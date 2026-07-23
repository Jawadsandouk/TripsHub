@props([
    'href' => '#',
    'icon' => 'flight_takeoff',
    'title' => '',
    'description' => '',
    'color' => 'secondary',
])

@php
    $iconBg = $color === 'secondary' ? 'bg-welcome-secondary/30 border-welcome-secondary/20' : 'bg-welcome-tertiary/20 border-welcome-tertiary/20';
@endphp

<a href="{{ $href }}" class="group block glass-card p-3 rounded-xl flex items-center justify-between">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg {{ $iconBg }} flex items-center justify-center border text-welcome-tertiary transition-transform duration-500 group-hover:scale-110">
            <span class="material-symbols-outlined text-xl">{{ $icon }}</span>
        </div>
        <div>
            <h3 class="text-sm font-headline font-bold text-white mb-0.5">{{ $title }}</h3>
            <p class="text-[10px] text-white/70 font-body">{{ $description }}</p>
        </div>
    </div>
    <span class="material-symbols-outlined text-white/40 group-hover:text-welcome-tertiary transition-all group-hover:translate-x-2 duration-300">{{ app()->getLocale() === 'ar' ? 'chevron_left' : 'chevron_right' }}</span>
</a>
