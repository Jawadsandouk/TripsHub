@extends('layouts.welcome')

@section('content')
    <div class="text-center">
        <div class="flex justify-center animate-logo-entrance">
            <div class="animate-float">
                <img src="{{ asset('images/logo1.png') }}" alt="Trips Hub" class="object-contain w-[21.6rem] h-[21.6rem] md:w-[28.8rem] md:h-[28.8rem] max-sm:w-[14rem] max-sm:h-[14rem]">
            </div>
        </div>
        <h2 class="text-welcome-tertiary font-headline font-bold text-sm tracking-[0.2em] mb-2 -mt-8 stagger-1 uppercase">{{ __('Your Gateway To Syria') }}</h2>
        <h1 class="text-3xl md:text-5xl max-sm:text-xl font-headline font-extrabold text-white mb-10 tracking-tight stagger-2">{{ __('Welcome to') }} {{ config('app.name') }}</h1>
    </div>

    <div class="w-full max-w-lg max-sm:max-w-xs scale-[1.15] max-sm:scale-100 origin-top space-y-3">
        <x-role-card
            :href="route('login.show', ['role' => 'user'])"
            icon="directions_bus"
            :title="__('I\'m a Tourist')"
            :description="__('Discover and book your trips now')"
            color="secondary"
        />

        <x-role-card
            :href="route('login.show', ['role' => 'office'])"
            icon="location_city"
            :title="__('I\'m a Tourism Office')"
            :description="__('You can now create and manage your office trips')"
            color="tertiary"
        />
    </div>
@endsection
