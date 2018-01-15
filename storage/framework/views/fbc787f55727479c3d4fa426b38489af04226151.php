<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title grey" id="myModalLabel">
                    Dirección de Envío
                </h4>
            </div>
            <div class="modal-body grey" id="modal-body-address">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection("content"); ?>
    <div class="container m-top">
        <div class="panel panel-default dashadmin ">
            <div class="panel-heading">
                <h2>Ordenes</h2>
            </div>
            <div class="panel-body">
                <h3>Estadisticas</h3>
                <div class="row top-space">
                    <div class="col-xs-4 col-md-3  sale-data">
                        <span><?php echo e($totalMonth); ?> USD</span>
                        Ingresos del Mes
                    </div>
                    <div class="col-xs-4 col-md-3  sale-data">
                        <span><?php echo e($totalMonthCount); ?></span>
                        Numero de Ventas
                    </div>
                </div>
                <h4>Ventas</h4>
                <table class="table table-bordered tabla-status">
                    <thead>
                    <tr>
                        <td>Id. Venta</td>
                        <td>Comprador</td>
                        <td>Dirección</td>
                        <td>No. Guía</td>
                        <td>Estatus</td>
                        <td>Fecha de Venta</td>
                        <td>Acciones</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($order->id); ?></td>
                            <td><?php echo e($order->recipient_name); ?></td>
                            
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary shopping_cart_address"
                                        data-shoppingcart="<?php echo e($order->shopping_cart_id); ?>">
                                    <i class="fa fa-eye"></i>Ver Dirección
                                </button>
                            </td>
                            <td>
                                <a href="#" data-type="text"
                                   data-pk="<?php echo e($order->id); ?>"
                                   data-url="<?php echo e(url("/orders/$order->id")); ?>"
                                   data-title="Numero de Guia"
                                   data-value="<?php echo e($order->guide_numer); ?>"
                                   class="set-guide-number"
                                   data-name="guide_numer"></a>

                            </td>
                            <td><a href="#" data-type="select"
                                   data-pk="<?php echo e($order->id); ?>"
                                   data-url="<?php echo e(url("/orders/$order->id")); ?>"
                                   data-title="Status"
                                   data-value="<?php echo e($order->status); ?>"
                                   class="select-status"
                                   data-name="status "></a></td>
                            <td><?php echo e($order->created_at); ?></td>
                            <td>
                                <form action="<?php echo e(url('/user/order/get-receta')); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>
                                    <input type="hidden" name="url_receta_path"
                                           value="<?php echo e($order->shoppingcart->receta_path); ?>"/>
                                    <button class="btn btn-success">Descargar Receta</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(function () {
            $(".shopping_cart_address").on('click', function (e) {
                e.preventDefault();
                var shoppingcart = $(this).data('shoppingcart');

                // acemos la peticion ajax para obtener la plantilla del carrito

                $.ajax({
                    url: '<?php echo e(url('/order/info_address/')); ?>/' + shoppingcart,
                    type: 'GET',
                    success: function (data) {
                        $("#modal-body-address").html(data);
                        $("#myModal").modal('show');
                    }
                })
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>