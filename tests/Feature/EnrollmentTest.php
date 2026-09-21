<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    private User $student;
    private Course $course;

    protected function setUp(): void
    {
        parent::setUp();

        $instructor = User::factory()->create(['role' => 'instructor']);
        $category   = Category::create(['name' => 'Teknologi', 'slug' => 'teknologi']);

        $this->course = Course::create([
            'title'         => 'Kursus Laravel',
            'slug'          => 'kursus-laravel',
            'description'   => 'Belajar Laravel',
            'category_id'   => $category->id,
            'instructor_id' => $instructor->id,
            'level'         => 'beginner',
            'duration'      => 120,
            'status'        => 'published',
        ]);

        $this->student = User::factory()->create(['role' => 'student']);
    }

    // ==========================================
    // ENROLLMENT
    // ==========================================

    #[Test]
    public function student_dapat_enroll_ke_kursus_published(): void
    {
        $response = $this->actingAs($this->student)
            ->post("/student/courses/{$this->course->id}/enroll");

        $response->assertRedirect(route('student.courses.show', $this->course->slug));

        $this->assertDatabaseHas('enrollments', [
            'user_id'   => $this->student->id,
            'course_id' => $this->course->id,
        ]);
    }

    #[Test]
    public function student_tidak_bisa_enroll_dua_kali_ke_kursus_yang_sama(): void
    {
        // Enroll pertama
        Enrollment::create([
            'user_id'     => $this->student->id,
            'course_id'   => $this->course->id,
            'enrolled_at' => now(),
        ]);

        // Coba enroll kedua — harus redirect dengan pesan info, bukan DB error
        $response = $this->actingAs($this->student)
            ->post("/student/courses/{$this->course->id}/enroll");

        $response->assertRedirect(route('student.courses.show', $this->course->slug));
        $response->assertSessionHas('info');

        // Pastikan hanya ada 1 enrollment di DB
        $this->assertDatabaseCount('enrollments', 1);
    }

    #[Test]
    public function student_tidak_bisa_enroll_ke_kursus_draft(): void
    {
        $this->course->update(['status' => 'draft']);

        $this->actingAs($this->student)
            ->post("/student/courses/{$this->course->id}/enroll")
            ->assertStatus(404);

        $this->assertDatabaseCount('enrollments', 0);
    }

    // ==========================================
    // LESSON ACCESS
    // ==========================================

    #[Test]
    public function student_tidak_bisa_akses_lesson_tanpa_enrollment(): void
    {
        $lesson = Lesson::create([
            'course_id' => $this->course->id,
            'title'     => 'Pengenalan Laravel',
            'order'     => 1,
        ]);

        // Harus di-redirect karena belum enroll
        $this->actingAs($this->student)
            ->get("/student/lessons/{$lesson->id}")
            ->assertRedirect();
    }

    #[Test]
    public function student_yang_sudah_enroll_dapat_akses_lesson(): void
    {
        Enrollment::create([
            'user_id'     => $this->student->id,
            'course_id'   => $this->course->id,
            'enrolled_at' => now(),
        ]);

        $lesson = Lesson::create([
            'course_id' => $this->course->id,
            'title'     => 'Pengenalan Laravel',
            'order'     => 1,
        ]);

        $this->actingAs($this->student)
            ->get("/student/lessons/{$lesson->id}")
            ->assertStatus(200);
    }

    // ==========================================
    // LESSON PROGRESS
    // ==========================================

    #[Test]
    public function student_dapat_menandai_lesson_selesai(): void
    {
        Enrollment::create([
            'user_id'     => $this->student->id,
            'course_id'   => $this->course->id,
            'enrolled_at' => now(),
        ]);

        $lesson = Lesson::create([
            'course_id' => $this->course->id,
            'title'     => 'Pengenalan Laravel',
            'order'     => 1,
        ]);

        $this->actingAs($this->student)
            ->post("/student/lessons/{$lesson->id}/complete")
            ->assertRedirect();

        $this->assertDatabaseHas('lesson_progress', [
            'user_id'   => $this->student->id,
            'lesson_id' => $lesson->id,
        ]);
    }

    #[Test]
    public function student_tidak_bisa_menandai_lesson_selesai_dua_kali(): void
    {
        Enrollment::create([
            'user_id'     => $this->student->id,
            'course_id'   => $this->course->id,
            'enrolled_at' => now(),
        ]);

        $lesson = Lesson::create([
            'course_id' => $this->course->id,
            'title'     => 'Pengenalan Laravel',
            'order'     => 1,
        ]);

        // Complete pertama
        $this->actingAs($this->student)
            ->post("/student/lessons/{$lesson->id}/complete");

        // Complete kedua — tidak boleh duplicate, harus OK tanpa error
        $this->actingAs($this->student)
            ->post("/student/lessons/{$lesson->id}/complete")
            ->assertRedirect();

        // Hanya 1 record progress
        $this->assertDatabaseCount('lesson_progress', 1);
    }

    #[Test]
    public function progress_kursus_dihitung_dengan_benar(): void
    {
        Enrollment::create([
            'user_id'     => $this->student->id,
            'course_id'   => $this->course->id,
            'enrolled_at' => now(),
        ]);

        // Buat 5 lesson
        $lessons = [];
        for ($i = 1; $i <= 5; $i++) {
            $lessons[] = Lesson::create([
                'course_id' => $this->course->id,
                'title'     => "Lesson {$i}",
                'order'     => $i,
            ]);
        }

        // Selesaikan 2 dari 5 = 40%
        LessonProgress::create([
            'user_id'      => $this->student->id,
            'lesson_id'    => $lessons[0]->id,
            'completed_at' => now(),
        ]);
        LessonProgress::create([
            'user_id'      => $this->student->id,
            'lesson_id'    => $lessons[1]->id,
            'completed_at' => now(),
        ]);

        $progress = $this->course->getProgressForUser($this->student);

        $this->assertEquals(40, $progress);
    }

    #[Test]
    public function progress_100_persen_ketika_semua_lesson_selesai(): void
    {
        Enrollment::create([
            'user_id'     => $this->student->id,
            'course_id'   => $this->course->id,
            'enrolled_at' => now(),
        ]);

        // Buat 3 lesson dan selesaikan semua
        for ($i = 1; $i <= 3; $i++) {
            $lesson = Lesson::create([
                'course_id' => $this->course->id,
                'title'     => "Lesson {$i}",
                'order'     => $i,
            ]);
            LessonProgress::create([
                'user_id'      => $this->student->id,
                'lesson_id'    => $lesson->id,
                'completed_at' => now(),
            ]);
        }

        $progress = $this->course->getProgressForUser($this->student);

        $this->assertEquals(100, $progress);
    }
}
