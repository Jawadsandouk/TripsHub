<x-app-layout>
    @php
        $message = $exception->getMessage() ?? '';
        $isPaused = str_contains($message, 'paused');
    @endphp
    <div class="min-h-[70vh] flex items-center justify-center px-4">
        <div class="text-center max-w-md">
            @if($isPaused)
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-yellow-500/20 to-amber-500/10 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-text-primary mb-3">{{ __('Your account is paused') }}</h1>
                <p class="text-text-muted mb-8">{{ __('You cannot perform this action while your account is paused. Please contact the owner to unpause your account.') }}</p>
            @else
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-coral/20 to-rose/10 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-text-primary mb-3">403 — {{ __('Access Denied') }}</h1>
                <p class="text-text-muted mb-8">{{ __('You do not have permission to access this page.') }}</p>
            @endif
            <div class="flex items-center justify-center gap-3">
                <a href="{{ url()->previous() }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    {{ __('Go Back') }}
                </a>
                <a href="{{ route('dashboard') }}" class="btn-outline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    {{ __('Dashboard') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
