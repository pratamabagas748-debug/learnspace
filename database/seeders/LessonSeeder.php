<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus lesson lama agar tidak duplikasi saat re-seeding
        Lesson::query()->delete();

        $lessonsData = [
            // =========================================================================
            // KURSUS 1: LARAVEL UNTUK PEMULA: DARI NOL SAMPAI MAHIR
            // =========================================================================
            'laravel-untuk-pemula-dari-nol-sampai-mahir' => [
                [
                    'title'       => 'Pengenalan Laravel dan Arsitektur MVC',
                    'duration'    => 25,
                    'description' => 'Memahami konsep dasar framework Laravel, filosofi desain, dan bagaimana pola arsitektur MVC memisahkan logika aplikasi.',
                    'content'     => <<<'MARKDOWN'
# Pengenalan Laravel & Konsep Arsitektur MVC

Selamat datang di materi pertama kursus **Laravel untuk Pemula**! Di modul ini, kita akan mempelajari fondasi paling penting sebelum mulai menulis baris kode: memahami **apa itu Laravel** dan **bagaimana cara kerja pola arsitektur MVC**.

---

### 1. Apa itu Laravel?
**Laravel** adalah sebuah *web application framework* berbasis bahasa pemrograman PHP yang dirancang dengan sintaks yang elegan, ekspresif, dan menyenangkan bagi pengembang (*developer happiness*). Diciptakan oleh **Taylor Otwell** pada tahun 2011, Laravel kini menjadi salah satu framework backend paling populer di dunia.

Beberapa keunggulan utama Laravel:
* **Ekosistem Lengkap:** Mendukung autentikasi, ORM, routing, migrasi database, queue, dan caching secara bawaan.
* **Sintaks Ekspresif:** Kode mudah dibaca seperti bahasa Inggris formal.
* **Keamanan Terintegrasi:** Dilengkapi perlindungan terhadap *CSRF (Cross-Site Request Forgery)*, *SQL Injection*, dan *XSS (Cross-Site Scripting)*.
* **Komunitas Global & Lokal yang Sangat Besar:** Dokumentasi resmi yang luar biasa dan komunitas Indonesia yang aktif.

---

### 2. Memahami Pola Arsitektur MVC
Laravel mengadopsi pola desain arsitektur **MVC (Model - View - Controller)**. MVC memisahkan tanggung jawab kode menjadi 3 lapisan terpisah:

1. **Model (M):**
   * Bertanggung jawab mengelola data dan aturan logika bisnis database.
   * Di Laravel, Model menggunakan **Eloquent ORM**, sehingga tabel di database dipetakan ke dalam objek PHP.
2. **View (V):**
   * Bertanggung jawab atas tampilan antarmuka (UI) yang dilihat pengguna di browser.
   * Di Laravel, tampilan dibuat menggunakan file template **Blade** (`.blade.php`).
3. **Controller (C):**
   * Bertindak sebagai otak atau perantara antara Model dan View.
   * Menerima request HTTP dari pengguna, memproses data melalui Model, lalu mengirimkan hasilnya ke View.

```
Pengguna (Browser) ──[ HTTP Request ]──> Route ──> Controller
                                                        │
                      ┌─────────────────────────────────┴─────────────────┐
                      ▼                                                   ▼
                Model (Database)                                     View (Blade)
                      │                                                   ▲
                      └─────────────[ Data Dikembalikan ]─────────────────┘
                                              │
Browser <────────[ Respon HTML/JSON ]─────────┘
```

---

### 3. Contoh Sederhana Alur MVC di Laravel

Berikut gambaran alur kode saat pengguna membuka halaman daftar artikel:

**Langkah A: Route (`routes/web.php`)**
```php
use App\Http\Controllers\ArticleController;

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
```

**Langkah B: Controller (`app/Http/Controllers/ArticleController.php`)**
```php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        // 1. Ambil data melalui Model
        $articles = Article::where('is_published', true)->latest()->get();

        // 2. Kirim data ke View
        return view('articles.index', [
            'articles' => $articles
        ]);
    }
}
```

**Langkah C: View (`resources/views/articles/index.blade.php`)**
```html
<div class="container">
    <h1>Daftar Artikel Terbaru</h1>
    <ul>
        @foreach($articles as $article)
            <li>
                <h3>{{ $article->title }}</h3>
                <p>{{ $article->excerpt }}</p>
            </li>
        @endforeach
    </ul>
</div>
```

---

### 💡 Tips & Best Practice
> Selalu terapkan prinsip **"Fat Model, Skinny Controller"**. Artinya, letakkan logika query dan manipulasi data di dalam Model atau Service Class, sedangkan Controller tetap ringkas hanya untuk mengatur alur request dan response.

---

### 🛠️ Tantangan Mandiri
1. Jelaskan dengan kata-katamu sendiri apa keuntungan memisahkan kode tampilan (HTML) dari logika pengolahan data (PHP/SQL)!
2. Jika pengguna menekan tombol "Simpan Data", bagian MVC manakah yang bertugas memvalidasi input tersebut?
MARKDOWN
                ],
                [
                    'title'       => 'Instalasi Laravel, Composer & Struktur Folder',
                    'duration'    => 30,
                    'description' => 'Panduan langkah demi langkah menginstall Laravel terbaru menggunakan Composer, konfigurasi file .env, dan membedah struktur folder proyek.',
                    'content'     => <<<'MARKDOWN'
# Instalasi Laravel, Composer & Struktur Direktori

Pada materi kedua ini, kita akan langsung mempraktikkan proses instalasi Laravel di komputer lokal dan memahami arsitektur folder di dalam proyek Laravel.

---

### 1. Prasyarat Sistem
Sebelum menginstall Laravel, pastikan komputermu sudah memiliki:
* **PHP:** Minimal versi 8.2+ dengan ekstensi `pdo`, `mbstring`, `openssl`, `curl`.
* **Composer:** Package manager dependensi PHP resmi ([getcomposer.org](https://getcomposer.org)).
* **Database Server:** MySQL / MariaDB (misalnya via XAMPP) atau PostgreSQL / SQLite.
* **Node.js & NPM:** Digunakan untuk kompilasi asset frontend (Tailwind/Vite).

---

### 2. Membuat Proyek Laravel Baru
Buka terminal (Command Prompt, PowerShell, atau Terminal VS Code), lalu jalankan perintah Composer:

```bash
# Membuat proyek baru bernama 'my-app'
composer create-project laravel/laravel my-app

# Masuk ke direktori proyek
cd my-app

# Menjalankan server pengembangan lokal
php artisan serve
```

Setelah server aktif, buka browser dan akses URL: `http://127.0.0.1:8000`. Kamu akan melihat halaman pembuka resmi Laravel yang menawan!

---

### 3. Konfigurasi Environment (`.env`)
File `.env` di direktori *root* menyimpan pengaturan rahasia dan konfigurasi lingkungan:

```ini
APP_NAME=LearnSpace
APP_ENV=local
APP_KEY=base64:V3dsRJGpkwqlWTKRCKAIrS0furYieDkhs1Mb6McJlD8=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Konfigurasi Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_app_db
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan Keamanan:** File `.env` tidak boleh di-*commit* ke repositori Git publik seperti GitHub demi menjaga keamanan kata sandi dan kunci enkripsi aplikasi!

---

### 4. Memahami Struktur Folder Laravel
Laravel memiliki struktur direktori yang sangat rapi dan intuitif:

* `app/`: Rumah utama logika aplikasi.
  * `Http/Controllers/`: Menyimpan semua class Controller.
  * `Models/`: Menyimpan class Eloquent Model.
  * `Http/Middleware/`: Filter request (misal: otentikasi login, otorisasi role).
* `bootstrap/`: Skrip inisialisasi framework dan konfigurasi aplikasi (`app.php`).
* `config/`: Berisi semua file konfigurasi framework (database, mail, session, dll.).
* `database/`:
  * `migrations/`: Skema tabel database dalam format kode PHP.
  * `seeders/`: Pengisi data awal ke database.
* `public/`: Titik masuk utama web (`index.php`), serta aset publik seperti gambar, CSS terkompilasi, dan favicon.
* `resources/`:
  * `views/`: Template tampilan HTML/Blade.
  * `css/` & `js/`: Kode sumber frontend yang akan dikompilasi oleh Vite.
* `routes/`:
  * `web.php`: Tempat mendefinisikan rute web yang diakses pengguna via browser.
  * `api.php`: Tempat mendefinisikan rute API stateless.
* `storage/`: Tempat penyimpanan file log, sesi, dan file yang diunggah pengguna.

---

### 💡 Perintah Artisan Penting
Artisan adalah command-line interface (CLI) bawaan Laravel yang sangat mempercepat pekerjaan:

```bash
# Menampilkan daftar semua perintah artisan yang tersedia
php artisan list

# Membuat controller baru
php artisan make:controller PostController

# Membuat model beserta migration dan controller
php artisan make:model Product -mcr
```
MARKDOWN
                ],
                [
                    'title'       => 'Routing: Mengelola URL dan Parameter Aplikasi',
                    'duration'    => 35,
                    'description' => 'Mendefinisikan route HTTP, route parameters, named routes, route groups, dan route middleware.',
                    'content'     => <<<'MARKDOWN'
# Routing: Mengelola URL & Alur Permintaan di Laravel

Routing adalah gerbang utama aplikasi web. Setiap kali pengguna mengetik URL atau mengeklik tautan, **Route** bertugas mencocokkan URL tersebut dengan aksi atau Controller yang tepat.

---

### 1. Di Mana Route Ditulis?
Untuk aplikasi web biasa yang mengembalikan tampilan HTML, semua route didefinisikan di dalam file:
📂 `routes/web.php`

---

### 2. Berbagai Metode HTTP Routing
Laravel mendukung semua metode HTTP standar:

```php
use Illuminate\Support\Facades\Route;

// 1. GET: Untuk menampilkan data / halaman
Route::get('/', function () {
    return view('welcome');
});

// 2. POST: Untuk mengirimkan form / data baru
Route::post('/kontak', [ContactController::class, 'store']);

// 3. PUT / PATCH: Untuk memperbarui data yang sudah ada
Route::put('/profil', [ProfileController::class, 'update']);

// 4. DELETE: Untuk menghapus data
Route::delete('/artikel/{id}', [ArticleController::class, 'destroy']);
```

---

### 3. Route Parameter Dinamis
Seringkali kita membutuhkan URL yang memiliki parameter dinamis, misalnya ID atau slug artikel:

```php
// Menerima parameter {id}
Route::get('/artikel/{id}', function (int $id) {
    return "Sedang membaca artikel dengan ID: " . $id;
});

// Route Model Binding (Sangat Direkomendasikan!)
// Laravel otomatis mencari Model Course berdasarkan slug di database
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');
```

---

### 4. Named Routes (Penamaan Rute)
Memberikan nama pada route sangat penting agar URL aplikasi kita fleksibel dan tidak mudah rusak (*broken links*):

```php
// Definisi route dengan nama
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
```

Di dalam template Blade atau Controller, kita dapat memanggil rute ini cukup dengan namanya:

```php
// Di Controller (Redirect):
return redirect()->route('about');
```

```html
<!-- Di File Blade View: -->
<a href="{{ route('about') }}">Tentang Kami</a>
```

Keuntungan utamanya: Jika sewaktu-waktu URL `/tentang-kami` diubah menjadi `/about-us`, tautan di seluruh website akan otomatis terupdate tanpa perlu diubah manual satu per satu!

---

### 5. Route Groups & Middleware
Kita dapat mengelompokkan route yang memiliki karakteristik serupa, seperti perlindungan otentikasi atau awalan URL (*prefix*):

```php
// Semua route di dalam group ini hanya dapat diakses pengguna yang sudah login
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});
```

Hasilnya URL akan menjadi `/student/dashboard`, `/student/courses`, dan `/student/profile`, dengan nama route `student.dashboard`, `student.courses.index`, dan `student.profile.edit`.

---

### 🛠️ Latihan Mandiri
1. Buat sebuah route GET dengan URL `/salam/{nama}` yang mengembalikan teks salam ramah, contoh: `"Halo, Bagas! Selamat belajar Laravel!"`
2. Tambahkan validasi ekspresi reguler (*where constraint*) pada parameter agar `{nama}` hanya boleh berisi huruf alfabet.
MARKDOWN
                ],
                [
                    'title'       => 'Controller: Memisahkan Logika Bisnis Aplikasi',
                    'duration'    => 35,
                    'description' => 'Membuat controller, resource controller, request lifecycle, dan dependency injection pada controller.',
                    'content'     => <<<'MARKDOWN'
# Controller: Memisahkan Logika Bisnis Aplikasi

Alih-alih menuliskan semua logika aplikasi langsung di file `routes/web.php`, kita memindahkannya ke dalam **Controller**. Ini membuat kode terstruktur, modular, dan mudah diuji (*testable*).

---

### 1. Membuat Controller dengan Artisan
Gunakan perintah Artisan di terminal:

```bash
# Membuat controller kosong
php artisan make:controller CourseController

# Membuat Resource Controller (lengkap dengan 7 fungsi CRUD standar)
php artisan make:controller ProductController --resource
```

---

### 2. Anatomi Resource Controller
Resource controller menyediakan method standar untuk operasi CRUD:

| HTTP Verb | URI Path | Controller Action | Kegunaan |
|---|---|---|---|
| GET | `/courses` | `index()` | Menampilkan daftar semua kursus |
| GET | `/courses/create` | `create()` | Menampilkan formulir tambah kursus |
| POST | `/courses` | `store()` | Menyimpan data kursus baru ke database |
| GET | `/courses/{id}` | `show()` | Menampilkan detail satu kursus |
| GET | `/courses/{id}/edit` | `edit()` | Menampilkan formulir edit kursus |
| PUT/PATCH | `/courses/{id}` | `update()` | Memperbarui data kursus di database |
| DELETE | `/courses/{id}` | `destroy()` | Menghapus kursus dari database |

---

### 3. Contoh Implementasi Lengkap

```php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->where('status', 'published')->paginate(10);
        return view('courses.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|min:5|max:255',
            'description' => 'required',
            'level'       => 'required|in:beginner,intermediate,advanced',
        ]);

        $course = Course::create($validated);

        return redirect()->route('courses.show', $course->slug)
            ->with('success', 'Kursus berhasil ditambahkan!');
    }
}
```
MARKDOWN
                ],
                [
                    'title'       => 'Blade Templating: Membuat Tampilan Dinamis',
                    'duration'    => 40,
                    'description' => 'Menguasai Blade template engine, layout inheritance, component, directive (@if, @foreach, @auth).',
                    'content'     => <<<'MARKDOWN'
# Blade Templating: Membuat Tampilan Dinamis

**Blade** adalah template engine bawaan Laravel yang sangat cepat dan fleksibel. Kode Blade dikompilasi menjadi PHP murni dan di-cache hingga terjadi perubahan file.

---

### 1. Sintaks Dasar Blade
Blade memudahkan pencetakan data ke HTML tanpa perlu mengetik `<?php echo ... ?>`:

```blade
{{-- Menampilkan variabel dengan proteksi otomatis XSS htmlspecialchars --}}
<h1>Halo, {{ $userName }}!</h1>

