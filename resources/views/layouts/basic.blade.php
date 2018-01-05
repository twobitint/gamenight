<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Gamenight</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> --}}

    </head>
    <body>

        @yield('body')

    </body>
</html>
