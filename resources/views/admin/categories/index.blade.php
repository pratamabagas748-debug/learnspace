@extends('layouts.dashboard')
@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')
@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        Kelola User
    </a>
    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-indigo-50 text-indigo-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        Kelola Kategori
    </a>
    <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Kelola Kursus
    </a>
@endsection
@section('content')
<div class="flex items-center justify-between mb-5">
    <p class="text-slate-500 text-sm">Total {{ $categories->total() }} kategori</p>
    <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-indigo-700 transition-colors">+ Tambah Kategori</a>
</div>
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="text-left px-5 py-3 font-medium text-slate-500">Nama Kategori</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500 hidden md:table-cell">Deskripsi</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500">Kursus</th>
                <th class="px-5 py-3 font-medium text-slate-500 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($categories as $category)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-5 py-3.5 font-medium text-slate-800">{{ $category->name }}</td>
                <td class="px-5 py-3.5 text-slate-500 hidden md:table-cell text-xs">{{ Str::limit($category->description, 60) ?? '-' }}</td>
                <td class="px-5 py-3.5 text-slate-500">{{ $category->courses_count }}</td>
                <td class="px-5 py-3.5 text-right">
                    <div class="flex items-center gap-3 justify-end">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-xs text-indigo-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Hapus kategori ini?')">
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
<div class="mt-4">{{ $categories->links() }}</div>
@endsection