{{-- Menampilkan tag HTML mentah (gunakan hati-hati!) --}}
<div>{!! $rawHtmlContent !!}</div>
```

---

### 2. Directives Kondisional & Perulangan

```blade
{{-- Percabangan IF --}}
@if($course->isFreePreview())
    <span class="badge-free">Materi Gratis</span>
@else
    <span class="badge-locked">Materi Terkunci</span>
@endif

{{-- Cek Otentikasi Pengguna --}}
@auth
    <p>Selamat datang kembali, {{ auth()->user()->name }}!</p>
@else
    <a href="{{ route('login') }}">Silakan Masuk</a>
@endauth

{{-- Perulangan FOREACH --}}
<div class="grid">
    @forelse($lessons as $lesson)
        <div class="card">
            <h4>{{ $lesson->order }}. {{ $lesson->title }}</h4>
            <p>{{ $lesson->duration }} menit</p>
        </div>
    @empty
        <p>Belum ada materi pembelajaran yang tersedia.</p>
    @endforelse
</div>
```
MARKDOWN
                ],
                [
                    'title'       => 'Eloquent ORM & Migrations: Interaksi Database Modern',
                    'duration'    => 45,
                    'description' => 'Membuat migrasi tabel, mendefinisikan Eloquent Model, Mass Assignment, dan operasi CRUD database modern.',
                    'content'     => <<<'MARKDOWN'
# Eloquent ORM & Migrations: Interaksi Database Modern

**Eloquent** adalah Object-Relational Mapper (ORM) bawaan Laravel yang mengubah baris tabel database menjadi objek PHP yang mudah dimanipulasi.

---

### 1. Membuat Migration
Migration adalah sistem kontrol versi (*version control*) untuk database:

```bash
php artisan make:migration create_lessons_table
```

File migrasi yang dihasilkan:
```php
public function up(): void
{
    Schema::create('lessons', function (Blueprint $table) {
        $table->id();
        $table->foreignId('course_id')->constrained()->cascadeOnDelete();
        $table->string('title');
        $table->text('description')->nullable();
        $table->longText('content')->nullable();
        $table->integer('order')->default(1);
        $table->integer('duration')->nullable();
        $table->timestamps();
    });
}
```

Jalankan migrasi ke database:
```bash
php artisan migrate
```

---

### 2. Menggunakan Eloquent Model
```php
// Mengambil semua data
$allCourses = Course::all();

