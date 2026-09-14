<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $instructor1 = User::where('email', 'instructor@learnspace.test')->first();
        $instructor2 = User::where('email', 'instructor2@learnspace.test')->first();

        $webDev    = Category::where('slug', 'web-development')->first();
        $mobile    = Category::where('slug', 'mobile-development')->first();
        $uiux      = Category::where('slug', 'uiux-design')->first();
        $data      = Category::where('slug', 'data-science')->first();
        $marketing = Category::where('slug', 'digital-marketing')->first();

        $courses = [
            [
                'title'         => 'Laravel untuk Pemula: Dari Nol Sampai Mahir',
                'description'   => 'Belajar framework Laravel dari dasar hingga membuat aplikasi web yang nyata. Materi mencakup routing, Eloquent ORM, Blade templating, authentication, dan deployment.',
                'category_id'   => $webDev->id,
                'instructor_id' => $instructor1->id,
                'level'         => 'beginner',
                'duration'      => 480,
                'status'        => 'published',
            ],
            [
                'title'         => 'JavaScript Modern: ES6+ dan Asynchronous Programming',
                'description'   => 'Kuasai JavaScript modern dengan ES6+, Promises, Async/Await, dan konsep-konsep penting untuk pengembangan web profesional.',
                'category_id'   => $webDev->id,
                'instructor_id' => $instructor1->id,
                'level'         => 'intermediate',
                'duration'      => 360,
                'status'        => 'published',
            ],
            [
                'title'         => 'HTML & CSS: Membangun Website yang Indah',
                'description'   => 'Pelajari dasar-dasar HTML5 dan CSS3 untuk membangun website yang menarik dan responsif.',
                'category_id'   => $webDev->id,
                'instructor_id' => $instructor1->id,
                'level'         => 'beginner',
                'duration'      => 240,
                'status'        => 'published',
            ],
            [
                'title'         => 'Desain UI/UX dengan Figma: Panduan Lengkap',
                'description'   => 'Kuasai Figma dari awal dan pelajari prinsip-prinsip desain UI/UX yang digunakan industri.',
                'category_id'   => $uiux->id,
                'instructor_id' => $instructor2->id,
                'level'         => 'beginner',
                'duration'      => 300,
                'status'        => 'published',
            ],
            [
                'title'         => 'User Research dan Usability Testing',
                'description'   => 'Pelajari metodologi riset pengguna dan teknik usability testing untuk menciptakan produk digital yang berpusat pada pengguna.',
                'category_id'   => $uiux->id,
                'instructor_id' => $instructor2->id,
                'level'         => 'intermediate',
                'duration'      => 270,
                'status'        => 'published',
            ],
            [
                'title'         => 'Python untuk Data Science: Pandas dan Matplotlib',
                'description'   => 'Mulai perjalanan data science Anda dengan Python. Pelajari Pandas untuk manipulasi data dan Matplotlib untuk visualisasi.',
                'category_id'   => $data->id,
                'instructor_id' => $instructor1->id,
                'level'         => 'intermediate',
                'duration'      => 420,
                'status'        => 'published',
            ],
            [
                'title'         => 'Digital Marketing: Strategi SEO & Media Sosial',
                'description'   => 'Pelajari cara meningkatkan visibilitas website di mesin pencari dan membangun strategi media sosial yang efektif.',
                'category_id'   => $marketing->id,
                'instructor_id' => $instructor2->id,
                'level'         => 'beginner',
                'duration'      => 200,
                'status'        => 'published',
            ],
            [
                'title'         => 'React Native: Bangun Aplikasi Mobile Cross-Platform',
                'description'   => 'Buat aplikasi mobile Android dan iOS menggunakan React Native. Satu codebase untuk dua platform sekaligus.',
                'category_id'   => $mobile->id,
                'instructor_id' => $instructor1->id,
                'level'         => 'advanced',
                'duration'      => 540,
                'status'        => 'published',
            ],
        ];

        foreach ($courses as $courseData) {
            $courseData['slug'] = Str::slug($courseData['title']);
            Course::create($courseData);
        }
    }
}