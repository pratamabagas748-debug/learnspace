<nav class="site-navbar bg-white/80 backdrop-blur-lg border-b border-slate-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 bg-gradient-to-br from-indigo-600 to-violet-600 rounded-xl flex items-center justify-center shadow-sm shadow-indigo-200 group-hover:shadow-md group-hover:shadow-indigo-200 transition-shadow">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="text-xl font-extrabold text-slate-900">Learn<span class="text-indigo-600">Space</span></span>
            </a>

            {{-- Desktop Nav --}}
            <div class="site-nav-links hidden md:flex items-center gap-2">
                <a href="{{ route('home') }}"
                   class="site-nav-link group flex items-center gap-2.5 px-4 py-2.5 rounded-2xl text-base font-semibold {{ request()->routeIs('home') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }} transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="m3 10 9-7 9 7M5 9v11h14V9M9 20v-6h6v6"/></svg>
                    <span>Home</span>
                </a>
                <a href="{{ route('courses.index') }}"
                   class="site-nav-link group flex items-center gap-2.5 px-4 py-2.5 rounded-2xl text-base font-semibold {{ request()->routeIs('courses.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }} transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M4 5.5v16M8 7h8M8 11h7"/></svg>
                    <span>Kursus</span>
                </a>
                @auth
                    @if(auth()->user()->isStudent())
                    <a href="{{ route('student.leaderboard') }}"
                       class="site-nav-link group flex items-center gap-2.5 px-4 py-2.5 rounded-2xl text-base font-semibold {{ request()->routeIs('student.leaderboard') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }} transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M8 21h8m-4-4v4M7 4h10v5a5 5 0 0 1-10 0V4Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M7 6H4v2a4 4 0 0 0 4 4m9-6h3v2a4 4 0 0 1-4 4"/></svg>
                        <span>Leaderboard</span>
                    </a>
                    @endif
                @endauth
            </div>

            {{-- Auth --}}
            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route(auth()->user()->role . '.dashboard') }}"
                       class="site-nav-dashboard text-base font-semibold text-slate-700 hover:text-indigo-600 transition-colors px-3 py-2 rounded-xl hover:bg-slate-50">
                        <span class="hidden sm:inline">Dashboard</span>
                        <svg class="w-5 h-5 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    </a>
                    @if(auth()->user()->avatar_url)
                        <a href="{{ route('profile.edit') }}" class="w-8 h-8 rounded-full overflow-hidden border-2 border-slate-100 hover:border-indigo-300 transition-colors shrink-0">
                            <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                        </a>
                    @else
                        <a href="{{ route('profile.edit') }}" class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white text-xs font-bold border-2 border-white hover:border-indigo-200 transition-colors shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-base font-semibold text-slate-700 hover:text-indigo-600 transition-colors px-3 py-2">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="text-base font-bold bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white px-5 py-2.5 rounded-xl transition-all hover:shadow-md hover:shadow-indigo-200">
                        Daftar Gratis
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>