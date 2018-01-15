
<?php $__env->startSection('content'); ?>
    <section id="four" class="wrapper style1 special fade-up">
        <div class="container">
            <header class="major">
                <h2 class="grey satisfic-font font1">
                    Bienvenido <?php echo e(Auth::user()->name); ?> al panel de gestion
                </h2>
                <p class="pprofile">
                    Desde "Mi Panel" tienes la posibilidad
                    de ver tu actividad reciente y actualizar tu información.
                </p>
            </header>

        </div>
        <div class="container margin-12">
            <div class="col-md-4">
                <div class="list-group text-left">
                    <img src="<?php echo e(url (Auth::user()->imgprofile)); ?>" class="img-responsive imgprofile " alt="">
                    <a href="javascript:void(0);" class="list-group-item active">
                        Opciones:
                    </a>
                    <a href="<?php echo e(url('user/profile')); ?>" class="list-group-item">
                        Cambiar mi imagen de perfil
                    </a>
                    <a href="<?php echo e(url('user/password')); ?>" class="list-group-item">
                        Cambiar mi contraseña
                    </a>
                    <a href="<?php echo e(url('user/direccion')); ?>" class="list-group-item">
                        Gestiona tus Direcciones
                    </a>
                    <a href="<?php echo e(url('user/my-favorite-products')); ?>" class="list-group-item">
                        Mis Productos Favoritos
                    </a>
                    <a href="<?php echo e(url('user/my-orders')); ?>" class="list-group-item">
                        Mis Ordenes
                    </a>
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>