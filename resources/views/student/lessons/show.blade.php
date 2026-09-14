@extends('layouts.dashboard')
@section('title', $lesson->title)
@section('page-title', $lesson->title)

@section('sidebar-nav')
    <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Dashboard
    </a>
    <div class="px-3 py-2 mt-2">
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-2">Materi Kursus</p>
        @foreach($course->lessons as $l)
        @php $isDone = in_array($l->id, $completedLessonIds); @endphp
        <a href="{{ route('student.lessons.show', $l->id) }}"
           class="flex items-center gap-2 py-2 text-sm {{ $l->id === $lesson->id ? 'text-indigo-700 font-semibold' : 'text-slate-600 hover:text-slate-900' }} transition-colors">
            <span class="w-5 h-5 rounded-full flex items-center justify-center shrink-0 text-xs {{ $isDone ? 'bg-emerald-100 text-emerald-600' : ($l->id === $lesson->id ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-500') }} font-bold">
                {{ $isDone ? '✓' : $l->order }}
            </span>
            <span class="line-clamp-1 text-xs">{{ $l->title }}</span>
        </a>
        @endforeach
    </div>
@endsection

@section('content')
<div class="max-w-3xl">

    {{-- Lesson Header --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 mb-5">
        <div class="flex items-center gap-2 mb-2">
            <span class="text-xs bg-indigo-100 text-indigo-700 font-semibold px-2.5 py-1 rounded-full">Materi {{ $lesson->order }}</span>
            @if($isCompleted)
                <span class="text-xs bg-emerald-100 text-emerald-700 font-semibold px-2.5 py-1 rounded-full">✓ Selesai</span>
            @endif
        </div>
        <h1 class="text-2xl font-bold text-slate-900 mb-2">{{ $lesson->title }}</h1>
        @if($lesson->description)
            <p class="text-slate-500">{{ $lesson->description }}</p>
        @endif
    </div>

    {{-- Video --}}
    @if($lesson->video_url)
    <div class="bg-black rounded-2xl overflow-hidden mb-5 aspect-video">
        <iframe src="{{ $lesson->video_url }}" class="w-full h-full" allowfullscreen></iframe>
    </div>
    @endif

    {{-- Content --}}
    @if($lesson->content)
    <div class="bg-white border border-slate-200 rounded-2xl p-6 mb-5 prose prose-slate max-w-none">
        {!! nl2br(e($lesson->content)) !!}
    </div>
    @endif

    {{-- Navigation & Complete Button --}}
    <div class="flex items-center justify-between gap-4 bg-white border border-slate-200 rounded-2xl p-4">
        <div>
            @if($prevLesson)
            <a href="{{ route('student.lessons.show', $prevLesson->id) }}"
               class="flex items-center gap-2 text-sm text-slate-600 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Materi Sebelumnya
            </a>
            @endif
        </div>

        <div class="flex items-center gap-3">
            @if(!$isCompleted)
                <form method="POST" action="{{ route('student.lessons.complete', $lesson->id) }}">
                    @csrf
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Tandai Selesai
                    </button>
                </form>
            @endif

            @if($nextLesson)
            <a href="{{ route('student.lessons.show', $nextLesson->id) }}"
               class="flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                Materi Berikutnya
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
            @endif
        </div>
    </div>
</div>
@endsection