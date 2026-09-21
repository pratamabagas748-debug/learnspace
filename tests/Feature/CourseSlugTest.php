<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CourseSlugTest extends TestCase
{
    use RefreshDatabase;

    private function makeInstructorAndCategory(): array
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $category   = Category::create(['name' => 'Web', 'slug' => 'web']);
        return [$instructor, $category];
    }

    #[Test]
    public function slug_dibuat_otomatis_dari_title(): void
    {
        [$instructor, $category] = $this->makeInstructorAndCategory();

        $course = Course::create([
            'title'         => 'Belajar Laravel',
            'description'   => 'Deskripsi',
            'category_id'   => $category->id,
            'instructor_id' => $instructor->id,
            'level'         => 'beginner',
            'duration'      => 60,
            'status'        => 'published',
        ]);

        $this->assertEquals('belajar-laravel', $course->slug);
    }

    #[Test]
    public function slug_unik_jika_judul_sama(): void
    {
        [$instructor, $category] = $this->makeInstructorAndCategory();

        $data = [
            'description'   => 'Deskripsi',
            'category_id'   => $category->id,
            'instructor_id' => $instructor->id,
            'level'         => 'beginner',
            'duration'      => 60,
            'status'        => 'published',
        ];

        $course1 = Course::create(array_merge($data, ['title' => 'Belajar Laravel']));
        $course2 = Course::create(array_merge($data, ['title' => 'Belajar Laravel']));
        $course3 = Course::create(array_merge($data, ['title' => 'Belajar Laravel']));

        $this->assertEquals('belajar-laravel',   $course1->slug);
        $this->assertEquals('belajar-laravel-2', $course2->slug);
        $this->assertEquals('belajar-laravel-3', $course3->slug);
    }

    #[Test]
    public function slug_kursus_dapat_diakses_melalui_route_publik(): void
    {
        [$instructor, $category] = $this->makeInstructorAndCategory();

        $course = Course::create([
            'title'         => 'Kursus Publik',
            'description'   => 'Deskripsi',
            'category_id'   => $category->id,
            'instructor_id' => $instructor->id,
            'level'         => 'beginner',
            'duration'      => 60,
            'status'        => 'published',
        ]);

        $this->get("/courses/{$course->slug}")->assertStatus(200);
    }

    #[Test]
    public function kursus_draft_tidak_dapat_diakses_di_halaman_publik(): void
    {
        [$instructor, $category] = $this->makeInstructorAndCategory();

        $course = Course::create([
            'title'         => 'Kursus Draft',
            'description'   => 'Deskripsi',
            'category_id'   => $category->id,
            'instructor_id' => $instructor->id,
            'level'         => 'beginner',
            'duration'      => 60,
            'status'        => 'draft',
        ]);

        $this->get("/courses/{$course->slug}")->assertStatus(404);
    }
}
