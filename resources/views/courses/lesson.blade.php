@extends('layouts.app')
@section('title', $lesson->title . ' - ' . $course->title)
@section('meta_description', Str::limit($lesson->description ?? $course->description, 160))

@section('content')
{{-- Prism.js untuk Code Syntax Highlighting Modern --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" integrity="sha512-vswe+cgvic/XBoF1OcM/31QIitRLBnoOH68GmpKKZTrIE2bfHBqltPNjUrPmDAODVMmAKWiG9XM16enNoMa3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .prose pre {
        background-color: #1e1e2e !important;
        border-radius: 0.85rem;
        padding: 1.15rem;
        position: relative;
        overflow-x: auto;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.25);
    }
    .prose code {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-size: 0.88rem;
    }
    .prose :not(pre) > code {
        background-color: #eef2ff;
        color: #4338ca;
        padding: 0.2rem 0.45rem;
        border-radius: 0.375rem;
        font-weight: 600;
        border: 1px solid #e0e7ff;
    }
    .prose h1, .prose h2, .prose h3 {
        color: #0f172a;
        font-weight: 800;
        letter-spacing: -0.02em;
    }
    .prose h2 {
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 0.5rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .prose p {
        margin-bottom: 1.25rem;
        line-height: 1.8;
    }
    .prose ul, .prose ol {
        margin-bottom: 1.25rem;
        padding-left: 1.5rem;
    }
    .prose li {
        margin-bottom: 0.5rem;
        line-height: 1.7;
    }
    .prose blockquote {
        border-left: 4px solid #6366f1;
        background-color: #f8fafc;
        padding: 0.85rem 1.25rem;
        border-radius: 0 0.75rem 0.75rem 0;
        color: #475569;
        font-style: italic;
        margin: 1.5rem 0;
    }
</style>

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6 flex-wrap">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Home</a>
        <svg class="w-3.5 h-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('courses.index') }}" class="hover:text-indigo-600 transition-colors">Kursus</a>
        <svg class="w-3.5 h-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('courses.show', $course->slug) }}" class="hover:text-indigo-600 transition-colors font-medium text-slate-700 truncate max-w-xs">{{ $course->title }}</a>
        <svg class="w-3.5 h-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-indigo-600 font-semibold truncate">Materi {{ $lesson->order }}: {{ $lesson->title }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- ==================== MAIN CONTENT (COL 8) ==================== --}}
        <div class="lg:col-span-8 space-y-6">

            {{-- Banner Preview / Status --}}
            @if($lesson->isFreePreview() && !$isEnrolled)
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 rounded-2xl p-4 sm:p-5 text-white shadow-lg shadow-emerald-900/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-extrabold uppercase tracking-wider bg-white/25 px-2 py-0.5 rounded-full">Pratinjau Terbuka</span>
                            <span class="text-xs text-emerald-100 font-medium">Materi {{ $lesson->order }} dari {{ $course->lessons->count() }}</span>
                        </div>
                        <p class="text-sm font-semibold mt-0.5">Modul ini dapat dipelajari secara bebas & gratis!</p>
                    </div>
                </div>
                @auth
                    @if(auth()->user()->isStudent())
                    <form method="POST" action="{{ route('student.courses.enroll', $course->id) }}" class="shrink-0">
                        @csrf
                        <button type="submit" class="text-xs font-bold bg-white text-emerald-700 hover:bg-emerald-50 px-4 py-2.5 rounded-xl shadow transition-all">
                            Daftar Gratis untuk Progres →
                        </button>
                    </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-xs font-bold bg-white text-emerald-700 hover:bg-emerald-50 px-4 py-2.5 rounded-xl shadow transition-all shrink-0">
                        Masuk untuk Daftar Gratis →
                    </a>
                @endauth
            </div>
            @endif

            {{-- Lesson Header Card --}}
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 sm:p-8">
                <div class="flex flex-wrap items-center gap-2.5 mb-4">
                    <span class="text-xs bg-indigo-50 border border-indigo-200/60 text-indigo-700 font-extrabold px-3 py-1 rounded-full">
                        Materi {{ $lesson->order }}
                    </span>
                    @if($lesson->isFreePreview())
                        <span class="text-xs bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold px-3 py-1 rounded-full flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                            Modul Terbuka (Gratis)
                        </span>
                    @endif
                    @if($lesson->duration)
                        <span class="text-xs bg-slate-100 text-slate-600 font-semibold px-3 py-1 rounded-full flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $lesson->duration }} menit baca
                        </span>
                    @endif
                    @if($isCompleted)
                        <span class="text-xs bg-emerald-500 text-white font-bold px-3 py-1 rounded-full flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Sudah Selesai
                        </span>
                    @endif
                </div>

                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                    {{ $lesson->title }}
                </h1>

                @if($lesson->description)
                <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed border-l-2 border-indigo-400 pl-3 italic">
                    {{ $lesson->description }}
                </p>
                @endif
            </div>

            {{-- Video Player (jika ada) --}}
            @if($lesson->video_url)
            <div class="bg-black rounded-2xl overflow-hidden shadow-xl aspect-video">
                <iframe src="{{ $lesson->video_url }}" class="w-full h-full" allowfullscreen></iframe>
            </div>
            @endif

            {{-- Module Body with Markdown Rendering --}}
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 sm:p-10">
                <div class="prose prose-slate max-w-none text-slate-700">
                    {!! \Illuminate\Support\Str::markdown($lesson->content ?? 'Materi belum diisi.') !!}
                </div>
            </div>

            {{-- Interactive Live Code Playground --}}
            <x-code-playground :course="$course" :lesson="$lesson" />

            {{-- Navigation Bottom Bar --}}
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="w-full sm:w-auto">
                    @if($prevLesson)
                    <a href="{{ route('courses.lessons.show', [$course->slug, $prevLesson->id]) }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-slate-700 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Materi Sebelumnya</span>
                    </a>
                    @else
                    <a href="{{ route('courses.show', $course->slug) }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
                        ← Kembali ke Silabus Kursus
                    </a>
                    @endif
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                    @auth
                        @if($isEnrolled && !$isCompleted)
                        <form method="POST" action="{{ route('student.lessons.complete', $lesson->id) }}">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white text-xs sm:text-sm font-bold px-4 sm:px-5 py-2.5 rounded-xl transition-all shadow hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Tandai Selesai
                            </button>
                        </form>
                        @endif
                    @endauth

                    @if($nextLesson)
                        @php
                            $nextCanOpen = $isEnrolled || $nextLesson->isFreePreview();
                        @endphp
                        @if($nextCanOpen)
                        <a href="{{ route('courses.lessons.show', [$course->slug, $nextLesson->id]) }}"
                           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs sm:text-sm font-bold px-5 py-2.5 rounded-xl transition-all shadow-md shadow-indigo-100">
                            <span>Materi Berikutnya</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        @else
                        <a href="{{ route('courses.show', $course->slug) }}#daftar-kursus"
                           class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-xs sm:text-sm font-bold px-5 py-2.5 rounded-xl transition-all">
                            <span>Daftar untuk Lanjut Modul {{ $nextLesson->order }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </a>
                        @endif
                    @else
                        <a href="{{ route('courses.show', $course->slug) }}"
                           class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold px-5 py-2.5 rounded-xl transition-all">
                            <span>Selesai Seluruh Modul 🎉</span>
                        </a>
                    @endif
                </div>
            </div>

        </div>

        {{-- ==================== SIDEBAR CURRICULUM (COL 4) ==================== --}}
        <div class="lg:col-span-4">
            <div class="sticky top-20 space-y-5">

                {{-- Course Summary Card --}}
                <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm p-5 overflow-hidden">
                    <a href="{{ route('courses.show', $course->slug) }}" class="group block">
                        <div class="aspect-video rounded-2xl overflow-hidden mb-3.5 relative shadow-sm">
                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            <span class="absolute bottom-2.5 left-2.5 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-black/60 backdrop-blur-md text-white border border-white/20">
                                {{ $course->level_label }}
                            </span>
                        </div>
                        <span class="text-[11px] font-extrabold text-indigo-600 uppercase tracking-wider">{{ $course->category->name }}</span>
                        <h3 class="font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors text-base mt-1 leading-snug">
                            {{ $course->title }}
                        </h3>
                    </a>

                    <div class="flex items-center gap-3 mt-4 pt-4 border-t border-slate-100 text-xs text-slate-500">
                        <span><strong>{{ $course->lessons->count() }}</strong> Modul</span>
                        <span>•</span>
                        <span><strong>{{ $course->formatted_duration }}</strong></span>
                        <span>•</span>
                        <span class="text-emerald-600 font-bold">Min. 3 Gratis</span>
                    </div>

                    @if(!$isEnrolled)
                    <div class="mt-4 pt-3 border-t border-slate-100">
                        @auth
                            @if(auth()->user()->isStudent())
                            <form method="POST" action="{{ route('student.courses.enroll', $course->id) }}">
                                @csrf
                                <button type="submit" class="w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-3 rounded-xl transition-all shadow-md shadow-indigo-200">
                                    Daftar Kursus Ini — Gratis
                                </button>
                            </form>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-3 rounded-xl transition-all shadow-md shadow-indigo-200">
                                Daftar Gratis untuk Akses Penuh
                            </a>
                        @endauth
                    </div>
                    @endif
                </div>

                {{-- Modules List --}}
                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h4 class="font-bold text-sm text-slate-900">Silabus Pembelajaran</h4>
                        <span class="text-xs text-slate-500 bg-slate-100 px-2.5 py-0.5 rounded-full font-semibold">{{ $course->lessons->count() }} Modul</span>
                    </div>

                    <div class="divide-y divide-slate-100 max-h-[500px] overflow-y-auto">
                        @foreach($course->lessons as $l)
                        @php
                            $isActive = $l->id === $lesson->id;
                            $canAccess = $isEnrolled || $l->isFreePreview();
                            $isDone = in_array($l->id, $completedLessonIds);
                        @endphp
                        @if($canAccess)
                        <a href="{{ route('courses.lessons.show', [$course->slug, $l->id]) }}"
                           class="flex items-start gap-3 p-3.5 transition-colors {{ $isActive ? 'bg-indigo-50/80 border-l-4 border-indigo-600 pl-2.5' : 'hover:bg-slate-50' }}">
                            <div class="w-6 h-6 rounded-lg flex items-center justify-center shrink-0 text-xs font-bold mt-0.5
                                {{ $isActive ? 'bg-indigo-600 text-white' : ($isDone ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600') }}">
                                {{ $isDone ? '✓' : $l->order }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-semibold leading-snug {{ $isActive ? 'text-indigo-900 font-bold' : 'text-slate-800' }}">
                                    {{ $l->title }}
                                </p>
                                <div class="flex items-center gap-2 mt-1">
                                    @if($l->duration)
                                    <span class="text-[11px] text-slate-400">{{ $l->duration }} mnt</span>
                                    @endif
                                    @if($l->isFreePreview() && !$isEnrolled)
                                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.2 rounded">Gratis</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @else
                        <div class="flex items-start gap-3 p-3.5 opacity-60 bg-slate-50/40 cursor-not-allowed">
                            <div class="w-6 h-6 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center shrink-0 text-xs font-bold mt-0.5">
                                {{ $l->order }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-medium text-slate-500 leading-snug">{{ $l->title }}</p>
                                <div class="flex items-center gap-1 mt-1 text-[11px] text-slate-400">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    <span>Terkunci (Daftar kursus)</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

{{-- Prism JS Script untuk Code Highlight --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js" integrity="sha512-7Z9J3l1+EYfeaPKcGXu3MS/7T+w1NbiAxoLA/UElb3bQU1/2GlWDAJDd84UW12eFQfcIohTCv7DAaaRpTMUWhw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
<script>
    // Tambahkan tombol Salin Kode (Copy Code) otomatis ke semua pre code
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.prose pre').forEach(function(pre) {
            var btn = document.createElement('button');
            btn.className = 'absolute top-3 right-3 text-[11px] font-semibold bg-white/10 hover:bg-white/20 text-slate-200 hover:text-white px-2.5 py-1 rounded-md transition-all border border-white/10 flex items-center gap-1';
            btn.innerHTML = '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg> Salin';
            btn.onclick = function() {
                var code = pre.querySelector('code');
                var text = code ? code.innerText : pre.innerText;
                navigator.clipboard.writeText(text).then(function() {
                    btn.innerHTML = '✓ Tersalin!';
                    btn.classList.add('text-emerald-400');
                    setTimeout(function() {
                        btn.innerHTML = '<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg> Salin';
                        btn.classList.remove('text-emerald-400');
                    }, 2000);
                });
            };
            pre.appendChild(btn);
        });
    });
</script>
@endsection
