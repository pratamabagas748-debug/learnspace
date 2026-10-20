@props(['course'])

@php
$levelColor = match($course->level) {
    'beginner'     => 'bg-emerald-500/90 text-white',
    'intermediate' => 'bg-amber-500/90 text-white',
    'advanced'     => 'bg-rose-500/90 text-white',
    default        => 'bg-slate-700 text-white',
};
@endphp

<a href="{{ route('courses.show', $course->slug) }}"
   class="bg-white rounded-3xl border border-slate-200/80 hover:border-indigo-400 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 overflow-hidden flex flex-col group cursor-pointer transform hover:-translate-y-1">

    {{-- Thumbnail Image Container --}}
    <div class="aspect-video bg-slate-900 relative overflow-hidden">
        <img src="{{ $course->thumbnail_url }}"
             alt="{{ $course->title }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-black/20"></div>

        {{-- Top Badges Row --}}
        <div class="absolute top-3 left-3 right-3 flex items-center justify-between z-10">
            <span class="text-[11px] font-extrabold px-3 py-1 rounded-full backdrop-blur-md {{ $levelColor }} shadow-md border border-white/20">
                {{ $course->level_label }}
            </span>

            <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-full backdrop-blur-md bg-emerald-500/90 text-white border border-white/20 shadow-md flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                Min. 3 Modul Gratis
            </span>
        </div>

        {{-- Category Pill (Bottom Left of Thumbnail) --}}
        <div class="absolute bottom-3 left-3 z-10">
            <span class="text-[10px] font-bold text-white bg-black/40 backdrop-blur-md px-2.5 py-1 rounded-lg border border-white/10 uppercase tracking-wider">
                {{ $course->category->name ?? '-' }}
            </span>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-5 flex flex-col flex-1">
        {{-- Title --}}
        <h3 class="font-extrabold text-slate-900 mb-2 line-clamp-2 leading-snug group-hover:text-indigo-600 transition-colors flex-1 text-base">
            {{ $course->title }}
        </h3>

        {{-- Instructor with Avatar --}}
        <div class="flex items-center gap-2.5 my-3">
            @if($course->instructor->avatar_url)
                <img src="{{ $course->instructor->avatar_url }}" class="w-6 h-6 rounded-full object-cover ring-2 ring-indigo-100" alt="{{ $course->instructor->name }}">
            @else
                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-[10px] font-bold text-white">
                    {{ strtoupper(substr($course->instructor->name ?? '?', 0, 1)) }}
                </div>
            @endif
            <p class="text-xs font-semibold text-slate-600 truncate">{{ $course->instructor->name ?? '-' }}</p>
            <span class="ml-auto text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Gratis</span>
        </div>

        {{-- Meta --}}
        <div class="flex items-center gap-4 text-xs font-medium text-slate-400 pt-3 border-t border-slate-100">
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                {{ $course->lessons_count ?? $course->lessons->count() }} modul
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $course->formatted_duration }}
            </span>
            <span class="flex items-center gap-1.5 ml-auto text-slate-500 font-semibold">
                <svg class="w-3.5 h-3.5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $course->enrollments_count ?? $course->enrollments->count() }} siswa
            </span>
        </div>
    </div>
</a>