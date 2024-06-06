<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/login_register.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
        @csrf

        <div class="formcontainer">
            <div class="form_area">
                <p class="title">REGISTER AS: </p>
                <form method="POST">
                    @csrf
                    <div class = "sub_title" style="margin-top:20px">
                        <x-cute-link  class="ms-4" href="{{ route('register-user') }}">
                            {{ __('Register as User') }}
                        </x-cute-link >
                        <x-cute-link class="ms-4" href="{{ route('register-therapist') }}">
                            {{ __('Register as Therapist') }}
                        </x-cute-link >
                    </div>
                    <div>
                        <p style="margin-top:20px">Have an Account? <a class="link" href="">Login Here!</a></p>
                    </div>
                </form>
            </div>
        </div>
</x-guest-layout>
