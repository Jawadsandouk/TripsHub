<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Trips Hub'))</title>
    <link rel="icon" href="{{ asset('images/logo1.png') }}">

    <script>document.documentElement.classList.add('dark');</script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@600;700;800&family=Public+Sans:wght@400;700&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'Material Symbols Outlined';
            font-style: normal;
            font-weight: 400;
            src: url('{{ asset('fonts/material-symbols/MaterialSymbolsOutlined.woff2') }}') format('woff2');
        }
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <style>
        .content-warm { background: #181B40; }
        .stagger-1 { animation: fade-slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.08s both; }
        .stagger-2 { animation: fade-slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.16s both; }
        .stagger-3 { animation: fade-slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.24s both; }
        .stagger-4 { animation: fade-slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.32s both; }
        .stagger-5 { animation: fade-slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.40s both; }
    </style>
</head>
<body class="font-sans antialiased">

    <div class="min-h-screen bg-[#2b5b99] text-text-primary" x-data="{ mobileNavOpen: false }">

        @if(session()->has('impersonator'))
        <div class="relative z-50 bg-gradient-to-r from-accent-purple/80 to-purple-700/80 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex items-center justify-between">
                <div class="flex items-center gap-2 text-sm text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span>{{ __('You are logged in as') }} <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->role }})</span>
                </div>
                <a href="{{ route('owner.leave.impersonation') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-white/15 text-white border border-white/25 hover:bg-white/25 transition-all duration-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    {{ __('Leave impersonation') }}
                </a>
            </div>
        </div>
        @endif

            {{-- Main content area --}}
            <div class="flex-1 flex flex-col min-h-screen content-warm">
            {{-- Top bar --}}
            <header class="sticky top-0 z-50 bg-transparent backdrop-blur-[4px]" dir="ltr">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center h-[115px] max-md:h-[80px] max-sm:h-[70px] border-b border-white/15">
                    {{-- Logo on left --}}
                    @section('header_logo')
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo1.png') }}" alt="Trips Hub" class="h-[110px] max-md:h-[55px] max-sm:h-[45px] w-auto object-contain drop-shadow-[0_0_5px_rgba(255,255,255,0.2)]">
                    </a>
                    @show

                    {{-- Right side group --}}
                    <div class="ml-auto flex items-center gap-2 md:gap-4 lg:gap-6">
                        {{-- Dashboard button --}}
                        <a href="{{ route('dashboard') }}"
                           class="hidden lg:flex items-center px-4 lg:px-6 py-2.5 bg-primary hover:bg-primary-light text-white font-bold uppercase tracking-wider text-xs lg:text-sm rounded-lg transition-all duration-200"
                            title="{{ __('Home') }}">
                             <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                             </svg>
                             <span>{{ __('Home') }}</span>
                        </a>

                        {{-- Hamburger menu (mobile) --}}
                        <button type="button" @click="mobileNavOpen = !mobileNavOpen" class="hamburger-btn lg:hidden" aria-label="{{ __('Menu') }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        {{-- Language switcher --}}
                        <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" onclick="saveFormData()" class="group relative hidden lg:inline-flex">
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary hover:bg-primary-light text-white font-medium text-sm transition-all duration-300 group-hover:scale-105 active:scale-95">
                                <span class="material-symbols-outlined text-lg transition-all duration-700 ease-in-out group-hover:rotate-[360deg] group-hover:scale-110">language</span>
                                <span class="tracking-wider font-semibold">{{ app()->getLocale() === 'ar' ? 'EN' : 'AR' }}</span>
                                <span class="w-0 overflow-hidden transition-all duration-300 ease-in-out group-hover:w-4 group-hover:ml-0.5 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">{{ app()->getLocale() === 'ar' ? 'arrow_back' : 'arrow_forward' }}</span>
                                </span>
                            </span>
                        </a>

                        {{-- User dropdown --}}
                        @auth
                            <div class="relative hidden lg:block" x-data="{ open: false }">
                                <button type="button" @click="open = !open" class="flex items-center gap-2.5 px-3 py-1.5 rounded-lg bg-primary hover:bg-primary-light transition-all duration-300 group">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-purple-500 flex items-center justify-center text-sm font-bold text-white shadow-lg shadow-primary/30">
                                        @php
                                            $parts = explode(' ', auth()->user()->name);
                                            $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                                        @endphp
                                        {{ $initials }}
                                    </div>
                                    <span class="text-sm font-medium text-white/80 group-hover:text-white transition-colors hidden sm:inline">{{ auth()->user()->name }}</span>
                                    <svg class="w-4 h-4 text-white/60 group-hover:text-white transition-all duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 py-2 bg-surface-card rounded-xl shadow-lg border border-white/10 z-50">
                                    <div class="px-4 py-2 border-b border-white/10 mb-1">
                                        <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-white/60">{{ auth()->user()->email }}</p>
                                    </div>
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-white/80 hover:bg-white/10 hover:text-white transition-colors">{{ __('Profile') }}</a>
                                    <a href="{{ route('help') }}" class="block px-4 py-2 text-sm text-white/80 hover:bg-white/10 hover:text-white transition-colors">{{ __('Help') }}</a>
                                    <form method="POST" action="{{ route('logout') }}" class="mt-1 pt-1 border-t border-white/10">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-white/80 hover:bg-white/10 hover:text-white transition-colors">{{ __('Logout') }}</button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </header>

            {{-- Mobile Navigation Panel --}}
            <template x-teleport="body">
                <div x-show="mobileNavOpen" x-cloak class="mobile-nav-overlay lg:!hidden" @click="mobileNavOpen = false">
                    <div class="mobile-nav-panel lg:!hidden" @click.stop>
                        <div class="flex items-center justify-between p-4 border-b border-white/10">
                            <span class="text-sm font-semibold text-white/80">{{ __('Menu') }}</span>
                            <button type="button" @click="mobileNavOpen = false" class="hamburger-btn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4 space-y-2">
                            <a href="{{ route('dashboard') }}" @click="mobileNavOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-white/80 hover:bg-primary/40 hover:text-white transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                {{ __('Home') }}
                            </a>
                            @auth
                            <a href="{{ route('profile.edit') }}" @click="mobileNavOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-white/80 hover:bg-primary/40 hover:text-white transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ __('Profile') }}
                            </a>
                            <a href="{{ route('help') }}" @click="mobileNavOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-white/80 hover:bg-primary/40 hover:text-white transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ __('Help') }}
                            </a>
                            <div class="border-t border-white/10 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-lg text-sm text-coral-light hover:bg-coral/10 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    {{ __('Logout') }}
                                </button>
                            </form>
                            @endauth
                            <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" @click="mobileNavOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-white/80 hover:bg-primary/40 hover:text-white transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
                            </a>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Main content --}}
            <main class="flex-1">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-2">
                    {{ $header ?? '' }}
                </div>
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function saveFormData() {
            const data = {};
            document.querySelectorAll('input[name], textarea[name], select[name]').forEach(el => {
                if (el.type !== 'file' && el.type !== 'submit' && el.type !== 'button' && el.type !== 'hidden') {
                    data[el.name] = el.value;
                }
            });
            sessionStorage.setItem('savedFormData', JSON.stringify(data));
            sessionStorage.setItem('savedFormUrl', window.location.pathname + window.location.search);
            const alpineEl = document.querySelector('[x-data]');
            if (alpineEl && alpineEl.__x) {
                const d = alpineEl.__x.$data;
                if (d.stops) sessionStorage.setItem('savedAlpineStops', JSON.stringify(d.stops));
                if (d.stopLang) sessionStorage.setItem('savedAlpineStopLang', d.stopLang);
            }
        }

        function restoreFormData() {
            const saved = sessionStorage.getItem('savedFormData');
            const savedUrl = sessionStorage.getItem('savedFormUrl');
            if (!saved || savedUrl !== window.location.pathname + window.location.search) return;
            try {
                const data = JSON.parse(saved);
                document.querySelectorAll('input[name], textarea[name], select[name]').forEach(el => {
                    if (data[el.name] !== undefined) el.value = data[el.name];
                });
            } catch(e) {}
            sessionStorage.removeItem('savedFormData');
            sessionStorage.removeItem('savedFormUrl');
            sessionStorage.removeItem('savedAlpineStops');
            sessionStorage.removeItem('savedAlpineStopLang');
        }

        window.openConfirmModal = window.openConfirmModal || function(data) {
            window.dispatchEvent(new CustomEvent('open-confirm-modal', { detail: data }));
            return false;
        };

        document.addEventListener('DOMContentLoaded', restoreFormData);

        document.addEventListener('submit', function() {
            sessionStorage.removeItem('savedFormData');
            sessionStorage.removeItem('savedFormUrl');
        });

        function goBack(fallback) {
            if (window.history.length > 1) {
                window.history.back();
            } else if (document.referrer && document.referrer !== window.location.href) {
                window.location.href = document.referrer;
            } else {
                window.location.href = fallback || '{{ route('dashboard') }}';
            }
        }
    </script>

@stack('scripts')

</body>
</html>
