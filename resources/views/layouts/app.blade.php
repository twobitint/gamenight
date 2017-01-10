<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Gamenight</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> --}}

    </head>
    <body>

        <nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top">

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="#">Gamenight</a>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item {{ strpos(Route::currentRouteName(), 'boardgames') === 0 ? 'events' : '' }}">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown {{ strpos(Route::currentRouteName(), 'boardgames') === 0 ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle"
                            href="http://example.com"
                            id="navbarDropdownMenuLink"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            Best With
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('boardgames', ['players' => 2]) }}">Two</a>
                            <a class="dropdown-item" href="{{ route('boardgames', ['players' => 3]) }}">Three</a>
                            <a class="dropdown-item" href="{{ route('boardgames', ['players' => 4]) }}">Four</a>
                            <a class="dropdown-item" href="{{ route('boardgames', ['players' => 5]) }}">Five</a>
                            <a class="dropdown-item" href="{{ route('boardgames', ['players' => 6]) }}">Six Plus</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="flex-center position-ref full-height">
            <div id="app" class="content container">
                @yield('content')
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
