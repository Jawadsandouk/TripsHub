@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-4 bg-teal/10 border border-teal/15 rounded-[12px] text-teal-light text-sm flex items-center gap-3']) }}>
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ $status }}
    </div>
@endif
