
<?php $__env->startSection('content'); ?>
    <section id="four" class="wrapper style1 special fade-up">
        <div class="container">
            <header class="major">
                <h2 class="grey satisfic-font font1">
                    Recetas Generadas
                </h2>
                <p class="pprofile">
                    Viazualiza Todas las Recetas de los Pedidos
                </p>
            </header>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php if(count($recetas)): ?>
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <td># Venta</td>
                                <td>Usuario</td>
                                <td>Receta</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $recetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($receta->id); ?>

                                    </td>
                                    <td>
                                        <?php echo e(($receta->shoppingcart->user_id != null )
                                            ? '#'.$receta->shoppingcart->user->id . ' ' . $receta->shoppingcart->user->email
                                            : 'Invitado'); ?>

                                    </td>
                                    <td>
                                        <form action=" <?php echo e(url('/user/order/get-receta')); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="url_receta_path"
                                                   value="<?php echo e($receta->shoppingcart->receta_path); ?>"/>
                                            <button class="btn btn-success">Descargar Receta</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            No hay productos vendidos
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pagination">
                <?php echo e($recetas->links()); ?>

            </div>

        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>