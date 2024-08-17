<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hugo Torres - Developer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @filamentStyles
    <meta charset="UTF-8">
    <meta name="description" content="Discover the portfolio of Hugo Torres, an expert developer in Laravel, Minecraft plugins, Discord bots, and Minecraft server configuration.">

    <!-- Discord -->
    <meta property="og:site_name" content="Hugo Torres, Developer">

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

    <!-- Extra Fonts -->
    <link href="{{ asset('fonts/Inconsolata-Regular.woff2') }}" rel="font/woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wdth,wght@50..200,200..900&display=swap" rel="stylesheet">

</head>
    <body class="antialiased text-gray-900 transition duration-200 bg-gray-100 dark:bg-black dark:text-white">
        <div class="font-sans">
            {{ $slot }}
        </div>

        @livewireScripts
        @filamentScripts
        <script>            function copyToClipboard(event, text) {
            event.preventDefault();
            navigator.clipboard.writeText(text).then(function() {
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }</script>


<script async defer src="https://api.redactado.es/latest.js"></script>
<noscript><img src="https://api.redactado.es/noscript.gif" alt="" referrerpolicy="no-referrer-when-downgrade" /></noscript>
    </body>
</html>
