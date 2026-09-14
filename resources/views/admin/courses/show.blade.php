@extends('layouts.dashboard')
@section('title', $course->title)
@section('page-title', $course->title)
@section('sidebar-nav')
    <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Kursus
    </a>
@endsection
@section('content')
<div class="max-w-4xl grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-4">
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <h2 class="font-bold text-slate-900 mb-3">Informasi Kursus</h2>
            <dl class="grid grid-cols-2 gap-3 text-sm">
                <dt class="text-slate-500">Kategori</dt><dd class="font-medium text-slate-800">{{ $course->category->name }}</dd>
                <dt class="text-slate-500">Instructor</dt><dd class="font-medium text-slate-800">{{ $course->instructor->name }}</dd>
                <dt class="text-slate-500">Level</dt><dd class="font-medium text-slate-800">{{ $course->level_label }}</dd>
                <dt class="text-slate-500">Durasi</dt><dd class="font-medium text-slate-800">{{ $course->formatted_duration }}</dd>
                <dt class="text-slate-500">Status</dt><dd><span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($course->status) }}</span></dd>
                <dt class="text-slate-500">Total Peserta</dt><dd class="font-medium text-slate-800">{{ $course->students->count() }}</dd>
            </dl>
            <div class="mt-4 pt-4 border-t border-slate-100">
                <p class="text-slate-500 text-xs mb-1">Deskripsi</p>
                <p class="text-slate-700 text-sm">{{ $course->description }}</p>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <h2 class="font-bold text-slate-900 mb-3">Daftar Materi ({{ $course->lessons->count() }})</h2>
            @forelse($course->lessons as $lesson)
            <div class="flex items-center gap-3 py-2.5 border-b border-slate-100 last:border-0 text-sm">
                <span class="w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center text-xs font-bold text-indigo-600 shrink-0">{{ $lesson->order }}</span>
                <span class="text-slate-700 flex-1">{{ $lesson->title }}</span>
                @if($lesson->duration)<span class="text-slate-400 text-xs">{{ $lesson->duration }} mnt</span>@endif
            </div>
            @empty
            <p class="text-slate-400 text-sm">Belum ada materi.</p>
            @endforelse
        </div>
    </div>
    <div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5">
            <h2 class="font-bold text-slate-900 mb-3">Peserta ({{ $course->students->count() }})</h2>
            @forelse($course->students->take(10) as $student)
            <div class="flex items-center gap-2.5 py-2 border-b border-slate-100 last:border-0">
                <div class="w-7 h-7 bg-indigo-100 rounded-full flex items-center justify-center text-xs font-bold text-indigo-700 shrink-0">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-slate-800 truncate">{{ $student->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ $student->email }}</p>
                </div>
            </div>
            @empty
            <p class="text-slate-400 text-sm">Belum ada peserta.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection