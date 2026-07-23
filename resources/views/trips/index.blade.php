<x-app-layout>
    <x-slot name="header">
            <div class="flex items-center gap-4">
                <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('My Trips') }}</h2>
                <div class="flex items-center gap-2 ml-auto">
                <a href="{{ route('trips.create.multi') }}" class="btn-primary-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    {{ __('Create New Trip') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-6 p-4 bg-teal/10 border border-teal/15 rounded-[12px] text-teal-light flex items-center gap-3 animate-slide-down">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-4">
                @forelse($trips as $trip)
                    <div class="card-hover overflow-hidden group animate-slide-up" style="animation-delay: {{ $loop->index * 0.05 }}s">
                        <div class="img-zoom">
                            @if($trip->image)
                                <img src="{{ asset('storage/' . $trip->image) }}" class="w-full h-44 object-cover">
                            @else
                                <div class="w-full h-44 skeleton"></div>
                            @endif
                        </div>

                        <div class="p-5">
                            <h3 class="text-lg font-bold text-text-primary">{{ $trip->getTranslatedName() }}</h3>

                            <div class="flex items-center gap-3 mt-2 text-sm text-text-muted">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $trip->duration }}
                                </span>
                                <span class="w-1 h-1 rounded-full bg-text-muted/30"></span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $trip->available_seats }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xl font-bold text-text-primary">${{ $trip->seat_price }}</span>
                                <span class="badge {{ $trip->status === 'finished' ? 'badge-primary' : ($trip->status === 'canceled' ? 'badge-danger' : 'badge-success') }} capitalize">{{ $trip->status }}</span>
                            </div>

                            <p class="text-xs text-text-muted mt-2">{{ \Carbon\Carbon::parse($trip->departure_time)->format('M d, Y H:i') }}</p>

                            <div class="flex gap-2 mt-4 pt-4 border-t border-surface-border">
                                @if($trip->status === 'canceled')
                                    <span class="flex-1 text-center px-3 py-2 rounded-[8px] text-sm font-medium bg-coral/10 text-coral-light">
                                        {{ __('Canceled') }}
                                    </span>
                                @elseif($trip->status === 'open')
                                <a href="{{ route('trips.edit', $trip->id) }}" class="flex-1 text-center px-3 py-2 rounded-[8px] text-sm font-medium bg-gold/10 text-gold-light hover:bg-gold/20 transition-all duration-300">
                                    {{ __('Edit') }}
                                </a>
                                <a href="{{ route('office.trip.bookings', $trip->id) }}" class="flex-1 text-center px-3 py-2 rounded-[8px] text-sm font-medium bg-teal/10 text-teal-light hover:bg-teal/20 transition-all duration-300">
                                    {{ __('Bookings') }}
                                </a>
                                <button type="button"
                                    @click.prevent="$dispatch('open-confirm-modal', {
                                        action: '{{ route('trips.cancel', $trip->id) }}',
                                        method: 'PATCH',
                                        title: '{{ __('Cancel trip') }}',
                                        message: '{{ __('Are you sure you want to cancel this trip?') }}',
                                        confirmText: 'TripsHub',
                                        buttonText: '{{ __('Cancel') }}',
                                        buttonClass: 'bg-ice'
                                    })"
                                    class="flex-1 px-3 py-2 rounded-[8px] text-sm font-medium bg-ice/15 text-ice-light border border-ice/25 hover:bg-ice/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-300 ease-out cursor-pointer">
                                    {{ __('Cancel') }}
                                </button>
                                @else
                                <a href="{{ route('trips.show', $trip->id) }}" class="flex-1 text-center px-3 py-2 rounded-[8px] text-sm font-medium bg-primary text-white hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-300 ease-out">
                                    {{ __('Details') }}
                                </a>
                                <a href="{{ route('office.trip.bookings', $trip->id) }}" class="flex-1 text-center px-3 py-2 rounded-[8px] text-sm font-medium bg-teal/10 text-teal-light hover:bg-teal/20 transition-all duration-300">
                                    {{ __('Bookings') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full card p-16 max-sm:p-8 text-center">
                        <div class="w-16 h-16 rounded-full bg-primary/40 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-text-secondary text-lg mb-4">{{ __('No trips yet') }}</p>
                        <a href="{{ route('trips.create.multi') }}" class="btn-primary">
                            {{ __('Create New Trip') }}
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $trips->links() }}
            </div>
        </div>
    </div>

    {{-- Create trip options shown as inline links in header --}}

    <x-confirm-modal />
</x-app-layout>