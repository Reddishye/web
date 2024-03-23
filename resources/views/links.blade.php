<x-guest-layout>
    <div class="bg-gray-700 min-h-screen">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @php
                    $groupedLinks = $links
                        ->where('enabled', true)
                        ->sortBy('path')
                        ->groupBy(function ($item) {
                            $pathParts = explode('/', $item['path']);
                            return count($pathParts) > 1 ? $pathParts[0] : '';
                        });
                @endphp

                <div class="lg:col-span-1">
                    @foreach ($groupedLinks as $group => $groupLinks)
                        @if ($loop->odd)
                            @if ($group === '')
                                @foreach ($groupLinks as $link)
                                    <a href="{{ $link->link }}" class="md:rounded-lg">
                                        <div class="bg-white dark:bg-gray-800 p-4 md:rounded-lg shadow mb-5 transition duration-200 ease-in-out transform hover:border-2 hover:border-indigo-600 dark:hover:border-indigo-400 hover:border-dashed" style="box-sizing: border-box;">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0">
                                                    <i class="{{ $link->fa_icon }}" style="color: {{ $link->color }};"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                                        {{ $link->name }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                        {{ $link->link }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div x-data="{ open: false }" class="mb-5">
                                    <button @click="open = !open" class="w-full text-left cursor-pointer bg-gray-300 dark:bg-gray-600 p-4 md:rounded-lg shadow transition-all duration-300" :class="{ 'rounded-b-none': open }">
                                        <div class="flex justify-between items-center">
                                            <span class="font-medium text-gray-900 dark:text-white">{{ ucfirst($group) }}</span>
                                            <svg :class="{ 'rotate-180': open, 'rotate-0': !open }" class="h-5 w-5 transform transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                    <div x-show="open" x-collapse.duration.500ms x-collapse.group class="bg-white dark:bg-gray-800 md:rounded-b-lg shadow-inner">
                                        <div class="p-4 space-y-4">
                                            @foreach ($groupLinks as $link)
                                                <a href="{{ $link->link }}" class="md:rounded-lg">
                                                    <div class="bg-white dark:bg-gray-800 p-4 md:rounded-lg shadow mb-5 transition duration-200 ease-in-out transform hover:border-2 hover:border-indigo-600 dark:hover:border-indigo-400 hover:border-dashed" style="box-sizing: border-box;">
                                                        <div class="flex items-center space-x-4">
                                                            <div class="flex-shrink-0">
                                                                <i class="{{ $link->fa_icon }}" style="color: {{ $link->color }};"></i>
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                                                    {{ $link->name }}
                                                                </p>
                                                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                                    {{ $link->link }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>

                <div class="lg:col-span-1">
                    @foreach ($groupedLinks as $group => $groupLinks)
                        @if ($loop->even)
                            @if ($group === '')
                                @foreach ($groupLinks as $link)
                                    <a href="{{ $link->link }}" class="md:rounded-lg">
                                        <div class="bg-white dark:bg-gray-800 p-4 md:rounded-lg shadow mb-5" style="box-sizing: border-box;">
                                            <div class="flex items-center space-x-4 transition duration-200 ease-in-out transform hover:bg-indigo-600 dark:hover:bg-indigo-400">
                                                <div class="flex-shrink-0">
                                                    <i class="{{ $link->fa_icon }}" style="color: {{ $link->color }};"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                                        {{ $link->name }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                        {{ $link->link }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div x-data="{ open: false }" class="mb-5">
                                    <button @click="open = !open" class="w-full text-left cursor-pointer bg-gray-300 dark:bg-gray-600 p-4 md:rounded-lg shadow transition-all duration-300" :class="{ 'rounded-b-none': open }">
                                        <div class="flex justify-between items-center">
                                            <span class="font-medium text-gray-900 dark:text-white">{{ ucfirst($group) }}</span>
                                            <svg :class="{ 'rotate-180': open, 'rotate-0': !open }" class="h-5 w-5 transform transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                    <div x-show="open" x-collapse.duration.500ms x-collapse.group class="bg-white dark:bg-gray-800 md:rounded-b-lg shadow-inner">
                                        <div class="p-4 space-y-4">
                                            @foreach ($groupLinks as $link)
                                                <a href="{{ $link->link }}" class="md:rounded-lg">
                                                    <div class="bg-white dark:bg-gray-800 p-4 md:rounded-lg shadow mb-5" style="box-sizing: border-box;">
                                                        <div class="flex items-center space-x-4 transition duration-200 ease-in-out transform hover:bg-indigo-600 dark:hover:bg-indigo-400">
                                                            <div class="flex-shrink-0">
                                                                <i class="{{ $link->fa_icon }}" style="color: {{ $link->color }};"></i>
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                                                    {{ $link->name }}
                                                                </p>
                                                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                                    {{ $link->link }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
