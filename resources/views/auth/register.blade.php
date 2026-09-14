@extends('layouts.auth')
@section('title', 'Daftar')

@section('form')
<div>
    <h1 class="text-2xl font-bold text-slate-900 mb-2">Buat Akun Baru</h1>
    <p class="text-slate-500 mb-8">Bergabung dan mulai belajar bersama LearnSpace</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                   placeholder="Nama lengkap Anda"
                   class="w-full px-4 py-3 border @error('name') border-red-400 bg-red-50 @else border-slate-300 @enderror rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm">
            @error('name')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                   placeholder="nama@email.com"
                   class="w-full px-4 py-3 border @error('email') border-red-400 bg-red-50 @else border-slate-300 @enderror rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm">
            @error('email')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
            <input type="password" id="password" name="password" required
                   placeholder="Minimal 8 karakter"
                   class="w-full px-4 py-3 border border-slate-300 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                   placeholder="Ulangi password"
                   class="w-full px-4 py-3 border border-slate-300 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm">
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition-colors text-sm">
            Buat Akun
        </button>
    </form>

    <p class="text-center text-sm text-slate-500 mt-6">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline">Masuk di sini</a>
    </p>
</div>
@endsection