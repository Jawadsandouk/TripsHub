<x-guest-layout>
    <form method="POST" action="{{ route('register', ['role' => $role]) }}">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        <div class="text-center mb-8">
            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-accent-purple/20 to-primary/10 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-text-primary">{{ __('Create account') }}</h2>
            <p class="text-text-secondary text-sm mt-1">
                {{ __('Register as') }}                 <span class="text-primary-light font-medium capitalize">{{ $role }}</span>
            </p>
        </div>

        <div class="space-y-5">
            <div class="input-group">
                <x-input-label for="name" :value="__('Name')" class="!text-xs !text-text-muted !absolute ltr:!left-4 rtl:!right-4 !top-2" />
                <x-text-input id="name" class="block w-full input pt-6 pb-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="input-group">
                <x-input-label for="email" :value="__('Email')" class="!text-xs !text-text-muted !absolute ltr:!left-4 rtl:!right-4 !top-2" />
                <x-text-input id="email" class="block w-full input pt-6 pb-2" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="input-group">
                <x-input-label for="password" :value="__('Password')" class="!text-xs !text-text-muted !absolute ltr:!left-4 rtl:!right-4 !top-2" />
                <div class="relative">
                    <x-text-input id="password" class="block w-full input pt-6 pb-2 ltr:pr-14 rtl:pl-14"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password"
                                    placeholder="············" />
                    <button id="regPassBtn" type="button" class="absolute ltr:right-3 rtl:left-3 top-1/2 -translate-y-1/2 text-white/50 hover:text-white transition-colors p-0.5">
                        <svg id="regPassClosed" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" opacity="0.3"/>
                            <path d="M4.5 4.5L19.5 19.5"/>
                        </svg>
                        <svg id="regPassOpen" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <g id="regPassPupil">
                                <circle cx="12" cy="12" r="3"/>
                            </g>
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="input-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="!text-xs !text-text-muted !absolute ltr:!left-4 rtl:!right-4 !top-2" />
                <div class="relative">
                    <x-text-input id="password_confirmation" class="block w-full input pt-6 pb-2 ltr:pr-14 rtl:pl-14"
                                    type="password"
                                    name="password_confirmation"
                                    required autocomplete="new-password"
                                    placeholder="············" />
                    <button id="regConfirmBtn" type="button" class="absolute ltr:right-3 rtl:left-3 top-1/2 -translate-y-1/2 text-white/50 hover:text-white transition-colors p-0.5">
                        <svg id="regConfirmClosed" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" opacity="0.3"/>
                            <path d="M4.5 4.5L19.5 19.5"/>
                        </svg>
                        <svg id="regConfirmOpen" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <g id="regConfirmPupil">
                                <circle cx="12" cy="12" r="3"/>
                            </g>
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <hr class="border-surface-border">

            <p class="text-sm font-medium text-text-primary">{{ __('Phone numbers') }}</p>

            <div class="grid sm:grid-cols-2 gap-4">
                <div class="input-group">
                    <x-input-label for="num1" :value="__('Num1')" class="!text-xs !text-text-muted !absolute ltr:!left-4 rtl:!right-4 !top-2" />
                    <x-text-input id="num1" class="block w-full input pt-6 pb-2" type="text" name="num1" :value="old('num1')" required placeholder="09XX XXX XXX" maxlength="10" />
                    <x-input-error :messages="$errors->get('num1')" class="mt-2" />
                </div>

                <div class="input-group">
                    <x-input-label for="num2" :value="__('Num2')" class="!text-xs !text-text-muted !absolute ltr:!left-4 rtl:!right-4 !top-2" />
                    <x-text-input id="num2" class="block w-full input pt-6 pb-2" type="text" name="num2" :value="old('num2')" required placeholder="09XX XXX XXX" maxlength="10" />
                    <x-input-error :messages="$errors->get('num2')" class="mt-2" />
                </div>
            </div>
        </div>

        <button type="submit" class="btn-primary w-full mt-8">
            {{ __('Create account') }}
        </button>

        <div class="mt-6 text-center mb-6">
            <p class="text-sm text-text-muted">
                {{ __('Already have an account?') }}
                <a href="{{ route('login.show', ['role' => $role]) }}" class="text-primary-light hover:text-white font-medium transition-colors">
                    {{ __('Sign in') }}
                </a>
            </p>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupEyeToggle(btnId, closedId, openId, inputId, pupilId) {
                var btn = document.getElementById(btnId);
                var closed = document.getElementById(closedId);
                var open = document.getElementById(openId);
                var input = document.getElementById(inputId);
                var pupil = pupilId ? document.getElementById(pupilId) : null;
                var isOpen = false;
                if (!btn || !input) return;
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    isOpen = !isOpen;
                    input.type = isOpen ? 'text' : 'password';
                    closed.classList.toggle('hidden', isOpen);
                    open.classList.toggle('hidden', !isOpen);
                    if (pupil && !isOpen) pupil.setAttribute('transform', 'translate(0, 0)');
                });
                if (pupil) {
                    document.addEventListener('mousemove', function(e) {
                        if (!isOpen) return;
                        var rect = btn.getBoundingClientRect();
                        var cx = rect.left + rect.width / 2;
                        var cy = rect.top + rect.height / 2;
                        var dx = e.clientX - cx;
                        var dy = e.clientY - cy;
                        var dist = Math.sqrt(dx * dx + dy * dy);
                        var maxDist = 2;
                        var limited = Math.min(dist, maxDist);
                        var angle = Math.atan2(dy, dx);
                        var tx = Math.cos(angle) * limited;
                        var ty = Math.sin(angle) * limited;
                        pupil.setAttribute('transform', 'translate(' + tx + ', ' + ty + ')');
                    });
                }
            }
            setupEyeToggle('regPassBtn', 'regPassClosed', 'regPassOpen', 'password', 'regPassPupil');
            setupEyeToggle('regConfirmBtn', 'regConfirmClosed', 'regConfirmOpen', 'password_confirmation', 'regConfirmPupil');
        });
    </script>
</x-guest-layout>