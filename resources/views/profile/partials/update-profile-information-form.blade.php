<section class="entrance stagger-1">
    <header>
        <h2 class="text-xl font-bold text-text-primary">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-text-secondary">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-2 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-2 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4">
                    <p class="text-sm text-text-secondary">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-primary-blue hover:text-primary-hover rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-blue">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if(auth()->user()->role !== 'owner')
        <hr class="border-surface-border my-6">

        <p class="text-sm font-medium text-text-primary mb-4">{{ __('Phone numbers (optional)') }}</p>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="num1" :value="__('Num1')" />
                <x-text-input id="num1" name="num1" type="text" class="mt-2 block w-full" :value="old('num1', $user->num1)" placeholder="09XX XXX XXX" maxlength="10" />
                <x-input-error class="mt-2" :messages="$errors->get('num1')" />
            </div>

            <div>
                <x-input-label for="num2" :value="__('Num2')" />
                <x-text-input id="num2" name="num2" type="text" class="mt-2 block w-full" :value="old('num2', $user->num2)" placeholder="09XX XXX XXX" maxlength="10" />
                <x-input-error class="mt-2" :messages="$errors->get('num2')" />
            </div>
        </div>
        @endif

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary-sm">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>