<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('owner.financials') }}" class="btn-ghost-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">
                @if(isset($currentStatus) && $currentStatus === 'completed')
                    {{ __('Completed Transfers') }}
                @else
                    {{ __('Withdrawal Requests') }}
                @endif
            </h2>
        </div>
    </x-slot>

    @if(isset($currentStatus))
    <div class="px-4 sm:px-6 lg:px-8 pt-4">
        <div class="max-w-7xl mx-auto">
            <a href="{{ route('owner.withdrawals') }}" class="inline-flex items-center gap-1.5 text-sm text-teal-light hover:text-teal transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('All Withdrawal Requests') }}
            </a>
        </div>
    </div>
    @endif

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto">

            <div class="card p-5 mb-6 entrance" style="border-top: 4px solid #10B981;">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-[10px] flex items-center justify-center" style="background: rgba(16,185,129,0.15);">
                            <svg class="w-5 h-5" style="color: #10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-text-muted uppercase tracking-wider">{{ __('Total Transferred') }}</p>
                            <p class="text-2xl font-bold" style="color: #10B981;"><span dir="ltr">${{ number_format($totalTransferred, 2) }}</span></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-text-muted">{{ __('completed withdrawals') }}</p>
                        <p class="text-sm font-medium" style="color: #10B981;">{{ \App\Models\WithdrawalRequest::where('status', 'completed')->count() }} {{ __('transfers') }}</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-teal/10 border border-teal/15 rounded-[12px] text-teal-light flex items-center gap-3 animate-slide-down">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card p-5 mb-6 entrance">
                <form method="GET" action="{{ route('owner.withdrawals') }}">
                    <div class="grid sm:grid-cols-2 lg:grid-cols-6 gap-4">
                        <div>
                            <label class="block text-xs text-text-muted uppercase tracking-wider mb-1.5">{{ __('Office') }}</label>
                            <input type="text" name="office_name" value="{{ request('office_name') }}" placeholder="{{ __('Search by office...') }}" class="input">
                        </div>
                        <div>
                            <label class="block text-xs text-text-muted uppercase tracking-wider mb-1.5">{{ __('Payment Method') }}</label>
                            <select name="payment_method" class="input">
                                <option value="">{{ __('All') }}</option>
                                @foreach($methods as $key => $label)
                                    <option value="{{ $key }}" {{ request('payment_method') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs text-text-muted uppercase tracking-wider mb-1.5">{{ __('Details') }}</label>
                            <input type="text" name="payment_details" value="{{ request('payment_details') }}" placeholder="{{ __('Wallet / phone...') }}" class="input">
                        </div>
                        <div>
                            <label class="block text-xs text-text-muted uppercase tracking-wider mb-1.5">{{ __('Status') }}</label>
                            <select name="status" class="input">
                                <option value="">{{ __('All') }}</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>{{ __('Processing') }}</option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>{{ __('Rejected') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs text-text-muted uppercase tracking-wider mb-1.5">{{ __('Date From') }}</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="input">
                        </div>
                        <div>
                            <label class="block text-xs text-text-muted uppercase tracking-wider mb-1.5">{{ __('Date To') }}</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="input">
                        </div>
                    </div>
                    <div class="flex items-center gap-3 mt-4">
                        <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-[8px] text-sm font-medium bg-teal/15 text-teal-light border border-teal/25 hover:bg-teal/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            {{ __('Filter') }}
                        </button>
                        @if(request()->anyFilled(['office_name', 'payment_method', 'payment_details', 'status', 'date_from', 'date_to']))
                            <a href="{{ route('owner.withdrawals') }}" class="btn-secondary text-sm px-4 py-2.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                {{ __('Clear') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="card overflow-hidden entrance">
                @if($withdrawals->count() > 0)
                    <div class="table-responsive-wrapper">
                        <table class="table-premium">
                        <thead>
                            <tr>
                                <th>{{ __('Office') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Details') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawals as $w)
                                <tr>
                                    <td class="text-text-primary font-medium">{{ $w->office->name }}</td>
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
                                    <td>
                                        @if($w->status === 'pending')
                                            <form action="{{ route('owner.withdrawals.process', $w) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-orange-500/15 text-orange-300 border border-orange-500/25 hover:bg-orange-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    {{ __('Start Transfer') }}
                                                </button>
                                            </form>
                                            <form action="{{ route('owner.withdrawals.reject', $w) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-coral/15 text-coral border border-coral/25 hover:bg-coral/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    {{ __('Reject') }}
                                                </button>
                                            </form>
                                        @elseif($w->status === 'processing')
                                            <form action="{{ route('owner.withdrawals.complete', $w) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-emerald-500/15 text-emerald-300 border border-emerald-500/25 hover:bg-emerald-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    {{ __('Transfer Completed') }}
                                                </button>
                                            </form>
                                            <form action="{{ route('owner.withdrawals.reject', $w) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-coral/15 text-coral border border-coral/25 hover:bg-coral/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    {{ __('Reject') }}
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-text-muted text-sm">&mdash;</span>
                                        @endif
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
                    <p class="text-sm text-text-muted/60">{{ __('Withdrawal requests from offices will appear here.') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>