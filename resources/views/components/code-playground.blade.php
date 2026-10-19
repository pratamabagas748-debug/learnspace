@props(['course' => null, 'lesson' => null])

@php
    $categoryName = strtolower($course->category->name ?? '');
    $courseTitle = strtolower($course->title ?? '');

    $isHtmlCss = str_contains($courseTitle, 'html') || str_contains($courseTitle, 'css') || str_contains($categoryName, 'css');
    $isJs = str_contains($courseTitle, 'javascript') || str_contains($courseTitle, 'js') || str_contains($categoryName, 'javascript');

    if ($isJs) {
        $defaultHtml = '<div class="wrapper">
  <div class="card">
    <div class="badge">ES6+ Sandbox</div>
    <h2>Modern JavaScript Runner</h2>
    <p>Klik tombol untuk menguji logika async & state:</p>
    <div class="stats">
      <span>Klik: <b id="count">0</b></span>
      <span>Status: <b id="status">Idle</b></span>
    </div>
    <button id="actionBtn" class="btn">🚀 Eksekusi Aksi</button>
  </div>
</div>';
        $defaultCss = 'body {
  margin: 0;
  padding: 20px;
  background: #090d16;
  font-family: system-ui, -apple-system, sans-serif;
  color: #f8fafc;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 85vh;
}
.wrapper { width: 100%; max-width: 360px; }
.card {
  background: #111827;
  border: 1px solid #1f2937;
  border-radius: 16px;
  padding: 24px;
  box-shadow: 0 10px 25px -5px rgba(0,0,0,0.5);
}
.badge {
  display: inline-block;
  background: rgba(245, 158, 11, 0.15);
  color: #fbbf24;
  border: 1px solid rgba(245, 158, 11, 0.3);
  font-size: 11px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 999px;
  margin-bottom: 12px;
}
h2 { margin: 0 0 8px; font-size: 18px; font-weight: 700; color: #ffffff; }
p { font-size: 13px; color: #9ca3af; margin: 0 0 16px; line-height: 1.5; }
.stats {
  display: flex;
  justify-content: space-between;
  background: #1f2937;
  padding: 10px 14px;
  border-radius: 10px;
  font-size: 12px;
  margin-bottom: 16px;
}
.stats b { color: #38bdf8; }
.btn {
  width: 100%;
  background: linear-gradient(135deg, #4f46e5, #6366f1);
  color: white;
  border: none;
  padding: 12px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 13px;
  cursor: pointer;
  transition: transform 0.1s, opacity 0.2s;
}
.btn:hover { opacity: 0.95; }
.btn:active { transform: scale(0.98); }';
        $defaultJs = '// Selamat datang di LearnSpace Playground!
console.log("⚡ Sistem JavaScript siap.");

let count = 0;
const btn = document.getElementById("actionBtn");
const countEl = document.getElementById("count");
const statusEl = document.getElementById("status");

btn.addEventListener("click", async () => {
  count++;
  countEl.textContent = count;
  statusEl.textContent = "Memproses...";
  statusEl.style.color = "#f59e0b";
  
  console.log(`[Event] Tombol diklik ke-${count}`);

  // Simulasi async operation
  await new Promise(res => setTimeout(res, 400));
  
  statusEl.textContent = "Sukses ✓";
  statusEl.style.color = "#10b981";
  console.log(`[Async] Operasi ke-${count} selesai dengan sukses!`);
});';
    } elseif ($isHtmlCss) {
        $defaultHtml = '<div class="glass-card">
  <div class="icon-wrap">💎</div>
  <span class="pill">CSS Masterclass</span>
  <h1>Modern Glassmorphism</h1>
  <p>Bereksperimen langsung dengan properti CSS Flexbox, Grid, dan Backdrop-Filter di editor sebelah kiri!</p>
  <button class="cta-btn">Pelajari Lebih Lanjut →</button>
</div>';
        $defaultCss = 'body {
  margin: 0;
  min-height: 85vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: radial-gradient(circle at top right, #312e81, #0f172a 70%);
  font-family: "Plus Jakarta Sans", system-ui, sans-serif;
  color: #fff;
  padding: 20px;
}
.glass-card {
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 24px;
  padding: 32px;
  max-width: 320px;
  text-align: center;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}
.icon-wrap { font-size: 36px; margin-bottom: 12px; }
.pill {
  display: inline-block;
  background: rgba(99, 102, 241, 0.2);
  color: #a5b4fc;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  padding: 4px 12px;
  border-radius: 999px;
  margin-bottom: 12px;
}
h1 { font-size: 20px; font-weight: 800; margin: 0 0 10px; }
p { font-size: 13px; color: #cbd5e1; line-height: 1.6; margin: 0 0 20px; }
.cta-btn {
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  border: none;
  color: white;
  font-weight: 700;
  font-size: 13px;
  padding: 12px 24px;
  border-radius: 12px;
  cursor: pointer;
  box-shadow: 0 8px 16px -4px rgba(99, 102, 241, 0.5);
  transition: all 0.2s ease;
}
.cta-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 20px -4px rgba(99, 102, 241, 0.6);
}';
        $defaultJs = 'console.log("✨ CSS Playground aktif! Ubah warna gradient atau border radius dan lihat perubahannya.");';
    } else {
        $defaultHtml = '<div class="box">
  <h3>⚡ Algorithm & Logic Playground</h3>
  <p>Uji fungsi, algoritma, atau manipulasi data secara langsung:</p>
  <div class="result-box">
    <span>Hasil Kalkulasi:</span>
    <code id="resultArea">Menghitung...</code>
  </div>
</div>';
        $defaultCss = 'body {
  margin: 0;
  padding: 24px;
  background: #0b0f19;
  font-family: system-ui, sans-serif;
  color: #f1f5f9;
}
.box {
  background: #111827;
  border: 1px solid #1f2937;
  border-radius: 14px;
  padding: 20px;
}
h3 { margin: 0 0 6px; font-size: 17px; color: #fff; }
p { margin: 0 0 16px; font-size: 13px; color: #94a3b8; }
.result-box {
  background: #030712;
  border: 1px solid #1f2937;
  border-radius: 10px;
  padding: 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 13px;
}
code {
  color: #34d399;
  font-family: monospace;
  font-size: 14px;
  font-weight: bold;
}';
        $defaultJs = '// Uji coba algoritma Anda di bawah:
const sampleData = [12, 45, 68, 23, 91, 5];

const evens = sampleData.filter(n => n % 2 === 0);
const sum = sampleData.reduce((a, b) => a + b, 0);

console.log("Data awal:", sampleData);
console.log("Bilangan genap:", evens);
console.log("Total jumlah data:", sum);

document.getElementById("resultArea").textContent = `Genap: [${evens.join(", ")}] | Total: ${sum}`;';
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
                    <span class="text-[10px] bg-indigo-500/20 text-indigo-300 font-bold px-2 py-0.5 rounded-full border border-indigo-500/30">Sandbox Interaktif</span>
                </div>
                <p class="text-[11px] text-slate-400">Eksperimen langsung dengan kode di browser tanpa perlu install tool apapun</p>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center gap-2">
            <button @click="resetCode()" type="button" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-400 hover:text-white bg-slate-800 hover:bg-slate-700/80 transition-all border border-slate-700/60 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Reset
            </button>
            <button @click="runCode()" type="button" class="px-4 py-1.5 rounded-lg text-xs font-bold text-white bg-gradient-to-r from-indigo-500 via-indigo-600 to-violet-600 hover:from-indigo-600 hover:to-violet-700 transition-all shadow-md shadow-indigo-600/30 flex items-center gap-1.5 hover:scale-[1.02]">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
                Jalankan Kode
            </button>
        </div>
    </div>

    {{-- Main Workspace Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 lg:divide-x divide-slate-800">
        
        {{-- Left: Code Editors with Tabs --}}
        <div class="flex flex-col bg-[#0b0e14]">
            
            {{-- Tabs --}}
            <div class="flex items-center border-b border-slate-800 px-3 bg-slate-950/60">
                <button type="button" @click="activeTab = 'html'" :class="activeTab === 'html' ? 'text-indigo-400 border-indigo-500 bg-slate-900/80' : 'text-slate-400 border-transparent hover:text-slate-200'" class="px-3.5 py-2 text-xs font-bold border-b-2 flex items-center gap-1.5 transition-all">
                    <span class="text-orange-400">HTML</span>
                </button>
                <button type="button" @click="activeTab = 'css'" :class="activeTab === 'css' ? 'text-indigo-400 border-indigo-500 bg-slate-900/80' : 'text-slate-400 border-transparent hover:text-slate-200'" class="px-3.5 py-2 text-xs font-bold border-b-2 flex items-center gap-1.5 transition-all">
                    <span class="text-sky-400">CSS</span>
                </button>
                <button type="button" @click="activeTab = 'js'" :class="activeTab === 'js' ? 'text-indigo-400 border-indigo-500 bg-slate-900/80' : 'text-slate-400 border-transparent hover:text-slate-200'" class="px-3.5 py-2 text-xs font-bold border-b-2 flex items-center gap-1.5 transition-all">
                    <span class="text-amber-300">JavaScript</span>
                </button>
                <div class="ml-auto text-[10px] text-slate-500 hidden sm:block">Tekan Ctrl+Enter untuk Run</div>
            </div>

            {{-- Textarea Editors --}}
            <div class="relative flex-1 min-h-[300px]">
                <textarea x-show="activeTab === 'html'" x-model="htmlCode" @keydown.ctrl.enter.prevent="runCode()" spellcheck="false"
                          class="w-full h-full min-h-[300px] p-4 bg-transparent text-slate-200 font-mono text-xs leading-relaxed focus:outline-none resize-none selection:bg-indigo-600/40"></textarea>

                <textarea x-show="activeTab === 'css'" x-model="cssCode" @keydown.ctrl.enter.prevent="runCode()" spellcheck="false"
                          class="w-full h-full min-h-[300px] p-4 bg-transparent text-slate-200 font-mono text-xs leading-relaxed focus:outline-none resize-none selection:bg-indigo-600/40"></textarea>

                <textarea x-show="activeTab === 'js'" x-model="jsCode" @keydown.ctrl.enter.prevent="runCode()" spellcheck="false"
                          class="w-full h-full min-h-[300px] p-4 bg-transparent text-slate-200 font-mono text-xs leading-relaxed focus:outline-none resize-none selection:bg-indigo-600/40"></textarea>
            </div>

        </div>

        {{-- Right: Live Preview & Virtual Console Output --}}
        <div class="flex flex-col bg-[#0b0e14]">
            
            {{-- Preview Window Header --}}
            <div class="px-4 py-2 bg-slate-950/80 border-b border-slate-800 flex items-center justify-between text-xs font-bold text-slate-300">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Live Preview (Pratinjau)
                </span>
                <span class="text-[10px] text-slate-500 font-mono">Sandbox Sandbox</span>
            </div>

            {{-- Live Iframe Preview --}}
            <div class="bg-white min-h-[220px] flex-1">
                <iframe id="playgroundPreviewFrame" class="w-full h-full min-h-[220px] border-0" sandbox="allow-scripts allow-modals"></iframe>
            </div>

            {{-- Virtual Terminal Console --}}
            <div class="border-t border-slate-800 bg-[#07090e]">
                <div class="px-4 py-1.5 bg-slate-950 border-b border-slate-800/80 flex items-center justify-between">
                    <span class="text-[11px] font-bold text-slate-400 flex items-center gap-1.5 font-mono">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3"/></svg>
                        Konsol Virtual (Console Output)
                    </span>
                    <button type="button" @click="logs = []" class="text-[10px] text-slate-500 hover:text-slate-300 transition-colors">
                        Bersihkan
                    </button>
                </div>
                <div class="p-3 font-mono text-xs max-h-36 overflow-y-auto space-y-1">
                    <template x-if="logs.length === 0">
                        <p class="text-slate-600 text-[11px] italic">Belum ada output konsol. Klik "Jalankan Kode" di atas.</p>
                    </template>
                    <template x-for="(log, idx) in logs" :key="idx">
                        <div class="flex items-start gap-2 leading-relaxed text-[11px]">
                            <span class="text-slate-600 select-none text-[10px]" x-text="log.time"></span>
                            <span :class="{
                                'text-slate-300': log.type === 'log',
                                'text-emerald-400': log.type === 'info',
                                'text-amber-400': log.type === 'warn',
                                'text-rose-400': log.type === 'error'
                            }" x-text="log.msg"></span>
                        </div>
                    </template>
                </div>
            </div>

        </div>

    </div>

</div>

<script>
    function learnSpacePlayground() {
        const initialHtml = @json($defaultHtml);
        const initialCss = @json($defaultCss);
        const initialJs = @json($defaultJs);

        return {
            activeTab: 'js',
            htmlCode: initialHtml,
            cssCode: initialCss,
            jsCode: initialJs,
            logs: [],

            init() {
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
                    }
                });

                // Auto run initial code once DOM is ready
                this.$nextTick(() => {
                    this.runCode();
                });
            },

            resetCode() {
                this.htmlCode = initialHtml;
                this.cssCode = initialCss;
                this.jsCode = initialJs;
                this.logs = [];
                this.runCode();
            },

            runCode() {
                const iframe = document.getElementById('playgroundPreviewFrame');
                if (!iframe) return;

                const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

                // Build HTML payload with injected console interceptor
                const content = `
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>${this.cssCode}</style>
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
    ${this.htmlCode}
    <script>
        try {
            ${this.jsCode}
        } catch (err) {
            console.error(err.message);
        }
    <\/script>
</body>
</html>
                `;

                iframeDoc.open();
                iframeDoc.write(content);
                iframeDoc.close();
            }
        };
    }
</script>
