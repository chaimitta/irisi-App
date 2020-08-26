
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
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
   
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
     
      <div class="logo"> <a href="{{ url('/') }}" class="simple-text logo-normal  ">
                        <img class="w-50" src="{{ url('img/logo.png') }}" alt="IRISI-App" title="IRISI-App" />
                    </a></div>
      <div class="sidebar-wrapper ">
        <ul class="nav">
        <li class="nav-item ">
            <a class="nav-link" href="{{url('/dashboard/adminProfesseur')}}">
            <i class="material-icons">contacts</i>
              <p>Professeurs</p>
            </a>
          </li>
          <li class="nav-item active ">
            <a class="nav-link" href="{{url('/dashboard/adminEtudiant')}}">
            <i class="material-icons">people</i>
              <p>Etudiants</p>
            </a>
          </li>
         
           
          <li class="nav-item ">
            <a class="nav-link" href="{{url('/dashboard/profile-admin')}}">
              <i class="material-icons">person</i>
              <p>Mon compte</p>
            </a>
          </li>
          <li class="nav-item  ">
            <a class="nav-link" href="/dashboard/archive">
            <i class="material-icons" >archive</i>

              <p>Archive</p>
            </a>
          </li>
           
          <li class="nav-item">
            <a class="nav-link" href="{{url('/dashboard/settings')}}">
            <i class="fa fa-cog" aria-hidden="true"></i>

              <p>Paramètres</p>
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
            <a class="navbar-brand" href="javascript:;">Les étudiants</a>
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
               
              
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="{{url('/dashboard/profile-admin')}}">Mon compte</a>
                  <a class="dropdown-item" href="{{url('/dashboard/settings')}}">Paramètres</a>
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

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            
                <div class="row" >
     <div class="col-md-4" >
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">IRISI 1</p><br>
             
            </div>
            <div class="card-footer">
              <div class="stats">
              
              <form method="Post"  action="{{url('/dashboard/adminEtudiant')}}">
                @csrf
                   <input type="hidden" value="1" name="niveau">
                  <button class="btn btn-primary btn-round  hover focus" style="  background-color:#4CAF50;color:white;"  type="submit">
                  <i class="fa fa-eye" aria-hidden="true"></i> Voir la liste des étudiants</button>
                
                </form>
              </div>
            </div>
          </div>
        </div>
       
  <div class="col-md-4"  >
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">IRISI 2</p><br>
             
            </div>
            <div class="card-footer">
              <div class="stats">
             
              <form method="Post"  action="{{url('/dashboard/adminEtudiant')}}">
                @csrf
                   <input type="hidden" value="2" name="niveau">
                  <button class="btn btn-primary btn-round  hover focus" style="background-color:#4CAF50;color:white;"  type="submit"><i class="fa fa-eye" aria-hidden="true"></i> Voir la liste des étudiants</button>
                
                </form>
              </div>
            </div>
          </div>
        </div>
       
  <div class="col-md-4" >
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">IRISI 3</p><br>
             
            </div>
            <div class="card-footer">
              <div class="stats">
              
              <form method="Post"  action="{{url('/dashboard/adminEtudiant')}}">
                @csrf
                   <input type="hidden" value="3" name="niveau">
                  <button class="btn btn-primary btn-round  hover focus" style="background-color:#4CAF50;color:white;"  type="submit"><i class="fa fa-eye" aria-hidden="true"></i> Voir la liste des étudiants</button>
                
                </form>
              </div>
            </div>
          </div>
        </div>
    
</div>
        
                @if(isset($resultat))
              <div class="col-md-12">
               <div class="card">
                <div class="card-header card-header-primary">
                 <div class="pull-right">
										<a href="{{url('/dashboard/ajouter_etud')}}" class="text-white"><h4><i
											class="fa fa-plus-circle"></i> Ajouter un étudiant
										</h4></a>
									</div>
                  @if($niveau == 1)
                  <h4 class="card-title ">Liste des étudiants de IRISI 1</h4>
                  @endif

                  @if($niveau == 2)
                  <h4 class="card-title ">Liste des étudiants de IRISI 2</h4>
                  @endif

                  @if($niveau == 3)
                  <h4 class="card-title ">Liste des étudiants de IRISI 3</h4>
                  @endif
                </div>
               
               
               <div class="card-body">
                 <div class="table-responsive">
                   <table class="table">
                     <thead class=" text-primary">
                     <thead>
                      <tr>
                      
                        <th>CNE</th>
                        <th>Code Apogee</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>N° telephone</th>
                        <th>Adresse E-mail</th>
                        <th>Adresse</th>
                        <th>Date naissance</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody id="myTable">
                    @foreach($resultat as $res)
                      <tr>
                      
                        <td>{{$res->cne}}</td>
                        <td>{{$res->code_apogee}}</td>
                        <td>{{$res->nom}}</td>
                        <td>{{$res->prenom}}</td>
                        <td>{{$res->tel}}</td>
                        <td>{{$res->email}}</td>  
                        <td>{{$res->adresse}}</td>  
                        <td>{{$res->date_naissance}}</td>  
                        <td>
                            <div class="row" style="padding-left:0px">
                            
                                <a href="{{url('/dashboard/showAdminEditEtud/'.$res->id)}}">
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
              <h4 class="modal-title">Voullez-vous vraiment supprimer cet étudiant ?</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              Cliquez sur supprimer pour supprimer l'étudiant.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
              <a  onclick="javascript:location.href='{{url('/etudiant-delete/'.$res->id)}}'">
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
              </div>
              </div>
            </div>
    @endif
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
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
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