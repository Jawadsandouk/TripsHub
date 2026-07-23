<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <button type="button" onclick="goBack()" class="p-2 rounded-[10px] text-text-muted hover:text-text-primary hover:bg-primary/40 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </button>
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Help & Support') }}</h2>
        </div>
    </x-slot>

    @php $role = auth()->user()->role; @endphp

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-4xl mx-auto space-y-8">

            {{-- About Section --}}
            <div class="card p-8 entrance">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gold/20 to-gold-dark/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-text-primary">{{ __('About Trips Hub') }}</h3>
                        <p class="text-sm text-text-muted">{{ __('Your complete travel management platform') }}</p>
                    </div>
                </div>
                <p class="text-text-secondary leading-relaxed">
                    {{ __('Trips Hub is a comprehensive platform for managing travel trips, bookings, and offices. Whether you are a traveler looking for exciting trips or a travel office managing your offerings, it provides all the tools you need in one place.') }}
                </p>
            </div>

            {{-- Tutorial Video Section --}}
            <div class="card p-8 entrance">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-ice/20 to-ice-dark/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-ice-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-text-primary">{{ __('Guide & Tutorial') }}</h3>
                        <p class="text-sm text-text-muted">{{ __('Learn how to use your account effectively') }}</p>
                    </div>
                </div>

                @if($role === 'user')
                    <div class="p-4 bg-accent-purple/5 border border-accent-purple/10 rounded-[12px] mb-6">
                        <h4 class="font-semibold text-accent-purple mb-2">{{ __('User Guide') }}</h4>
                        <p class="text-sm text-text-secondary">{{ __('As a user, you can browse trips, book seats, earn points, and manage your bookings. Watch the video below for a complete walkthrough.') }}</p>
                    </div>
                    <div class="aspect-video bg-surface-card rounded-[12px] flex items-center justify-center border border-surface-border/40">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-text-muted/30 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-text-muted">{{ __('User tutorial video (coming soon)') }}</p>
                        </div>
                    </div>
                @elseif($role === 'office')
                    <div class="p-4 bg-gold/5 border border-gold/10 rounded-[12px] mb-6">
                        <h4 class="font-semibold text-gold mb-2">{{ __('Travel Office Guide') }}</h4>
                        <p class="text-sm text-text-secondary">{{ __('As a travel office, you can create and manage trips, view bookings, cancel trips, and handle your office profile. Watch the video below for a complete walkthrough.') }}</p>
                    </div>
                    <div class="aspect-video bg-surface-card rounded-[12px] flex items-center justify-center border border-surface-border/40">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-text-muted/30 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-text-muted">{{ __('Office tutorial video (coming soon)') }}</p>
                        </div>
                    </div>
                @elseif($role === 'admin')
                    <div class="p-4 bg-ice/5 border border-ice/10 rounded-[12px] mb-6">
                        <h4 class="font-semibold text-ice-light mb-2">{{ __('Admin Guide') }}</h4>
                        <p class="text-sm text-text-secondary">{{ __('As an admin, you can manage offices, create new office accounts, and oversee office operations. Watch the video below for a complete walkthrough.') }}</p>
                    </div>
                    <div class="aspect-video bg-surface-card rounded-[12px] flex items-center justify-center border border-surface-border/40">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-text-muted/30 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-text-muted">{{ __('Admin tutorial video (coming soon)') }}</p>
                        </div>
                    </div>
                @elseif($role === 'owner')
                    <div class="p-4 bg-coral/5 border border-coral/10 rounded-[12px] mb-6">
                        <h4 class="font-semibold text-coral mb-2">{{ __('Owner Guide') }}</h4>
                        <p class="text-sm text-text-secondary">{{ __('As an owner, you have full access to manage users, trips, bookings, offices, and system settings. Watch the video below for a complete walkthrough.') }}</p>
                    </div>
                    <div class="aspect-video bg-surface-card rounded-[12px] flex items-center justify-center border border-surface-border/40">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-text-muted/30 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-text-muted">{{ __('Owner tutorial video (coming soon)') }}</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Quick Guide Section --}}
            <div class="card p-8 entrance">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-teal/20 to-emerald/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-teal-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-text-primary">{{ __('Quick Guide') }}</h3>
                        <p class="text-sm text-text-muted">{{ __('Get started quickly with these steps') }}</p>
                    </div>
                </div>

                @if($role === 'user')
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">1</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Browse & Book') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Browse available trips, check details, and book your seats with ease.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">2</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Manage Bookings') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('View your bookings, track your trips, and cancel if needed.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">3</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Earn Points') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Earn points with every booking and redeem them for great benefits.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">4</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Get Support') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Contact us anytime for assistance with your account or bookings.') }}</p>
                    </div>
                </div>
                @elseif($role === 'office')
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">1</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Create Trips') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Create and publish trips with descriptions, images, and pricing.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">2</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Manage Bookings') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('View and manage all booking requests for your trips.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">3</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Track Performance') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Monitor your trip popularity, ratings, and earnings.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">4</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Get Support') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Contact us anytime for assistance.') }}</p>
                    </div>
                </div>
                @elseif($role === 'admin')
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">1</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Manage Offices') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Create new office accounts and manage existing ones.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">2</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Oversee Operations') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Monitor office activities and system usage.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">3</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Platform Settings') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Configure global discounts and platform preferences.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">4</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Get Support') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Contact us anytime for assistance.') }}</p>
                    </div>
                </div>
                @elseif($role === 'owner')
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">1</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Manage Users') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Create and manage all user accounts across every role.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">2</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Manage Trips') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Oversee all trips: pause, cancel, reopen, or delete.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">3</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('Manage Offices') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Create and manage travel office accounts.') }}</p>
                    </div>
                    <div class="p-4 bg-surface-card/50 rounded-[12px] border border-surface-border/30">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-7 h-7 rounded-full bg-gold/20 flex items-center justify-center text-xs font-bold text-gold">4</span>
                            <h4 class="font-semibold text-text-primary text-sm">{{ __('System Settings') }}</h4>
                        </div>
                        <p class="text-xs text-text-muted leading-relaxed">{{ __('Configure global discounts and system-wide settings.') }}</p>
                    </div>
                </div>
                @endif
            </div>

            {{-- Contact Section --}}
            <div class="card p-8 entrance">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-coral/20 to-rose/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-text-primary">{{ __('Contact Us') }}</h3>
                        <p class="text-sm text-text-muted">{{ __('We are here to help you') }}</p>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gold/10 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-text-primary">{{ __('Email') }}</h4>
                            <p class="text-xs text-text-muted mt-0.5">support@tripshub.com</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-ice/10 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-ice-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-text-primary">{{ __('Phone') }}</h4>
                            <p class="text-xs text-text-muted mt-0.5">+963 11 234 5678</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-coral/10 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-text-primary">{{ __('Address') }}</h4>
                            <p class="text-xs text-text-muted mt-0.5">{{ __('Damascus, Syria') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-teal/10 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-teal-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-text-primary">{{ __('Working Hours') }}</h4>
                            <p class="text-xs text-text-muted mt-0.5">{{ __('Sun - Thu, 9:00 AM - 5:00 PM') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
