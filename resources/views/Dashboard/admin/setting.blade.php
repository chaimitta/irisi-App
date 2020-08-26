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

<div class="wrapper ">
    <div class="sidebar" data-color="green" data-background-color="white" data-image="../../assets/img/sidebar-1.jpg">
    
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
          <li class="nav-item  ">
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
          <li class="nav-item active">
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
            <a class="navbar-brand" href="javascript:;">Année académique</a>
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
<!-- end of modal -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 ">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Choisir l'année académique</h4>
                  <p class="card-category">Veuiller choisir la nouvelle annéé académique</p>
                </div>
                <div class="card-body">
                <form method="post" action="{{url('/dashboard/settingsAnnee')}}">
                        @csrf
                        <button type="submit" class="btn btn-primary pull-left">Choisir</button>
                        </form>
                  <form method="post" action="{{url('/dashboard/settingsChoose')}}" enctype="multipart/form-data">
                  @csrf
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
                          
                      
                        <fieldset class="form-group pl-3">
                        @if(isset($annee))
                        <select class="browser-default custom-select custom-select-lg mb-3 h-75 w-50" 
                        name="annee" > 
                       
                        @foreach($annee as $ann)
                        <option value="{{$ann->id}}">{{$ann->int_annee}}</option> 
                        @endforeach
                        </select>
                        </fieldset>

                      
                      <div class="row">
                           <input type="hidden" name="id" value="{{$ann->id}}">
                  <br>
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">Envoyer</button>
                    <div class="clearfix"></div>
                   </div>
                        @endif
                  </form>
                </div>

                </div>
            </div>
          
          </div>
          
        </div>
        
      <div class="container-fluid">

<div class="row">
<div class="col-md-6">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Ajouter une année académique</h4>
          <p class="card-category">Veuillez décrire l'année à ajouter</p>
        </div>
        <div class="card-body">
          <form method="post" action="{{url('/dashboard/settingsAdd')}}" enctype="multipart/form-data">
          @csrf
          
                    @if(isset($message3))
                        <div class="alert alert-warning alert-dismissible fade show text-center">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning:</strong> {{$message3}}
                        </div>
                    @endif
       
          @if(isset($message4))
                        <div class="alert alert-success alert-dismissible fade show text-center">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Bien, </strong> {{$message4}}
                        </div>
                    @endif
                  
              <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  
                  <input type="text" class="form-control" name="annee" required placeholder="ex: 2019/2020">
                </div>
              </div>
          </div>
            
                       
          <br>
            <button type="submit" class="btn btn-primary pull-right">Sauvegarder</button>
            <div class="clearfix"></div>
          </form>
        </div>
  </div>
  </div>

</div>
</div>   

<div class="container-fluid">

<div class="row">
  <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Ajouter un emplois du temps</h4>
          <p class="card-category">Veuillez décrire l'emplois à ajouter</p>
        </div>
        <div class="card-body">
          <form method="post" action="{{url('/dashboard/settingsEmplois')}}" enctype="multipart/form-data">
          @csrf
          
                    @if(isset($messageEmp1))
                        <div class="alert alert-danger alert-dismissible fade show text-center">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erreur:</strong> {{$messageEmp1}}
                        </div>
                    @endif
       
          @if(isset($messageEmp2))
                        <div class="alert alert-success alert-dismissible fade show text-center">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Bien, </strong> {{$messageEmp2}}
                        </div>
                    @endif
                  
               <div class="row">
                 <div class="col-md-6">
                  <div class="form-group">
                  
                    <fieldset class="form-group pl-3">
                    
                    <select class="browser-default custom-select custom-select-lg mb-3 h-75 w-50" 
                    name="niveau" > 
                    <option value="1">IRISI1</option> 
                    <option value="2">IRISI 2</option> 
                    <option value="3">IRISI 3</option> 
                    
                    </select>
                    </fieldset>

                  </div>
                  </div>

                    <div class="col-md-6">
                    <div class="form-group">
                      
                    <fieldset class="form-group pl-3">
                    
                    <select class="browser-default custom-select custom-select-lg mb-3 h-75 w-50" 
                    name="semestre" > 
                    <option value="S1">Semestre 1</option> 
                    <option value="S2">Semestre 2</option> 
                    </select>
                    </fieldset>
                    </div>
                  </div>
                   
               </div>

               <div class="row">
                 <div class="col-md-8">
                    <div class="form-group">
                      <label class="bmd-label-floating">Choisir un fichier</label>
                    </div>
                    <input type="file" class="form-control" name = "path" required>

                  </div>
               </div>
            
                       
          <br>
            <button type="submit" class="btn btn-primary pull-right">Sauvegarder</button>
            <div class="clearfix"></div>
          </form>
        </div>
  </div>
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
 
</body>

</html>