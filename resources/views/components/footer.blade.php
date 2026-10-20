<footer class="bg-slate-900 text-slate-400 mt-20 relative overflow-hidden">
    {{-- Background decoration --}}
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-40"></div>

    <div class="max-w-7xl mx-auto px-4 py-14 relative">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
            {{-- Brand --}}
            <div class="md:col-span-2">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-xl flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="text-white font-extrabold text-lg">Learn<span class="text-indigo-400">Space</span></span>
                </div>
                <p class="text-sm leading-relaxed max-w-md">Platform Learning Management System (LMS) untuk membantu Anda mengembangkan keterampilan profesional dengan kurikulum terstruktur.</p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Navigasi</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('courses.index') }}" class="hover:text-white transition-colors">Semua Kursus</a></li>
                    @guest
                    <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Masuk</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Daftar</a></li>
                    @else
                    <li><a href="{{ route(auth()->user()->role . '.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="hover:text-white transition-colors">Profil Saya</a></li>
                    @endguest
                </ul>
            </div>

            {{-- Kategori Dinamis --}}
            <div>
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4">Kategori</h4>
                <ul class="space-y-2.5 text-sm">
                    @foreach(\App\Models\Category::take(5)->get() as $cat)
                    <li><a href="{{ route('courses.index', ['category' => $cat->slug]) }}" class="hover:text-white transition-colors">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs">
            <p>&copy; {{ date('Y') }} LearnSpace. Dibuat untuk keperluan Tugas Akhir.</p>
            <p class="text-slate-600">Laravel {{ app()->version() }} · PHP {{ phpversion() }}</p>
        </div>
    </div>
</footer>