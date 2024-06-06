<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />
    
        <!-- Inline CSS -->
        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/css/card.css', 'resources/js/app.js'])
    </head>
<div class="cardcontainer">
    <div class="card_area">
        <div class="titlecard">
            {{ $title }}
        </div>
            <label class="sub_titlecard" {{ $attributes }}>
                {{ $sub_title }}
            </label>
            <div class="form_group">
                {{ $form_group }}
            </div>
            {{ $slot }}
            
        </div>
    </div>
</div>

