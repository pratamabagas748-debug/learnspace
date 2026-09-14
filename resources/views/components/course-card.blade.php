@props(['course'])

@php
$levelColors = [
    'beginner'     => 'bg-emerald-100 text-emerald-700',
    'intermediate' => 'bg-amber-100 text-amber-700',
    'advanced'     => 'bg-red-100 text-red-700',
];
$levelColor = $levelColors[$course->level] ?? 'bg-slate-100 text-slate-600';
@endphp

<div class="bg-white rounded-2xl border border-slate-200 hover:border-indigo-300 hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col">
    {{-- Thumbnail --}}
    <div class="aspect-video bg-gradient-to-br from-indigo-500 to-violet-600 relative overflow-hidden">
        @if ($course->thumbnail)
            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
        @else
            <div class="absolute inset-0 flex items-center justify-center">
                <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        @endif
        {{-- Level badge --}}
        <span class="absolute top-3 left-3 text-xs font-semibold px-2.5 py-1 rounded-full {{ $levelColor }}">
            {{ $course->level_label }}
        </span>
    </div>

    {{-- Content --}}
    <div class="p-5 flex flex-col flex-1">
        {{-- Category --}}
        <span class="text-xs font-medium text-indigo-600 uppercase tracking-wide mb-2">
            {{ $course->category->name ?? '-' }}
        </span>

        {{-- Title --}}
        <h3 class="font-semibold text-slate-800 mb-2 line-clamp-2 leading-snug flex-1">{{ $course->title }}</h3>

        {{-- Instructor --}}
        <p class="text-sm text-slate-500 mb-4">oleh {{ $course->instructor->name ?? '-' }}</p>

        {{-- Meta --}}
        <div class="flex items-center gap-4 text-xs text-slate-500 mb-4 border-t border-slate-100 pt-4">
            <span class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                {{ $course->lessons_count ?? $course->lessons->count() }} materi
            </span>
            <span class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $course->formatted_duration }}
            </span>
        </div>

        {{-- CTA Button --}}
        <a href="{{ route('courses.show', $course->slug) }}"
           class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2.5 rounded-xl transition-colors">
            Lihat Detail
        </a>
    </div>
</div>