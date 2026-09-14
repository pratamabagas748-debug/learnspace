@extends('layouts.auth')
@section('title', 'Masuk')

@section('form')
<div>
    <h1 class="text-2xl font-bold text-slate-900 mb-2">Selamat Datang Kembali</h1>
    <p class="text-slate-500 mb-8">Masuk ke akun LearnSpace Anda</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                   placeholder="nama@email.com"
                   class="w-full px-4 py-3 border @error('email') border-red-400 bg-red-50 @else border-slate-300 @enderror rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm">
            @error('email')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
            <input type="password" id="password" name="password" required
                   placeholder="••••••••"
                   class="w-full px-4 py-3 border border-slate-300 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="remember" name="remember" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
            <label for="remember" class="text-sm text-slate-600">Ingat saya</label>
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition-colors text-sm">
            Masuk
        </button>
    </form>

    <p class="text-center text-sm text-slate-500 mt-6">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Daftar sekarang</a>
    </p>

    {{-- Demo credentials --}}
    <div class="mt-6 bg-slate-50 border border-slate-200 rounded-xl p-4 text-xs text-slate-500">
        <p class="font-semibold text-slate-600 mb-2">Akun Demo:</p>
        <div class="space-y-1">
            <p>Admin: <code class="bg-white px-1 rounded">admin@learnspace.test</code></p>
            <p>Instructor: <code class="bg-white px-1 rounded">instructor@learnspace.test</code></p>
            <p>Student: <code class="bg-white px-1 rounded">student@learnspace.test</code></p>
            <p>Password: <code class="bg-white px-1 rounded">password</code></p>
        </div>
    </div>
</div>
@endsection