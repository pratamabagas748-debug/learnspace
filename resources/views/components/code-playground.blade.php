@props(['course' => null, 'lesson' => null])

@php
    $categoryName = strtolower($course->category->name ?? '');
    $courseTitle = strtolower($course->title ?? '');

    $isHtmlCss = str_contains($courseTitle, 'html') || str_contains($courseTitle, 'css') || str_contains($categoryName, 'css');
    $isJs = str_contains($courseTitle, 'javascript') || str_contains($courseTitle, 'js') || str_contains($categoryName, 'javascript');

    if ($isJs) {
        $challengeTitle = 'Tantangan: Interaktivitas Tombol & Manipulasi DOM';
        $challengeDesc = 'Latih pemahaman JavaScript Anda dengan membuat tombol menjadi interaktif. Tulis kode logika event listener Anda sendiri!';
        $challengeSteps = [
            'Buka tab "JavaScript" pada editor di sebelah kiri.',
            'Ambil elemen tombol `#actionBtn`, teks `#count`, dan status `#status`.',
            'Tambahkan event listener `click` pada tombol tersebut.',
            'Di dalam event, tambah nilai `count` dan ubah teks status.',
            'Gunakan `console.log()` untuk mencetak pesan ke Konsol Virtual.',
            'Klik "Jalankan Kode" (atau tekan Ctrl+Enter), lalu uji klik tombol di Live Preview!',
        ];

        // Starter Code
        $defaultHtml = '<div class="wrapper">
  <div class="card">
    <div class="badge">Latihan Mandiri</div>
    <h2>Uji Logika Interaktif</h2>
    <p>Tombol ini belum memiliki aksi. Tulis kodenya di tab JavaScript!</p>
    <div class="stats">
      <span>Total Klik: <b id="count">0</b></span>
      <span>Status: <b id="status">Menunggu kodemu...</b></span>
    </div>
    <button id="actionBtn" class="btn" onclick="if(!window._hasUserListener){document.getElementById(\'status\').textContent=\'⚠️ Tulis kodenya di tab JS!\';}">👉 Klik Saya</button>
  </div>
</div>';

        $defaultCss = '* {
  box-sizing: border-box;
}
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
}
body {
  padding: 16px;
  background: #090d16;
  font-family: system-ui, -apple-system, sans-serif;
  color: #f8fafc;
  display: flex;
  justify-content: center;
  align-items: center;
}
.wrapper {
  width: 100%;
  max-width: 320px;
}
.card {
  background: #111827;
  border: 1px solid #1f2937;
  border-radius: 16px;
  padding: 18px;
  box-shadow: 0 10px 25px -5px rgba(0,0,0,0.5);
  text-align: left;
}
.badge {
  display: inline-block;
  background: rgba(99, 102, 241, 0.15);
  color: #a5b4fc;
  border: 1px solid rgba(99, 102, 241, 0.3);
  font-size: 10px;
  font-weight: 700;
  padding: 3px 9px;
  border-radius: 999px;
  margin-bottom: 10px;
}
h2 {
  margin: 0 0 6px;
  font-size: 17px;
  font-weight: 700;
  color: #ffffff;
}
p {
  font-size: 12px;
  color: #9ca3af;
  margin: 0 0 14px;
  line-height: 1.4;
}
.stats {
  display: flex;
  justify-content: space-between;
  background: #1f2937;
  padding: 8px 12px;
  border-radius: 10px;
  font-size: 11px;
  margin-bottom: 14px;
}
.stats b {
  color: #38bdf8;
}
.btn {
  width: 100%;
  background: linear-gradient(135deg, #4f46e5, #6366f1);
  color: white;
  border: none;
  padding: 10px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 12px;
  cursor: pointer;
  transition: transform 0.1s, opacity 0.2s;
}
.btn:hover {
  opacity: 0.92;
}
.btn:active {
  transform: scale(0.97);
}';

        $defaultJs = '// 🎯 TANTANGAN: Tulis logika JavaScript Anda di bawah ini!
// 1. Ambil elemen yang diperlukan:
const btn = document.getElementById("actionBtn");
const countEl = document.getElementById("count");
const statusEl = document.getElementById("status");

let count = 0;

// TODO: Tambahkan event listener "click" pada tombol:
// btn.addEventListener("click", () => {
//     window._hasUserListener = true;
//     count++;
//     countEl.textContent = count;
//     statusEl.textContent = "Tombol Berhasil Merespons!";
//     statusEl.style.color = "#34d399";
//     console.log(`[Event] Tombol diklik sebanyak ${count} kali!`);
// });

// TULIS KODEMU DI SINI:
';

        // Solusi Referensi
        $solutionHtml = $defaultHtml;
        $solutionCss = $defaultCss;
        $solutionJs = 'const btn = document.getElementById("actionBtn");
const countEl = document.getElementById("count");
const statusEl = document.getElementById("status");

let count = 0;

btn.addEventListener("click", () => {
    window._hasUserListener = true;
    count++;
    countEl.textContent = count;
    statusEl.textContent = "Tombol Berhasil Merespons! ✓";
    statusEl.style.color = "#34d399";
    console.log(`[Event] Tombol diklik ke-${count}. Logika koding berjalan lancar!`);
});

console.log("Kode solusi aktif! Coba klik tombol di Live Preview.");';
        $preferredTab = 'js';

    } elseif ($isHtmlCss) {
        $challengeTitle = 'Tantangan: Desain & Styling Kartu Modern';
        $challengeDesc = 'Rancang dan percantik tampilan kartu web menggunakan HTML & CSS kreasi Anda sendiri!';
        $challengeSteps = [
            'Buka tab "HTML" untuk mengubah konten dan struktur kartu.',
            'Buka tab "CSS" untuk menulis styling kartu (`.card`) dan tombol (`.btn`).',
            'Eksperimen dengan background warna, border-radius, padding, atau efek hover.',
            'Klik tombol "Jalankan Kode" (atau Ctrl+Enter) untuk melihat preview perubahannya.',
        ];

        $defaultHtml = '<div class="card">
  <div class="icon">🚀</div>
  <h2>Judul Kartu Anda</h2>
  <p>Tuliskan deskripsi atau konten kreatif Anda di sini. Atur gayanya di tab CSS!</p>
  <button class="btn">Mulai Belajar →</button>
</div>';

        $defaultCss = '* {
  box-sizing: border-box;
}
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
}
body {
  padding: 16px;
  background: #0f172a;
  font-family: system-ui, sans-serif;
  color: #f8fafc;
  display: flex;
  align-items: center;
  justify-content: center;
}
.card {
  background: #1e293b;
  border: 1px solid #334155;
  border-radius: 16px;
  padding: 20px;
  max-width: 320px;
  width: 100%;
  text-align: center;
  /* TODO: Tambahkan efek gradien atau bayangan di sini */
}
.icon {
  font-size: 32px;
  margin-bottom: 10px;
}
h2 {
  font-size: 17px;
  margin: 0 0 8px;
}
p {
  font-size: 12px;
  color: #94a3b8;
  line-height: 1.5;
  margin: 0 0 16px;
}
.btn {
  background: #6366f1;
  color: white;
  border: none;
  padding: 10px 18px;
  border-radius: 8px;
  font-weight: 700;
  font-size: 12px;
  cursor: pointer;
  transition: all 0.2s ease;
}
.btn:hover {
  background: #4f46e5;
  transform: translateY(-1px);
}';

        $defaultJs = '// Opsional: Tulis JavaScript interaktif jika diinginkan
