<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kelulusan - {{ $course->title }} | LearnSpace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .cert-border {
            border: 3px double #d97706;
            box-shadow: inset 0 0 0 12px #fff, inset 0 0 0 14px #b45309;
        }
        @media print {
            body { background: #fff !important; padding: 0 !important; margin: 0 !important; }
            .no-print { display: none !important; }
            .cert-container { box-shadow: none !important; border-radius: 0 !important; max-width: 100% !important; margin: 0 !important; width: 100% !important; height: 100vh !important; }
            @page { size: landscape; margin: 0; }
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen py-10 px-4 antialiased flex flex-col items-center justify-center selection:bg-amber-500 selection:text-white">

    {{-- Control Buttons (Hidden on Print) --}}
    <div class="no-print max-w-5xl w-full flex items-center justify-between mb-6">
        <a href="{{ route('student.courses.show', $course->slug) }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors bg-slate-900/80 px-4 py-2.5 rounded-xl border border-slate-800">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Kursus
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('certificate.verify', $enrollment->certificate_number) }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-amber-400 bg-amber-950/40 border border-amber-600/40 hover:bg-amber-900/40 px-4 py-2.5 rounded-xl font-medium transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Verifikasi Online
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 text-sm font-bold text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-yellow-500 hover:from-amber-300 hover:to-yellow-400 px-6 py-2.5 rounded-xl shadow-lg shadow-amber-500/20 transition-all hover:scale-[1.02] cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak / Simpan PDF
            </button>
        </div>
    </div>

    {{-- Main Luxury Certificate Diploma --}}
    <div class="cert-container max-w-5xl w-full bg-[#fdfcfa] text-slate-900 rounded-3xl p-8 sm:p-14 shadow-2xl relative overflow-hidden cert-border">
        
        {{-- Luxury Background Elements --}}
        <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-amber-100/40 blur-3xl pointer-events-none"></div>
        <div class="absolute -left-20 -top-20 w-80 h-80 rounded-full bg-amber-100/40 blur-3xl pointer-events-none"></div>

        {{-- Watermark Seal --}}
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none select-none">
            <svg class="w-[600px] h-[600px]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>

        <div class="relative z-10 flex flex-col items-center text-center">
            
            {{-- Header & Brand --}}
            <div class="flex items-center gap-3 mb-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-amber-500 to-yellow-300 flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-slate-950 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <span class="font-cinzel text-2xl font-extrabold tracking-widest text-slate-900">LEARNSPACE</span>
            </div>

            <p class="font-cinzel text-xs font-bold tracking-[0.35em] text-amber-700 uppercase mb-8">
                Official Certificate of Excellence & Completion
            </p>

            <h1 class="font-cinzel text-3xl sm:text-5xl font-black text-slate-900 tracking-wide mb-6 uppercase">
                Sertifikat Kelulusan
            </h1>

            <p class="text-sm font-medium text-slate-500 mb-4 tracking-wide uppercase">Diberikan secara terhormat kepada:</p>

            {{-- Graduate Name --}}
            <div class="mb-5 border-b-2 border-amber-600/40 pb-3 px-8 inline-block max-w-2xl">
                <h2 class="font-playfair text-3xl sm:text-5xl font-bold text-amber-950 italic tracking-tight">
                    {{ $user->name }}
                </h2>
            </div>

            <p class="text-slate-600 max-w-2xl text-sm sm:text-base leading-relaxed mb-6 font-normal">
                Telah berhasil menyelesaikan seluruh kurikulum materi pelatihan teknis dan ujian praktik pada program kursus profesional berstandar industri:
            </p>

            {{-- Course Title --}}
            <div class="bg-amber-500/10 border border-amber-600/20 rounded-2xl py-3 px-6 sm:px-10 mb-8 inline-block shadow-sm">
                <h3 class="font-cinzel text-lg sm:text-2xl font-bold text-slate-900 tracking-tight">
                    {{ $course->title }}
                </h3>
                <p class="text-xs font-semibold text-amber-800 tracking-wider uppercase mt-1">
                    Kategori: {{ $course->category->name }} · Tingkat {{ ucfirst($course->level) }}
                </p>
            </div>

            {{-- Signatures & Seal Section --}}
            <div class="w-full grid grid-cols-1 md:grid-cols-3 items-end gap-8 pt-4 border-t border-slate-200 mt-4">
                
                {{-- Left: Date & Certificate ID --}}
                <div class="text-left md:text-left flex flex-col items-center md:items-start">
                    <p class="text-xs uppercase tracking-wider text-slate-400 font-bold mb-1">Tanggal Kelulusan</p>
                    <p class="text-sm font-semibold text-slate-800 mb-4">{{ $enrollment->completed_at ? $enrollment->completed_at->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }}</p>
                    
                    <p class="text-xs uppercase tracking-wider text-slate-400 font-bold mb-1">Nomor Sertifikat</p>
                    <p class="font-mono text-xs font-bold text-amber-900 bg-amber-100/70 px-2.5 py-1 rounded border border-amber-300">
                        {{ $enrollment->certificate_number }}
                    </p>
                </div>

                {{-- Center: Official Gold Seal Badge --}}
                <div class="flex flex-col items-center justify-center">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-amber-600 via-amber-400 to-yellow-200 p-1 shadow-xl flex items-center justify-center">
                        <div class="w-full h-full rounded-full bg-[#fdfcfa] border-2 border-dashed border-amber-600 flex flex-col items-center justify-center text-center p-2">
                            <svg class="w-6 h-6 text-amber-600 mb-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="font-cinzel text-[8px] font-black uppercase text-amber-900 leading-tight">Verified<br>Credential</span>
                        </div>
                    </div>
                </div>

                {{-- Right: Instructor Signature --}}
                <div class="flex flex-col items-center md:items-end text-center md:text-right">
                    <div class="h-12 flex items-center justify-center mb-1">
                        <span class="font-playfair text-2xl italic font-bold text-slate-800 tracking-wider">
                            {{ $course->instructor->name }}
                        </span>
                    </div>
                    <div class="w-48 border-t-2 border-slate-800 pt-1.5">
                        <p class="text-xs font-bold text-slate-900">{{ $course->instructor->name }}</p>
                        <p class="text-[11px] text-slate-500 font-medium">Head Instructor · LearnSpace Academy</p>
                    </div>
                </div>

            </div>

            {{-- Verification QR info at footer --}}
            <div class="mt-8 pt-4 border-t border-slate-100 flex flex-wrap items-center justify-between w-full text-slate-400 text-[10px]">
                <p>Verifikasi keaslian dokumen ini dapat dilakukan di <span class="font-mono text-slate-600">{{ route('certificate.verify', $enrollment->certificate_number) }}</span></p>
                <p>© {{ date('Y') }} LearnSpace Education Inc. All Rights Reserved.</p>
            </div>

        </div>

    </div>

</body>
</html>
