@extends('layouts.dashboard')
@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')
@section('sidebar-nav')
    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
@endsection
@section('content')
<form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
    @csrf @method('PUT')
    <div class="max-w-lg">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('description', $category->description ?? '') }}</textarea>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">Simpan</button>
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-slate-600 px-4 py-2.5 rounded-xl hover:bg-slate-100 transition-colors">Batal</a>
        </div>
    </div>
</div>
</form>
@endsection