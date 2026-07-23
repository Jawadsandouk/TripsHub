<x-app-layout>
    <style>
        .dashboard-stitch {
            display: flex;
            flex-direction: column;
            background-color: #0D0F1A;
            min-height: calc(100vh - 84px);
        }
        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.6s ease-out forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        .glass-card {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        .glass-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.09);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }
        .arrow-slide { transition: transform 0.3s ease; }
        .glass-card:hover .arrow-slide { transform: translateX(4px); }
        .dashboard-card { height: 200px !important; width: 285px; min-width: 0; margin: 0 auto; overflow-wrap: break-word; word-wrap: break-word; }
        @media (max-width: 640px) { .dashboard-card { width: 100% !important; height: 140px !important; } }

    </style>

    <div class="dashboard-stitch">
        <img src="{{ asset('images/dashboard-bg.png') }}" alt=""
             class="fixed inset-0 w-full h-full object-cover opacity-70"
             style="z-index: 0;">
        <div class="fixed inset-0 z-[1]" style="background: linear-gradient(to bottom, rgba(13,15,26,0.6), rgba(13,15,26,0.1));"></div>

        <div class="relative z-10 flex-1 pt-14 pb-[23px] px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            {{-- Welcome Header --}}
            <header class="mb-[43px]">
                <h1 class="font-headline-xl text-headline-xl max-sm:!text-headline-md text-on-surface mb-2 fade-up stagger-1">{{ __('Welcome back') }}, {{ auth()->user()->name }}</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant fade-up stagger-1">{{ __('Discover Damascus — your next adventure awaits') }}</p>
            </header>

            {{-- 4 Cards Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">

                {{-- Browse Trips --}}
                <a href="{{ route('trips.public') }}" class="glass-card dashboard-card p-6 max-sm:p-3 rounded-xl flex flex-col justify-between group fade-up stagger-1 block" style="border-top: 4px solid #8B5CF6;">
                    <div class="flex items-start justify-between mb-8 max-sm:mb-2">
                        <div class="w-14 h-14 max-sm:w-8 max-sm:h-8 rounded-lg flex items-center justify-center" style="background: rgba(139, 92, 246, 0.15);">
                            <span class="material-symbols-outlined text-3xl max-sm:text-xl" style="color: #8B5CF6;">calendar_today</span>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-[#bec2ff] arrow-slide max-sm:text-sm">arrow_forward</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md max-sm:text-sm text-headline-md text-on-surface mb-2 max-sm:mb-1">{{ __('Browse Trips') }}</h3>
                        <p class="font-body-sm text-body-sm max-sm:text-[10px] text-on-surface-variant">{{ __('Find and book your next adventure') }}</p>
                    </div>
                </a>

                {{-- Offices --}}
                <a href="{{ route('offices.index') }}" class="glass-card dashboard-card p-6 max-sm:p-3 rounded-xl flex flex-col justify-between group fade-up stagger-2 block" style="border-top: 4px solid #D4AF37;">
                    <div class="flex items-start justify-between mb-8 max-sm:mb-2">
                        <div class="w-14 h-14 max-sm:w-8 max-sm:h-8 rounded-lg flex items-center justify-center" style="background: rgba(212, 175, 55, 0.15);">
                            <span class="material-symbols-outlined text-3xl max-sm:text-xl text-gold-accent">domain</span>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-[#bec2ff] arrow-slide max-sm:text-sm">arrow_forward</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md max-sm:text-sm text-headline-md text-on-surface mb-2 max-sm:mb-1">{{ __('Offices') }}</h3>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">{{ __('Discover trusted travel offices') }}</p>
                    </div>
                </a>

                {{-- My Bookings --}}
                <a href="{{ route('bookings.index') }}" class="glass-card dashboard-card p-6 max-sm:p-3 rounded-xl flex flex-col justify-between group fade-up stagger-3 block" style="border-top: 4px solid #2DD4BF;">
                    <div class="flex items-start justify-between mb-8 max-sm:mb-2">
                        <div class="w-14 h-14 max-sm:w-8 max-sm:h-8 rounded-lg flex items-center justify-center" style="background: rgba(45, 212, 191, 0.15);">
                            <span class="material-symbols-outlined text-3xl max-sm:text-xl text-teal-accent">menu_book</span>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-[#bec2ff] arrow-slide max-sm:text-sm">arrow_forward</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md max-sm:text-sm text-headline-md text-on-surface mb-2 max-sm:mb-1">{{ __('My Bookings') }}</h3>
                        <p class="font-body-sm text-body-sm max-sm:text-[10px] text-on-surface-variant">{{ __('Manage your reservations') }}</p>
                    </div>
                </a>

                {{-- My Points --}}
                <a href="{{ route('user.points') }}" class="glass-card dashboard-card p-6 max-sm:p-3 rounded-xl flex flex-col justify-between group fade-up stagger-4 block" style="border-top: 4px solid #D4AF37;">
                    <div class="flex items-start justify-between mb-8 max-sm:mb-2">
                        <div class="w-14 h-14 max-sm:w-8 max-sm:h-8 rounded-lg flex items-center justify-center" style="background: rgba(212, 175, 55, 0.15);">
                            <span class="material-symbols-outlined text-3xl max-sm:text-xl text-gold-accent">monetization_on</span>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-[#bec2ff] arrow-slide max-sm:text-sm">arrow_forward</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md max-sm:text-sm text-headline-md text-on-surface mb-2 max-sm:mb-1">{{ __('My Points') }}</h3>
                        <p class="font-body-sm text-body-sm max-sm:text-[10px] text-on-surface-variant">{{ number_format(auth()->user()->points) }} {{ __('pts') }}</p>
                    </div>
                </a>

            </div>


        </div>

        {{-- Footer --}}
        <footer class="relative z-10 w-full py-4 px-4 md:px-20 flex flex-col md:flex-row justify-between items-center gap-2 bg-black/20 backdrop-blur-sm border-t border-white/5">
            <div class="flex flex-col items-center md:items-start gap-1">
                <span class="text-sm font-bold text-welcome-tertiary">{{ config('app.name', 'Trips Hub') }}</span>
                <p class="text-sm text-white/50">&copy; {{ date('Y') }} Trips Hub. {{ __('All rights reserved.') }}</p>
            </div>
            <div class="flex gap-6">
                <a class="text-sm text-white/60 hover:text-welcome-tertiary transition-all" href="#">{{ __('Privacy Policy') }}</a>
                <a class="text-sm text-white/60 hover:text-welcome-tertiary transition-all" href="#">{{ __('Terms of Service') }}</a>
                <a class="text-sm text-white/60 hover:text-welcome-tertiary transition-all" href="#">{{ __('Support') }}</a>
                <a class="text-sm text-white/60 hover:text-welcome-tertiary transition-all" href="#">{{ __('Global Network') }}</a>
            </div>
        </footer>
    </div>
</x-app-layout>
