@extends('layouts.dashboard')
@section('title', $lesson->title)
@section('page-title', $lesson->title)
@section('page-subtitle', $course->title)

@section('sidebar-nav')
<x-nav-item href="{{ route('student.courses.show', $course->slug) }}" :active="false"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>'>
    Kembali ke Kursus
</x-nav-item>

<div class="mt-4 mb-2 px-3">
    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Daftar Materi</p>
</div>

@foreach($course->lessons as $l)
@php $isDone = in_array($l->id, $completedLessonIds); @endphp
<a href="{{ route('student.lessons.show', $l->id) }}"
   class="sidebar-item flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm transition-all
          {{ $l->id === $lesson->id ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
    <span class="w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold
        {{ $l->id === $lesson->id ? 'bg-white/20 text-white' : ($isDone ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500') }}">
        {{ $isDone ? '✓' : $l->order }}
    </span>
    <span class="line-clamp-1 text-xs font-medium">{{ $l->title }}</span>
</a>
@endforeach
@endsection

@section('content')
<div class="max-w-3xl">

    {{-- Lesson Header --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 mb-5">
        <div class="flex flex-wrap items-center gap-2 mb-3">
            <span class="text-xs bg-indigo-100 text-indigo-700 font-bold px-2.5 py-1 rounded-full">Materi {{ $lesson->order }}</span>
            @if($isCompleted)
                <span class="text-xs bg-emerald-100 text-emerald-700 font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    Selesai
                </span>
            @endif
            @if($lesson->duration)
                <span class="text-xs bg-slate-100 text-slate-600 font-medium px-2.5 py-1 rounded-full flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $lesson->duration }} menit
                </span>
            @endif
        </div>
        <h1 class="text-xl font-extrabold text-slate-900 leading-tight">{{ $lesson->title }}</h1>
        @if($lesson->description)
            <p class="text-slate-500 text-sm mt-2 leading-relaxed">{{ $lesson->description }}</p>
        @endif
    </div>

    {{-- Video Player --}}
    @if($lesson->video_url)
    <div class="bg-black rounded-2xl overflow-hidden mb-5 shadow-xl aspect-video">
        <iframe src="{{ $lesson->video_url }}" class="w-full h-full" allowfullscreen></iframe>
    </div>
    @endif

    {{-- Content Body --}}
    @if($lesson->content)
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 mb-5">
        <div class="prose prose-slate prose-sm max-w-none text-slate-700 leading-relaxed">
            {!! nl2br(e($lesson->content)) !!}
        </div>
    </div>
    @endif

    {{-- Navigation Bar --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-4 flex items-center justify-between gap-4">
        <div class="min-w-0">
            @if($prevLesson)
            <a href="{{ route('student.lessons.show', $prevLesson->id) }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span class="hidden sm:inline truncate max-w-xs">{{ $prevLesson->title }}</span>
                <span class="sm:hidden">Sebelumnya</span>
            </a>
            @endif
        </div>

        <div class="flex items-center gap-3 shrink-0">
            @if(!$isCompleted)
                <form method="POST" action="{{ route('student.lessons.complete', $lesson->id) }}">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition-all hover:shadow-lg hover:shadow-emerald-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Tandai Selesai
                    </button>
                </form>
            @else
                <span class="inline-flex items-center gap-1.5 text-sm font-bold text-emerald-600 bg-emerald-50 px-4 py-2.5 rounded-xl">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    Sudah Selesai
                </span>
            @endif

            @if($nextLesson)
            <a href="{{ route('student.lessons.show', $nextLesson->id) }}"
               class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                <span class="hidden sm:inline truncate max-w-xs">{{ $nextLesson->title }}</span>
                <span class="sm:hidden">Berikutnya</span>
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            @endif
        </div>
    </div>
</div>
@endsection