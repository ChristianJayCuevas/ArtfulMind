
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/videolanding.css') }}">

        <!-- Inline CSS -->
        <style>
            .pastelbg1 {
                background-color: #577371;
            }

        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-gray-900 antialiased backgroundColor">
        <!-- Content -->
        <nav x-data="{ open: false }" class="pastelbg1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="/">
                                {{-- <x-application-logo class="block w-11 h-11 fill-current"> </x-application-logo> --}}
                                <h1 class="fontforlogo">Artful Mind</h1>
                            </a>
                        </div>

                        @auth
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex ">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        </div>
                        @endauth
                        <!-- Navigation Links -->
                    </div>
                    <div class="flex">
                        
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex " >
                            <x-nav-link :href="route('login')">
                                    {{ __('Login') }}
                            </x-nav-link>

                            <x-nav-link :href="route('register')">
                                {{ __('Register') }}
                            </x-nav-link>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <section class="showcase">
            <div class="video-container">
                <video src="{{ asset('storage/videos/samplevid.mp4') }}" autoplay muted loop></video>
            </div>
            <div class="content">
                <h1 class="titleforvideo">Care for your mental health</h1>
                <h3>Let a therapist assess your artwork</h3>
                <a href="#about" class="btn">Get Started</a>
            </div>
        </section>
        <x-dashboard-card> HELLLLLOOOOOOOOOOOOOO </x-dashboard-card>
        <!-- Main Content -->
    </body>
</html>
