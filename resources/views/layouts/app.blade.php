<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel E-commerce Website') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body>
@include('layouts.navigation')
<main class="bg-white">
    <div class="w-full mx-auto">
        <div class="hero mx-auto w-full h-[100vh] flex items-center justify-center" style="background-image: url('images/bg-image.png'); background-size: cover; background-position: center; background-repeat: no-repeat")>
            <div class="bg-white bg-opacity-75 shadow-sm w-[730px] h-[349px] flex flex-col items-center lg:px-20 mx:px-8 sm:p-8 py-6">
                <p class="text-3xl">🌱</p>
                <h1 class="text-3xl mt-3">The nature candle</h1>
                <p class="text-center text-lg text-gray-900 mt-4">All handmade with natural soy wax, Candleaf is a companion for all your pleasure moments </p>
                <button class="bg-green-400 py-2 px-12 text-white rounded-md mt-12">Discovery our collection</button>
            </div>
        </div>
    </div>
    <div class="max-w-[1440px] mx-auto">
        {{ $slot }}
    </div>
</main>

<!-- Toast -->
<div
    x-data="toast"
    x-show="visible"
    x-transition
    x-cloak
    @notify.window="show($event.detail.message, $event.detail.type || 'success')"
    class="fixed w-[400px] left-1/2 -ml-[200px] top-16 py-2 px-4 pb-4 text-white"
    :class="type === 'success' ? 'bg-emerald-500' : 'bg-red-500'"
>
    <div class="font-semibold" x-text="message"></div>
    <button
        @click="close"
        class="absolute flex items-center justify-center right-2 top-2 w-[30px] h-[30px] rounded-full hover:bg-black/10 transition-colors"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"
            />
        </svg>
    </button>
    <!-- Progress -->
    <div>
        <div
            class="absolute left-0 bottom-0 right-0 h-[6px] bg-black/10"
            :style="{'width': `${percent}%`}"
        ></div>
    </div>
</div>
<!--/ Toast -->
</body>
</html>
