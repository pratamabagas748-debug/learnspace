@extends('layouts.app')
@section('title', $course->title)
@section('meta_description', Str::limit($course->description, 160))

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Home</a>
        <svg class="w-3.5 h-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('courses.index') }}" class="hover:text-indigo-600 transition-colors">Kursus</a>
        <svg class="w-3.5 h-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-800 font-medium truncate">{{ $course->title }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- ==================== MAIN CONTENT ==================== --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Hero Header --}}
            <div class="bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-500/10 rounded-full"></div>
                <div class="absolute bottom-0 right-20 w-24 h-24 bg-violet-500/10 rounded-full"></div>
                <div class="relative">
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span class="text-xs font-bold text-indigo-300 bg-indigo-500/20 border border-indigo-400/30 px-3 py-1 rounded-full uppercase tracking-wide">
                            {{ $course->category->name }}
                        </span>
                        <span class="text-xs font-bold px-3 py-1 rounded-full
                            @if($course->level === 'beginner') bg-emerald-500/20 text-emerald-300 border border-emerald-400/30
                            @elseif($course->level === 'intermediate') bg-amber-500/20 text-amber-300 border border-amber-400/30
                            @else bg-red-500/20 text-red-300 border border-red-400/30 @endif">
                            {{ $course->level_label }}
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold leading-tight mb-3">{{ $course->title }}</h1>
                    <p class="text-indigo-200 text-sm leading-relaxed max-w-xl">{{ Str::limit($course->description, 200) }}</p>

                    {{-- Meta --}}
                    <div class="flex flex-wrap gap-5 mt-6 pt-5 border-t border-white/10 text-sm">
                        <div class="flex items-center gap-2 text-indigo-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <span><strong class="text-white">{{ $course->lessons->count() }}</strong> Materi</span>
                        </div>
                        <div class="flex items-center gap-2 text-indigo-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span><strong class="text-white">{{ $course->formatted_duration }}</strong></span>
                        </div>
                        <div class="flex items-center gap-2 text-indigo-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span><strong class="text-white">{{ $course->enrollments->count() }}</strong> Peserta</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description Full --}}
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6">
                <h2 class="font-bold text-slate-900 mb-3">Tentang Kursus Ini</h2>
                <div class="prose prose-slate prose-sm max-w-none text-slate-600 leading-relaxed">
                    {!! nl2br(e($course->description)) !!}
                </div>
            </div>

            {{-- Instructor --}}
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6">
                <h2 class="font-bold text-slate-900 mb-4">Instruktur</h2>
                <div class="flex items-center gap-4">
                    @if($course->instructor->avatar)
                        <img src="{{ asset('storage/' . $course->instructor->avatar) }}" class="w-14 h-14 rounded-2xl object-cover shadow-sm" alt="">
                    @else
                        <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-2xl flex items-center justify-center text-white text-xl font-bold shadow-sm">
                            {{ strtoupper(substr($course->instructor->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p class="font-bold text-slate-800">{{ $course->instructor->name }}</p>
                        @if($course->instructor->bio)
                            <p class="text-sm text-slate-500 mt-0.5">{{ $course->instructor->bio }}</p>
                        @endif
                        <p class="text-xs text-slate-400 mt-1">{{ $course->instructor->courses()->where('status','published')->count() }} kursus diterbitkan</p>
                    </div>
                </div>
            </div>

            {{-- Lesson List --}}
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h2 class="font-bold text-slate-900">Daftar Materi</h2>
                    <span class="text-xs bg-slate-100 text-slate-600 font-semibold px-2.5 py-1 rounded-full">{{ $course->lessons->count() }} materi</span>
                </div>
                @if($course->lessons->isNotEmpty())
                    @foreach($course->lessons as $lesson)
                    <div class="flex items-center gap-4 px-6 py-4 border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 bg-indigo-50 rounded-xl flex items-center justify-center text-xs font-bold text-indigo-600 shrink-0">
                            {{ $lesson->order }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm text-slate-800">{{ $lesson->title }}</p>
                            @if($lesson->description)
                                <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">{{ $lesson->description }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            @if($lesson->duration)
                                <span class="text-xs text-slate-400">{{ $lesson->duration }} mnt</span>
                            @endif
                            @if(!$isEnrolled)
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-slate-400 text-sm py-10 text-center">Belum ada materi yang tersedia.</p>
                @endif
            </div>
        </div>

        {{-- ==================== SIDEBAR ==================== --}}
        <div class="lg:col-span-1">
            <div class="sticky top-20 space-y-5">
                {{-- Enrollment Card --}}
                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
                    {{-- Thumbnail --}}
                    <div class="aspect-video bg-gradient-to-br from-indigo-500 to-violet-600 relative">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-5 space-y-5">
                        {{-- Course Meta --}}
                        <div class="space-y-3">
                            @foreach([
                                ['Total Materi', $course->lessons->count() . ' materi', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                                ['Durasi', $course->formatted_duration, 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ['Level', $course->level_label, 'M13 10V3L4 14h7v7l9-11h-7z'],
                                ['Peserta', $course->enrollments->count() . ' orang', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                            ] as $meta)
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $meta[2] }}"/></svg>
                                <span class="text-sm text-slate-500 flex-1">{{ $meta[0] }}</span>
                                <span class="text-sm font-semibold text-slate-800">{{ $meta[1] }}</span>
                            </div>
                            @endforeach
                        </div>

                        <hr class="border-slate-100">

                        {{-- CTA --}}
                        @auth
                            @if($isEnrolled)
                                <a href="{{ route('student.courses.show', $course->slug) }}"
                                   class="block text-center w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-3.5 rounded-xl transition-all hover:shadow-lg hover:shadow-emerald-200">
                                    Mulai Belajar →
                                </a>
                                <p class="text-center text-xs text-emerald-600 font-semibold flex items-center justify-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Anda sudah terdaftar di kursus ini
                                </p>
                            @elseif(auth()->user()->isStudent())
                                <form method="POST" action="{{ route('student.courses.enroll', $course->id) }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold py-3.5 rounded-xl transition-all hover:shadow-lg hover:shadow-indigo-200">
                                        Daftar Kursus — Gratis
                                    </button>
                                </form>
                                <p class="text-center text-xs text-slate-400 mt-2">100% gratis, tidak ada biaya tersembunyi</p>
                            @else
                                <div class="text-center text-sm text-slate-500 bg-slate-50 rounded-xl py-3">
                                    Hanya student yang dapat mendaftar kursus.
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                               class="block text-center w-full bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold py-3.5 rounded-xl transition-all hover:shadow-lg hover:shadow-indigo-200">
                                Masuk untuk Mendaftar
                            </a>
                            <p class="text-center text-xs text-slate-400 mt-2">
                                Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">Daftar gratis</a>
                            </p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection