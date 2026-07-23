<x-guest-layout>
    <div class="text-center mb-8">
        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-accent-purple/20 to-primary/10 flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m6 4H6a2 2 0 01-2-2v-6a2 2 0 012-2h12a2 2 0 012 2v6a2 2 0 01-2 2zm-4-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-text-primary">{{ __('Confirm password') }}</h2>
        <p class="text-text-secondary text-sm mt-2">{{ __('This is a secure area. Please confirm your password before continuing.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="input-group">
            <x-input-label for="password" :value="__('Password')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
            <x-text-input id="password" class="block w-full input pt-6 pb-2" type="password" name="password" required autocomplete="current-password" placeholder="············" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <button type="submit" class="btn-primary w-full mt-8">
            {{ __('Confirm') }}
        </button>
    </form>
</x-guest-layout>