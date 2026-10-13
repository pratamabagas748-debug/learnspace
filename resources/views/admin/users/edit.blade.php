@extends('layouts.dashboard')
@section('title', 'Edit User')
@section('page-title', 'Edit User')
@section('page-subtitle', $user->name)
@section('sidebar-nav')
@include('admin.partials.sidebar')
@endsection

@section('content')
<div class="mb-5">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar User
    </a>
</div>

<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf @method('PUT')
    <div class="max-w-lg">
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-6 space-y-5">
        <h2 class="font-bold text-slate-900 text-sm pb-1 border-b border-slate-100">Data User</h2>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                   class="w-full px-4 py-3 border {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white' }} rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
            @error('name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                   class="w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-200 bg-slate-50 focus:bg-white' }} rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
            @error('email')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
            <select name="role" required class="w-full px-4 py-3 border border-slate-200 bg-slate-50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>Student</option>
                <option value="instructor" {{ old('role', $user->role) === 'instructor' ? 'selected' : '' }}>Instructor</option>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password <span class="text-slate-400 font-normal">(kosongkan jika tidak diubah)</span></label>
            <input type="password" name="password"
                   class="w-full px-4 py-3 border border-slate-200 bg-slate-50 focus:bg-white rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
            @error('password')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
        </div>

        {{-- Info --}}
        <div class="bg-slate-50 rounded-xl p-4 text-xs text-slate-500 space-y-1">
            <p><span class="font-semibold text-slate-700">Bergabung:</span> {{ $user->created_at->format('d M Y, H:i') }}</p>
            <p><span class="font-semibold text-slate-700">Terakhir diubah:</span> {{ $user->updated_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold py-2.5 px-6 rounded-xl text-sm transition-all hover:shadow-lg hover:shadow-indigo-200">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-slate-500 px-4 py-2.5 rounded-xl hover:bg-slate-100 transition-colors">Batal</a>
        </div>
    </div>
    </div>
</form>
@endsection