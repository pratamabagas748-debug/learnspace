<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    // ==========================================
    // REGISTER
    // ==========================================

    #[Test]
    public function user_dapat_melihat_halaman_register(): void
    {
        $this->get('/register')->assertStatus(200);
    }

    #[Test]
    public function user_dapat_registrasi_dan_menjadi_student(): void
    {
        $response = $this->post('/register', [
            'name'                  => 'User Test',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('student.dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role'  => 'student',
        ]);

        // Pastikan password tidak disimpan plaintext
        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotEquals('password123', $user->password);
    }

    #[Test]
    public function registrasi_gagal_jika_email_sudah_dipakai(): void
    {
        User::factory()->create(['email' => 'duplikat@example.com']);

        $response = $this->post('/register', [
            'name'                  => 'User Lain',
            'email'                 => 'duplikat@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    // ==========================================
    // LOGIN
    // ==========================================

    #[Test]
    public function user_dapat_melihat_halaman_login(): void
    {
        $this->get('/login')->assertStatus(200);
    }

    #[Test]
    public function student_dapat_login_dan_diarahkan_ke_student_dashboard(): void
    {
        $student = User::factory()->create(['role' => 'student', 'password' => bcrypt('password')]);

        $response = $this->post('/login', [
            'email'    => $student->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('student.dashboard'));
        $this->assertAuthenticatedAs($student);
    }

    #[Test]
    public function admin_dapat_login_dan_diarahkan_ke_admin_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'password' => bcrypt('password')]);

        $this->post('/login', [
            'email'    => $admin->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));
    }

    #[Test]
    public function instructor_dapat_login_dan_diarahkan_ke_instructor_dashboard(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor', 'password' => bcrypt('password')]);

        $this->post('/login', [
            'email'    => $instructor->email,
            'password' => 'password',
        ])->assertRedirect(route('instructor.dashboard'));
    }

    #[Test]
    public function login_gagal_jika_password_salah(): void
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'salah123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    // ==========================================
    // LOGOUT
    // ==========================================

    #[Test]
    public function user_dapat_logout(): void
    {
        $user = User::factory()->create(['role' => 'student']);

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    // ==========================================
    // GUEST PROTECTION
    // ==========================================

    #[Test]
    public function guest_tidak_bisa_akses_student_dashboard(): void
    {
        $this->get('/student/dashboard')->assertRedirect(route('login'));
    }

    #[Test]
    public function guest_tidak_bisa_akses_admin_dashboard(): void
    {
        $this->get('/admin/dashboard')->assertRedirect(route('login'));
    }

    #[Test]
    public function guest_tidak_bisa_akses_instructor_dashboard(): void
    {
        $this->get('/instructor/dashboard')->assertRedirect(route('login'));
    }
}
