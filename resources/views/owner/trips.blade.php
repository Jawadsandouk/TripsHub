<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Manage Trips') }}</h2>
            <div class="flex gap-3">
                <a href="{{ route('owner.export.trips') }}" class="btn-primary-sm">
                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    {{ __('Export Excel') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto">
            <div class="card overflow-hidden entrance">
                <div class="table-responsive-wrapper">
                    <table class="table-premium">
                        <thead>
                            <tr>
                                <th>{{ __('Place') }}</th>
                                <th>{{ __('Office') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Seats') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Departure') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trips as $trip)
                                <tr>
                                    <td class="text-text-primary font-medium">{{ $trip->getTranslatedName() }}</td>
                                    <td class="text-text-muted">{{ $trip->user->name }}</td>
                                    <td class="text-primary-light font-bold">${{ number_format($trip->seat_price, 2) }}</td>
                                    <td class="text-text-primary">{{ $trip->available_seats }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($trip->status === 'open') badge-success
                                            @elseif($trip->status === 'closed') badge-warning
                                            @elseif($trip->status === 'canceled') badge-danger
                                            @elseif($trip->status === 'paused') badge-paused
                                            @elseif($trip->status === 'finished') badge-primary
                                            @else badge-info @endif capitalize">{{ __($trip->status) }}</span>
                                    </td>
                                    <td class="text-text-muted text-sm">{{ \Carbon\Carbon::parse($trip->departure_time)->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="flex flex-wrap items-center gap-2">
                                            @php
                                                $pauseAction = route('owner.trips.pause', $trip->id);
                                                $cancelAction = route('owner.trips.cancel', $trip->id);
                                                $reopenAction = route('owner.trips.reopen', $trip->id);
                                                $deleteAction = route('owner.trips.destroy', $trip->id);
                                                $pauseData = [
                                                    "action" => $pauseAction, "method" => "PATCH",
                                                    "title" => $trip->status === "paused" ? __("Unpause trip") : __("Pause trip"),
                                                    "message" => $trip->status === "paused" ? __("Are you sure you want to unpause this trip?") : __("Are you sure you want to pause this trip?"),
                                                    "confirmText" => "TripsHub",
                                                    "buttonText" => $trip->status === "paused" ? __("Unpause") : __("Pause"),
                                                    "buttonClass" => $trip->status === "paused" ? "bg-emerald-500" : "bg-yellow-500",
                                                ];
                                                $cancelData = ["action" => $cancelAction, "method" => "PATCH", "title" => __("Cancel trip"), "message" => __("Are you sure you want to cancel this trip?"), "confirmText" => "TripsHub", "buttonText" => __("Cancel"), "buttonClass" => "bg-ice"];
                                                $reopenData = ["action" => $reopenAction, "method" => "PATCH", "title" => __("Reopen trip"), "message" => __("Are you sure you want to reopen this trip?"), "confirmText" => "TripsHub", "buttonText" => __("Reopen"), "buttonClass" => "bg-emerald-500"];
                                                $deleteData = ["action" => $deleteAction, "method" => "DELETE", "title" => __("Delete trip"), "message" => __("Are you sure you want to delete this trip? This action cannot be undone."), "confirmText" => "TripsHub", "buttonText" => __("Delete"), "buttonClass" => "bg-coral"];
                                            @endphp

                                            {{-- Pause / Unpause --}}
                                            <button type="button"
                                                onclick='return openConfirmModal(@json($pauseData))'
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium transition-all duration-200 cursor-pointer
                                                    @if($trip->status === 'paused')
                                                        bg-emerald-500/15 text-emerald-400 border border-emerald-500/25 hover:bg-emerald-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95
                                                    @else
                                                        bg-yellow-500/15 text-yellow-400 border border-yellow-500/25 hover:bg-yellow-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95
                                                    @endif">
                                                @if($trip->status === 'paused')
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ __('Unpause') }}
                                                @else
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ __('Pause') }}
                                                @endif
                                            </button>

                                            {{-- Cancel --}}
                                            @if($trip->status === 'open')
                                            <button type="button"
                                                onclick='return openConfirmModal(@json($cancelData))'
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-ice/15 text-ice-light border border-ice/25 hover:bg-ice/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                                                    {{ __('Cancel') }}
                                            </button>
                                            @endif

                                            {{-- Reopen --}}
                                            @if($trip->status === 'canceled')
                                            <button type="button"
                                                onclick='return openConfirmModal(@json($reopenData))'
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-emerald-500/15 text-emerald-400 border border-emerald-500/25 hover:bg-emerald-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 cursor-pointer">
                                                    {{ __('Reopen') }}
                                            </button>
                                            @endif

                                            {{-- Delete --}}
                                            <button type="button"
                                                onclick='return openConfirmModal(@json($deleteData))'
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-coral/15 text-coral-light border border-coral/25 hover:bg-coral/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                                                    {{ __('Delete') }}
                                            </button>
                                        </div>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-surface-border">
                    {{ $trips->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-confirm-modal />
</x-app-layout>