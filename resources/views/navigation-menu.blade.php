<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block w-auto h-9" />
                    </a>
                </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <i class="mr-3 fas fa-home"></i>{{ __('Dashboard') }}
                </x-nav-link>
                @if (has_permission('admin'))
                <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                    <i class="mr-3 fas fa-user"></i>{{ __('Users') }}
                </x-nav-link>
                <x-nav-link href="{{ route('analytics') }}" :active="request()->routeIs('analytics')">
                    <i class="mr-3 fas fa-chart-column"></i>{{ __('Analytics') }}
                </x-nav-link>
                <x-nav-link href="{{ route('projects.index') }}" :active="request()->routeIs('projects.index')">
                    <i class="mr-3 fas fa-project-diagram"></i>{{ __('Projects') }}
                </x-nav-link>
                <x-nav-link href="{{ route('links.index') }}" :active="request()->routeIs('links.index')">
                    <i class="mr-3 fa-solid fa-link"></i>{{ __('Links')}}
                </x-nav-link>
                @endif
                <x-nav-link href="{{ route('licenses.index') }}" :active="request()->routeIs('licenses.index')">
                    <i class="mr-3 fa-solid fa-id-card"></i>{{ __('Licenses')}}
                </x-nav-link>
                <x-nav-link href="{{ route('calendar.index') }}" :active="request()->routeIs('calendar.index')">
                    <i class="mr-3 fa-solid fa-calendar"></i>{{ __('Calendar')}}
                </x-nav-link>
                <x-nav-link href="{{ route('messages.index') }}" :active="request()->routeIs('messages.index')">
                    <i class="mr-3 fa-solid fa-message"></i>{{ __('Messages')}}
                    @livewire('unread-messages-count')
                </x-nav-link>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <!-- Settings Dropdown -->
                <div class="relative ms-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                    <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                <i class="mr-3 fas fa-gear"></i>{{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                <i class="mr-3 fas fa-user"></i>{{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    <i class="mr-3 fas fa-right-from-bracket"></i>{{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                <i class="mr-3 fas fa-home"></i>{{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if (has_permission('admin'))
            <x-responsive-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                <i class="mr-3 fas fa-user"></i>{{ __('Users') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('analytics') }}" :active="request()->routeIs('analytics')">
                <i class="mr-3 fas fa-chart-column"></i>{{ __('Analytics') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('projects.index') }}" :active="request()->routeIs('projects.index')">
                <i class="mr-3 fas fa-project-diagram"></i>{{ __('Projects') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('links.index') }}" :active="request()->routeIs('links.index')">
                <i class="mr-3 fa-solid fa-link"></i>{{ __('Links')}}
            </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link href="{{ route('licenses.index') }}" :active="request()->routeIs('licenses.index')">
                <i class="mr-3 fa-solid fa-id-card"></i>{{ __('Licenses')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('calendar.index') }}" :active="request()->routeIs('calendar.index')">
                <i class="mr-3 fa-solid fa-calendar"></i>{{ __('Calendar')}}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('messages.index') }}" :active="request()->routeIs('messages.index')">
                <i class="mr-3 fa-solid fa-messages"></i>{{ __('Messages')}}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
