@extends('layouts.dashboard')
@section('title', 'Peserta Kursus')
@section('page-title', 'Peserta: ' . $course->title)

@section('sidebar-nav')
    <a href="{{ route('instructor.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-100 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('instructor.courses.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-indigo-50 text-indigo-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Kursus Saya
    </a>
@endsection

@section('content')
<div class="mb-5">
    <a href="{{ route('instructor.courses.index') }}" class="inline-flex items-center gap-2 text-sm text-indigo-600 hover:underline">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Kursus
    </a>
</div>

<div class="bg-white border border-slate-200 rounded-2xl p-5 mb-6">
    <h2 class="font-semibold text-slate-800">{{ $course->title }}</h2>
    <p class="text-sm text-slate-500 mt-1">Total peserta: <span class="font-semibold text-slate-700">{{ $students->total() }}</span></p>
</div>

@if($students->isNotEmpty())
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="text-left px-5 py-3 font-medium text-slate-500">Nama</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500 hidden md:table-cell">Email</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500">Terdaftar Sejak</th>
                <th class="text-left px-5 py-3 font-medium text-slate-500 hidden md:table-cell">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($students as $student)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold text-xs shrink-0">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>
                        <span class="font-medium text-slate-800">{{ $student->name }}</span>
                    </div>
                </td>
                <td class="px-5 py-4 text-slate-500 hidden md:table-cell">{{ $student->email }}</td>
                <td class="px-5 py-4 text-slate-500">
                    {{ $student->pivot->enrolled_at ? \Carbon\Carbon::parse($student->pivot->enrolled_at)->format('d M Y') : '-' }}
                </td>
                <td class="px-5 py-4 hidden md:table-cell">
                    @if($student->pivot->completed_at)
                        <span class="text-xs font-semibold bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-full">Selesai</span>
                    @else
                        <span class="text-xs font-semibold bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full">Berlangsung</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $students->links() }}</div>
@else
<div class="text-center py-16 bg-white rounded-2xl border border-slate-200">
    <p class="text-slate-500">Belum ada peserta yang mendaftar ke kursus ini.</p>
</div>
@endif
@endsection
