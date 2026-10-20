@extends('layouts.app')
@section('title', 'Platform Pembelajaran Online Terbaik')
@section('meta_description', 'LearnSpace - Belajar skill baru dengan kursus berkualitas dari instruktur terpercaya.')

@section('content')

{{-- HERO SECTION --}}
<section class="relative bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 text-white overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDM0di00aC0ydjRoLTR2Mmg0djRoMnYtNGg0di0yaC00em0wLTMwVjBoLTJ2NGgtNHYyaDR2NGgyVjZoNFY0aC00ek02IDM0di00SDR2NEgwdjJoNHY0aDJ2LTRoNHYtMkg2ek02IDRWMEg0djRIMHYyaDR2NGgyVjZoNFY0SDZ6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-40"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-24 sm:py-32">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 bg-indigo-500/20 border border-indigo-400/30 text-indigo-300 text-xs font-medium px-3 py-1.5 rounded-full mb-6">
                <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-pulse"></span>
                Platform Pembelajaran Online
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                Tingkatkan Skill,<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Raih Karir Impian</span>
            </h1>
            <p class="text-slate-300 text-lg sm:text-xl leading-relaxed mb-10 max-w-2xl">
                Belajar dari instruktur terpercaya dengan kurikulum yang terstruktur. Mulai dari nol, berkembang menjadi profesional.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('courses.index') }}"
                   class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-7 py-3.5 rounded-xl transition-all hover:scale-105">
                    Jelajahi Kursus
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                @guest
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold px-7 py-3.5 rounded-xl transition-all backdrop-blur">
                    Daftar Gratis
                </a>
                @endguest
            </div>

            {{-- Stats --}}
            <div class="flex flex-wrap gap-8 mt-12 pt-8 border-t border-white/10">
                <div>
                    <p class="text-3xl font-bold text-white">{{ \App\Models\Course::where('status','published')->count() }}+</p>
                    <p class="text-slate-400 text-sm">Kursus Tersedia</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-white">{{ \App\Models\User::where('role','student')->count() }}+</p>
                    <p class="text-slate-400 text-sm">Pelajar Aktif</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-white">{{ \App\Models\User::where('role','instructor')->count() }}+</p>
                    <p class="text-slate-400 text-sm">Instruktur</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FEATURED COURSES --}}
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex items-end justify-between mb-10">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Kursus Pilihan</h2>
            <p class="text-slate-500 mt-1">Kursus terbaru dan terpopuler untuk Anda</p>
        </div>
        <a href="{{ route('courses.index') }}" class="hidden sm:flex items-center gap-1 text-indigo-600 font-medium text-sm hover:underline">
            Lihat Semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>

    @if($featuredCourses->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredCourses as $course)
                <x-course-card :course="$course"/>
            @endforeach
        </div>
    @else
        <p class="text-center text-slate-400 py-12">Belum ada kursus tersedia.</p>
    @endif
</section>

{{-- CATEGORIES --}}
<section class="bg-white border-y border-slate-200 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Jelajahi Berdasarkan Kategori</h2>
            <p class="text-slate-500 mt-1">Temukan kursus yang sesuai dengan minat Anda</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($categories as $cat)
            <a href="{{ route('courses.index', ['category' => $cat->slug]) }}"
               class="flex flex-col items-center gap-3 p-5 rounded-2xl border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50 transition-all group text-center">
                <div class="w-12 h-12 bg-indigo-100 group-hover:bg-indigo-200 rounded-xl flex items-center justify-center transition-colors">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-700 group-hover:text-indigo-700 transition-colors">{{ $cat->name }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $cat->published_courses_count }} kursus</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- WHY LEARNSPACE --}}
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Mengapa LearnSpace?</h2>
        <p class="text-slate-500 mt-1 max-w-xl mx-auto">Kami berkomitmen memberikan pengalaman belajar terbaik</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center p-6">
            <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-800 mb-2">Kurikulum Terstruktur</h3>
            <p class="text-slate-500 text-sm leading-relaxed">Materi pembelajaran yang dirancang sistematis dari dasar hingga mahir untuk kemajuan optimal.</p>
        </div>
        <div class="text-center p-6">
            <div class="w-14 h-14 bg-violet-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-800 mb-2">Progress Terukur</h3>
            <p class="text-slate-500 text-sm leading-relaxed">Pantau kemajuan belajar Anda secara real-time dengan sistem tracking progress yang detail.</p>
        </div>
        <div class="text-center p-6">
            <div class="w-14 h-14 bg-cyan-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-800 mb-2">Instruktur Berpengalaman</h3>
            <p class="text-slate-500 text-sm leading-relaxed">Belajar langsung dari praktisi industri dengan pengalaman bertahun-tahun di bidangnya.</p>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
@guest
<section class="bg-gradient-to-r from-indigo-600 to-violet-700 text-white py-16">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Mulai Belajar?</h2>
        <p class="text-indigo-100 text-lg mb-8">Bergabung dengan ribuan pelajar yang sudah meningkatkan skill mereka bersama LearnSpace.</p>
        <a href="{{ route('register') }}"
           class="inline-flex items-center gap-2 bg-white text-indigo-700 font-bold px-8 py-4 rounded-xl hover:bg-indigo-50 transition-all hover:scale-105">
            Daftar Sekarang — Gratis!
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
@endguest

@endsection