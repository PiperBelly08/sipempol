<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'SIPEMPOL') }} - @yield('title', 'Dashboard')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('meta')
    @include('layouts.primary-library')

    @stack('styles')
    @stack('scripts-defer')
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html>
