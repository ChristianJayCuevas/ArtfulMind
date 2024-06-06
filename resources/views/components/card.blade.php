
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    use App\Models\User;
    $name = User::find($post->USER_ID)->name;
    $profile = User::find($post->USER_ID)->profile_photo_path;
@endphp
 <!-- Add consistent margin to each card -->
<div class="flex flex-col rounded-3xl p-5 mb-4 cursor-pointer card_area4 w-[36rem] min-w-full" data-post-url="/post/{{$post->id}}">
     <!-- Add flex container to align profile picture and name -->
    <div class="flex justify-start items-start flex-row">

        <div class="profile-picture mr-2 mb-3">
            @if($profile==null)
            <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
            </div>
            @else
            <img class="rounded-full w-10 h-10" src="{{ asset('storage/'.$name->image_url) }}">
            @endif
        </div>
        <div class="profile-name p-1" style="text-align:left ">
            <a href="/user/{{$post->USER_ID}}" class="text-black-600 hover:underline font-bold">
                {{$name}}
            </a>
        </div>
    </div>
    <div class="flex justify-start items-start flex-row">
        <div dir="ltr">
            <div>
                <h1 class="titlecard font-bold text-2xl p-2 ml-3">
                    {{ $post->title }}
                </h1>
            </div>
            @if($post->image_url == null)
                <div class="sub_titlecard p-2">
                    <p class="description">
                        {{$post->description}}
                    </p>
                </div>
            @endif
        </div>
    </div>
    @if($post->image_url)
        <div class="max-w-full px-4 mt-4">
            <img class="rounded w-full" src="{{ asset('storage/'. $post->image_url) }}">
        </div>
    @endif
    <div class="flex justify-between ">
        @include('components.heart-button')
        <div class="sub_titlecard">{{ $post->created_at->diffForHumans() }}</div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.card_area4').forEach(function (element) {
            element.addEventListener('click', function (event) {
                // Check if the click was on the profile link or inside it
                if (!event.target.closest('a')) {
                    window.location.href = element.getAttribute('data-post-url');
                }
            });
        });
    });
</script>
