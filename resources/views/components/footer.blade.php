<footer class="site-footer mt-20 relative overflow-hidden">
    <div class="footer-ambient footer-ambient-one" aria-hidden="true"></div>
    <div class="footer-ambient footer-ambient-two" aria-hidden="true"></div>
    <div class="footer-top-line" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-14 relative z-10">
        {{-- Closing CTA --}}
        <div class="footer-cta-panel mb-12 sm:mb-14">
            <div class="footer-cta-copy">
                <span class="footer-eyebrow"><span></span> WAKTUNYA BERTUMBUH</span>
                <h2>Skill hebat dimulai dari <span>satu langkah kecil.</span></h2>
                <p>Pilih materi yang sesuai dengan tujuanmu dan mulai bangun masa depanmu bersama LearnSpace.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="footer-cta-button">
                Jelajahi Kursus
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
            </a>
            <div class="footer-cta-decoration" aria-hidden="true"><span></span><span></span><span></span></div>
        </div>

        <div class="footer-main-grid">
            {{-- Brand --}}
            <div class="footer-brand-block">
                <a href="{{ route('home') }}" class="footer-brand" aria-label="LearnSpace — Home">
                    <span class="footer-brand-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z"/><path d="M4 6v15M8 7h8M8 11h7"/></svg>
                    </span>
                    <span>Learn<span>Space</span></span>
                </a>
                <p class="footer-brand-description">Platform pembelajaran online untuk membangun keterampilan digital lewat materi terstruktur, latihan, dan progres yang terasa.</p>
                <div class="footer-brand-tag"><span>✦</span> Belajar hari ini, tumbuh setiap hari</div>
            </div>

            {{-- Navigation --}}
            <div class="footer-column">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home <span>↗</span></a></li>
                    <li><a href="{{ route('courses.index') }}">Semua Kursus <span>↗</span></a></li>
                </ul>
            </div>

            {{-- Dynamic categories --}}
            <div class="footer-column">
                <h4>Jelajahi Kategori</h4>
                <ul>
                    @foreach(\App\Models\Category::take(5)->get() as $cat)
                    <li><a href="{{ route('courses.index', ['category' => $cat->slug]) }}">{{ $cat->name }} <span>↗</span></a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Account links --}}
            <div class="footer-column">
                <h4>Akun Saya</h4>
                <ul>
                    @guest
                    <li><a href="{{ route('login') }}">Masuk <span>↗</span></a></li>
                    <li><a href="{{ route('register') }}">Daftar Akun <span>↗</span></a></li>
                    @else
                    <li><a href="{{ route(auth()->user()->role . '.dashboard') }}">Dashboard <span>↗</span></a></li>
                    <li><a href="{{ route('profile.edit') }}">Profil Saya <span>↗</span></a></li>
                    @endguest
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} LearnSpace. Dibuat untuk keperluan Tugas Akhir.</p>
            <div class="footer-bottom-meta"><span>Dirancang untuk terus bertumbuh</span><span class="footer-meta-separator">·</span><span>Laravel {{ app()->version() }} · PHP {{ phpversion() }}</span></div>
        </div>
    </div>
</footer>
