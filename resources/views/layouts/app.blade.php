<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.description') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Peeech') }}</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ url('/favicon.ico',[],$is_production) }}" type="image/x-icon">
    <link rel="icon" href="{{ url('/favicon.ico',[],$is_production) }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ url('images/icons/sp_home_icon.png',[],$is_production) }}" />
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slider-pro.min.css',$is_production) }}">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-44969371-9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-44969371-9');
    </script>
</head>
<body class="bg_white">
    <div class="ht100">
        <nav class="navbar navbar_thin navbar-default navbar-static-top nav-bar-fixed mb0">
            <div class="container">
                <div class="navbar-header navbar-header_bg_color">
                    <div class="title-area-register">
                        <h4 class="title-text_white text_clamp_title wd70">{{ $title or 'Peeech' }}</h4>
                    </div>
                    <!-- <title-default></title-default> -->
                    <!-- Branding Image -->
                    <a class="navbar-brand disnone" href="{{ url('/',[],$is_production) }}">
                        {{ config('app.name', 'Peeech') }}
                    </a>
                </div>
            </div>
        </nav>

        @yield('content')
        @if(Auth::user())
        <footer class="footer">
            <div class="container sp-between">
                <a class="text_align_c wd25 menu_footer" href="{{ url('/friends',Auth::user()->id, $is_production) }}"><img class="wd80 menu1" src="{{ asset('images/icons/menu_no_color/menu1_2.png',$is_production) }}"></a>
                <a class="text_align_c wd25 menu_footer" href="{{ url('/matchings',Auth::user()->id, $is_production) }}"><img class="wd80 menu2" src="{{ asset('images/icons/menu_no_color/menu2_2.png',$is_production) }}"></a>
                <a class="text_align_c wd25 menu_footer" href="{{ url('/rooms',Auth::user()->id, $is_production) }}"><img class="wd80 menu3" src="{{ asset('images/icons/menu_no_color/menu3_2.png',$is_production) }}"></a>
                <a class="text_align_c wd25 menu_footer" href="{{ url('/profiles',Auth::user()->id, $is_production) }}"><img class="wd80 menu4" src="{{ asset('images/icons/menu_no_color/menu4_2.png',$is_production) }}"></a>
            </div>
        </footer>
        @endif
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.0.min.js',$is_production) }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.sliderPro.min.js',$is_production) }}"></script>
    <script src="{{ asset('js/index_2.js',$is_production) }}"></script>
</body>
</html>
