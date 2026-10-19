<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Jeffrey Way',
            'email'    => 'instructor@learnspace.test',
            'password' => Hash::make('password'),
            'role'     => 'instructor',
            'bio'      => 'Founder of Laracasts & Senior Web Engineer. Lebih dari 12 tahun mengajar Laravel, PHP, dan arsitektur web modern kepada jutaan programmer di seluruh dunia.',
            'avatar'   => 'avatars/instructor_jeffrey.jpg',
        ]);

        User::create([
            'name'     => 'Dr. Angela Yu',
            'email'    => 'instructor2@learnspace.test',
            'password' => Hash::make('password'),
            'role'     => 'instructor',
            'bio'      => 'Founder & Lead Instructor di The App Brewery. Pengajar top dunia dalam pemrograman Python, Data Science, Mobile Apps, dan UI/UX Design dengan lebih dari 2 juta murid global.',
            'avatar'   => 'avatars/instructor2.jpg',
        ]);

        User::create([
            'name'     => 'Brad Traversy',
            'email'    => 'instructor3@learnspace.test',
            'password' => Hash::make('password'),
            'role'     => 'instructor',
            'bio'      => 'Creator of Traversy Media. Ahli full-stack web development yang telah memproduksi ratusan kursus praktis seputar JavaScript, React, dan API modern.',
            'avatar'   => 'avatars/instructor3.jpg',
        ]);
    }
}
