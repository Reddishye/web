<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-8 md:py-12">
        <!-- back to homepage button, top left, hidden on mobile -->
        <a href="/" class="hidden md:block absolute top-4 left-4 text-zinc-500 dark:text-gray-400 hover:text-white transition duration-200 ease-in-out">
            <i class="fas fa-arrow-left"></i> <span class="font-bold ml-2 font-inconsolata">Back to Home</span>
        </a>
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-black dark:text-white mb-8 md:mb-12 text-center" style="font-family: 'gg sans', 'Noto Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;">
            Hugo Torres
        </h1>
        <div class="w-full max-w-4xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 justify-items-center">
                @foreach ($links as $link)
                    <livewire:guest.link.body :link="$link"/>
                @endforeach
            </div>
            <livewire:guest.link.back :backLink="$previousPath"/>

            <!-- Back to Home link for mobile, at the bottom -->
            <div class="mt-8 md:hidden">
                <a href="/" class="text-zinc-500 dark:text-gray-400 hover:text-white transition duration-200 ease-in-out">
                    <i class="fas fa-arrow-left"></i> <span class="font-bold ml-2 font-inconsolata">Back to Home</span>
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
