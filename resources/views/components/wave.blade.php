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
    <style>
        @keyframes move_wave {
            0% {
                transform: translateX(0) translateZ(0) scaleY(1);
            }
            50% {
                transform: translateX(-25%) translateZ(0) scaleY(0.55);
            }
            100% {
                transform: translateX(-50%) translateZ(0) scaleY(1);
            }
        }

        .waveWrapper {
            overflow: hidden;
            position: fixed; /* Fixed positioning */
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Ensures wave animation is behind other content */
        }

        .waveWrapperInner {
            position: absolute;
            width: 100%;
            overflow: hidden;
            height: 100%;
            bottom: -1px;
            background-image: linear-gradient(to top, #ffafcc 20%, #ffc8dd 80%);
        }
         /* to top, #86377b 20%, #e6b079 80% very nice color palette like GTA 6 */ ?>

        .bgTop {
            z-index: 15;
            opacity: 0.5;
        }

        .bgMiddle {
            z-index: 10;
            opacity: 0.75;
        }

        .bgBottom {
            z-index: 5;
        }

        .wave {
            position: absolute;
            left: 0;
            width: 200%;
            height: 100%;
            background-repeat: repeat no-repeat;
            background-position: 0 bottom;
            transform-origin: center bottom;
        }

        .waveTop {
            background-size: 50% 100px;
        }

        .waveAnimation .waveTop {
            animation: move_wave 10s linear infinite;
        }

        .waveMiddle {
            background-size: 50% 120px;
        }

        .waveAnimation .waveMiddle {
            animation: move_wave 20s linear infinite;
        }

        .waveBottom {
            background-size: 50% 100px;
        }

        .waveAnimation .waveBottom {
            animation: move_wave 45s linear infinite;
        }
        .bgblue {
            background: linear-gradient(to bottom, #fafabe 20%, #fafabe 80%);
            background-color: #BED2D5;
        }
    </style>
</head>
<div class="waveWrapper waveAnimation">
    <div class="waveWrapperInner bgTop">
        <div class="wave waveTop" style="background-image: url('https://i.imghippo.com/files/zHasl1716367612.png')"></div>
    </div>
    <div class="waveWrapperInner bgMiddle">
        <div class="wave waveMiddle" style="background-image: url('https://i.imghippo.com/files/2d2rw1716367581.png')"></div>
    </div>
    <div class="waveWrapperInner bgBottom">
        <div class="wave waveBottom" style="background-image: url('https://i.imghippo.com/files/nGrn91716367464.png')"></div>
    </div>
</div>