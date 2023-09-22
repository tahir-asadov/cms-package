<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @vite(['resources/css/tacms.css'])
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'TACMS Public') }}</title>
    </head>
    <body class="font-sans antialiased">
    @yield('content')
    @vite(['resources/js/tacms.js'])
    </body>
</html>
