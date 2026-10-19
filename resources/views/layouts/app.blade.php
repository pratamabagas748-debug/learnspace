<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'LearnSpace - Platform pembelajaran online untuk semua.')">
    <title>@yield('title', 'LearnSpace') | LearnSpace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        html { scroll-behavior: smooth; }
        ::selection { background: #6366f1; color: #ffffff; }
        .fade-up { animation: fadeUp 0.4s ease; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        ::-webkit-scrollbar { width: 7px; height: 7px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- FLASH MESSAGES --}}
    <div class="max-w-7xl mx-auto px-4 pt-4">
        @include('components.alert')
    </div>

    {{-- CONTENT --}}
    <main class="fade-up">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.footer')

    @stack('scripts')
</body>
</html>