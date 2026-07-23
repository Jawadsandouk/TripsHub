<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('My Bookings') }}</h2>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12" x-data="bookingModals()">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="mb-6 p-4 bg-teal/10 border border-teal/15 rounded-[12px] text-teal-light flex items-center gap-3 animate-slide-down">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 p-4 bg-coral/10 border border-coral/15 rounded-[12px] text-coral-light flex items-center gap-3 animate-slide-down">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if($bookings->isEmpty())
                <div class="card p-16 max-sm:p-8 text-center entrance">
                    <div class="w-16 h-16 rounded-full bg-primary/40 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <p class="text-text-secondary text-lg mb-4">{{ __('No bookings yet') }}</p>
                    <a href="{{ route('trips.public') }}" class="btn-primary">{{ __('Browse Trips') }}</a>
                </div>
            @else
                <div class="space-y-6 entrance">
                    @foreach($bookings as $booking)
                        @php
                            $ticketId = strtoupper(substr(md5($booking->id . ($booking->payment?->id ?? '')), 0, 8));
                            $discountPercent = $booking->trip->getDiscountPercent();
                            $discountAmount = $booking->trip->getDiscountAmount();
                            $seatPrice = $booking->trip->seat_price;
                            $totalBefore = $seatPrice * $booking->number_of_seats;
                            $isFinished = \Carbon\Carbon::parse($booking->trip->departure_time)->endOfDay()->isPast();
                        @endphp
                        <div class="golden-card">
                            <div class="gold-accent-line"></div>

                            <div class="p-5 sm:p-7">
                                <div class="flex items-start justify-between flex-wrap gap-3 mb-5">
                                    <div>
                                        <p class="text-[10px] tracking-[0.2em] uppercase" style="color: rgba(184, 168, 144, 0.4);">{{ __('e-ticket') }}</p>
                                        <p class="text-sm font-semibold" style="color: #C9A96E;">#{{ $ticketId }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if($discountPercent > 0)
                                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-md" style="background: rgba(74, 222, 128, 0.12); color: #4ADE80;">−{{ number_format($discountPercent, 0) }}%</span>
                                        @endif
                                        <span class="text-[11px] font-semibold px-3 py-1 rounded-full" style="background: rgba(201, 169, 110, 0.1); color: #C9A96E;">{{ __('confirmed') }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-start gap-4 sm:gap-6">
                                    @if($booking->trip->image)
                                        <div class="shrink-0 w-full sm:w-28 h-32 sm:h-28 rounded-xl overflow-hidden border" style="border-color: rgba(201, 169, 110, 0.1);">
                                            <img src="{{ asset('storage/' . $booking->trip->image) }}" alt="{{ $booking->trip->getTranslatedName() }}" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-xl font-black mb-0.5 truncate" style="color: #E8DEC8;">{{ $booking->trip->getTranslatedName() }}</h3>
                                        <p class="text-sm mb-3" style="color: rgba(184, 168, 144, 0.5);">{{ $booking->trip->user->name ?? '' }}</p>

                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                            <div class="golden-info-box">
                                                <p class="golden-info-label">{{ __('departure') }}</p>
                                                <p class="golden-info-value">{{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('M d, Y · H:i') }}</p>
                                            </div>
                                            <div class="golden-info-box">
                                                <p class="golden-info-label">{{ __('Seats') }}</p>
                                                <p class="golden-info-value">{{ $booking->number_of_seats }} <span class="text-xs font-normal" style="color: rgba(184, 168, 144, 0.45);">&times; ${{ number_format($seatPrice, 2) }}</span></p>
                                            </div>
                                            <div class="golden-info-box">
                                                <p class="golden-info-label">{{ __('Booked') }}</p>
                                                <p class="golden-info-value text-sm">{{ $booking->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <div class="golden-info-box">
                                                <p class="golden-info-label">{{ __('total') }}</p>
                                                <p class="text-lg font-black" style="color: #C9A96E;">${{ number_format($booking->total_price, 2) }}</p>
                                                @if($discountPercent > 0)
                                                    <p class="text-xs line-through" style="color: rgba(184, 168, 144, 0.3);">${{ number_format($totalBefore, 2) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="golden-divider"></div>

                            <div class="px-5 sm:px-7 py-4 flex flex-wrap items-center justify-end gap-2 sm:gap-3">
                                <a href="{{ route('trips.show', $booking->trip_id) }}"
                                   class="golden-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ __('Details') }}
                                </a>
                                @if(!$isFinished)
                                    <button type="button"
                                        @click="resendOpen('{{ route('bookings.resend-ticket', $booking->id) }}', '{{ $booking->trip->getTranslatedName() }}', '{{ Auth::user()->email }}')"
                                        class="golden-btn">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                        </svg>
                                        {{ __('Resend Ticket') }}
                                    </button>
                                    <button type="button"
                                        @click="open('{{ route('bookings.destroy', $booking->id) }}', '{{ $booking->trip->getTranslatedName() }}')"
                                        class="golden-btn-danger">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        {{ __('Cancel') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="pt-2">
                        {{ $bookings->links() }}
                    </div>
                </div>
            @endif
        </div>

        {{-- Cancel Confirmation Modal --}}
        <div x-show="cancelShow"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             style="display: none; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);"
             @click.self="cancelShow = false">

            <div x-show="cancelShow"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="w-full max-w-md rounded-[20px] overflow-hidden"
                 style="background: linear-gradient(180deg, #1C1811 0%, #14110C 100%); border: 1px solid rgba(201, 169, 110, 0.15); box-shadow: 0 24px 80px rgba(0,0,0,0.6);">

                <div class="text-center px-8 pt-8 pb-6">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-coral/20 to-rose/10 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold" style="color: #E8DEC8;">{{ __('Cancel Booking?') }}</h3>
                    <p class="text-sm mt-3" style="color: rgba(184, 168, 144, 0.6);">
                        {{ __('Are you sure you want to cancel your booking for') }}
                        <span class="font-semibold" style="color: #E8DEC8;" x-text="cancelTripName"></span>?
                    </p>
                    <p class="text-xs mt-3" style="color: rgba(184, 168, 144, 0.35);">
                        {{ __('Your seats will be released and you will not be charged.') }}
                    </p>
                </div>

                <div class="flex gap-3 px-8 pb-8">
                    <button type="button" @click="cancelShow = false"
                            class="flex-1 px-5 py-3 rounded-[12px] text-sm font-medium transition-all duration-200"
                            style="background: rgba(184, 168, 144, 0.08); color: rgba(184, 168, 144, 0.7);">
                        {{ __('Keep Booking') }}
                    </button>
                    <form :action="cancelAction" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit"
                                 class="w-full px-5 py-3 rounded-[12px] text-sm font-bold bg-ice/15 text-ice-light border border-ice/25 hover:bg-ice/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            {{ __('Yes, Cancel') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Resend Ticket Modal --}}
        <div x-show="resendShow"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             style="display: none; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);"
             @click.self="resendShow = false">

            <div x-show="resendShow"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="w-full max-w-md rounded-[20px] overflow-hidden"
                 style="background: linear-gradient(180deg, #1C1811 0%, #14110C 100%); border: 1px solid rgba(201, 169, 110, 0.15); box-shadow: 0 24px 80px rgba(0,0,0,0.6);">

                <div class="text-center px-8 pt-8 pb-6">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-gold/20 to-amber/10 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-gold-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold" style="color: #E8DEC8;">{{ __('Resend Ticket') }}</h3>
                    <p class="text-sm mt-3" style="color: rgba(184, 168, 144, 0.6);">
                        {{ __('Enter your email to receive the ticket for') }}
                    </p>
                    <p class="text-base font-semibold mt-1.5" style="color: #E8DEC8;" x-text="resendTripName"></p>

                    <form :action="resendAction" method="POST" class="mt-6 text-start">
                        @csrf
                        <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: rgba(184, 168, 144, 0.4);" for="resend_email">{{ __('Email') }}</label>
                        <input id="resend_email" type="email" name="email" required
                               class="w-full px-4 py-3 rounded-xl text-sm"
                               style="background: rgba(184, 168, 144, 0.06); border: 1px solid rgba(201, 169, 110, 0.12); color: #E8DEC8; outline: none;"
                               placeholder="name@example.com"
                               x-ref="resendEmail">
                        <div class="flex gap-3 mt-6">
                            <button type="button" @click="resendShow = false"
                                    class="flex-1 px-5 py-3 rounded-[12px] text-sm font-medium transition-all duration-200"
                                    style="background: rgba(184, 168, 144, 0.08); color: rgba(184, 168, 144, 0.7);">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit"
                                    class="flex-1 px-5 py-3 rounded-[12px] text-sm font-bold text-navy-950 bg-btn-gold hover:bg-gold-light hover:scale-105 hover:shadow-lg hover:shadow-gold/20 active:scale-95 transition-all duration-200 ease-out flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ __('Send') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('bookingModals', () => ({
                cancelShow: false,
                cancelAction: '',
                cancelTripName: '',
                resendShow: false,
                resendAction: '',
                resendTripName: '',
                open(action, name) {
                    this.cancelAction = action;
                    this.cancelTripName = name;
                    this.cancelShow = true;
                },
                resendOpen(action, name, email) {
                    this.resendAction = action;
                    this.resendTripName = name;
                    this.resendShow = true;
                    this.$nextTick(() => {
                        if (this.$refs.resendEmail) {
                            this.$refs.resendEmail.value = email || '';
                            this.$refs.resendEmail.focus();
                        }
                    });
                }
            }));
        });
    </script>
</x-app-layout>