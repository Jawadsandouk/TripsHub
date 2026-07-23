<x-guest-layout>
    <div class="text-center mb-8">
        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-accent-purple/20 to-primary/10 flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-text-primary">{{ __('Forgot password?') }}</h2>
        <p class="text-text-secondary text-sm mt-2">{{ __('No problem. Just enter your email and we\'ll send you a reset link.') }}</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="input-group">
            <x-input-label for="email" :value="__('Email')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
            <x-text-input id="email" class="block w-full input pt-6 pb-2" type="email" name="email" :value="old('email')" required autofocus placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <button type="submit" class="btn-primary w-full mt-8">
            {{ __('Send reset link') }}
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login.show', ['role' => 'user']) }}" class="text-sm text-text-muted hover:text-primary-light transition-colors">
            ← {{ __('Back to login') }}
        </a>
    </div>
</x-guest-layout>