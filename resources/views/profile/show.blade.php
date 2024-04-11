<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Discord Information</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Your linked Discord account details.
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                @if (Auth::user()->discord_id)
                                    <div class="flex items-center mb-4">
                                        <img class="inline-block h-12 w-12 rounded-full mr-4" src="{{ Auth::user()->discord_avatar_url }}" alt="Discord Avatar">
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900">{{ Auth::user()->discord_displayname }}</h4>
                                            <p class="text-sm text-gray-500">{{ Auth::user()->discord_id }}</p>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500">Your Discord account is successfully linked, contact an admin if you wonder to unlink it.</p>
                                @else
                                    <div class="flex items-center mb-4">
                                        <svg class="h-12 w-12 text-gray-400 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900">No Discord account linked</h4>
                                            <p class="text-sm text-gray-500">Connect your Discord account to unlock additional features.</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('auth.discord') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                                        Connect Discord
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <x-section-border />
            </div>

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
