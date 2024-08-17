<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hugo Torres - Developer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta charset="UTF-8">
    <meta name="description" content="Discover the portfolio of Hugo Torres, an expert developer in Laravel, Minecraft plugins, Discord bots, and Minecraft server configuration.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://redactado.es/">
    <meta property="og:title" content="Hugo Torres, Developer">
    <meta property="og:description" content="Discover the portfolio of Hugo Torres, an expert developer in Laravel, Minecraft plugins, Discord bots, and Minecraft server configuration.">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://redactado.es/">
    <meta name="twitter:title" content="Hugo Torres, Developer">
    <meta name="twitter:description" content="Discover the portfolio of Hugo Torres, an expert developer in Laravel, Minecraft plugins, Discord bots, and Minecraft server configuration.">
</head>

<body class="antialiased text-gray-900 transition duration-200 bg-gray-100 dark:bg-gray-900 dark:text-white">
    @if (Route::has('login'))
    <div class="z-10 p-6 text-right sm:fixed sm:top-0 sm:right-0">
        @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Manage</a>
        @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Login</a>
        @endauth
    </div>
    @endif
    <div class="relative flex justify-center min-h-screen py-4 items-top sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="z-0 flex justify-center mt-8 sm:justify-start sm:mt-0">
                <h1 class="z-0 ml-4 text-5xl font-bold text-gray-900 sm:mt-20 lg:text-6xl dark:text-white">Hugo Torres</h1>
            </div>

            <div class="mt-8 overflow-hidden bg-white shadow sm:rounded-lg dark:bg-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6 group">
                        <div class="flex items-center">
                            <div class="text-lg font-semibold leading-7">
                                <i
                                    class="mr-2 text-blue-500 transition duration-200 fas fa-user group-hover:text-blue-700 dark:text-blue-400 dark:group-hover:text-blue-600"></i>
                                <span class="text-gray-900 transition duration-200 group-hover:text-blue-500 dark:text-white dark:group-hover:text-blue-400">About Me</span>
                            </div>
                        </div>

                        <div class="mt-2 ml-6 text-sm text-gray-600 transition duration-200 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300">
                            <p>Hugo Torres, with over 5 years of experience in Minecraft development, excels in creating Minecraft plugins, Discord bots, and server configurations. Additionally, Hugo is a skilled web developer specializing in building websites using Laravel and Livewire. His expertise ensures unique, tailored solutions that enhance gaming, community, and web experiences. Elevate your digital project by leveraging Hugo's diverse skills for unmatched innovation and satisfaction. Contact Hugo today to transform your Minecraft, Discord, or web environment.</p>
                        </div>
                    </div>
                    <div class="p-6 group">
                        <div class="flex items-center">
                            <div class="text-lg font-semibold leading-7">
                                <i class="mr-2 text-green-500 transition duration-200 fas fa-code group-hover:text-green-700 dark:text-green-400 dark:group-hover:text-green-600"></i>
                                <span class="text-gray-900 transition duration-200 group-hover:text-green-500 dark:text-white dark:group-hover:text-green-400">Technologies</span>
                            </div>
                        </div>

                        <div class="mt-2 ml-6 text-sm text-gray-600 transition duration-200 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300 flex flex-col items-start">
                            <div class="grid justify-center grid-cols-4 gap-3">
                                <!-- Laravel -->
                                <span @popper(Laravel) class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <x-devicon-laravel class="w-8 h-8 transition ease-in-out duration-400 hover:text-white"/>
                                </span>
                                <!-- PHP -->
                                <span @popper(PHP) class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <x-devicon-php class="w-8 h-8 transition ease-in-out duration-400 hover:text-white"/>
                                </span>
                                <!-- Docker -->
                                <span @popper(Docker) class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <x-devicon-docker class="w-8 h-8 transition ease-in-out duration-400 hover:text-white"/>
                                </span>
                                <!-- TypeScript -->
                                <span @popper(TypeScript) class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <x-devicon-typescript class="w-8 h-8 rounded-md transition ease-in-out duration-400 hover:text-white"/>
                                </span>
                                <!-- Python -->
                                <span @popper(Python) class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <x-devicon-python class="w-8 h-8 transition ease-in-out duration-400 hover:text-white"/>
                                </span>
                                <!-- Java -->
                                <span @popper(Java) class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <x-devicon-java class="w-8 h-8 transition ease-in-out duration-400 hover:text-white"/>
                                </span>
                                <!-- TailwindCSS -->
                                <span @popper(TailwindCSS) class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <x-devicon-tailwindcss class="w-8 h-8 transition ease-in-out duration-400 hover:text-white"/>
                                </span>
                                <!-- MySQL -->
                                <span @popper(MySQL) class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <x-devicon-mysql class="w-8 h-8 transition ease-in-out duration-400 hover:text-white"/>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
