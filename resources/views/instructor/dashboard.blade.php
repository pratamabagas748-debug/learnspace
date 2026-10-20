@extends('layouts.dashboard')
@section('title', 'Dashboard Instructor')
@section('page-title', 'Dashboard Instructor')
@section('page-subtitle', 'Kelola kursus dan pantau peserta Anda')

@section('topbar-actions')
<a href="{{ route('instructor.courses.create') }}"
   class="hidden sm:inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition-all hover:shadow-md hover:shadow-indigo-200">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
    Buat Kursus
</a>
@endsection

@section('sidebar-nav')
<x-nav-item href="{{ route('instructor.dashboard') }}" :active="request()->routeIs('instructor.dashboard')"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>'>
    Dashboard
</x-nav-item>

<div class="mt-4 mb-1 px-3">
    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Konten</p>
</div>

<x-nav-item href="{{ route('instructor.courses.index') }}" :active="request()->routeIs('instructor.courses.*')"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>'
    :badge="$stats['total_courses']">
    Kursus Saya
</x-nav-item>

<x-nav-item href="{{ route('instructor.courses.create') }}" :active="request()->routeIs('instructor.courses.create')"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>'>
    Tambah Kursus
</x-nav-item>
@endsection

@section('content')

{{-- Welcome Banner --}}
<div class="bg-gradient-to-r from-indigo-600 to-violet-700 rounded-2xl p-6 mb-6 text-white relative overflow-hidden">
    <div class="absolute -top-6 -right-6 w-32 h-32 bg-white/5 rounded-full"></div>
    <div class="absolute -bottom-4 right-16 w-20 h-20 bg-white/5 rounded-full"></div>
    <div class="relative">
        <p class="text-indigo-200 text-sm font-medium mb-1">Selamat datang kembali 👋</p>
        <h2 class="text-2xl font-extrabold">{{ auth()->user()->name }}</h2>
        <p class="text-indigo-200 text-sm mt-1">Anda memiliki <strong class="text-white">{{ $stats['total_courses'] }}</strong> kursus dengan <strong class="text-white">{{ $stats['total_students'] }}</strong> peserta aktif.</p>
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    @php
    $stats_items = [
        ['label' => 'Total Kursus',  'value' => $stats['total_courses'],  'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'from' => 'from-indigo-500', 'to' => 'to-indigo-700'],
        ['label' => 'Total Peserta', 'value' => $stats['total_students'], 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'from' => 'from-violet-500', 'to' => 'to-violet-700'],
        ['label' => 'Total Materi',  'value' => $stats['total_lessons'],  'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'from' => 'from-cyan-500', 'to' => 'to-cyan-700'],
    ];
    @endphp

    @foreach($stats_items as $s)
    <div class="stat-card bg-white border border-slate-100 rounded-2xl p-5 shadow-sm hover:shadow-md cursor-default">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 bg-gradient-to-br {{ $s['from'] }} {{ $s['to'] }} rounded-xl flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-extrabold text-slate-900">{{ $s['value'] }}</p>
        <p class="text-xs font-medium text-slate-500 mt-0.5">{{ $s['label'] }}</p>
    </div>
    @endforeach
</div>

{{-- Courses Table --}}
<div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <h2 class="font-bold text-slate-900 text-sm">Kursus Saya</h2>
        <a href="{{ route('instructor.courses.create') }}" class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-3.5 py-2 rounded-xl transition-colors">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Tambah
        </a>
    </div>
    @if($courses->isNotEmpty())
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="text-left px-5 py-3 font-semibold text-slate-500 text-xs uppercase tracking-wide">Kursus</th>
                <th class="text-left px-5 py-3 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden md:table-cell">Materi</th>
                <th class="text-left px-5 py-3 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden md:table-cell">Peserta</th>
                <th class="text-left px-5 py-3 font-semibold text-slate-500 text-xs uppercase tracking-wide">Status</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @foreach($courses as $course)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="px-5 py-4 font-semibold text-slate-800">{{ Str::limit($course->title, 40) }}</td>
                <td class="px-5 py-4 text-slate-500 hidden md:table-cell">{{ $course->lessons->count() }}</td>
                <td class="px-5 py-4 text-slate-500 hidden md:table-cell">{{ $course->enrollments->count() }}</td>
                <td class="px-5 py-4">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $course->status === 'published' ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center gap-2 justify-end opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('instructor.courses.students', $course->id) }}" class="text-xs text-slate-500 hover:text-slate-800 font-medium transition-colors">Peserta</a>
                        <a href="{{ route('instructor.courses.edit', $course->id) }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium transition-colors">Edit</a>
                        <form method="POST" action="{{ route('instructor.courses.destroy', $course->id) }}" onsubmit="return confirm('Hapus kursus ini?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:text-red-700 font-medium transition-colors">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="py-16 text-center">
        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        </div>
        <p class="font-semibold text-slate-600 mb-1">Belum ada kursus</p>
        <p class="text-slate-400 text-sm mb-4">Mulai buat kursus pertama Anda sekarang.</p>
        <a href="{{ route('instructor.courses.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-indigo-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Kursus Pertama
        </a>
    </div>
    @endif
</div>
@endsection