@props(['course' => null, 'lesson' => null])

<div id="focus-room-container" class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 border border-slate-800 text-white rounded-2xl p-5 mb-6 shadow-xl relative overflow-hidden transition-all duration-300">

    {{-- Subtle decorative glow background --}}
    <div class="absolute -top-12 -right-12 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-5">

        {{-- Left: Status & Mode Info --}}
        <div class="space-y-1.5">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 -ml-2.5"></span>
                    Live Study Room
                </span>
                <span id="live-peers-count" class="text-xs text-slate-300 font-medium">
                    14 siswa sedang fokus belajar sekarang
                </span>
            </div>
            <h3 class="text-base font-extrabold text-white flex items-center gap-2">
                <span>🧠</span> Focus Mode & Pomodoro
            </h3>
            <p class="text-xs text-slate-400">Tingkatkan retensi belajar dengan timer 25 menit dan ambient audio penenang.</p>
        </div>

        {{-- Center: Pomodoro Display & Controls --}}
        <div class="bg-black/30 backdrop-blur-md border border-white/10 rounded-2xl p-3.5 flex flex-col items-center gap-3 shrink-0">
            {{-- Mode Switcher Tabs --}}
            <div class="flex items-center bg-white/10 p-1 rounded-xl text-xs font-semibold gap-1">
                <button type="button" onclick="setPomodoroMode('focus', 25)" id="pomo-mode-focus" class="px-3 py-1 rounded-lg bg-indigo-600 text-white transition-all">
                    🧠 Fokus (25m)
                </button>
                <button type="button" onclick="setPomodoroMode('shortBreak', 5)" id="pomo-mode-short" class="px-3 py-1 rounded-lg text-slate-300 hover:text-white transition-all">
                    ☕ Rehat (5m)
                </button>
                <button type="button" onclick="setPomodoroMode('longBreak', 15)" id="pomo-mode-long" class="px-3 py-1 rounded-lg text-slate-300 hover:text-white transition-all">
                    🌴 Istirahat (15m)
                </button>
            </div>

            {{-- Digital Countdown & Buttons --}}
            <div class="flex items-center gap-4">
                <span id="pomodoro-timer-display" class="font-mono text-3xl font-black tracking-wider text-white">
                    25:00
                </span>

                <div class="flex items-center gap-2">
                    <button type="button" id="pomo-toggle-btn" onclick="togglePomodoroTimer()"
                            class="px-4 py-1.5 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-xs font-bold transition-all shadow-md shadow-emerald-500/20 flex items-center gap-1.5">
                        <svg id="pomo-play-icon" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
                        <span id="pomo-btn-text">Mulai</span>
                    </button>
                    <button type="button" onclick="resetPomodoroTimer()" title="Reset Timer"
                            class="p-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white text-xs transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </button>
                </div>
            </div>

            {{-- Progress bar --}}
            <div class="w-full bg-white/10 rounded-full h-1.5 overflow-hidden">
                <div id="pomodoro-progress" class="bg-gradient-to-r from-indigo-400 to-emerald-400 h-full rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
        </div>

        {{-- Right: Ambient Audio & Zen Mode --}}
        <div class="flex flex-col gap-3 min-w-[220px]">
            {{-- Ambient Selector --}}
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">
                    🎵 Ambient Soundscape
                </label>
                <div class="grid grid-cols-2 gap-1.5 text-xs font-semibold">
                    <button type="button" onclick="switchAmbientSound('none')" id="ambient-btn-none" class="px-2.5 py-1.5 rounded-xl bg-white/10 text-slate-200 hover:bg-white/15 transition-all text-left">
                        🔇 Off
                    </button>
                    <button type="button" onclick="switchAmbientSound('rain')" id="ambient-btn-rain" class="px-2.5 py-1.5 rounded-xl bg-white/5 text-slate-400 hover:bg-white/10 transition-all text-left">
                        🌧️ Hujan
                    </button>
                    <button type="button" onclick="switchAmbientSound('cafe')" id="ambient-btn-cafe" class="px-2.5 py-1.5 rounded-xl bg-white/5 text-slate-400 hover:bg-white/10 transition-all text-left">
                        ☕ Kafe
                    </button>
                    <button type="button" onclick="switchAmbientSound('waves')" id="ambient-btn-waves" class="px-2.5 py-1.5 rounded-xl bg-white/5 text-slate-400 hover:bg-white/10 transition-all text-left">
                        🌊 Ombak
                    </button>
                </div>
            </div>

            {{-- Volume & Zen Button --}}
            <div class="flex items-center gap-3 pt-1">
                <div class="flex items-center gap-1.5 flex-1">
                    <span class="text-xs text-slate-400">🔊</span>
                    <input type="range" id="ambient-volume" min="0" max="1" step="0.05" value="0.5" oninput="changeAmbientVolume(this.value)"
                           class="w-full h-1.5 bg-white/20 rounded-lg appearance-none cursor-pointer accent-indigo-500">
                </div>

                <button type="button" onclick="toggleZenFocusMode()" title="Masuk Mode Zen Tanpa Gangguan"
                        class="px-2.5 py-1 rounded-xl bg-indigo-500/20 hover:bg-indigo-500/30 text-indigo-300 text-xs font-bold border border-indigo-500/30 transition-all flex items-center gap-1 shrink-0">
                    <span>🧘</span> Zen Mode
                </button>
            </div>
        </div>

    </div>

    {{-- Notification Toast for Finished Pomodoro --}}
    <div id="pomo-finish-toast" class="hidden mt-4 bg-emerald-500/20 border border-emerald-500/40 rounded-xl p-3 text-emerald-200 text-xs flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-lg">🎉</span>
            <span id="pomo-finish-message">Hebat! Kamu menyelesaikan 25 menit sesi fokus belajar dan mendapatkan +5 XP!</span>
        </div>
        <button type="button" onclick="this.parentElement.classList.add('hidden')" class="text-emerald-400 hover:text-white">✕</button>
    </div>

