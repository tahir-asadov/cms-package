<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @vite(['resources/css/tacms.css'])
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'TACMS Private') }}</title>
    </head>
    <body class="font-sans antialiased">
    @yield('content')
    @vite(['resources/js/tacms.js'])
    </body>
</html>
