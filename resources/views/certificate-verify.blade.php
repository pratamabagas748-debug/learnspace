@extends('layouts.app')

@section('title', 'Verifikasi Sertifikat - LearnSpace')

@section('content')
<div class="min-h-[80vh] py-16 px-4 bg-slate-950 text-slate-100 flex items-center justify-center relative overflow-hidden"
     style="background: linear-gradient(135deg, #090d16 0%, #0f172a 45%, #1e1b4b 100%) !important;">
    
    {{-- Glow background --}}
    <div class="absolute w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-3xl pointer-events-none -top-20 -right-20"></div>
    <div class="absolute w-[400px] h-[400px] bg-amber-500/10 rounded-full blur-3xl pointer-events-none -bottom-20 -left-20"></div>

    <div class="max-w-2xl w-full relative z-10">
        
        {{-- Card Container --}}
        <div class="bg-slate-900/90 backdrop-blur-xl border border-slate-800 rounded-3xl p-8 sm:p-12 shadow-2xl">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-800/80 border border-slate-700/60 text-xs font-semibold text-slate-300 mb-4">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Sistem Validasi Kredensial Resmi
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Verifikasi Sertifikat Digital</h1>
                <p class="text-slate-400 text-sm mt-2">Periksa keabsahan dan keaslian kredensial lulusan LearnSpace Academy</p>
            </div>

            @if($isValid && $enrollment)
                {{-- Verified Success Card --}}
                <div class="bg-emerald-950/40 border border-emerald-500/40 rounded-2xl p-6 mb-8 text-center">
                    <div class="w-16 h-16 rounded-full bg-emerald-500/20 border-2 border-emerald-400 flex items-center justify-center mx-auto mb-3 shadow-lg shadow-emerald-500/10">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="inline-block text-emerald-400 text-xs font-black uppercase tracking-widest bg-emerald-900/60 px-3 py-1 rounded-full border border-emerald-500/30 mb-2">
                        ✓ Kredensial Terverifikasi & Asli
                    </span>
                    <h2 class="text-xl font-bold text-white mt-1">Sertifikat Resmi Terdaftar</h2>
                    <p class="text-slate-300 text-xs mt-1">Kredensial ini terdaftar secara valid dalam database akademik LearnSpace.</p>
                </div>

                {{-- Graduate Details Table --}}
                <div class="space-y-4 bg-slate-950/60 rounded-2xl p-6 border border-slate-800/80 mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-slate-800/80 gap-1">
                        <span class="text-xs uppercase font-bold tracking-wider text-slate-400">Nama Lulusan</span>
                        <span class="text-base font-bold text-white">{{ $enrollment->user->name }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-slate-800/80 gap-1">
                        <span class="text-xs uppercase font-bold tracking-wider text-slate-400">Program Kursus</span>
                        <span class="text-sm font-semibold text-indigo-300">{{ $enrollment->course->title }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-slate-800/80 gap-1">
                        <span class="text-xs uppercase font-bold tracking-wider text-slate-400">Instruktur</span>
                        <span class="text-sm font-semibold text-slate-200">{{ $enrollment->course->instructor->name }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-slate-800/80 gap-1">
                        <span class="text-xs uppercase font-bold tracking-wider text-slate-400">Tanggal Kelulusan</span>
                        <span class="text-sm font-semibold text-slate-200">{{ $enrollment->completed_at ? $enrollment->completed_at->translatedFormat('d F Y') : '-' }}</span>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                        <span class="text-xs uppercase font-bold tracking-wider text-slate-400">ID Sertifikat</span>
                        <span class="font-mono text-xs font-bold text-amber-400 bg-amber-950/60 px-2.5 py-1 rounded border border-amber-600/30">
                            {{ $enrollment->certificate_number }}
                        </span>
                    </div>
                </div>

            @else
                {{-- Invalid Certificate Warning --}}
                <div class="bg-rose-950/40 border border-rose-500/40 rounded-2xl p-6 mb-8 text-center">
                    <div class="w-16 h-16 rounded-full bg-rose-500/20 border-2 border-rose-400 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <span class="inline-block text-rose-400 text-xs font-black uppercase tracking-widest bg-rose-900/60 px-3 py-1 rounded-full border border-rose-500/30 mb-2">
                        Kredensial Tidak Ditemukan
                    </span>
                    <h2 class="text-lg font-bold text-white mt-1">Nomor Sertifikat Tidak Valid</h2>
                    <p class="text-slate-300 text-xs mt-1">Kode "{{ $code }}" tidak cocok dengan rekaman kelulusan aktif manapun di LearnSpace.</p>
                </div>
            @endif

            <div class="flex items-center justify-center gap-4">
                <a href="{{ route('courses.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white transition-colors">
                    ← Jelajahi Kursus Lainnya
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
