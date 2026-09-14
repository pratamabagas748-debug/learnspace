@extends('layouts.dashboard')
@section('title', 'Edit Kursus')
@section('page-title', 'Edit Kursus')
@section('sidebar-nav')
    <a href="{{ route('instructor.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('instructor.courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Kursus Saya
    </a>
@endsection
@section('content')
<form method="POST" action="{{ route('instructor.courses.update', $course->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="max-w-2xl">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Judul Kursus <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $course->title ?? '') }}" required
                   class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
            <select name="category_id" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $course->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" rows="4" required
                      class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('description', $course->description ?? '') }}</textarea>
            @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Level <span class="text-red-500">*</span></label>
                <select name="level" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    <option value="beginner" {{ old('level', $course->level ?? '') === 'beginner' ? 'selected' : '' }}>Pemula</option>
                    <option value="intermediate" {{ old('level', $course->level ?? '') === 'intermediate' ? 'selected' : '' }}>Menengah</option>
                    <option value="advanced" {{ old('level', $course->level ?? '') === 'advanced' ? 'selected' : '' }}>Mahir</option>
                </select>
                @error('level')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Durasi (menit) <span class="text-red-500">*</span></label>
                <input type="number" name="duration" value="{{ old('duration', $course->duration ?? '') }}" min="1" required
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('duration')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Status</label>
            <select name="status" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                <option value="draft" {{ old('status', $course->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft (tidak terlihat publik)</option>
                <option value="published" {{ old('status', $course->status ?? '') === 'published' ? 'selected' : '' }}>Published (terlihat publik)</option>
            </select>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">Simpan</button>
            <a href="{{ route('instructor.courses.index') }}" class="text-sm text-slate-600 hover:text-slate-800 px-4 py-2.5 rounded-xl hover:bg-slate-100 transition-colors">Batal</a>
        </div>
    </div>
</div>
</form>
@endsection