// Mencari berdasarkan ID
$course = Course::findOrFail(1);

// Menambahkan data baru
$newLesson = Lesson::create([
    'course_id' => $course->id,
    'title'     => 'Dasar Pemrograman Web',
    'duration'  => 30,
]);

// Memperbarui data
$course->update(['status' => 'published']);

// Menghapus data
$course->delete();
```
MARKDOWN
                ],
            ],

            // =========================================================================
            // KURSUS 2: JAVASCRIPT MODERN: ES6+ & ASYNCHRONOUS PROGRAMMING
            // =========================================================================
            'javascript-modern-es6-dan-asynchronous-programming' => [
                [
                    'title'       => 'Variabel Modern: Let, Const, vs Var & Block Scope',
                    'duration'    => 20,
                    'description' => 'Perbedaan fundamental deklarasi variabel let, const, dan var, memahami konsep block scope, temporal dead zone, dan hoisting.',
                    'content'     => <<<'MARKDOWN'
# Variabel Modern: Let, Const, vs Var & Block Scope

Sebelum standar **ECMAScript 2015 (ES6)** diluncurkan, pengembang JavaScript hanya memiliki satu cara untuk mendeklarasikan variabel: kata kunci `var`. Namun, `var` sering kali menimbulkan bug yang membingungkan akibat perilakunya yang tidak mematuhi *block scope*.

---

### 1. Tiga Kata Kunci Variabel

| Fitur | `var` | `let` | `const` |
|---|---|---|---|
| **Scope** | Function / Global | Block (`{ ... }`) | Block (`{ ... }`) |
| **Bisa Dideklarasikan Ulang?** | Ya | Tidak | Tidak |
| **Bisa Di-*reassign* (ubah nilai)?** | Ya | Ya | Tidak |
| **Hoisting** | Ter-hoist (nilai `undefined`) | Temporal Dead Zone | Temporal Dead Zone |

---

### 2. Memahami Block Scope
Block scope berarti variabel hanya hidup di dalam sepasang kurung kurawal `{ ... }` tempat ia dibuat (misal di dalam blok `if`, `for`, atau `while`).

```javascript
function contohScope() {
    if (true) {
        var x = 10;     // var tidak mematuhi block scope!
        let y = 20;     // let mematuhi block scope
        const z = 30;   // const mematuhi block scope
    }

    console.log(x); // Output: 10 (bocor keluar blok!)
    // console.log(y); // ReferenceError: y is not defined
    // console.log(z); // ReferenceError: z is not defined
}
```

---

### 3. Kapan Menggunakan `const` vs `let`?
Aturan praktis (*Rule of Thumb*) industri modern:
1. **Gunakan `const` secara *default*** untuk setiap variabel. Ini mencegah variabel diubah secara tidak sengaja dan membuat kode lebih aman diprediksi.
2. **Gunakan `let` hanya jika** kamu tahu pasti nilai variabel tersebut akan berubah nanti (misalnya variabel counter perulangan `for (let i = 0; i < n; i++)`).
3. **Hindari `var`** dalam kode JavaScript modern!

```javascript
// Penggunaan const pada Array & Objek
const user = {
    name: 'Bagas Syahputra',
    role: 'Frontend Developer'
};

// KITA BISA memodifikasi properti di dalamnya:
user.role = 'Fullstack Engineer'; // Valid!

