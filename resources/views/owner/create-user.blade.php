<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Create account') }} — <span class="capitalize">{{ __($role) }}</span></h2>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-2xl mx-auto">
            <a href="{{ route('owner.users') }}" class="inline-flex items-center gap-2 text-sm text-text-muted hover:text-text-primary mb-6 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('Back to users') }}
            </a>

            <div class="card p-8">
                @php
                    $roleColors = [
                        'user' => ['bg' => 'from-yellow-500/20 to-amber-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20 hover:border-yellow-500/40'],
                        'office' => ['bg' => 'from-emerald-500/20 to-teal-500/10', 'text' => 'text-emerald-400', 'border' => 'border-emerald-500/20 hover:border-emerald-500/40'],
                        'admin' => ['bg' => 'from-cyan-500/20 to-blue-500/10', 'text' => 'text-cyan-400', 'border' => 'border-cyan-500/20 hover:border-cyan-500/40'],
                        'owner' => ['bg' => 'from-accent-purple/20 to-accent-deep/10', 'text' => 'text-accent-purple', 'border' => 'border-accent-purple/20 hover:border-accent-purple/40'],
                    ];
                    $colors = $roleColors[$role] ?? $roleColors['user'];
                @endphp

                <div class="text-center mb-8">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br {{ $colors['bg'] }} flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 {{ $colors['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-primary">{{ __('Create account') }}</h3>
                    <p class="text-text-secondary text-sm mt-1">
                        {{ __('New') }} <span class="{{ $colors['text'] }} font-medium capitalize">{{ __($role) }}</span>
                    </p>
                </div>

                <form method="POST" action="{{ route('owner.users.store') }}">
                    @csrf
                    <input type="hidden" name="role" value="{{ $role }}">

                    <div class="space-y-5">
                        <div class="input-group">
                            <x-input-label for="name" :value="__('Name')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                            <x-text-input id="name" class="block w-full input pt-6 pb-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="input-group">
                            <x-input-label for="email" :value="__('Email')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                            <x-text-input id="email" class="block w-full input pt-6 pb-2" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="input-group">
                            <x-input-label for="password" :value="__('Password')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                            <div class="relative">
                                <x-text-input id="password" class="block w-full input pt-6 pb-2 pr-14" type="password" name="password" required autocomplete="new-password" placeholder="············" />
                                <button id="adminPassBtn" type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-tertiary/50 hover:text-white transition-colors p-0.5">
                                    <svg id="adminPassClosed" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" fill="currentColor" fill-opacity="0.04" opacity="0.35"/>
                                        <path d="M3.5 10.5C6 7.5 9 7 12 7c3 0 6 .5 8.5 3.5" stroke-linecap="round"/>
                                    </svg>
                                    <svg id="adminPassOpen" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" fill="currentColor" fill-opacity="0.08"/>
                                        <circle cx="12" cy="12" r="4" fill="currentColor" fill-opacity="0.18" stroke="none"/>
                                        <g id="adminPassPupil">
                                            <circle cx="12" cy="12" r="2" fill="currentColor" stroke="none"/>
                                        </g>
                                        <circle cx="13.5" cy="10.2" r="1.2" fill="white" fill-opacity="0.25" stroke="none"/>
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="input-group">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                            <div class="relative">
                                <x-text-input id="password_confirmation" class="block w-full input pt-6 pb-2 pr-14" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="············" />
                                <button id="adminConfirmBtn" type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-tertiary/50 hover:text-white transition-colors p-0.5">
                                    <svg id="adminConfirmClosed" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" fill="currentColor" fill-opacity="0.04" opacity="0.35"/>
                                        <path d="M3.5 10.5C6 7.5 9 7 12 7c3 0 6 .5 8.5 3.5" stroke-linecap="round"/>
                                    </svg>
                                    <svg id="adminConfirmOpen" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" fill="currentColor" fill-opacity="0.08"/>
                                        <circle cx="12" cy="12" r="4" fill="currentColor" fill-opacity="0.18" stroke="none"/>
                                        <g id="adminConfirmPupil">
                                            <circle cx="12" cy="12" r="2" fill="currentColor" stroke="none"/>
                                        </g>
                                        <circle cx="13.5" cy="10.2" r="1.2" fill="white" fill-opacity="0.25" stroke="none"/>
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <hr class="border-surface-border">

                        <p class="text-sm font-medium text-text-primary">{{ __('Phone numbers') }}</p>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="input-group">
                                <x-input-label for="num1" :value="__('Num1')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                                <x-text-input id="num1" class="block w-full input pt-6 pb-2" type="text" name="num1" :value="old('num1')" required placeholder="09XX XXX XXX" maxlength="10" />
                                <x-input-error :messages="$errors->get('num1')" class="mt-2" />
                            </div>

                            <div class="input-group">
                                <x-input-label for="num2" :value="__('Num2')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                                <x-text-input id="num2" class="block w-full input pt-6 pb-2" type="text" name="num2" :value="old('num2')" required placeholder="09XX XXX XXX" maxlength="10" />
                                <x-input-error :messages="$errors->get('num2')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-8">
                        <a href="{{ route('owner.users') }}" class="btn-ghost-danger px-6 py-2.5 text-sm">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="flex-1 px-6 py-2.5 rounded-[10px] text-sm font-bold text-white bg-gradient-to-r {{ $colors['bg'] }} {{ $colors['text'] }} hover:scale-[1.02] transition-all duration-200">
                            {{ __('Create account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
            setupEyeToggle('adminPassBtn', 'adminPassClosed', 'adminPassOpen', 'password', 'adminPassPupil');
            setupEyeToggle('adminConfirmBtn', 'adminConfirmClosed', 'adminConfirmOpen', 'password_confirmation', 'adminConfirmPupil');
        });
    </script>
</x-app-layout>
