<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/dashboard_style.css') }}">
    <title>Irisi-App</title>
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-expand-md navbar-light">
    <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#myNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNavbar">
        <div class="container-fluid">
            <div class="row">
                <!-- sidebar -->
                <div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
                    <a href="{{ url('/') }}" class="navbar-brand text-white d-block mx-auto text-center py-3 mb-4">
                        <img class="w-50" src="{{ url('img/logo.png') }}" alt="IRISI-App" title="IRISI-App" />
                    </a>
                    <div class="bottom-border pb-3">
                        <img src="{{ asset('img/admin.jpeg') }}" width="50" class="rounded-circle mr-3">
                        <a href="#" class="text-white">Hi, {{$user->prenom}}!</a>
                    </div>
                    <ul class="navbar-nav flex-column mt-4">
                        <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-home text-light fa-lg mr-3"></i>Tableau de bord</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-chart-bar text-light fa-lg mr-3"></i>Emploi du temps</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-table text-light fa-lg mr-3"></i>Notes</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-envelope text-light fa-lg mr-3"></i>Messages</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-user text-light fa-lg mr-3"></i>Profile</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-newspaper-o text-light fa-lg mr-3"></i>A propos</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-wrench text-light fa-lg mr-3"></i>Préférences</a></li>
                        <!-- <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-file-alt text-light fa-lg mr-3"></i>Documentation</a></li>-->
                    </ul>
                </div>
                <!-- end of sidebar -->

                <!-- top-nav -->
                <div class="col-xl-10 col-lg-9 col-md-8 ml-auto bg-dark fixed-top py-2 top-navbar">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h4 class="text-light text-uppercase mb-0">Dashboard</h4>
                        </div>
                        <div class="col-md-5">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control search-input text-white" placeholder="Search...">
                                    <button type="button" class="btn btn-white search-button"><i class="fas fa-search text-success"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <ul class="navbar-nav">
                                <li class="nav-item icon-parent"><a href="#" class="nav-link icon-bullet"><i class="fas fa-comments text-muted fa-lg"></i></a></li>
                                <li class="nav-item icon-parent"><a href="#" class="nav-link icon-bullet"><i class="fas fa-bell text-muted fa-lg"></i></a></li>
                                <li class="nav-item ml-md-auto"><a href="#" class="nav-link" data-toggle="modal" data-target="#sign-out"><i class="fas fa-sign-out-alt text-danger fa-lg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end of top-nav -->
            </div>
        </div>
    </div>
</nav>
<!-- end of navbar -->

<!-- modal -->
<div class="modal fade" id="sign-out">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Voullez-vous vraiment vous déconnecter ?</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Cliquez sur quitter pour vous déconnecter.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Rester ici</button>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Quitter</button>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end of modal -->

<section>
    @yield('content')
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>--}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
