<div class="container">
<div>
    <div class="m-4 max-w-80 max-h-24">
        <!-- Card -->
        <div class="border border-gray-300 dark:border-stone-600 rounded-lg shadow-sm antialiased p-3 relative transition duration-300 ease-in-out hover:shadow-md cursor-pointer"
             x-data="{ hover: false }"
             x-on:mouseenter="hover = true"
             x-on:mouseleave="hover = false"
             x-bind:style="hover ? `border-color: {{ $link->color }}; box-shadow: 0 0 10px 2px {{ $link->color }}40;` : ''"
             @if ($actionType != 'onlyview')
             x-on:click="handleLinkAction('{{ $link->link }}', '{{ $link->name }}')"
             @endif
             >
            <!-- Action Icon -->
            <div class="absolute top-1 right-1 mr-2">
                <i class="fas
                    @if ($actionType === 'copy') fa-copy
                    @elseif ($actionType === 'newwindow') fa-external-link-alt
                    @elseif ($actionType === 'route') fa-link
                    @elseif ($actionType === 'onlyview') fa-eye
                    @else fa-link
                    @endif
                    text-gray-400 text-xs"></i>
            </div>
            <!-- Main Content -->
            <div class="flex h-full items-center space-x-4">
                <!-- Icon -->
                <div class="flex-none">
                    <i class="fas {{ $link->fa_icon }} text-3xl" style="color: {{ $link->color }};"></i>
                </div>
                <!-- Title -->
                <div class="flex-grow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-zinc-200">{{ $link->name }}</h3>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleLinkAction(link, name) {
            if ('{{ $actionType }}' === 'copy') {
                const textToCopy = link;
                navigator.clipboard.writeText(textToCopy).then(() => {
                    alert(`Texto "${textToCopy}" copiado al portapapeles`);
                });
            } else if ('{{ $actionType }}' === 'newwindow') {
                window.open(link, '_blank');
            } else if ('{{ $actionType }}' === 'route') {
                window.location.href = route(link);
            } else if ('{{ $actionType }}' === 'onlyview') {
                // does nothing!
            } else {
                window.location.href = link;
            }
        }
    </script>
</div>
</div>
