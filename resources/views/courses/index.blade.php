@extends('layouts.app')
@section('title', 'Semua Kursus')
@section('meta_description', 'Jelajahi semua kursus di LearnSpace. Filter berdasarkan kategori, level, dan kata kunci.')

@section('content')
<div class="courses-discovery-page max-w-7xl mx-auto px-4 py-8 sm:py-10">

    {{-- Header --}}
    <div class="courses-discovery-hero mb-7 sm:mb-8">
        <div class="courses-discovery-hero-copy">
            <span class="courses-discovery-eyebrow"><span></span> LEARN • BUILD • GROW</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold">Jelajahi Kursus</h1>
            <p>Temukan skill berikutnya, bangun proyek nyata, dan selangkah lebih dekat ke tujuanmu.</p>
            <div class="courses-discovery-tags"><span>✦ Materi terstruktur</span><span>↗ Belajar sesuai ritme</span></div>
        </div>
        <div class="courses-discovery-hero-art" aria-hidden="true">
            <span class="courses-discovery-orbit courses-discovery-orbit-one"></span><span class="courses-discovery-orbit courses-discovery-orbit-two"></span>
            <div class="courses-discovery-book"><span class="courses-discovery-book-mark">LS</span><strong>YOUR NEXT<br>CHAPTER</strong><small>LEARNING PATH</small><div><i></i><i></i><i></i></div></div>
            <span class="courses-discovery-float courses-discovery-float-one">⌘ Skill up</span><span class="courses-discovery-float courses-discovery-float-two">✦ Keep growing</span>
        </div>
    </div>

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('courses.index') }}" class="mb-8">
        <div class="courses-discovery-filter bg-white border border-slate-100 rounded-2xl shadow-sm p-4">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari kursus..."
                           class="w-full pr-4 py-3 border border-slate-200 bg-slate-50 focus:bg-white rounded-xl text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-xs"
                           style="padding-left: 2.75rem;">
                </div>
                <select name="category" class="px-4 py-3 border border-slate-200 bg-slate-50 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <select name="level" class="px-4 py-3 border border-slate-200 bg-slate-50 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <option value="">Semua Level</option>
                    <option value="beginner" {{ request('level') === 'beginner' ? 'selected' : '' }}>🟢 Pemula</option>
                    <option value="intermediate" {{ request('level') === 'intermediate' ? 'selected' : '' }}>🟡 Menengah</option>
                    <option value="advanced" {{ request('level') === 'advanced' ? 'selected' : '' }}>🔴 Mahir</option>
                </select>
                <button type="submit" class="bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white text-sm font-bold px-6 py-3 rounded-xl transition-all hover:shadow-md hover:shadow-indigo-200">
                    Cari
                </button>
            </div>

            {{-- Active Filters --}}
            @if(request()->hasAny(['search','category','level']))
            <div class="flex flex-wrap items-center gap-2 mt-3 pt-3 border-t border-slate-100">
                <span class="text-xs text-slate-500">Filter aktif:</span>
                @if(request('search'))
                    <span class="text-xs bg-indigo-50 text-indigo-700 font-semibold px-2.5 py-1 rounded-full">"{{ request('search') }}"</span>
                @endif
                @if(request('category'))
                    <span class="text-xs bg-violet-50 text-violet-700 font-semibold px-2.5 py-1 rounded-full">{{ $categories->firstWhere('slug', request('category'))->name ?? request('category') }}</span>
                @endif
                @if(request('level'))
                    <span class="text-xs bg-amber-50 text-amber-700 font-semibold px-2.5 py-1 rounded-full capitalize">{{ request('level') }}</span>
                @endif
                <a href="{{ route('courses.index') }}" class="text-xs text-red-500 hover:text-red-700 font-semibold transition-colors ml-1">
                    ✕ Hapus semua
                </a>
            </div>
            @endif
        </div>
    </form>

    {{-- Results Count --}}
    <p class="text-sm text-slate-500 mb-6 font-medium">Menampilkan <strong class="text-slate-800">{{ $courses->total() }}</strong> kursus</p>

    {{-- Course Grid --}}
    @if($courses->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($courses as $course)
                <x-course-card :course="$course"/>
            @endforeach
        </div>

        @if($courses->hasPages())
        <div class="mt-10">{{ $courses->links() }}</div>
        @endif
    @else
        <div class="text-center py-20 bg-white rounded-2xl border border-slate-100 shadow-sm">
            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-600 mb-1">Kursus tidak ditemukan</h3>
            <p class="text-slate-400 text-sm mb-4">Coba kata kunci atau filter yang berbeda</p>
            @if(request()->hasAny(['search','category','level']))
            <a href="{{ route('courses.index') }}" class="text-indigo-600 font-semibold text-sm hover:underline">Lihat semua kursus →</a>
            @endif
        </div>
    @endif
</div>
@endsection