<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shea.254 offers a wide range of the best skincare products such as essential oils, shea butter, cocoa butter, carrier oils and body butters.">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/jpg" href="{{ asset('assets/images/logo.jpg') }}">
    <link rel="stylesheet" href="{{ asset('assets/icons/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    @yield('head')
    @vite(['resources/css/styles.css', 'resources/js/app.js'])
    <title>{{ config('app.name') }}</title>
</head>
<body>
    @yield('content')
    @include('partials.javascripts')
</body>
</html>
