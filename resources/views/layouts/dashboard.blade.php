<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | LearnSpace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-[Inter] bg-slate-100 antialiased">

<div class="flex h-screen overflow-hidden">
    {{-- SIDEBAR --}}
    <aside id="sidebar" class="w-64 bg-white border-r border-slate-200 flex flex-col shrink-0 transition-all duration-300">
        {{-- Logo --}}
        <div class="h-16 flex items-center px-6 border-b border-slate-200">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-7 h-7 bg-indigo-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="font-bold text-slate-900 text-sm">Learn<span class="text-indigo-600">Space</span></span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
            @yield('sidebar-nav')
        </nav>

        {{-- User Info --}}
        <div class="p-4 border-t border-slate-200">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold text-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500 capitalize">{{ auth()->user()->role }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-xs text-slate-500 hover:text-red-600 transition-colors flex items-center gap-2 py-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Top Bar --}}
        <header class="h-16 bg-white border-b border-slate-200 flex items-center px-6 gap-4 shrink-0">
            <h1 class="text-lg font-semibold text-slate-800">@yield('page-title', 'Dashboard')</h1>
        </header>

        {{-- Content Area --}}
        <main class="flex-1 overflow-y-auto p-6">
            {{-- Flash Messages --}}
            @include('components.alert')

            {{-- Page Content --}}
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>