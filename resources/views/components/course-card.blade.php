@props(['course'])

@php
$levelColors = [
    'beginner'     => 'bg-emerald-100 text-emerald-700',
    'intermediate' => 'bg-amber-100 text-amber-700',
    'advanced'     => 'bg-red-100 text-red-700',
];
$levelColor = $levelColors[$course->level] ?? 'bg-slate-100 text-slate-600';
@endphp

<a href="{{ route('courses.show', $course->slug) }}"
   class="bg-white rounded-2xl border border-slate-100 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-100/50 transition-all duration-300 overflow-hidden flex flex-col group cursor-pointer">
    {{-- Thumbnail --}}
    <div class="aspect-video bg-gradient-to-br from-indigo-500 to-violet-600 relative overflow-hidden">
        @if ($course->thumbnail)
            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="absolute inset-0 flex items-center justify-center">
                <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        @endif
        {{-- Level badge --}}
        <span class="absolute top-3 left-3 text-xs font-bold px-2.5 py-1 rounded-full {{ $levelColor }} shadow-sm">
            {{ $course->level_label }}
        </span>
    </div>

    {{-- Content --}}
    <div class="p-5 flex flex-col flex-1">
        {{-- Category --}}
        <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2">
            {{ $course->category->name ?? '-' }}
        </span>

        {{-- Title --}}
        <h3 class="font-bold text-slate-800 mb-1.5 line-clamp-2 leading-snug group-hover:text-indigo-700 transition-colors flex-1">
            {{ $course->title }}
        </h3>

        {{-- Instructor --}}
        <div class="flex items-center gap-2 mb-4">
            @if($course->instructor->avatar ?? false)
                <img src="{{ asset('storage/' . $course->instructor->avatar) }}" class="w-5 h-5 rounded-full object-cover" alt="">
            @else
                <div class="w-5 h-5 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-500">
                    {{ strtoupper(substr($course->instructor->name ?? '?', 0, 1)) }}
                </div>
            @endif
            <p class="text-xs text-slate-500">{{ $course->instructor->name ?? '-' }}</p>
        </div>

        {{-- Meta --}}
        <div class="flex items-center gap-4 text-xs text-slate-400 pt-3 border-t border-slate-50">
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
            <span class="flex items-center gap-1 ml-auto">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $course->enrollments_count ?? $course->enrollments->count() }}
            </span>
        </div>
    </div>
</a>