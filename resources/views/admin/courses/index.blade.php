@extends('layouts.dashboard')
@section('title', 'Kelola Kursus')
@section('page-title', 'Kelola Kursus')
@section('page-subtitle', $courses->total() . ' kursus terdaftar')

@section('sidebar-nav')
@include('admin.partials.sidebar')
@endsection

@section('content')
<div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide">Kursus</th>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden md:table-cell">Instructor</th>
                <th class="text-center px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden lg:table-cell">Peserta</th>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide">Status</th>
                <th class="px-5 py-3.5 text-right text-xs uppercase tracking-wide font-semibold text-slate-500">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @foreach($courses as $course)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="px-5 py-4">
                    <p class="font-semibold text-slate-800">{{ Str::limit($course->title, 40) }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $course->category->name }} · {{ $course->level_label }}</p>
                </td>
                <td class="px-5 py-4 text-slate-500 text-xs hidden md:table-cell">{{ $course->instructor->name }}</td>
                <td class="px-5 py-4 text-center font-semibold text-slate-700 hidden lg:table-cell">{{ $course->enrollments->count() }}</td>
                <td class="px-5 py-4">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $course->status === 'published' ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center gap-2 justify-end opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('admin.courses.show', $course->id) }}" class="text-xs bg-indigo-50 text-indigo-700 hover:bg-indigo-100 px-2.5 py-1.5 rounded-lg font-semibold transition-colors">Detail</a>
                        <form method="POST" action="{{ route('admin.courses.destroy', $course->id) }}" onsubmit="return confirm('Hapus kursus {{ $course->title }}?')">
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
@endsection