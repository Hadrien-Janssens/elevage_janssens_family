<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        html {
            background-color: oklch(1 0 0);
        }
    </style>

    <title inertia>{{ config('app.name') }}</title>
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @routes
    @vite(['resources/js/app.ts'])
    @inertiaHead


    <?php
    
    $cookieConsent = request()->cookie('analytics_consent');
    echo '<script>console.log("Cookie consent: ' . $cookieConsent . '");</script>';
    if ($cookieConsent === 'yes') {
        echo '<script>console.log("Google Analytics loaded");</script>';
    } else {
        echo '<script>console.log("Google Analytics not loaded");</script>';
    }
    ?>

    {{-- @if (request()->cookie('analytics_consent') === 'yes') --}}


    <!-- Google tag (gtag.js) -->


    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NMF8WZ840F"></script>
    <script>
        console.log('Google Analytics loaded');
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-NMF8WZ840F');
        console.log('Google Analytics loaded2');
    </script>
    {{-- @endif --}}
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
