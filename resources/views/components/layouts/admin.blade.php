<!DOCTYPE html>
<html x-data="{ theme: 'light' }" x-bind:class="theme" lang="en">

<head class='dark'>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Admin Pawonkoe' }}</title>
    <style>
        @layer base {
            html {
                color-scheme: light !important;
            }
        }

        .cover-image {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>

    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">

    @include('partials.dashboard.link')
    {{-- jquery --}}



    <style>
        /* Add this in your CSS or within a style tag in your HTML */
        .costumscroll::-webkit-scrollbar {
            width: 8px;
            /* Set the width of the scrollbar */
        }

        .costumscroll::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            /* Set the color of the thumb (the draggable part) */
            border-radius: 8px;
            /* Set the border-radius of the thumb */
        }

        .costumscroll::-webkit-scrollbar-track {
            background-color: #f1f1f1;
            /* Set the color of the track (the non-draggable part) */
        }
    </style>
    @livewireStyles()
</head>

<body>

    <div class="flex w-screen h-screen bg-gray-100 " x-on:DOMContentLoaded="theme = 'light'" x-data="{ isSideMenuOpen: false, theme: 'light' }">
        {{-- @include('partials.sidenav') --}}
        @include('partials.dashboard.sidenav')
        <div class="flex flex-col flex-1 w-full">
            @include('partials.dashboard.header')
            {{-- @include('partials.header') --}}
            <main class="h-full overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
    @extends('partials.dashboard.link')
    {{-- @extends('partials.link') --}}
    @livewireScripts()
    <script>
        localStorage.theme = 'light'
    </script>
</body>

</html>
