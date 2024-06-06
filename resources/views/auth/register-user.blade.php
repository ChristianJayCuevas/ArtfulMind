<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/login_register.css') }}">

        <!-- Inline CSS -->
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<x-guest-layout>
    <form method="POST" action="{{ route('register-user') }}">
        @csrf
        <div class="formcontainer">
            <div class="form_area">
                <p class="title">SIGN UP</p>
                <form action="">
                    <div class="form_group">
                        <label class="sub_title" for="name">Name</label>
                        <x-text-input placeholder="Enter your name" id="name" name="name" :value="old('name')" required autofocus autocomplete="name"  class="form_style" type="text" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="form_group">
                        <label class="sub_title" for="email">Email</label>
                        <x-text-input placeholder="Enter your email" id="email" class="form_style" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="form_group">
                        <label class="sub_title" for="password">Password</label>
                        <x-text-input placeholder="Enter your password" id="password" class="form_style" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="form_group">
                        <label class="sub_title" for="password_confirmation">Confirm Password</label>
                        <x-text-input placeholder="Enter password again" id="password_confirmation" class="form_style" type="password" name="password_confirmation"  required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div>
                        <button class="btn">SIGN UP</button>
                        <p>Have an Account? <a class="link" href="">Login Here!</a></p>
                        <a class="link" href=""></a>
                    </div><a class="link" href=""></a>
                </form>
            </div>
            <a class="link" href=""></a>
        </div>
    </form>
</x-guest-layout>