// TETAPI KITA TIDAK BISA menimpa objeknya secara keseluruhan:
// user = { name: 'Lain' }; // TypeError: Assignment to constant variable.
```

---

### 🛠️ Latihan Mandiri
Ubah potongan kode berikut agar menggunakan praktik ES6 yang bersih dan aman:
```javascript
var diskon = 0.1;
var totalBelanja = 150000;
if (totalBelanja > 100000) {
    var bayar = totalBelanja - (totalBelanja * diskon);
    console.log("Total yang harus dibayar: " + bayar);
}
```
MARKDOWN
                ],
                [
                    'title'       => 'Arrow Functions & Template Literals',
                    'duration'    => 25,
                    'description' => 'Sintaks ringkas arrow functions, lexical this binding, dan keunggulan template literals dengan ekspresi interpolasi string.',
                    'content'     => <<<'MARKDOWN'
# Arrow Functions & Template Literals

Dua fitur ES6 yang paling sering digunakan setiap hari dalam penulisan kode JavaScript modern adalah **Arrow Function** dan **Template Literals**. Keduanya membuat kode jauh lebih ringkas, mudah dibaca, dan bebas dari boilerplate.

---

### 1. Arrow Functions (`=>`)
Arrow function adalah cara baru menulis fungsi dengan sintaks panah yang sangat hemat tempat:

```javascript
// Cara Lama (Regular Function)
function hitungLuasPersegi(sisi) {
    return sisi * sisi;
}

// Cara Baru (Arrow Function Lengkap)
const hitungLuas = (sisi) => {
    return sisi * sisi;
};

// Cara Ringkas (Implicit Return untuk 1 Baris Pernyataan)
const hitungLuasSingkat = sisi => sisi * sisi;

console.log(hitungLuasSingkat(8)); // Output: 64
```

#### Lexical `this` Binding
Keunggulan terbesar Arrow Function bukan hanya sintaksnya, melainkan bagaimana ia menangani kata kunci `this`. Arrow function tidak memiliki `this` sendiri, melainkan mewarisi `this` dari lingkungan leksikal di luarnya (*lexical scope*):

```javascript
const timer = {
    detik: 0,
    mulai() {
        // Arrow function mewarisi `this` dari method mulai() (yaitu objek timer)
        setInterval(() => {
            this.detik++;
            console.log(`Detik ke: ${this.detik}`);
        }, 1000);
    }
};
```

---

### 2. Template Literals (Backtick `` ` ``)
Template literals menggunakan karakter backtick (`` ` ``) alih-alih tanda kutip tunggal (`'`) atau ganda (`"`).

Fitur unggulan:
1. **Interpolasi String:** Sisipkan variabel atau ekspresi JavaScript langsung ke dalam string dengan format `${ekspresi}`.
2. **Multi-line String:** Tulis teks multi-baris tanpa perlu menyambung string dengan tanda `+ \n`.

```javascript
const produk = 'MacBook Air M2';
const harga = 16000000;
const diskonPersen = 10;

// Menghitung harga diskon langsung di dalam template literal
const pesan = `
Detail Pembelian:
- Produk : ${produk.toUpperCase()}
- Harga Asli : Rp ${harga.toLocaleString('id-ID')}
- Total Bayar : Rp ${(harga * (100 - diskonPersen) / 100).toLocaleString('id-ID')}
`;

console.log(pesan);
```
MARKDOWN
                ],
                [
                    'title'       => 'Destructuring, Spread & Rest Operator',
                    'duration'    => 30,
                    'description' => 'Teknik mengekstrak nilai dari array dan object dengan destructuring serta manipulasi struktur data menggunakan spread/rest operator (...).',
                    'content'     => <<<'MARKDOWN'
# Destructuring, Spread & Rest Operator

ES6 memperkenalkan cara yang sangat elegan untuk mengekstrak data dari array/objek (**Destructuring**) serta menyalin atau menggabungkan koleksi data (**Spread & Rest Operator**).

---

### 1. Object Destructuring
Mengekstrak properti objek langsung ke dalam variabel independen:

```javascript
const course = {
    title: 'Belajar JavaScript Modern',
    instructor: 'Bagas Syahputra',
    level: 'Intermediate',
    price: 0
};

// Cara lama:
// const title = course.title;
// const instructor = course.instructor;

// Cara ES6 Destructuring:
const { title, instructor, level, isFree = true } = course;

console.log(title);      // 'Belajar JavaScript Modern'
console.log(instructor); // 'Bagas Syahputra'
console.log(isFree);     // true (menggunakan default value)
```

---

### 2. Array Destructuring
Mengekstrak elemen array berdasarkan urutan indeksnya:

```javascript
const koordinat = [-6.2088, 106.8456];

// Destructuring posisi 0 ke lat, posisi 1 ke lng
const [latitude, longitude] = koordinat;

console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
```

---

### 3. Spread Operator (`...`)
Operator spread (`...`) digunakan untuk **membongkar atau menyebarkan** elemen dari array atau properti dari objek:

```javascript
// 1. Menggabungkan Array
const frontend = ['HTML', 'CSS', 'JavaScript'];
const backend = ['PHP', 'Laravel', 'MySQL'];
const fullstack = [...frontend, ...backend, 'DevOps'];
console.log(fullstack); // ['HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'MySQL', 'DevOps']

// 2. Kloning & Memperbarui Objek Secara Immutabel
const user = { name: 'Alex', age: 24 };
const updatedUser = {
    ...user,
    age: 25,
    city: 'Jakarta'
};
```

---

### 4. Rest Parameter (`...`)
Ketika operator `...` diletakkan di parameter fungsi, fungsinya berubah menjadi **Rest Parameter** yang mengumpulkan banyak argumen menjadi satu array tunggal:

```javascript
const hitungTotal = (...angka) => {
    return angka.reduce((total, nilai) => total + nilai, 0);
};

console.log(hitungTotal(10, 20, 30, 40)); // Output: 100
```
MARKDOWN
                ],
                [
                    'title'       => 'Promises: Menangani Operasi Asynchronous',
                    'duration'    => 40,
                    'description' => 'Memahami konsep asynchronous, event loop, Promise states (pending, fulfilled, rejected), promise chaining, dan error handling.',
                    'content'     => <<<'MARKDOWN'
# Promises: Mengelola Operasi Asynchronous di JavaScript

JavaScript adalah bahasa yang berjalan di satu thread (*single-threaded*). Agar operasi berat seperti mengambil data dari server tidak membekukan (*freeze*) tampilan browser, JavaScript menggunakan mekanisme **Asynchronous**.

---

### 1. Tiga State dalam Promise
Promise adalah objek yang mewakili penyelesaian atau kegagalan sebuah operasi asinkron di masa depan:
* **Pending:** Operasi sedang berjalan (belum selesai).
* **Fulfilled (Resolved):** Operasi berhasil diselesaikan dengan nilai hasil.
* **Rejected:** Operasi gagal dan mengembalikan alasan kesalahan (*error*).

```javascript
const cekKoneksiDatabase = () => {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            const serverOnline = true;
            if (serverOnline) {
                resolve('Koneksi berhasil terhubung!');
            } else {
                reject(new Error('Koneksi gagal: Server timeout.'));
            }
        }, 1500);
    });
};

// Mengonsumsi Promise dengan .then() dan .catch()
cekKoneksiDatabase()
    .then(pesanSukses => {
        console.log('Sukses: ' + pesanSukses);
    })
    .catch(error => {
        console.error('Error: ' + error.message);
    });
```
MARKDOWN
                ],
                [
                    'title'       => 'Async / Await: Sintaks Asynchronous yang Bersih',
                    'duration'    => 35,
                    'description' => 'Menulis kode asynchronous dengan gaya synchronous yang bersih, mudah didebug, dan penanganan error menggunakan try-catch.',
                    'content'     => <<<'MARKDOWN'
# Async / Await: Sintaks Asynchronous yang Bersih

Sintaks `async` dan `await` (diperkenalkan pada ES2017) adalah *syntactic sugar* di atas Promise yang membuat kode asinkron terlihat dan terbaca seperti kode sinkron berurutan.

---

### Contoh Perbandingan
```javascript
// Menggunakan Async / Await & Try / Catch
async function ambilDataPengguna(userId) {
    try {
        console.log('Memulai pengambilan data...');
        const response = await fetch(`https://jsonplaceholder.typicode.com/users/${userId}`);
        
        if (!response.ok) {
            throw new Error(`Gagal mengambil data: HTTP status ${response.status}`);
        }

        const data = await response.json();
        console.log(`Nama Pengguna: ${data.name}`);
        console.log(`Email: ${data.email}`);
        return data;
    } catch (error) {
        console.error('Terjadi kesalahan:', error.message);
    } finally {
        console.log('Proses selesai.');
    }
}

