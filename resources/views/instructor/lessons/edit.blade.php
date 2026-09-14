@extends('layouts.dashboard')
@section('title', 'Edit Materi')
@section('page-title', 'Edit Materi')
@section('sidebar-nav')
    <a href="{{ route('instructor.courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Kursus
    </a>
@endsection
@section('content')
<form method="POST" action="{{ route('instructor.lessons.update', $lesson->id) }}">
    @csrf @method('PUT')
    <div class="max-w-2xl">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Judul Materi <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $lesson->title ?? '') }}" required
                   class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi Singkat</label>
            <input type="text" name="description" value="{{ old('description', $lesson->description ?? '') }}"
                   class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Konten Materi</label>
            <textarea name="content" rows="8"
                      class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none font-mono">{{ old('content', $lesson->content ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">URL Video (opsional)</label>
            <input type="url" name="video_url" value="{{ old('video_url', $lesson->video_url ?? '') }}"
                   placeholder="https://youtube.com/embed/..."
                   class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('video_url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Urutan <span class="text-red-500">*</span></label>
                <input type="number" name="order" value="{{ old('order', $lesson->order ?? 1) }}" min="1" required
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Durasi (menit)</label>
                <input type="number" name="duration" value="{{ old('duration', $lesson->duration ?? '') }}" min="1"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">Simpan</button>
            <a href="{{ route('instructor.courses.index') }}" class="text-sm text-slate-600 px-4 py-2.5 rounded-xl hover:bg-slate-100 transition-colors">Batal</a>
        </div>
    </div>
</div>
</form>
@endsection