<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('office.financials') }}" class="btn-ghost-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('My Withdrawal Requests') }}</h2>
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

            <div class="card overflow-hidden entrance">
                @if($withdrawals->count() > 0)
                    <div class="table-responsive-wrapper">
                        <table class="table-premium">
                        <thead>
                            <tr>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Details') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawals as $w)
                                <tr>
                                    <td class="text-teal-light font-bold">${{ number_format($w->amount, 2) }}</td>
                                    <td class="text-text-muted">{{ $w->payment_method }}</td>
                                    <td class="text-text-muted text-sm">{{ $w->payment_details ?? '—' }}</td>
                                    <td class="text-text-muted text-sm">{{ $w->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @switch($w->status)
                                            @case('pending')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-500/15 text-yellow-300 border border-yellow-500/25">
                                                    {{ __('Pending') }}
                                                </span>
                                            @break
                                            @case('processing')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/15 text-blue-300 border border-blue-500/25">
                                                    {{ __('Processing') }}
                                                </span>
                                            @break
                                            @case('completed')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-300 border border-emerald-500/25">
                                                    {{ __('Completed') }}
                                                </span>
                                            @break
                                            @case('rejected')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-coral/15 text-coral border border-coral/25">
                                                    {{ __('Rejected') }}
                                                </span>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-surface-border">
                    {{ $withdrawals->links() }}
                </div>
                @else
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-text-muted/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-text-muted mb-2">{{ __('No withdrawal requests') }}</h3>
                    <p class="text-sm text-text-muted/60">{{ __('Your withdrawal requests will appear here.') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>