@extends('layouts.auth')
@section('title', 'Masuk')

@section('form')
<div>
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-slate-900 mb-1.5">Selamat Datang Kembali 👋</h1>
        <p class="text-slate-500 text-sm">Masuk ke akun LearnSpace Anda untuk melanjutkan.</p>
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