<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IRISI-App</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
   <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Roboto:100,300,400,500,700|Philosopher:400,400i,700,700i" rel="stylesheet">

    <!-- Bootstrap css -->
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/modal-video/css/modal-video.min.css') }}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!--Dashboard links-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

</head>
<body>
<div id="app">
<header id="header" class="header header-hide">
    <div class="container">

        <div id="logo" class="pull-left pl-5" style="margin-left: 45px;">
            <!--<h1><a href="#body" class="scrollto"><span>e</span>Startup</a></h1>-->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="{{ url('/') }}"><img class="w-25" src="{{ url('img/logo.png') }}" alt="IRISI-App" title="IRISI-App" /></a>
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                @guest
                     <li id="accueil" class="menu-active"><a href="{{ url('/') }}">Accueil</a></li>
                     <li id="connexion"><a href="{{ route('login') }}">Connexion</a></li>
{{--                    @if (Route::has('register'))--}}
{{--                        <li>--}}
{{--                        <a href="{{ route('register') }}" >Inscription</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
                        <li id="inscription">
                        <a href="{{ url('/check') }}" >Inscription</a>
                        </li>
                    <li id="contact"><a href="{{ url('/contact') }}">Contact</a></li>
                @else
                    <li class="menu-active"><a href="{{ url('/dashboard') }}">Accueil</a></li>
                    <li class="menu-has-children"> <a href="#">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</a><span class="caret"></span>
                    <ul>
                       <!-- <li><a href="{{ url('/tableau') }}">Tableau de bord</a></li>
                        <li><a href="{{ url('/profil') }}">Profil</a></li>
                        <li><a href="{{ url('/notes') }}">Notes</a></li>
                        <li><a href="{{ url('/preferences') }}">Préférences</a></li>
                        <li><a href="{{ url('/messages') }}">Messages personnels</a></li>-->
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Déconnexion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endguest
        </nav><!-- #nav-menu-container -->
    </div>
</header><!--header-->
        <main class="py-4">
            @yield('content')
       </main>
</div>
</body>

</html>
