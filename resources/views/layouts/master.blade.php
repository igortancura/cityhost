<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @section('title')
            CityHost -
        @show</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')
</head>
<body>
@yield('body')
@yield('foot')
</body>
</html>
