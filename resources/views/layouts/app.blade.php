<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Social') }}</title>

        <!-- Styles -->
        <link href="{{ url('css/app.css')}}" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://use.fontawesome.com/6044cadb34.js"></script>
        <script>
            window.Laravel = <?php
echo json_encode([
    'csrfToken' => csrf_token(),
]);
?>
        </script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <form class="navbar-form navbar-left" method="GET" action="{{url('/search')}}">
                            
                            <div class="input-group">
                                <input type="text" name="q"  class="form-control" placeholder="Szukaj uzytkownika">

                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </span>
                            </div>
                        </form>
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Logowanie</a></li>
                            <li><a href="{{ url('/register') }}">Rejstracja</a></li>
                            @else
                                <li>
                                    <a href="{{ url('/wall') }}"><i class="fa fa-outdent"></i> Tablica</a>
                                </li>
                                <li>
                                    <a href="{{ url('/notifications') }}"><i class="fa fa-commenting"></i>Powiadomienia
                                           {!!  Auth::user()->unreadNotifications->count()>0 ? '<span  class="label label-danger">'.Auth::user()->unreadNotifications->count().'</span>' : '<i style="color:green;" class="fa fa-check" ></i>'!!}
                                        </a>
                                </li>
                                <li>
                                    <a href="{{ url('/users/' . Auth::id()) }}"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                                </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
                                </a>

                                <ul class="dropdown-menu" role="menu">


                                        @if (Auth::check())
                                        <li>
                                            <a href="{{ url('/users/' . Auth::id()) . '/edit' }}">Edytuj swój profil</a>
                                        </li>

                                        @endif
                                        <li>
                                        <a href="{{ url('/logout') }}"
                                                 onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            Wyloguj
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')
            
        </div>

        <!-- Scripts -->
        <script src="{{url('js/app.js')}}"></script>
    </body>
</html>
