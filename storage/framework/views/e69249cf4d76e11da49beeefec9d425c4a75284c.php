<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>IRISI-App</title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
   <!-- <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">-->

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Roboto:100,300,400,500,700|Philosopher:400,400i,700,700i" rel="stylesheet">

    <!-- Bootstrap css -->
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link href="<?php echo e(asset('lib/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="<?php echo e(asset('lib/owlcarousel/assets/owl.carousel.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('lib/owlcarousel/assets/owl.theme.default.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('lib/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('lib/animate/animate.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('lib/modal-video/css/modal-video.min.css')); ?>" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">

</head>
<body>
<div id="app">
<header id="header" class="header header-hide">
    <div class="container">

        <div id="logo" class="pull-left">
            <!--<h1><a href="#body" class="scrollto"><span>e</span>Startup</a></h1>-->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="<?php echo e(url('/')); ?>"><img class="w-25" src="<?php echo e(url('img/logo.png')); ?>" alt="IRISI-App" title="IRISI-App" /></a>
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <?php if(auth()->guard()->guest()): ?>
                     <li class="menu-active"><a href="<?php echo e(url('/')); ?>">Accueil</a></li>
                     <li><a href="<?php echo e(route('login')); ?>">Connexion</a></li>





                        <li>
                        <a href="<?php echo e(url('/check')); ?>" >Inscription</a>
                        </li>
                    <li><a href="<?php echo e(url('/contact')); ?>">Contact</a></li>
                <?php else: ?>
                    <li class="menu-active"><a href="<?php echo e(url('/dashboard')); ?>">Accueil</a></li>
                    <li class="menu-has-children"> <a href="#"><?php echo e(Auth::user()->nom); ?> <?php echo e(Auth::user()->prenom); ?></a><span class="caret"></span>
                    <ul>
                       <!-- <li><a href="<?php echo e(url('/tableau')); ?>">Tableau de bord</a></li>
                        <li><a href="<?php echo e(url('/profil')); ?>">Profil</a></li>
                        <li><a href="<?php echo e(url('/notes')); ?>">Notes</a></li>
                        <li><a href="<?php echo e(url('/preferences')); ?>">Préférences</a></li>
                        <li><a href="<?php echo e(url('/messages')); ?>">Messages personnels</a></li>-->
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Déconnexion
                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" >
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php endif; ?>
        </nav><!-- #nav-menu-container -->
    </div>
</header><!--header-->
        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
       </main>
</div>
</body>

</html>
<?php /**PATH C:\Users\besto\PhpstormProjects\irisi-App\resources\views/layouts/app.blade.php ENDPATH**/ ?>