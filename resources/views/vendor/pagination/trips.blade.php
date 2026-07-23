@if ($paginator->hasPages())
    <div class="flex justify-center items-center gap-2">
        @if ($paginator->onFirstPage())
            <span class="p-2 rounded-lg bg-surface-container-low text-on-surface-variant/40 border border-white/5 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="p-2 rounded-lg bg-surface-container-low text-on-surface-variant hover:text-trips-primary transition-colors border border-white/5 hover:border-trips-primary/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="w-10 h-10 rounded-lg bg-surface-container-low text-on-surface-variant border border-white/5 flex items-center justify-center text-sm font-medium cursor-default">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-10 h-10 rounded-lg flex items-center justify-center text-sm font-bold" style="background-color: #3B82F6; color: #FFFFFF;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="w-10 h-10 rounded-lg bg-surface-container-low text-on-surface-variant hover:text-trips-primary transition-colors border border-white/5 hover:border-trips-primary/30 flex items-center justify-center text-sm font-medium" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="p-2 rounded-lg bg-surface-container-low text-on-surface-variant hover:text-trips-primary transition-colors border border-white/5 hover:border-trips-primary/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @else
            <span class="p-2 rounded-lg bg-surface-container-low text-on-surface-variant/40 border border-white/5 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        @endif
    </div>
@endif
