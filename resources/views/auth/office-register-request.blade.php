<x-guest-layout>
    @if(session('success'))
        <div class="mb-6 p-4 bg-teal/10 border border-teal/15 rounded-[12px] text-teal-light flex items-center gap-3 animate-slide-down">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('office.register.request.store') }}">
        @csrf

        <div class="text-center mb-8">
            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-500/20 to-primary/10 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-text-primary">{{ __('Office Registration Request') }}</h2>
            <p class="text-text-secondary text-sm mt-1">
                {{ __('Submit a request to create a new office account') }}
            </p>
        </div>

        <div class="space-y-5">
            <div class="input-group">
                <x-input-label for="office_name" :value="__('Office Name')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                <x-text-input id="office_name" class="block w-full input pt-6 pb-2" type="text" name="office_name" :value="old('office_name')" required placeholder="e.g. Al-Atlat Al shamia" />
                <x-input-error :messages="$errors->get('office_name')" class="mt-2" />
            </div>

            <div class="input-group">
                <x-input-label for="contact_person" :value="__('Contact Person Name')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                <x-text-input id="contact_person" class="block w-full input pt-6 pb-2" type="text" name="contact_person" :value="old('contact_person')" required placeholder="{{ __('Full name') }}" />
                <x-input-error :messages="$errors->get('contact_person')" class="mt-2" />
            </div>

            <div class="input-group">
                <x-input-label for="email" :value="__('Contact Email')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                <x-text-input id="email" class="block w-full input pt-6 pb-2" type="email" name="email" :value="old('email')" required placeholder="office@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <hr class="border-surface-border">

            <p class="text-sm font-medium text-text-primary">{{ __('Phone numbers') }}</p>

            <div class="grid sm:grid-cols-2 gap-4">
                <div class="input-group">
                    <x-input-label for="num1" :value="__('Phone 1')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                    <x-text-input id="num1" class="block w-full input pt-6 pb-2" type="text" name="num1" :value="old('num1')" required placeholder="09XX XXX XXX" maxlength="10" />
                    <x-input-error :messages="$errors->get('num1')" class="mt-2" />
                </div>

                <div class="input-group">
                    <x-input-label for="num2" :value="__('Phone 2')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                    <x-text-input id="num2" class="block w-full input pt-6 pb-2" type="text" name="num2" :value="old('num2')" placeholder="09XX XXX XXX" maxlength="10" />
                    <x-input-error :messages="$errors->get('num2')" class="mt-2" />
                </div>
            </div>

            <hr class="border-surface-border">

            <p class="text-sm font-medium text-text-primary">{{ __('Office Location') }}</p>

            <x-map-picker
                button-label="{{ __('Select office location on map') }}"
            />

            <div class="input-group">
                <x-input-label for="address" :value="__('Address Description')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                <textarea id="address" name="address" class="block w-full input pt-6 pb-2 min-h-[80px]" placeholder="{{ __('Describe the office location...') }}">{{ old('address') }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <hr class="border-surface-border">

            <div class="input-group">
                <x-input-label for="notes" :value="__('Additional Notes')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                <textarea id="notes" name="notes" class="block w-full input pt-6 pb-2 min-h-[80px]" placeholder="{{ __('Any additional information...') }}">{{ old('notes') }}</textarea>
                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
            </div>
        </div>

        <button type="submit" class="btn-primary w-full mt-8">
            {{ __('Submit Request') }}
        </button>

        <div class="mt-6 text-center mb-6">
            <p class="text-sm text-text-muted">
                {{ __('Already have an account?') }}
                <a href="{{ route('login.show', ['role' => 'office']) }}" class="text-primary-light hover:text-white font-medium transition-colors">
                    {{ __('Sign in') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
