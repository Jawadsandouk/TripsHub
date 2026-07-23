@props([
    'latInput' => 'latitude',
    'lngInput' => 'longitude',
    'latValue' => '',
    'lngValue' => '',
    'targetId' => '',
    'buttonLabel' => __('Select departure location on map'),
])

<div x-data="mapPicker('{{ $latInput }}', '{{ $lngInput }}', '{{ $latValue }}', '{{ $lngValue }}', '{{ $targetId }}')">
    <input type="hidden" :name="latInputName" x-model="lat">
    <input type="hidden" :name="lngInputName" x-model="lng">

    <button type="button" @click="openModal()" class="btn-outline text-xs px-4 py-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        {{ $buttonLabel }}
    </button>

    <span x-show="selected" class="text-xs text-teal-light ml-2" x-text="`{{ __('Location set') }} (${parseFloat(lat).toFixed(4)}, ${parseFloat(lng).toFixed(4)})`"></span>

    <template x-teleport="body">
        <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="open = false"></div>
            <div class="relative bg-surface-card rounded-[16px] border border-surface-border shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden" @click.outside="open = false">
                <div class="flex items-center justify-between p-4 border-b border-surface-border">
                    <h3 class="text-lg font-bold text-text-primary">{{ __('Select location on map') }}</h3>
                    <button type="button" @click="open = false" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="p-4">
                    <div class="flex gap-2 mb-3">
                        <input type="text" x-model="searchQuery" @keydown.enter="searchLocation()"
                               placeholder="{{ __('Search for a place...') }}"
                               class="input flex-1 text-sm">
                        <button type="button" @click="searchLocation()" class="btn-primary-sm text-xs">
                            {{ __('Search') }}
                        </button>
                    </div>

                    <div class="relative" x-init="initMap()">
                        <div :id="mapId" class="w-full rounded-[12px] border border-surface-border" style="height: 400px;"></div>
                    </div>

                    <div class="mt-3 flex items-center justify-between">
                        <p class="text-xs text-text-muted">
                            <span x-show="lat && lng" x-text="`${parseFloat(lat).toFixed(6)}, ${parseFloat(lng).toFixed(6)}`"></span>
                            <span x-show="!lat || !lng">{{ __('Click on the map to select a location') }}</span>
                        </p>
                        <div class="flex gap-2">
                            <button type="button" @click="open = false" class="btn-ghost text-xs">{{ __('Cancel') }}</button>
                            <button type="button" @click="confirmLocation()" class="btn-primary-sm text-xs" :disabled="!lat || !lng">
                                {{ __('Confirm Location') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

@once
    @push('styles')
    <style>
        .leaflet-container {
            background: #1a1a2e;
            border-radius: 12px;
        }
        .leaflet-control-zoom a {
            background: rgba(30, 30, 50, 0.9) !important;
            color: #e8dec8 !important;
            border-color: rgba(201, 169, 110, 0.2) !important;
        }
        .leaflet-control-zoom a:hover {
            background: rgba(50, 50, 80, 0.9) !important;
        }
        .leaflet-control-attribution {
            background: rgba(30, 30, 50, 0.7) !important;
            color: rgba(232, 222, 200, 0.5) !important;
        }
        .leaflet-control-attribution a {
            color: rgba(201, 169, 110, 0.6) !important;
        }
        .leaflet-control-search {
            display: none !important;
        }
    </style>
    @endpush
@endonce

@once
    @push('scripts')
    <script>
        function mapPicker(latInput, lngInput, latVal, lngVal, targetId) {
            return {
                open: false,
                mapId: 'map-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9),
                latInputName: latInput,
                lngInputName: lngInput,
                lat: latVal || '',
                lng: lngVal || '',
                selected: !!(latVal && lngVal),
                searchQuery: '',
                map: null,
                marker: null,
                initMap() {
                    this.$nextTick(() => {
                        const container = document.getElementById(this.mapId);
                        if (!container) {
                            setTimeout(() => this.initMap(), 100);
                            return;
                        }
                        const defaultLat = this.lat ? parseFloat(this.lat) : 33.5138;
                        const defaultLng = this.lng ? parseFloat(this.lng) : 36.2765;
                        this.map = L.map(this.mapId, {
                            center: [defaultLat, defaultLng],
                            zoom: this.lat ? 14 : 10,
                            zoomControl: true,
                        });
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; OpenStreetMap',
                        }).addTo(this.map);
                        if (this.lat && this.lng) {
                            this.marker = L.marker([parseFloat(this.lat), parseFloat(this.lng)], { draggable: true }).addTo(this.map);
                            this.marker.on('dragend', () => {
                                const pos = this.marker.getLatLng();
                                this.lat = pos.lat.toFixed(7);
                                this.lng = pos.lng.toFixed(7);
                                this.selected = true;
                            });
                        }
                        this.map.on('click', (e) => {
                            this.placeMarker(e.latlng.lat, e.latlng.lng);
                        });
                    });
                },
                placeMarker(lat, lng) {
                    this.lat = lat.toFixed(7);
                    this.lng = lng.toFixed(7);
                    this.selected = true;
                    if (this.marker) {
                        this.marker.setLatLng([lat, lng]);
                    } else {
                        this.marker = L.marker([lat, lng], { draggable: true }).addTo(this.map);
                        this.marker.on('dragend', () => {
                            const pos = this.marker.getLatLng();
                            this.lat = pos.lat.toFixed(7);
                            this.lng = pos.lng.toFixed(7);
                        });
                    }
                },
                searchLocation() {
                    if (!this.searchQuery.trim()) return;
                    const q = encodeURIComponent(this.searchQuery.trim());
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${q}&limit=5`)
                        .then(r => r.json())
                        .then(data => {
                            if (data.length > 0) {
                                const loc = data[0];
                                const lat = parseFloat(loc.lat);
                                const lng = parseFloat(loc.lon);
                                this.map.setView([lat, lng], 15);
                                this.placeMarker(lat, lng);
                            } else {
                                alert('{{ __('No location found') }}');
                            }
                        })
                        .catch(() => {
                            alert('{{ __('Search failed') }}');
                        });
                },
                openModal() {
                    this.open = true;
                    this.$nextTick(() => {
                        if (this.map) {
                            setTimeout(() => this.map.invalidateSize(), 200);
                        } else {
                            this.initMap();
                        }
                    });
                },
                confirmLocation() {
                    if (this.lat && this.lng) {
                        this.selected = true;
                        this.open = false;
                    }
                },
            };
        }
    </script>
    @endpush
@endonce
