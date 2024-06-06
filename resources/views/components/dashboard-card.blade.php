
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />
    <style>
      .container {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
      z-index:1;
      }

      .form_area {
        width: auto;
        background: #577371;
        padding: 1rem;
        border-radius: 1rem;
        border: 0.5vmin #05060f;
        box-shadow: 0.4rem 0.4rem gray;
        overflow: hidden;
        color: gray; 
        z-index:1;
        margin-top:20px;
      }

      .title {
      color: #fff;
      font-weight: 900;
      font-size: 1.5em;
      margin-top: 20px;
      margin-bottom: 20px;
      margin-right: 20px;
      margin-left: 20px;
      }

      .sub_title {
      font-weight: 600;
      margin: 5px 0;

      }

      
  </style>
    
 @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
  <div class="container">
    <div class="form_area">
      <div class="title">{{ $slot }}</div>
    </div>
  </div>
               

    