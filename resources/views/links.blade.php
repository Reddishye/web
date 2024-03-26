<x-guest-layout>
    <div class="min-h-screen bg-gray-900 flex flex-col justify-center items-center">
        <h1 class="text-8xl font-extrabold text-white mb-20" style="font-family: 'gg sans', 'Noto Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
            Hugo Torres
        </h1>
        <div class="max-w-lg mx-auto w-full">
            @if ($isSection)
                <div class="mb-8">
                    <h2 class="text-3xl font-semibold text-white mb-4">{{ ucfirst($currentCategory['case']) }}</h2>
                    @if ($parentCategory)
                        <a href="{{ $parentCategory['url'] }}" class="text-gray-400 hover:text-white mb-4 block transition duration-200 ease-in-out">
                            <i class="fas fa-arrow-left mr-2"></i> Back to {{ ucfirst($parentCategory['path']) }}
                        </a>
                    @endif
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($links as $link)
                    @if (!$isSection || !str_contains($link->path, '/'))
                        @php
                            $linkUrl = $link->link;
                            $linkTarget = '_self';
                            $linkOnClick = null;
                            $linkText = $link->link;

                            if (Str::startsWith($link->link, 'copy:')) {
                                $textToCopy = substr($link->link, 5);
                                $linkUrl = '#';
                                $linkOnClick = "copyToClipboard(event, '$textToCopy')";
                                $linkText = $textToCopy;
                            } elseif (Str::startsWith($link->link, 'newwindow:')) {
                                $linkUrl = substr($link->link, 10);
                                $linkTarget = '_blank';
                                $linkText = $linkUrl;
                            } elseif (Str::startsWith($link->link, 'route:')) {
                                $routeName = substr($link->link, 6);
                                $linkUrl = route($routeName);
                                $linkText = $routeName;
                            } elseif ($link->link === 'onlyview') {
                                $linkUrl = '#';
                                $linkOnClick = 'return false;';
                                $linkText = 'View Only';
                            }
                        @endphp

                        <div class="bg-gray-800 rounded-lg shadow-md transition duration-200 ease-in-out hover:bg-gray-700 hover:shadow-lg">
                            <a href="{{ $linkUrl }}" target="{{ $linkTarget }}" onclick="{{ $linkOnClick }}" class="block p-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class="{{ $link->fa_icon }} text-3xl" style="color: {{ $link->color }};"></i>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-xl font-semibold text-white truncate">
                                            {{ $link->name }}
                                        </p>
                                        <p class="text-sm text-gray-400 truncate">
                                            {{ Str::limit($linkText, 20, '...') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif ($isSection && str_contains($link->path, '/'))
                        <div class="bg-gray-800 rounded-lg shadow-md transition duration-200 ease-in-out hover:bg-gray-700 hover:shadow-lg">
                            <a href="{{ url()->current() . '?category=' . urlencode(explode('/', $link->path)[0]) }}" class="block p-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-folder text-3xl text-gray-500"></i>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-xl font-semibold text-white truncate">
                                            {{ ucfirst(explode('/', $link->path)[0]) }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @livewire('theme-switcher')
</x-guest-layout>
