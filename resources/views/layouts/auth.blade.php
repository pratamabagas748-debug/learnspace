<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | LearnSpace</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-[Inter] bg-slate-50 antialiased">
    <div class="min-h-screen flex">
        {{-- Left Panel (Decorative) --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDM0di00aC0ydjRoLTR2Mmg0djRoMnYtNGg0di0yaC00em0wLTMwVjBoLTJ2NGgtNHYyaDR2NGgyVjZoNFY0aC00ek02IDM0di00SDR2NEgwdjJoNHY0aDJ2LTRoNHYtMkg2ek02IDRWMEg0djRIMHYyaDR2NGgyVjZoNFY0SDZ6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-50"></div>
            <div class="relative flex flex-col justify-center px-12 text-white">
                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-12">
                    <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold">LearnSpace</span>
                </a>
                <h2 class="text-4xl font-bold mb-4 leading-tight">Mulai Perjalanan<br>Belajar Anda</h2>
                <p class="text-indigo-200 text-lg leading-relaxed mb-8">Platform pembelajaran online dengan ratusan kursus berkualitas dari instruktur terpercaya.</p>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white/10 backdrop-blur rounded-xl p-4 text-center">
                        <p class="text-2xl font-bold">100+</p>
                        <p class="text-xs text-indigo-200 mt-1">Kursus</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-xl p-4 text-center">
                        <p class="text-2xl font-bold">5K+</p>
                        <p class="text-xs text-indigo-200 mt-1">Pelajar</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-xl p-4 text-center">
                        <p class="text-2xl font-bold">50+</p>
                        <p class="text-xs text-indigo-200 mt-1">Instruktur</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Panel (Form) --}}
        <div class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">
                {{-- Mobile Logo --}}
                <div class="lg:hidden mb-8 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                        <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">Learn<span class="text-indigo-600">Space</span></span>
                    </a>
                </div>

                {{-- Flash Messages --}}
                @include('components.alert')

                @yield('form')
            </div>
        </div>
    </div>
</body>
</html>