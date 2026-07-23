<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Office Deletion Requests') }}</h2>
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
                @if($requests->count() > 0)
                    <div class="table-responsive-wrapper">
                        <table class="table-premium">
                        <thead>
                            <tr>
                                <th>{{ __('Office Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone 1') }}</th>
                                <th>{{ __('Phone 2') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $req)
                                <tr>
                                    <td class="text-text-primary font-medium">{{ $req->office_name }}</td>
                                    <td class="text-text-muted">{{ $req->email }}</td>
                                    <td class="text-text-muted font-mono">{{ $req->num1 ?? '—' }}</td>
                                    <td class="text-text-muted font-mono">{{ $req->num2 ?? '—' }}</td>
                                    <td class="text-text-muted text-sm">{{ $req->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @switch($req->status)
                                            @case('pending')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-500/15 text-yellow-300 border border-yellow-500/25">
                                                    {{ __('Pending') }}
                                                </span>
                                            @break
                                            @case('approved')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/15 text-emerald-300 border border-emerald-500/25">
                                                    {{ __('Approved') }}
                                                </span>
                                            @break
                                            @case('rejected')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-coral/15 text-coral border border-coral/25">
                                                    {{ __('Rejected') }}
                                                </span>
                                            @break
                                            @default
                                                <span class="text-text-muted text-sm">{{ $req->status }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($req->status === 'pending')
                                        <div class="flex gap-2">
                                            @php
                                                $approveData = [
                                                    'action' => route('owner.deletion.requests.approve', $req),
                                                    'method' => 'PATCH',
                                                    'title' => __('Delete Office Account'),
                                                    'message' => __('Are you sure you want to permanently delete this office account? All trips and bookings will be removed. This action cannot be undone.'),
                                                    'confirmText' => 'TripsHub',
                                                    'buttonText' => __('Approve & Delete'),
                                                    'buttonClass' => 'bg-emerald-500',
                                                ];
                                                $rejectData = [
                                                    'action' => route('owner.deletion.requests.reject', $req),
                                                    'method' => 'PATCH',
                                                    'title' => __('Reject Deletion Request'),
                                                    'message' => __('Reject this office deletion request? The office will be notified.'),
                                                    'confirmText' => 'TripsHub',
                                                    'buttonText' => __('Reject'),
                                                    'buttonClass' => 'bg-coral',
                                                ];
                                            @endphp
                                            <button type="button"
                                                    onclick='return openConfirmModal(@json($approveData))'
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-emerald-500/15 text-emerald-300 border border-emerald-500/25 hover:bg-emerald-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                {{ __('Approve & Delete') }}
                                            </button>
                                            <button type="button"
                                                    onclick='return openConfirmModal(@json($rejectData))'
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-coral/15 text-coral border border-coral/25 hover:bg-coral/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                {{ __('Reject') }}
                                            </button>
                                        </div>
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
                    {{ $requests->links() }}
                </div>
                @else
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-text-muted/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    <h3 class="text-lg font-medium text-text-muted mb-2">{{ __('No deletion requests') }}</h3>
                    <p class="text-sm text-text-muted/60">{{ __('Office deletion requests will appear here.') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <x-confirm-modal />
</x-app-layout>