<!-- Projects Section -->
<div class="p-6 mt-12 border-t border-gray-200 group dark:border-gray-700">
    <div class="flex items-center">
        <div class="text-lg font-semibold leading-7">
            <i
                class="mr-2 text-yellow-500 transition duration-200 fas fa-tasks group-hover:text-yellow-700 dark:text-yellow-400 dark:group-hover:text-yellow-600"></i>
            <span class="text-gray-900 transition duration-200 group-hover:text-yellow-500 dark:text-white dark:group-hover:text-yellow-400">Projects</span>
        </div>
    </div>

    <div class="mt-2 ml-6 text-sm text-gray-600 transition duration-200 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects as $project)
                <div class="p-4 transition duration-200 ease-in-out transform bg-gray-200 rounded-lg shadow-md hover:shadow-lg hover:scale-105 dark:bg-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $project->name }} <span class="inline-flex px-2 ml-2 text-xs font-semibold leading-5 text-gray-600 transition duration-200 ease-in-out transform bg-gray-200 border-2 border-gray-300 rounded-md select-none hover:border-indigo-400 hover:text-indigo-500 hover:shadow-lg dark:bg-gray-700 dark:border-gray-500 dark:text-gray-400 dark:hover:border-indigo-300 dark:hover:text-indigo-400">{{ $project->version }}</span></h3><span class="px-2 inline-flex text-xs leading-5 font-semibold absolute top-0 right-0 mt-2 mr-2 rounded-full bg-gray-200 border-dashed border-2 select-none @if ($project->status === 'active') border-green-300 @elseif ($project->status === 'inactive') border-red-300 @elseif ($project->status === 'archived') border-yellow-400 @elseif ($project->status === 'soon') border-orange-400 @endif dark:bg-gray-800">@if ($project->status === 'active') ⭐ Active @elseif ($project->status === 'inactive') 💀 Inactive @elseif ($project->status === 'archived') 📦 Archived @elseif ($project->status === 'soon') 👀 Soon @endif</span>
                    <p class="mt-1 text-gray-700 dark:text-gray-400">{{ $project->description }}</p>
                    <div class="mt-2">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">
                            @if(count($project->authors) > 1)
                                Authors:
                            @else
                                Author:
                            @endif
                        </span>
                            <div class="inline dark:text-gray-400 text-gray-800">
                                @foreach ($project->authors as $author)
                                    {{ $author }}@if (!$loop->last), @else. @endif
                                @endforeach
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>

<div class="flex flex-col sm:flex-row justify-center sm:justify-between mt-4 sm:items-center">
    <div class="text-sm text-center text-gray-500 sm:text-left dark:text-gray-400 mb-4 sm:mb-0">
        <div class="flex items-center justify-center sm:justify-start">
            <span>Developed with</span>
            <i class="mx-1 text-red-500 fas fa-heart"></i>
            <span>by Hugo Torres</span>
        </div>
    </div>
    <div class="text-sm text-center text-gray-500 dark:text-gray-400 mb-4 sm:mb-0">
        <a href="{{ route('links.redirect') }}">
            <div class="flex items-center justify-center sm:justify-center">
                <i class="mx-1 text-blue-500 dark:text-blue-400 fas fa-link mr-2"></i>
                <span class="underline decoration-dashed">Other Links</span>
            </div>
        </a>
    </div>
    <div class="text-sm text-center text-gray-500 sm:text-right dark:text-gray-400">
        <a href="mailto:contact@redactado.es">
            <div class="flex items-center justify-center sm:justify-end">
                <i class="mx-1 text-green-500 fas fa-at mr-2"></i>
                <span class="underline decoration-dashed">contact@redactado.es</span>
            </div>
        </a>
    </div>
</div>
</div>
</div>
@livewire('theme-switcher')
@livewireScripts

<script async defer src="https://api.redactado.es/latest.js"></script>
<noscript><img src="https://api.redactado.es/noscript.gif" alt="" referrerpolicy="no-referrer-when-downgrade" /></noscript>

@include('popper::assets')
</body>

</html>
