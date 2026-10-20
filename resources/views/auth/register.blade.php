@extends('layouts.auth')
@section('title', 'Daftar Akun')

@section('form')
<div>
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-slate-900 mb-1.5">Buat Akun Baru ✨</h1>
        <p class="text-slate-500 text-sm">Bergabung dengan ribuan pelajar di LearnSpace.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                   placeholder="Nama lengkap Anda"
                   class="form-input w-full px-4 py-3 border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white' }} rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
            @error('name')
                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                   placeholder="nama@email.com"
                   class="form-input w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white' }} rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
            @error('email')
                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
            <input type="password" id="password" name="password" required
                   placeholder="Minimal 8 karakter"
                   class="form-input w-full px-4 py-3 border border-slate-200 bg-slate-50 focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
            @error('password')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                   placeholder="Ulangi password Anda"
                   class="form-input w-full px-4 py-3 border border-slate-200 bg-slate-50 focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
        </div>

        <div class="pt-1">
            <button type="submit"
                    class="btn-primary w-full bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold py-3 rounded-xl text-sm">
                Buat Akun Saya
            </button>
        </div>
    </form>

    <p class="text-center text-sm text-slate-500 mt-6">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition-colors">Masuk di sini</a>
    </p>

    <p class="text-center text-xs text-slate-400 mt-4">
        Dengan mendaftar, akun Anda otomatis terdaftar sebagai <strong class="text-slate-600">Student</strong>.
    </p>
</div>
@endsection