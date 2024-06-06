<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/login_register.css') }}">
    </head>
<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="formcontainer">
            <div class="form_area ">
                <p class="title">LOG IN</p>
                <form action="">
                    <div class="form_group">
                            <label class="sub_title" for="email">Email</label>
                            <x-text-input placeholder="Enter your email" id="email" class="form_style" type="email" name="email" :value="old('email')" required autocomplete="username">
                            </x-text-input>
                            <x-input-error :messages="$errors->get('email')" class="mt-2">
                            </x-input-error>
                    </div>
                    <div class="form_group">
                        <label class="sub_title" for="password">Password</label>
                        <x-text-input placeholder="Enter your password" id="password" class="form_style" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div>
                        <button class="btn">LOGIN</button>
                        <p>Don't have an Account? <a class="link" href="/register">Register Here!</a></p>
                    </div>
            </form>
        </div>
        </form>

</x-guest-layout>
