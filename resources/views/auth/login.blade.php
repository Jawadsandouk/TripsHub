<x-guest-layout>
    <div class="scale-[0.90] origin-top">
    <div class="text-center mb-0 -mt-6 md:-mt-8 max-sm:-mt-4">
        <div class="flex justify-center mb-0.5 max-sm:mb-0 logo-3d-container" style="perspective: 600px;">
            <img id="logo3d" src="{{ asset('images/logo1.png') }}" alt="Trips Hub" class="w-[396px] md:w-[476px] max-w-full object-contain drop-shadow-md logo-3d max-sm:!w-[200px]" style="clip-path: inset(0 0 20px 0);">
        </div>
        <p class="text-base max-sm:text-sm text-white/80 font-medium mt-0">{{ __('Sign in to your account') }}</p>
        <div class="role-badge inline-flex items-center gap-1.5 px-3 max-sm:px-2 py-1 rounded-full text-xs max-sm:text-[10px] font-semibold mt-1 border
            @switch($role)
                @case('user') bg-yellow-500/15 text-yellow-300 border-yellow-500/25 @break
                @case('office') bg-emerald-500/15 text-emerald-300 border-emerald-500/25 @break
                @case('admin') bg-cyan-500/15 text-cyan-300 border-cyan-500/25 @break
                @case('owner') bg-purple-500/15 text-purple-300 border-purple-500/25 @break
            @endswitch">
            <span class="material-symbols-outlined text-sm">
                @switch($role)
                    @case('user') person @break
                    @case('office') business @break
                    @case('admin') verified_user @break
                    @case('owner') star @break
                    @default person @break
                @endswitch
            </span>
            <span>
                @switch($role)
                    @case('user') {{ __('Tourist') }} @break
                    @case('office') {{ __('Office') }} @break
                    @case('admin') {{ __('Admin') }} @break
                    @case('owner') {{ __('Owner') }} @break
                    @default {{ ucfirst($role) }} @break
                @endswitch
            </span>
        </div>
    </div>

    <form method="POST" action="{{ route('login.role', ['role' => $role]) }}" class="space-y-5 max-sm:space-y-2.5">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-3">
                <ul class="list-disc list-inside text-sm text-white space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-1.5 max-sm:space-y-1">
            <label class="block text-xs max-sm:text-[11px] font-semibold uppercase tracking-wider text-white/70 ml-1" for="email">{{ __('Email') }}</label>
            <div class="relative">
                <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-white/50 text-xl">mail</span>
                <input class="glass-input w-full ltr:pl-11 rtl:pr-11 ltr:pr-4 rtl:pl-4 py-3 max-sm:py-2.5 rounded-xl" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus autocomplete="username">
            </div>
        </div>

        <div class="space-y-1.5 max-sm:space-y-1">
            <label class="block text-xs max-sm:text-[11px] font-semibold uppercase tracking-wider text-white/70 ml-1" for="password">{{ __('Password') }}</label>
            <div class="relative">
                <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-white/50 text-xl">lock</span>
                <input class="glass-input w-full ltr:pl-11 rtl:pr-11 ltr:pr-14 rtl:pl-14 py-3 max-sm:py-2.5 rounded-xl" id="password" name="password" type="password" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" required autocomplete="current-password">
                <button id="eyeBtn" class="absolute ltr:right-3 rtl:left-3 top-1/2 -translate-y-1/2 text-white/50 hover:text-white transition-colors p-0.5" type="button">
                    <svg id="eyeClosed" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" opacity="0.3"/>
                        <path d="M4.5 4.5L19.5 19.5"/>
                    </svg>
                    <svg id="eyeOpen" class="w-6 h-6 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <g id="pupilGroup">
                            <circle cx="12" cy="12" r="3"/>
                        </g>
                    </svg>
                </button>
            </div>
            @if (Route::has('password.request'))
            <div class="ltr:text-right rtl:text-left px-1 mt-1 max-sm:mt-0.5">
                <a class="text-xs max-sm:text-[11px] hover:text-white transition-colors" style="color: #ffffff;" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
            </div>
            @endif
        </div>

        <div class="flex items-center space-x-2 rtl:space-x-reverse px-1 max-sm:space-x-1.5">
            <input class="w-4 h-4 rounded border-white/20 bg-white/10 text-secondary focus:ring-secondary transition-colors" id="remember_me" name="remember" type="checkbox">
            <label class="text-sm max-sm:text-xs text-white/70 select-none" for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <div class="pt-2 max-sm:pt-0">
            <button type="submit" class="w-full bg-[#2932FF] hover:bg-[#2932FF]/90 text-white font-headline font-bold py-3.5 max-sm:py-2.5 rounded-xl shadow-lg hover:shadow-blue-500/20 transition-all active:scale-[0.98]">
                {{ __('Log in') }}
            </button>
        </div>
    </form>

    @if($role === 'user')
    <div class="mt-5 max-sm:mt-3 text-center">
        <p class="text-sm max-sm:text-xs text-white/60">
            {{ __("Don't have an account?") }}
            <a class="font-semibold hover:underline decoration-white/30 underline-offset-4 ml-1" style="color: #ffffff;" href="{{ route('register', ['role' => $role]) }}">{{ __('Create account') }}</a>
        </p>
    </div>
    @elseif($role === 'office')
    <div class="mt-5 max-sm:mt-3 text-center">
        <p class="text-sm max-sm:text-xs text-white/60">
            {{ __("Don't have an account?") }}
            <a class="font-semibold hover:underline decoration-white/30 underline-offset-4 ml-1" style="color: #ffffff;" href="{{ route('office.register.request') }}">{{ __('Send a registration request') }}</a>
        </p>
    </div>
    @endif

    <script>
        (function() {
            var eyeBtn = document.getElementById('eyeBtn');
            var eyeClosed = document.getElementById('eyeClosed');
            var eyeOpen = document.getElementById('eyeOpen');
            var pupilGroup = document.getElementById('pupilGroup');
            var passwordInput = document.getElementById('password');
            var isOpen = false;

            eyeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                isOpen = !isOpen;
                passwordInput.type = isOpen ? 'text' : 'password';
                eyeClosed.classList.toggle('hidden', isOpen);
                eyeOpen.classList.toggle('hidden', !isOpen);
                if (!isOpen) {
                    pupilGroup.setAttribute('transform', 'translate(0, 0)');
                }
            });

            document.addEventListener('mousemove', function(e) {
                if (!isOpen) return;
                var rect = eyeBtn.getBoundingClientRect();
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
                pupilGroup.setAttribute('transform', 'translate(' + tx + ', ' + ty + ')');
            });

            eyeBtn.addEventListener('touchmove', function(e) {
                if (!isOpen) return;
                var touch = e.touches[0];
                var rect = eyeBtn.getBoundingClientRect();
                var cx = rect.left + rect.width / 2;
                var cy = rect.top + rect.height / 2;
                var dx = touch.clientX - cx;
                var dy = touch.clientY - cy;
                var dist = Math.sqrt(dx * dx + dy * dy);
                var maxDist = 2;
                var limited = Math.min(dist, maxDist);
                var angle = Math.atan2(dy, dx);
                var tx = Math.cos(angle) * limited;
                var ty = Math.sin(angle) * limited;
                pupilGroup.setAttribute('transform', 'translate(' + tx + ', ' + ty + ')');
            });

            // 3D Logo Tilt
            var logo = document.getElementById('logo3d');
            var container = document.querySelector('.logo-3d-container');
            if (logo && container) {
                var isMobile = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);
                if (!isMobile) {
                    container.addEventListener('mousemove', function(e) {
                        var rect = container.getBoundingClientRect();
                        var x = (e.clientX - rect.left) / rect.width - 0.5;
                        var y = (e.clientY - rect.top) / rect.height - 0.5;
                        logo.style.transform = 'perspective(600px) rotateY(' + (x * 12) + 'deg) rotateX(' + (-y * 12) + 'deg) scale(1.05)';
                    });
                    container.addEventListener('mouseleave', function() {
                        logo.style.transform = 'perspective(600px) rotateY(0deg) rotateX(0deg) scale(1)';
                    });
                } else {
                    var breathing = true;
                    (function animate() {
                        if (!breathing) return;
                        var t = Date.now() / 2000;
                        var s = 1 + Math.sin(t) * 0.02;
                        logo.style.transform = 'perspective(600px) rotateY(0deg) rotateX(0deg) scale(' + s + ')';
                        requestAnimationFrame(animate);
                    })();
                    container.addEventListener('touchstart', function() {
                        breathing = false;
                    });
                }
            }
        })();
    </script>
</div>
</x-guest-layout>
