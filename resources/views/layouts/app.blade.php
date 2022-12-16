<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>MC Dashboard | @yield('title')</title>

        @include('components.css')
    </head>
    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        @include('components.sidebar')

        <main class="main-content position-relative border-radius-lg">
            @include('components.navbar')

            <div class="container-fluid py-4">
                @yield('content')

                @include('components.footer')
            </div>
        </main>

        @include('components.js')
    </body>
</html>
