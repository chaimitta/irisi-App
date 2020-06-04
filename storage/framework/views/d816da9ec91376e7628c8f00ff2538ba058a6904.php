<?php $__env->startSection('content'); ?>
    <br><br>
    <div class="content">
        <div class="container">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                <form class="form" method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="card card-login">
                        <div class="card-header ">
                            <div class="card-header ">
                                <h3 class="header text-center" style="color: orange">Connectez vous</h3>
                            </div>
                        </div>
                        <div class="card-body ">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Email')); ?>" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="<?php echo e(__('Mot de passe')); ?>" type="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="remember" type="checkbox" value="" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                        <span class="form-check-sign"></span>
                                        <?php echo e(__('Rester connecté')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-block btn"><?php echo e(__('Connexion')); ?></button>
                        </div>
                    </div>
                    <br><?php if(Route::has('password.request')): ?>
                                <a  href="<?php echo e(route('password.request')); ?>" style="color: green">
                                    Mot de passe oublié ?
                                </a>
                            <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\besto\PhpstormProjects\irisi-App\resources\views/auth/login.blade.php ENDPATH**/ ?>