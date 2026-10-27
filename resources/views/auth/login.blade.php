@extends('layouts.auth')
@section('title', 'Masuk')

@section('form')
<div>
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-slate-900 mb-1.5">Selamat Datang Kembali 👋</h1>
        <p class="text-slate-500 text-sm">Masuk ke akun LearnSpace Anda untuk melanjutkan.</p>
    </div>

    {{-- Social Login Buttons --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
        <a href="{{ route('auth.social.redirect', 'google') }}"
           class="flex items-center justify-center gap-2.5 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-sm hover:border-slate-300 hover:shadow">
            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span>Google</span>
        </a>

        <a href="{{ route('auth.social.redirect', 'facebook') }}"
           class="flex items-center justify-center gap-2.5 px-4 py-2.5 rounded-xl border border-sky-200/80 bg-sky-50/60 hover:bg-sky-50 text-[#1877F2] text-xs font-bold transition-all shadow-sm hover:border-sky-300 hover:shadow">
            <svg class="w-4 h-4 shrink-0 fill-current" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            <span>Facebook</span>
        </a>
    </div>

    {{-- Divider --}}
    <div class="relative mb-6">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
        <div class="relative flex justify-center"><span class="bg-white px-3 text-xs text-slate-400 font-medium">atau masuk dengan email</span></div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
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
            <div class="relative">
                <input type="password" id="password" name="password" required
                       placeholder="Masukkan password"
                       class="form-input w-full px-4 py-3 pr-11 border border-slate-200 bg-slate-50 focus:bg-white rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
                <button type="button" onclick="togglePassword()" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer group">
                <input type="checkbox" id="remember" name="remember"
                       class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0 cursor-pointer">
                <span class="text-sm text-slate-600 group-hover:text-slate-800 transition-colors select-none">Ingat saya</span>
            </label>
        </div>

        <button type="submit"
                class="btn-primary w-full bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold py-3 rounded-xl text-sm">
            Masuk ke Akun
        </button>
    </form>

    <p class="text-center text-sm text-slate-500 mt-6">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition-colors">Daftar sekarang</a>
    </p>

    {{-- Divider --}}
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
        <div class="relative flex justify-center"><span class="bg-white px-3 text-xs text-slate-400 font-medium">AKUN DEMO</span></div>
    </div>

    {{-- Demo credentials --}}
    <div class="grid grid-cols-3 gap-2 text-xs">
        @foreach([['Admin', 'admin@learnspace.test', 'bg-red-50 border-red-100 text-red-700'], ['Instructor', 'instructor@learnspace.test', 'bg-violet-50 border-violet-100 text-violet-700'], ['Student', 'student@learnspace.test', 'bg-indigo-50 border-indigo-100 text-indigo-700']] as $demo)
        <div class="border {{ $demo[2] }} rounded-xl p-2.5 text-center cursor-pointer hover:opacity-80 transition-opacity"
             onclick="document.getElementById('email').value='{{ $demo[1] }}';document.getElementById('password').value='password'">
            <p class="font-bold">{{ $demo[0] }}</p>
            <p class="opacity-70 mt-0.5 truncate">{{ $demo[1] }}</p>
        </div>
        @endforeach
    </div>
    <p class="text-center text-xs text-slate-400 mt-2">Klik kartu untuk auto-fill • Password: <code class="bg-slate-100 px-1 rounded">password</code></p>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('eye-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }
}
</script>
@endsection