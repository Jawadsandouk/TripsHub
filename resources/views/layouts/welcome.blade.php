<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Trips Hub') }}</title>
    <link rel="icon" href="{{ asset('images/logo1.png') }}">
    <link rel="preload" href="{{ asset('images/damascus-bg.png') }}" as="image">

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

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Montserrat:wght@700;800&family=Public+Sans:wght@400;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body text-white selection:bg-welcome-tertiary selection:text-welcome-primary overflow-x-hidden">
    <div class="relative h-screen w-full flex flex-col overflow-hidden" style="background-image: linear-gradient(rgba(5,10,48,0.7), rgba(5,10,48,0.85)), url('/images/damascus-bg.png'); background-size: cover; background-position: center;">
        <header class="fixed top-0 left-0 w-full z-50 flex items-center px-4 md:px-20 h-16 bg-transparent">
            <div class="flex items-center gap-2"></div>
            <div class="absolute right-4 md:right-20 flex items-center gap-4">
                <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="group relative">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/5 backdrop-blur-sm text-sm font-medium text-white/80 hover:bg-white/15 hover:border-welcome-tertiary/40 hover:text-welcome-tertiary transition-all duration-500 group-hover:scale-105 active:scale-95 shadow-lg shadow-black/10">
                        <span class="material-symbols-outlined text-lg transition-all duration-700 ease-in-out group-hover:rotate-[360deg] group-hover:scale-110">language</span>
                        <span class="tracking-wider font-semibold">{{ app()->getLocale() === 'ar' ? 'EN' : 'AR' }}</span>
                        <span class="w-0 overflow-hidden transition-all duration-300 ease-in-out group-hover:w-4 group-hover:ml-0.5 flex items-center justify-center">
                            <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">arrow_forward</span>
                        </span>
                    </span>
                </a>
            </div>
        </header>

        <main class="flex-grow flex flex-col items-center px-4 sm:px-6 pt-4 pb-4">
            @yield('content')
        </main>

        <footer class="w-full py-4 px-4 sm:px-6 md:px-20 flex flex-col md:flex-row justify-between items-center gap-2 bg-black/20 backdrop-blur-sm border-t border-white/5">
            <div class="flex flex-col items-center md:items-start gap-1">
                <span class="text-sm font-bold text-welcome-tertiary">{{ config('app.name', 'Trips Hub') }}</span>
                <p class="text-sm text-white/50">&copy; {{ date('Y') }} Trips Hub. All rights reserved.</p>
            </div>
            <div class="flex gap-6">
                <a class="text-sm text-white/60 hover:text-welcome-tertiary transition-all" href="#">{{ __('Privacy Policy') }}</a>
                <a class="text-sm text-white/60 hover:text-welcome-tertiary transition-all" href="#">{{ __('Terms of Service') }}</a>
                <a class="text-sm text-white/60 hover:text-welcome-tertiary transition-all" href="#">{{ __('Contact Us') }}</a>
            </div>
        </footer>
    </div>


</body>
</html>
