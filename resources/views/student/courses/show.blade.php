@extends('layouts.dashboard')
@section('title', $course->title)
@section('page-title', $course->title)
@section('page-subtitle', $course->instructor->name . ' · ' . $course->category->name)

@section('sidebar-nav')
<x-nav-item href="{{ route('student.dashboard') }}" :active="false"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>'>
    Dashboard
</x-nav-item>
<div class="mt-4 mb-1 px-3"><p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Belajar</p></div>
<x-nav-item href="{{ route('student.courses.index') }}" :active="true"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>'>
    Kursus Saya
</x-nav-item>
<x-nav-item href="{{ route('courses.index') }}" :active="false"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>'>
    Jelajahi Kursus
</x-nav-item>
@endsection

@section('content')
<div class="mb-5">
    <a href="{{ route('student.courses.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Kursus Saya
    </a>
</div>

<div class="max-w-4xl">
    {{-- Progress Card --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm font-semibold text-slate-700 mb-0.5">Progress Keseluruhan</p>
                <p class="text-xs text-slate-400">{{ count($completedLessonIds) }} dari {{ $course->lessons->count() }} materi selesai</p>
            </div>
            <span class="text-3xl font-extrabold {{ $progress >= 100 ? 'text-emerald-600' : 'text-indigo-600' }}">{{ $progress }}%</span>
        </div>
        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
            <div class="h-full rounded-full transition-all duration-700 {{ $progress >= 100 ? 'bg-gradient-to-r from-emerald-400 to-emerald-500' : 'bg-gradient-to-r from-indigo-500 to-violet-600' }}"
                 style="width: {{ $progress }}%"></div>
        </div>
        @if($progress >= 100)
            <div class="mt-4 bg-emerald-50 border border-emerald-200 rounded-xl py-3 px-4 flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <p class="text-emerald-700 font-semibold text-sm">🎉 Selamat! Anda telah menyelesaikan semua materi kursus ini!</p>
            </div>
        @endif
    </div>

    {{-- Lesson List --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-900">Daftar Materi</h2>
            <span class="text-xs text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full font-medium">
                {{ $course->lessons->count() }} materi
            </span>
        </div>

        @forelse($course->lessons as $lesson)
        @php $isCompleted = in_array($lesson->id, $completedLessonIds); @endphp
        <div class="flex items-center gap-4 px-6 py-4 border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors group">
            {{-- Status indicator --}}
            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-colors
                {{ $isCompleted ? 'bg-emerald-100' : 'bg-slate-100 group-hover:bg-indigo-50' }}">
                @if($isCompleted)
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                @else
                    <span class="text-xs font-bold text-slate-500 group-hover:text-indigo-600 transition-colors">{{ $lesson->order }}</span>
                @endif
            </div>

            {{-- Lesson info --}}
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm text-slate-800 {{ $isCompleted ? 'line-through text-slate-400' : '' }}">{{ $lesson->title }}</p>
                @if($lesson->duration)
                    <p class="text-xs text-slate-400 mt-0.5 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $lesson->duration }} menit
                    </p>
                @endif
            </div>

            {{-- Action button --}}
            <a href="{{ route('student.lessons.show', $lesson->id) }}"
               class="text-xs font-bold px-4 py-2 rounded-xl transition-all shrink-0
               {{ $isCompleted
                   ? 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                   : 'bg-indigo-600 text-white hover:bg-indigo-700 hover:shadow-md hover:shadow-indigo-200' }}">
                {{ $isCompleted ? '↩ Ulangi' : '→ Belajar' }}
            </a>
        </div>
        @empty
        <div class="px-6 py-12 text-center text-slate-400">
            <p class="text-sm">Belum ada materi di kursus ini.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection