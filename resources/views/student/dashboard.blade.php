@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Saya')
@section('page-subtitle', 'Pantau progress belajar Anda')

@section('topbar-actions')
<a href="{{ route('courses.index') }}"
   class="hidden sm:inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition-all hover:shadow-md hover:shadow-indigo-200">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    Jelajahi Kursus
</a>
@endsection

@section('sidebar-nav')
<x-nav-item href="{{ route('student.dashboard') }}" :active="request()->routeIs('student.dashboard')"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>'>
    Dashboard
</x-nav-item>

<div class="mt-4 mb-1 px-3">
    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Belajar</p>
</div>

<x-nav-item href="{{ route('student.courses.index') }}" :active="request()->routeIs('student.courses.*')"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>'
    :badge="$stats['total_enrolled']">
    Kursus Saya
</x-nav-item>

<x-nav-item href="{{ route('courses.index') }}"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>'>
    Jelajahi Kursus
</x-nav-item>
@endsection

@section('content')

{{-- Welcome + Quick Stats --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-8">

    {{-- Welcome Card --}}
    <div class="lg:col-span-2 bg-gradient-to-r from-indigo-600 via-indigo-600 to-violet-700 rounded-2xl p-6 text-white relative overflow-hidden">
        <div class="absolute -top-6 -right-6 w-36 h-36 bg-white/5 rounded-full"></div>
        <div class="absolute bottom-0 right-12 w-24 h-24 bg-white/5 rounded-full"></div>
        <div class="relative">
            <p class="text-indigo-200 text-sm font-medium mb-1">Halo, {{ auth()->user()->name }} 👋</p>
            <h2 class="text-xl font-extrabold mb-1">Selamat datang kembali!</h2>
            <p class="text-indigo-200 text-sm">
                Anda sedang mengikuti <strong class="text-white">{{ $stats['total_enrolled'] }}</strong> kursus.
                @if($stats['total_active'] > 0)
                    Lanjutkan belajar sekarang!
                @else
                    Mulai kursus baru hari ini.
                @endif
            </p>
        </div>
    </div>

    {{-- Completion Stats --}}
    <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm flex flex-col justify-between">
        <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-4">Progress Belajar</p>
        <div class="space-y-3">
            @foreach([
                ['Kursus Diikuti', $stats['total_enrolled'], 'bg-indigo-500'],
                ['Sedang Belajar', $stats['total_active'], 'bg-amber-500'],
                ['Selesai', $stats['total_completed'], 'bg-emerald-500'],
            ] as $s)
            <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full {{ $s[2] }} shrink-0"></div>
                <p class="text-sm text-slate-600 flex-1">{{ $s[0] }}</p>
                <p class="text-sm font-bold text-slate-900">{{ $s[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Continue Learning --}}
@if($continuelearning->isNotEmpty())
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-slate-900">Lanjutkan Belajar</h2>
        <a href="{{ route('student.courses.index') }}" class="text-sm text-indigo-600 font-semibold hover:text-indigo-800 transition-colors">Lihat Semua →</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($continuelearning as $enrollment)
        @php
            $course = $enrollment->course;
            $progress = $course->getProgressForUser(auth()->user());
        @endphp
        <a href="{{ route('student.courses.show', $course->slug) }}"
           class="stat-card bg-white border border-slate-100 rounded-2xl p-5 block shadow-sm hover:shadow-md hover:border-indigo-200 group cursor-pointer">
            <div class="flex items-start gap-3 mb-4">
                <div class="w-11 h-11 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-xl shrink-0 flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-slate-800 text-sm leading-snug group-hover:text-indigo-700 transition-colors line-clamp-2">{{ $course->title }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $course->instructor->name }}</p>
                </div>
            </div>
            {{-- Progress bar --}}
            <div class="relative">
                <div class="flex justify-between items-center mb-1.5">
                    <span class="text-xs text-slate-500">Progress</span>
                    <span class="text-xs font-bold {{ $progress >= 100 ? 'text-emerald-600' : 'text-indigo-600' }}">{{ $progress }}%</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-500 {{ $progress >= 100 ? 'bg-emerald-500' : 'bg-gradient-to-r from-indigo-500 to-violet-500' }}"
                         style="width: {{ $progress }}%"></div>
                </div>
                <p class="text-xs text-slate-400 mt-1.5">
                    {{ $course->lessons->count() > 0 ? round($progress * $course->lessons->count() / 100) : 0 }}/{{ $course->lessons->count() }} materi
                </p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- All Enrollments Table --}}
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-slate-900">Semua Kursus Saya</h2>
        <a href="{{ route('student.courses.index') }}" class="text-sm text-indigo-600 font-semibold hover:text-indigo-800 transition-colors">Lihat Semua →</a>
    </div>

    @if($enrollments->isNotEmpty())
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-slate-500 text-xs uppercase tracking-wide">Kursus</th>
                        <th class="text-left px-5 py-3 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden md:table-cell">Kategori</th>
                        <th class="text-left px-5 py-3 font-semibold text-slate-500 text-xs uppercase tracking-wide">Progress</th>
                        <th class="text-left px-5 py-3 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden sm:table-cell">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($enrollments->take(5) as $enrollment)
                    @php $progress = $enrollment->course->getProgressForUser(auth()->user()); @endphp
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-4">
                            <a href="{{ route('student.courses.show', $enrollment->course->slug) }}"
                               class="font-semibold text-slate-800 hover:text-indigo-600 transition-colors line-clamp-1 block">
                                {{ $enrollment->course->title }}
                            </a>
                        </td>
                        <td class="px-5 py-4 text-slate-500 hidden md:table-cell text-xs">{{ $enrollment->course->category->name }}</td>
                        <td class="px-5 py-4 w-36">
                            <div class="flex items-center gap-2">
                                <div class="flex-1 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-full rounded-full {{ $progress >= 100 ? 'bg-emerald-500' : 'bg-gradient-to-r from-indigo-500 to-violet-500' }}" style="width: {{ $progress }}%"></div>
                                </div>
                                <span class="text-xs font-bold text-slate-600 shrink-0 w-8 text-right">{{ $progress }}%</span>
                            </div>
                        </td>
                        <td class="px-5 py-4 hidden sm:table-cell">
                            @if($enrollment->completed_at)
                                <span class="text-xs bg-emerald-100 text-emerald-700 font-semibold px-2.5 py-1 rounded-full">Selesai</span>
                            @else
                                <span class="text-xs bg-amber-100 text-amber-700 font-semibold px-2.5 py-1 rounded-full">Berlangsung</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-14 text-center">
            <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <p class="font-bold text-slate-700 mb-1">Belum ada kursus</p>
            <p class="text-slate-400 text-sm mb-5">Mulai perjalanan belajarmu dengan mendaftar kursus pertama!</p>
            <a href="{{ route('courses.index') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all hover:shadow-md hover:shadow-indigo-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Jelajahi Kursus
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tableCard = document.querySelectorAll('div.bg-white.rounded-2xl')[1];
    const realTableCard = tableCard || document.querySelector('div.bg-white.rounded-2xl');
    if(!realTableCard) return;

    let toast = document.getElementById('js-toast');
    if(!toast){
        toast = document.createElement('div');
        toast.id = 'js-toast';
        toast.className = 'fixed bottom-5 right-5 bg-slate-900 text-white text-sm px-4 py-3 rounded-xl shadow-lg hidden z-50';
        document.body.appendChild(toast);
    }

    const searchWrapper = document.createElement('div');
    searchWrapper.className = 'p-5 pb-0 flex flex-wrap gap-2';
    searchWrapper.innerHTML = `
        <input id="js-search" placeholder=" Cari kursus..." class="flex-1 min-w-[200px] px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
        <button data-filter="all" class="filter-btn bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm font-semibold">Semua</button>
        <button data-filter="Berlangsung" class="filter-btn bg-white border px-4 py-2 rounded-xl text-sm">Berlangsung</button>
        <button data-filter="Selesai" class="filter-btn bg-white border px-4 py-2 rounded-xl text-sm">Selesai</button>
    `;
    realTableCard.prepend(searchWrapper);

    const searchInput = document.getElementById('js-search');
    const rows = document.querySelectorAll('tbody tr');

    function showToast(msg) {
        toast.textContent = msg;
        toast.classList.remove('hidden');
        setTimeout(() => toast.classList.add('hidden'), 2500);
    }

    
    searchInput.value = localStorage.getItem('student_search') || '';
    if(searchInput.value) searchInput.dispatchEvent(new Event('input'));

    
    searchInput.addEventListener('input', (e) => {
        const keyword = e.target.value.toLowerCase();
        localStorage.setItem('student_search', keyword);
        let count = 0;
        rows.forEach(row => {
            const show = row.innerText.toLowerCase().includes(keyword);
            row.style.display = show? '' : 'none';
            if(show) count++;
        });
        if(keyword && count === 0) showToast('Gak ada kursus yang cocok');
    });


    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            document.querySelectorAll('.filter-btn').forEach(b => b.className = 'filter-btn bg-white border px-4 py-2 rounded-xl text-sm');
            e.currentTarget.className = 'filter-btn bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm font-semibold';
            const filter = e.currentTarget.dataset.filter;
            rows.forEach(row => {
                row.style.display = (filter === 'all' || row.innerText.includes(filter))? '' : 'none';
            });
            showToast(`Filter: ${filter}`);
        });
    });

    const haloCard = document.querySelector('.mb-6');
    if(haloCard) {
        haloCard.classList.add('cursor-pointer', 'hover:shadow-md', 'transition');
        haloCard.title = 'Klik untuk motivasi!';
        haloCard.addEventListener('click', () => {
            const quotes = ["Keren! Lanjutin 1 pelajaran lagi hari ini?","Konsisten > Cepat. Kamu udah on track!","Gas! 30 menit hari ini = progress gede besok."];
            showToast(quotes[Math.floor(Math.random()*quotes.length)]);
        });
    }
});
</script>
@endpush
@endsection