ambilDataPengguna(1);
```
MARKDOWN
                ],
            ],

            // =========================================================================
            // KURSUS 3: HTML & CSS: MEMBANGUN WEBSITE YANG INDAH
            // =========================================================================
            'html-css-membangun-website-yang-indah' => [
                [
                    'title'       => 'Pengenalan HTML5 Modern & Elemen Semantik',
                    'duration'    => 25,
                    'description' => 'Memahami anatomi dokumen HTML5, struktur tag semantik (<header>, <nav>, <main>, <article>, <section>, <footer>), dan aksesibilitas web.',
                    'content'     => <<<'MARKDOWN'
# Pengenalan HTML5 Modern & Elemen Semantik

HTML (*HyperText Markup Language*) adalah bahasa markah standar yang bertindak sebagai **tulang punggung dan kerangka** dari setiap halaman web yang ada di dunia.

---

### 1. Struktur Dasar Dokumen HTML5
Setiap file HTML harus diawali dengan deklarasi doctype standar:

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Portofolio Saya</title>
</head>
<body>
    <h1>Selamat Datang di Dunia Web Development!</h1>
    <p>Ini adalah halaman web pertama yang dibangun dengan standar HTML5.</p>
</body>
</html>
```

---

### 2. Mengapa Elemen Semantik Sangat Penting?
Sebelum HTML5, programmer sering kali membuat seluruh tata letak hanya menggunakan tag `<div class="header">`, `<div class="footer">`. Cara ini tidak memberikan arti apapun bagi mesin pencari (*Search Engine*) maupun perangkat pembaca layar bagi penyandang disabilitas (*Screen Reader*).

HTML5 menghadirkan elemen **semantik** yang memiliki arti jelas:

* `<header>`: Menampung logo, judul situs, atau navigasi pembuka.
* `<nav>`: Kumpulan tautan menu navigasi utama.
* `<main>`: Konten utama unik dari halaman tersebut (hanya boleh 1 per halaman).
* `<section>`: Pembagian tema atau bagian spesifik (misal: "Tentang Kami", "Testimoni").
* `<article>`: Bagian konten independen yang dapat didistribusikan mandiri (misal: postingan blog, berita).
* `<aside>`: Konten sampingan seperti sidebar, daftar kategori, atau iklan relevan.
* `<footer>`: Bagian penutup halaman berisi hak cipta, kontak, atau tautan legalitas.

```
┌──────────────────────────────────────────────┐
│                  <header>                    │
│      [Logo]               <nav>              │
├──────────────────────────────────────────────┤
│                   <main>                     │
│  ┌──────────────────────────────┐ ┌────────┐ │
│  │          <article>           │ │<aside> │ │
│  │   <h1>Judul Artikel</h1>     │ │Sidebar │ │
│  │   <p>Konten artikel...</p>   │ │Links   │ │
│  └──────────────────────────────┘ └────────┘ │
├──────────────────────────────────────────────┤
│                  <footer>                    │
│        © 2026 LearnSpace Indonesia           │
└──────────────────────────────────────────────┘
```

---

