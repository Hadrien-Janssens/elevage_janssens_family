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


    <!-- Google tag (gtag.js) -->
    @if (request()->cookie('analytics_consent') === 'yes')
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-01R6T4ZEX5"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-01R6T4ZEX5');
        </script>
    @endif
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
