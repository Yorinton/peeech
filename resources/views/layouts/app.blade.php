<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <!-- <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script> -->
</head>
<body class="bg_white">
    <div class="ht100">
        <nav class="navbar navbar-default navbar-static-top nav-bar-fixed mb0">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="title-area-register">
                        <h4 class="title-text text_clamp_title">{{ $title or 'Peeech' }}</h4>
                    </div>
                    <!-- <title-default></title-default> -->
                    <!-- Branding Image -->
                    <a class="navbar-brand disnone" href="{{ url('/') }}">
                        {{ config('app.name', 'Peeech') }}
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <!-- <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
        @if(Auth::user())
        <footer class="footer">
            <div class="container sp-between">
                <a class="text_align_c wd25 menu_footer" href="{{ url('/friends/'.Auth::user()->id) }}"><img class="wd80 menu1" src="../../images/icons/menu_no_color/menu1_2.png"></a>
                <a class="text_align_c wd25 menu_footer" href="{{ url('/matchings/'.Auth::user()->id) }}"><img class="wd80 menu2" src="../../images/icons/menu_no_color/menu2_2.png"></a>
                <a class="text_align_c wd25 menu_footer" href="{{ url('/rooms/'.Auth::user()->id) }}"><img class="wd80 menu3" src="../../images/icons/menu_no_color/menu3_2.png"></a>
                <a class="text_align_c wd25 menu_footer" href="{{ url('/profiles/'.Auth::user()->id) }}"><img class="wd80 menu4" src="../../images/icons/menu_no_color/menu4_2.png"></a>
            </div>
        </footer>
        @endif
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.0.min.js') }}"></script>
</body>
</html>
