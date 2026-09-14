@props(['progress' => 0, 'label' => true, 'size' => 'md'])

@php
$heights = ['sm' => 'h-1.5', 'md' => 'h-2.5', 'lg' => 'h-3'];
$height = $heights[$size] ?? $heights['md'];
$color = $progress >= 100 ? 'bg-emerald-500' : 'bg-indigo-500';
@endphp

<div>
    @if ($label)
        <div class="flex justify-between items-center mb-1.5 text-xs text-slate-500">
            <span>Progress</span>
            <span class="font-semibold {{ $progress >= 100 ? 'text-emerald-600' : 'text-indigo-600' }}">{{ $progress }}%</span>
        </div>
    @endif
    <div class="w-full bg-slate-200 rounded-full {{ $height }} overflow-hidden">
        <div class="{{ $color }} {{ $height }} rounded-full transition-all duration-500"
             style="width: {{ $progress }}%"></div>
    </div>
</div>