<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Office Registration Requests') }}</h2>
            <a href="{{ route('owner.export.office-requests') }}" class="btn-primary-sm">
                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                {{ __('Export Excel') }}
            </a>
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
                                <th>{{ __('Contact Person') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Location') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $req)
                                <tr>
                                    <td class="text-text-primary font-medium">{{ $req->office_name }}</td>
                                    <td class="text-text-muted">{{ $req->contact_person }}</td>
                                    <td class="text-text-muted">{{ $req->email }}</td>
                                    <td>
                                        <div class="flex flex-col gap-0.5 text-xs">
                                            <span class="text-text-muted font-mono">{{ $req->num1 }}</span>
                                            @if($req->num2)
                                                <span class="text-text-muted font-mono">{{ $req->num2 }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($req->latitude && $req->longitude)
                                            <a href="https://www.google.com/maps?q={{ $req->latitude }},{{ $req->longitude }}" target="_blank" class="text-tertiary hover:text-white transition-colors text-sm">
                                                {{ number_format((float)$req->latitude, 4) }}, {{ number_format((float)$req->longitude, 4) }}
                                            </a>
                                            @if($req->address)
                                                <div class="text-xs text-text-muted mt-0.5">{{ Str::limit($req->address, 40) }}</div>
                                            @endif
                                        @else
                                            <span class="text-text-muted text-sm">&mdash;</span>
                                        @endif
                                    </td>
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
                                        <button type="button"
                                                onclick='openDetailModal(@json($req))'
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-primary/10 text-primary-light border border-primary/20 hover:bg-primary/20 transition-all duration-200 cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            {{ __('View') }}
                                        </button>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <h3 class="text-lg font-medium text-text-muted mb-2">{{ __('No requests yet') }}</h3>
                    <p class="text-sm text-text-muted/60">{{ __('Office registration requests will appear here.') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div id="detail-modal-overlay" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50 hidden">
        <div class="fixed inset-0 transform transition-all" onclick="hideDetailModal()">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        </div>

        <div class="mb-6 card p-6 overflow-hidden shadow-elevated transform transition-all sm:w-full sm:max-w-lg sm:mx-auto" style="margin-top: 5vh;">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-text-primary" id="detail-modal-title">{{ __('Request Details') }}</h3>
                <button type="button" onclick="hideDetailModal()" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4" id="detail-modal-body">
            </div>

            <div class="mt-6 pt-4 border-t border-surface-border flex gap-3" id="detail-modal-actions">
            </div>
        </div>
    </div>

    <x-confirm-modal confirm-text="Created Office" />

    <script>
        const detailModalState = {};

        function openDetailModal(req) {
            detailModalState.id = req.id;

            const body = document.getElementById('detail-modal-body');
            body.innerHTML = `
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-3 rounded-[10px] bg-white/5">
                        <p class="text-xs text-text-muted mb-1">{{ __('Office Name') }}</p>
                        <p class="text-sm font-medium text-text-primary">${escapeHtml(req.office_name)}</p>
                    </div>
                    <div class="p-3 rounded-[10px] bg-white/5">
                        <p class="text-xs text-text-muted mb-1">{{ __('Contact Person') }}</p>
                        <p class="text-sm font-medium text-text-primary">${escapeHtml(req.contact_person)}</p>
                    </div>
                    <div class="p-3 rounded-[10px] bg-white/5">
                        <p class="text-xs text-text-muted mb-1">{{ __('Contact Email') }}</p>
                        <p class="text-sm font-medium text-text-primary">${escapeHtml(req.email)}</p>
                    </div>
                    <div class="p-3 rounded-[10px] bg-white/5">
                        <p class="text-xs text-text-muted mb-1">{{ __('Phone 1') }}</p>
                        <p class="text-sm font-medium text-text-primary">${escapeHtml(req.num1)}</p>
                    </div>
                    ${req.num2 ? `
                    <div class="p-3 rounded-[10px] bg-white/5">
                        <p class="text-xs text-text-muted mb-1">{{ __('Phone 2') }}</p>
                        <p class="text-sm font-medium text-text-primary">${escapeHtml(req.num2)}</p>
                    </div>
                    ` : ''}
                    ${req.latitude && req.longitude ? `
                    <div class="p-3 rounded-[10px] bg-white/5">
                        <p class="text-xs text-text-muted mb-1">{{ __('Location') }}</p>
                        <a href="https://www.google.com/maps?q=${req.latitude},${req.longitude}" target="_blank" class="text-sm font-medium text-tertiary hover:text-white transition-colors">
                            ${parseFloat(req.latitude).toFixed(4)}, ${parseFloat(req.longitude).toFixed(4)}
                        </a>
                    </div>
                    ` : ''}
                    ${req.address ? `
                    <div class="col-span-2 p-3 rounded-[10px] bg-white/5">
                        <p class="text-xs text-text-muted mb-1">{{ __('Address Description') }}</p>
                        <p class="text-sm text-text-primary">${escapeHtml(req.address)}</p>
                    </div>
                    ` : ''}
                    ${req.notes ? `
                    <div class="col-span-2 p-3 rounded-[10px] bg-white/5">
                        <p class="text-xs text-text-muted mb-1">{{ __('Additional Notes') }}</p>
                        <p class="text-sm text-text-primary">${escapeHtml(req.notes)}</p>
                    </div>
                    ` : ''}
                    <div class="col-span-2 p-3 rounded-[10px] bg-white/5">
                        <p class="text-xs text-text-muted mb-1">{{ __('Submitted at') }}</p>
                        <p class="text-sm font-medium text-text-primary">${formatDateTime(req.created_at)}</p>
                    </div>
                </div>
            `;

            const actions = document.getElementById('detail-modal-actions');
            if (req.status === 'pending') {
                actions.innerHTML = `
                    <button type="button" onclick="hideDetailModal(); approveRequest(${req.id})"
                            class="flex-1 px-4 py-2.5 rounded-[10px] text-sm font-bold text-emerald-400 bg-emerald-500/15 border border-emerald-500/25 hover:bg-emerald-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out">
                        {{ __('Confirm Request') }}
                    </button>
                    <button type="button" onclick="hideDetailModal()"
                            class="flex-1 px-4 py-2.5 rounded-[10px] text-sm font-medium bg-surface hover:bg-surface-hover text-text-secondary transition-all duration-200">
                        {{ __('Cancel') }}
                    </button>
                `;
            } else {
                actions.innerHTML = `
                    <button type="button" onclick="hideDetailModal()"
                            class="flex-1 px-4 py-2.5 rounded-[10px] text-sm font-medium bg-surface hover:bg-surface-hover text-text-secondary transition-all duration-200">
                        {{ __('Close') }}
                    </button>
                `;
            }

            document.getElementById('detail-modal-overlay').classList.remove('hidden');
        }

        function hideDetailModal() {
            document.getElementById('detail-modal-overlay').classList.add('hidden');
        }

        function approveRequest(id) {
            openConfirmModal({
                action: '{{ route('owner.office.requests.approve', ':id') }}'.replace(':id', id),
                method: 'PATCH',
                title: '{{ __('Confirm Request') }}',
                message: '{{ __('Type "Created Office" to confirm this request.') }}',
                confirmText: 'Created Office',
                buttonText: '{{ __('Approve') }}',
                buttonClass: 'bg-emerald-500',
            });
        }

        function formatDateTime(dateStr) {
            const d = new Date(dateStr);
            const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            return d.toLocaleDateString(undefined, options);
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }
    </script>
</x-app-layout>
