<?php $__env->startSection("content"); ?>

    <div class="big-padding text-center blue-grey white-text" style="    padding-top: 65px !important;">
        <h1>Tu carrito de compras</h1>

    </div>



    <div class="container margin-top">

        <table class="table table-bordered">

            <thead>

            <tr>

                <td>

                    <strong>Producto</strong>

                </td>

                <td>

                    <strong>Precio</strong>

                </td>

                <td>

                    <strong>Cantidad</strong>

                </td>

                <td>

                    <strong>Subtotal</strong>

                </td>

                <td>

                    <strong></strong>

                </td>

            </tr>

            </thead>

            <tbody>

            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>

                    <td>

                        <?php echo e($product->title); ?>


                        <?php if(is_object($product->cat) && $product->cat->slug == 'Promociones'): ?>

                            <label class="text-info">(Producto en Promoción)</label>

                        <?php endif; ?>

                    </td>

                    <td>

                        <?php if(is_object($product->cat) && $product->cat->slug == 'Promociones'): ?>

                            $ <?php echo e($product->promotion_pricing); ?>


                        <?php else: ?>

                            $ <?php echo e($product->pricing); ?>


                        <?php endif; ?>



                    </td>

                    <td>

                        <?php echo e($product->pivot->qty); ?>


                    </td>

                    <td>

                        $ <?php echo e(number_format($product->pivot->qty * ((is_object($product->cat) && $product->cat->slug == 'Promociones') ? $product->promotion_pricing : $product->pricing), 2)); ?>


                    </td>

                    <td>

                        <?php echo $__env->make("shopping_carts.delete", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </td>



                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



            <tr class="background-blueth">

                <td></td>

                <td></td>

                <td class="t-r f-b">Total</td>

                <td>$ <?php echo e($total); ?> </td>

            </tr>



            </tbody>

        </table>

        <div>

            <?php echo $__env->make("shopping_carts.form", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>

        <p class="text-center" style="color: black;"><strong>El tiempo estimado de la entrega es de 5 a 7 dias habiles</strong></p>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="<?php echo e(asset('js/plugins/piexif.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/plugins/sortable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/plugins/purify.min.js')); ?>"></script>
    <script src=""></script>
    <!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js 
   3.3.x versions without popper.min.js. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/fileinput.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/locales/es.js')); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script>
        $('#receta').fileinput({
            theme: 'fa',
            language: 'es',
            showUpload: false,
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>