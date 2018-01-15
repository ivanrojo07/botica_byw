

<?php $__env->startSection('content'); ?>
    <section id="four" class="wrapper style1 special fade-up">
        <div class="container">
            <header class="major">
                <h2 class="grey satisfic-font font1">Agrega tus Direcciones</h2>
            </header>

        </div>
        <div class="container">

            <div class="pull-left">
                <a href="<?php echo e(url('/user/direccion/create')); ?>" class="btn btn-primary">
                    Nueva Dirección
                </a>
            </div>

            <hr/>


            <?php echo $__env->make('feedback', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


            <div class="">
                <table class="table table-hover text-center color-black">
                    <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>País</td>
                        <td>Estado, Municipio</td>
                        <td>Calle, Número</td>
                        <td>C.P</td>
                        <td>Predeterminada</td>
                    </tr>
                    </thead>
                    <tbody>

                    <form action="<?php echo e(url('/user/direccion/set_default')); ?>" method="POST" id="form-default-direction">
                        <?php echo e(csrf_field()); ?>

                        <?php $__currentLoopData = $direccions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $direccion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($direccion->name); ?></td>
                                <td><?php echo e($direccion->pais); ?></td>
                                <td><?php echo e($direccion->calle . ', ' . 'Ext: ' . $direccion->num_ext . ', Int: ' . $direccion->num_int); ?></td>
                                <td><?php echo e($direccion->estado . ', ' . $direccion->municipio); ?></td>
                                <td><?php echo e($direccion->codigop); ?></td>
                                <td>
                                    <input type="radio" class="default" name="default"
                                           <?php echo e($direccion->default ? 'checked' : ''); ?> value="<?php echo e($direccion->id); ?>"/>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </form>

                    </tbody>
                </table>
            </div>
        </div>

    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script>
        $(function () {
            $('.default').on('change', function () {
                $("#form-default-direction").submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>