@extends('layouts.dashboard')
@section('title', 'Kursus Saya')
@section('page-title', 'Kursus Saya')
@section('page-subtitle', $courses->total() . ' kursus ditemukan')

@section('topbar-actions')
<a href="{{ route('instructor.courses.create') }}"
   class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition-all hover:shadow-md hover:shadow-indigo-200">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
    Buat Kursus
</a>
@endsection

@section('sidebar-nav')
<x-nav-item href="{{ route('instructor.dashboard') }}" :active="false"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>'>
    Dashboard
</x-nav-item>
<div class="mt-4 mb-1 px-3"><p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Konten</p></div>
<x-nav-item href="{{ route('instructor.courses.index') }}" :active="true"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>'>
    Kursus Saya
</x-nav-item>
<x-nav-item href="{{ route('instructor.courses.create') }}" :active="false"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>'>
    Tambah Kursus
</x-nav-item>
@endsection

@section('content')
@if($courses->isNotEmpty())
<div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide">Kursus</th>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden lg:table-cell">Kategori</th>
                <th class="text-center px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden md:table-cell">Materi</th>
                <th class="text-center px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden md:table-cell">Peserta</th>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide">Status</th>
                <th class="px-5 py-3.5 text-right text-xs uppercase tracking-wide font-semibold text-slate-500">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @foreach($courses as $course)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="px-5 py-4">
                    <p class="font-semibold text-slate-800">{{ Str::limit($course->title, 45) }}</p>
                    <p class="text-xs text-slate-400 mt-0.5 capitalize">{{ $course->level_label }}</p>
                </td>
                <td class="px-5 py-4 text-slate-500 hidden lg:table-cell text-xs">{{ $course->category->name }}</td>
                <td class="px-5 py-4 text-center text-slate-700 font-semibold hidden md:table-cell">{{ $course->lessons->count() }}</td>
                <td class="px-5 py-4 text-center text-slate-700 font-semibold hidden md:table-cell">{{ $course->enrollments->count() }}</td>
                <td class="px-5 py-4">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $course->status === 'published' ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center gap-2 justify-end opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('instructor.lessons.create', $course->id) }}"
                           class="text-xs bg-cyan-50 text-cyan-700 hover:bg-cyan-100 px-2.5 py-1.5 rounded-lg font-semibold transition-colors whitespace-nowrap">
                            + Materi
                        </a>
                        <a href="{{ route('instructor.courses.students', $course->id) }}"
                           class="text-xs bg-slate-100 text-slate-700 hover:bg-slate-200 px-2.5 py-1.5 rounded-lg font-semibold transition-colors">
                            Peserta
                        </a>
                        <a href="{{ route('instructor.courses.edit', $course->id) }}"
                           class="text-xs bg-indigo-50 text-indigo-700 hover:bg-indigo-100 px-2.5 py-1.5 rounded-lg font-semibold transition-colors">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('instructor.courses.destroy', $course->id) }}" onsubmit="return confirm('Yakin hapus kursus ini? Semua materi dan data peserta akan ikut terhapus.')">
                            @csrf @method('DELETE')
                            <button class="text-xs bg-red-50 text-red-600 hover:bg-red-100 px-2.5 py-1.5 rounded-lg font-semibold transition-colors">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($courses->hasPages())
<div class="mt-5">{{ $courses->links() }}</div>
@endif

@else
<div class="text-center py-20 bg-white rounded-2xl border border-slate-100 shadow-sm">
    <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
    </div>
    <p class="font-bold text-slate-700 mb-1">Belum ada kursus</p>
    <p class="text-slate-400 text-sm mb-5">Buat kursus pertama Anda dan mulai berbagi ilmu.</p>
    <a href="{{ route('instructor.courses.create') }}"
       class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Buat Kursus Pertama
    </a>
</div>
@endif
@endsection