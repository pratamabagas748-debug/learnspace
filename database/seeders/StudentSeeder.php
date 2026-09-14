<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['name' => 'Ahmad Fauzi',    'email' => 'student@learnspace.test'],
            ['name' => 'Dewi Lestari',   'email' => 'dewi@learnspace.test'],
            ['name' => 'Rizki Pratama',  'email' => 'rizki@learnspace.test'],
            ['name' => 'Maya Sari',      'email' => 'maya@learnspace.test'],
            ['name' => 'Hendra Wijaya',  'email' => 'hendra@learnspace.test'],
        ];

        foreach ($students as $student) {
            User::create([
                'name'     => $student['name'],
                'email'    => $student['email'],
                'password' => Hash::make('password'),
                'role'     => 'student',
            ]);
        }
    }
}
