@extends('layouts.dashboard')
@section('title', 'Kursus Saya')
@section('page-title', 'Kursus Saya')

@section('sidebar-nav')
    <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('student.courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-indigo-50 text-indigo-700 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Kursus Saya
    </a>
    <a href="{{ route('courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        Jelajahi Kursus
    </a>
@endsection

@section('content')
@if($enrollments->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach($enrollments as $enrollment)
        @php
            $course = $enrollment->course;
            $progress = $course->getProgressForUser(auth()->user());
        @endphp
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-md hover:border-indigo-200 transition-all">
            <div class="aspect-video bg-gradient-to-br from-indigo-500 to-violet-600 relative">
                @if($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-full h-full object-cover" alt="">
                @endif
                @if($enrollment->completed_at)
                    <div class="absolute inset-0 bg-emerald-900/60 flex items-center justify-center">
                        <span class="bg-emerald-500 text-white text-xs font-bold px-3 py-1.5 rounded-full">✓ SELESAI</span>
                    </div>
                @endif
            </div>
            <div class="p-5">
                <p class="text-xs font-medium text-indigo-600 uppercase tracking-wide mb-1">{{ $course->category->name }}</p>
                <h3 class="font-semibold text-slate-800 mb-3 line-clamp-2 text-sm">{{ $course->title }}</h3>
                <x-progress-bar :progress="$progress" size="sm"/>
                <div class="flex items-center justify-between mt-3">
                    <span class="text-xs text-slate-500">
                        {{ round($progress * $course->lessons->count() / 100) }}/{{ $course->lessons->count() }} materi
                    </span>
                    <a href="{{ route('student.courses.show', $course->slug) }}"
                       class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                        {{ $progress > 0 ? 'Lanjutkan →' : 'Mulai →' }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $enrollments->links() }}</div>
@else
    <div class="text-center py-20 bg-white rounded-2xl border border-slate-200">
        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        <p class="font-semibold text-slate-600 mb-4">Anda belum mengikuti kursus apapun</p>
        <a href="{{ route('courses.index') }}" class="bg-indigo-600 text-white text-sm font-medium px-6 py-2.5 rounded-xl hover:bg-indigo-700 transition-colors">
            Temukan Kursus
        </a>
    </div>
@endif
@endsection