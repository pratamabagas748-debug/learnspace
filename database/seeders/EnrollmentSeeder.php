<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\User;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $student1 = User::where('email', 'student@learnspace.test')->first();
        $student2 = User::where('email', 'dewi@learnspace.test')->first();
        $student3 = User::where('email', 'rizki@learnspace.test')->first();

        $laravelCourse = Course::where('slug', 'laravel-untuk-pemula-dari-nol-sampai-mahir')->first();
        $jsCourse      = Course::where('slug', 'javascript-modern-es6-dan-asynchronous-programming')->first();
        $htmlCourse    = Course::where('slug', 'html-css-membangun-website-yang-indah')->first();
        $figmaCourse   = Course::where('slug', 'desain-ui-ux-dengan-figma-panduan-lengkap')->first();

        // Student 1: enroll Laravel (progress 40%), JS (progress 0%), HTML (sudah selesai semua)
        if ($laravelCourse) {
            Enrollment::create([
                'user_id'     => $student1->id,
                'course_id'   => $laravelCourse->id,
                'enrolled_at' => now()->subDays(14),
            ]);

            // Selesaikan 4 dari 10 lesson
            $lessons = $laravelCourse->lessons()->take(4)->get();
            foreach ($lessons as $lesson) {
                LessonProgress::create([
                    'user_id'      => $student1->id,
                    'lesson_id'    => $lesson->id,
                    'completed_at' => now()->subDays(10),
                ]);
            }
        }

        if ($jsCourse) {
            Enrollment::create([
                'user_id'     => $student1->id,
                'course_id'   => $jsCourse->id,
                'enrolled_at' => now()->subDays(7),
            ]);
            // Belum ada progress
        }

        if ($htmlCourse) {
            Enrollment::create([
                'user_id'     => $student1->id,
                'course_id'   => $htmlCourse->id,
                'enrolled_at' => now()->subDays(30),
                'completed_at'=> now()->subDays(5),
            ]);

            // Selesaikan semua lesson HTML
            $lessons = $htmlCourse->lessons()->get();
            foreach ($lessons as $lesson) {
                LessonProgress::create([
                    'user_id'      => $student1->id,
                    'lesson_id'    => $lesson->id,
                    'completed_at' => now()->subDays(6),
                ]);
            }
        }

        // Student 2: enroll Figma (progress 70%)
        if ($figmaCourse) {
            Enrollment::create([
                'user_id'     => $student2->id,
                'course_id'   => $figmaCourse->id,
                'enrolled_at' => now()->subDays(20),
            ]);

            $lessons = $figmaCourse->lessons()->take(5)->get();
            foreach ($lessons as $lesson) {
                LessonProgress::create([
                    'user_id'      => $student2->id,
                    'lesson_id'    => $lesson->id,
                    'completed_at' => now()->subDays(15),
                ]);
            }
        }

        if ($laravelCourse) {
            Enrollment::create([
                'user_id'     => $student2->id,
                'course_id'   => $laravelCourse->id,
                'enrolled_at' => now()->subDays(10),
            ]);
        }

        // Student 3: enroll Laravel dan JS
        if ($laravelCourse) {
            Enrollment::create([
                'user_id'     => $student3->id,
                'course_id'   => $laravelCourse->id,
                'enrolled_at' => now()->subDays(5),
            ]);

            $lessons = $laravelCourse->lessons()->take(2)->get();
            foreach ($lessons as $lesson) {
                LessonProgress::create([
                    'user_id'      => $student3->id,
                    'lesson_id'    => $lesson->id,
                    'completed_at' => now()->subDays(3),
                ]);
            }
        }

        if ($jsCourse) {
            Enrollment::create([
                'user_id'     => $student3->id,
                'course_id'   => $jsCourse->id,
                'enrolled_at' => now()->subDays(3),
            ]);
        }
    }
}
