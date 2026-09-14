<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development',  'description' => 'Pelajari HTML, CSS, JavaScript, PHP, Laravel, dan framework modern lainnya.'],
            ['name' => 'Mobile Development', 'description' => 'Kembangkan aplikasi mobile untuk Android dan iOS.'],
            ['name' => 'Data Science',     'description' => 'Analisis data, machine learning, dan kecerdasan buatan.'],
            ['name' => 'UI/UX Design',     'description' => 'Desain antarmuka dan pengalaman pengguna yang luar biasa.'],
            ['name' => 'Digital Marketing','description' => 'Strategi pemasaran digital, SEO, dan media sosial.'],
            ['name' => 'Bisnis & Karir',   'description' => 'Pengembangan karir, manajemen, dan keterampilan bisnis.'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name'        => $cat['name'],
                'slug'        => Str::slug($cat['name']),
                'description' => $cat['description'],
            ]);
        }
    }
}
