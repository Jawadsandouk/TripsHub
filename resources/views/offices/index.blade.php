<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Travel Offices') }}</h2>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto">
            <form method="GET" class="card p-6 mb-8 entrance">
                <div class="flex gap-4 flex-wrap max-sm:flex-nowrap max-sm:gap-2">
                    <div class="flex-1 min-w-[200px] max-sm:min-w-0 max-sm:flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search offices...') }}" class="input">
                    </div>
                    <select name="sort" class="input w-auto max-sm:w-auto max-sm:shrink-0 max-sm:text-xs max-sm:px-2">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('Sort by Name') }}</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>{{ __('Sort by Rating') }}</option>
                    </select>
                    <button type="submit" class="btn-primary-sm max-sm:shrink-0 max-sm:text-xs max-sm:px-3 max-sm:py-2">{{ __('Filter') }}</button>
                </div>
            </form>

            @if($offices->isEmpty())
                <div class="card p-16 max-sm:p-8 text-center entrance">
                    <div class="w-16 h-16 rounded-full bg-primary/40 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3"/>
                        </svg>
                    </div>
                    <p class="text-text-secondary text-lg">{{ __('No offices found.') }}</p>
                </div>
            @else
                <div class="grid w-full sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 max-sm:gap-4">
                    @foreach($offices as $office)
                        <a href="{{ route('offices.show', $office->id) }}" class="card-hover p-6 group block entrance max-sm:mx-4" style="animation-delay: {{ $loop->index * 0.05 }}s">
                            <div class="flex items-center gap-4 mb-4 max-sm:gap-3 max-sm:mb-3">
                                <div class="w-14 h-14 max-sm:w-10 max-sm:h-10 rounded-full bg-gradient-to-br from-accent-purple/20 to-primary/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-7 h-7 max-sm:w-5 max-sm:h-5 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-text-primary truncate max-sm:text-[15px]">{{ $office->name }}</h3>
                                    @php $avg = $office->averageRating(); $count = $office->ratingCount(); @endphp
                                    @if($avg)
                                        <div class="flex items-center gap-1.5 mt-1 max-sm:gap-1">
                                            <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3 text-gold" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            <span class="text-sm max-sm:text-xs font-medium text-text-primary">{{ number_format($avg, 1) }}</span>
                                            <span class="text-xs max-sm:text-[10px] text-text-muted">({{ $count }})</span>
                                        </div>
                                    @endif
                                </div>
                                <svg class="w-5 h-5 text-primary opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all duration-500 shrink-0 max-sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                            <div class="flex items-center gap-2 text-sm max-sm:text-xs text-text-muted">
                                <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $office->trips_count }} {{ __('trips') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $offices->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>