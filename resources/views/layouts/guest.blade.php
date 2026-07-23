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

        @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        @stack('styles')
    </head>
    <body class="font-body text-white selection:bg-tertiary/30">

        <div class="relative min-h-screen flex flex-col">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover" src="{{ asset('images/login-bg.png') }}" alt="">
                <div class="absolute inset-0" style="background: rgba(0,0,0,0.45);"></div>
                @if(app()->getLocale() === 'ar')
                <div class="absolute inset-0" style="background: rgba(0,0,0,0.1);"></div>
                @endif
            </div>

            <header class="relative z-10 h-20 md:h-24">
                <div class="absolute left-4 md:left-10 top-6 md:top-8">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-white/10 backdrop-blur-sm border border-white/15 text-white/80 hover:bg-white/20 hover:text-white hover:border-tertiary/50 hover:shadow-lg hover:shadow-tertiary/10 transition-all duration-300 group">
                        <span class="material-symbols-outlined text-2xl transition-transform duration-300 group-hover:-translate-x-0.5 rtl:group-hover:translate-x-0.5">arrow_back</span>
                        <span class="text-sm font-medium hidden md:inline">{{ __('Back') }}</span>
                    </a>
                </div>
                <div class="absolute right-4 md:right-12 top-1/2 -translate-y-1/2 flex items-center gap-4">
                    <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="group relative">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/5 backdrop-blur-sm text-sm font-medium text-white/80 hover:bg-white/15 hover:border-tertiary/40 hover:text-tertiary transition-all duration-500 group-hover:scale-105 active:scale-95 shadow-lg shadow-black/10">
                            <span class="material-symbols-outlined text-lg transition-all duration-700 ease-in-out group-hover:rotate-[360deg] group-hover:scale-110">language</span>
                            <span class="tracking-wider font-semibold">{{ app()->getLocale() === 'ar' ? 'EN' : 'AR' }}</span>
                            <span class="w-0 overflow-hidden transition-all duration-300 ease-in-out group-hover:w-4 group-hover:ml-0.5 flex items-center justify-center">
                                <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">{{ app()->getLocale() === 'ar' ? 'arrow_back' : 'arrow_forward' }}</span>
                            </span>
                        </span>
                    </a>
                </div>
            </header>

            <main class="relative z-10 flex-1 flex items-center justify-center px-4 pb-12">
                <div class="w-full max-w-md max-sm:max-w-[300px]">
                    <div class="glass-card rounded-2xl pt-2 pb-0 px-5 sm:px-8 md:px-10 shadow-[0_8px_32px_0_rgba(31,38,135,0.37)]">
                        {{ $slot }}
                    </div>
                    <p class="text-center mt-6 text-xs text-white/40">
                        &copy; {{ date('Y') }} Trips Hub
                    </p>
                </div>
            </main>
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

            document.addEventListener('DOMContentLoaded', restoreFormData);
            document.addEventListener('submit', function() {
                sessionStorage.removeItem('savedFormData');
                sessionStorage.removeItem('savedFormUrl');
            });
        </script>

        @stack('scripts')
    </body>
</html>
