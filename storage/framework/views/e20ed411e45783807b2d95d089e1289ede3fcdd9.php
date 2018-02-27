

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
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

        <h1 class="grey"><a href="<?php echo e(url('/products/'.$product->id)); ?>"><?php echo e($product->title); ?></a></h1>

    </header>
    <?php if($product->extension): ?>

        <img class="bt1" src="<?php echo e(url("/img_prod/$product->id.$product->extension")); ?>" class="product_avatar">

    <?php else: ?>

        <img class="bt1"  alt="100%x200" src="<?php echo e(asset('img/12.jpg')); ?>" class="product_avatar">

    <?php endif; ?>
        
      
      <div class="caption">
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

                $ <?php echo e($product->pricing); ?> USD

            <?php endif; ?>

        </p>

    </strong>



    <?php echo $__env->make("in_shopping_carts.form",["product" => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
    </div>
  </div>


