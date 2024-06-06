
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />
        <style>
            .pastelbg {
                background-color: #fdecdf;
            }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="font-sans antialiased"  style="background-image: linear-gradient(to top, #efd6d5 20%, #efd6d5 80%)">
        @include('layouts.navigation')

            <!-- Page Heading -->
        <!--
        @if (isset($header))
            <header class="pastelbg dark:bg-gray-800 ">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                    {{ $header }}
                    <a href="/create">Create Post</a>
                </div>

            </header>
        @endif
        -->
            <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
