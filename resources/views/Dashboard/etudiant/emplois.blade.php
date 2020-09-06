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
            <a class="nav-link" href="{{url('/notesEtudiant')}}" data-toggle="modal" data-target="#exampleModal">
             
              <i class="material-icons">content_paste</i>
              <p>Notes</p>
            </a>
          </li>
           
          <li class="nav-item ">
            <a class="nav-link" href="{{url('/dashboard/profile-etudiant')}}">
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
                  <a class="dropdown-item" href="{{url('/dashboard/profile-etudiant')}}">Mon compte</a>
                 
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
        
          <div class="row">
            <div class="col-md-10">
              <div class="card">

                <div class="card-header card-header-primary">
                  
                  <h4 class="card-title ">Emplois du temps</h4>
                </div>
                <div class="card-body">
                @if(isset($message))
                                <div class="alert alert-warning alert-dismissible fade show text-center">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Oups:</strong> {{$message}}
                                </div>
                  @endif
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <thead>
                          <tr>
                            <th>l'emplois du temps</th>
                            <th>Dernière modification</th>
                          </tr>
                        </thead>
                     
                     @if(isset($resultat))
                      <tbody id="myTable">
                      
                        <tr>

                          <td><a href="{{asset('storage/'.$resultat->emplois)}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Cliquer pour voir l'emplois</a></td>
                          <td>{{$resultat->updated_at}}</td>
                         
                          
                        </tr>
                      
                     
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
 
  </div>
  </div>

  </div>

  <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Pour obtenir la liste de vos notes ,veuillez cliquer sur "Obtenir".</p>
              </div>
              <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{route('notes.etudiant')}}" class="btn btn-primary">Obtenir</a>
              </div>
            </div>
          </div>
        </div>
        <a class="dropdown-item" href="#" data-toggle="modal" id="btn2" data-target="#exampleModal2" style="display: block;">Déconnexion</a>


        <div class="modal" tabindex="-1" role="dialog" id="exampleModal2" >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @php
             $msg=Session::get('msg')
                @endphp
                @if( $msg==3)
                <p>Aucune note n'a été affectée.</p>
                @endif
              </div>
              <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </div>
          </div>
        </div>
  <!--   Core JS Files   -->
  <script src="../../assets/js/core/jquery.min.js"></script>
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../../assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  @if($msg==3)
 <script>
document.getElementById("btn2").click();
 </script>
@endif
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