<div>
    @if ($backLink)
        <div class="mt-6 mb-6">
            <a href="{{ route('links.user', ['path' => $backLink]) }}"
               class="inline-flex items-center px-4 py-2 bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 rounded-lg shadow-md hover:bg-zinc-200 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                <i class="fas fa-chevron-left mr-2"></i>
                <span class="font-semibold font-inconsolata">Back</span>
            </a>
        </div>
    @endif
</div>
