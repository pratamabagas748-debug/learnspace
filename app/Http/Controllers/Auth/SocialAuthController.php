<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /** Provider yang didukung */
    protected array $supportedProviders = ['google', 'facebook'];

    /**
     * Redirect user langsung ke halaman otentikasi resmi Google / Facebook
     */
    public function redirect(string $provider)
    {
        if (!in_array($provider, $this->supportedProviders)) {
            return redirect()->route('login')->with('error', 'Metode login tidak didukung.');
        }

        $clientId = config("services.{$provider}.client_id");
        $clientSecret = config("services.{$provider}.client_secret");
        $providerName = ucfirst($provider);

        // Validasi kredensial OAuth di file .env
        if (empty($clientId) || empty($clientSecret)) {
            return redirect()->route('login')->with(
                'warning',
                "Untuk menyambungkan akun {$providerName} sungguhan, harap masukkan {$providerName}_CLIENT_ID dan {$providerName}_CLIENT_SECRET ke file .env terlebih dahulu."
            );
        }

        try {
            $redirectUrl = $this->getRedirectUrl($provider);

            // Arahkan browser langsung ke server otentikasi resmi Google / Facebook
            return Socialite::driver($provider)
                ->redirectUrl($redirectUrl)
                ->redirect();
        } catch (Exception $e) {
            Log::error("Socialite redirect error for {$provider}: " . $e->getMessage());

            return redirect()->route('login')->with(
                'error',
                "Gagal menghubungkan ke server {$providerName}: " . $e->getMessage()
            );
        }
    }

    /**
     * Handle callback resmi dari Google / Facebook setelah user memilih akun dan memberi izin
     */
    public function callback(Request $request, string $provider)
    {
        if (!in_array($provider, $this->supportedProviders)) {
            return redirect()->route('login')->with('error', 'Metode login tidak didukung.');
        }

        $providerName = ucfirst($provider);

        // Jika user membatalkan proses otorisasi di Google/Facebook
        if ($request->has('error') || $request->has('error_code')) {
            $errorDesc = $request->get('error_description', 'Proses otentikasi dibatalkan oleh pengguna.');
            return redirect()->route('login')->with('warning', "Login {$providerName} dibatalkan: {$errorDesc}");
        }

        try {
            $redirectUrl = $this->getRedirectUrl($provider);

            // Ambil data profil riil dari akun Google / Facebook pengguna
            try {
                $socialUser = Socialite::driver($provider)
                    ->redirectUrl($redirectUrl)
                    ->user();
            } catch (Exception $e) {
                // Fallback stateless untuk local development environment
                $socialUser = Socialite::driver($provider)
                    ->redirectUrl($redirectUrl)
                    ->stateless()
                    ->user();
            }

            $socialId = $socialUser->getId();
            $email = $socialUser->getEmail();
            $name = $socialUser->getName() ?? $socialUser->getNickname() ?? ('Pengguna ' . $providerName);
            $avatar = $socialUser->getAvatar();

            // Jika Facebook tidak menyediakan email (misal nomor telepon)
            if (empty($email)) {
                $email = "{$provider}_{$socialId}@social.learnspace.test";
            }

            // Cari apakah akun user sudah ada berdasarkan provider_id atau email
            $user = User::where('provider', $provider)
                ->where('provider_id', $socialId)
                ->first();

            if (!$user) {
                $user = User::where('email', $email)->first();
            }

            if ($user) {
                // Sambungkan akun yang sudah ada dengan kredensial Google/Facebook riil
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialId,
                    'provider_avatar' => $avatar,
                    'avatar' => $user->avatar ?: $avatar,
                    'email_verified_at' => $user->email_verified_at ?: now(),
                ]);
            } else {
                // Daftarkan pengguna baru dari akun Google/Facebook
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => null,
                    'role' => 'student',
                    'avatar' => $avatar,
                    'provider' => $provider,
                    'provider_id' => $socialId,
                    'provider_avatar' => $avatar,
                    'email_verified_at' => now(),
                    'xp_points' => 0,
                ]);
            }

            // Login ke sesi aplikasi
            Auth::login($user, true);
            $request->session()->regenerate();

            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard')->with('success', "Selamat datang, {$user->name}! Anda berhasil login dengan akun resmi {$providerName}."),
                'instructor' => redirect()->route('instructor.dashboard')->with('success', "Selamat datang, {$user->name}! Anda berhasil login dengan akun resmi {$providerName}."),
                default => redirect()->route('student.dashboard')->with('success', "Selamat datang, {$user->name}! Anda berhasil login dengan akun resmi {$providerName}."),
            };

        } catch (Exception $e) {
            Log::error("Socialite callback error for {$provider}: " . $e->getMessage());

            return redirect()->route('login')->with(
                'error',
                "Gagal memproses data akun {$providerName}: " . $e->getMessage()
            );
        }
    }

    /**
     * Dapatkan URL callback redirect yang konsisten
     */
    protected function getRedirectUrl(string $provider): string
    {
        $configured = config("services.{$provider}.redirect");
        if (!empty($configured)) {
            return $configured;
        }

        return route('auth.social.callback', $provider);
    }
}
