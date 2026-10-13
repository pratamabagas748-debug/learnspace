@extends('layouts.dashboard')
@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')
@section('page-subtitle', $category->name)
@section('sidebar-nav')
@include('admin.partials.sidebar')
@endsection

@section('content')
<div class="mb-5">
    <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Kategori
    </a>
</div>

<form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
    @csrf @method('PUT')
    <div class="max-w-lg">
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 space-y-5">
        <h2 class="font-bold text-slate-900 text-sm pb-1 border-b border-slate-100">Data Kategori</h2>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                   class="w-full px-4 py-3 border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white' }} rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
            @error('name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi <span class="text-slate-400 font-normal">(opsional)</span></label>
            <textarea name="description" rows="3"
                      class="w-full px-4 py-3 border border-slate-200 bg-slate-50 focus:bg-white rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all resize-none">{{ old('description', $category->description) }}</textarea>
            @error('description')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
        </div>

        <div class="bg-slate-50 rounded-xl p-4 text-xs text-slate-500 space-y-1">
            <p><span class="font-semibold text-slate-700">Slug:</span> {{ $category->slug }}</p>
            <p><span class="font-semibold text-slate-700">Kursus:</span> {{ $category->courses()->count() }} kursus menggunakan kategori ini</p>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold py-2.5 px-6 rounded-xl text-sm transition-all hover:shadow-lg hover:shadow-indigo-200">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.categories.index') }}" class="text-sm font-medium text-slate-500 px-4 py-2.5 rounded-xl hover:bg-slate-100 transition-colors">Batal</a>
        </div>
    </div>
    </div>
</form>
@endsection