<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('trips.show', $trip->id) }}" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Payment') }}</h2>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12" x-data="paymentForm()">
        <div class="max-w-6xl mx-auto">
            {{-- Step indicator --}}
            <div class="flex items-center gap-1 sm:gap-2 max-sm:gap-0.5 mb-6 sm:mb-8 entrance-up overflow-x-auto pb-1">
                <div class="flex items-center gap-1 sm:gap-2 text-[11px] sm:text-sm max-sm:text-[10px] shrink-0">
                    <span class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-gold text-navy-950 flex items-center justify-center text-[10px] sm:text-xs font-bold">1</span>
                    <span class="text-text-primary font-medium whitespace-nowrap">{{ __('Select Method') }}</span>
                </div>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-text-muted shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <div class="flex items-center gap-1 sm:gap-2 text-[11px] sm:text-sm max-sm:text-[10px] shrink-0">
                    <span class="w-6 h-6 sm:w-7 sm:h-7 rounded-full flex items-center justify-center text-[10px] sm:text-xs font-bold" :class="method ? 'bg-gold text-navy-950' : 'bg-primary text-text-primary'">2</span>
                    <span class="whitespace-nowrap" :class="method ? 'text-text-primary font-medium' : 'text-text-muted'">{{ __('Enter Details') }}</span>
                </div>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-text-muted shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <div class="flex items-center gap-1 sm:gap-2 text-[11px] sm:text-sm max-sm:text-[10px] shrink-0">
                    <span class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-gold text-navy-950 flex items-center justify-center text-[10px] sm:text-xs font-bold">3</span>
                    <span class="text-text-primary font-medium whitespace-nowrap">{{ __('Confirm') }}</span>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-coral/10 border border-coral/15 rounded-[12px] animate-slide-down">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-coral shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-coral font-medium text-sm">{{ __('Please fix the following errors') }}</span>
                    </div>
                    <ul class="space-y-1 ml-7 list-disc text-coral/80 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="paymentForm" action="{{ route('payment.process') }}" method="POST" class="grid lg:grid-cols-5 gap-8 max-sm:gap-6">
                @csrf
                {{-- Left: Payment form --}}
                <div class="lg:col-span-3 space-y-6 entrance min-w-0">
                    {{-- Method selection --}}
                    <div class="card p-6 max-sm:p-4 max-sm:overflow-hidden">
                        <h3 class="text-lg font-bold text-text-primary mb-4">{{ __('Payment Method') }}</h3>
                        <div class="max-sm:flex max-sm:overflow-x-auto max-sm:gap-2 max-sm:pb-2 grid grid-cols-3 sm:grid-cols-5 gap-2 sm:gap-3">
                            <template x-for="m in methods" :key="m.id">
                                <button type="button" @click="selectMethod(m.id)"
                                    :class="method === m.id ? 'border-gold bg-gold/10' : 'border-surface-border bg-primary/30 hover:border-primary/20'"
                                    class="flex flex-col items-center gap-1.5 p-3 rounded-[10px] border transition-all duration-200 text-center max-sm:flex-shrink-0 max-sm:w-[90px]">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold"
                                         :class="method === m.id ? 'text-gold' : 'text-text-muted'"
                                         x-html="m.icon"></div>
                                    <span class="text-[10px] font-medium leading-tight" :class="method === m.id ? 'text-gold' : 'text-text-muted'" x-text="m.label"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- Credit Card Form (Visa / Mastercard) --}}
                    <div class="card p-6 max-sm:p-4 space-y-6 max-sm:overflow-hidden"
                         x-show="isCard"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         style="display: none;">

                        <div class="perspective-1000 h-[200px] sm:h-[220px] max-sm:h-[160px] max-w-[380px] mx-auto" @mouseleave="flipped = false">
                            <div class="relative w-full h-full transition-transform duration-700 ease-out preserve-3d"
                                 :class="flipped ? 'rotate-y-180' : ''"
                                 style="transform-style: preserve-3d;">
                                <div class="absolute inset-0 rounded-[16px] p-6 max-sm:p-4 flex flex-col justify-between backface-hidden"
                                     style="background: linear-gradient(135deg, #2D2438 0%, #1A1530 50%, #0E0A1A 100%); border: 1px solid rgba(201, 169, 110, 0.15); box-shadow: 0 8px 32px rgba(0,0,0,0.4);">
                                    <div class="flex items-start justify-between">
                                        <div><p class="text-[10px] tracking-[0.2em] uppercase" style="color: rgba(184, 168, 144, 0.5);">{{ __('credit card') }}</p></div>
                                        <div class="flex items-center gap-2">
                                            <template x-if="method === 'visa'"><span class="text-lg font-bold tracking-wider" style="color: #4A8BB7;">VISA</span></template>
                                            <template x-if="method === 'mastercard'"><span class="text-lg font-bold tracking-wider" style="color: #D45A6A;">MC</span></template>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-7 rounded-[4px] flex items-center justify-center" style="background: linear-gradient(135deg, #C9A96E, #D8C18E);">
                                            <div class="w-6 h-4 rounded-[2px] border border-navy-950/20"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xl sm:text-2xl tracking-[0.15em] font-mono text-white" x-text="cardNumber || '•••• •••• •••• ••••'"></p>
                                    </div>
                                    <div class="flex items-end justify-between">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-[9px] tracking-[0.15em] uppercase mb-1" style="color: rgba(184, 168, 144, 0.5);">{{ __('card holder') }}</p>
                                            <p class="text-sm font-medium text-white truncate" x-text="cardholderName || 'Your Name'"></p>
                                        </div>
                                        <div class="text-right shrink-0 ml-4">
                                            <p class="text-[9px] tracking-[0.15em] uppercase mb-1" style="color: rgba(184, 168, 144, 0.5);">{{ __('expires') }}</p>
                                            <p class="text-sm font-medium text-white" x-text="expiry || 'MM/YY'"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute inset-0 rounded-[16px] overflow-hidden backface-hidden rotate-y-180"
                                     style="background: linear-gradient(135deg, #2D2438 0%, #1A1530 50%, #0E0A1A 100%); border: 1px solid rgba(201, 169, 110, 0.15); box-shadow: 0 8px 32px rgba(0,0,0,0.4);">
                                    <div class="h-10 mt-6" style="background: rgba(0,0,0,0.3);"></div>
                                    <div class="mx-6 mt-4 h-8 rounded-[4px] flex items-center justify-end pr-3" style="background: rgba(232, 222, 200, 0.15);">
                                        <span class="text-sm font-mono tracking-widest text-white mr-1" x-text="cvv ? cvv : '•••'"></span>
                                    </div>
                                    <p class="text-[8px] tracking-[0.1em] mt-3 px-6" style="color: rgba(184, 168, 144, 0.3);">{{ __('demo notice') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-3 sm:gap-4 max-sm:gap-2">
                            <div class="sm:col-span-2 input-group">
                                <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Card Number') }}</label>
                                <input type="text" name="card_number" inputmode="numeric"
                                       :value="cardNumber"
                                       @input="cardNumber = formatCardNumber($event.target.value); $el.value = cardNumber"
                                       maxlength="19" placeholder="0000 0000 0000 0000"
                                       class="input pt-6 pb-2 text-lg tracking-wider font-mono">
                            </div>
                            <div class="input-group sm:col-span-2">
                                <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Cardholder Name') }}</label>
                                <input type="text" name="cardholder_name"
                                       :value="cardholderName"
                                       @input="cardholderName = $event.target.value.toUpperCase(); $el.value = cardholderName"
                                       placeholder="JOHN DOE"
                                       class="input pt-6 pb-2 uppercase tracking-wider">
                            </div>
                            <div class="input-group">
                                <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Expiry (MM/YY)') }}</label>
                                <input type="text" name="expiry" inputmode="numeric"
                                       :value="expiry"
                                       @input="expiry = formatExpiry($event.target.value); $el.value = expiry"
                                       maxlength="5" placeholder="MM/YY"
                                       class="input pt-6 pb-2 text-center tracking-wider font-mono">
                            </div>
                            <div class="input-group">
                                <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('CVV') }}</label>
                                <input type="text" name="cvv" inputmode="numeric"
                                       :value="cvv"
                                        @input="cvv = $event.target.value.replace(/\D/g,'').substring(0,3); $el.value = cvv"
                                        @focus="flipped = true" @blur="flipped = false"
                                        maxlength="3" placeholder="•••"
                                       class="input pt-6 pb-2 text-center tracking-wider font-mono">
                            </div>
                        </div>

                        <p class="text-xs" style="color: rgba(184, 168, 144, 0.5);">
                            <svg class="w-3.5 h-3.5 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            {{ __('Your card details are securely encrypted.') }}
                        </p>
                    </div>

                    {{-- Mobile Cash Form (Syriatel / MTN / Sham) --}}
                        <div class="card p-6 max-sm:p-4 space-y-5 max-sm:overflow-hidden"
                             x-show="isMobile"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             style="display: none;">
                        <div class="flex items-center gap-4 pb-4 border-b border-surface-border">
                            <div class="w-14 h-14 max-sm:w-10 max-sm:h-10 rounded-full flex items-center justify-center text-2xl max-sm:text-lg font-bold"
                                 :class="{
                                     'bg-gradient-to-br from-gold/20 to-gold-dark/10 text-gold': method === 'syriatel_cash',
                                     'bg-gradient-to-br from-teal/20 to-teal-dark/10 text-teal-light': method === 'mtn_cash',
                                     'bg-gradient-to-br from-accent-purple/20 to-primary/10 text-accent-purple': method === 'sham_cash'
                                 }">
                                <span x-text="method === 'syriatel_cash' ? 'SC' : method === 'mtn_cash' ? 'CM' : 'SH'"></span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-text-primary" x-text="method === 'syriatel_cash' ? 'Syriatel Cash' : method === 'mtn_cash' ? 'Cash Mobile' : 'Sham Cash'"></h4>
                                <p class="text-sm text-text-muted">{{ __('Pay using your mobile wallet') }}</p>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Mobile Number') }}</label>
                            <input type="tel" name="phone" inputmode="numeric" placeholder="09X XXX XXXX" class="input pt-6 pb-2 tracking-wider" maxlength="10">
                        </div>
                        <div class="input-group">
                            <label class="text-xs text-text-muted absolute left-4 top-2">{{ __('Wallet PIN') }}</label>
                            <input type="password" name="pin" inputmode="numeric" placeholder="••••" maxlength="4" class="input pt-6 pb-2 text-center tracking-wider font-mono">
                        </div>
                        <div class="p-4 rounded-[10px]" style="background: rgba(201, 169, 110, 0.05); border: 1px solid rgba(201, 169, 110, 0.1);">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-gold shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-text-primary mb-1">{{ __('How to pay') }}</p>
                                    <ol class="text-xs text-text-muted space-y-1 list-decimal ml-4">
                                        <li>{{ __('Enter your mobile wallet number') }}</li>
                                        <li>{{ __('Enter your 4-digit wallet PIN') }}</li>
                                        <li>{{ __('You will receive an SMS confirmation') }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Booking summary --}}
                <div class="lg:col-span-2 entrance stagger-2 min-w-0">
                    <div class="card p-6 max-sm:p-4 sticky top-24 max-sm:overflow-hidden">
                        <h3 class="text-lg font-bold text-text-primary mb-5">{{ __('Booking Summary') }}</h3>

                        @if($trip->image)
                            <div class="img-zoom rounded-[10px] overflow-hidden mb-4">
                                <img src="{{ asset('storage/' . $trip->image) }}" class="w-full h-32 max-sm:h-24 object-cover">
                            </div>
                        @endif

                        <div class="space-y-3 text-sm">
                            <div>
                                <p class="text-text-muted text-xs">{{ __('Trip') }}</p>
                                <p class="text-text-primary font-medium">{{ $trip->getTranslatedName() }}</p>
                            </div>
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-text-muted text-xs">{{ __('Office') }}</p>
                                    <p class="text-text-primary">{{ $trip->user->name ?? 'N/A' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-text-muted text-xs">{{ __('Duration') }}</p>
                                    <p class="text-text-primary">{{ $trip->duration }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-text-muted text-xs">{{ __('Departure') }}</p>
                                    <p class="text-text-primary">{{ \Carbon\Carbon::parse($trip->departure_time)->format('M d, Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-text-muted text-xs">{{ __('Seats') }}</p>
                                    <p class="text-text-primary font-bold">{{ $seats }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="divider my-4"></div>

                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-text-muted">{{ __('Price per seat') }}</span>
                                <span class="text-text-primary">${{ number_format($trip->seat_price, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-text-muted">{{ __('Seats') }}</span>
                                <span class="text-text-primary">x {{ $seats }}</span>
                            </div>
                            @php
                                $discountPercent = $trip->getDiscountPercent();
                                $discountAmount = $trip->getDiscountAmount() * $seats;
                                $officeDiscountPercent = $trip->getOfficeDiscountPercent();
                                $officeDiscountAmount = $trip->getPriceAfterOfficeDiscount() * $officeDiscountPercent / 100 * $seats;
                                $finalTotal = $totalPrice - $discountAmount - $officeDiscountAmount;
                            @endphp
                            @if($trip->getTotalDiscountPercent() > 0)
                            <div class="p-3 rounded-[10px]" style="background: rgba(185, 28, 28, 0.08); border: 1px solid rgba(217, 119, 6, 0.15);">
                                @if($discountPercent > 0)
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-text-muted text-xs">{{ __('Discount') }}</span>
                                    <span class="badge" style="background: linear-gradient(135deg, #B91C1C 0%, #D97706 100%); color: #fff; font-weight: 800; font-size: 10px;">-{{ number_format($discountPercent, 0) }}%</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-xs" style="color: rgba(184, 168, 144, 0.6);">{{ __('You save') }}</span>
                                    <span class="text-sm font-bold" style="color: #D97706;">-${{ number_format($discountAmount, 2) }}</span>
                                </div>
                                @endif
                                @if($officeDiscountPercent > 0)
                                <div class="flex justify-between items-center mb-1 mt-1">
                                    <span class="text-text-muted text-xs">{{ __('Office Discount') }}</span>
                                    <span class="badge" style="background: linear-gradient(135deg, #B91C1C 0%, #D97706 100%); color: #fff; font-weight: 800; font-size: 10px;">-{{ number_format($officeDiscountPercent, 1) }}%</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-xs" style="color: rgba(184, 168, 144, 0.6);">{{ __('You save') }}</span>
                                    <span class="text-sm font-bold" style="color: #D97706;">-${{ number_format($officeDiscountAmount, 2) }}</span>
                                </div>
                                @endif
                            </div>
                            @endif
                            <div class="divider my-2"></div>
                            <div class="flex justify-between text-lg">
                                <span class="text-text-primary font-bold">{{ __('Total') }}</span>
                                <span class="font-bold" style="color: #D97706;">${{ number_format($finalTotal, 2) }}</span>
                            </div>
                            @if($trip->getTotalDiscountPercent() > 0)
                            <p class="text-xs text-center mt-2" style="color: rgba(74, 222, 128, 0.75);">
                                <svg class="w-3.5 h-3.5 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ __('You saved :amount on this booking through Trips Hub!', ['amount' => '$' . number_format($discountAmount + $officeDiscountAmount, 2)]) }}
                            </p>
                            @endif

                            {{-- Points earned --}}
                            <div class="mt-4 p-3 rounded-[10px]" style="background: rgba(201, 169, 110, 0.06); border: 1px solid rgba(201, 169, 110, 0.12);">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" style="color: #C9A96E;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs" style="color: rgba(184, 168, 144, 0.6);">{{ __('Points earned') }}</span>
                                    </div>
                                    <span class="text-sm font-bold" style="color: #C9A96E;">+{{ $seats }} {{ __('pts') }}</span>
                                </div>
                                <p class="text-[10px] mt-1" style="color: rgba(184, 168, 144, 0.3);">
                                    {{ __('Valid for 3 months from booking date.') }}
                                </p>
                            </div>
                        </div>

                        <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                        <input type="hidden" name="number_of_seats" value="{{ $seats }}">
                        <input type="hidden" name="payment_method" x-bind:value="method">
                        <input type="hidden" name="ticket_email" x-bind:value="ticketEmail">

                        @php $displayTotal = $finalTotal; @endphp
                        <button type="button" @click="openConfirmModal" class="btn-gold w-full text-base py-4 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Pay') }} ${{ number_format($displayTotal, 2) }}
                        </button>

                        <p class="text-xs text-text-muted text-center mt-3">
                            <svg class="w-3.5 h-3.5 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            {{ __('Secured by SSL encryption') }}
                        </p>
                    </div>
                </div>

            </form>
        </div>

    {{-- Confirmation Modal --}}
    <div x-show="showConfirmModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         style="display: none; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);"
         @click.self="showConfirmModal = false">

        <div x-show="showConfirmModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-[20px]"
             style="background: linear-gradient(180deg, #1C1811 0%, #14110C 100%); border: 1px solid rgba(201, 169, 110, 0.15); box-shadow: 0 24px 80px rgba(0,0,0,0.6);">

             {{-- Modal header --}}
            <div class="flex items-center justify-between px-4 sm:px-6 pt-4 sm:pt-6 pb-4 border-b" style="border-color: rgba(201, 169, 110, 0.1);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gold to-gold-dark flex items-center justify-center">
                        <svg class="w-5 h-5" style="color: #1C1811;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold" style="color: #E8DEC8;">{{ __('Confirm Payment') }}</h3>
                        <p class="text-xs" style="color: rgba(184, 168, 144, 0.6);">{{ __('Review your booking before paying') }}</p>
                    </div>
                </div>
                <button type="button" @click="showConfirmModal = false" class="w-8 h-8 rounded-full flex items-center justify-center transition-all duration-200 hover:bg-white/5" style="color: rgba(184, 168, 144, 0.4);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- E-Ticket design --}}
            <div class="p-4 sm:p-6">
                <div class="rounded-[12px] sm:rounded-[16px] overflow-hidden" style="border: 1px solid rgba(201, 169, 110, 0.12); background: rgba(26, 22, 16, 0.6);">
                    {{-- Ticket top: trip info --}}
                    <div class="p-4 sm:p-5 pb-6 sm:pb-8 relative">
                        {{-- Decorative circles for ticket tear line --}}
                        <div class="absolute bottom-0 left-0 right-0 flex justify-between px-2" style="transform: translateY(50%);">
                            <div class="w-5 h-5 rounded-full" style="background: #14110C;"></div>
                            <div class="w-5 h-5 rounded-full" style="background: #14110C;"></div>
                            <div class="w-5 h-5 rounded-full" style="background: #14110C;"></div>
                            <div class="w-5 h-5 rounded-full" style="background: #14110C;"></div>
                        </div>

                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-[10px] tracking-[0.2em] uppercase" style="color: rgba(184, 168, 144, 0.4);">{{ __('e-ticket') }}</p>
                                <p class="text-xs font-medium text-gold mt-0.5">#<span x-text="'TKH-' + Date.now().toString(36).toUpperCase()"></span></p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-bold tracking-wider" style="color: #C9A96E;">TRIPS HUB</p>
                                <p class="text-[9px]" style="color: rgba(184, 168, 144, 0.4);">{{ __('Damascus') }}</p>
                            </div>
                        </div>

                        {{-- Dashed divider --}}
                        <div class="h-px mb-4" style="border-top: 1px dashed rgba(201, 169, 110, 0.15);"></div>

                        {{-- Trip details --}}
                        <div class="flex gap-4">
                            <div class="flex-1 space-y-3">
                                <div>
                                    <p class="text-xl font-bold" style="color: #E8DEC8;">{{ $trip->getTranslatedName() }}</p>
                                    <p class="text-xs mt-0.5" style="color: rgba(184, 168, 144, 0.5);">{{ $trip->user->name ?? '' }} · {{ $trip->duration }}</p>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <div>
                                        <p class="text-[10px] uppercase tracking-wider" style="color: rgba(184, 168, 144, 0.4);">{{ __('departure') }}</p>
                                        <p class="font-medium" style="color: #E8DEC8;">{{ \Carbon\Carbon::parse($trip->departure_time)->format('M d, Y · H:i') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[10px] uppercase tracking-wider" style="color: rgba(184, 168, 144, 0.4);">{{ __('passenger') }}</p>
                                        <p class="font-medium" style="color: #E8DEC8;">{{ auth()->user()->name }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- QR Code --}}
                            <div class="shrink-0 flex flex-col items-center gap-1">
                                <div class="w-[72px] h-[72px] rounded-[8px] p-1.5 relative overflow-hidden" style="background: rgba(201, 169, 110, 0.08); border: 1px solid rgba(201, 169, 110, 0.12);">
                                    <svg viewBox="0 0 24 24" class="w-full h-full opacity-60">
                                        <rect x="0" y="0" width="8" height="8" rx="1" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="10" y="0" width="4" height="4" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="16" y="0" width="8" height="6" rx="1" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="0" y="10" width="6" height="2" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="8" y="8" width="4" height="6" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="14" y="10" width="6" height="4" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="22" y="10" width="2" height="6" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="0" y="14" width="8" height="4" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="10" y="16" width="2" height="8" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="14" y="16" width="6" height="6" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="22" y="18" width="2" height="4" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="18" y="0" width="2" height="2" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="6" y="6" width="2" height="2" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                        <rect x="12" y="6" width="2" height="2" rx="0.5" fill="rgba(201,169,110,0.5)"/>
                                    </svg>
                                </div>
                                <span class="text-[7px] tracking-widest uppercase" style="color: rgba(184, 168, 144, 0.3);">{{ __('scan') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Dashed divider row --}}
                    <div class="relative px-5">
                        <div class="h-px" style="border-top: 1px dashed rgba(217, 119, 6, 0.2);"></div>
                    </div>

                    {{-- Ticket bottom: price + seats --}}
                    <div class="p-5 pt-6">
                        <div class="flex justify-between items-start">
                            <div class="space-y-2">
                                <div>
                                    <p class="text-[10px] uppercase tracking-wider" style="color: rgba(184, 168, 144, 0.4);">{{ __('seats') }}</p>
                                    <p class="text-lg font-bold" style="color: #E8DEC8;">{{ $seats }} <span class="text-sm font-normal" style="color: rgba(184, 168, 144, 0.5);">× ${{ number_format($trip->seat_price, 2) }}</span></p>
                                    @if($trip->getTotalDiscountPercent() > 0)
                                    <p class="text-xs" style="color: rgba(217, 119, 6, 0.75);">
                                        <svg class="w-3 h-3 inline -mt-0.5 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ __('Discount') }}
                                        @if($discountPercent > 0){{ number_format($discountPercent, 0) }}%@endif
                                        @if($discountPercent > 0 && $officeDiscountPercent > 0)+@endif
                                        @if($officeDiscountPercent > 0){{ number_format($officeDiscountPercent, 1) }}%@endif
                                        — {{ __('save') }} ${{ number_format($discountAmount + $officeDiscountAmount, 2) }}
                                    </p>
                                    @endif
                                </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-wider" style="color: rgba(184, 168, 144, 0.4);">{{ __('payment') }}</p>
                                <p class="text-sm font-medium" style="color: rgba(184, 168, 144, 0.7);" x-text="methodLabel"></p>
                            </div>
                        </div>
                        <div class="mt-4 pt-3" style="border-top: 1px solid rgba(217, 119, 6, 0.12);">
                            <div class="flex items-center justify-between">
                                <span class="text-xs" style="color: rgba(184, 168, 144, 0.5);">
                                    <svg class="w-3 h-3 inline -mt-0.5 mr-1" style="color: #C9A96E;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ __('Points earned') }}
                                </span>
                                <span class="text-sm font-bold" style="color: #C9A96E;">+{{ $seats }} {{ __('pts') }}</span>
                            </div>
                        </div>
                            <div class="text-right">
                                <p class="text-[10px] uppercase tracking-wider" style="color: rgba(184, 168, 144, 0.4);">{{ __('total') }}</p>
                                                    <p class="text-2xl font-bold text-gold">${{ number_format($displayTotal, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Email field for ticket --}}
                <div class="mt-5">
                    <label class="block text-sm font-medium mb-2" style="color: #E8DEC8;">
                        <svg class="w-4 h-4 inline -mt-0.5 mr-1.5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ __('Send ticket to email') }}
                    </label>
                    <div class="input-group">
                        <input type="email" x-model="ticketEmail"
                               placeholder="your@email.com"
                               class="w-full bg-primary/30 text-text-primary text-sm border border-surface-border rounded-[10px] px-4 py-3 transition-all duration-300 focus:outline-none focus:border-gold/30 focus:bg-primary/50 focus:shadow-[0_0_0_3px_rgba(201,169,110,0.06)]">
                    </div>
                    <p class="text-xs mt-1.5" style="color: rgba(184, 168, 144, 0.4);">
                        <svg class="w-3 h-3 inline -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('We will send your ticket and receipt to this email') }}
                    </p>
                </div>
            </div>

            {{-- Modal actions --}}
            <div class="flex gap-2 sm:gap-3 px-4 sm:px-6 pb-4 sm:pb-6 pt-2">
                <button type="button" @click="showConfirmModal = false"
                        class="flex-1 px-3 sm:px-5 py-3 rounded-[12px] text-xs sm:text-sm font-medium transition-all duration-200"
                        style="background: rgba(184, 168, 144, 0.08); color: rgba(184, 168, 144, 0.7); hover:background: rgba(184, 168, 144, 0.12);">
                    {{ __('Cancel') }}
                </button>
                <button type="button" @click="confirmPayment"
                        class="flex-1 px-3 sm:px-5 py-3 rounded-[12px] text-xs sm:text-sm font-bold transition-all duration-200 flex items-center justify-center gap-2"
                        style="background: linear-gradient(135deg, #C9A96E 0%, #D8C18E 100%); color: #1C1811;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ __('Confirm & Pay') }} ${{ number_format($displayTotal, 2) }}
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .perspective-1000 { perspective: 1000px; }
    .preserve-3d { transform-style: preserve-3d; }
    .backface-hidden { backface-visibility: hidden; -webkit-backface-visibility: hidden; }
    .rotate-y-180 { transform: rotateY(180deg); }
    </style>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('paymentForm', () => ({
                method: 'visa',
                cardNumber: '',
                cardholderName: '',
                expiry: '',
                cvv: '',
                flipped: false,
                showConfirmModal: false,
                ticketEmail: '{{ auth()->user()->email }}',
                methods: [
                    { id: 'syriatel_cash', label: 'Syriatel Cash', icon: 'SC' },
                    { id: 'mtn_cash', label: 'Cash Mobile', icon: 'CM' },
                    { id: 'sham_cash', label: 'Sham Cash', icon: 'SH' },
                    { id: 'visa', label: 'Visa', icon: 'V' },
                    { id: 'mastercard', label: 'Mastercard', icon: 'M' },
                ],
                get methodLabel() {
                    const m = this.methods.find(m => m.id === this.method);
                    return m ? m.label : '';
                },
                selectMethod(id) { this.method = id; },
                openConfirmModal() { this.showConfirmModal = true; },
                confirmPayment() {
                    this.showConfirmModal = false;
                    setTimeout(() => {
                        document.getElementById('paymentForm').submit();
                    }, 100);
                },
                formatCardNumber(value) {
                    return value.replace(/\s/g, '').replace(/\D/g, '').replace(/(.{4})/g, '$1 ').trim().substring(0, 19);
                },
                formatExpiry(value) {
                    let v = value.replace(/\D/g, '').substring(0, 4);
                    if (v.length > 0) {
                        let month = parseInt(v.substring(0, 2));
                        if (month > 12) v = '12' + v.substring(2);
                    }
                    if (v.length > 2) v = v.substring(0, 2) + '/' + v.substring(2);
                    return v;
                },
                get isCard() { return ['visa', 'mastercard'].includes(this.method); },
                get isMobile() { return ['syriatel_cash', 'mtn_cash', 'sham_cash'].includes(this.method); }
            }));
        });
    </script>
</x-app-layout>