<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /** Tampilkan halaman login */
    public function show()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (auth()->check()) {
            return $this->redirectToDashboard();
        }

        return view('auth.login');
    }

    /** Proses login */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->redirectToDashboard();
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /** Logout */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }

    /** Redirect ke dashboard sesuai role */
    private function redirectToDashboard()
    {
        $role = auth()->user()->role;

        return match ($role) {
            'admin'      => redirect()->route('admin.dashboard'),
            'instructor' => redirect()->route('instructor.dashboard'),
            'student'    => redirect()->route('student.dashboard'),
            default      => redirect('/'),
        };
    }
}
