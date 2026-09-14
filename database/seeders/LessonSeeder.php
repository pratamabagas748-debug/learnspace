<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $lessonsData = [
            // Kursus 1: Laravel untuk Pemula
            'laravel-untuk-pemula-dari-nol-sampai-mahir' => [
                ['title' => 'Pengenalan Laravel dan MVC Pattern',         'duration' => 20, 'content' => 'Laravel adalah framework PHP yang elegan dan ekspresif. Framework ini menggunakan arsitektur MVC (Model-View-Controller) yang memisahkan logika bisnis, tampilan, dan kontrol alur aplikasi. Pada materi ini kita akan memahami konsep dasar MVC dan bagaimana Laravel mengimplementasikannya.'],
                ['title' => 'Instalasi Laravel dan Konfigurasi Environment','duration' => 25, 'content' => 'Cara menginstall Laravel menggunakan Composer, konfigurasi file .env, setup database MySQL, dan menjalankan development server. Kita juga akan belajar tentang struktur folder Laravel.'],
                ['title' => 'Routing: Mengelola URL Aplikasi',             'duration' => 30, 'content' => 'Routing adalah jantung dari aplikasi Laravel. Pada materi ini kita belajar cara mendefinisikan route, menggunakan route parameters, route naming, dan route grouping untuk mengorganisasi URL aplikasi.'],
                ['title' => 'Controller: Memisahkan Logika Bisnis',        'duration' => 35, 'content' => 'Controller berperan sebagai perantara antara Model dan View. Kita akan belajar cara membuat controller, resource controller, dan bagaimana menghubungkan controller dengan route.'],
                ['title' => 'Blade Templating: Membuat Tampilan Dinamis',  'duration' => 40, 'content' => 'Blade adalah template engine bawaan Laravel yang powerful. Kita akan belajar sintaks Blade, template inheritance, komponen, dan cara menampilkan data dari controller ke view.'],
                ['title' => 'Eloquent ORM: Interaksi dengan Database',     'duration' => 45, 'content' => 'Eloquent adalah ORM (Object-Relational Mapper) Laravel yang membuat interaksi dengan database menjadi intuitif. Kita akan belajar cara mendefinisikan model, CRUD operations, dan query builder.'],
                ['title' => 'Relasi Database dengan Eloquent',             'duration' => 50, 'content' => 'Pelajari cara mendefinisikan relasi antar tabel menggunakan Eloquent: hasOne, hasMany, belongsTo, belongsToMany, dan cara menggunakannya dalam aplikasi nyata.'],
                ['title' => 'Authentication dengan Laravel Breeze',        'duration' => 40, 'content' => 'Implementasi sistem login, registrasi, dan logout menggunakan sistem autentikasi bawaan Laravel. Kita juga akan belajar middleware untuk melindungi route.'],
                ['title' => 'Validasi Form dan Penanganan Error',          'duration' => 35, 'content' => 'Cara memvalidasi input pengguna menggunakan Form Request dan fitur validasi Laravel. Kita juga belajar cara menampilkan pesan error yang informatif kepada pengguna.'],
                ['title' => 'File Storage dan Upload Gambar',              'duration' => 30, 'content' => 'Cara menyimpan file dan gambar menggunakan sistem penyimpanan Laravel. Kita akan belajar local storage, public disk, dan cara menampilkan gambar yang diupload.'],
            ],
            // Kursus 2: JavaScript Modern
            'javascript-modern-es6-dan-asynchronous-programming' => [
                ['title' => 'Let, Const, dan Var: Perbedaan dan Penggunaannya','duration' => 20, 'content' => 'Memahami perbedaan antara var, let, dan const dalam JavaScript modern. Kita akan belajar tentang scope, hoisting, dan kapan harus menggunakan masing-masing.'],
                ['title' => 'Arrow Functions dan Template Literals',           'duration' => 25, 'content' => 'Arrow function adalah sintaks baru ES6 untuk menulis fungsi yang lebih ringkas. Template literal memungkinkan kita menyisipkan ekspresi JavaScript ke dalam string dengan mudah.'],
                ['title' => 'Destructuring dan Spread Operator',              'duration' => 30, 'content' => 'Destructuring memungkinkan kita mengekstrak nilai dari array atau objek dengan cara yang elegan. Spread operator (...) memungkinkan kita menyebarkan elemen array atau properti objek.'],
                ['title' => 'Promises: Menangani Operasi Asynchronous',       'duration' => 40, 'content' => 'Promise adalah cara modern untuk menangani operasi asynchronous di JavaScript. Kita akan belajar cara membuat promise, chaining, dan menangani error.'],
                ['title' => 'Async/Await: Sintaks yang Lebih Bersih',         'duration' => 35, 'content' => 'Async/await adalah sintaks yang membuat kode asynchronous terlihat dan berperilaku seperti kode synchronous. Sangat berguna untuk membaca kode yang kompleks.'],
                ['title' => 'Fetch API dan Integrasi dengan REST API',        'duration' => 45, 'content' => 'Cara mengambil data dari server menggunakan Fetch API. Kita akan belajar cara melakukan GET, POST, PUT, dan DELETE request ke REST API.'],
                ['title' => 'JavaScript Modules: Import dan Export',          'duration' => 25, 'content' => 'Modularisasi kode JavaScript menggunakan ES Modules. Cara mengexport fungsi dan variabel dari satu file dan mengimportnya di file lain.'],
            ],
            // Kursus 3: HTML & CSS
            'html-css-membangun-website-yang-indah' => [
                ['title' => 'Pengenalan HTML5 dan Struktur Dokumen',    'duration' => 20, 'content' => 'HTML (HyperText Markup Language) adalah bahasa markup yang digunakan untuk membuat struktur halaman web. Kita akan belajar tag-tag dasar HTML5 dan cara membuat dokumen HTML yang valid.'],
                ['title' => 'Elemen Semantik HTML5',                    'duration' => 25, 'content' => 'HTML5 memperkenalkan elemen semantik seperti header, nav, main, article, section, dan footer yang membuat struktur halaman lebih bermakna dan SEO-friendly.'],
                ['title' => 'Dasar CSS: Selector, Properties, Values', 'duration' => 30, 'content' => 'CSS (Cascading Style Sheets) digunakan untuk mengontrol tampilan halaman web. Kita akan belajar berbagai jenis selector CSS dan property yang paling sering digunakan.'],
                ['title' => 'CSS Flexbox: Layout yang Fleksibel',       'duration' => 35, 'content' => 'Flexbox adalah model layout CSS yang powerful untuk mengatur elemen dalam satu dimensi (baris atau kolom). Sangat berguna untuk membuat navigasi, card grid, dan layout yang responsif.'],
                ['title' => 'CSS Grid: Layout Dua Dimensi',             'duration' => 40, 'content' => 'CSS Grid adalah sistem layout dua dimensi yang memungkinkan kita mengatur elemen dalam baris dan kolom sekaligus. Sangat powerful untuk membuat layout halaman yang kompleks.'],
                ['title' => 'Responsive Design dengan Media Queries',   'duration' => 35, 'content' => 'Cara membuat website yang terlihat bagus di semua ukuran layar menggunakan media queries, mobile-first approach, dan unit yang relatif.'],
            ],
            // Kursus 4: UI/UX dengan Figma
            'desain-ui-ux-dengan-figma-panduan-lengkap' => [
                ['title' => 'Pengenalan UI/UX Design dan Perbedaannya', 'duration' => 20, 'content' => 'UI (User Interface) dan UX (User Experience) adalah dua aspek penting dalam desain produk digital. Kita akan memahami perbedaan keduanya dan bagaimana mereka saling melengkapi.'],
                ['title' => 'Mengenal Antarmuka Figma',                 'duration' => 25, 'content' => 'Tur lengkap antarmuka Figma: canvas, layers panel, properties panel, toolbar, dan shortcut penting yang harus kamu kuasai untuk bekerja efisien.'],
                ['title' => 'Prinsip Desain Visual: Hierarki dan Kontras','duration' => 30, 'content' => 'Prinsip-prinsip desain visual yang penting: hierarki visual, kontras, keseimbangan, dan kesatuan. Bagaimana menerapkannya untuk menciptakan desain yang efektif.'],
                ['title' => 'Typography dalam UI Design',               'duration' => 25, 'content' => 'Cara memilih dan menggunakan tipografi yang tepat dalam desain UI. Kita akan belajar tentang font pairing, ukuran teks, line height, dan cara membuat type scale.'],
                ['title' => 'Color Theory untuk UI Designer',           'duration' => 30, 'content' => 'Teori warna dalam konteks desain UI: roda warna, harmoni warna, psikologi warna, dan cara membuat color palette yang konsisten untuk produk digital.'],
                ['title' => 'Membuat Component Library di Figma',       'duration' => 45, 'content' => 'Cara membuat dan mengelola component library di Figma menggunakan Auto Layout, Variants, dan Instance. Component library memastikan konsistensi desain.'],
                ['title' => 'Prototyping Interaktif dengan Figma',      'duration' => 40, 'content' => 'Cara membuat prototype interaktif di Figma untuk mensimulasikan alur pengguna. Kita akan belajar connections, transitions, dan cara mempresentasikan prototype ke klien.'],
            ],
        ];

        foreach ($lessonsData as $courseSlug => $lessons) {
            $course = Course::where('slug', $courseSlug)->first();
            if (!$course) continue;

            foreach ($lessons as $order => $lessonData) {
                Lesson::create([
                    'course_id'   => $course->id,
                    'title'       => $lessonData['title'],
                    'description' => 'Materi ke-' . ($order + 1) . ' dari kursus ' . $course->title,
                    'content'     => $lessonData['content'],
                    'duration'    => $lessonData['duration'],
                    'order'       => $order + 1,
                ]);
            }
        }
    }
}
