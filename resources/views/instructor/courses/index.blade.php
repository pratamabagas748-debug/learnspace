@extends('layouts.dashboard')
@section('title', 'Kursus Saya')
@section('page-title', 'Kursus Saya')

@section('sidebar-nav')
    <a href="{{ route('instructor.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('instructor.courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-indigo-50 text-indigo-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Kursus Saya
    </a>
    <a href="{{ route('instructor.courses.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Kursus
    </a>
@endsection

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-slate-500 text-sm">{{ $courses->total() }} kursus ditemukan</p>
    <a href="{{ route('instructor.courses.create') }}" class="bg-indigo-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-indigo-700 transition-colors">+ Buat Kursus Baru</a>
</div>

@if($courses->isNotEmpty())
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="text-left px-5 py-3 font-medium text-slate-500">Kursus</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500 hidden lg:table-cell">Kategori</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500 hidden md:table-cell">Materi</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500 hidden md:table-cell">Peserta</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500">Status</th>
                <th class="px-5 py-3 font-medium text-slate-500 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($courses as $course)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-5 py-4">
                    <p class="font-medium text-slate-800">{{ Str::limit($course->title, 45) }}</p>
                    <p class="text-xs text-slate-400 mt-0.5 capitalize">{{ $course->level_label }}</p>
                </td>
                <td class="px-5 py-4 text-slate-500 hidden lg:table-cell">{{ $course->category->name }}</td>
                <td class="px-5 py-4 text-slate-500 hidden md:table-cell">{{ $course->lessons->count() }}</td>
                <td class="px-5 py-4 text-slate-500 hidden md:table-cell">{{ $course->enrollments->count() }}</td>
                <td class="px-5 py-4">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $course->status === 'published' ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center gap-3 justify-end">
                        <a href="{{ route('instructor.lessons.create', $course->id) }}" class="text-xs text-cyan-600 hover:underline">+ Materi</a>
                        <a href="{{ route('instructor.courses.edit', $course->id) }}" class="text-xs text-indigo-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('instructor.courses.destroy', $course->id) }}" onsubmit="return confirm('Yakin hapus kursus ini?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:underline">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $courses->links() }}</div>
@else
<div class="text-center py-20 bg-white rounded-2xl border border-slate-200">
    <p class="text-slate-500 mb-4">Anda belum memiliki kursus.</p>
    <a href="{{ route('instructor.courses.create') }}" class="bg-indigo-600 text-white text-sm font-medium px-6 py-2.5 rounded-xl hover:bg-indigo-700 transition-colors">Buat Kursus Pertama</a>
</div>
@endif
@endsection