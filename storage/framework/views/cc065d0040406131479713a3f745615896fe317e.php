<?php $__env->startSection('content'); ?>
    <div class="big-padding blue-grey white-text ">
        <h1>Productos</h1>
    </div>

    <div class="container">
        <table class="table table-hover text-center color-black">
            <thead>
            <tr>
                <td>Id</td>
                <td>Titulo</td>
                <td>Categoria</td>
                <td>Descripcion</td>
                <td>Precio</td>
                <td>Acciones</td>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($product->id); ?></td>
                    <td><?php echo e($product->title); ?></td>
                    <td><?php echo e((is_object($product->cat)) ? $product->cat->title : 'N/A'); ?></td>
                    <td><?php echo e($product->description); ?></td>
                    <td><?php echo e((is_object($product->cat) && $product->cat->title == 'Promociones') ? $product->promotion_pricing :$product->pricing); ?></td>
                    <td>
                    <a class="green" href="<?php echo e(url("/products/$product->id")); ?>">Ver</a>
                        <?php if(Auth::check() && Auth::user()->rol == 'admin'): ?>                            
                            <a href="<?php echo e(url('/products/'.$product->id.'/edit')); ?>">Editar</a>
                            <?php echo $__env->make('products.delete',['product' => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>

                    </td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pagination">
                    <?php echo e($products->links()); ?>
                </div>
    </div>
    <div class="floating">
        <a href="<?php echo e(url('/products/create')); ?>" class="btn btn-default btn-fab">
            <i class="material-icons">add</i>
        </a>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>