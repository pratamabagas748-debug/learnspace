@extends('layouts.dashboard')
@section('title', 'Kursus Saya')
@section('page-title', 'Kursus Saya')
@section('page-subtitle', $enrollments->total() . ' kursus diikuti')

@section('topbar-actions')
<a href="{{ route('courses.index') }}"
   class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    Jelajahi Kursus
</a>
@endsection

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
@if($enrollments->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach($enrollments as $enrollment)
        @php
            $course = $enrollment->course;
            $progress = $course->getProgressForUser(auth()->user());
            $lessonCount = $course->lessons->count();
            $doneCount = $lessonCount > 0 ? (int)round($progress * $lessonCount / 100) : 0;
        @endphp
        <a href="{{ route('student.courses.show', $course->slug) }}"
           class="stat-card bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md hover:border-indigo-200 group block">
            {{-- Thumbnail --}}
            <div class="aspect-video bg-gradient-to-br from-indigo-500 to-violet-600 relative overflow-hidden">
                @if($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                @endif
                @if($enrollment->completed_at)
                    <div class="absolute inset-0 bg-emerald-900/50 flex items-center justify-center">
                        <span class="bg-emerald-500 text-white text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Selesai
                        </span>
                    </div>
                @endif
            </div>
            {{-- Info --}}
            <div class="p-5">
                <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide mb-1">{{ $course->category->name }}</p>
                <h3 class="font-bold text-slate-800 mb-3 line-clamp-2 text-sm group-hover:text-indigo-700 transition-colors leading-snug">{{ $course->title }}</h3>
                {{-- Progress bar --}}
                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden mb-2">
                    <div class="h-full rounded-full {{ $progress >= 100 ? 'bg-emerald-500' : 'bg-gradient-to-r from-indigo-500 to-violet-500' }} transition-all duration-500"
                         style="width: {{ $progress }}%"></div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-500">{{ $doneCount }}/{{ $lessonCount }} materi · {{ $progress }}%</span>
                    <span class="text-xs font-bold {{ $progress >= 100 ? 'text-emerald-600' : 'text-indigo-600' }}">
                        {{ $progress >= 100 ? 'Ulangi ↗' : ($progress > 0 ? 'Lanjutkan →' : 'Mulai →') }}
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @if($enrollments->hasPages())
    <div class="mt-6">{{ $enrollments->links() }}</div>
    @endif

@else
    <div class="text-center py-20 bg-white rounded-2xl border border-slate-100 shadow-sm">
        <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <p class="font-bold text-slate-700 mb-1">Belum ada kursus</p>
        <p class="text-slate-400 text-sm mb-5">Mulai perjalanan belajarmu sekarang.</p>
        <a href="{{ route('courses.index') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-all hover:shadow-md hover:shadow-indigo-200">
            Temukan Kursus
        </a>
    </div>
@endif
@endsection