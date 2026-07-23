<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('All Bookings') }}</h2>
            <a href="{{ route('owner.export.bookings') }}" class="btn-primary-sm">
                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                {{ __('Export Excel') }}
            </a>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto">
            <div class="card overflow-hidden entrance">
                <div class="table-responsive-wrapper">
                    <table class="table-premium">
                        <thead>
                            <tr>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Trip') }}</th>
                                <th>{{ __('Office') }}</th>
                                <th>{{ __('Seats') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th>{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td class="text-text-primary font-medium">{{ $booking->user->name ?? 'N/A' }}</td>
                                    <td class="text-text-muted">{{ $booking->trip->getTranslatedName() ?? 'N/A' }}</td>
                                    <td class="text-text-muted">{{ $booking->trip->user->name ?? 'N/A' }}</td>
                                    <td class="text-text-primary">{{ $booking->number_of_seats }}</td>
                                    <td class="text-primary-light font-bold">${{ number_format($booking->total_price, 2) }}</td>
                                    <td class="text-text-muted text-sm">{{ $booking->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-surface-border">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>