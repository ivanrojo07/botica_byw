<?php $__env->startSection('content'); ?>

    <section id="four" class="wrapper style1 special fade-up">
        <div id="productos" class="container">


            <header class="major">
                <h2 class="grey satisfic-font font1">
                    Mis Productos Favoritos
                </h2>
            </header>

            <br/>


            <?php if(Session::has('favorite_status')): ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>
                        <?php echo e(Session::get('favorite_status')); ?>
                    </strong>
                </div>
                <br/>
            <?php endif; ?>


            <div class="box alt ">
                <div class="row uniform">

                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make("products.product", ["product" => $product, 'promotion' => (is_object($product->cat) && $product->cat->slug == 'Promociones') ? 1 : 0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(!count($products)): ?>
                        <div class="col-lg-12 alert alert-warning">
                            <strong>No has agregado Favoritos.</strong>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="pagination">
                    <?php echo e($products->links()); ?>
                </div>


            </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>