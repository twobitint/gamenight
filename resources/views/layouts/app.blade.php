@extends('layouts.basic')

@section('body')

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">

        <a class="navbar-brand" href="#">Gamenight</a>

        <button class="navbar-toggler"
            type="button" data-toggle="collapse"
            data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @active('home')">
                    <a class="nav-link" href="#">
                        Home @active('boardgames', '<span class="sr-only">(current)</span>')
                    </a>
                </li>
                <li class="nav-item @active('hot')">
                    <a class="nav-link"
                        href="{{ url('/hot') }}">
                        Hot List @active('hot', '<span class="sr-only">(current)</span>')
                    </a>
                </li>
                <li class="nav-item dropdown @active('bests')">

                    <a class="nav-link dropdown-toggle"
                        href="#"
                        id="navbarDropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        Best With
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('bests', ['players' => 2]) }}">Two</a>
                        <a class="dropdown-item" href="{{ route('bests', ['players' => 3]) }}">Three</a>
                        <a class="dropdown-item" href="{{ route('bests', ['players' => 4]) }}">Four</a>
                        <a class="dropdown-item" href="{{ route('bests', ['players' => 5]) }}">Five</a>
                        <a class="dropdown-item" href="{{ route('bests', ['players' => 6]) }}">Six Plus</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav mr-sm-2">
                <li>
                    @if (Auth::guest())
                        <li><a class="nav-link" href="{{ url('/login?from='.url()->current()) }}">Login</a></li>
                        <li><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="nav-item dropdown @active('user')">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdownMenuLink"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                {{ Auth::user()->username ? Auth::user()->username : Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item"
                                    href="{{ route('user-collection') }}">
                                    Collection
                                </a>
                                <a class="dropdown-item"
                                    href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form"
                                    action="{{ url('/logout') }}"
                                    method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown @active('group')">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdownMenuLink"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                Groups <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item"
                                    href="#">
                                    Whumps Warren <i aria-hidden="" class="fa fa-star-o"></i>
                                </a>
                                <a class="dropdown-item"
                                    href="#">
                                    Spaghetti Fascists
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    href="#">
                                    Join a Group
                                </a>
                                <a class="dropdown-item"
                                    href="#">
                                    Start a New Group
                                </a>
                            </div>
                        </li>
                    @endif
                </li>
            </ul>
        </div>
    </nav>

    <div class="flex-center position-ref full-height" style="padding-top: 65px;">
        <div id="app" class="content container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>
    @section('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
    @show
@endsection