<?php $__env->startSection('content'); ?>

    <header class="major">
        <h2 class="grey satisfic-font  font12">
            Agrega un comentario para el producto:
            <br/>
            <?php echo e($product->title); ?>
        </h2>
    </header>
    <div class="container">
        <div class="col-md-8 margin-large margin-bottom-cort">

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method='post' action='<?php echo e(url("user/product/comment")); ?>' enctype='multipart/form-data'>
                <?php echo e(csrf_field()); ?>
                <input type="hidden" name="id" value="<?php echo e($product->id); ?>"/>
                <input type="hidden" name="back_url" value="<?php echo e(url()->previous()); ?>"/>
                <div class="form-group">
                    <label for="comment">Describe tu comentario sobre el producto:</label>
                    <textarea type="text" name="comment" id="comment" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

            </form>
        </div>


    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>