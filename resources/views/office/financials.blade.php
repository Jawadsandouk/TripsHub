<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('office.dashboard') }}" class="btn-ghost-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Financial Overview') }}</h2>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto">

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="card p-6 entrance" style="border-top: 4px solid #2DD4BF;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Withdrawable Balance') }}</p>
                    <p class="text-3xl font-bold mt-2 text-start" style="color: #2DD4BF;"><span dir="ltr">${{ number_format($withdrawableBalance, 2) }}</span></p>
                    <button type="button" onclick="openWithdrawalModal()" class="mt-3 w-full inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-cyan-500/15 text-cyan-300 border border-cyan-500/25 hover:bg-cyan-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        {{ __('Request Withdrawal') }}
                    </button>
                </div>
                <div class="card p-6 entrance stagger-1" style="border-top: 4px solid #8B5CF6;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Total Bookings') }}</p>
                    <p class="text-3xl font-bold mt-2 text-start" style="color: #8B5CF6;"><span dir="ltr">{{ $totalBookings }}</span></p>
                </div>
                <div class="card p-6 entrance stagger-2" style="border-top: 4px solid #D4AF37;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Avg Booking Value') }}</p>
                    <p class="text-3xl font-bold mt-2 text-start" style="color: #D4AF37;"><span dir="ltr">${{ number_format($avgBookingValue, 2) }}</span></p>
                </div>
                <div class="card p-6 entrance stagger-3" style="border-top: 4px solid #F97316;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Total Trips') }}</p>
                    <p class="text-3xl font-bold mt-2 text-start" style="color: #F97316;"><span dir="ltr">{{ $totalTrips }}</span></p>
                </div>
            </div>

            <div class="card p-6 mb-8 entrance stagger-2">
                <h3 class="text-lg font-bold text-text-primary mb-4">{{ __('Revenue by Trip') }}</h3>
                @if($trips->isEmpty())
                    <p class="text-text-muted text-sm">{{ __('No trips yet.') }}</p>
                @else
                    <div class="table-responsive-wrapper">
                        <table class="table-premium">

                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Notes') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($withdrawals as $w)
                                <tr>
                                    <td>{{ $w->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ number_format($w->amount, 2) }}</td>
                                    <td>
                                        @if($w->status === 'completed')
                                            <span class="badge-success">{{ __('Completed') }}</span>
                                        @elseif($w->status === 'pending')
                                            <span class="badge-warning">{{ __('Pending') }}</span>
                                        @elseif($w->status === 'rejected')
                                            <span class="badge-danger">{{ __('Rejected') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-text-muted text-sm">{{ $w->notes ?? '—' }}</td>
                                </tr>
                            @empty

                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- جدول أرباح الحجوزات --}}
                    <div class="table-responsive-wrapper mt-6">
                        <table class="table-premium">
                            <thead>
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Count') }}</th>
                                    <th>{{ __('Gross Revenue') }}</th>
                                    <th>{{ __('Commission (10%)') }}</th>
                                    <th>{{ __('Net Revenue') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentStats as $stat)
                                    <tr>
                                        <td>
                                            <span class="badge 
                                                @if($stat->payment_status === 'paid') badge-success
                                                @elseif($stat->payment_status === 'failed') badge-danger
                                                @else badge-info @endif capitalize">{{ __($stat->payment_status) }}</span>
                                        </td>
                                        <td class="text-text-primary">{{ $stat->count }}</td>
                                        <td style="color: #3B82F6;" class="font-bold">${{ number_format($stat->gross_revenue, 2) }}</td>
                                        <td style="color: #F97316;" class="font-bold">${{ number_format($stat->commission_amount, 2) }}</td>
                                        <td style="color: #2DD4BF;" class="font-bold">${{ number_format($stat->net_revenue, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- Withdrawal Modal --}}
    <div id="withdrawal-modal-overlay" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50 hidden">
        <div class="fixed inset-0 transform transition-all" onclick="hideWithdrawalModal()">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        </div>

        <div class="mb-6 card p-6 overflow-hidden shadow-elevated transform transition-all sm:w-full sm:max-w-md sm:mx-auto" style="margin-top: 8vh;">
            <div class="text-center mb-6">
                <div class="w-14 h-14 rounded-full bg-cyan-500/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-text-primary">{{ __('Request Withdrawal') }}</h3>
                <p class="text-text-muted text-sm mt-2">{{ __('Submit a withdrawal request to the owner.') }}</p>
            </div>

            <form action="{{ route('office.withdrawals.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-2">{{ __('Amount') }}</label>
                        <input type="number" name="amount" step="0.01" min="0.01" max="{{ $withdrawableBalance }}" required
                               class="input w-full"
                               placeholder="0.00">
                        <p class="text-text-muted text-xs mt-1">{{ __('Max withdrawable') }}: ${{ number_format($withdrawableBalance, 2) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text-primary mb-2">{{ __('Payment Method') }}</label>
                        <select name="payment_method" id="withdrawal-method" required class="input w-full" onchange="toggleWithdrawalDetails()">
                            <option value="">{{ __('Select Method') }}</option>
                            @foreach(\App\Services\Payments\PaymentFactory::methods() as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="withdrawal-wallet-field" class="hidden">
                        <label class="block text-sm font-medium text-text-primary mb-2">{{ __('Wallet Number') }}</label>
                        <input type="text" name="payment_details" inputmode="numeric" maxlength="5" pattern="\d{5}" class="input w-full" placeholder="{{ __('Enter your wallet number') }}">
                        <p class="text-text-muted text-xs mt-1">{{ __('5 digits only') }}</p>
                    </div>
                    <div id="withdrawal-mobile-field" class="hidden">
                        <label class="block text-sm font-medium text-text-primary mb-2">{{ __('Mobile Number') }}</label>
                        <input type="text" name="payment_details" inputmode="numeric" maxlength="10" pattern="\d{10}" class="input w-full" placeholder="{{ __('Enter the mobile number to transfer to') }}">
                        <p class="text-text-muted text-xs mt-1">{{ __('10 digits only') }}</p>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="hideWithdrawalModal()"
                                class="flex-1 px-4 py-2.5 rounded-[10px] text-sm font-medium bg-surface hover:bg-surface-hover text-text-secondary transition-all duration-200">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit"
                                class="flex-1 px-4 py-2.5 rounded-[10px] text-sm font-bold text-white bg-gradient-to-r from-cyan-500 to-cyan-600 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out">
                            {{ __('Submit Request') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openWithdrawalModal() {
        document.getElementById('withdrawal-modal-overlay').classList.remove('hidden');
    }
    function hideWithdrawalModal() {
        document.getElementById('withdrawal-modal-overlay').classList.add('hidden');
    }
    function toggleWithdrawalDetails() {
        var method = document.getElementById('withdrawal-method').value;
        var walletField = document.getElementById('withdrawal-wallet-field');
        var mobileField = document.getElementById('withdrawal-mobile-field');
        var walletInput = walletField.querySelector('input');
        var mobileInput = mobileField.querySelector('input');

        walletField.classList.add('hidden');
        mobileField.classList.add('hidden');
        walletInput.disabled = true;
        walletInput.required = false;
        mobileInput.disabled = true;
        mobileInput.required = false;
        walletInput.value = '';
        mobileInput.value = '';

        if (method === 'syriatel_cash' || method === 'mtn_cash') {
            mobileField.classList.remove('hidden');
            mobileInput.disabled = false;
            mobileInput.required = true;
        } else if (method === 'sham_cash' || method === 'visa' || method === 'mastercard') {
            walletField.classList.remove('hidden');
            walletInput.disabled = false;
            walletInput.required = true;
        }
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') hideWithdrawalModal();
    });
    </script>
</x-app-layout>
