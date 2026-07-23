<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <button type="button" onclick="goBack()" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </button>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Profile') }}</h2>
        </div>
    </x-slot>

    @php $role = auth()->user()->role; @endphp

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto space-y-8 entrance">

            @if($role === 'office')
            {{-- Office Profile Display (read-only with one-time phone add) --}}
            <div class="card p-8">
                <div class="max-w-xl">
                    <section class="entrance stagger-1">
                        <header>
                            <h2 class="text-xl font-bold text-text-primary">
                                {{ __('Office Information') }}
                            </h2>
                        </header>

                        <div class="mt-6 space-y-6">
                            <div>
                                <x-input-label :value="__('Office Name')" />
                                <p class="mt-2 text-text-primary font-medium">{{ $user->name }}</p>
                            </div>

                            <div>
                                <x-input-label :value="__('Email')" />
                                <p class="mt-2 text-text-primary">{{ $user->email }}</p>
                            </div>

                            <hr class="border-surface-border">

                            <p class="text-sm font-medium text-text-primary">{{ __('Phone Numbers') }}</p>

                            @php
                                $num1 = $user->num1;
                                $num2 = $user->num2;
                                $hasEmptyPhone = empty($num1) || empty($num2);
                            @endphp

                            <div class="grid sm:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label :value="__('Num1')" />
                                    @if(empty($num1))
                                        <p class="mt-2 text-text-muted italic">{{ __('Not set') }}</p>
                                    @else
                                        <p class="mt-2 text-text-primary">{{ $num1 }}</p>
                                    @endif
                                </div>
                                <div>
                                    <x-input-label :value="__('Num2')" />
                                    @if(empty($num2))
                                        <p class="mt-2 text-text-muted italic">{{ __('Not set') }}</p>
                                    @else
                                        <p class="mt-2 text-text-primary">{{ $num2 }}</p>
                                    @endif
                                </div>
                            </div>

                            @if($hasEmptyPhone)
                            <hr class="border-surface-border">

                            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                                @csrf
                                @method('patch')

                                <p class="text-sm font-medium text-text-primary">{{ __('Add a phone number') }}</p>
                                <p class="text-xs text-text-secondary">{{ __('You can only add a number once — it cannot be edited or removed later.') }}</p>

                                <input type="hidden" name="name" value="{{ $user->name }}">
                                <input type="hidden" name="email" value="{{ $user->email }}">

                                <div class="grid sm:grid-cols-2 gap-4">
                                    @if(empty($num1))
                                    <div>
                                        <x-input-label for="num1" :value="__('Num1')" />
                                        <x-text-input id="num1" name="num1" type="text" class="mt-2 block w-full" placeholder="09XX XXX XXX" maxlength="10" />
                                        <x-input-error class="mt-2" :messages="$errors->get('num1')" />
                                    </div>
                                    @endif
                                    @if(empty($num2))
                                    <div>
                                        <x-input-label for="num2" :value="__('Num2')" />
                                        <x-text-input id="num2" name="num2" type="text" class="mt-2 block w-full" placeholder="09XX XXX XXX" maxlength="10" />
                                        <x-input-error class="mt-2" :messages="$errors->get('num2')" />
                                    </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-4">
                                    <button type="submit" class="btn-primary-sm">{{ __('Save') }}</button>
                                    @if (session('status') === 'profile-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-400">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                            @endif
                        </div>
                    </section>
                </div>
            </div>

            {{-- No password card for offices --}}

            @else
            <div class="card p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            @endif

            @if($role === 'office')
            {{-- Deletion Request card for offices --}}
            <div class="card p-8 entrance">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-xl font-bold text-text-primary">
                                {{ __('Delete Account') }}
                            </h2>
                            <p class="mt-1 text-sm text-text-secondary">
                                {{ __('If you want to delete your office account, submit a deletion request. An administrator will review and process it.') }}
                            </p>
                        </header>

                        @php
                            $pendingRequest = \App\Models\OfficeDeletionRequest::where('user_id', auth()->id())->where('status', 'pending')->first();
                        @endphp

                        @if($pendingRequest)
                            <div class="p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-[12px]">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-yellow-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-yellow-300">{{ __('Deletion request pending') }}</p>
                                        <p class="text-xs text-yellow-200/60 mt-0.5">{{ __('Your request is being reviewed by an administrator.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <form method="POST" action="{{ route('profile.deletion.request') }}">
                                @csrf
                                <p class="text-sm text-text-muted mb-4">{{ __('Once your account is deleted, all office data including trips and bookings will be permanently removed. This action cannot be undone.') }}</p>
                                <button type="submit" class="btn-danger"
                                        onclick="return confirm('{{ __('Are you sure you want to request account deletion? This will notify the administrators.') }}')">
                                    {{ __('Request Account Deletion') }}
                                </button>
                                @if (session('status') === 'deletion-requested')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)" class="mt-3 text-sm text-green-400">
                                        {{ __('Your deletion request has been submitted. An administrator will review it shortly.') }}
                                    </p>
                                @endif
                            </form>
                        @endif
                    </section>
                </div>
            </div>
            @else
            <div class="card p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>