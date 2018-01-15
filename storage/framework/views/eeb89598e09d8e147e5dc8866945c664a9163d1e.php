<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo $__env->make("products.product", ["product" => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    
    <?php if(count($product_comments)): ?>
        <div class="container">
            <h3 class="grey">Reseñas</h3>
            <ul>
                <?php $__currentLoopData = $product_comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="grey">
                        <?php echo e($comment->comment); ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>