console.log("Ketik styling CSS-mu di editor dan klik \'Jalankan Kode\'!");';

        $solutionHtml = $defaultHtml;
        $solutionCss = '* { box-sizing: border-box; }
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
}
body {
  padding: 16px;
  background: radial-gradient(circle at top right, #312e81, #0f172a 75%);
  font-family: system-ui, sans-serif;
  color: #f8fafc;
  display: flex;
  align-items: center;
  justify-content: center;
}
.card {
  background: rgba(30, 41, 59, 0.85);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 20px;
  padding: 22px;
  max-width: 320px;
  width: 100%;
  text-align: center;
  box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.5);
}
.icon { font-size: 34px; margin-bottom: 10px; }
h2 { font-size: 18px; margin: 0 0 8px; color: #fff; }
p { font-size: 12px; color: #cbd5e1; line-height: 1.5; margin: 0 0 16px; }
.btn {
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 12px;
  cursor: pointer;
  box-shadow: 0 4px 14px rgba(99, 102, 241, 0.4);
  transition: transform 0.2s, box-shadow 0.2s;
}
.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(99, 102, 241, 0.6);
}';
        $solutionJs = 'console.log("Styling solusi CSS modern berhasil dimuat!");';
        $preferredTab = 'css';

    } else {
        $challengeTitle = 'Tantangan: Logika Fungsi & Algoritma';
        $challengeDesc = 'Latih kemampuan logika Anda dengan melengkapi fungsi perhitungan data di bawah ini!';
        $challengeSteps = [
            'Buka tab "JavaScript" untuk melihat fungsi `hitungDiskon()`.',
            'Lengkapi rumus di dalam fungsi sesuai instruksi komentar.',
            'Cetak hasilnya dengan `console.log()` untuk melihat output.',
            'Klik "Jalankan Kode" (atau Ctrl+Enter) untuk memverifikasi kalkulasi Anda.',
        ];

        $defaultHtml = '<div class="box">
  <h3>⚡ Latihan Algoritma & Perhitungan</h3>
  <p>Lengkapi fungsi di tab JavaScript untuk menyelesaikan tantangan ini:</p>
  <div class="result-box">
    <span>Hasil Kalkulasi:</span>
    <code id="resultArea">Menunggu kodemu...</code>
  </div>
</div>';

        $defaultCss = '* { box-sizing: border-box; }
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
}
body {
  padding: 16px;
  background: #0b0f19;
  font-family: system-ui, sans-serif;
  color: #f8fafc;
  display: flex;
  align-items: center;
  justify-content: center;
}
.box {
  background: #111827;
  border: 1px solid #1f2937;
  border-radius: 14px;
  padding: 20px;
  max-width: 340px;
  width: 100%;
}
h3 { margin: 0 0 6px; font-size: 16px; color: #fff; }
p { margin: 0 0 14px; font-size: 12px; color: #94a3b8; line-height: 1.4; }
.result-box {
  background: #030712;
  border: 1px solid #1f2937;
  border-radius: 10px;
  padding: 12px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 12px;
}
code {
  color: #38bdf8;
  font-family: monospace;
  font-size: 13px;
  font-weight: bold;
}';

        $defaultJs = '// 🎯 TANTANGAN: Lengkapi fungsi kalkulasi diskon berikut:
// Hitung harga akhir: hargaAwal - (hargaAwal * persenDiskon / 100)

function hitungDiskon(hargaAwal, persenDiskon) {
    // TODO: Tulis rumus perhitungan Anda di sini:
    
    return 0; // Ganti nilai return ini dengan hasil rumus Anda
}

// Uji fungsi dengan nilai:
const harga = 150000;
const diskon = 20; // 20%
const hargaAkhir = hitungDiskon(harga, diskon);

console.log("Harga Awal: Rp", harga);
console.log("Diskon:", diskon + "%");
console.log("Harga Akhir:", hargaAkhir);

const el = document.getElementById("resultArea");
if (hargaAkhir > 0) {
    el.textContent = `Rp ${hargaAkhir.toLocaleString("id-ID")}`;
    el.style.color = "#34d399";
} else {
    el.textContent = "Belum diisi! Lengkapi fungsi di editor.";
    el.style.color = "#f59e0b";
}
';

        $solutionHtml = $defaultHtml;
        $solutionCss = $defaultCss;
        $solutionJs = 'function hitungDiskon(hargaAwal, persenDiskon) {
    const potongan = (hargaAwal * persenDiskon) / 100;
    return hargaAwal - potongan;
}

const harga = 150000;
const diskon = 20;
const hargaAkhir = hitungDiskon(harga, diskon);

console.log(`[Sukses] Harga setelah diskon 20%: Rp ${hargaAkhir.toLocaleString("id-ID")}`);

const el = document.getElementById("resultArea");
el.textContent = `Rp ${hargaAkhir.toLocaleString("id-ID")}`;
el.style.color = "#34d399";';
        $preferredTab = 'js';
    }
