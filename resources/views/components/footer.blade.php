<footer class="bg-slate-900 text-slate-400 mt-20">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-7 h-7 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="text-white font-bold">LearnSpace</span>
                </div>
                <p class="text-sm leading-relaxed">Platform pembelajaran online yang membantu Anda mengembangkan keterampilan profesional.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Tautan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('courses.index') }}" class="hover:text-white transition-colors">Semua Kursus</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Masuk</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Daftar</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Kategori</h4>
                <ul class="space-y-2 text-sm">
                    <li><span class="hover:text-white transition-colors cursor-pointer">Web Development</span></li>
                    <li><span class="hover:text-white transition-colors cursor-pointer">UI/UX Design</span></li>
                    <li><span class="hover:text-white transition-colors cursor-pointer">Data Science</span></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-800 pt-6 text-center text-sm">
            <p>&copy; {{ date('Y') }} LearnSpace. Dibuat untuk keperluan Tugas Akhir.</p>
        </div>
    </div>
</footer>