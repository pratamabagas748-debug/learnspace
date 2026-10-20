@props(['href', 'icon', 'active' => false, 'badge' => null])

@php
$isActive = $active || request()->fullUrlIs($href) || (isset($activePattern) && request()->routeIs($activePattern));
@endphp

<a href="{{ $href }}"
   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
          {{ $isActive
    ? 'bg-[#153EBD] text-white shadow-sm shadow-blue-200'
    : 'text-slate-600 hover:bg-[#F4F7FF] hover:text-[#153EBD]' }}">
    <span class="{{ $isActive ? 'text-white' : 'text-slate-400' }} shrink-0">
        {!! $icon !!}
    </span>
    <span class="flex-1 min-w-0 truncate">{{ $slot }}</span>
    @if($badge !== null)
    <span class="shrink-0 text-xs font-bold px-1.5 py-0.5 rounded-full {{ $isActive ? 'bg-white/20 text-white' : 'bg-[#E8EEFF] text-[#153EBD]' }}">
        {{ $badge }}
    </span>
    @endif
</a>
