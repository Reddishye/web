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
                            <p>Hugo Torres, with 5+ years in Minecraft development, excels in creating Minecraft plugins, Discord bots, and server configurations. His expertise ensures unique, tailored solutions that enhance gaming and community experiences. Elevate your digital project by leveraging Hugo's skills for unmatched innovation and satisfaction. Contact Hugo today to transform your Minecraft or Discord environment.</p>
                        </div>
                    </div>

                    <div class="p-6 group">
                        <div class="flex items-center">
                            <div class="text-lg font-semibold leading-7">
                                <i class="mr-2 text-green-500 transition duration-200 fas fa-code group-hover:text-green-700 dark:text-green-400 dark:group-hover:text-green-600"></i>
                                <span class="text-gray-900 transition duration-200 group-hover:text-green-500 dark:text-white dark:group-hover:text-green-400">Contact me</span>
                            </div>
                        </div>

                        <div class="mt-2 ml-6 text-sm text-gray-600 transition duration-200 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300">
                            <div class="grid justify-center grid-cols-4 gap-3">

                                <span class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <a href="https://github.com/Reddishye"><i class="text-2xl transition ease-in-out fab fa-github duration-400 hover:text-white"></i></a>
                                </span>

                                <span class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <a href="https://bsky.app/profile/redactado.es"><i class="text-2xl transition ease-in-out fa-brands fa-twitter duration-400 hover:text-white"></i></a>
                                </span>

                                <span class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <a href="https://redactado.es/links/discord"><i class="text-2xl transition ease-in-out fa-brands fa-discord duration-400 hover:text-white"></i></a>
                                </span>

                                <span class="inline-flex items-center justify-center w-16 h-16 p-2 m-2 transition duration-200 ease-in-out transform bg-gray-200 rounded-full hover:-translate-y-1 hover:scale-110 hover:bg-purple-500 hover:shadow-lg hover:shadow-purple-500/50 dark:bg-gray-900 dark:hover:bg-purple-400 dark:hover:shadow-purple-400/50">
                                    <a href="{{ route('links.redirect') }}"><i class="text-2xl transition ease-in-out fa-solid fa-paper-plane duration-400 hover:text-white"></i></a>
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
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Authors:</span>
                        <ul class="mt-1 ml-4 text-gray-700 list-disc dark:text-gray-400">
                            @foreach ($project->authors as $author)
                                <li>{{ $author }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>

<div class="flex justify-center mt-4 sm:items-center sm:justify-between">
    <div class="text-sm text-center text-gray-500 sm:text-left dark:text-gray-400">
        <div class="flex items-center">
            <span>Developed with</span>
            <i class="mx-1 text-red-500 fas fa-heart"></i>
            <span>by Hugo Torres</span>
        </div>
    </div>
</div>
</div>
</div>
@livewire('theme-switcher')
@livewireScripts
</body>

</html>
