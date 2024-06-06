<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">

    <!-- Inline CSS -->
    <style>
         .pastelbg1 {
            background-color: #fdecdfaf;
        }
    </style>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.card_area3').forEach(function (element) {
                element.addEventListener('click', function (event) {
                    // Check if the click was on the profile link, if not navigate to the post URL
                    if (!event.target.closest('a')) {
                        window.location.href = element.getAttribute('data-post-url');
                    }
                });
            });
        });
    </script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<x-app-layout>
    <!-- Main Content Area -->

    <div class="text-base md:text-lg md:flex-row flex justify-center flex-col flex-1">
        <!-- Sidebar Navigation -->
       <div class="flex justify-center">
           <x-side-navigation></x-side-navigation>
       </div>
       <div class="flex-col border-solid border-transparent rounded-3xl cursor-pointer mt-12 mx-3">
           @if($posts->isEmpty())
               <div class="card_area2 flex justify-center items-center flex-col min-w-min">
                   <div class="titlecard">
                       No posts yet :(
                   </div>
                   <div class="sub_titlecard">
                       Create a post to share your thoughts
                   </div>
                   <img class="rounded" src="{{ asset('storage/images/EmptyLogo.png') }}">
               </div>
           @endif
           @foreach ($posts as $post)
               <x-card :post="$post"></x-card>
           @endforeach
           {{ $posts->links() }}
       </div>

       <div class="flex justify-start flex-col mt-5 w-80">
           <form action="{{ route('dashboard') }}" method="GET">
               <div class="card_area2">
                   <div class="sub_titlecard">
                       Search
                   </div>
                   <input type="search" name="search" id="default-search" class="block p-3 ps-5 text-sm card-area2-search" style="margin-bottom:10px;" placeholder="Search Posts" required />
                   <x-primary-button>Search</x-primary-button>
               </div>
           </form>

           <div class="card_area3" data-post-url="{{ route('createPost') }}">
               <div class="sub_titlecard2">
                   <a href="{{ route('createPost') }}">Create Post +</a>
               </div>
           </div>
       </div>
   </div>

<!--  -->
</x-app-layout>
