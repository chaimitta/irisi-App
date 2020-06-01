<?php $__env->startSection('content'); ?>

    <section id="hero" class="wow fadeIn">
        <div class="hero-container">
            <h1>Bienvenue sur IRISI-App</h1>
            <h2>Une application destinée aux élèves ingénieurs en Réseaux et Systèmes d'Information</h2>
            <img src="img/hero-img.png" alt="Hero Imgs">
            <a href="<?php echo e(route('register')); ?>" class="btn-get-started scrollto">Commencer</a>
        </div>
    </section>
    <footer >
        <div class="container-fluid">
            <div class="row">
                <div class="credits ml-auto">
                <span class="copyright">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script><?php echo e(__(', made with love ')); ?><i class="fa fa-heart heart"></i><?php echo e(__(' by Chaimaa and Meriem ')); ?>

                </div>
            </div>
        </div>
    </footer>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Chaimaa\irisi-App\resources\views/welcome.blade.php ENDPATH**/ ?>