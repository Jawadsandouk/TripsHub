<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-text-primary leading-tight">{{ __('Manage Users') }}</h2>
            <a href="{{ route('owner.export.users') }}" class="btn-primary-sm">
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

            <div class="card overflow-hidden entrance">
                <div class="table-responsive-wrapper">
                    <table class="table-premium">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Role') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Discount') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-text-primary font-medium">{{ $user->name }}</td>
                                    <td class="text-text-muted">{{ $user->email }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($user->role === 'owner') badge-primary
                                            @elseif($user->role === 'admin') badge-info
                                            @elseif($user->role === 'office') badge-success
                                            @else badge-warning @endif capitalize">{{ $user->role }}</span>
                                    </td>
                                    <td>
                                        @if($user->num1 || $user->num2)
                                            <div class="flex flex-col gap-1 text-xs">
                                                @if($user->num1)
                                                    <span><span class="font-medium text-emerald-400">Num1</span> <span class="text-text-muted font-mono">{{ $user->num1 }}</span></span>
                                                @endif
                                                @if($user->num2)
                                                    <span><span class="font-medium text-yellow-400">Num2</span> <span class="text-text-muted font-mono">{{ $user->num2 }}</span></span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-text-muted text-sm">&mdash;</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->role === 'office')
                                            <form method="POST" action="{{ route('owner.offices.discount', $user->id) }}" class="flex items-center gap-1">
                                                @csrf @method('PATCH')
                                                <input type="number" name="discount" value="{{ $user->discount ?? 0 }}" min="0" max="50" step="0.01" class="w-16 text-xs input py-1 px-2 text-center"
                                                    onchange="this.form.submit()">
                                                <span class="text-xs text-text-muted">%</span>
                                            </form>
                                        @else
                                            <span class="text-text-muted text-sm">&mdash;</span>
                                        @endif
                                    </td>
                                    <td class="text-text-muted text-sm">{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if($user->id !== Auth::id())
                                        <div class="flex items-center gap-2">
                                            @php
                                                $pauseRoute = $user->role === 'office'
                                                    ? route('owner.offices.pause', $user->id)
                                                    : route('owner.users.pause', $user->id);
                                                $deleteRoute = $user->role === 'office'
                                                    ? route('owner.offices.destroy', $user->id)
                                                    : route('owner.users.destroy', $user->id);
                                            @endphp

                                            @php
                                                $pauseData = [
                                                    "action" => $pauseRoute,
                                                    "method" => "PATCH",
                                                    "title" => $user->is_paused ? __("Unpause user") : __("Pause user"),
                                                    "message" => $user->is_paused ? __("Are you sure you want to unpause this user?") : __("Are you sure you want to pause this user?"),
                                                    "confirmText" => "TripsHub",
                                                    "buttonText" => $user->is_paused ? __("Unpause") : __("Pause"),
                                                    "buttonClass" => $user->is_paused ? "bg-emerald-500" : "bg-yellow-500",
                                                ];
                                                $deleteData = [
                                                    "action" => $deleteRoute,
                                                    "method" => "DELETE",
                                                    "title" => __("Delete user"),
                                                    "message" => __("Are you sure you want to delete this user? This action cannot be undone."),
                                                    "confirmText" => "TripsHub",
                                                    "buttonText" => __("Delete"),
                                                    "buttonClass" => "bg-coral",
                                                ];
                                            @endphp

                                            @if($user->role !== 'owner')
                                            <button type="button"
                                                onclick='return openConfirmModal(@json($pauseData))'
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium transition-all duration-200 cursor-pointer
                                                    @if($user->is_paused)
                                                        bg-emerald-500/15 text-emerald-400 border border-emerald-500/25 hover:bg-emerald-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95
                                                    @else
                                                        bg-yellow-500/15 text-yellow-400 border border-yellow-500/25 hover:bg-yellow-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95
                                                    @endif">
                                                @if($user->is_paused)
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
                                            @endif

                                            @if($user->role !== 'owner')
                                            <a href="{{ route('owner.users.impersonate', $user) }}"
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-accent-purple/15 text-accent-purple border border-accent-purple/25 hover:bg-accent-purple/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer whitespace-nowrap"
                                                title="{{ __('Login as this user') }}">
                                                 <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                 </svg>
                                                 {{ __('Login as') }}
                                             </a>
                                            @endif

                                            @if($user->role !== 'owner')
                                            <button type="button"
                                                onclick='return openConfirmModal(@json($deleteData))'
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[8px] text-xs font-medium bg-coral/15 text-coral-light border border-coral/25 hover:bg-coral/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out cursor-pointer">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                {{ __('Delete') }}
                                            </button>
                                            @endif
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-surface-border">
                    {{ $users->links() }}
                </div>
                <div class="p-6 border-t border-surface-border flex flex-wrap items-center gap-4">
                    <span class="text-sm text-text-muted font-medium">{{ __('Create new') }}:</span>

                    <a href="{{ route('owner.users.create', 'user') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-[10px] text-sm font-bold text-yellow-400 bg-yellow-500/15 border border-yellow-500/25 hover:bg-yellow-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        {{ __('Add new User') }}
                    </a>

                    <a href="{{ route('owner.users.create', 'office') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-[10px] text-sm font-bold text-emerald-400 bg-emerald-500/15 border border-emerald-500/25 hover:bg-emerald-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3"/>
                        </svg>
                        {{ __('Add new Office') }}
                    </a>

                    <a href="{{ route('owner.users.create', 'admin') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-[10px] text-sm font-bold text-cyan-400 bg-cyan-500/15 border border-cyan-500/25 hover:bg-cyan-500/25 hover:scale-105 hover:shadow-lg hover:shadow-black/25 active:scale-95 transition-all duration-200 ease-out">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        {{ __('Add new Admin') }}
                    </a>

                    <a href="{{ route('owner.users.create', 'owner') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-[10px] text-sm font-bold text-accent-purple bg-accent-purple/10 border border-accent-purple/20 hover:bg-accent-purple/20 hover:border-accent-purple/40 hover:scale-[1.02] transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        {{ __('Add new Owner') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <x-confirm-modal />
</x-app-layout>