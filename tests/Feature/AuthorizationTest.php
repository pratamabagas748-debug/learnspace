<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    // ==========================================
    // STUDENT TIDAK BOLEH AKSES ADMIN/INSTRUCTOR
    // ==========================================

    #[Test]
    public function student_tidak_bisa_akses_admin_dashboard(): void
    {
        $student = User::factory()->create(['role' => 'student']);

        // RoleMiddleware harus redirect ke dashboard role aktif
        $this->actingAs($student)
            ->get('/admin/dashboard')
            ->assertRedirect(route('student.dashboard'));
    }

    #[Test]
    public function student_tidak_bisa_akses_instructor_dashboard(): void
    {
        $student = User::factory()->create(['role' => 'student']);

        $this->actingAs($student)
            ->get('/instructor/dashboard')
            ->assertRedirect(route('student.dashboard'));
    }

    // ==========================================
    // INSTRUCTOR TIDAK BOLEH AKSES ADMIN
    // ==========================================

    #[Test]
    public function instructor_tidak_bisa_akses_admin_dashboard(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor']);

        $this->actingAs($instructor)
            ->get('/admin/dashboard')
            ->assertRedirect(route('instructor.dashboard'));
    }

    #[Test]
    public function instructor_tidak_bisa_akses_student_dashboard(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor']);

        $this->actingAs($instructor)
            ->get('/student/dashboard')
            ->assertRedirect(route('instructor.dashboard'));
    }

    // ==========================================
    // ADMIN TIDAK BOLEH AKSES AREA LAIN
    // ==========================================

    #[Test]
    public function admin_tidak_bisa_akses_instructor_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get('/instructor/dashboard')
            ->assertRedirect(route('admin.dashboard'));
    }

    // ==========================================
    // INSTRUCTOR OWNERSHIP
    // ==========================================

    #[Test]
    public function instructor_tidak_bisa_edit_course_milik_instructor_lain(): void
    {
        $instructor1 = User::factory()->create(['role' => 'instructor']);
        $instructor2 = User::factory()->create(['role' => 'instructor']);

        $category = Category::create(['name' => 'Test', 'slug' => 'test']);
        $course = Course::create([
            'title'         => 'Kursus Instructor 1',
            'slug'          => 'kursus-instructor-1',
            'description'   => 'Deskripsi',
            'category_id'   => $category->id,
            'instructor_id' => $instructor1->id,
            'level'         => 'beginner',
            'duration'      => 60,
            'status'        => 'published',
        ]);

        // Instructor 2 mencoba edit course milik Instructor 1 → 403
        $this->actingAs($instructor2)
            ->get("/instructor/courses/{$course->id}/edit")
            ->assertStatus(403);
    }

    #[Test]
    public function instructor_tidak_bisa_hapus_course_milik_instructor_lain(): void
    {
        $instructor1 = User::factory()->create(['role' => 'instructor']);
        $instructor2 = User::factory()->create(['role' => 'instructor']);

        $category = Category::create(['name' => 'Test', 'slug' => 'test']);
        $course = Course::create([
            'title'         => 'Kursus Instructor 1',
            'slug'          => 'kursus-instructor-1',
            'description'   => 'Deskripsi',
            'category_id'   => $category->id,
            'instructor_id' => $instructor1->id,
            'level'         => 'beginner',
            'duration'      => 60,
            'status'        => 'published',
        ]);

        $this->actingAs($instructor2)
            ->delete("/instructor/courses/{$course->id}")
            ->assertStatus(403);

        // Course harus tetap ada di database
        $this->assertDatabaseHas('courses', ['id' => $course->id]);
    }

    // ==========================================
    // STUDENT TIDAK BOLEH AKSES INSTRUCTOR ROUTES
    // ==========================================

    #[Test]
    public function student_tidak_bisa_buat_course(): void
    {
        $student = User::factory()->create(['role' => 'student']);

        $this->actingAs($student)
            ->get('/instructor/courses/create')
            ->assertRedirect(route('student.dashboard'));
    }
}
