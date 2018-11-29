<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fictionary') }}</title>

    <link href="{{ webpack('styles', 'css') }}" rel="stylesheet">

    @yield('styles')
</head>
<body>

    @yield('layout')

    @yield('scripts')
</body>
</html>
