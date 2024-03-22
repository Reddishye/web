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

<body class="antialiased bg-gray-900 text-white">
    <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <h1 class="ml-4 text-6xl font-bold">⭐ Hugo Torres</h1>
            </div>

            <div class="mt-8 bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6 group">
                        <div class="flex items-center">
                            <div class="text-lg leading-7 font-semibold">
                                <i
                                    class="fas fa-user mr-2 text-blue-400 group-hover:text-blue-600 transition duration-200"></i>
                                <span class="group-hover:text-blue-400 transition duration-200">About Me</span>
                            </div>
                        </div>

                        <div class="mt-2 ml-6 text-gray-400 text-sm group-hover:text-gray-300 transition duration-200">
                            <p>Hugo Torres, with 7+ years in Minecraft development, excels in creating Minecraft plugins, Discord bots, and server configurations. His expertise ensures unique, tailored solutions that enhance gaming and community experiences. Elevate your digital project by leveraging Hugo's skills for unmatched innovation and satisfaction. Contact Hugo today to transform your Minecraft or Discord environment.</p>
                        </div>
                    </div>

                    <div class="p-6 group">
                        <div class="flex items-center">
                            <div class="text-lg leading-7 font-semibold">
                                <i class="fas fa-code mr-2 text-green-400 group-hover:text-green-600 transition duration-200"></i>
                                <span class="group-hover:text-green-400 transition duration-200">Contact me</span>
                            </div>
                        </div>

                        <div class="mt-2 ml-6 text-gray-400 text-sm group-hover:text-gray-300 transition duration-200">
                            <div class="grid grid-cols-4 justify-center gap-3">

                                <span class="inline-flex justify-center items-center m-2 p-2 bg-gray-900 rounded-full h-16 w-16 transition duration-200 ease-in-out transform hover:-translate-y-1 hover:scale-110 hover:bg-purple-400 hover:shadow-lg hover:shadow-purple-400/50">
                                    <a href="https://github.com/Reddishye"><i class="fab fa-github text-2xl transition ease-in-out duration-400 hover:text-white"></i></a>
                                </span>

                                <span class="inline-flex justify-center items-center m-2 p-2 bg-gray-900 rounded-full h-16 w-16 transition duration-200 ease-in-out transform hover:-translate-y-1 hover:scale-110 hover:bg-purple-400 hover:shadow-lg hover:shadow-purple-400/50">
                                    <a href="https://bsky.app/profile/redactado.es"><i class="fa-brands fa-twitter text-2xl transition ease-in-out duration-400 hover:text-white"></i></a>
                                </span>

                                <span class="inline-flex justify-center items-center m-2 p-2 bg-gray-900 rounded-full h-16 w-16 transition duration-200 ease-in-out transform hover:-translate-y-1 hover:scale-110 hover:bg-purple-400 hover:shadow-lg hover:shadow-purple-400/50">
                                    <a href="https://redactado.es/links/discord"><i class="fa-brands fa-discord text-2xl transition ease-in-out duration-400 hover:text-white"></i></a>
                                </span>

                                <span class="inline-flex justify-center items-center m-2 p-2 bg-gray-900 rounded-full h-16 w-16 transition duration-200 ease-in-out transform hover:-translate-y-1 hover:scale-110 hover:bg-purple-400 hover:shadow-lg hover:shadow-purple-400/50">
                                    <a href="mailto:contact@redactado.es"><i class="fa-solid fa-paper-plane text-2xl transition ease-in-out duration-400 hover:text-white"></i></a>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projects Section -->
                <div class="p-6 border-t border-gray-700 group mt-12">
                    <div class="flex items-center">
                        <div class="text-lg leading-7 font-semibold">
                            <i
                                class="fas fa-tasks mr-2 text-yellow-400 group-hover:text-yellow-600 transition duration-200"></i>
                            <span class="group-hover:text-yellow-400 transition duration-200">Projects</span>
                        </div>
                    </div>

                    <div class="mt-2 ml-6 text-gray-400 text-sm group-hover:text-gray-300 transition duration-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($projects as $project)
                                <div class="bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200 ease-in-out transform hover:scale-105">
                                    <h3 class="text-lg font-semibold">{{ $project->name }} <span class="px-2 ml-2 inline-flex text-xs leading-5 font-semibold transition duration-200 ease-in-out transform rounded-md bg-gray-700 border-2 select-none border-gray-500 text-gray-400 hover:border-indigo-300 hover:text-indigo-400 hover:shadow-lg">{{ $project->version }}</span></h3><span class="px-2 inline-flex text-xs leading-5 font-semibold absolute top-0 right-0 mt-2 mr-2 rounded-full bg-gray-800 border-dashed border-2 select-none @if ($project->status === 'active') border-green-200 @elseif ($project->status === 'inactive') border-red-200 @elseif ($project->status === 'archived') border-yellow-300 @elseif ($project->status === 'soon') border-orange-300 @endif">@if ($project->status === 'active') ⭐ Active @elseif ($project->status === 'inactive') 💀 Inactive @elseif ($project->status === 'archived') 📦 Archived @elseif ($project->status === 'soon') 👀 Soon @endif</span>
                                    <p class="mt-1">{{ $project->description }}</p>
                                    <div class="mt-2">
                                        <span class="text-sm font-medium text-gray-400">Authors:</span>
                                        <ul class="mt-1 ml-4 list-disc">
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
                <div class="text-center text-sm text-gray-400 sm:text-left">
                    <div class="flex items-center">
                        <span>Developed with</span>
                        <i class="fas fa-heart mx-1 text-red-500"></i>
                        <span>by Hugo Torres</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>

</html>
