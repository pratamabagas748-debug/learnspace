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
            'name'     => 'Budi Santoso',
            'email'    => 'instructor@learnspace.test',
            'password' => Hash::make('password'),
            'role'     => 'instructor',
            'bio'      => 'Software Engineer dengan 8 tahun pengalaman di bidang web development. Spesialisasi di Laravel dan JavaScript.',
        ]);

        User::create([
            'name'     => 'Siti Rahayu',
            'email'    => 'instructor2@learnspace.test',
            'password' => Hash::make('password'),
            'role'     => 'instructor',
            'bio'      => 'UI/UX Designer berpengalaman dengan fokus pada desain produk digital. Menguasai Figma, Adobe XD, dan prinsip Human-Centered Design.',
        ]);
    }
}