</div>

{{-- Zen Mode Floating Exit Button --}}
<div id="zen-exit-button-wrapper" class="fixed top-4 right-4 z-50 hidden">
    <button type="button" onclick="toggleZenFocusMode()"
            class="px-4 py-2 rounded-xl bg-slate-900/90 text-white hover:bg-slate-900 border border-slate-700 shadow-2xl text-xs font-bold backdrop-blur-md transition-all flex items-center gap-2 hover:scale-105">
        <span>✕</span> Keluar Mode Zen (ESC)
    </button>
</div>

<script>
    // ==========================================
    // 1. POMODORO TIMER ENGINE
    // ==========================================
    let pomoInterval = null;
    let pomoTimeLeft = 25 * 60;
    let pomoTotalDuration = 25 * 60;
    let pomoIsRunning = false;
    let pomoCurrentMode = 'focus'; // 'focus', 'shortBreak', 'longBreak'

    function setPomodoroMode(mode, minutes) {
        if (pomoIsRunning) {
            clearInterval(pomoInterval);
            pomoIsRunning = false;
            updatePlayBtnUi(false);
        }

        pomoCurrentMode = mode;
        pomoTimeLeft = minutes * 60;
        pomoTotalDuration = minutes * 60;

        // Update button states
        ['focus', 'short', 'long'].forEach(m => {
            const btn = document.getElementById('pomo-mode-' + m);
            if (btn) {
                btn.className = 'px-3 py-1 rounded-lg text-slate-300 hover:text-white transition-all';
            }
        });

        const activeKey = mode === 'focus' ? 'focus' : (mode === 'shortBreak' ? 'short' : 'long');
        const activeBtn = document.getElementById('pomo-mode-' + activeKey);
        if (activeBtn) {
            activeBtn.className = 'px-3 py-1 rounded-lg bg-indigo-600 text-white font-bold transition-all';
        }

        updatePomodoroDisplay();
    }

    function togglePomodoroTimer() {
        if (pomoIsRunning) {
            clearInterval(pomoInterval);
            pomoIsRunning = false;
            updatePlayBtnUi(false);
        } else {
            pomoIsRunning = true;
            updatePlayBtnUi(true);

            pomoInterval = setInterval(() => {
                pomoTimeLeft--;
                updatePomodoroDisplay();

                if (pomoTimeLeft <= 0) {
                    clearInterval(pomoInterval);
                    pomoIsRunning = false;
                    updatePlayBtnUi(false);
                    onPomodoroCompleted();
                }
            }, 1000);
        }
    }

    function resetPomodoroTimer() {
        clearInterval(pomoInterval);
        pomoIsRunning = false;
        updatePlayBtnUi(false);
        pomoTimeLeft = pomoTotalDuration;
        updatePomodoroDisplay();
    }

    function updatePomodoroDisplay() {
        const mins = Math.floor(pomoTimeLeft / 60);
        const secs = pomoTimeLeft % 60;
        const formatted = String(mins).padStart(2, '0') + ':' + String(secs).padStart(2, '0');

        const displayEl = document.getElementById('pomodoro-timer-display');
        if (displayEl) displayEl.innerText = formatted;

        // Progress bar
        const progressEl = document.getElementById('pomodoro-progress');
        if (progressEl) {
            const pct = ((pomoTotalDuration - pomoTimeLeft) / pomoTotalDuration) * 100;
            progressEl.style.width = pct + '%';
        }
    }

    function updatePlayBtnUi(running) {
        const btnText = document.getElementById('pomo-btn-text');
        const playBtn = document.getElementById('pomo-toggle-btn');
        if (running) {
            if (btnText) btnText.innerText = 'Jeda';
            if (playBtn) playBtn.className = 'px-4 py-1.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold transition-all shadow-md shadow-amber-500/20 flex items-center gap-1.5';
        } else {
            if (btnText) btnText.innerText = 'Mulai';
            if (playBtn) playBtn.className = 'px-4 py-1.5 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-xs font-bold transition-all shadow-md shadow-emerald-500/20 flex items-center gap-1.5';
        }
    }

    function onPomodoroCompleted() {
        playSynthBellChime();

        if (pomoCurrentMode === 'focus') {
            // Catat sesi fokus selesai ke server untuk tambah +5 XP
            const lessonId = "{{ $lesson->id ?? '' }}";
            const targetUrl = "{{ route('student.lessons.focus-complete', $lesson->id ?? 0) }}";

            if (lessonId) {
                fetch(targetUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    const toast = document.getElementById('pomo-finish-toast');
                    const msg = document.getElementById('pomo-finish-message');
                    if (toast && msg) {
                        msg.innerText = data.message || '🎉 Sesi Fokus 25 menit selesai! Kamu mendapatkan +5 XP!';
                        toast.classList.remove('hidden');
                    }
                })
                .catch(err => {
                    console.log('Focus completed offline/local:', err);
                });
            }
        } else {
            alert('Waktu istirahat selesai! Siap untuk kembali fokus belajar?');
        }
    }

    // ==========================================
    // 2. SYNTHESIZED WEB AUDIO BELL CHIME
    // ==========================================
    let audioCtx = null;
    function getAudioContext() {
        if (!audioCtx) {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            audioCtx = new AudioContext();
        }
        if (audioCtx.state === 'suspended') {
            audioCtx.resume();
        }
        return audioCtx;
    }

    function playSynthBellChime() {
        try {
            const ctx = getAudioContext();
            const now = ctx.currentTime;
            // 4-chord soft bell: C5 (523Hz), E5 (659Hz), G5 (784Hz), C6 (1046Hz)
            const notes = [523.25, 659.25, 783.99, 1046.50];

            notes.forEach((freq, idx) => {
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();

                osc.type = 'sine';
                osc.frequency.setValueAtTime(freq, now + (idx * 0.12));

                gain.gain.setValueAtTime(0, now + (idx * 0.12));
                gain.gain.linearRampToValueAtTime(0.2, now + (idx * 0.12) + 0.04);
                gain.gain.exponentialRampToValueAtTime(0.001, now + (idx * 0.12) + 1.6);

                osc.connect(gain);
                gain.connect(ctx.destination);

                osc.start(now + (idx * 0.12));
                osc.stop(now + (idx * 0.12) + 1.8);
            });
        } catch (e) {
            console.error('Audio chime error:', e);
        }
    }

    // ==========================================
    // 3. PROCEDURAL AMBIENT SOUND GENERATOR
    // ==========================================
    let activeAmbientType = 'none';
    let ambientNodes = [];
    let ambientGainNode = null;
    let currentVolume = 0.5;

    function switchAmbientSound(type) {
        stopCurrentAmbientSound();
        activeAmbientType = type;

        // Update Button UI
        ['none', 'rain', 'cafe', 'waves'].forEach(t => {
            const btn = document.getElementById('ambient-btn-' + t);
            if (btn) {
                if (t === type) {
                    btn.className = 'px-2.5 py-1.5 rounded-xl bg-indigo-600 text-white font-bold transition-all text-left';
                } else {
                    btn.className = 'px-2.5 py-1.5 rounded-xl bg-white/5 text-slate-400 hover:bg-white/10 transition-all text-left';
                }
            }
        });

        if (type === 'none') return;

        const ctx = getAudioContext();
        ambientGainNode = ctx.createGain();
        ambientGainNode.gain.setValueAtTime(currentVolume, ctx.currentTime);
        ambientGainNode.connect(ctx.destination);

        // Procedural generator
        if (type === 'rain') {
            startRainSound(ctx, ambientGainNode);
        } else if (type === 'cafe') {
            startCafeSound(ctx, ambientGainNode);
        } else if (type === 'waves') {
            startWavesSound(ctx, ambientGainNode);
        }
    }

    function stopCurrentAmbientSound() {
        ambientNodes.forEach(node => {
            try {
                if (node.stop) node.stop();
                if (node.disconnect) node.disconnect();
            } catch (e) {}
        });
        ambientNodes = [];
        if (ambientGainNode) {
            try { ambientGainNode.disconnect(); } catch (e) {}
            ambientGainNode = null;
        }
    }

    function changeAmbientVolume(val) {
        currentVolume = parseFloat(val);
        if (ambientGainNode && audioCtx) {
            ambientGainNode.gain.setValueAtTime(currentVolume, audioCtx.currentTime);
        }
    }

    // Pink/Filtered noise generator helper
    function createNoiseBuffer(ctx, seconds = 4) {
        const bufferSize = ctx.sampleRate * seconds;
        const buffer = ctx.createBuffer(1, bufferSize, ctx.sampleRate);
        const data = buffer.getChannelData(0);
        let b0 = 0, b1 = 0, b2 = 0, b3 = 0, b4 = 0, b5 = 0, b6 = 0;
        for (let i = 0; i < bufferSize; i++) {
            const white = Math.random() * 2 - 1;
            b0 = 0.99886 * b0 + white * 0.0555179;
            b1 = 0.99332 * b1 + white * 0.0750759;
            b2 = 0.96900 * b2 + white * 0.1538520;
            b3 = 0.86650 * b3 + white * 0.3104856;
            b4 = 0.55000 * b4 + white * 0.5329522;
            b5 = -0.7616 * b5 - white * 0.0168980;
            data[i] = (b0 + b1 + b2 + b3 + b4 + b5 + b6 + white * 0.5362) * 0.11;
            b6 = white * 0.115926;
        }
        return buffer;
    }

    function startRainSound(ctx, targetNode) {
        const noise = ctx.createBufferSource();
        noise.buffer = createNoiseBuffer(ctx, 5);
        noise.loop = true;

        const filter = ctx.createBiquadFilter();
        filter.type = 'lowpass';
        filter.frequency.setValueAtTime(900, ctx.currentTime);

        noise.connect(filter);
        filter.connect(targetNode);
        noise.start();

        ambientNodes.push(noise, filter);
    }

    function startCafeSound(ctx, targetNode) {
        const noise = ctx.createBufferSource();
        noise.buffer = createNoiseBuffer(ctx, 5);
        noise.loop = true;

        const filter = ctx.createBiquadFilter();
        filter.type = 'bandpass';
        filter.frequency.setValueAtTime(450, ctx.currentTime);
        filter.Q.setValueAtTime(1.2, ctx.currentTime);

        noise.connect(filter);
        filter.connect(targetNode);
        noise.start();

        ambientNodes.push(noise, filter);
    }

    function startWavesSound(ctx, targetNode) {
        const noise = ctx.createBufferSource();
        noise.buffer = createNoiseBuffer(ctx, 6);
        noise.loop = true;

        const filter = ctx.createBiquadFilter();
        filter.type = 'lowpass';

        // LFO oscillator to modulate filter for ocean wave sound
        const lfo = ctx.createOscillator();
        lfo.type = 'sine';
        lfo.frequency.setValueAtTime(0.12, ctx.currentTime); // 1 wave cycle every 8 seconds

        const lfoGain = ctx.createGain();
        lfoGain.gain.setValueAtTime(450, ctx.currentTime);

        filter.frequency.setValueAtTime(500, ctx.currentTime);
        lfo.connect(lfoGain);
        lfoGain.connect(filter.frequency);

        noise.connect(filter);
        filter.connect(targetNode);

        lfo.start();
        noise.start();

        ambientNodes.push(noise, filter, lfo, lfoGain);
    }

    // ==========================================
    // 4. ZEN / DISTRACTION-FREE MODE
    // ==========================================
    let isZenMode = false;
    function toggleZenFocusMode() {
        isZenMode = !isZenMode;
        const sidebar = document.getElementById('sidebar');
        const exitBtn = document.getElementById('zen-exit-button-wrapper');

        if (isZenMode) {
            document.body.classList.add('bg-slate-950', 'text-slate-100');
            if (sidebar) sidebar.classList.add('hidden');
            if (exitBtn) exitBtn.classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            document.body.classList.remove('bg-slate-950', 'text-slate-100');
            if (sidebar) sidebar.classList.remove('hidden');
            if (exitBtn) exitBtn.classList.add('hidden');
        }
    }

    // Press Escape to exit Zen mode
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isZenMode) {
            toggleZenFocusMode();
        }
    });

    // Randomize active peers realistically between 11 and 24
    document.addEventListener('DOMContentLoaded', () => {
        const peersEl = document.getElementById('live-peers-count');
        if (peersEl) {
            const count = Math.floor(Math.random() * 12) + 11;
            peersEl.innerText = count + ' siswa sedang fokus belajar materi ini';
        }
    });
</script>
