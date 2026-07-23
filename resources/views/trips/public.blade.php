<x-app-layout>
    @section('header_logo')
    <a href="{{ route('dashboard') }}" id="navbar-logo">
                                        <img src="{{ asset('images/logo1.png') }}" alt="Trips Hub" class="h-[110px] max-md:h-[55px] max-sm:h-[45px] w-auto object-contain drop-shadow-[0_0_5px_rgba(255,255,255,0.2)]">
    </a>
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Available Trips') }}</h2>
    </x-slot>

    @push('styles')
    <style>
.card, .card-hover { background-color: #181B40 !important; }
@keyframes wave {
  0% {
    d: path("M0,60 C200,20 400,100 600,60 C800,20 900,120 1000,80 L1000,180 C900,220 800,120 600,160 C400,200 200,120 0,160 Z");
  }
  50% {
    d: path("M0,58 C200,25 400,95 600,63 C800,18 900,118 1000,78 L1000,178 C900,218 800,118 600,163 C400,195 200,125 0,158 Z");
  }
  100% {
    d: path("M0,60 C200,20 400,100 600,60 C800,20 900,120 1000,80 L1000,180 C900,220 800,120 600,160 C400,200 200,120 0,160 Z");
  }
}
.waving path {
  animation: wave 4s ease-in-out infinite;
}

/* Logo transfer effect */
#hero-logo-wrapper {
  transition: opacity 0.6s ease-out !important;
}
.hero-offscreen #hero-logo-wrapper {
  opacity: 0 !important;
  animation: none !important;
}
.hero-offscreen #hero-logo-wrapper .animate-float,
.hero-offscreen #hero-logo-wrapper .animate-logo-entrance {
  animation: none !important;
}
#navbar-logo {
  opacity: 0;
  transform: translateY(-15px) scale(0.8);
  transition: opacity 0.6s ease-out, transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.hero-offscreen #navbar-logo {
  opacity: 1 !important;
  transform: translateY(0) scale(1) !important;
}
@media (max-width: 767px) {
  .flex-none.relative { margin-top: -240px !important; }
  .flex-none.relative .h-\[950px\] { height: 600px !important; }
  #hero-logo-wrapper img { width: 12rem !important; height: 12rem !important; }
  #hero-logo-wrapper { top: calc(33.333% + 240px - 12rem + 10px) !important; }
  .flex-none.relative .h-\[185px\] { height: 100px !important; }
  .flex-none.relative .text-2xl { font-size: 14px !important; }
  .flex-none.relative .top-\[calc\(33\.333\%\+390px\)\] { top: calc(33.333% + 240px) !important; }
}
@media (max-width: 1023px) {
  .flex-none.relative .h-\[950px\] { height: 750px !important; }
}
    </style>
    @endpush

    <div class="flex-none relative" style="margin-top: -359px;">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="relative h-[950px] overflow-hidden">
                    <img src="{{ asset('images/damascus-bg.png') }}" alt="" class="absolute top-0 left-0 w-full h-full object-cover blur-[2px]">
                    <div class="absolute top-[calc(33.333%+390px-26.4rem+10px)] left-1/2 -translate-x-1/2 z-20" id="hero-logo-wrapper">
                        <div class="animate-logo-entrance">
                            <div class="animate-float">
                                <img src="{{ asset('images/logo1.png') }}" alt="Trips Hub" class="object-contain w-[26.4rem] h-[26.4rem] drop-shadow-[0_0_25px_rgba(0,0,0,0.9)]">
                            </div>
                        </div>
                    </div>
                    <div class="absolute top-[calc(33.333%+390px)] left-0 w-full flex justify-center">
                        <div class="relative w-full h-[185px] overflow-hidden">
                            <svg class="absolute inset-0 w-full h-full waving" viewBox="0 0 1000 200" preserveAspectRatio="none">
                                <defs>
                                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#30000B"/>
                                        <stop offset="50%" stop-color="#9B1830"/>
                                        <stop offset="100%" stop-color="#400010"/>
                                    </linearGradient>
                                </defs>
                                <path id="ribbonPath" d="M0,60 C200,20 400,100 600,60 C800,20 900,120 1000,80 L1000,180 C900,220 800,120 600,160 C400,200 200,120 0,160 Z" fill="url(#grad)"/>
                                <path d="M0,67 C200,27 400,107 600,67 C800,27 900,127 1000,87 L1000,173 C900,213 800,113 600,153 C400,193 200,113 0,153 Z" fill="none" stroke="rgba(255,255,255,0.35)" stroke-width="1" style="animation: none !important;"/>
                            </svg>
                            <div class="absolute left-1/2 top-[55%] -translate-x-1/2 -translate-y-1/2 text-white font-bold drop-shadow-[0_0_10px_rgba(128,0,32,0.6)] text-center max-sm:whitespace-normal max-sm:w-[90%]">
                                <div class="text-2xl max-sm:text-sm">{{ __("Get a special platform offer: 5% discount on all trips!") }}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 sm:px-6 lg:px-8 pb-12 -mt-16 relative z-20">
        <div class="max-w-7xl mx-auto">
            <form method="GET" class="card p-6 mb-8 animate-slide-up shadow-xl">
                <div class="grid grid-cols-2 max-sm:grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3 sm:gap-4">
                    <div class="col-span-2 max-sm:col-span-1 sm:col-span-2 lg:col-span-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search trips...') }}" class="input">
                    </div>
                    <div>
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="{{ __('Min price') }}" class="input">
                    </div>
                    <div>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="{{ __('Max price') }}" class="input">
                    </div>
                    <div>
                        <input type="date" name="date" value="{{ request('date') }}" class="input">
                    </div>
                    <div>
                        <select name="sort" class="input">
                            <option value="departure" {{ request('sort') == 'departure' ? 'selected' : '' }}>{{ __('Sort by Date') }}</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>{{ __('Sort by Price') }}</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>{{ __('Sort by Rating') }}</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 mt-4">
                    <button type="submit" class="btn-primary-sm">{{ __('Filter') }}</button>
                    <a href="{{ route('trips.public') }}" class="btn-secondary text-sm px-4 py-2.5">{{ __('Clear') }}</a>
                </div>
            </form>

            @if($trips->isEmpty())
                <div class="card p-16 max-sm:p-8 text-center animate-slide-up">
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
                                        <a href="{{ route('trips.show', $trip->id) }}" class="inline-flex items-center justify-center rounded-[8px] text-sm max-sm:text-[10px] font-medium px-4 max-sm:px-2 py-2 bg-primary text-white hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out">
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

                <div class="mt-10">
                    {{ $trips->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

<script>
(function() {
    const hero = document.querySelector('.flex-none.relative');
    const nav = document.getElementById('navbar-logo');
    if (!hero || !nav) return;
    function check() {
        document.body.classList.toggle('hero-offscreen', hero.getBoundingClientRect().bottom < window.innerHeight * 0.25);
    }
    check();
    window.addEventListener('scroll', check, {passive:true});
})();
</script>
