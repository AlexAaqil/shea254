<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @isset($extra_head)
            {{ $extra_head }}
        @endisset

        @vite(['resources/css/styles.css', 'resources/js/app.js'])
        
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        {{ $slot }}

        @isset($javascript)
            {{ $javascript }}
        @endisset

        <x-alert></x-alert>
    </body>
</html>
