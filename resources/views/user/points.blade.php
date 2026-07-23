<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('user.dashboard') }}" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('My Points') }}</h2>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-4xl mx-auto space-y-6">

            {{-- Points balance card --}}
            <div class="card overflow-hidden entrance">
                <div class="p-8 text-center" style="background: linear-gradient(135deg, rgba(201,169,110,0.08) 0%, rgba(201,169,110,0.02) 100%);">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-gold/20 to-gold-dark/10 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm" style="color: rgba(184, 168, 144, 0.5);">{{ __('Your Points Balance') }}</p>
                    <p class="text-5xl max-sm:text-3xl font-bold mt-2" style="color: #C9A96E;">{{ $totalPoints }}</p>
                    <p class="text-sm mt-1" style="color: rgba(184, 168, 144, 0.5);">{{ __('pts') }}</p>
                </div>
            </div>

            {{-- Info notes --}}
            <div class="card p-6 entrance stagger-1">
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-gold/10 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-text-primary">{{ __('Points are valid for 3 months from the booking date.') }}</p>
                            <p class="text-xs mt-1" style="color: rgba(184, 168, 144, 0.4);">{{ __('After expiry, points will be removed and cannot be recovered.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-teal/10 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-teal-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-text-primary">{{ __('Earn 1 point for every seat you book.') }}</p>
                            <p class="text-xs mt-1" style="color: rgba(184, 168, 144, 0.4);">{{ __('Points are automatically added after successful payment.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-accent-purple/10 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-accent-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-text-primary">{{ __('Redeeming points will be available soon.') }}</p>
                            <p class="text-xs mt-1" style="color: rgba(184, 168, 144, 0.4);">{{ __('Keep earning points to use them for discounts and special offers.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Points history --}}
            <div class="card overflow-hidden entrance stagger-2">
                <div class="p-6 border-b border-surface-border">
                    <h3 class="text-lg font-bold text-text-primary">{{ __('Points History') }}</h3>
                </div>

                @if($transactions->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-14 h-14 rounded-full bg-primary/40 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-text-secondary">{{ __('No points yet. Start booking trips to earn points!') }}</p>
                    </div>
                @else
                    <div class="table-responsive-wrapper">
                        <table class="table-premium">
                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th class="text-right">{{ __('Points') }}</th>
                                    <th class="text-right">{{ __('Expires') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $txn)
                                    <tr>
                                        <td class="text-text-muted text-sm">{{ $txn->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            @if($txn->type === 'earned')
                                                <span class="text-teal-light text-sm">{{ __('Earned from booking') }}</span>
                                            @elseif($txn->type === 'expired')
                                                <span class="text-coral text-sm">{{ __('Expired / Cancelled') }}</span>
                                            @else
                                                <span class="text-text-muted text-sm">{{ $txn->type }}</span>
                                            @endif
                                        </td>
                                        <td class="text-right font-bold" style="color: {{ $txn->points > 0 ? '#4ADE80' : '#E05A5A' }};">
                                            {{ $txn->points > 0 ? '+' : '' }}{{ $txn->points }}
                                        </td>
                                        <td class="text-right text-text-muted text-sm">
                                            @if($txn->type === 'earned' && $txn->expires_at)
                                                {{ $txn->expires_at->format('Y-m-d') }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 border-t border-surface-border">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