@endphp

{{-- Interactive Playground Container --}}
<div x-data="learnSpacePlayground()" class="mt-8 mb-6 border border-slate-800 bg-[#0d1117] rounded-3xl overflow-hidden shadow-2xl">
    
    {{-- Header Bar --}}
    <div class="px-5 py-3.5 bg-slate-900 border-b border-slate-800 flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-indigo-500 to-violet-500 flex items-center justify-center text-white shadow-md shadow-indigo-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-white">Live Code Playground</span>
                    <span class="text-[10px] bg-amber-500/20 text-amber-300 font-bold px-2 py-0.5 rounded-full border border-amber-500/30 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                        Latihan Mandiri
                    </span>
                </div>
                <p class="text-[11px] text-slate-400">Tulis dan uji kodemu sendiri secara langsung di browser</p>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center gap-2">
            <button @click="showSolutionModal = true" type="button" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-amber-300 hover:text-white bg-amber-500/10 hover:bg-amber-500/20 transition-all border border-amber-500/30 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                Contoh Solusi
            </button>
            <button @click="resetCode()" type="button" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-400 hover:text-white bg-slate-800 hover:bg-slate-700/80 transition-all border border-slate-700/60 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Reset Soal
            </button>
            <button @click="runCode()" type="button" class="px-4 py-1.5 rounded-lg text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 transition-all shadow-md shadow-emerald-600/30 flex items-center gap-1.5 hover:scale-[1.02]">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
                Jalankan Kode
            </button>
        </div>
    </div>

    {{-- Interactive Challenge Instructions Banner --}}
    <div class="px-5 py-3 bg-slate-950/80 border-b border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
        <div class="flex items-start gap-2.5">
            <span class="w-5 h-5 rounded-md bg-indigo-500/20 text-indigo-400 font-bold flex items-center justify-center shrink-0 mt-0.5 text-[11px]">🎯</span>
            <div>
                <p class="font-bold text-slate-200">{{ $challengeTitle }}</p>
                <p class="text-slate-400 text-[11px] mt-0.5">{{ $challengeDesc }}</p>
            </div>
        </div>
        <button type="button" @click="showSteps = !showSteps" class="text-[11px] font-semibold text-indigo-400 hover:text-indigo-300 transition-colors flex items-center gap-1 shrink-0 self-start sm:self-auto">
            <span x-text="showSteps ? 'Sembunyikan Petunjuk' : 'Lihat Langkah Misi'"></span>
            <svg class="w-3 h-3 transition-transform" :class="showSteps ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
    </div>

    {{-- Collapsible Steps --}}
    <div x-show="showSteps" x-collapse class="px-5 py-3 bg-[#0a0d14] border-b border-slate-800/80 text-[11px] text-slate-300">
        <p class="font-bold text-slate-400 uppercase tracking-wider mb-2 text-[10px]">Langkah Misi Tantangan:</p>
        <ol class="space-y-1.5 list-decimal list-inside text-slate-300 leading-relaxed">
            @foreach($challengeSteps as $step)
                <li>{!! $step !!}</li>
            @endforeach
        </ol>
    </div>

    {{-- Main Workspace Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 lg:divide-x divide-slate-800">
        
        {{-- Left: Code Editors with Tabs --}}
        <div class="flex flex-col bg-[#0b0e14]">
            
            {{-- Tabs --}}
            <div class="flex items-center border-b border-slate-800 px-3 bg-slate-950/60">
                <button type="button" @click="activeTab = 'html'" :class="activeTab === 'html' ? 'text-indigo-400 border-indigo-500 bg-slate-900/80' : 'text-slate-400 border-transparent hover:text-slate-200'" class="px-3.5 py-2 text-xs font-bold border-b-2 flex items-center gap-1.5 transition-all">
                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                    <span>HTML</span>
                </button>
                <button type="button" @click="activeTab = 'css'" :class="activeTab === 'css' ? 'text-indigo-400 border-indigo-500 bg-slate-900/80' : 'text-slate-400 border-transparent hover:text-slate-200'" class="px-3.5 py-2 text-xs font-bold border-b-2 flex items-center gap-1.5 transition-all">
                    <span class="w-2 h-2 rounded-full bg-sky-400"></span>
                    <span>CSS</span>
                </button>
                <button type="button" @click="activeTab = 'js'" :class="activeTab === 'js' ? 'text-indigo-400 border-indigo-500 bg-slate-900/80' : 'text-slate-400 border-transparent hover:text-slate-200'" class="px-3.5 py-2 text-xs font-bold border-b-2 flex items-center gap-1.5 transition-all">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span>JavaScript</span>
                </button>
                <div class="ml-auto text-[10px] text-slate-500 hidden sm:block">Tekan Ctrl+Enter untuk Run | Tab untuk Indent</div>
            </div>

            {{-- Textarea Editors --}}
            <div class="relative flex-1 min-h-[480px]">
                <textarea x-show="activeTab === 'html'" x-model="htmlCode" @keydown.ctrl.enter.prevent="runCode()" @keydown.tab.prevent="insertTab($event)" spellcheck="false"
                          placeholder="Tulis kode HTML Anda di sini..."
                          class="w-full h-full min-h-[480px] p-4 bg-transparent text-slate-200 font-mono text-xs leading-relaxed focus:outline-none resize-none selection:bg-indigo-600/40"></textarea>

                <textarea x-show="activeTab === 'css'" x-model="cssCode" @keydown.ctrl.enter.prevent="runCode()" @keydown.tab.prevent="insertTab($event)" spellcheck="false"
                          placeholder="Tulis kode CSS Anda di sini..."
                          class="w-full h-full min-h-[480px] p-4 bg-transparent text-slate-200 font-mono text-xs leading-relaxed focus:outline-none resize-none selection:bg-indigo-600/40"></textarea>

                <textarea x-show="activeTab === 'js'" x-model="jsCode" @keydown.ctrl.enter.prevent="runCode()" @keydown.tab.prevent="insertTab($event)" spellcheck="false"
                          placeholder="Tulis kode JavaScript Anda di sini..."
                          class="w-full h-full min-h-[480px] p-4 bg-transparent text-slate-200 font-mono text-xs leading-relaxed focus:outline-none resize-none selection:bg-indigo-600/40"></textarea>
            </div>

            {{-- Editor Footer info --}}
            <div class="px-4 py-2 bg-slate-950/80 border-t border-slate-800 text-[10px] text-slate-500 flex items-center justify-between">
                <span>Tab aktif: <b class="uppercase text-slate-400" x-text="activeTab"></b></span>
                <span>Gunakan tab di atas untuk berganti file</span>
            </div>

        </div>

        {{-- Right: Live Preview & Virtual Console Output --}}
        <div class="flex flex-col bg-[#0b0e14]">
            
            {{-- Preview Window Header (Browser Mockup Style) --}}
            <div class="px-4 py-2 bg-slate-950 border-b border-slate-800 flex items-center justify-between text-xs font-bold text-slate-300">
                <div class="flex items-center gap-2">
                    <div class="flex items-center gap-1.5 mr-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
                    </div>
                    <span>Live Preview</span>
                </div>
                <div class="flex items-center gap-1.5 font-mono text-[10px] px-2.5 py-0.5 rounded-full" :class="{
                    'bg-slate-800 text-slate-400': execStatus === 'idle',
                    'bg-blue-500/20 text-blue-300': execStatus === 'running',
                    'bg-emerald-500/20 text-emerald-300': execStatus === 'ready',
                    'bg-rose-500/20 text-rose-300': execStatus === 'error'
                }">
                    <span :class="{
                        'bg-slate-400': execStatus === 'idle',
                        'bg-blue-400 animate-pulse': execStatus === 'running',
                        'bg-emerald-400': execStatus === 'ready',
                        'bg-rose-400': execStatus === 'error'
                    }" class="w-1.5 h-1.5 rounded-full"></span>
                    <span x-text="statusLabel"></span>
                </div>
            </div>

            {{-- Live Iframe Preview Area --}}
            <div class="bg-[#090d16] min-h-[360px] h-[360px] sm:h-[380px] flex-1 overflow-hidden relative">
                <iframe id="playgroundPreviewFrame" class="w-full h-full border-0 block" sandbox="allow-scripts allow-modals allow-same-origin"></iframe>
            </div>

            {{-- Virtual Terminal Console --}}
            <div class="border-t border-slate-800 bg-[#07090e]">
                <div class="px-4 py-1.5 bg-slate-950 border-b border-slate-800/80 flex items-center justify-between">
                    <span class="text-[11px] font-bold text-slate-400 flex items-center gap-1.5 font-mono">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3"/></svg>
                        Konsol Virtual Output
                    </span>
                    <button type="button" @click="logs = []" class="text-[10px] text-slate-500 hover:text-slate-300 transition-colors">
                        Bersihkan
                    </button>
                </div>
                <div class="p-3 font-mono text-xs h-28 max-h-28 overflow-y-auto space-y-1">
                    <template x-for="(log, idx) in logs" :key="idx">
                        <div class="flex items-start gap-2 leading-relaxed text-[11px]">
                            <span class="text-slate-600 select-none text-[10px]" x-text="log.time"></span>
                            <span :class="{
                                'text-slate-300': log.type === 'log',
                                'text-sky-400': log.type === 'info',
                                'text-amber-400': log.type === 'warn',
                                'text-rose-400 font-semibold': log.type === 'error'
                            }" x-text="log.msg"></span>
                        </div>
                    </template>
                </div>
            </div>

        </div>

    </div>

    {{-- Modal: Contoh Solusi --}}
    <div x-show="showSolutionModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100">
        <div @click.away="showSolutionModal = false" class="bg-[#0f172a] border border-slate-700 rounded-2xl max-w-xl w-full p-5 shadow-2xl flex flex-col max-h-[85vh]">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3 mb-3">
                <div class="flex items-center gap-2">
                    <span class="text-amber-400 text-lg">💡</span>
                    <h4 class="font-bold text-white text-sm">Contoh Kunci Solusi</h4>
                </div>
                <button type="button" @click="showSolutionModal = false" class="text-slate-400 hover:text-white text-sm">✕</button>
            </div>
            
            <p class="text-xs text-slate-300 mb-3 leading-relaxed">
                Pilih tab di bawah untuk melihat referensi kode solusi yang tepat:
            </p>

            {{-- Modal Solution Tabs --}}
            <div class="flex items-center gap-2 mb-2">
                <button type="button" @click="solutionTab = 'js'" :class="solutionTab === 'js' ? 'bg-amber-500/20 text-amber-300 border-amber-500/40' : 'bg-slate-800 text-slate-400 border-transparent'" class="px-3 py-1 rounded-lg text-xs font-bold border transition-colors">
                    JavaScript
                </button>
                <button type="button" @click="solutionTab = 'css'" :class="solutionTab === 'css' ? 'bg-sky-500/20 text-sky-300 border-sky-500/40' : 'bg-slate-800 text-slate-400 border-transparent'" class="px-3 py-1 rounded-lg text-xs font-bold border transition-colors">
                    CSS
                </button>
                <button type="button" @click="solutionTab = 'html'" :class="solutionTab === 'html' ? 'bg-orange-500/20 text-orange-300 border-orange-500/40' : 'bg-slate-800 text-slate-400 border-transparent'" class="px-3 py-1 rounded-lg text-xs font-bold border transition-colors">
                    HTML
                </button>
            </div>

            <div class="bg-black/60 p-3 rounded-xl border border-slate-800/80 overflow-y-auto flex-1 font-mono text-xs text-slate-200 leading-relaxed mb-4 max-h-[300px]">
                <pre x-show="solutionTab === 'js'" class="whitespace-pre-wrap">{{ $solutionJs }}</pre>
                <pre x-show="solutionTab === 'css'" class="whitespace-pre-wrap">{{ $solutionCss }}</pre>
                <pre x-show="solutionTab === 'html'" class="whitespace-pre-wrap">{{ $solutionHtml }}</pre>
            </div>

            <div class="flex items-center justify-between gap-3 pt-2 border-t border-slate-800">
                <button type="button" @click="applySolution()" class="px-3.5 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition-colors flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    Terapkan Solusi ke Editor
                </button>
                <button type="button" @click="showSolutionModal = false" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>

