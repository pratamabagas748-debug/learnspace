@extends('layouts.dashboard')
@section('title', 'Kelola User')
@section('page-title', 'Kelola User')
@section('page-subtitle', $users->total() . ' user terdaftar')

@section('topbar-actions')
<a href="{{ route('admin.users.create') }}"
   class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition-all hover:shadow-md hover:shadow-indigo-200">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
    Tambah User
</a>
@endsection

@section('sidebar-nav')
@include('admin.partials.sidebar')
@endsection

@section('content')
<div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide">User</th>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden md:table-cell">Email</th>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide">Role</th>
                <th class="text-left px-5 py-3.5 font-semibold text-slate-500 text-xs uppercase tracking-wide hidden md:table-cell">Bergabung</th>
                <th class="px-5 py-3.5 text-right text-xs uppercase tracking-wide font-semibold text-slate-500">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @foreach($users as $user)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="w-8 h-8 rounded-full object-cover shrink-0" alt="">
                        @else
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs shrink-0
                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'instructor' ? 'bg-violet-100 text-violet-700' : 'bg-indigo-100 text-indigo-700') }}">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="font-semibold text-slate-800">{{ $user->name }}</span>
                    </div>
                </td>
                <td class="px-5 py-3.5 text-slate-500 hidden md:table-cell text-xs">{{ $user->email }}</td>
                <td class="px-5 py-3.5">
                    <span class="text-xs font-semibold capitalize px-2.5 py-1 rounded-full
                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'instructor' ? 'bg-violet-100 text-violet-700' : 'bg-blue-100 text-blue-700') }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td class="px-5 py-3.5 text-slate-400 hidden md:table-cell text-xs">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-5 py-3.5 text-right">
                    <div class="flex items-center gap-2 justify-end opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-xs bg-indigo-50 text-indigo-700 hover:bg-indigo-100 px-2.5 py-1.5 rounded-lg font-semibold transition-colors">Edit</a>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                            @csrf @method('DELETE')
                            <button class="text-xs bg-red-50 text-red-600 hover:bg-red-100 px-2.5 py-1.5 rounded-lg font-semibold transition-colors">Hapus</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if($users->hasPages())
<div class="mt-5">{{ $users->links() }}</div>
@endif
@endsection