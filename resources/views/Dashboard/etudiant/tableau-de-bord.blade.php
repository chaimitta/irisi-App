<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
     <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

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
    <link rel="stylesheet" href="{{asset('node_modules/izitoast/dist/css/iziToast.min.css')}}">

   <link href="{{asset('assets/css/material-dashboard.css?v=2.1.2')}}" rel="stylesheet" />
   
  <link rel="stylesheet" href="{{asset('assets2/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets2/css/components.css')}}">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
     
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
                <input id="tableSearch" type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
               
            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Welcome to Stisla template!
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
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

                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                    @csrf
                </form>
</div>
        </div>
    </div>
</div>
<!-- end of modal -->
      <div class="content">

        <div class="container-fluid">
        <!-- <div class="col-12 mb-4">
                <div class="hero bg-primary text-white" style="background-image: url('img/bg;">
                  <div class="hero-inner">
                    <h2>Bienvenu , {{$user->nom}} !</h2>
                     <div class="mt-2">
  
                      <a href="{{url('/etudiant-emplois/'.$semestre_id.'/'.$niveau_id)}}" style="background-color: #000;" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-edit"></i> Votre emploi du temps</a>
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="col-12 mb-4">
                <div class="hero text-white hero-bg-image" data-background="/img/bg/bg6.jpg">
                  <div class="hero-inner">
                    <h2>Bienvenu , {{$user->nom}} !</h2>
                    <p class="lead">Cette page va vous aider à avoir toutes les informations qui vous intéressent.</p>
                    <div class="mt-4">
                    <a href="{{url('/etudiant-emplois/'.$semestre_id.'/'.$niveau_id)}}" style="background-color: #ffa426;" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-edit"></i> Votre emploi du temps</a>
                    </div>
                  </div>
                </div>
              </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Liste des modules</h4>
                  

                </div>
              
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                    

                      </thead>
                  
  <tbody id="myTable">
       @if(isset($modules))
      @foreach($modules as $module)
    <tr>
       <td><h5>
       <a href="#">{{$module->libelle}}</a></td>

       </h5>
      
       
      <td><a href="{{url('/etudiant-listeCours/'.$module->libelle)}}"
 class="pull-right btn btn-outline-white btn-lg btn-icon icon-left" style="background-color: #000;"><i class="fa fa-eye" aria-hidden="true"></i> Voir la liste des cours</a></td>
 
 <td></td>
    </tr>
     
    @endforeach
     @endif
  </tbody>
</table>
   
                  </div>
                </div>
                   
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
            </script>, made with  love <i class="material-icons"></i> by Chaimaa
             and Meriem for a better web.
          </div>
        </div>
      </footer>
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
 

   <script src="{{asset('assets/js/core/jquery.min.js')}}"></script> 
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
   
  <script src="{{asset('assets/js/core/bootstrap-material-design.min.js')}}"></script>
  
    
  <script src="{{asset('assets/js/material-dashboard.js?v=2.1.2')}}" type="text/javascript"></script>
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
 
  <!-- Template JS File -->
 
  <!-- JS Libraies -->
 <script>$("[data-background]").each(function() {
    var me = $(this);
    me.css({
      backgroundImage: 'url(' + me.data('background') + ')'
    });
  });
</script>
   
</body>

</html>