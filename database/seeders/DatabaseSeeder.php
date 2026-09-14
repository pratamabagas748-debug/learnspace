<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            InstructorSeeder::class,
            StudentSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            LessonSeeder::class,
            EnrollmentSeeder::class,
        ]);
    }
}
