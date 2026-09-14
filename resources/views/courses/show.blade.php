@extends('layouts.app')
@section('title', $course->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Main Content --}}
        <div class="lg:col-span-2">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
                <a href="{{ route('courses.index') }}" class="hover:text-indigo-600 transition-colors">Kursus</a>
                <span>/</span>
                <span class="text-slate-800 font-medium truncate">{{ $course->title }}</span>
            </nav>

            {{-- Category & Level Badges --}}
            <div class="flex items-center gap-2 mb-4">
                <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full uppercase tracking-wide">
                    {{ $course->category->name }}
                </span>
                <span class="text-xs font-semibold px-3 py-1 rounded-full
                    @if($course->level === 'beginner') bg-emerald-100 text-emerald-700
                    @elseif($course->level === 'intermediate') bg-amber-100 text-amber-700
                    @else bg-red-100 text-red-700 @endif">
                    {{ $course->level_label }}
                </span>
            </div>

            {{-- Title --}}
            <h1 class="text-3xl font-bold text-slate-900 mb-4 leading-tight">{{ $course->title }}</h1>

            {{-- Description --}}
            <p class="text-slate-600 leading-relaxed mb-6">{{ $course->description }}</p>

            {{-- Instructor Info --}}
            <div class="flex items-center gap-3 mb-8 p-4 bg-slate-50 rounded-xl border border-slate-200">
                <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold text-lg shrink-0">
                    {{ strtoupper(substr($course->instructor->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-xs text-slate-500">Instruktur</p>
                    <p class="font-semibold text-slate-800">{{ $course->instructor->name }}</p>
                    @if($course->instructor->bio)
                        <p class="text-xs text-slate-500 mt-0.5">{{ Str::limit($course->instructor->bio, 80) }}</p>
                    @endif
                </div>
            </div>

            {{-- Lesson List --}}
            <div>
                <h2 class="text-xl font-bold text-slate-900 mb-4">Daftar Materi ({{ $course->lessons->count() }} Materi)</h2>
                @if($course->lessons->isNotEmpty())
                    <div class="border border-slate-200 rounded-xl overflow-hidden divide-y divide-slate-100">
                        @foreach($course->lessons as $lesson)
                        <div class="flex items-start gap-4 p-4 bg-white hover:bg-slate-50 transition-colors">
                            <div class="w-7 h-7 bg-indigo-100 rounded-full flex items-center justify-center text-xs font-bold text-indigo-600 shrink-0">
                                {{ $lesson->order }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-slate-800 text-sm">{{ $lesson->title }}</p>
                                @if($lesson->description)
                                    <p class="text-xs text-slate-500 mt-0.5">{{ $lesson->description }}</p>
                                @endif
                            </div>
                            @if($lesson->duration)
                                <span class="text-xs text-slate-400 shrink-0">{{ $lesson->duration }} mnt</span>
                            @endif
                            @if(!$isEnrolled)
                                <svg class="w-4 h-4 text-slate-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-slate-400 text-sm py-6 text-center">Belum ada materi yang tersedia.</p>
                @endif
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            <div class="sticky top-20">
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    {{-- Thumbnail --}}
                    <div class="aspect-video bg-gradient-to-br from-indigo-500 to-violet-600 relative">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        {{-- Course Meta --}}
                        <div class="space-y-3 mb-5 pb-5 border-b border-slate-100">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Total Materi</span>
                                <span class="font-semibold text-slate-800">{{ $course->lessons->count() }} materi</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Durasi</span>
                                <span class="font-semibold text-slate-800">{{ $course->formatted_duration }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Level</span>
                                <span class="font-semibold text-slate-800">{{ $course->level_label }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Peserta</span>
                                <span class="font-semibold text-slate-800">{{ $course->enrollments->count() }} orang</span>
                            </div>
                        </div>

                        {{-- Enroll / Continue Button --}}
                        @auth
                            @if($isEnrolled)
                                <a href="{{ route('student.courses.show', $course->slug) }}"
                                   class="block text-center w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl transition-colors mb-3">
                                    Mulai Belajar →
                                </a>
                                <p class="text-center text-xs text-emerald-600 font-medium">✓ Anda sudah terdaftar di kursus ini</p>
                            @elseif(auth()->user()->isStudent())
                                <form method="POST" action="{{ route('student.courses.enroll', $course->id) }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition-colors">
                                        Daftar Kursus Ini
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                               class="block text-center w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition-colors mb-3">
                                Masuk untuk Mendaftar
                            </a>
                            <p class="text-center text-xs text-slate-400">Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Daftar gratis</a></p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection