@extends('layouts.dashboard')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-indigo-50 text-indigo-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        Kelola User
    </a>
    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        Kelola Kategori
    </a>
    <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Kelola Kursus
    </a>
@endsection

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    @php
    $statItems = [
        ['label' => 'Total User', 'value' => $stats['total_users'], 'color' => 'bg-slate-100 text-slate-700'],
        ['label' => 'Student', 'value' => $stats['total_students'], 'color' => 'bg-blue-100 text-blue-700'],
        ['label' => 'Instructor', 'value' => $stats['total_instructors'], 'color' => 'bg-violet-100 text-violet-700'],
        ['label' => 'Kursus', 'value' => $stats['total_courses'], 'color' => 'bg-indigo-100 text-indigo-700'],
        ['label' => 'Enrollment', 'value' => $stats['total_enrollments'], 'color' => 'bg-emerald-100 text-emerald-700'],
    ];
    @endphp
    @foreach($statItems as $item)
    <div class="bg-white border border-slate-200 rounded-2xl p-5 col-span-1">
        <p class="text-xs text-slate-500 font-medium mb-2">{{ $item['label'] }}</p>
        <p class="text-3xl font-bold text-slate-900">{{ $item['value'] }}</p>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Kursus Terbaru --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-900">Kursus Terbaru</h3>
            <a href="{{ route('admin.courses.index') }}" class="text-xs text-indigo-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="divide-y divide-slate-100">
            @foreach($latestCourses as $course)
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-800 truncate">{{ $course->title }}</p>
                    <p class="text-xs text-slate-400">{{ $course->instructor->name }} • {{ $course->category->name }}</p>
                </div>
                <span class="text-xs font-medium px-2 py-1 rounded-full {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }} shrink-0">
                    {{ $course->status === 'published' ? 'Aktif' : 'Draft' }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- User Terbaru --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-900">User Terbaru</h3>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-indigo-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="divide-y divide-slate-100">
            @foreach($latestUsers as $user)
            <div class="flex items-center gap-3 px-5 py-3.5">
                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold text-xs shrink-0">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-800 truncate">{{ $user->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ $user->email }}</p>
                </div>
                <span class="text-xs font-medium px-2 py-1 rounded-full capitalize
                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'instructor' ? 'bg-violet-100 text-violet-700' : 'bg-blue-100 text-blue-700') }} shrink-0">
                    {{ $user->role }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection