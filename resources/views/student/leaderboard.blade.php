@extends('layouts.dashboard')
@section('title', 'Leaderboard & Misi Harian')
@section('page-title', 'Leaderboard & Liga')
@section('page-subtitle', 'Berkompetisi secara sehat dan selesaikan misi harian untuk raih XP')

@section('sidebar-nav')
<x-nav-item href="{{ route('student.dashboard') }}" :active="false"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>'>
    Dashboard
</x-nav-item>

<div class="mt-4 mb-1 px-3">
    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Belajar</p>
</div>

<x-nav-item href="{{ route('student.courses.index') }}" :active="false"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>'>
    Kursus Saya
</x-nav-item>

<x-nav-item href="{{ route('student.leaderboard') }}" :active="true"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>'>
    Leaderboard & Misi
</x-nav-item>

<x-nav-item href="{{ route('courses.index') }}" :active="false"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>'>
    Jelajahi Kursus
</x-nav-item>
@endsection

@section('content')
<div class="max-w-6xl space-y-8 leaderboard-page">

    {{-- Gamified leaderboard hero: decorative presentation only. --}}
    <section class="leaderboard-hero relative overflow-hidden rounded-[28px] p-6 sm:p-8 text-white">
        <div class="leaderboard-hero-copy relative z-10 max-w-2xl">
            <p class="leaderboard-hero-eyebrow inline-flex items-center gap-2 text-[11px] font-extrabold uppercase tracking-[.18em] mb-3"><span class="leaderboard-live-dot"></span> Learn · Compete · Level up</p>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight">Setiap usaha punya poin. Setiap progres layak dirayakan.</h2>
            <p class="text-sm sm:text-base mt-3 leading-relaxed max-w-xl">Selesaikan misi, kumpulkan XP, dan terus naik level bersama komunitas LearnSpace.</p>
            <div class="leaderboard-hero-pills flex flex-wrap gap-2.5 mt-5">
                <span class="leaderboard-hero-pill"><span aria-hidden="true">⚡</span> {{ auth()->user()->xp_points ?? 0 }} XP total</span>
                <span class="leaderboard-hero-pill"><span aria-hidden="true">🔥</span> {{ $streak }} hari streak</span>
                <span class="leaderboard-hero-pill"><span aria-hidden="true">{{ $league['badge'] }}</span> Liga {{ $league['name'] }}</span>
            </div>
            <a href="{{ route('student.courses.index') }}" class="leaderboard-hero-cta inline-flex items-center gap-2 mt-5 rounded-xl px-4 py-2.5 text-sm font-bold">Lanjutkan belajar <span aria-hidden="true">→</span></a>
        </div>
        <div class="leaderboard-hero-art" aria-hidden="true">
            <div class="leaderboard-art-ring leaderboard-art-ring-one"></div>
            <div class="leaderboard-art-ring leaderboard-art-ring-two"></div>
            <div class="leaderboard-art-trophy"><span>🏆</span><i>✦</i></div>
            <div class="leaderboard-art-float leaderboard-art-float-top">+ XP</div>
            <div class="leaderboard-art-float leaderboard-art-float-bottom">LEVEL UP <b>↗</b></div>
            <span class="leaderboard-art-spark leaderboard-art-spark-one">✦</span>
            <span class="leaderboard-art-spark leaderboard-art-spark-two">✧</span>
        </div>
    </section>

    {{-- Alert Notification Banner --}}
    <div id="quest-alert" class="hidden rounded-2xl p-4 shadow-sm border transition-all animate-bounce">
        <div class="flex items-center gap-3">
            <span class="text-2xl">🎉</span>
            <div class="flex-1">
                <p id="quest-alert-title" class="font-bold text-slate-800 text-sm">Reward Berhasil Diklaim!</p>
                <p id="quest-alert-desc" class="text-xs text-slate-600 mt-0.5">XP telah ditambahkan ke profil Anda.</p>
            </div>
            <button onclick="closeQuestAlert()" class="text-slate-400 hover:text-slate-600 p-1">✕</button>
        </div>
    </div>

    {{-- Top League & Stats Cards --}}
    <div class="leaderboard-stat-grid grid grid-cols-1 md:grid-cols-3 gap-5">

        {{-- League Tier Banner --}}
        <div class="leaderboard-stat-card league-current-card bg-gradient-to-br {{ $league['color'] }} rounded-2xl p-6 text-white shadow-lg shadow-indigo-100 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 text-7xl opacity-20 pointer-events-none">{{ $league['badge'] }}</div>
            <div>
                <span class="text-xs uppercase tracking-wider font-extrabold bg-white/20 backdrop-blur-xs px-2.5 py-1 rounded-full inline-block mb-3">
                    Tingkatan Liga Saat Ini
                </span>
                <div class="flex items-center gap-2">
                    <span class="text-3xl">{{ $league['badge'] }}</span>
                    <h2 class="text-2xl font-black">{{ $league['name'] }}</h2>
                </div>
                <p class="text-white/80 text-xs mt-1">
                    @if($league['next'])
                        Kumpulkan hingga {{ $league['next'] }} XP untuk promosi ke tingkatan berikutnya!
                    @else
                        Selamat! Kamu telah berada di tingkatan liga tertinggi!
                    @endif
                </p>
            </div>
            <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between text-xs">
                <span>Reset Mingguan:</span>
                <span class="font-bold bg-white/25 px-2 py-0.5 rounded-md">⏳ {{ $timeRemaining }}</span>
            </div>
        </div>

        {{-- Peringkat Kamu --}}
        <div class="leaderboard-stat-card student-rank-card bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div>
                <span class="text-xs uppercase tracking-wider font-bold text-slate-400 block mb-1">Peringkat Mingguanmu</span>
                <div class="flex items-baseline gap-2 mt-2">
                    <span class="text-4xl font-extrabold text-indigo-600">#{{ $userRank }}</span>
                    <span class="text-xs text-slate-500 font-medium">dari seluruh siswa aktif</span>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-600">
                <span>Total XP Kamu:</span>
                <span class="font-extrabold text-slate-900 text-sm" id="user-total-xp">⭐ {{ auth()->user()->xp_points ?? 0 }} XP</span>
            </div>
        </div>

        {{-- Streak & Konsistensi --}}
        <div class="leaderboard-stat-card student-streak-rank-card bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div>
                <span class="text-xs uppercase tracking-wider font-bold text-slate-400 block mb-1">Learning Streak</span>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-3xl">🔥</span>
                    <span class="text-3xl font-extrabold text-orange-500">{{ $streak }} Hari</span>
                </div>
                <p class="text-xs text-slate-500 mt-1">Belajar setiap hari untuk menjaga api streak tetap menyala.</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Status Hari Ini:</span>
                <span class="font-bold {{ $streak > 0 ? 'text-emerald-600' : 'text-slate-400' }}">
                    {{ $streak > 0 ? '✓ Aktif' : 'Belum Belajar' }}
                </span>
            </div>
        </div>

    </div>

    {{-- Daily Quests (Misi Harian) Section --}}
    <div class="quest-board-panel bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
            <div>
                <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <span>🎯</span> Misi Harian (Daily Quests)
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Selesaikan misi setiap hari untuk klaim bonus XP instan!</p>
            </div>
            <span class="text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-full">
                Diperbarui Setiap 00:00 WIB
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($quests as $key => $quest)
            <div class="quest-card border rounded-2xl p-4.5 transition-all {{ $quest['claimed'] ? 'bg-slate-50/70 border-slate-200 opacity-75' : ($quest['completed'] ? 'bg-emerald-50/50 border-emerald-200 shadow-xs' : 'bg-white border-slate-200') }}">
                <div class="flex items-start justify-between gap-2 mb-2">
                    <div class="quest-icon-tile w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-xl shrink-0">
                        {{ $key === 'daily_focus' ? '🧠' : $quest['icon'] }}
                    </div>
                    <span class="text-xs font-bold px-2 py-0.5 rounded-md {{ $quest['claimed'] ? 'bg-slate-200 text-slate-600' : 'bg-amber-100 text-amber-800' }}">
                        +{{ $quest['reward_xp'] }} XP
                    </span>
                </div>

                <h4 class="font-bold text-slate-900 text-sm mb-1">{{ $quest['title'] }}</h4>
                <p class="text-xs text-slate-500 mb-3 leading-relaxed">{{ $quest['description'] }}</p>

                {{-- Progress Bar --}}
                <div class="space-y-1 mb-4">
                    <div class="flex justify-between text-[11px] font-semibold text-slate-500">
                        <span>Progress</span>
                        <span>{{ $quest['current'] }}/{{ $quest['target'] }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="quest-progress-fill h-full rounded-full transition-all duration-500 {{ $quest['completed'] ? 'bg-emerald-500' : 'bg-indigo-600' }}"
                             style="width: {{ ($quest['current'] / $quest['target']) * 100 }}%"></div>
                    </div>
                </div>

                {{-- Claim Button --}}
                @if($quest['claimed'])
                    <button disabled class="w-full py-2 px-3 rounded-xl bg-slate-200 text-slate-500 text-xs font-bold flex items-center justify-center gap-1.5 cursor-not-allowed">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Sudah Diklaim
                    </button>
                @elseif($quest['completed'])
                    <button onclick="claimQuest('{{ $key }}', this)"
                            class="w-full py-2 px-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-xs font-bold shadow-md shadow-emerald-200 hover:shadow-lg transition-all flex items-center justify-center gap-1.5 transform hover:scale-[1.02]">
                        <span>🎁</span> Klaim +{{ $quest['reward_xp'] }} XP
                    </button>
                @else
                    <a href="{{ $key === 'daily_focus' ? route('student.courses.index') : route('student.courses.index') }}"
                       class="w-full py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold flex items-center justify-center gap-1 transition-colors">
                        Mulai Belajar →
                    </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    {{-- Leaderboard Tables with Tabs --}}
    <div class="leaderboard-table-panel bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        {{-- Tabs Header --}}
        <div class="leaderboard-table-header border-b border-slate-100 p-4 sm:p-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900">Papan Peringkat Siswa</h3>
                <p class="text-xs text-slate-500 mt-0.5">Top 3 teratas berpeluang promosi ke liga berikutnya setiap minggu!</p>
            </div>
            <div class="ranking-tabs flex items-center bg-slate-100 p-1 rounded-xl text-xs font-bold">
                <button id="tab-weekly-btn" onclick="switchLeaderboardTab('weekly')" class="px-4 py-2 rounded-lg bg-white shadow-xs text-indigo-600 transition-all">
                    🏆 Liga Minggu Ini
                </button>
                <button id="tab-alltime-btn" onclick="switchLeaderboardTab('alltime')" class="px-4 py-2 rounded-lg text-slate-500 hover:text-slate-900 transition-all">
                    ⭐ Sepanjang Waktu
                </button>
            </div>
        </div>

        {{-- Weekly League Tab Table --}}
        <div id="tab-weekly" class="divide-y divide-slate-100">
            @forelse($weeklyLeaderboard as $index => $u)
                @php
                    $isCurrentUser = $u->id === auth()->id();
                    $rank = $index + 1;
                @endphp
                <div class="leaderboard-row leaderboard-row-weekly p-4 sm:px-6 flex items-center gap-4 transition-colors {{ $isCurrentUser ? 'bg-indigo-50/80 border-l-4 border-indigo-600' : 'hover:bg-slate-50' }}">
                    {{-- Rank Badge --}}
                    <div class="w-8 flex items-center justify-center shrink-0">
                        @if($rank === 1)
                            <span class="text-2xl" title="Juara 1">🥇</span>
                        @elseif($rank === 2)
                            <span class="text-2xl" title="Juara 2">🥈</span>
                        @elseif($rank === 3)
                            <span class="text-2xl" title="Juara 3">🥉</span>
                        @else
                            <span class="text-sm font-extrabold text-slate-400">#{{ $rank }}</span>
                        @endif
                    </div>

                    {{-- Avatar --}}
                    <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 border-2 {{ $rank <= 3 ? 'border-amber-400 ring-2 ring-amber-100' : 'border-slate-200' }}">
                        @if($u->avatar_url)
                            <img src="{{ $u->avatar_url }}" alt="{{ $u->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    {{-- User Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-bold text-slate-900 truncate">
                                {{ $u->name }}
                            </p>
                            @if($isCurrentUser)
                                <span class="text-[10px] bg-indigo-600 text-white font-extrabold px-2 py-0.5 rounded-full">Kamu</span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-400 truncate">
                            Total: {{ $u->xp_points ?? 0 }} XP
                        </p>
                    </div>

                    {{-- Weekly Points --}}
                    <div class="text-right shrink-0">
                        <span class="inline-flex items-center gap-1 font-extrabold text-sm text-indigo-600 bg-indigo-50 px-3 py-1 rounded-xl">
                            <span>⚡</span> {{ $u->weekly_points }} XP
                        </span>
                        <p class="text-[10px] text-slate-400 mt-0.5">minggu ini</p>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-slate-400 text-sm">
                    Belum ada aktivitas belajar minggu ini. Jadilah yang pertama meraih XP!
                </div>
            @endforelse
        </div>

        {{-- All-Time Tab Table --}}
        <div id="tab-alltime" class="hidden divide-y divide-slate-100">
            @forelse($allTimeLeaderboard as $index => $u)
                @php
                    $isCurrentUser = $u->id === auth()->id();
                    $rank = $index + 1;
                @endphp
                <div class="leaderboard-row leaderboard-row-alltime p-4 sm:px-6 flex items-center gap-4 transition-colors {{ $isCurrentUser ? 'bg-indigo-50/80 border-l-4 border-indigo-600' : 'hover:bg-slate-50' }}">
                    <div class="w-8 flex items-center justify-center shrink-0">
                        @if($rank === 1)
                            <span class="text-2xl">🥇</span>
                        @elseif($rank === 2)
                            <span class="text-2xl">🥈</span>
                        @elseif($rank === 3)
                            <span class="text-2xl">🥉</span>
                        @else
                            <span class="text-sm font-extrabold text-slate-400">#{{ $rank }}</span>
                        @endif
                    </div>

                    <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 border-2 {{ $rank <= 3 ? 'border-amber-400' : 'border-slate-200' }}">
                        @if($u->avatar_url)
                            <img src="{{ $u->avatar_url }}" alt="{{ $u->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-bold text-slate-900 truncate">{{ $u->name }}</p>
                            @if($isCurrentUser)
                                <span class="text-[10px] bg-indigo-600 text-white font-extrabold px-2 py-0.5 rounded-full">Kamu</span>
                            @endif
                        </div>
                        <span class="text-xs text-slate-400">Siswa LearnSpace</span>
                    </div>

                    <div class="text-right shrink-0">
                        <span class="inline-flex items-center gap-1 font-extrabold text-sm text-amber-600 bg-amber-50 px-3 py-1 rounded-xl">
                            <span>⭐</span> {{ $u->xp_points ?? 0 }} XP
                        </span>
                        <p class="text-[10px] text-slate-400 mt-0.5">sepanjang waktu</p>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-slate-400 text-sm">
                    Belum ada data siswa.
                </div>
            @endforelse
        </div>
    </div>

</div>

<script>
    function switchLeaderboardTab(tab) {
        const weeklyTab = document.getElementById('tab-weekly');
        const alltimeTab = document.getElementById('tab-alltime');
        const weeklyBtn = document.getElementById('tab-weekly-btn');
        const alltimeBtn = document.getElementById('tab-alltime-btn');

        if (tab === 'weekly') {
            weeklyTab.classList.remove('hidden');
            alltimeTab.classList.add('hidden');
            weeklyBtn.className = 'px-4 py-2 rounded-lg bg-white shadow-xs text-indigo-600 transition-all font-bold';
            alltimeBtn.className = 'px-4 py-2 rounded-lg text-slate-500 hover:text-slate-900 transition-all font-semibold';
        } else {
            weeklyTab.classList.add('hidden');
            alltimeTab.classList.remove('hidden');
            alltimeBtn.className = 'px-4 py-2 rounded-lg bg-white shadow-xs text-indigo-600 transition-all font-bold';
            weeklyBtn.className = 'px-4 py-2 rounded-lg text-slate-500 hover:text-slate-900 transition-all font-semibold';
        }
    }

    function claimQuest(questKey, btn) {
        btn.disabled = true;
        btn.innerHTML = '<span class="inline-block animate-spin">⏳</span> Mengklaim...';

        fetch("{{ route('student.quests.claim') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ quest_key: questKey })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Tampilkan banner sukses
                const alertEl = document.getElementById('quest-alert');
                document.getElementById('quest-alert-title').innerText = '🎉 Berhasil!';
                document.getElementById('quest-alert-desc').innerText = data.message;
                alertEl.className = 'rounded-2xl p-4 shadow-md bg-emerald-50 border border-emerald-200 block transition-all';

                // Update Total XP di card
                const xpEl = document.getElementById('user-total-xp');
                if (xpEl) xpEl.innerText = '⭐ ' + data.total_xp + ' XP';

                // Ubah button jadi sudah diklaim
                btn.className = 'w-full py-2 px-3 rounded-xl bg-slate-200 text-slate-500 text-xs font-bold flex items-center justify-center gap-1.5 cursor-not-allowed';
                btn.innerHTML = '✓ Sudah Diklaim';
            } else {
                alert(data.message || 'Gagal mengklaim misi.');
                btn.disabled = false;
                btn.innerHTML = '🎁 Coba Lagi';
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan koneksi.');
            btn.disabled = false;
            btn.innerHTML = '🎁 Klaim Reward';
        });
    }

    function closeQuestAlert() {
        document.getElementById('quest-alert').classList.add('hidden');
    }
</script>
@endsection
