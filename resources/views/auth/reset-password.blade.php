<x-guest-layout>
    <div class="text-center mb-8">
        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-accent-purple/20 to-primary/10 flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-text-primary">{{ __('Reset password') }}</h2>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="space-y-5">
            <div class="input-group">
                <x-input-label for="email" :value="__('Email')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                <x-text-input id="email" class="block w-full input pt-6 pb-2" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="input-group">
                <x-input-label for="password" :value="__('New Password')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                <x-text-input id="password" class="block w-full input pt-6 pb-2" type="password" name="password" required autocomplete="new-password" placeholder="············" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="input-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                <x-text-input id="password_confirmation" class="block w-full input pt-6 pb-2" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="············" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <button type="submit" class="btn-primary w-full mt-8">
            {{ __('Reset password') }}
        </button>
    </form>
</x-guest-layout>