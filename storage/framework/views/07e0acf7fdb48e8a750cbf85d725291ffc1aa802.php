
<?php $__env->startSection('content'); ?>
    <section id="four" class="wrapper style1 special fade-up">
        <div class="container">
            <header class="major">
                <h2 class="grey satisfic-font font1">
                    Mis Ordenes
                </h2>
                <p class="pprofile">
                    Visualiza el detalle de cada uno de tus pedidos.
                </p>
            </header>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php if(count($orders)): ?>
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>Estatus</td>
                                <td>Total</td>
                                <td>Receta</td>
                                <td>Fecha Creación</td>
                                <td>Detalle</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <td>
                                        <?php echo e($order->id); ?>

                                    </td>
                                    <td>
                                        <?php echo e($order->status); ?>

                                    </td>
                                    <td>
                                        $ <?php echo e(number_format($order->total, '2')); ?>

                                    </td>
                                    <td>
                                        <form action="<?php echo e(url('/user/order/get-receta')); ?>" method="POST">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="url_receta_path"
                                                   value="<?php echo e($order->receta_path); ?>"/>
                                            <button  class="btn btn-success" type="submit">
                                                Descargar Receta
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <?php echo e($order->created_at); ?>

                                    </td>
                                    <td>
                                        <a href="<?php echo e(url('/compras/' . $order->customid)); ?>">Ver Pedido</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            No tienes pedidos
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>