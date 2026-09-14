@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Saya')

@section('sidebar-nav')
    @php $routePrefix = 'student'; @endphp
    <a href="{{ route('student.dashboard') }}"
       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('student.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }} transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Dashboard
    </a>
    <a href="{{ route('student.courses.index') }}"
       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('student.courses.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }} transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        Kursus Saya
    </a>
    <a href="{{ route('courses.index') }}"
       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        Jelajahi Kursus
    </a>
@endsection

@section('content')

{{-- Welcome --}}
<div class="mb-6">
    <h2 class="text-xl font-bold text-slate-900">Halo, {{ auth()->user()->name }}! 👋</h2>
    <p class="text-slate-500 text-sm mt-1">Selamat datang kembali. Yuk lanjutkan belajar!</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm text-slate-500 font-medium">Kursus Diikuti</p>
            <div class="w-9 h-9 bg-indigo-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_enrolled'] }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm text-slate-500 font-medium">Sedang Belajar</p>
            <div class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_active'] }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm text-slate-500 font-medium">Selesai</p>
            <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_completed'] }}</p>
    </div>
</div>

{{-- Continue Learning --}}
@if($continuelearning->isNotEmpty())
<div class="mb-8">
    <h3 class="text-lg font-bold text-slate-900 mb-4">Lanjutkan Belajar</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($continuelearning as $enrollment)
        @php
            $course = $enrollment->course;
            $progress = $course->getProgressForUser(auth()->user());
        @endphp
        <a href="{{ route('student.courses.show', $course->slug) }}"
           class="bg-white border border-slate-200 hover:border-indigo-300 rounded-2xl p-5 block transition-all hover:shadow-md group">
            <div class="flex items-start gap-3 mb-4">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-xl shrink-0 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-slate-800 text-sm leading-snug group-hover:text-indigo-700 transition-colors line-clamp-2">{{ $course->title }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $course->instructor->name }}</p>
                </div>
            </div>
            <x-progress-bar :progress="$progress" size="sm"/>
            <p class="text-xs text-slate-500 mt-2">
                {{ $course->lessons->count() > 0 ? round($progress * $course->lessons->count() / 100) : 0 }} / {{ $course->lessons->count() }} materi selesai
            </p>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- All Enrollments --}}
<div>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-bold text-slate-900">Semua Kursus Saya</h3>
        <a href="{{ route('student.courses.index') }}" class="text-sm text-indigo-600 hover:underline">Lihat Semua</a>
    </div>

    @if($enrollments->isNotEmpty())
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-medium text-slate-500">Kursus</th>
                        <th class="text-left px-5 py-3 font-medium text-slate-500 hidden md:table-cell">Kategori</th>
                        <th class="text-left px-5 py-3 font-medium text-slate-500">Progress</th>
                        <th class="text-left px-5 py-3 font-medium text-slate-500 hidden sm:table-cell">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($enrollments->take(5) as $enrollment)
                    @php $progress = $enrollment->course->getProgressForUser(auth()->user()); @endphp
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-4">
                            <a href="{{ route('student.courses.show', $enrollment->course->slug) }}" class="font-medium text-slate-800 hover:text-indigo-600 transition-colors line-clamp-1">
                                {{ $enrollment->course->title }}
                            </a>
                        </td>
                        <td class="px-5 py-4 text-slate-500 hidden md:table-cell">{{ $enrollment->course->category->name }}</td>
                        <td class="px-5 py-4 w-32">
                            <div class="flex items-center gap-2">
                                <div class="flex-1 bg-slate-200 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-full rounded-full {{ $progress >= 100 ? 'bg-emerald-500' : 'bg-indigo-500' }}" style="width: {{ $progress }}%"></div>
                                </div>
                                <span class="text-xs font-medium text-slate-600 shrink-0">{{ $progress }}%</span>
                            </div>
                        </td>
                        <td class="px-5 py-4 hidden sm:table-cell">
                            @if($enrollment->completed_at)
                                <span class="text-xs bg-emerald-100 text-emerald-700 font-medium px-2.5 py-1 rounded-full">Selesai</span>
                            @else
                                <span class="text-xs bg-amber-100 text-amber-700 font-medium px-2.5 py-1 rounded-full">Berlangsung</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white border border-slate-200 rounded-2xl p-12 text-center">
            <svg class="w-14 h-14 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <p class="font-semibold text-slate-600 mb-1">Belum ada kursus</p>
            <p class="text-slate-400 text-sm mb-4">Mulai belajar dengan mendaftar ke kursus pertama Anda!</p>
            <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm font-medium px-5 py-2.5 rounded-xl hover:bg-indigo-700 transition-colors">
                Jelajahi Kursus
            </a>
        </div>
    @endif
</div>
@endsection