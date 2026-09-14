<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'LearnSpace - Platform pembelajaran online untuk semua.')">
    <title>@yield('title', 'LearnSpace') | LearnSpace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-[Inter] bg-slate-50 text-slate-800 antialiased">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- FLASH MESSAGES --}}
    <div class="max-w-7xl mx-auto px-4 pt-4">
        @include('components.alert')
    </div>

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.footer')

    @stack('scripts')
</body>
</html>