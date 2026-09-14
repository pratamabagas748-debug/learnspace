@extends('layouts.app')
@section('title', 'Semua Kursus')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Semua Kursus</h1>
        <p class="text-slate-500 mt-1">Temukan kursus yang tepat untuk tujuan Anda</p>
    </div>

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('courses.index') }}" class="mb-8">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari kursus..."
                       class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-xl text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
            <select name="category" class="px-4 py-2.5 border border-slate-300 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="level" class="px-4 py-2.5 border border-slate-300 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                <option value="">Semua Level</option>
                <option value="beginner" {{ request('level') === 'beginner' ? 'selected' : '' }}>Pemula</option>
                <option value="intermediate" {{ request('level') === 'intermediate' ? 'selected' : '' }}>Menengah</option>
                <option value="advanced" {{ request('level') === 'advanced' ? 'selected' : '' }}>Mahir</option>
            </select>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-colors">
                Filter
            </button>
            @if(request()->hasAny(['search','category','level']))
                <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-2.5 text-sm text-slate-600 hover:text-red-600 transition-colors">
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- Results Count --}}
    <p class="text-sm text-slate-500 mb-6">Menampilkan {{ $courses->total() }} kursus</p>

    {{-- Course Grid --}}
    @if($courses->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($courses as $course)
                <x-course-card :course="$course"/>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $courses->links() }}
        </div>
    @else
        <div class="text-center py-20">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-lg font-semibold text-slate-600 mb-1">Kursus tidak ditemukan</h3>
            <p class="text-slate-400 text-sm">Coba kata kunci atau filter yang berbeda</p>
        </div>
    @endif
</div>
@endsection