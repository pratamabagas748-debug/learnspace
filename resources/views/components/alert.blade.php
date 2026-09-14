@if (session('success'))
    <div class="mb-4 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl" role="alert">
        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="mb-4 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl" role="alert">
        <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if (session('info'))
    <div class="mb-4 flex items-center gap-3 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-xl" role="alert">
        <svg class="w-5 h-5 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>{{ session('info') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl">
        <p class="font-medium mb-1">Terdapat beberapa kesalahan:</p>
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif