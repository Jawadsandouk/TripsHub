<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('office.trips.index') }}" class="btn-ghost-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Create Multi-Stop Tour') }}</h2>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-3xl mx-auto">
            @if ($errors->any())
                <div class="mb-6 p-5 bg-coral/10 border border-coral/15 rounded-[12px] animate-slide-down">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-coral font-medium">{{ __('Please fix the following errors') }}</span>
                    </div>
                    <ul class="space-y-1 ml-7 list-disc text-coral/80 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card p-8 entrance" x-data="multiStopForm()"
                 @location-confirmed.window="if ($event.detail.target === 'stop') { stops[$event.detail.index].lat = $event.detail.lat; stops[$event.detail.index].lng = $event.detail.lng; }">
                <form action="{{ route('trips.store.multi') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <div class="flex gap-1 border-b border-surface-border">
                            <button type="button" onclick="switchTab('ar')" id="tab-ar" class="px-6 py-3 text-sm font-medium border-b-2 text-primary-light border-primary transition-all duration-300">عربي</button>
                            <button type="button" onclick="switchTab('en')" id="tab-en" class="px-6 py-3 text-sm font-medium text-text-muted border-b-2 border-transparent hover:text-text-primary transition-all duration-300">English</button>
                        </div>
                        <p class="text-xs text-text-muted mt-3">{{ __('Fill in the trip information in both Arabic and English. When done with one language, switch to the other.') }}</p>
                    </div>

                    <div id="tab-content-ar" class="lang-content space-y-5">
                        <div class="input-group">
                            <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Place Name (Arabic)') }} <span class="text-coral">*</span></label>
                            <input type="text" name="place_name_ar" class="input pt-6 pb-2" required>
                        </div>
                        <div class="input-group">
                            <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Meeting Point (Arabic)') }} <span class="text-coral">*</span></label>
                            <input type="text" name="meeting_point_ar" class="input pt-6 pb-2" required>
                        </div>
                        <div class="input-group">
                            <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Description (Arabic)') }} <span class="text-coral">*</span></label>
                            <textarea name="description_ar" rows="3" class="input pt-6 pb-2" required></textarea>
                        </div>
                    </div>

                    <div id="tab-content-en" class="lang-content hidden space-y-5">
                        <div class="input-group">
                            <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Place Name (English)') }} <span class="text-coral">*</span></label>
                            <input type="text" name="place_name_en" class="input pt-6 pb-2" required>
                        </div>
                        <div class="input-group">
                            <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Meeting Point (English)') }} <span class="text-coral">*</span></label>
                            <input type="text" name="meeting_point_en" class="input pt-6 pb-2" required>
                        </div>
                        <div class="input-group">
                            <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Description (English)') }} <span class="text-coral">*</span></label>
                            <textarea name="description_en" rows="3" class="input pt-6 pb-2" required></textarea>
                        </div>
                    </div>

                    <div class="divider my-8"></div>

                    <div class="space-y-5">
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div class="flex flex-col gap-5">
                                <div class="input-group">
                                    <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Available Seats') }} <span class="text-coral">*</span></label>
                                    <input type="number" name="available_seats" class="input pt-6 pb-2" required>
                                </div>
                                <div class="input-group">
                                    <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Seat Price') }} <span class="text-coral">*</span></label>
                                    <input type="number" step="0.01" name="seat_price" class="input pt-6 pb-2" required>
                                </div>
                                <div class="input-group">
                                    <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Office Discount (%)') }}</label>
                                    <input type="number" step="0.01" name="office_discount" class="input pt-6 pb-2" placeholder="0.00">
                                </div>
                                <div class="input-group">
                                    <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Duration') }} <span class="text-coral">*</span></label>
                                    <div class="flex gap-2 items-center pt-6 pb-2">
                                        <input type="number" id="duration-value" value="1" class="input !pt-0 !pb-0 flex-1" step="0.5" min="0.5" max="10" required
                                               oninput="syncDuration()">
                                        <select id="duration-unit" class="input !pt-0 !pb-0 w-28" onchange="updateDurationMax(); syncDuration()">
                                            <option value="Days">{{ __('Days') }}</option>
                                            <option value="Hours">{{ __('Hours') }}</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="duration" id="duration" value="1 Days">
                                </div>
                                <div class="input-group">
                                    <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Departure Time') }} <span class="text-coral">*</span></label>
                                    <input type="datetime-local" name="departure_time" class="input pt-6 pb-2" required>
                                </div>
                            </div>
                            <div class="flex flex-col gap-5">
                                <div class="input-group">
                                    <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Trip Type') }} <span class="text-coral">*</span></label>
                                    <select name="trip_type" class="input pt-6 pb-2" required>
                                        <option value="">{{ __('Select type') }}</option>
                                        <option value="religious">{{ __('Religious') }}</option>
                                        <option value="historical">{{ __('Historical') }}</option>
                                        <option value="archaeological">{{ __('Archaeological') }}</option>
                                        <option value="recreational">{{ __('Recreational') }}</option>
                                        <option value="adventure">{{ __('Adventure') }}</option>
                                        <option value="shopping">{{ __('Shopping') }}</option>
                                        <option value="cultural">{{ __('Cultural') }}</option>
                                        <option value="food">{{ __('Food Tour') }}</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Area Serviced') }} <span class="text-coral">*</span></label>
                                    <select name="area_serviced" class="input pt-6 pb-2" required>
                                        <option value="Serviced">{{ __('Serviced') }}</option>
                                        <option value="Not Serviced">{{ __('Not Serviced') }}</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Food Policy') }} <span class="text-coral">*</span></label>
                                    <select name="food_policy" class="input pt-6 pb-2" required>
                                        <option value="Allowed">{{ __('Allowed') }}</option>
                                        <option value="Not Allowed">{{ __('Not Allowed') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs text-text-muted mb-2">{{ __('Image') }} <span class="text-coral">*</span></label>
                            <div class="relative">
                                <input type="file" name="image" id="image-input" class="hidden" required onchange="document.getElementById('file-name').textContent = this.files[0]?.name || '{{ __('Choose File') }}'">
                                <label for="image-input" class="input pt-2 pb-2 flex items-center justify-between cursor-pointer">
                                    <span id="file-name" class="text-text-muted">{{ __('Choose File') }}</span>
                                    <svg class="w-5 h-5 text-text-muted shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs text-text-muted mb-2">{{ __('Additional Images') }} <span class="text-text-muted/50">({{ __('up to 5, 3MB max each') }})</span></label>
                            <div class="relative">
                                <input type="file" name="sub_images[]" id="sub-images-input" class="hidden" multiple accept="image/*" onchange="document.getElementById('sub-file-count').textContent = this.files.length + ' {{ __('file(s) selected') }}'">
                                <label for="sub-images-input" class="input pt-2 pb-2 flex items-center justify-between cursor-pointer">
                                    <span id="sub-file-count" class="text-text-muted">{{ __('Choose Files') }}</span>
                                    <svg class="w-5 h-5 text-text-muted shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs text-text-muted mb-2">{{ __('Trip Location') }}</label>
                            <x-map-picker />
                        </div>
                    </div>

                    {{-- Stops section --}}
                    <div class="divider my-8"></div>
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-text-primary">{{ __('Tour Stops') }}</h3>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1 bg-primary/50 rounded-pill p-0.5">
                                    <button type="button" @click="stopLang = 'ar'"
                                            :class="stopLang === 'ar' ? 'bg-primary/15 text-primary-light' : 'text-text-muted hover:text-text-primary'"
                                            class="px-2.5 py-1 text-xs font-medium rounded-pill transition-all duration-200">عربي</button>
                                    <button type="button" @click="stopLang = 'en'"
                                            :class="stopLang === 'en' ? 'bg-primary/15 text-primary-light' : 'text-text-muted hover:text-text-primary'"
                                            class="px-2.5 py-1 text-xs font-medium rounded-pill transition-all duration-200">English</button>
                                </div>
                                <button type="button" @click="addStop()" class="btn-primary-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    {{ __('Add Stop') }}
                                </button>
                            </div>
                        </div>
                        <p class="text-xs text-text-muted mb-4">{{ __('Add the places this tour will visit in order') }}</p>

                        <template x-for="(stop, index) in stops" :key="index">
                            <div class="card p-5 mb-4 border border-surface-border/60">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-sm font-bold text-text-primary" x-text="`${'{{ __('Stop') }}'} ${index + 1}`"></h4>
                                    <button type="button" @click="removeStop(index)" class="text-coral hover:text-coral-light transition-colors duration-200" x-show="stops.length > 1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>

                                <div class="grid sm:grid-cols-2 gap-4">
                                    <div class="input-group sm:col-span-2">
                                        <label class="text-xs text-text-muted absolute left-4 top-2" x-show="stopLang === 'ar'">{{ __('Place Name (Arabic)') }} <span class="text-coral">*</span></label>
                                        <label class="text-xs text-text-muted absolute left-4 top-2" x-show="stopLang === 'en'">{{ __('Place Name (English)') }} <span class="text-coral">*</span></label>
                                        <div x-show="stopLang === 'ar'">
                                            <input type="text" :name="`stops[${index}][place_name_ar]`" class="input pt-6 pb-2" required>
                                        </div>
                                        <div x-show="stopLang === 'en'">
                                            <input type="text" :name="`stops[${index}][place_name_en]`" class="input pt-6 pb-2" required>
                                        </div>
                                    </div>
                                    <div class="input-group sm:col-span-2">
                                        <label class="text-xs text-text-muted absolute left-4 top-2" x-show="stopLang === 'ar'">{{ __('Description (Arabic)') }}</label>
                                        <label class="text-xs text-text-muted absolute left-4 top-2" x-show="stopLang === 'en'">{{ __('Description (English)') }}</label>
                                        <div x-show="stopLang === 'ar'">
                                            <textarea :name="`stops[${index}][description_ar]`" rows="2" class="input pt-6 pb-2"></textarea>
                                        </div>
                                        <div x-show="stopLang === 'en'">
                                            <textarea :name="`stops[${index}][description_en]`" rows="2" class="input pt-6 pb-2"></textarea>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Stop Duration') }} <span class="text-coral">*</span></label>
                                        <div class="flex items-center gap-2 pt-6 pb-1">
                                            <button type="button" @click="stop.duration = Math.max(0.25, (parseFloat(stop.duration) || 0.25) - 0.25)"
                                                    class="w-8 h-8 rounded-full bg-primary/60 hover:bg-primary text-text-primary flex items-center justify-center transition-all duration-200 text-lg font-bold">−</button>
                                            <span class="text-sm font-bold w-16 text-center" x-text="(parseFloat(stop.duration) || 0.25).toFixed(2)"></span>
                                            <button type="button" @click="stop.duration = Math.min(6, (parseFloat(stop.duration) || 0.25) + 0.25)"
                                                    class="w-8 h-8 rounded-full bg-primary/60 hover:bg-primary text-text-primary flex items-center justify-center transition-all duration-200 text-lg font-bold">+</button>
                                            <span class="text-xs text-text-muted">{{ __('hour') }}</span>
                                        </div>
                                        <input type="hidden" :name="`stops[${index}][stop_duration]`" :value="(parseFloat(stop.duration) || 0.25).toFixed(2)">
                                    </div>
                                    <div class="input-group">
                                        <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Image') }}</label>
                                        <input type="file" :name="`stops[${index}][image]`" class="input pt-6 pb-2" accept="image/*">
                                    </div>
                                    <div class="input-group">
                                        <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Additional Stop Images') }} <span class="text-text-muted/50">({{ __('up to 5') }})</span></label>
                                        <input type="file" :name="`stops[${index}][sub_images][]`" class="input pt-6 pb-2" multiple accept="image/*">
                                    </div>
                                    <div class="input-group sm:col-span-2 flex items-end">
                                        <button type="button" @click="openStopMap(index)" class="btn-outline text-xs px-4 py-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ __('Select stop location on map') }}
                                        </button>
                                        <span x-show="stop.lat && stop.lng" class="text-xs text-teal-light ml-2" x-text="`{{ __('Location set') }} (${parseFloat(stop.lat).toFixed(4)}, ${parseFloat(stop.lng).toFixed(4)})`"></span>
                                    </div>
                                </div>

                                <input type="hidden" :name="`stops[${index}][latitude]`" :value="stop.lat || ''">
                                <input type="hidden" :name="`stops[${index}][longitude]`" :value="stop.lng || ''">
                                <input type="hidden" :name="`stops[${index}][stop_order]`" :value="index + 1">
                            </div>
                        </template>

                        <div x-show="stops.length === 0" class="card p-10 text-center">
                            <div class="w-12 h-12 rounded-full bg-primary/40 flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-text-muted">{{ __('No stops added yet. Click "Add Stop" to begin.') }}</p>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-surface-border flex items-center gap-3">
                        <button type="submit" class="btn-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ __('Create Tour') }}
                        </button>
                        <a href="{{ route('office.trips.index') }}" class="btn-ghost">{{ __('Cancel') }}</a>
                    </div>
                </form>

                {{-- Shared map modal for stops --}}
                <template x-teleport="body">
                    <div x-show="stopMapOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
                        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="stopMapOpen = false"></div>
                        <div class="relative bg-surface-card rounded-[16px] border border-surface-border shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden">
                            <div class="flex items-center justify-between p-4 border-b border-surface-border">
                                <h3 class="text-lg font-bold text-text-primary">{{ __('Select location on map') }}</h3>
                                <button type="button" @click="stopMapOpen = false" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4">
                                <div class="flex gap-2 mb-3">
                                    <input type="text" x-model="stopMapQuery" @keydown.enter="searchStopMap()"
                                           placeholder="{{ __('Search for a place...') }}"
                                           class="input flex-1 text-sm">
                                    <button type="button" @click="searchStopMap()" class="btn-primary-sm text-xs">{{ __('Search') }}</button>
                                </div>
                                <div class="relative" x-init="initStopMap()">
                                    <div id="stop-map-modal" class="w-full rounded-[12px] border border-surface-border" style="height: 400px;"></div>
                                </div>
                                <div class="mt-3 flex items-center justify-between">
                                    <p class="text-xs text-text-muted">
                                        <span x-show="stopMapLat && stopMapLng" x-text="`${parseFloat(stopMapLat).toFixed(6)}, ${parseFloat(stopMapLng).toFixed(6)}`"></span>
                                        <span x-show="!stopMapLat || !stopMapLng">{{ __('Click on the map to select a location') }}</span>
                                    </p>
                                    <div class="flex gap-2">
                                        <button type="button" @click="stopMapOpen = false" class="btn-ghost text-xs">{{ __('Cancel') }}</button>
                                        <button type="button" @click="confirmStopMap()" class="btn-primary-sm text-xs" :disabled="!stopMapLat || !stopMapLng">
                                            {{ __('Confirm Location') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <script>
        function switchTab(lang) {
            document.querySelectorAll('.lang-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('tab-content-' + lang).classList.remove('hidden');
            document.querySelectorAll('[id^="tab-"]').forEach(btn => {
                if (btn.id === 'tab-' + lang) {
                    btn.classList.remove('text-text-muted', 'border-transparent');
                    btn.classList.add('text-primary-light', 'border-primary');
                } else {
                    btn.classList.remove('text-primary-light', 'border-primary');
                    btn.classList.add('text-text-muted', 'border-transparent');
                }
            });
        }

        function updateDurationMax() {
            const unit = document.getElementById('duration-unit');
            const input = document.getElementById('duration-value');
            if (!unit || !input) return;
            input.max = unit.value === 'Days' ? '10' : '23.5';
            if (parseFloat(input.value) > parseFloat(input.max)) input.value = input.max;
            syncDuration();
        }

        function syncDuration() {
            const input = document.getElementById('duration-value');
            const unit = document.getElementById('duration-unit');
            const hidden = document.getElementById('duration');
            if (input && unit && hidden) hidden.value = input.value + ' ' + unit.value;
        }

        function multiStopForm() {
            return {
                stops: (function() {
                    try {
                        var s = sessionStorage.getItem('savedAlpineStops');
                        return s ? JSON.parse(s) : [];
                    } catch(e) { return []; }
                })(),
                stopLang: (function() {
                    try {
                        var s = sessionStorage.getItem('savedAlpineStopLang');
                        return s || 'ar';
                    } catch(e) { return 'ar'; }
                })(),
                addStop() {
                    this.stops.push({ duration: 0.25, lat: '', lng: '' });
                },
                removeStop(index) {
                    this.stops.splice(index, 1);
                },
                stopMapOpen: false,
                stopMapTarget: -1,
                stopMapQuery: '',
                stopMapLat: '',
                stopMapLng: '',
                stopMap: null,
                stopMapMarker: null,
                openStopMap(index) {
                    this.stopMapTarget = index;
                    this.stopMapLat = this.stops[index].lat || '';
                    this.stopMapLng = this.stops[index].lng || '';
                    this.stopMapOpen = true;
                    this.$nextTick(() => { setTimeout(() => { if (this.stopMap) this.stopMap.invalidateSize(); else this.initStopMap(); }, 250); });
                },
                initStopMap() {
                    this.$nextTick(() => {
                        var el = document.getElementById('stop-map-modal');
                        if (!el) { setTimeout(() => this.initStopMap(), 100); return; }
                        var lat = this.stopMapLat ? parseFloat(this.stopMapLat) : 33.5138;
                        var lng = this.stopMapLng ? parseFloat(this.stopMapLng) : 36.2765;
                        if (this.stopMap) { this.stopMap.remove(); }
                        this.stopMap = L.map('stop-map-modal', { center: [lat, lng], zoom: this.stopMapLat ? 14 : 10, zoomControl: true });
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap' }).addTo(this.stopMap);
                        if (this.stopMapLat && this.stopMapLng) {
                            this.stopMapMarker = L.marker([parseFloat(this.stopMapLat), parseFloat(this.stopMapLng)], { draggable: true }).addTo(this.stopMap);
                            this.stopMapMarker.on('dragend', () => {
                                var p = this.stopMapMarker.getLatLng();
                                this.stopMapLat = p.lat.toFixed(7);
                                this.stopMapLng = p.lng.toFixed(7);
                            });
                        }
                        this.stopMap.on('click', (e) => {
                            this.placeStopMarker(e.latlng.lat, e.latlng.lng);
                        });
                    });
                },
                placeStopMarker(lat, lng) {
                    this.stopMapLat = lat.toFixed(7);
                    this.stopMapLng = lng.toFixed(7);
                    if (this.stopMapMarker) {
                        this.stopMapMarker.setLatLng([lat, lng]);
                    } else {
                        this.stopMapMarker = L.marker([lat, lng], { draggable: true }).addTo(this.stopMap);
                        this.stopMapMarker.on('dragend', () => {
                            var p = this.stopMapMarker.getLatLng();
                            this.stopMapLat = p.lat.toFixed(7);
                            this.stopMapLng = p.lng.toFixed(7);
                        });
                    }
                },
                searchStopMap() {
                    if (!this.stopMapQuery.trim()) return;
                    fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(this.stopMapQuery.trim()) + '&limit=5')
                        .then(r => r.json()).then(data => {
                            if (data.length > 0) {
                                var loc = data[0];
                                var lat = parseFloat(loc.lat), lng = parseFloat(loc.lon);
                                this.stopMap.setView([lat, lng], 15);
                                this.placeStopMarker(lat, lng);
                            } else { alert('{{ __('No location found') }}'); }
                        }).catch(() => { alert('{{ __('Search failed') }}'); });
                },
                confirmStopMap() {
                    if (this.stopMapLat && this.stopMapLng && this.stopMapTarget >= 0) {
                        this.stops[this.stopMapTarget].lat = this.stopMapLat;
                        this.stops[this.stopMapTarget].lng = this.stopMapLng;
                        this.stopMapOpen = false;
                    }
                },
            }
        }
    </script>
</x-app-layout>
