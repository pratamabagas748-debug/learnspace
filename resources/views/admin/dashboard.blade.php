@extends('layouts.dashboard')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'Pantau semua aktivitas platform LearnSpace')

@section('sidebar-nav')
<x-nav-item href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>'>
    Dashboard
</x-nav-item>

<div class="mt-4 mb-1 px-3">
    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Manajemen</p>
</div>

<x-nav-item href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>'>
    Kelola User
</x-nav-item>

<x-nav-item href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories.*')"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>'>
    Kelola Kategori
</x-nav-item>

<x-nav-item href="{{ route('admin.courses.index') }}" :active="request()->routeIs('admin.courses.*')"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>'>
    Kelola Kursus
</x-nav-item>
@endsection

@section('content')

{{-- Stat Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
@php
$statItems = [
    ['label' => 'Total User',     'value' => $stats['total_users'],       'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197',       'from' => 'from-slate-500',   'to' => 'to-slate-700'],
    ['label' => 'Student',        'value' => $stats['total_students'],    'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',                   'from' => 'from-blue-500',    'to' => 'to-blue-700'],
    ['label' => 'Instructor',     'value' => $stats['total_instructors'], 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'from' => 'from-violet-500', 'to' => 'to-violet-700'],
    ['label' => 'Total Kursus',   'value' => $stats['total_courses'],    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'from' => 'from-indigo-500', 'to' => 'to-indigo-700'],
    ['label' => 'Enrollment',     'value' => $stats['total_enrollments'], 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',                                         'from' => 'from-emerald-500', 'to' => 'to-emerald-700'],
];
@endphp

@foreach($statItems as $item)
<div class="stat-card bg-white border border-slate-100 rounded-2xl p-5 col-span-1 shadow-sm hover:shadow-md cursor-default">
    <div class="flex items-center justify-between mb-4">
        <div class="w-10 h-10 bg-gradient-to-br {{ $item['from'] }} {{ $item['to'] }} rounded-xl flex items-center justify-center shadow-sm">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
            </svg>
        </div>
    </div>
    <p class="text-2xl font-extrabold text-slate-900">{{ $item['value'] }}</p>
    <p class="text-xs font-medium text-slate-500 mt-0.5">{{ $item['label'] }}</p>
</div>
@endforeach
</div>

{{-- Tables --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Kursus Terbaru --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h2 class="font-bold text-slate-900 text-sm">Kursus Terbaru</h2>
            <a href="{{ route('admin.courses.index') }}" class="text-xs text-indigo-600 font-semibold hover:text-indigo-800 transition-colors flex items-center gap-1">
                Lihat Semua
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="divide-y divide-slate-50">
            @forelse($latestCourses as $course)
            <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50 transition-colors">
                <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $course->title }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $course->instructor->name }} · {{ $course->category->name }}</p>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full shrink-0 {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                    {{ $course->status === 'published' ? 'Aktif' : 'Draft' }}
                </span>
            </div>
            @empty
            <p class="text-slate-400 text-sm text-center py-8">Belum ada kursus.</p>
            @endforelse
        </div>
    </div>

    {{-- User Terbaru --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h2 class="font-bold text-slate-900 text-sm">User Terbaru</h2>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-indigo-600 font-semibold hover:text-indigo-800 transition-colors flex items-center gap-1">
                Lihat Semua
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="divide-y divide-slate-50">
            @forelse($latestUsers as $user)
            <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50 transition-colors">
                <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm shrink-0
                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'instructor' ? 'bg-violet-100 text-violet-700' : 'bg-indigo-100 text-indigo-700') }}">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $user->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ $user->email }}</p>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full capitalize shrink-0
                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'instructor' ? 'bg-violet-100 text-violet-700' : 'bg-blue-100 text-blue-700') }}">
                    {{ $user->role }}
                </span>
            </div>
            @empty
            <p class="text-slate-400 text-sm text-center py-8">Belum ada user.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection