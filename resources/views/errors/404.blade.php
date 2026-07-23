<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — {{ __('Page Not Found') }} | Trips Hub</title>
    <link rel="icon" href="{{ asset('images/logo1.png') }}">
    <script>document.documentElement.classList.add('dark');</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body bg-[#0F0D0A] text-white min-h-screen flex items-center justify-center">
    <div class="px-4 py-12 w-full">
        <div class="max-w-md mx-auto text-center">
            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#C9A96E]/20 to-[#C9A96E]/5 flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-[#C9A96E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-8xl font-black text-[#C9A96E] tracking-tight mb-2">404</h1>
            <div class="w-16 h-0.5 bg-[#C9A96E]/30 mx-auto mb-6 rounded-full"></div>
            <h2 class="text-2xl font-bold text-[#E8DEC8] mb-3">{{ __('Page Not Found') }}</h2>
            <p class="text-[#B8A890]/60 mb-10 leading-relaxed">{{ __('The page you are looking for does not exist or has been moved.') }}</p>
            <div class="flex items-center justify-center gap-3">
                <a href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#C9A96E]/10 border border-[#C9A96E]/20 text-[#C9A96E] hover:bg-[#C9A96E]/20 hover:border-[#C9A96E]/30 transition-all duration-200 font-medium text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    {{ __('Go Back') }}
                </a>
                <a href="{{ url('/') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#2932FF] hover:bg-[#2932FF]/90 text-white transition-all duration-200 font-medium text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    {{ __('Home') }}
                </a>
            </div>
        </div>
    </div>
</body>
</html>