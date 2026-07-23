<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Manage Offices') }}</h2>
            <a href="{{ route('owner.export.offices') }}" class="btn-primary-sm">
                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                {{ __('Export Excel') }}
            </a>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 pb-12">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-6 p-4 bg-teal/10 border border-teal/15 rounded-[12px] text-teal-light flex items-center gap-3 animate-slide-down">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @php $globalDiscount = DB::table('settings')->where('key', 'global_discount')->value('value') ?? 0; @endphp

            @if(auth()->user()->role === 'owner')
            <div class="card p-6 mb-8 entrance">
                <form method="POST" action="{{ route('owner.settings.global-discount') }}" class="flex items-end gap-4">
                    @csrf
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-text-primary mb-2">
                            <svg class="w-4 h-4 inline -mt-0.5 mr-1.5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Global Discount') }}
                        </label>
                        <div class="flex gap-2">
                            <input type="number" name="global_discount" value="{{ $globalDiscount }}" min="0" max="50" step="0.01" class="input w-32" placeholder="%">
                            <span class="text-text-muted self-center text-sm">{{ __('percent off on all trips') }}</span>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary-sm">{{ __('Update') }}</button>
                </form>
            </div>
            @endif

            <div class="card p-6 mb-8 entrance flex items-center justify-between max-sm:flex-col max-sm:items-start max-sm:gap-3">
                <div>
                    <h3 class="text-lg max-sm:text-base font-bold text-text-primary">{{ __('Office Requests') }}</h3>
                    <p class="text-sm max-sm:text-xs text-text-muted mt-1">{{ __('View and manage office registration and deletion requests') }}</p>
                </div>
                <div class="flex gap-3 max-sm:w-full">
                    <a href="{{ route('owner.deletion.requests') }}" class="btn-primary inline-flex items-center gap-2 max-sm:text-xs max-sm:px-3 max-sm:py-1.5">
                        <svg class="w-5 h-5 max-sm:w-4 max-sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        {{ __('Deletion Requests') }}
                    </a>
                    <a href="{{ route('owner.office.requests') }}" class="btn-primary inline-flex items-center gap-2 max-sm:text-xs max-sm:px-3 max-sm:py-1.5">
                        <svg class="w-5 h-5 max-sm:w-4 max-sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        {{ __('Registration Requests') }}
                    </a>
                </div>
            </div>

            @if(auth()->user()->role === 'admin')
            <div class="card p-8 mb-8 entrance">
                <h3 class="text-lg font-bold text-text-primary mb-6">{{ __('Create account') }} — <span class="text-emerald-400">{{ __('Office') }}</span></h3>
                <form method="POST" action="{{ route('owner.users.store') }}">
                    @csrf
                    <input type="hidden" name="role" value="office">

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="input-group">
                            <x-input-label for="name" :value="__('Name')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                            <x-text-input id="name" class="block w-full input pt-6 pb-2" type="text" name="name" :value="old('name')" required placeholder="Office name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="input-group">
                            <x-input-label for="email" :value="__('Email')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                            <x-text-input id="email" class="block w-full input pt-6 pb-2" type="email" name="email" :value="old('email')" required placeholder="office@example.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="input-group">
                            <x-input-label for="password" :value="__('Password')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                            <x-text-input id="password" class="block w-full input pt-6 pb-2" type="password" name="password" required placeholder="············" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="input-group">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="!text-xs !text-text-muted !absolute !left-4 !top-2" />
                            <x-text-input id="password_confirmation" class="block w-full input pt-6 pb-2" type="password" name="password_confirmation" required placeholder="············" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

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

                    <button type="submit" class="btn-primary mt-6 w-full">
                        {{ __('Create account') }}
                    </button>
                </form>
            </div>
            @endif

            <div class="card overflow-hidden entrance">
                    <div class="table-responsive-wrapper">
                        <table class="table-premium">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Trips') }}</th>
                                <th>{{ __('Discount') }}</th>
                                <th>{{ __('Rating') }}</th>
                                <th>{{ __('Joined') }}</th>
                                @if(auth()->user()->role === 'owner')
                                <th>{{ __('Actions') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($offices as $office)
                                <tr>
                                    <td class="text-text-primary font-medium">{{ $office->name }}</td>
                                    <td class="text-text-muted">{{ $office->email }}</td>
                                    <td>
                                        @if($office->num1 || $office->num2)
                                            <div class="flex flex-col gap-0.5 text-xs">
                                                @if($office->num1)
                                                    <span><span class="font-medium text-emerald-400">Num1</span> <span class="text-text-muted font-mono">{{ $office->num1 }}</span></span>
                                                @endif
                                                @if($office->num2)
                                                    <span><span class="font-medium text-yellow-400">Num2</span> <span class="text-text-muted font-mono">{{ $office->num2 }}</span></span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-text-muted text-sm">&mdash;</span>
                                        @endif
                                    </td>
                                    <td class="text-text-primary">{{ $office->trips->count() }}</td>
                                    <td>
                                        @if(auth()->user()->role === 'owner')
                                            <form method="POST" action="{{ route('owner.offices.discount', $office->id) }}" class="flex items-center gap-1">
                                                @csrf @method('PATCH')
                                                <input type="number" name="discount" value="{{ $office->discount ?? 0 }}" min="0" max="50" step="0.01" class="w-16 text-xs input py-1 px-2 text-center"
                                                    onchange="this.form.submit()">
                                                <span class="text-xs text-text-muted">%</span>
                                            </form>
                                        @else
                                            <span class="text-text-muted text-sm">{{ $office->discount ?? 0 }}%</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php $avg = $office->averageRating(); @endphp
                                        @if($avg)
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                </svg>
                                                <span class="text-sm font-medium text-text-primary">{{ number_format($avg, 1) }}</span>
                                            </div>
                                        @else
                                            <span class="text-text-muted text-sm">{{ __('N/A') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-text-muted text-sm">{{ $office->created_at->format('Y-m-d') }}</td>
                                    @if(auth()->user()->role === 'owner')
                                    <td>
                                        <div class="flex items-center gap-2">
                                            @php
                                                $pauseData = [
                                                    "action" => route("owner.offices.pause", $office->id),
                                                    "method" => "PATCH",
                                                    "title" => $office->is_paused ? __("Unpause user") : __("Pause user"),
                                                    "message" => $office->is_paused ? __("Are you sure you want to unpause this user?") : __("Are you sure you want to pause this user?"),
                                                    "confirmText" => "TripsHub",
                                                    "buttonText" => $office->is_paused ? __("Unpause") : __("Pause"),
                                                    "buttonClass" => $office->is_paused ? "bg-emerald-500" : "bg-yellow-500",
                                                ];
                                                $deleteData = [
                                                    "action" => route("owner.offices.destroy", $office->id),
                                                    "method" => "DELETE",
                                                    "title" => __("Delete user"),
                                                    "message" => __("Are you sure you want to delete this user? This action cannot be undone."),
                                                    "confirmText" => "TripsHub",
                                                    "buttonText" => __("Delete"),
                                                    "buttonClass" => "bg-coral",
                                                ];
                                            @endphp
                                            <button type="button"
                                                onclick='return openConfirmModal(@json($pauseData))'
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium transition-all duration-200 cursor-pointer
                                                    @if($office->is_paused)
                                                        bg-emerald-500/15 text-emerald-400 border border-emerald-500/25 hover:bg-emerald-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95
                                                    @else
                                                        bg-yellow-500/15 text-yellow-400 border border-yellow-500/25 hover:bg-yellow-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95
                                                    @endif">
                                                @if($office->is_paused)
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ __('Unpause') }}
                                                @else
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ __('Pause') }}
                                                @endif
                                            </button>

                                            <a href="{{ route('owner.users.impersonate', $office) }}"
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-accent-purple/15 text-accent-purple border border-accent-purple/25 hover:bg-accent-purple/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer whitespace-nowrap"
                                                title="{{ __('Login as this office') }}">
                                                 <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                 </svg>
                                                 {{ __('Login as') }}
                                             </a>

                                            <button type="button"
                                                onclick='return openConfirmModal(@json($deleteData))'
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-coral/15 text-coral-light border border-coral/25 hover:bg-coral/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                {{ __('Delete') }}
                                            </button>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-surface-border">
                    {{ $offices->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-confirm-modal />
</x-app-layout>