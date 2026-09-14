@extends('layouts.dashboard')
@section('title', 'Dashboard Instructor')
@section('page-title', 'Dashboard Instructor')

@section('sidebar-nav')
    <a href="{{ route('instructor.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-indigo-50 text-indigo-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('instructor.courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Kursus Saya
    </a>
    <a href="{{ route('instructor.courses.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Kursus
    </a>
@endsection

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-bold text-slate-900">Halo, {{ auth()->user()->name }}! 👋</h2>
    <p class="text-slate-500 text-sm mt-1">Kelola kursus dan pantau perkembangan peserta Anda.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm text-slate-500 font-medium">Total Kursus</p>
            <div class="w-9 h-9 bg-indigo-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_courses'] }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm text-slate-500 font-medium">Total Peserta</p>
            <div class="w-9 h-9 bg-violet-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_students'] }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm text-slate-500 font-medium">Total Materi</p>
            <div class="w-9 h-9 bg-cyan-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_lessons'] }}</p>
    </div>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <h3 class="font-bold text-slate-900">Kursus Saya</h3>
        <a href="{{ route('instructor.courses.create') }}" class="bg-indigo-600 text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">+ Tambah Kursus</a>
    </div>
    @if($courses->isNotEmpty())
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="text-left px-5 py-3 font-medium text-slate-500">Kursus</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500 hidden md:table-cell">Materi</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500 hidden md:table-cell">Peserta</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500">Status</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($courses as $course)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-5 py-4 font-medium text-slate-800">{{ Str::limit($course->title, 40) }}</td>
                <td class="px-5 py-4 text-slate-500 hidden md:table-cell">{{ $course->lessons->count() }}</td>
                <td class="px-5 py-4 text-slate-500 hidden md:table-cell">{{ $course->enrollments->count() }}</td>
                <td class="px-5 py-4">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ $course->status === 'published' ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center gap-2 justify-end">
                        <a href="{{ route('instructor.courses.edit', $course->id) }}" class="text-xs text-indigo-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('instructor.courses.destroy', $course->id) }}" onsubmit="return confirm('Hapus kursus ini?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:underline">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="py-12 text-center text-slate-400 text-sm">
        <p class="mb-3">Anda belum memiliki kursus.</p>
        <a href="{{ route('instructor.courses.create') }}" class="text-indigo-600 hover:underline font-medium">Buat kursus pertama Anda</a>
    </div>
    @endif
</div>
@endsection