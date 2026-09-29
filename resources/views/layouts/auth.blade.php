<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — LearnSpace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .form-input { transition: all 0.2s ease; }
        .form-input:focus { box-shadow: 0 0 0 3px rgba(99,102,241,0.15); }
        .btn-primary { transition: all 0.2s ease; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 15px rgba(99,102,241,0.35); }
        .btn-primary:active { transform: translateY(0); }
        .blob { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; animation: blob 8s ease-in-out infinite; }
        @keyframes blob { 0%,100% { border-radius: 60% 40% 70% 30% / 50% 60% 40% 70%; } 50% { border-radius: 40% 60% 30% 70% / 60% 40% 70% 50%; } }
        .fade-up { animation: fadeUp 0.4s ease both; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="antialiased bg-white min-h-screen">
<div class="min-h-screen flex">

    {{-- ==================== LEFT PANEL ==================== --}}
    <div class="hidden lg:flex lg:w-[52%] xl:w-1/2 relative overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800">
        {{-- Decorative blobs --}}
        <div class="blob absolute -top-20 -left-20 w-72 h-72 bg-white/5"></div>
        <div class="blob absolute bottom-10 right-0 w-96 h-96 bg-violet-500/20" style="animation-delay:-4s"></div>
        <div class="blob absolute top-1/2 left-1/3 w-48 h-48 bg-indigo-400/20" style="animation-delay:-2s"></div>

        {{-- Grid pattern --}}
        <div class="absolute inset-0 opacity-[0.04]" style="background-image: repeating-linear-gradient(0deg,#fff 0,#fff 1px,transparent 1px,transparent 60px),repeating-linear-gradient(90deg,#fff 0,#fff 1px,transparent 1px,transparent 60px)"></div>

        <div class="relative flex flex-col justify-between p-12 w-full">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 w-fit group">
                <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center border border-white/20 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="text-white font-bold text-xl tracking-tight">LearnSpace</span>
            </a>

            {{-- Hero text --}}
            <div>
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur border border-white/20 rounded-full px-4 py-1.5 mb-6">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-white/80 text-xs font-medium">Platform Belajar Online #1</span>
                </div>
                <h1 class="text-4xl xl:text-5xl font-extrabold text-white leading-tight mb-4">
                    Mulai Perjalanan<br>
                    <span class="text-indigo-200">Belajarmu</span> Hari Ini
                </h1>
                <p class="text-indigo-200 text-base leading-relaxed mb-10 max-w-sm">
                    Platform pembelajaran online dengan kursus berkualitas dari instruktur terpercaya.
                </p>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-3">
                    @foreach([['100+', 'Kursus'], ['5K+', 'Pelajar'], ['50+', 'Instruktur']] as $stat)
                    <div class="bg-white/10 backdrop-blur border border-white/10 rounded-2xl p-4 text-center hover:bg-white/15 transition-colors">
                        <p class="text-2xl font-bold text-white">{{ $stat[0] }}</p>
                        <p class="text-xs text-indigo-200 mt-0.5 font-medium">{{ $stat[1] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <p class="text-indigo-300/60 text-xs">© {{ date('Y') }} LearnSpace. All rights reserved.</p>
        </div>
    </div>

    {{-- ==================== RIGHT PANEL ==================== --}}
    <div class="flex-1 flex items-center justify-center px-6 py-10 lg:px-14 xl:px-20 bg-white">
        <div class="w-full max-w-md fade-up">

            {{-- Mobile Logo --}}
            <div class="lg:hidden mb-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-slate-800 tracking-tight">Learn<span class="text-indigo-600">Space</span></span>
                </a>
            </div>

            {{-- Flash Messages --}}
            @include('components.alert')

            {{-- Form Content --}}
            @yield('form')
        </div>
    </div>
</div>
</body>
</html>