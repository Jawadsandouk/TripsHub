<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <button type="button" onclick="goBack()" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </button>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ $trip->getTranslatedName() }}</h2>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-4xl mx-auto">
            @if(session('error'))
                <div class="flash-error animate-slide-down">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 p-4 bg-teal/10 border border-teal/15 rounded-[12px] text-teal-light text-sm flex items-center gap-3 animate-slide-down">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card overflow-hidden entrance">
                <div class="img-zoom relative">
                    @if($trip->image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $trip->image) }}" class="w-full h-[320px] object-cover">
                            @if(Auth::check() && Auth::id() === $trip->user_id)
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <form action="{{ route('trips.image.upload', $trip->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 rounded-[10px] bg-white/10 border border-white/20 text-white text-sm font-medium hover:bg-white/20 transition-all backdrop-blur-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ __('Change Image') }}
                                            <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @elseif(Auth::check() && Auth::id() === $trip->user_id)
                        <div class="w-full h-[320px] flex flex-col items-center justify-center bg-primary/30 border-2 border-dashed border-surface-border rounded-none">
                            <svg class="w-12 h-12 text-text-muted mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-text-muted text-sm mb-3">{{ __('Add a photo to your trip') }}</p>
                            <form action="{{ route('trips.image.upload', $trip->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 rounded-[10px] bg-primary/10 border border-primary/20 text-primary-light text-sm font-medium hover:bg-primary/20 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    {{ __('Upload Image') }}
                                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="this.form.submit()">
                                </label>
                            </form>
                        </div>
                    @endif
                </div>

                @if($trip->images->count())
                    <div class="px-8 py-4 border-b border-surface-border/60">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-xs text-text-muted font-medium uppercase tracking-wider">{{ __('Gallery') }}</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($trip->images as $img)
                                <a href="{{ asset('storage/' . $img->image_path) }}" target="_blank" class="block w-16 sm:w-20 md:w-24 h-16 sm:h-20 md:h-24 rounded-[10px] border border-surface-border/60 overflow-hidden hover:ring-2 hover:ring-primary/40 transition-all duration-200">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="p-5 md:p-8">
                    <div class="flex flex-wrap md:flex-nowrap items-start justify-between gap-4 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-accent-purple/20 to-primary/10 flex items-center justify-center">
                                <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-text-muted text-xs uppercase tracking-wider">{{ __('Travel Office') }}</p>
                                <div class="flex items-center gap-2">
                                    <p class="text-lg font-bold text-text-primary">{{ $trip->user->name ?? 'N/A' }}</p>
                                    @php
                                        $office = $trip->user;
                                        $avgRating = $office ? $office->averageRating() : null;
                                        $ratingCount = $office ? $office->ratingCount() : 0;
                                    @endphp
                                    @if($avgRating)
                                        <div class="flex items-center gap-1 ml-1">
                                            <div class="flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-3.5 h-3.5 {{ $i <= round($avgRating) ? 'text-gold' : 'text-navy-600' }}" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <span class="text-sm font-bold text-text-primary">{{ number_format($avgRating, 1) }}</span>
                                            <span class="text-xs text-text-muted">({{ $ratingCount }})</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <span class="badge badge-primary capitalize">{{ $trip->trip_type ?? __('Trip') }}</span>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="p-4 rounded-[12px] bg-primary/30 border border-surface-border">
                            <p class="text-text-muted text-xs uppercase tracking-wider mb-1">{{ __('Duration') }}</p>
                            <p class="text-lg font-semibold text-text-primary">{{ $trip->duration }}</p>
                        </div>
                        <div class="p-4 rounded-[12px] bg-primary/30 border border-surface-border">
                            <p class="text-text-muted text-xs uppercase tracking-wider mb-1">{{ __('Available Seats') }}</p>
                            <p class="text-lg font-semibold text-text-primary">{{ $trip->available_seats }}</p>
                        </div>
                        <div class="p-4 rounded-[12px] bg-primary/30 border border-surface-border">
                            <p class="text-text-muted text-xs uppercase tracking-wider mb-1">{{ __('Seat Price') }}</p>
                            @if($trip->getTotalDiscountPercent() > 0)
                                <p class="text-sm line-through text-text-muted">${{ number_format($trip->seat_price, 2) }}</p>
                                @if($trip->hasDiscount() && $trip->hasOfficeDiscount())
                                    <p class="text-sm line-through text-text-muted/50">${{ number_format($trip->getPriceAfterOfficeDiscount(), 2) }}</p>
                                @endif
                                <p class="text-lg font-bold" style="color: #D97706;">${{ number_format($trip->getFinalPrice(), 2) }}
                                    @if($trip->hasDiscount())
                                    <span class="text-xs font-bold" style="background: linear-gradient(135deg, #B91C1C 0%, #D97706 100%); color: #fff; padding: 1px 6px; border-radius: 4px;">-{{ number_format($trip->getDiscountPercent(), 0) }}%</span>
                                    @endif
                                    @if($trip->hasOfficeDiscount())
                                    <span class="text-xs font-bold" style="background: linear-gradient(135deg, #B91C1C 0%, #D97706 100%); color: #fff; padding: 1px 6px; border-radius: 4px;">-{{ number_format($trip->getOfficeDiscountPercent(), 1) }}%</span>
                                    @endif
                                </p>
                            @else
                                <p class="text-lg font-bold text-primary-light">${{ number_format($trip->seat_price, 2) }}</p>
                            @endif
                        </div>
                        <div class="p-4 rounded-[12px] bg-primary/30 border border-surface-border">
                            <p class="text-text-muted text-xs uppercase tracking-wider mb-1">{{ __('Food Policy') }}</p>
                            <p class="text-lg font-semibold text-text-primary">{{ $trip->food_policy }}</p>
                        </div>
                        <div class="p-4 rounded-[12px] bg-primary/30 border border-surface-border">
                            <p class="text-text-muted text-xs uppercase tracking-wider mb-1">{{ __('Departure') }}</p>
                            <p class="text-lg font-semibold text-text-primary">{{ \Carbon\Carbon::parse($trip->departure_time)->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="p-4 rounded-[12px] bg-primary/30 border border-surface-border">
                            <p class="text-text-muted text-xs uppercase tracking-wider mb-1">{{ __('Meeting Point') }}</p>
                            <p class="text-lg font-semibold text-text-primary">{{ $trip->getTranslatedMeetingPoint() ?? 'N/A' }}</p>
                        </div>
                        <div class="p-4 rounded-[12px] bg-primary/30 border border-surface-border">
                            <p class="text-text-muted text-xs uppercase tracking-wider mb-1">{{ __('Status') }}</p>
                            <span class="badge
                                @if($trip->status === 'finished') badge-primary
                                @elseif($trip->status === 'canceled') badge-danger
                                @elseif($trip->status === 'paused') badge-paused
                                @else badge-success
                                @endif capitalize">{{ __($trip->status) }}</span>
                        </div>
                        <div class="p-4 rounded-[12px] bg-primary/30 border border-surface-border">
                            <p class="text-text-muted text-xs uppercase tracking-wider mb-1">{{ __('Trip Type') }}</p>
                            <p class="text-lg font-semibold text-text-primary capitalize">{{ $trip->trip_type ?? 'N/A' }}</p>
                        </div>
                    </div>

                    @if($trip->getTranslatedDescription())
                        <div class="mt-6 p-4 rounded-[12px] bg-primary/30 border border-surface-border">
                            <p class="text-text-muted text-xs uppercase tracking-wider mb-2">{{ __('Description') }}</p>
                            <p class="text-text-primary leading-relaxed whitespace-pre-line">{{ $trip->getTranslatedDescription() }}</p>
                        </div>
                    @endif

                    @if($trip->latitude && $trip->longitude)
                        <div class="mt-6 p-4 rounded-[12px] bg-primary/30 border border-surface-border">
                            <p class="text-text-muted text-xs uppercase tracking-wider mb-2">{{ __('Location') }}</p>
                            <button type="button" onclick="openViewMap()" class="btn-outline text-xs px-4 py-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ __('View Location') }}
                            </button>
                        </div>

                        {{-- View-only map modal --}}
                        <div id="view-map-modal" class="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-4" style="display: none;">
                            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeViewMap()"></div>
                            <div class="relative bg-surface-card rounded-[12px] sm:rounded-[16px] border border-surface-border shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden">
                                <div class="flex items-center justify-between p-3 sm:p-4 border-b border-surface-border">
                                    <h3 class="text-sm sm:text-lg font-bold text-text-primary">{{ __('Location') }}</h3>
                                    <button type="button" onclick="closeViewMap()" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-3 sm:p-4">
                                    <div id="view-map-container" class="w-full rounded-[12px] border border-surface-border" style="height: 400px; max-height: 50vh;"></div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function openViewMap() {
                                document.getElementById('view-map-modal').style.display = 'flex';
                                setTimeout(function() {
                                    var el = document.getElementById('view-map-container');
                                    if (!el._leaflet_map && typeof L !== 'undefined') {
                                        var map = L.map('view-map-container', {
                                            center: [{{ $trip->latitude }}, {{ $trip->longitude }}],
                                            zoom: 14,
                                            zoomControl: true,
                                        });
                                        el._leaflet_map = map;
                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap' }).addTo(map);
                                        L.marker([{{ $trip->latitude }}, {{ $trip->longitude }}]).addTo(map);
                                    } else if (el._leaflet_map) {
                                        el._leaflet_map.invalidateSize();
                                    }
                                }, 250);
                            }
                            function closeViewMap() {
                                document.getElementById('view-map-modal').style.display = 'none';
                            }
                        </script>
                    @endif
                    @if($trip->stops && $trip->stops->count() > 0)
                    @push('scripts')
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            if (typeof L === 'undefined') return;
                            @foreach($trip->stops as $stop)
                            @if($stop->latitude && $stop->longitude)
                            (function() {
                                var el = document.querySelector('.stop-map-{{ $stop->id }}');
                                if (el) {
                                    var m = L.map(el, { center: [{{ $stop->latitude }}, {{ $stop->longitude }}], zoom: 13, zoomControl: false, attributionControl: false });
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(m);
                                    L.marker([{{ $stop->latitude }}, {{ $stop->longitude }}]).addTo(m);
                                }
                            })();
                            @endif
                            @endforeach
                        });
                    </script>
                    @endpush
                    @endif

                    @if($trip->stops && $trip->stops->count() > 0)
                        <div class="mt-8 pt-8 border-t border-surface-border">
                            <h3 class="text-xl font-bold text-text-primary mb-8 flex items-center gap-3">
                                <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                                {{ __('Tour Stops') }}
                            </h3>

                            <div class="relative">
                                <div class="absolute left-[19px] top-3 bottom-3 w-0.5 bg-gradient-to-b from-gold/60 via-primary/30 to-gold/60"></div>

                                @foreach($trip->stops as $stop)
                                    <div class="relative pl-10 md:pl-14 pb-8 last:pb-0 group">
                                        <div class="absolute left-2.5 top-2 w-[15px] h-[15px] rounded-full border-[3px] border-gold bg-surface-card group-hover:shadow-[0_0_12px_rgba(201,169,110,0.4)] transition-shadow duration-300 z-10"></div>

                                        <div class="card-hover p-5 rounded-[12px] bg-surface-card/60 border border-surface-border/60 backdrop-blur-sm">
                                            <div class="flex items-start justify-between gap-4">
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-3 mb-2">
                                                        <span class="badge badge-warning text-xs font-bold px-2.5 py-0.5 rounded-full">{{ __('Stop') }} {{ $stop->stop_order }}</span>
                                                        <span class="text-xs text-text-muted flex items-center gap-1">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                            </svg>
                                                            {{ $stop->stop_duration }} {{ __('hour') }}
                                                        </span>
                                                    </div>
                                                    <h4 class="text-base font-bold text-text-primary mb-1">{{ $stop->{'place_name_' . session('locale', 'en')} ?? $stop->place_name }}</h4>
                                                    @if($stop->{'description_' . session('locale', 'en')} ?? $stop->description)
                                                        <p class="text-sm text-text-secondary leading-relaxed">{{ $stop->{'description_' . session('locale', 'en')} ?? $stop->description }}</p>
                                                    @endif
                                                </div>
                                                    @if($stop->latitude && $stop->longitude)
                                                        <div class="shrink-0 w-24 md:w-40 h-20 md:h-24 rounded-[10px] overflow-hidden border border-surface-border/60">
                                                            <div class="stop-map-{{ $stop->id }} w-full h-full" data-lat="{{ $stop->latitude }}" data-lng="{{ $stop->longitude }}"></div>
                                                        </div>
                                                    @elseif($stop->image)
                                                        <div class="shrink-0">
                                                            <img src="{{ asset('storage/' . $stop->image) }}" class="w-20 h-20 rounded-[10px] object-cover border border-surface-border/60">
                                                        </div>
                                                    @endif
                                            </div>
                                            <div class="mt-3 pt-3 border-t border-surface-border/40 flex items-center gap-4">
                                                <button type="button" onclick="openStopGallery({{ $stop->id }})" class="inline-flex items-center gap-1.5 text-xs font-medium {{ $stop->images->count() ? 'text-primary-light hover:text-primary' : 'text-text-muted/50 hover:text-text-muted' }} transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    {{ __('View Images') }} ({{ $stop->images->count() }})
                                                </button>
                                                @if($stop->latitude && $stop->longitude)
                                                    <button type="button" onclick="openStopMap({{ $stop->id }}, {{ $stop->latitude }}, {{ $stop->longitude }})" class="inline-flex items-center gap-1.5 text-xs font-medium text-teal-light hover:text-teal transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        </svg>
                                                        {{ __('View Location') }}
                                                    </button>
                                                @else
                                                    <button type="button" disabled class="inline-flex items-center gap-1.5 text-xs font-medium text-text-muted/30 cursor-not-allowed">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        </svg>
                                                        {{ __('View Location') }}
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($trip->available_seats > 0 && !in_array($trip->status, ['finished', 'closed', 'paused']))
                        <div class="mt-8 pt-8 border-t border-surface-border entrance stagger-4" x-data="{ seats: 1, maxSeats: {{ $trip->available_seats }} }">
                            <h3 class="text-xl font-bold text-text-primary mb-6">{{ __('Book This Trip') }}</h3>
                            <form action="{{ route('payment.create', $trip->id) }}" method="GET" class="flex flex-wrap gap-4 md:gap-6 items-end">
                                <div>
                                    <label class="block text-xs text-text-muted mb-2">{{ __('Seats') }}</label>
                                    <div class="flex items-center gap-0 bg-primary/30 border border-surface-border rounded-[10px] overflow-hidden" style="border-color: rgba(201, 169, 110, 0.12);">
                                        <button type="button" @click="seats = Math.max(1, seats - 1)"
                                                class="w-10 h-10 flex items-center justify-center text-lg font-bold transition-all duration-200 hover:bg-primary/40"
                                                style="color: rgba(184, 168, 144, 0.6);" :style="seats <= 1 ? 'color: rgba(184, 168, 144, 0.15); cursor: not-allowed;' : ''">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"/>
                                            </svg>
                                        </button>
                                        <input type="number" name="number_of_seats" x-model="seats"
                                               min="1" :max="maxSeats" required
                                               class="w-14 h-10 bg-transparent text-center text-lg font-bold text-text-primary border-x border-surface-border outline-none"
                                               style="border-color: rgba(201, 169, 110, 0.08);"
                                               @input="seats = Math.min(maxSeats, Math.max(1, parseInt($event.target.value) || 1))">
                                        <button type="button" @click="seats = Math.min(maxSeats, seats + 1)"
                                                class="w-10 h-10 flex items-center justify-center text-lg font-bold transition-all duration-200 hover:bg-primary/40"
                                                style="color: rgba(184, 168, 144, 0.6);" :style="seats >= maxSeats ? 'color: rgba(184, 168, 144, 0.15); cursor: not-allowed;' : ''">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                {{-- Points display --}}
                                <div>
                                    <label class="block text-xs text-text-muted mb-2">{{ __('Points') }}</label>
                                    <div class="flex items-center gap-2 px-4 h-10 rounded-[10px]" style="background: rgba(201, 169, 110, 0.06); border: 1px solid rgba(201, 169, 110, 0.12);">
                                        <svg class="w-4 h-4" style="color: #C9A96E;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm font-bold" style="color: #C9A96E;" x-text="seats"></span>
                                        <span class="text-xs" style="color: rgba(184, 168, 144, 0.5);">{{ __('pts') }}</span>
                                    </div>
                                </div>

                                <button type="submit" class="btn-gold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ __('Continue to Payment') }} —
                                    @if($trip->getTotalDiscountPercent() > 0)
                                        <span class="line-through text-sm opacity-70">${{ number_format($trip->seat_price, 2) }}</span>
                                        ${{ number_format($trip->getFinalPrice(), 2) }}/{{ __('seat') }}
                                        @if($trip->hasDiscount())
                                        <span style="background: rgba(185,28,28,0.25); padding: 0 4px; border-radius: 3px; font-size: 0.7rem;">-{{ number_format($trip->getDiscountPercent(), 0) }}%</span>
                                        @endif
                                        @if($trip->hasOfficeDiscount())
                                        <span style="background: rgba(185,28,28,0.25); padding: 0 4px; border-radius: 3px; font-size: 0.7rem;">-{{ number_format($trip->getOfficeDiscountPercent(), 1) }}%</span>
                                        @endif
                                    @else
                                        ${{ number_format($trip->seat_price, 2) }}/{{ __('seat') }}
                                    @endif
                                </button>
                            </form>
                        </div>
                    @elseif($trip->status === 'paused')
                        <div class="mt-8 p-5 rounded-[12px] bg-amber-500/10 border border-amber-500/15 text-amber-400 text-sm flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('This trip is paused and will be available for booking soon.') }}
                        </div>
                    @elseif($trip->available_seats <= 0)
                        <div class="mt-8 p-5 rounded-[12px] bg-gold/10 border border-gold/15 text-gold-light text-sm flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            {{ __('This trip is fully booked.') }}
                        </div>
                    @endif
                </div>
            </div>

            @php
                $tripEnded = $trip->status === 'finished';
                $userRating = null;
                $hasBookedTrip = false;
                if(Auth::check()) {
                    $userRating = \App\Models\Rating::where('user_id', Auth::id())->where('trip_id', $trip->id)->first();
                    $hasBookedTrip = \App\Models\Booking::where('user_id', Auth::id())->where('trip_id', $trip->id)->exists();
                }
            @endphp

            @if(Auth::check() && Auth::user()->role === 'user' && $tripEnded && $hasBookedTrip)
                <div class="card p-6 mt-6 entrance stagger-2">
                    <h3 class="text-lg font-bold text-text-primary mb-6">{{ __('Rate This Trip') }}</h3>

                    @if($tripEnded)
                        <div class="mb-5 p-4 rounded-[10px] bg-primary/5 border border-primary/10 text-text-secondary flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            {{ __('This trip has ended. Share your experience!') }}
                        </div>
                    @endif

                    <form action="{{ route('ratings.store', $trip->id) }}" method="POST" id="ratingForm">
                        @csrf
                        <input type="hidden" name="rating" id="ratingValue" value="{{ $userRating->rating ?? '' }}">
                        <div class="flex gap-2 mb-5">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="document.getElementById('ratingValue').value={{ $i }}; document.getElementById('ratingForm').submit()" 
                                    class="star {{ $userRating && $userRating->rating >= $i ? 'star-active' : 'star-inactive' }}">
                                    ★
                                </button>
                            @endfor
                        </div>

                        <textarea name="comment" rows="2" placeholder="{{ __('Write a review (optional)...') }}" class="input mb-4">{{ $userRating->comment ?? '' }}</textarea>

                        @if($userRating)
                            <button type="submit" class="btn-primary-sm">
                                {{ __('Update Rating') }}
                            </button>
                        @endif
                    </form>
                </div>

                @php
                    $tripRatings = \App\Models\Rating::with('user')->where('trip_id', $trip->id)->orderBy('created_at', 'desc')->limit(5)->get();
                @endphp

                @if($tripRatings->count() > 0)
                    <div class="card p-6 mt-6 entrance stagger-3">
                        <h3 class="text-lg font-bold text-text-primary mb-6">{{ __('Reviews') }}</h3>
                        <div class="space-y-5" id="reviews-list">
                            @foreach($tripRatings as $rating)
                                <div class="pb-5 border-b border-surface-border last:border-0 last:pb-0">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-accent-purple/20 to-primary/10 flex items-center justify-center">
                                            <span class="text-xs font-bold text-primary-light">{{ substr($rating->user->name, 0, 2) }}</span>
                                        </div>
                                        <div class="flex gap-0.5">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-gold' : 'text-navy-600' }}" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="text-sm text-text-muted">{{ $rating->user->name }}</span>
                                    </div>
                                    @if($rating->comment)
                                        <div class="comment-wrapper ml-11 relative" data-original='{{ $rating->comment }}'>
                                            <p class="comment-text text-text-secondary text-sm">{{ $rating->comment }}</p>
                                            <button type="button" class="comment-translate-toggle text-xs text-primary-light/60 hover:text-primary-light transition-colors mt-1 flex items-center gap-1" style="display:none" data-label-original="{{ __('Show original') }}" data-label-translated="{{ __('Show translated') }}">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m0 4a7 7 0 017 7M5 19l14-14"/>
                                                </svg>
                                                <span class="toggle-label">{{ __('Show original') }}</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>

    @php
        $_stopImages = $trip->stops->mapWithKeys(fn($s) => [
            $s->id => $s->images->map(fn($img) => asset('storage/' . $img->image_path))
        ]);
    @endphp

    <script>
        const stopImages = @json($_stopImages);

        function openStopGallery(stopId) {
            const images = stopImages[stopId];
            const container = document.getElementById('stop-gallery-images');
            const emptyState = document.getElementById('stop-gallery-empty');
            container.innerHTML = '';
            if (!images || !images.length) {
                emptyState.style.display = 'flex';
                container.style.display = 'none';
            } else {
                emptyState.style.display = 'none';
                container.style.display = 'flex';
                images.forEach(src => {
                    const a = document.createElement('a');
                    a.href = src;
                    a.target = '_blank';
                    a.className = 'block w-40 h-40 rounded-[10px] border border-surface-border/60 overflow-hidden hover:ring-2 hover:ring-primary/40 transition-all duration-200 shrink-0';
                    const img = document.createElement('img');
                    img.src = src;
                    img.className = 'w-full h-full object-cover';
                    img.loading = 'lazy';
                    a.appendChild(img);
                    container.appendChild(a);
                });
            }
            document.getElementById('stop-gallery-modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeStopGallery() {
            document.getElementById('stop-gallery-modal').style.display = 'none';
            document.body.style.overflow = '';
        }

        function openStopMap(stopId, lat, lng) {
            const modal = document.getElementById('stop-map-modal');
            const container = document.getElementById('stop-map-container');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                if (container._leafletMap) {
                    container._leafletMap.remove();
                    container._leafletMap = null;
                }
                const map = L.map(container, {
                    center: [lat, lng],
                    zoom: 15,
                    zoomControl: true,
                });
                container._leafletMap = map;
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap' }).addTo(map);
                L.marker([lat, lng]).addTo(map);
            }, 250);
        }

        function closeStopMap() {
            document.getElementById('stop-map-modal').style.display = 'none';
            document.body.style.overflow = '';
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const pageLang = document.documentElement.lang || 'en';
            const langMap = { 'ar': 'ar', 'en': 'en' };
            const targetLang = langMap[pageLang] || 'en';
            const wrappers = document.querySelectorAll('.comment-wrapper');

            for (const wrapper of wrappers) {
                const original = wrapper.dataset.original;
                if (!original) continue;
                const textEl = wrapper.querySelector('.comment-text');
                const toggle = wrapper.querySelector('.comment-translate-toggle');
                const toggleLabel = toggle?.querySelector('.toggle-label');

                try {
                    const res = await fetch(`https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${targetLang}&dt=t&q=${encodeURIComponent(original)}`);
                    const data = await res.json();
                    const translated = data[0][0][0];
                    const detectedLang = data[2] || 'auto';

                    if (translated && detectedLang !== targetLang) {
                        textEl.textContent = translated;
                        wrapper.dataset.translated = translated;
                        if (toggle) {
                            const labelOriginal = toggle.dataset.labelOriginal || 'Show original';
                            const labelTranslated = toggle.dataset.labelTranslated || 'Show translated';
                            toggle.style.display = 'flex';
                            let showingOriginal = false;
                            toggle.addEventListener('click', function() {
                                showingOriginal = !showingOriginal;
                                if (showingOriginal) {
                                    textEl.textContent = original;
                                    toggleLabel.textContent = labelTranslated;
                                } else {
                                    textEl.textContent = translated;
                                    toggleLabel.textContent = labelOriginal;
                                }
                            });
                        }
                    }
                } catch (e) {
                    // translation failed, keep original
                }
            }
        });
    </script>

    {{-- Stop Gallery Modal --}}
    <div id="stop-gallery-modal" class="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-4" style="display: none;">
        <div class="fixed inset-0 bg-black/70 backdrop-blur-sm" onclick="closeStopGallery()"></div>
        <div class="relative bg-surface-card rounded-[12px] sm:rounded-[16px] border border-surface-border shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-hidden">
            <div class="flex items-center justify-between p-3 sm:p-4 border-b border-surface-border">
                <h3 class="text-sm sm:text-lg font-bold text-text-primary">{{ __('Stop Images') }}</h3>
                <button type="button" onclick="closeStopGallery()" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="p-3 sm:p-4 overflow-y-auto max-h-[calc(90vh-64px)]">
                <div id="stop-gallery-images" class="flex flex-wrap gap-2 sm:gap-3 justify-center"></div>
                <div id="stop-gallery-empty" class="flex flex-col items-center justify-center py-16" style="display: none;">
                    <svg class="w-16 h-16 text-text-muted/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-text-muted/50 text-sm">{{ __('No images added for this stop yet.') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stop Map Modal --}}
    <div id="stop-map-modal" class="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-4" style="display: none;">
        <div class="fixed inset-0 bg-black/70 backdrop-blur-sm" onclick="closeStopMap()"></div>
        <div class="relative bg-surface-card rounded-[12px] sm:rounded-[16px] border border-surface-border shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden">
            <div class="flex items-center justify-between p-3 sm:p-4 border-b border-surface-border">
                <h3 class="text-sm sm:text-lg font-bold text-text-primary">{{ __('Stop Location') }}</h3>
                <button type="button" onclick="closeStopMap()" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="p-3 sm:p-4">
                <div id="stop-map-container" class="w-full rounded-[12px] border border-surface-border" style="height: 400px; max-height: 50vh;"></div>
            </div>
        </div>
    </div>
</x-app-layout>