

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

        <h1 class="grey"><a href="<?php echo e(url('/products/'.$product->id)); ?>"><?php echo e($product["descripcion"]); ?></a></h1>

    </header>
    <?php if($product->extension): ?>

        <img class="bt1" src="<?php echo e(url("/img_prod/$product->id.$product->extension")); ?>" class="product_avatar">

    <?php else: ?>

        <img class="bt1"  alt="100%x200" src="<?php echo e(asset('img/12.jpg')); ?>" class="product_avatar">

    <?php endif; ?>
        
      
    <div class="caption">
        <h5 class="grey">

            <strong>Categoria:</strong>

        </h5>





    <p class="grey">

        <?php if(isset($product->tipo_de_producto)): ?>
            
            <?php echo e($product->tipo_de_producto); ?>

        <?php else: ?>
            Sin categoría
            
        <?php endif; ?>


    </p>
    <?php if(isset($product["sustancia_activa"]) && $product["sustancia_activa"] != ""): ?>
        
        <h5 class="grey">

            <strong>Sustancia Activa:</strong>
            <p class="grey"><?php echo e($product["sustancia_activa"]); ?></p>
        </h5>
    <?php endif; ?>



    <h5 class="grey">

        <strong>descripcion</strong>

    </h5>



    <p class="grey">

        <?php echo e($product["descripcion_terapeutica"]); ?>


    </p>



    <strong>

        <p class="costo orangep">

            <?php if(isset($promotion) && $promotion): ?>

                $ <?php echo e($product->promotion_pricing); ?> usd

            <?php else: ?>

                $  <?php echo e(number_format(($product["precio_publico"]+($product["precio_publico"]*($product["iva"]/100))+($product["precio_publico"]*($product["ieps"]/100))+($product["precio_publico"]*($product["impuesto_3"]/100))),2)); ?>  MXN

            <?php endif; ?>

        </p>

    </strong>



    <?php echo $__env->make("in_shopping_carts.form",["product" => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
    </div>
  </div>


