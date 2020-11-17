<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @php
          $theme = $raffle->theme ?? 'default';
        @endphp
        <link rel="stylesheet" href="{{ asset( $theme.'/theme.css') }}">


        @livewireStyles

        <!-- Scripts -->
        @jquery

    </head>
    <body class="fullpage">

            <!-- Page Content -->
            {{ $slot }}


        @livewireScripts

    </body>
</html>
