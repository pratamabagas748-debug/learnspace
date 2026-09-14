<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-slate-900">Learn<span class="text-indigo-600">Space</span></span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Home</a>
                <a href="{{ route('courses.index') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Kursus</a>
            </div>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route(auth()->user()->role . '.dashboard') }}"
                       class="text-sm font-medium text-slate-700 hover:text-indigo-600 transition-colors">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg transition-colors">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 hover:text-indigo-600 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="text-sm font-medium bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Daftar Gratis
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>