@extends('layouts.dashboard')
@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')
@section('page-subtitle', $categories->total() . ' kategori tersedia')

@section('topbar-actions')
<a href="{{ route('admin.categories.create') }}"
   class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition-all hover:shadow-md hover:shadow-indigo-200">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
    Tambah Kategori
</a>
@endsection

@section('sidebar-nav')
@include('admin.partials.sidebar')
@endsection

@section('content')
<div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide">Kategori</th>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden md:table-cell">Deskripsi</th>
                <th class="text-center px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide">Kursus</th>
                <th class="px-5 py-3.5 text-right text-xs uppercase tracking-wide font-semibold text-slate-500">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @foreach($categories as $category)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </div>
                        <span class="font-semibold text-slate-800">{{ $category->name }}</span>
                    </div>
                </td>
                <td class="px-5 py-4 text-slate-400 hidden md:table-cell text-xs max-w-xs truncate">{{ $category->description ?? '-' }}</td>
                <td class="px-5 py-4 text-center font-semibold text-slate-700">{{ $category->courses_count }}</td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center gap-2 justify-end opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-xs bg-indigo-50 text-indigo-700 hover:bg-indigo-100 px-2.5 py-1.5 rounded-lg font-semibold transition-colors">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Hapus kategori {{ $category->name }}? Kursus di dalamnya tidak akan terhapus.')">
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
@if($categories->hasPages())
<div class="mt-5">{{ $categories->links() }}</div>
@endif
@endsection