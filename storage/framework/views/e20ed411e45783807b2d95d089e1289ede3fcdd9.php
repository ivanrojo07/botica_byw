<section class="products1 4u 6u$(medium) 12u$(xsmall) curacion">

    <header class="text-center">



        <div class="pull-left">



            <?php if(Auth::check()): ?>

                <?php if($favoriteProduct->isFavorite($product->id)): ?>

                    <a href="<?php echo e(url('/user/product/' . $product->id . '/favorite/remove')); ?>"

                       title="remover de favoritos">

                        <i class="fa fa-star"></i>



                    </a>

                <?php else: ?>

                    <a href="<?php echo e(url('/user/product/' . $product->id . '/favorite/add')); ?>" title="agregar a favoritos">

                        <i class="fa fa-star-o"></i>

                    </a>

                <?php endif; ?>



                <a href="<?php echo e(url('/user/product/' . $product->id . '/comment')); ?>" title="Valorar producto">

                    <i class="fa fa-comment"></i>

                </a>



            <?php endif; ?>



        </div>

        <br>

        <h1 class="grey"><?php echo e($product->title); ?></h1>

    </header>



    <?php if($product->extension): ?>

        <img class="bt1" src="<?php echo e(url("/img_prod/$product->id.$product->extension")); ?>" class="product_avatar">

    <?php else: ?>

        <img class="bt1" src="<?php echo e(asset('img/12.jpg')); ?>" class="product_avatar">

    <?php endif; ?>



    <br>



    <h5 class="grey">

        <strong>Categoria:</strong>



        <?php echo e($product->cat->title); ?>


    </h5>



    <p class="grey">



    </p>



    <h5 class="grey">

        <strong>descripcion</strong>

    </h5>



    <p class="grey">

        <?php echo e($product->description); ?>


    </p>



    <strong>

        <p class="costo orangep">

            <?php if(isset($promotion) && $promotion): ?>

                $ <?php echo e($product->promotion_pricing); ?> usd

            <?php else: ?>

                $ <?php echo e($product->pricing); ?> usd

            <?php endif; ?>

        </p>

    </strong>



    <?php echo $__env->make("in_shopping_carts.form",["product" => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



    <br/>



</section>

 