<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('owner.dashboard') }}" class="btn-ghost-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Financial Management') }}</h2>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto">

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="card p-6 entrance text-center" style="border-top: 4px solid #3B82F6;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Gross Revenue') }}</p>
                    <p class="text-3xl font-bold mt-2" style="color: #3B82F6;"><span dir="ltr">${{ number_format($grossRevenue, 2) }}</span></p>
                </div>
                <div class="card p-6 entrance stagger-1 text-center" style="border-top: 4px solid #F59E0B;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Commission (10%)') }}</p>
                    <p class="text-3xl font-bold mt-2" style="color: #F59E0B;"><span dir="ltr">${{ number_format($totalCommission, 2) }}</span></p>
                </div>
                <div class="card p-6 entrance stagger-1 text-center" style="border-top: 4px solid #2DD4BF;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Net Revenue (Offices)') }}</p>
                    <p class="text-3xl font-bold mt-2" style="color: #2DD4BF;"><span dir="ltr">${{ number_format($totalRevenue, 2) }}</span></p>
                </div>
                <div class="card p-6 entrance stagger-2 text-center" style="border-top: 4px solid #8B5CF6;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Total Bookings') }}</p>
                    <p class="text-3xl font-bold mt-2" style="color: #8B5CF6;"><span dir="ltr">{{ $totalBookings }}</span></p>
                </div>
                <div class="card p-6 entrance stagger-2 text-center" style="border-top: 4px solid #D4AF37;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Total Offices') }}</p>
                    <p class="text-3xl font-bold mt-2" style="color: #D4AF37;"><span dir="ltr">{{ $totalOffices }}</span></p>
                </div>
                <div class="card p-6 entrance stagger-3 text-center" style="border-top: 4px solid #EC4899;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Total Trips') }}</p>
                    <p class="text-3xl font-bold mt-2" style="color: #EC4899;"><span dir="ltr">{{ $totalTrips }}</span></p>
                </div>

                <a href="{{ route('owner.withdrawals') }}" class="card p-6 entrance stagger-3 text-center block relative hover:scale-[1.02] hover:shadow-lg hover:shadow-black/25 transition-all duration-200 ease-out group" style="border-top: 4px solid #F97316; text-decoration: none;">
                    <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Withdrawal Requests') }}</p>
                    <p class="text-3xl font-bold mt-2" style="color: #F97316;"><span dir="ltr">{{ $pendingWithdrawalsCount }}</span></p>
                    <p class="absolute bottom-2 right-2 text-[10px] text-orange-400/60 group-hover:text-orange-400 flex items-center gap-0.5 transition-colors opacity-0 group-hover:opacity-100">
                        {{ __('Manage') }}
                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </p>
                </a>
            </div>

            <div class="card p-6 mb-8 entrance stagger-2">
                <h3 class="text-lg font-bold text-text-primary mb-4">{{ __('Revenue by Office') }}</h3>
                @if($offices->isEmpty())
                    <p class="text-text-muted text-sm">{{ __('No offices yet.') }}</p>
                @else
                    <div class="table-responsive-wrapper">
                        <table class="table-premium">

                            @php
                                $currentPage = 1;
                            @endphp

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
                                        <td style="color: #F59E0B;" class="font-bold">${{ number_format($stat->commission_amount, 2) }}</td>
                                        <td class="text-teal-light font-bold">${{ number_format($stat->net_revenue, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
