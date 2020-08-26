<?php $__env->startSection('content'); ?>
    <?php if(isset($modules)): ?>
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                    <div class="row pt-md-5 mt-md-3 mb-5">
                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-3 col-sm-6 p-2">
                                <div class="card card-common">
                                    <div class="card-body" style="min-height: 150px">
                                        <div class="d-flex justify-content-between">
                                            <div class="text-left text-secondary">
                                                <h5><?php echo e($module->libelle); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-success">
                                        <i class="fas fa-eye mr-3"></i>
                                        <a href="#"><span class="text-success">Voir les cours</span></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboardApp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Chaimaa\irisi-App\resources\views/Dashboard/etudiant.blade.php ENDPATH**/ ?>