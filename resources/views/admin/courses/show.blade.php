@extends('layouts.dashboard')
@section('title', $course->title)
@section('page-title', $course->title)
@section('page-subtitle', 'Detail kursus · ' . $course->instructor->name)

@section('sidebar-nav')
@include('admin.partials.sidebar')
@endsection

@section('content')
<div class="mb-5">
    <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Kursus
    </a>
</div>

<div class="max-w-4xl grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        {{-- Course Info --}}
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6">
            <h2 class="font-bold text-slate-900 mb-4 text-sm border-b border-slate-100 pb-2">Informasi Kursus</h2>
            <dl class="grid grid-cols-2 gap-4 text-sm">
                @foreach([
                    ['Kategori', $course->category->name],
                    ['Instructor', $course->instructor->name],
                    ['Level', $course->level_label],
                    ['Durasi', $course->formatted_duration],
                ] as $info)
                <div class="bg-slate-50 rounded-xl p-3">
                    <dt class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">{{ $info[0] }}</dt>
                    <dd class="font-semibold text-slate-800">{{ $info[1] }}</dd>
                </div>
                @endforeach
                <div class="bg-slate-50 rounded-xl p-3">
                    <dt class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Status</dt>
                    <dd><span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($course->status) }}</span></dd>
                </div>
                <div class="bg-slate-50 rounded-xl p-3">
                    <dt class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Total Peserta</dt>
                    <dd class="font-semibold text-slate-800">{{ $course->students->count() }} orang</dd>
                </div>
            </dl>
            <div class="mt-5 pt-4 border-t border-slate-100">
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-2">Deskripsi</p>
                <p class="text-slate-600 text-sm leading-relaxed">{{ $course->description }}</p>
            </div>
        </div>

        {{-- Lessons --}}
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="font-bold text-slate-900 text-sm">Daftar Materi</h2>
                <span class="text-xs bg-slate-100 text-slate-600 font-semibold px-2.5 py-1 rounded-full">{{ $course->lessons->count() }}</span>
            </div>
            @forelse($course->lessons as $lesson)
            <div class="flex items-center gap-3 px-6 py-3.5 border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors">
                <div class="w-7 h-7 bg-indigo-50 rounded-lg flex items-center justify-center text-xs font-bold text-indigo-600 shrink-0">{{ $lesson->order }}</div>
                <span class="text-sm text-slate-700 flex-1 font-medium">{{ $lesson->title }}</span>
                @if($lesson->duration)<span class="text-slate-400 text-xs shrink-0">{{ $lesson->duration }} mnt</span>@endif
            </div>
            @empty
            <p class="text-slate-400 text-sm text-center py-8">Belum ada materi.</p>
            @endforelse
        </div>
    </div>

    {{-- Sidebar: Peserta --}}
    <div>
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden sticky top-20">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="font-bold text-slate-900 text-sm">Peserta</h2>
                <span class="text-xs bg-slate-100 text-slate-600 font-semibold px-2.5 py-1 rounded-full">{{ $course->students->count() }}</span>
            </div>
            @forelse($course->students->take(15) as $student)
            <div class="flex items-center gap-2.5 px-5 py-3 border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors">
                @if($student->avatar)
                    <img src="{{ asset('storage/' . $student->avatar) }}" class="w-7 h-7 rounded-full object-cover shrink-0" alt="">
                @else
                    <div class="w-7 h-7 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-bold text-indigo-700 shrink-0">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </div>
                @endif
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-slate-800 truncate">{{ $student->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ $student->email }}</p>
                </div>
            </div>
            @empty
            <p class="text-slate-400 text-sm text-center py-8">Belum ada peserta.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection