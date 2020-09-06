<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <title>IRISI-App</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">


  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">

  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('assets2/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets2/css/components.css')}}">
  <link rel="stylesheet" href="{{asset('node_modules/izitoast/dist/css/iziToast.min.css')}}">


<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white" data-image="assets2/img/sidebar-1.jpg">

      <div class="logo"> <a href="{{ url('/') }}" class="simple-text logo-normal  ">
          <img class="w-50" src="{{ url('img/logo.png') }}" alt="IRISI-App" title="IRISI-App" />
        </a></div>
      <div class="sidebar-wrapper ">
        <ul class="nav">
          <li class="nav-item  active">
            <a class="nav-link" href="{{url('/dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Tableau de bord</p>
            </a>
          </li>
          <li class="nav-item  ">
            <a class="nav-link" href="{{url('/notes')}}">
              <i class="material-icons">content_paste</i>
              <p>Notes</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{url('/dashboard/profile-professeur')}}">
              <i class="material-icons">person</i>
              <p>Mon compte</p>
            </a>
          </li>


        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Tableau de bord</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">


              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="{{url('/dashboard/profile-professeur')}}">Mon compte</a>
                  <!-- <a class="dropdown-item" href="#">Paramètres</a> -->
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sign-out">Déconnexion</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
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
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Quitter</button>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- end of modal -->
     
    </div>

    <div class="main-content">
      <section class="section">
      @if(isset($message))
              <div class="alert alert-warning alert-dismissible fade show text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Attention:</strong> {{$message}}
                                </div>
            @endif
      @if(isset($anne_univ))
      <div class="section-header">
            <h1>Année universitaire :</h1>
            <div class="section-header-breadcrumb">
                 <h3 class="pull-right">{{$anne_univ}}</h3>
                </div>
          </div>
          @endif
       
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12"> 
            <div class="card card-statistic-2">
              <div class="card-stats">
                <div class="card-stats-title">
                  <div class="dropdown d-inline">


                  </div>
                </div>
                <div class="card-stats-items">
                  <div class="card-stats-item">
                    <div class="card-stats-item-count">24</div>
                    <div class="card-stats-item-label">IRISI1</div>
                  </div>
                  <div class="card-stats-item">
                    <div class="card-stats-item-count">12</div>
                    <div class="card-stats-item-label">IRISI2</div>
                  </div>

                </div>
              </div>
              <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-user-graduate"></i> </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total étudiants</h4>
                </div>
                <div class="card-body">
                  59
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card card-statistic-2">

              <div class="card-chart">
              </div>
              <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-school"></i> </div>
              <div class="card-wrap">

                <div class="card-header">
                  <h4>Modules Affectés</h4>
                </div>
                <div class="card-body">
                  
                  {{ $nbr_modules }}
                 
                  <button class="btn btn-primary" id="toastr-1" style="display: none;">Launch</button>

                </div>
              </div>
            </div>
          </div>
          
        </div>
        @if($nbr_modules!=0)
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-warning">
              <div class="card-header">
                <h4>Modules </h4>
                <div class="card-header-action">
                </div>
              </div>
              <div class="card-body">
                <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                  @if(isset($resultat))
                  @foreach($resultat as $res)

                  <li class="media">
                    <figure class="avatar mr-2 avatar-lg bg-success text-white" data-initial="IRISI{{$res->int_niveau}} "></figure>


                    <div class="media-body">
                      <form method="post" action="{{url('/cours')}}" id="form1">
                        @csrf

                        <input type="hidden" name="idNiveau" value="{{$res->niveau_id}}">

                        <input type="hidden" name="libelleModule" value="{{$res->libelle}}">
                        <a href="#" class="text-success text-center " onclick="document.getElementById('form1').submit()"> {{$res->libelle}} </a>



                      </form>
                    </div>
                    <div class="media-progressbbar">
                    <form method="Post"  action="{{url('/listeE')}}" id="form2" >
                    @csrf
                    <input type="hidden" value="{{$res->niveau_id}}" name="idN">
                    <input type="hidden" value="{{$res->semestre_id}}" name="idS">
                    <a href="#" class="btn btn-icon icon-left btn-dark" onclick="document.getElementById('form2').submit()"><i class="far fa-file"></i> liste des étudiants</a>
  
                  </form>
 
                    </div>
                   
                    <div class="media-progressbar">

                      <a href="{{url('/professeur-emplois/'.$res->int_semestre.'/'.$res->int_niveau)}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> emploi du temps&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

                    </div>
                  </li>
                  @endforeach
                  @endif
                </ul>
              </div>
            </div>
          </div>
          
        </div>
         @endif
        <div class="row">
          <div class="col-md-8">

          </div>
        
        </div>
      </section>
    </div>

  </div>
 

 
<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap-material-design.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('node_modules/izitoast/dist/js/iziToast.min.js')}}"></script>

<script src="{{asset('assets/js/page/modules-toastr.js')}}"></script>
 @if($nbr_modules==0)
 <script>
 
 document.getElementById('toastr-1').click;
   </script>
   @endif
   </body>

</html>