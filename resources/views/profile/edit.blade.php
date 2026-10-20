@extends('layouts.dashboard')
@section('title', 'Edit Profil')
@section('page-title', 'Edit Profil')
@section('page-subtitle', 'Kelola informasi akun Anda')

@section('sidebar-nav')
@php
    $role = auth()->user()->role;
    $dashRoute = match($role) { 'admin' => 'admin.dashboard', 'instructor' => 'instructor.dashboard', default => 'student.dashboard' };
@endphp
<x-nav-item href="{{ route($dashRoute) }}" :active="false"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>'>
    Dashboard
</x-nav-item>
<div class="mt-4 mb-1 px-3"><p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Akun</p></div>
<x-nav-item href="{{ route('profile.edit') }}" :active="true"
    icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>'>
    Edit Profil
</x-nav-item>
@endsection

@section('content')
<div class="max-w-3xl space-y-6">

    {{-- ==================== INFORMASI PROFIL ==================== --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="font-bold text-slate-900">Informasi Profil</h2>
                <p class="text-xs text-slate-400 mt-0.5">Perbarui nama, email, bio, dan foto profil Anda.</p>
            </div>

            <div class="p-6 space-y-5">

                {{-- Avatar --}}
                <div class="flex items-center gap-5">
                    <div class="relative group">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                 id="avatar-preview"
                                 class="w-20 h-20 rounded-2xl object-cover border-2 border-slate-100 shadow-sm">
                        @else
                            <div id="avatar-preview" class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white text-2xl font-bold shadow-sm">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <label for="avatar-input" class="absolute inset-0 rounded-2xl bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center cursor-pointer transition-opacity">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </label>
                        <input type="file" id="avatar-input" name="avatar" accept="image/jpeg,image/png,image/webp" class="hidden"
                               onchange="previewAvatar(this)">
                    </div>
                    <div class="space-y-1.5">
                        <label for="avatar-input" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 cursor-pointer transition-colors">
                            Ganti Foto
                        </label>
                        @if($user->avatar)
                        <form method="POST" action="{{ route('profile.avatar.delete') }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium transition-colors block">Hapus Foto</button>
                        </form>
                        @endif
                        <p class="text-xs text-slate-400">JPG, PNG, WebP · Maks 2MB</p>
                    </div>
                </div>
                @error('avatar')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full px-4 py-3 border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white' }} rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    @error('name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white' }} rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    @error('email')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>

                {{-- Bio --}}
                <div>
                    <label for="bio" class="block text-sm font-semibold text-slate-700 mb-1.5">Bio <span class="text-slate-400 font-normal">(opsional)</span></label>
                    <textarea id="bio" name="bio" rows="3" maxlength="500"
                              placeholder="Ceritakan sedikit tentang diri Anda..."
                              class="w-full px-4 py-3 border border-slate-200 bg-slate-50 focus:bg-white rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all resize-none">{{ old('bio', $user->bio) }}</textarea>
                    <p class="text-xs text-slate-400 mt-1 text-right"><span id="bio-count">{{ strlen(old('bio', $user->bio ?? '')) }}</span>/500</p>
                    @error('bio')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror
                </div>

                {{-- Role Info --}}
                <div class="bg-slate-50 rounded-xl p-4 flex items-center gap-3">
                    @php
                        $roleConfig = [
                            'admin'      => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'label' => 'Administrator'],
                            'instructor' => ['bg' => 'bg-violet-100', 'text' => 'text-violet-700', 'label' => 'Instruktur'],
                            'student'    => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-700', 'label' => 'Pelajar'],
                        ];
                        $rc = $roleConfig[$user->role] ?? $roleConfig['student'];
                    @endphp
                    <span class="text-xs font-bold px-2.5 py-1 rounded-lg {{ $rc['bg'] }} {{ $rc['text'] }}">{{ $rc['label'] }}</span>
                    <p class="text-xs text-slate-500">Role tidak dapat diubah. Hubungi admin jika diperlukan.</p>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold py-2.5 px-6 rounded-xl text-sm transition-all hover:shadow-lg hover:shadow-indigo-200">
                    Simpan Profil
                </button>
            </div>
        </div>
    </form>

    {{-- ==================== UBAH PASSWORD ==================== --}}
    <form method="POST" action="{{ route('profile.password') }}">
        @csrf @method('PUT')
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="font-bold text-slate-900">Ubah Password</h2>
                <p class="text-xs text-slate-400 mt-0.5">Pastikan menggunakan password yang kuat dan unik.</p>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label for="current_password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" required
                           placeholder="Masukkan password lama"
                           class="w-full px-4 py-3 border {{ $errors->has('current_password') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white' }} rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    @error('current_password')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="new_password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password Baru</label>
                    <input type="password" id="new_password" name="password" required
                           placeholder="Minimal 8 karakter"
                           class="w-full px-4 py-3 border {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white' }} rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    @error('password')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           placeholder="Ulangi password baru"
                           class="w-full px-4 py-3 border border-slate-200 bg-slate-50 focus:bg-white rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>
            </div>

            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex justify-end">
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-bold py-2.5 px-6 rounded-xl text-sm transition-all">
                    Ubah Password
                </button>
            </div>
        </div>
    </form>

    {{-- ==================== INFO AKUN ==================== --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6">
        <h2 class="font-bold text-slate-900 mb-4">Informasi Akun</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div class="bg-slate-50 rounded-xl p-4">
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Bergabung Sejak</p>
                <p class="font-semibold text-slate-800">{{ $user->created_at->translatedFormat('d F Y') }}</p>
            </div>
            @if($user->isStudent())
            <div class="bg-slate-50 rounded-xl p-4">
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Kursus Diikuti</p>
                <p class="font-semibold text-slate-800">{{ $user->enrollments()->count() }}</p>
            </div>
            @elseif($user->isInstructor())
            <div class="bg-slate-50 rounded-xl p-4">
                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider mb-1">Kursus Dibuat</p>
                <p class="font-semibold text-slate-800">{{ $user->courses()->count() }}</p>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const preview = document.getElementById('avatar-preview');
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-20 h-20 rounded-2xl object-cover border-2 border-slate-100 shadow-sm';
                img.id = 'avatar-preview';
                preview.replaceWith(img);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
// Bio character counter
const bioInput = document.getElementById('bio');
if (bioInput) {
    bioInput.addEventListener('input', () => {
        document.getElementById('bio-count').textContent = bioInput.value.length;
    });
}
</script>
@endpush
