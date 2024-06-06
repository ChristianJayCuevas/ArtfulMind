<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/sidenavigation.css') }}">
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('.nav li').forEach(function (el) {
                el.addEventListener('click', function () {
                    document.querySelectorAll('.nav li').forEach(function (li) {
                        li.classList.remove('active');
                    });
                    el.classList.add('active');
                });
            });
        });
    </script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="nav_container h-[15.7rem] flex flex-col w-72 mt-5 rounded-3xl">
        <ul class="nav">
            <li class="rounded-t-3xl active">
                <a class="rounded-t-3xl" href="{{ route('dashboard') }}">
                    <span class="icon-home"></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/draw">
                    <span class="icon-user"></span>
                    <span class="text">Draw</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon-headphones"></span>
                    <span class="text">Audio</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon-picture"></span>
                    <span class="text">Portfolio</span>
                </a>
            </li>
            <li class="rounded-b-3xl ">
                <a class="rounded-b-3xl" href="#">
                    <span class="icon-facetime-video"></span>
                    <span class="text">video</span>
                </a>
            </li>
        </ul>
    </div>

<!--   <div class="nav_container h-[17.8rem] flex flex-col w-72 mt-5 rounded-3xl">
        <ul class="list-none m-0 p-0 ">
            <li class="h-14 rounded-t-3xl relative flex items-center justify-start w-full">
                <a class="anchorTag" href="#">
                    <span class="icon-home"></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="h-14 relative bg-yellow-200 flex items-center justify-start w-full">
                <a class="anchorTag" href="/draw">
                    <span class="icon-user"></span>
                    <span class="text">Draw</span>
                </a>
            </li>
            <li class="h-14 relative bg-yellow-200 flex items-center justify-start w-full">
                <a class="anchorTag" href="#">
                    <span class="icon-headphones"></span>
                    <span class="text">Audio</span>
                </a>
            </li>
            <li class="h-14 relative bg-yellow-200 flex items-center justify-start w-full">
                <a class="anchorTag" href="#">
                    <span class="icon-picture"></span>
                    <span class="text">Portfolio</span>
                </a>
            </li>
            <li class="h-14 rounded-b-3xl relative bg-yellow-200 flex items-center justify-start w-full">
                <a class="anchorTagLast" href="#">
                    <span class="icon-facetime-video"></span>
                    <span class="text">video</span>
                </a>
            </li>
        </ul>
    </div>
 -->
</body>
</html>