<script>
    (function() {
        function playgroundFactory() {
            const initialHtml = @json($defaultHtml);
            const initialCss = @json($defaultCss);
            const initialJs = @json($defaultJs);

            const solutionHtml = @json($solutionHtml);
            const solutionCss = @json($solutionCss);
            const solutionJs = @json($solutionJs);

            return {
                activeTab: @json($preferredTab),
                solutionTab: @json($preferredTab),
                htmlCode: initialHtml,
                cssCode: initialCss,
                jsCode: initialJs,
                logs: [],
                showSteps: true,
                showSolutionModal: false,
                execStatus: 'idle', // idle, running, ready, error

                get statusLabel() {
                    if (this.execStatus === 'running') return 'Memperbarui Preview...';
                    if (this.execStatus === 'ready') return 'Pratinjau Aktif';
                    if (this.execStatus === 'error') return 'Error Terdeteksi';
                    return 'Preview Siap';
                },

                insertTab(e) {
                    const el = e.target;
                    const start = el.selectionStart;
                    const end = el.selectionEnd;
                    const spaces = "  ";
                    el.value = el.value.substring(0, start) + spaces + el.value.substring(end);
                    el.selectionStart = el.selectionEnd = start + 2;
                    el.dispatchEvent(new Event('input'));
                },

                init() {
                    const now = new Date();
                    const timeStr = now.toTimeString().split(' ')[0];
                    this.logs.push({
                        type: 'info',
                        msg: '⚡ Playground siap. Ketik kodemu pada editor di sebelah kiri lalu klik "Jalankan Kode" (atau Ctrl+Enter).',
                        time: timeStr
                    });

                    // Listen to messages from sandbox iframe
                    window.addEventListener('message', (event) => {
                        if (event.data && event.data.type === 'ls_console') {
                            const now = new Date();
                            const timeStr = now.toTimeString().split(' ')[0];
                            this.logs.push({
                                type: event.data.level || 'log',
                                msg: event.data.message,
                                time: timeStr
                            });
                            if (event.data.level === 'error') {
                                this.execStatus = 'error';
                            }
                        }
                    });

                    // Tampilkan pratinjau kerangka awal saat pertama kali dibuka
                    this.$nextTick(() => {
                        setTimeout(() => this.renderPreview(), 150);
                    });
                },

                resetCode() {
                    this.htmlCode = initialHtml;
                    this.cssCode = initialCss;
                    this.jsCode = initialJs;
                    this.execStatus = 'idle';
                    this.logs = [{
                        type: 'info',
                        msg: '🔄 Kode telah di-reset ke template soal awal. Silakan ketik kodemu kembali.',
                        time: new Date().toTimeString().split(' ')[0]
                    }];
                    this.renderPreview();
                },

                applySolution() {
                    this.htmlCode = solutionHtml;
                    this.cssCode = solutionCss;
                    this.jsCode = solutionJs;
                    this.showSolutionModal = false;
                    this.logs.push({
                        type: 'info',
                        msg: '💡 Kunci solusi diterapkan ke editor. Menjalankan kode solusi...',
                        time: new Date().toTimeString().split(' ')[0]
                    });
                    this.runCode();
                },

                runCode() {
                    this.execStatus = 'running';
                    const now = new Date();
                    const timeStr = now.toTimeString().split(' ')[0];
                    this.logs.push({
                        type: 'info',
                        msg: '▶️ Menjalankan kode baru ke Live Preview...',
                        time: timeStr
                    });

                    this.renderPreview();

                    setTimeout(() => {
                        if (this.execStatus === 'running') {
                            this.execStatus = 'ready';
                        }
                    }, 350);
                },

                renderPreview() {
                    const iframe = document.getElementById('playgroundPreviewFrame');
                    if (!iframe) return;

                    const safeJs = (this.jsCode || '').replace(/<\/script>/gi, '<\\/script>');
                    const safeCss = (this.cssCode || '').replace(/<\/style>/gi, '<\\/style>');

                    const content = `<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>${safeCss}<\/style>
    <script>
        (function() {
            function sendLog(level, args) {
                const msg = Array.from(args).map(arg => {
                    if (typeof arg === 'object') {
                        try { return JSON.stringify(arg); } catch(e) { return String(arg); }
                    }
                    return String(arg);
                }).join(' ');
                window.parent.postMessage({ type: 'ls_console', level: level, message: msg }, '*');
            }
            const origLog = console.log;
            const origWarn = console.warn;
            const origError = console.error;
            const origInfo = console.info;

            console.log = function() { sendLog('log', arguments); origLog.apply(console, arguments); };
            console.warn = function() { sendLog('warn', arguments); origWarn.apply(console, arguments); };
            console.error = function() { sendLog('error', arguments); origError.apply(console, arguments); };
            console.info = function() { sendLog('info', arguments); origInfo.apply(console, arguments); };

            window.onerror = function(msg, url, line) {
                sendLog('error', ['Error di baris ' + line + ': ' + msg]);
            };
        })();
    <\/script>
</head>
<body>
    ${this.htmlCode || ''}
    <script>
        try {
            ${safeJs}
        } catch (err) {
            console.error(err.message);
        }
    <\/script>
</body>
</html>`;

                    if ('srcdoc' in iframe) {
                        iframe.srcdoc = content;
                    } else {
                        try {
                            const iframeDoc = iframe.contentDocument || (iframe.contentWindow && iframe.contentWindow.document);
                            if (iframeDoc) {
                                iframeDoc.open();
                                iframeDoc.write(content);
                                iframeDoc.close();
                            }
                        } catch (e) {
                            console.error('Error rendering preview:', e);
                        }
                    }
                }
            };
        }

        window.learnSpacePlayground = playgroundFactory;

        if (window.Alpine) {
            window.Alpine.data('learnSpacePlayground', playgroundFactory);
        } else {
            document.addEventListener('alpine:init', () => {
                window.Alpine.data('learnSpacePlayground', playgroundFactory);
            });
        }
    })();
</script>
