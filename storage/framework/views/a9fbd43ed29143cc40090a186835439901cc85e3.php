<?php $__env->startSection("content"); ?>
    <div class="big-padding text-center blue-grey white-text">
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
        <p class="text-center"><strong>El tiempo estimado de la entrega es de 5 a 7 dias habiles</strong></p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>