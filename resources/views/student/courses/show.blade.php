@extends('layouts.dashboard')
@section('title', $course->title)
@section('page-title', $course->title)

@section('sidebar-nav')
    <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('student.courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-indigo-50 text-indigo-700 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Kursus Saya
    </a>
@endsection

@section('content')
<div class="max-w-4xl">
    {{-- Progress Overview --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-5 mb-6">
        <div class="flex items-center justify-between mb-3">
            <div>
                <p class="text-sm font-semibold text-slate-700">Progress Keseluruhan</p>
                <p class="text-xs text-slate-400">{{ count($completedLessonIds) }} dari {{ $course->lessons->count() }} materi selesai</p>
            </div>
            <span class="text-2xl font-bold {{ $progress >= 100 ? 'text-emerald-600' : 'text-indigo-600' }}">{{ $progress }}%</span>
        </div>
        <x-progress-bar :progress="$progress" :label="false" size="lg"/>
        @if($progress >= 100)
            <p class="text-emerald-600 font-semibold text-sm mt-3 text-center">🎉 Selamat! Anda telah menyelesaikan semua materi kursus ini!</p>
        @endif
    </div>

    {{-- Lesson List --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="font-bold text-slate-900">Daftar Materi</h2>
        </div>
        @forelse($course->lessons as $lesson)
        @php $isCompleted = in_array($lesson->id, $completedLessonIds); @endphp
        <div class="flex items-center gap-4 px-5 py-4 border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors">
            {{-- Status icon --}}
            <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 {{ $isCompleted ? 'bg-emerald-100' : 'bg-slate-100' }}">
                @if($isCompleted)
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                @else
                    <span class="text-xs font-bold text-slate-500">{{ $lesson->order }}</span>
                @endif
            </div>

            {{-- Lesson info --}}
            <div class="flex-1 min-w-0">
                <p class="font-medium text-sm text-slate-800 {{ $isCompleted ? 'text-slate-500' : '' }}">{{ $lesson->title }}</p>
                @if($lesson->duration)
                    <p class="text-xs text-slate-400">{{ $lesson->duration }} menit</p>
                @endif
            </div>

            {{-- Action --}}
            <a href="{{ route('student.lessons.show', $lesson->id) }}"
               class="text-xs font-semibold px-4 py-2 rounded-lg transition-colors shrink-0
               {{ $isCompleted ? 'bg-slate-100 text-slate-600 hover:bg-slate-200' : 'bg-indigo-600 text-white hover:bg-indigo-700' }}">
                {{ $isCompleted ? 'Ulangi' : 'Belajar' }}
            </a>
        </div>
        @empty
        <div class="px-5 py-10 text-center text-slate-400 text-sm">Belum ada materi di kursus ini.</div>
        @endforelse
    </div>
</div>
@endsection