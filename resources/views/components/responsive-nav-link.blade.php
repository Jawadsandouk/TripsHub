@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 w-full px-4 py-2.5 rounded-[10px] text-sm font-medium text-text-primary bg-primary/10'
            : 'flex items-center gap-3 w-full px-4 py-2.5 rounded-[10px] text-sm font-medium text-text-muted hover:text-text-primary hover:bg-primary/30';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
