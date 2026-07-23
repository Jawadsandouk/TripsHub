<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('offices.index') }}" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ $office->name }}</h2>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto">
            <div class="card p-8 max-sm:p-4 mb-8 animate-slide-up">
                <div class="flex items-center gap-5">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-accent-purple/20 to-primary/10 flex items-center justify-center">
                        <svg class="w-10 h-10 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3"/>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <h1 class="text-3xl max-sm:text-xl font-bold text-text-primary">{{ $office->name }}</h1>
                            @if($avgRating)
                                <div class="flex items-center gap-2">
                                    <div class="flex gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= round($avgRating) ? 'text-gold' : 'text-navy-600' }}" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-lg font-bold text-text-primary">{{ number_format($avgRating, 1) }}</span>
                                    <span class="text-sm text-text-muted">({{ $ratingCount }})</span>
                                </div>
                            @endif
                        </div>
                        <p class="text-text-muted text-sm mt-1">{{ $trips->count() }} {{ __('trips available') }}</p>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold text-text-primary mb-6 animate-slide-up stagger-1">{{ __('Available Trips') }}</h3>

            @if($trips->isEmpty())
                <div class="card p-16 max-sm:p-8 text-center animate-slide-up stagger-1">
                    <div class="w-16 h-16 rounded-full bg-primary/40 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-text-secondary text-lg">{{ __('No trips available at the moment.') }}</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-6 max-sm:gap-2">
                    @foreach($trips as $trip)
                        <div class="card-hover overflow-hidden group animate-slide-up" style="animation-delay: {{ $loop->index * 0.05 }}s">
                            <div class="img-zoom relative">
                                @if($trip->image)
                                    <img src="{{ asset('storage/' . $trip->image) }}" class="w-full h-40 max-sm:h-24 sm:h-52 object-cover">
                                @else
                                    <div class="w-full h-40 max-sm:h-24 sm:h-52 skeleton"></div>
                                @endif
                                @if($trip->hasDiscount() && !in_array($trip->status, ['finished', 'paused']))
                                    <div class="absolute top-2 sm:top-3 left-2 sm:left-3">
                                        <span class="badge max-sm:text-[9px] max-sm:px-1.5 max-sm:py-0.5" style="background: linear-gradient(135deg, #B91C1C 0%, #D97706 100%); color: #fff; font-weight: 800;">{{ number_format($trip->getDiscountPercent(), 0) }}% OFF</span>
                                    </div>
                                @endif
                                @if($trip->status === 'finished')
                                    <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
                                        <span class="badge badge-primary max-sm:text-[9px] max-sm:px-1.5 max-sm:py-0.5">{{ __('Ended') }}</span>
                                    </div>
                                @elseif($trip->status === 'paused')
                                    <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
                                        <span class="badge badge-paused max-sm:text-[9px] max-sm:px-1.5 max-sm:py-0.5">{{ __('Paused') }}</span>
                                    </div>
                                @elseif($trip->available_seats <= 0)
                                    <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
                                        <span class="badge max-sm:text-[9px] max-sm:px-1.5 max-sm:py-0.5 bg-coral/90 text-white">{{ __('Sold Out') }}</span>
                                    </div>
                                @elseif($trip->hasOfficeDiscount())
                                    <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
                                        <span class="badge max-sm:text-[9px] max-sm:px-1.5 max-sm:py-0.5" style="background: linear-gradient(135deg, #B91C1C 0%, #D97706 100%); color: #fff; font-weight: 800;">-{{ number_format($trip->getOfficeDiscountPercent(), 1) }}%</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4 max-sm:p-2 sm:p-5">
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="text-sm max-sm:text-[11px] sm:text-lg font-bold text-text-primary flex-1">{{ $trip->getTranslatedName() }}</h3>
                                    <span class="text-xs max-sm:text-[9px] px-2.5 max-sm:px-1.5 py-1 rounded-full bg-gold/15 text-gold-light border border-gold/25 capitalize shrink-0 font-semibold tracking-wide">{{ $trip->trip_type }}</span>
                                </div>
                                <div class="flex items-center gap-3 max-sm:gap-1 mt-2 max-sm:mt-1 text-sm max-sm:text-[10px] text-text-muted">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3 text-navy-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                                        </svg>
                                        {{ $trip->user->name ?? __('Office') }}
                                    </div>
                                </div>
                                @php $avg = $trip->user->averageRating() @endphp
                                @if($avg)
                                    <div class="flex items-center gap-1.5 max-sm:gap-1 mt-2 max-sm:mt-1">
                                        <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3 text-gold" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <span class="text-sm max-sm:text-[10px] font-medium text-text-primary">{{ number_format($avg, 1) }}</span>
                                    </div>
                                @endif
                                <div class="flex items-center gap-3 max-sm:gap-1 mt-3 max-sm:mt-1 text-sm max-sm:text-[10px] text-text-muted">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $trip->duration }}
                                    </span>
                                    <span class="w-1 h-1 max-sm:w-0.5 max-sm:h-0.5 rounded-full bg-text-muted/30"></span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4 max-sm:w-3 max-sm:h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $trip->available_seats }} {{ __('seats') }}
                                    </span>
                                </div>
                                <div class="flex items-end justify-between mt-4 max-sm:mt-2 pt-4 max-sm:pt-2 border-t border-surface-border">
                                    <div>
                                        @if($trip->getTotalDiscountPercent() > 0)
                                            <span class="text-lg max-sm:text-xs line-through text-text-muted">${{ number_format($trip->seat_price, 2) }}</span>
                                            @if($trip->hasDiscount() && $trip->hasOfficeDiscount())
                                                <span class="text-base max-sm:text-[10px] line-through text-text-muted/50 block -mt-0.5">${{ number_format($trip->getPriceAfterOfficeDiscount(), 2) }}</span>
                                            @endif
                                            <span class="text-2xl max-sm:text-sm font-bold" style="color: #D97706;">${{ number_format($trip->getFinalPrice(), 2) }}</span>
                                        @else
                                            <span class="text-2xl max-sm:text-sm font-bold text-text-primary">${{ number_format($trip->seat_price, 2) }}</span>
                                        @endif
                                        <p class="text-xs max-sm:text-[9px] text-text-muted mt-0.5">
                                            <svg class="w-3 h-3 max-sm:w-2 max-sm:h-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($trip->departure_time)->format('M d, H:i') }}
                                        </p>
                                    </div>
                                    @if(in_array($trip->status, ['finished', 'closed', 'paused']) || $trip->available_seats <= 0)
                                        <a href="{{ route('trips.show', $trip->id) }}" class="inline-flex items-center justify-center rounded-[8px] text-sm max-sm:text-[10px] font-medium px-4 max-sm:px-2 py-2 max-sm:py-1.5 bg-primary text-white hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out">
                                            {{ __('Details') }}
                                        </a>
                                    @else
                                        <a href="{{ route('trips.show', $trip->id) }}" class="btn-gold text-sm max-sm:text-[10px] px-5 max-sm:px-2 py-2.5 max-sm:py-1.5">
                                            {{ __('Book') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $trips->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>