<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — LearnSpace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-item { transition: all 0.18s cubic-bezier(.4,0,.2,1); }
        .sidebar-item:hover { transform: translateX(2px); }
        .stat-card { transition: all 0.2s ease; }
        .stat-card:hover { transform: translateY(-2px); }
        .fade-in { animation: fadeIn 0.25s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
        #mobile-overlay { transition: opacity 0.25s ease; }
        #sidebar { transition: transform 0.3s cubic-bezier(.4,0,.2,1); }
        @media (max-width: 1023px) {
            #sidebar.mobile-hidden { transform: translateX(-100%); }
        }
    </style>
</head>
<body class="bg-slate-50 antialiased text-slate-900">

{{-- Mobile Overlay --}}
<div id="mobile-overlay" class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

<div class="flex h-screen overflow-hidden">

    {{-- ==================== SIDEBAR ==================== --}}
    <aside id="sidebar" class="fixed lg:relative z-40 w-64 h-full bg-white border-r border-slate-100 flex flex-col shadow-sm mobile-hidden lg:translate-x-0">

        {{-- Logo --}}
        <div class="h-16 flex items-center justify-between px-5 border-b border-slate-100 shrink-0">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-xl flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="font-bold text-slate-800 tracking-tight">Learn<span class="text-indigo-600">Space</span></span>
            </a>
            {{-- Close button mobile --}}
            <button onclick="toggleSidebar()" class="lg:hidden p-1.5 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
            @yield('sidebar-nav')
        </nav>

        {{-- Role Badge --}}
        <div class="px-3 pb-2">
            <div class="bg-slate-50 rounded-xl p-1.5 flex items-center gap-1.5">
                @php
                    $roleColors = ['admin' => 'bg-red-100 text-red-700', 'instructor' => 'bg-violet-100 text-violet-700', 'student' => 'bg-indigo-100 text-indigo-700'];
                    $roleColor = $roleColors[auth()->user()->role] ?? 'bg-slate-100 text-slate-600';
                @endphp
                <span class="text-xs font-semibold px-2 py-1 rounded-lg capitalize {{ $roleColor }}">
                    {{ auth()->user()->role }}
                </span>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-700 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        {{-- Logout --}}
        <div class="px-3 pb-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:bg-red-50 hover:text-red-600 transition-all group sidebar-item">
                    <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <div class="flex-1 flex flex-col overflow-hidden min-w-0">

        {{-- Top Bar --}}
        <header class="h-16 bg-white border-b border-slate-100 flex items-center gap-4 px-5 lg:px-6 shrink-0">
            {{-- Mobile hamburger --}}
            <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl hover:bg-slate-100 text-slate-500 hover:text-slate-700 transition-colors -ml-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div class="flex-1 min-w-0">
                <h1 class="text-base font-bold text-slate-800 truncate">@yield('page-title', 'Dashboard')</h1>
                @hasSection('page-subtitle')
                <p class="text-xs text-slate-400 truncate">@yield('page-subtitle')</p>
                @endif
            </div>

            {{-- Right actions --}}
            <div class="flex items-center gap-3">
                @yield('topbar-actions')

                {{-- Avatar --}}
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-full flex items-center justify-center text-white font-bold text-xs shrink-0 select-none">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Content Area --}}
        <main class="flex-1 overflow-y-auto">
            <div class="p-5 lg:p-7 fade-in">
                {{-- Flash Messages --}}
                @include('components.alert')
                {{-- Page Content --}}
                @yield('content')
            </div>
        </main>
    </div>
</div>

@stack('scripts')

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-overlay');
        const hidden = sidebar.classList.contains('mobile-hidden');
        if (hidden) {
            sidebar.classList.remove('mobile-hidden');
            overlay.classList.remove('hidden');
        } else {
            sidebar.classList.add('mobile-hidden');
            overlay.classList.add('hidden');
        }
    }
    // Close sidebar on resize to desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            document.getElementById('mobile-overlay').classList.add('hidden');
        }
    });
</script>
</body>
</html>