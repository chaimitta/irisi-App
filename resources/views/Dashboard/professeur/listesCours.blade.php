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
  <link href="../../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white" data-image="../../assets/img/sidebar-1.jpg">
      
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
                <input type="text" id="tableSearch" value="" class="form-control" placeholder="Search...">
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

      <div class="content">
        <div class="container-fluid">
                  
                            @if(isset($message))
                                <div class="alert alert-danger alert-dismissible fade show text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Erreur:</strong> {{$message}}
                                </div>
                            @endif
               
                  @if(isset($message2))
                                <div class="alert alert-success alert-dismissible fade show text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Bien, </strong> {{$message2}}
                                </div>
                            @endif
                            @if(isset($message3))
                                <div class="alert alert-success alert-dismissible fade show text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Bien, </strong> {{$message3}}
                                </div>
                            @endif
          <div class="row">
            <div class="col-md-12">
              <div class="card">

                <div class="card-header card-header-primary">
                  <div class="pull-right">
                    <a href="{{url('/cours/ajouter_cours')}}" class="text-white">
                      <h4><i class="fa fa-plus-circle"></i> Ajouter cours
                      </h4>
                    </a>

                  </div>
                  <h4 class="card-title ">Liste des cours</h4>
                </div>
                
                @if(isset($messageErr))
               
                                <div class="alert alert-warning alert-dismissible fade show text-center mt-5">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Attention:</strong> {{$messageErr}}
                                </div>
                            @endif
                @if(isset($resultat))
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <thead>
                          <tr>
                            <th>Cours</th>
                            <th>Date d'ajout</th>
                          
                          </tr>
                        </thead>
                      <tbody id="myTable">
                        @foreach($resultat as $res)
                        <tr>

                          <td><a href="{{asset('storage/'.$res->cours)}}" target="_blank">{{$res->nomCours}}</a></td>
                          <td>{{$res->created_at}}</td>
                         
                          <td class="pr-5">
                            <div class="row col-md-8">
                             
                            <a href="{{url('/cours-edit/'.$res->nomCours)}}">
                             <button type="button" rel="tooltip" title="Editer" class="btn btn-white btn-round btn-just-icon">
                                  <i class="fa fa-pencil material-icons" style="color:orange"></i>
                                  <div class="ripple-container"></div>
                                </button>
                             </a>
                                
                                <a href="#" data-toggle="modal" data-target="#delete{{$res->id}}">
                                <button type="submit" rel="tooltip" title="Supprimer" class="btn btn-white btn-round btn-just-icon">

                                  <i class="fa fa-trash material-icons" style="color:red"></i>
                                  <div class="ripple-container"></div>
                                </button>
                                </a>

      <div class="modal fade" id="delete{{$res->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Voullez-vous vraiment supprimer ce cours ?</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              Cliquez sur supprimer pour supprimer le cours.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
              <a  onclick="javascript:location.href='{{url('/cours-delete/'.$res->id)}}'">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Supprimer</button>
             </a>
            </div>
          </div>
        </div>
      </div>


                            
                            </div>
                          </td>
                        </tr>
                        @endforeach
                     
                      </tbody>
                    </table>


                  </div>
                </div>
                @endif
              </div>
            </div>

          </div>
        </div>
      </div>


    </div>
  </div>
  <footer class="footer">
    <div class="container-fluid">

      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, made with love <i class="material-icons"></i> by Chaimaa
        and Meriem for a better web.
      </div>
    </div>
  </footer>
  </div>
  </div>

  </div>
  <!--   Core JS Files   -->
  <script src="../../assets/js/core/jquery.min.js"></script>
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../../assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <script>
		$(document)
				.ready(
						function() {
							$("#tableSearch")
									.on(
											"keyup",
											function() {
												var value = $(this).val()
														.toLowerCase();
												$("#myTable tr")
														.filter(
																function() {
																	$(this)
																			.toggle(
																					$(
																							this)
																							.text()
																							.toLowerCase()
																							.indexOf(
																									value) > -1)
																});
											});
						});
	</script>
</body>

</html>