### 💡 Tips SEO (Search Engine Optimization)
> Gunakan hanya **satu tag `<h1>`** per halaman sebagai penanda topik utama. Untuk subtopik di bawahnya, gunakan hierarki berurutan: `<h2>`, `<h3>`, `<h4>`. Jangan melompati urutan heading (misal dari `<h1>` langsung ke `<h4>`).
MARKDOWN
                ],
                [
                    'title'       => 'Dasar CSS: Selector, Spesifisitas & The Box Model',
                    'duration'    => 30,
                    'description' => 'Memahami CSS selector, cascade, aturan spesifisitas, dan anatomi Box Model (Content, Padding, Border, Margin).',
                    'content'     => <<<'MARKDOWN'
# Dasar CSS: Selector, Spesifisitas & The Box Model

Jika HTML adalah kerangka tulang bangunan, maka **CSS (Cascading Style Sheets)** adalah cat dinding, desain interior, dan tata letak estetikanya.

---

### 1. Anatomi Peraturan CSS
Sebuah aturan CSS terdiri dari **Selector** dan **Declaration Block**:

```css
/* Selector: Elemen mana yang ingin kita beri gaya */
h1 {
    color: #4f46e5;          /* Property : Value; */
    font-size: 2.25rem;
    font-weight: 800;
    line-height: 1.2;
}
```

---

### 2. Konsep Penting: The Box Model
Di browser, **setiap elemen HTML dianggap sebagai sebuah kotak persegi panjang**. Box Model terdiri dari 4 lapisan berurutan dari dalam ke luar:

1. **Content:** Area teks, gambar, atau elemen anak yang sebenarnya.
2. **Padding:** Ruang kosong transparan di antara konten dan batas garis tepi (border).
3. **Border:** Garis tepi yang membungkus padding dan konten.
4. **Margin:** Ruang kosong transparan di luar border yang memisahkan elemen ini dari elemen tetangganya.

```
┌─────────────────────────────────────────────┐
│                   MARGIN                    │
│   ┌─────────────────────────────────────┐   │
│   │               BORDER                │   │
│   │   ┌─────────────────────────────┐   │   │
│   │   │           PADDING           │   │   │
│   │   │   ┌─────────────────────┐   │   │   │
│   │   │   │       CONTENT       │   │   │   │
│   │   │   └─────────────────────┘   │   │   │
│   │   └─────────────────────────────┘   │   │
│   └─────────────────────────────────────┘   │
└─────────────────────────────────────────────┘
```

#### Aturan Wajib Modern: `box-sizing: border-box`
Secara default browser menghitung `width` hanya untuk Content, sehingga menambah padding akan membuat kotak melebar melebihi ukuran yang ditentukan. Gunakan aturan universal ini di awal file CSS:

```css
*, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
```
Dengan `border-box`, jika kamu menentukan `width: 300px`, maka padding dan border akan dihitung di dalam ukuran 300px tersebut!
MARKDOWN
                ],
                [
                    'title'       => 'CSS Flexbox: Menguasai Tata Letak 1 Dimensi Modern',
                    'duration'    => 35,
                    'description' => 'Membangun layout dinamis dengan Flexbox: flex-direction, justify-content, align-items, flex-wrap, dan flex-grow.',
                    'content'     => <<<'MARKDOWN'
# CSS Flexbox: Menguasai Tata Letak 1 Dimensi Modern

**Flexbox (Flexible Box Layout)** adalah modul tata letak CSS yang dirancang untuk mendistribusikan ruang dan meratakan elemen di dalam kontainer, bahkan saat ukurannya tidak diketahui atau dinamis.

---

### 1. Mengaktifkan Flexbox
Cukup tambahkan properti `display: flex;` pada elemen induk (*flex container*):

```html
<div class="navbar">
    <div class="logo">LearnSpace</div>
    <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">Kursus</a></li>
        <li><a href="#">Tentang</a></li>
    </ul>
    <button class="btn-login">Masuk</button>
</div>
```

```css
.navbar {
    display: flex;
    justify-content: space-between; /* Mendistribusikan item ke kiri, tengah, kanan */
    align-items: center;            /* Meratakan vertikal persis di tengah */
    padding: 1rem 2rem;
    background-color: #ffffff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.nav-links {
    display: flex;
    gap: 1.5rem; /* Jarak antar menu */
    list-style: none;
}
```

---

### 2. Properti Kunci Flexbox Container
* **`flex-direction`:** Mengatur arah sumbu utama (`row` mendatar, `column` menurun).
* **`justify-content`:** Meratakan elemen di sumbu utama:
  * `flex-start` (awal)
  * `center` (tengah)
  * `flex-end` (akhir)
  * `space-between` (ruang terbagi rata di antara elemen)
  * `space-around` / `space-evenly` (ruang terbagi rata di sekeliling elemen)
* **`align-items`:** Meratakan elemen di sumbu silang (`center`, `stretch`, `flex-start`, `flex-end`).
* **`flex-wrap`:** Mengizinkan item melompat ke baris baru (`wrap`) jika layar terlalu sempit.
MARKDOWN
                ],
                [
                    'title'       => 'CSS Grid System: Menguasai Layout Dua Dimensi',
                    'duration'    => 40,
                    'description' => 'Membuat tata letak kompleks berbasis baris dan kolom dengan CSS Grid: grid-template-columns, gap, repeat(), dan minmax().',
                    'content'     => <<<'MARKDOWN'
# CSS Grid System: Menguasai Layout Dua Dimensi

Jika Flexbox ideal untuk 1 dimensi (hanya baris ATAU hanya kolom), maka **CSS Grid** adalah sistem tata letak paling *powerful* untuk mengelola 2 dimensi (baris DAN kolom sekaligus).

---

### Contoh Grid Responsif Otomatis Tanpa Media Query
```css
.card-grid {
    display: grid;
    /* Grid otomatis menyesuaikan kolom dengan lebar minimal 280px */
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    padding: 2rem;
}

.card {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}
```
MARKDOWN
                ],
            ],

            // =========================================================================
            // KURSUS 4: PYTHON UNTUK PEMROGRAMAN & DATA SCIENCE
            // =========================================================================
            'python-untuk-data-science-pandas-dan-matplotlib' => [
                [
                    'title'       => 'Pengenalan Python, Variabel & Tipe Data Dasar',
                    'duration'    => 25,
                    'description' => 'Memulai coding dengan Python, ekosistem interpreter, aturan sintaksis, variabel, dan tipe data primitif (str, int, float, bool).',
                    'content'     => <<<'MARKDOWN'
# Pengenalan Python, Variabel & Tipe Data Dasar

**Python** adalah bahasa pemrograman tingkat tinggi yang sangat populer karena sintaksnya yang bersih, ringkas, dan mirip dengan kalimat bahasa Inggris sehari-hari. Python menjadi pilihan nomor 1 di dunia untuk bidang **Data Science, Artificial Intelligence (AI), Machine Learning, serta Otomasi Scripting**.

---

### 1. Program Pertama: Hello World
Menulis kode di Python tidak membutuhkan tanda titik koma (`;`) atau fungsi `main()` yang rumit:

```python
# Program Python pertamaku
print("Halo Indonesia! Selamat datang di dunia coding Python.")
```

---

### 2. Variabel & Tipe Data Primitif
Python menggunakan *dynamic typing*, artinya tipe data variabel dideteksi secara otomatis saat runtime tanpa perlu deklarasi manual:

```python
# String (Teks)
nama_kursus = "Python Data Science"

# Integer (Bilangan Bulat)
total_siswa = 1250

# Float (Bilangan Desimal)
rating_kursus = 4.95

# Boolean (Nilai Kebenaran: True atau False)
is_aktif = True

# Menampilkan informasi dengan f-string (Formatted String Literal)
print(f"Kursus: {nama_kursus}")
print(f"Total Siswa: {total_siswa} orang | Rating: {rating_kursus}/5.0")
```

---

### 3. Menerima Input dari Pengguna
Fungsi `input()` digunakan untuk menerima masukan teks dari pengguna via terminal:

```python
nama = input("Masukkan nama Anda: ")
usia = int(input("Masukkan usia Anda: ")) # Konversi string ke integer dengan int()

tahun_lahir = 2026 - usia
print(f"Halo {nama}, Anda lahir sekitar tahun {tahun_lahir}.")
```
MARKDOWN
                ],
                [
                    'title'       => 'Logika Percabangan (If, Elif, Else) & Operator',
                    'duration'    => 30,
                    'description' => 'Mengontrol alur logika program dengan pernyataan kondisional if-elif-else, operator perbandingan, dan operator logika and/or/not.',
                    'content'     => <<<'MARKDOWN'
# Logika Percabangan (If, Elif, Else) & Operator Logika

Dalam membuat program komputer, komputer harus mampu membuat keputusan berdasarkan kondisi tertentu. Di Python, hal ini dikelola oleh pernyataan **`if`**, **`elif`** (*else if*), dan **`else`**.

---

### 1. Perhatikan Indentasi!
> **Penting di Python:** Python menggunakan **spasi indentasi (biasanya 4 spasi)** untuk menandai blok kode, bukan kurung kurawal `{}`! Jika indentasi salah, Python akan memunculkan `IndentationError`.

---

### 2. Contoh Pengambilan Keputusan Nilai Ujian

```python
nilai_akhir = 85

if nilai_akhir >= 85:
    predikat = "A (Sangat Memuaskan)"
    status = "LULUS DENGAN PUJIAN"
elif nilai_akhir >= 75:
    predikat = "B (Baik)"
    status = "LULUS"
elif nilai_akhir >= 60:
    predikat = "C (Cukup)"
    status = "LULUS"
else:
    predikat = "D / E (Kurang)"
    status = "REMIDIAL"

print(f"Predikat: {predikat}")
print(f"Status Kelulusan: {status}")
```

---

### 3. Operator Logika (`and`, `or`, `not`)
```python
umur = 20
punya_sim = True

# Keduanya harus bernilai True
if umur >= 17 and punya_sim:
    print("Boleh mengemudikan kendaraan bermotor.")
else:
    print("Belum diizinkan mengemudi.")
```
MARKDOWN
                ],
                [
                    'title'       => 'Perulangan (For & While Loops) di Python',
                    'duration'    => 30,
                    'description' => 'Melakukan iterasi data dengan for loops, fungsi range(), while loops, dan kontrol break/continue.',
                    'content'     => <<<'MARKDOWN'
# Perulangan (For & While Loops) di Python

Perulangan memungkinkan kita mengeksekusi satu blok kode berkali-kali secara otomatis tanpa perlu menulis ulang baris perintah.

---

### 1. Perulangan `for` dengan `range()`
Fungsi `range(start, stop, step)` menghasilkan deret angka:

```python
# Mencetak angka 1 sampai 5
for i in range(1, 6):
    print(f"Perulangan ke-{i}")

# Perulangan pada kumpulan data List
bahasa_coding = ["Python", "JavaScript", "PHP", "Go", "Rust"]
for bahasa in bahasa_coding:
    print(f"Saya sedang mempelajari: {bahasa}")
```

---

### 2. Perulangan `while`
Perulangan `while` berjalan selama kondisi logikanya bernilai `True`:

```python
hitungan_mundur = 5

while hitungan_mundur > 0:
    print(f"Roket meluncur dalam {hitungan_mundur}...")
    hitungan_mundur -= 1

print("🚀 Meluncur!")
```
MARKDOWN
                ],
                [
                    'title'       => 'Struktur Data Python: List, Tuple, & Dictionary',
                    'duration'    => 35,
                    'description' => 'Mengelola kumpulan data kompleks menggunakan List (mutable), Tuple (immutable), dan Dictionary (key-value pair).',
                    'content'     => <<<'MARKDOWN'
# Struktur Data Python: List, Tuple, & Dictionary

Dalam analisis data dan pengembangan perangkat lunak, kita membutuhkan wadah untuk menyimpan kumpulan informasi terstruktur.

---

### 1. List (Daftar Terurut & Bisa Diubah)
```python
siswa = ["Ahmad", "Siti", "Budi", "Dewi"]

# Menambah elemen
siswa.append("Reza")

# Mengakses indeks (dimulai dari 0)
print(siswa[0]) # Ahmad
print(len(siswa)) # 5
```

---

### 2. Dictionary (Pasangan Kunci & Nilai)
```python
kursus = {
    "judul": "Python untuk Data Science",
    "kategori": "Data Science",
    "durasi_menit": 420,
    "topik": ["Pandas", "NumPy", "Matplotlib"]
}

print(kursus["judul"])
print(f"Jumlah topik: {len(kursus['topik'])}")
```
MARKDOWN
                ],
            ],

            // =========================================================================
            // KURSUS 5: REACT NATIVE: APLIKASI MOBILE CROSS-PLATFORM
            // =========================================================================
            'react-native-bangun-aplikasi-mobile-cross-platform' => [
                [
                    'title'       => 'Pengenalan React Native & Arsitektur Mobile',
                    'duration'    => 25,
                    'description' => 'Memahami konsep pengembangan aplikasi mobile cross-platform, React Native vs Native murni, dan setup environment.',
                    'content'     => <<<'MARKDOWN'
# Pengenalan React Native & Arsitektur Mobile Cross-Platform

**React Native** adalah framework buatan Meta (Facebook) yang memungkinkan developer membangun aplikasi mobile native untuk **Android dan iOS sekaligus** menggunakan satu basis kode (*single codebase*) berbasis JavaScript dan React.

---

### 1. Mengapa Menggunakan React Native?
* **Learn Once, Write Anywhere:** Pengetahuan React di web dapat langsung diterapkan di mobile.
* **Performa Native:** Berbeda dengan WebView biasa (hybrid), komponen React Native diterjemahkan menjadi widget native asli (seperti `UIView` di iOS dan `android.view` di Android).
* **Hot Reloading:** Mengubah kode langsung terlihat di emulator tanpa perlu kompilasi ulang yang memakan waktu.

---

### 2. Komponen Inti React Native
React Native tidak menggunakan tag HTML (`<div>`, `<span>`, `<p>`), melainkan komponen khusus mobile:

| Komponen React Native | Padanan di Web (HTML) | Keterangan |
|---|---|---|
| `<View>` | `<div>` | Kontainer penampung tata letak flexbox |
| `<Text>` | `<p>`, `<span>`, `<h1>` | Menampilkan semua teks (wajib di dalam `<Text>`) |
| `<Image>` | `<img>` | Menampilkan gambar lokal atau remote URL |
| `<ScrollView>` | `<div>` dengan `overflow: scroll` | Kontainer yang dapat digulir |
| `<TouchableOpacity>` | `<button>` | Elemen sentuh dengan efek transparansi saat ditekan |
MARKDOWN
                ],
                [
                    'title'       => 'Komponen Inti (View, Text, Image) & Styling Mobile',
                    'duration'    => 30,
                    'description' => 'Membangun antarmuka mobile pertama menggunakan View, Text, Image, dan StyleSheet dengan sistem Flexbox mobile.',
                    'content'     => <<<'MARKDOWN'
# Komponen Inti & Styling dengan StyleSheet

Di React Native, styling ditulis menggunakan objek JavaScript melalui API `StyleSheet.create()`. Properti CSS ditulis dalam format *camelCase* (misal: `backgroundColor`, `fontSize`, `borderRadius`).

---

### Contoh Komponen Kartu Profil Mobile
```javascript
import React from 'react';
import { View, Text, Image, StyleSheet, TouchableOpacity } from 'react-native';

export default function ProfileCard() {
    return (
        <View style={styles.cardContainer}>
            <Image 
                source={{ uri: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb' }} 
                style={styles.avatar} 
            />
            <View style={styles.infoContainer}>
                <Text style={styles.name}>Bagas Syahputra</Text>
                <Text style={styles.role}>Mobile Developer</Text>
            </View>
            <TouchableOpacity style={styles.btnFollow} onPress={() => alert('Berhasil Mengikuti!')}>
                <Text style={styles.btnText}>Ikuti</Text>
            </TouchableOpacity>
        </View>
    );
}

const styles = StyleSheet.create({
    cardContainer: {
        flexDirection: 'row',
        alignItems: 'center',
        padding: 16,
        backgroundColor: '#ffffff',
        borderRadius: 16,
        marginHorizontal: 16,
        marginVertical: 8,
        elevation: 3, // Shadow di Android
        shadowColor: '#000', // Shadow di iOS
        shadowOffset: { width: 0, height: 2 },
        shadowOpacity: 0.1,
        shadowRadius: 6,
    },
    avatar: {
        width: 60,
        height: 60,
        borderRadius: 30,
    },
    infoContainer: {
        flex: 1,
        marginLeft: 14,
    },
    name: {
        fontSize: 16,
        fontWeight: 'bold',
        color: '#1e293b',
    },
    role: {
        fontSize: 13,
        color: '#64748b',
        marginTop: 2,
    },
    btnFollow: {
        backgroundColor: '#4f46e5',
        paddingHorizontal: 16,
        paddingVertical: 8,
        borderRadius: 10,
    },
    btnText: {
        color: '#ffffff',
        fontSize: 12,
        fontWeight: '600',
    },
});
```
MARKDOWN
                ],
                [
                    'title'       => 'State & Props: Interaktivitas dengan Hook useState',
                    'duration'    => 35,
                    'description' => 'Mengelola data internal yang berubah dengan hook useState, passing data antar komponen dengan props, dan event handling mobile.',
                    'content'     => <<<'MARKDOWN'
# State & Props: Interaktivitas dengan Hook useState

Aplikasi mobile menjadi hidup ketika antarmuka dapat merespons tindakan jari pengguna (tap, swipe, input text). Hal ini dimungkinkan melalui konsep **State**.

---

### Contoh Aplikasi Penghitung Interaktif (Counter App)
```javascript
import React, { useState } from 'react';
import { View, Text, TouchableOpacity, StyleSheet } from 'react-native';

export default function CounterApp() {
    const [counter, setCounter] = useState(0);

    return (
        <View style={styles.container}>
            <Text style={styles.label}>Nilai Penghitung:</Text>
            <Text style={styles.value}>{counter}</Text>

            <View style={styles.buttonRow}>
                <TouchableOpacity 
                    style={[styles.button, styles.btnMinus]} 
                    onPress={() => setCounter(counter - 1)}
                >
                    <Text style={styles.btnText}>- Kurang</Text>
                </TouchableOpacity>

                <TouchableOpacity 
                    style={[styles.button, styles.btnPlus]} 
                    onPress={() => setCounter(counter + 1)}
                >
                    <Text style={styles.btnText}>+ Tambah</Text>
                </TouchableOpacity>
            </View>
        </View>
    );
}

const styles = StyleSheet.create({
    container: {
        alignItems: 'center',
        justifyContent: 'center',
        padding: 24,
    },
    label: {
        fontSize: 14,
        color: '#64748b',
    },
    value: {
        fontSize: 48,
        fontWeight: '800',
        color: '#4f46e5',
        marginVertical: 12,
    },
    buttonRow: {
        flexDirection: 'row',
        gap: 12,
    },
    button: {
        paddingHorizontal: 20,
        paddingVertical: 12,
        borderRadius: 12,
    },
    btnMinus: {
        backgroundColor: '#ef4444',
    },
    btnPlus: {
        backgroundColor: '#10b981',
    },
    btnText: {
        color: '#ffffff',
        fontWeight: 'bold',
    },
});
```
MARKDOWN
                ],
            ],

            // =========================================================================
            // KURSUS 6: DESAIN UI/UX DENGAN FIGMA
            // =========================================================================
            'desain-uiux-dengan-figma-panduan-lengkap' => [
                [
                    'title'       => 'Pengenalan UI/UX Design & Perbedaan Keduanya',
                    'duration'    => 20,
                    'description' => 'Memahami ruang lingkup UI vs UX, peran product designer, dan alur kerja desain produk digital modern.',
                    'content'     => <<<'MARKDOWN'
# Pengenalan UI/UX Design & Perbedaan Keduanya

Banyak orang yang masih menganggap UI (*User Interface*) dan UX (*User Experience*) adalah hal yang sama. Padahal keduanya adalah dua disiplin ilmu yang saling melengkapi namun memiliki fokus yang berbeda.

---

### Perbedaan UI vs UX
* **UX (User Experience):** Fokus pada **bagaimana produk bekerja** dan bagaimana perasaan pengguna saat menggunakannya. Melibatkan riset pengguna, alur alur (*user flow*), *wireframing*, dan *usability testing*.
* **UI (User Interface):** Fokus pada **bagaimana produk terlihat**. Melibatkan estetika visual, pemilihan warna (*color palette*), tipografi, ikonografi, dan desain komponen interaktif.
MARKDOWN
                ],
                [
                    'title'       => 'Mengenal Workspace & Tool Dasar Figma',
                    'duration'    => 25,
                    'description' => 'Navigasi canvas Figma, layer panel, properties inspector, frame vs group, dan vector networks.',
                    'content'     => <<<'MARKDOWN'
# Mengenal Workspace & Tool Dasar Figma

Figma adalah tool desain berbasis cloud nomor 1 di industri teknologi dunia yang memungkinkan kolaborasi desain secara real-time.

---

### Fitur Utama Figma
* **Frame (F):** Wadah layar untuk berbagai ukuran perangkat (iPhone, Desktop, Tablet).
* **Auto Layout (Shift + A):** Mengatur tata letak yang fleksibel dan otomatis menyesuaikan ukuran konten (mirip Flexbox di CSS).
* **Components & Variants:** Menciptakan komponen UI yang dapat digunakan berulang-ulang (*reusable*).
MARKDOWN
                ],
                [
                    'title'       => 'Prinsip Desain Visual: Hierarki, Kontras & Tipografi',
                    'duration'    => 30,
                    'description' => 'Menerapkan prinsip visual hierarchy, kontras warna yang memenuhi standar aksesibilitas WCAG, dan type scaling.',
                    'content'     => <<<'MARKDOWN'
# Prinsip Desain Visual: Hierarki, Kontras & Tipografi

Desain yang baik bukan hanya tentang keindahan, melainkan tentang kemudahan navigasi informasi bagi mata pengguna.

---

### 1. Hierarki Visual
Arahkan mata pengguna ke informasi yang paling penting terlebih dahulu menggunakan perbedaan ukuran (*scale*), ketebalan font (*weight*), dan warna kontras.
MARKDOWN
                ],
            ],
        ];

        foreach ($lessonsData as $courseSlug => $lessons) {
            $course = Course::where('slug', $courseSlug)->first();
            if (!$course) {
                continue;
            }

            foreach ($lessons as $order => $lessonData) {
                Lesson::create([
                    'course_id'   => $course->id,
                    'title'       => $lessonData['title'],
                    'description' => $lessonData['description'] ?? ('Materi ke-' . ($order + 1) . ' dari kursus ' . $course->title),
                    'content'     => $lessonData['content'],
                    'duration'    => $lessonData['duration'] ?? 25,
                    'order'       => $order + 1,
                ]);
            }
        }
    }
}
