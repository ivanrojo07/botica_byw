<?php $__env->startSection('title', 'Productos Facilito'); ?>



<?php $__env->startSection('content'); ?>

    <!-- Banner -->

    <div id="index-header">

        <section id="banner">

            <div class="content">

                    <div>
                        <div class="container">
                            <nav class="navbar navbar-inverse navbar-xs" style="background: #1c1d26;" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#productos"><b>Categorías</b></a>
                          </div>

                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <?php $count = 0; ?>
                              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  
                                  <?php if($count == 8) break; ?>
                                  <li><a href="<?php echo e(url('/Products1?category=' . $category->slug)); ?>" title="<?php echo e($category->description); ?>" style="font-size: 12px"><?php echo e($category->title); ?></a></li>
                                    <?php $count++; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                              </li>
                            </ul>
                          </div><!-- /.navbar-collapse -->
                        </nav>
                        </div>
                    </div>
                <header style="height: 410px !important">
           
                    <div class="info-header">
                        <h2 class="satisfic-font">TuFarmaciaLatina.com</h2>

                        <p>Enviamos a toda Latinoamerica Incluyendo a VENEZUELA Y CUBA.</p>

                        <p class="satisfic-font"><a href="<?php echo e(url('/seguimiento')); ?>">¡Dale Seguimiento a tu pedido!</a></p>
                        <p class="statisfic-font"><a href="<?php echo e(url('/Products1')); ?>">¡COMPRAR!</a>
                        

                    </div>



                    <div id="slider">

                        <ul>

                            <?php $__currentLoopData = $products_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li>

                                    

                                    <div class="slider-container">

    <?php if($product->extension): ?>

        <img class="bt1 animated flash infinite" src="<?php echo e(url("/img_prod/$product->id.$product->extension")); ?>" class="product_avatar">

    <?php else: ?>

        <img class="bt1 animated flash infinite" src="<?php echo e(asset('img/12.jpg')); ?>" class="product_avatar">

    <?php endif; ?>

    

        <h4> <?php echo e($product->title); ?>


                                        </h4>

                                         <p class="costo orangep animated flash infinite">

                                            <?php echo e($product->pricing); ?> USD

                                        </p>

                                        <a class="btn btn-primary" style="position: inherit;" href="<?php echo e(url('/Products1')); ?>">Ver Promociones</a>



                                       



                                    </div>

                                </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                           

                        </ul>

                    </div>

                </header>

                <span class="image"></span>

            </div>
            <header class="content">
                
            
            <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <?php $__currentLoopData = $products0; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product0): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src=
                                    <?php if($product0->extension): ?>
                                        
                                        "<?php echo e(url("/img_prod/$product0->id.$product0->extension")); ?>"
                                    <?php else: ?>
                                        
                                        "<?php echo e(asset('img/12.jpg')); ?>"
                                    <?php endif; ?> class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price ">
                                            <h5 class="price-text-color">
                                                <?php echo e($product0->title); ?></h5>
                                            <h5 class="price-text-color">
                                                <?php if(isset($promotion) && $promotion): ?>

                                                    $ <?php echo e($product0->promotion_pricing); ?> usd

                                                <?php else: ?>

                                                    $ <?php echo e($product0->pricing); ?> usd

                                                <?php endif; ?></h5>
                                        </div>
                                        
                                    </div>
                                    <div class="clearfix">
                                            <?php echo Form::open(['url' => '/in_shopping_carts', 'method' => 'POST' ]); ?>

                                            <input type="hidden" name="product_id" value="<?php echo e($product0->id); ?>">
                                            <input type="hidden" name="qty" value="1" >

                                        <p class="btn">
                                                     <i class="price-text-color fa fa-shopping-cart"></i><button type="submit" class="btn btn-link hidden-sm">Agregar al carrito</button>
                                        </p>



                                            <?php echo Form::close(); ?>

                                           
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="item">
                    <?php $__currentLoopData = $products1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src=<?php if($product0->extension): ?>
                                        
                                        "<?php echo e(url("/img_prod/$product0->id.$product0->extension")); ?>"
                                    <?php else: ?>
                                        
                                        "<?php echo e(asset('img/12.jpg')); ?>"
                                    <?php endif; ?> class="img-responsive" alt="a" width="350px" height="260px" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price">
                                            <h5 class="price-text-color">
                                                <?php echo e($product1->title); ?></h5>
                                            <h5 class="price-text-color">
                                                <?php if(isset($promotion) && $promotion): ?>

                                                    $ <?php echo e($product1->promotion_pricing); ?> usd

                                                <?php else: ?>

                                                    $ <?php echo e($product1->pricing); ?> usd

                                                <?php endif; ?></h5>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                            <?php echo Form::open(['url' => '/in_shopping_carts', 'method' => 'POST' ]); ?>

                                            <input type="hidden" name="product_id" value="<?php echo e($product1->id); ?>">
                                            <input type="hidden" name="qty" value="1" >

                                        <p class="btn">
                                                     <i class="price-text-color fa fa-shopping-cart"></i><button type="submit" class="btn btn-link hidden-sm">Agregar al carrito</button>
                                        </p>



                                            <?php echo Form::close(); ?>

                                           
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        </header>

           





        </section>

    </div>

    <!-- Four -->

    <section id="four" class="wrapper style1 special fade-up">

        <div id="productos" class="container">
            <header class="major">

                <h2 class="grey">Categorias</h2>

                <p class="grey">

                    * Precio exclusivo de Tienda en Línea.

                    Puede variar por zona geográfica.

                </p>

            </header>
            <div class="main-container container text-center">
                <!-- Gallery Grid Starts -->
            <ul class="row list-unstyled" id="gallery-grid">
                <?php if(count($categories)): ?>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
            <!-- Gallery Item #1 Starts -->
                <li class="col-md-4 col-sm-6 col-xs-12 gallery-grid-item" >
                    <a href="<?php echo e(url('/Products1?category=' . $category->slug)); ?>">
                    <div class="hover-content">
                        <img src="images/gallery/cuadros/category<?php echo e($index); ?>.jpg" alt="Gallery Image 1" class="img-responsive img-center animation-1">
                        <div class="overlay animation text-lite-color">
                            <h6 class="text-uppercase animation-1"><?php echo e($category->description); ?></h6>
                            <p class="animation-1"><?php echo e($category->title); ?></p>                                     
                        </div>
                    </div>
                    </a>
                </li>    
            <!-- Gallery Item #1 Ends -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            
            </ul>
        <!-- Gallery Grid Ends -->
            <?php else: ?>

                <div class="alert alert-warning">

                    No hay categorías disponibles.

                </div>

            <?php endif; ?>
            </div>





            <footer class="major">

                <ul class="actions">

                    <li><a href="<?php echo e(url('/Products1')); ?>" class="button blue-template1">Ver Mas Productos</a></li>

                </ul>

            </footer>

        </div>

    </section>



    

    <!--<section class="spotlight style1 top">

    <div class="content">

        <div class="container">

            <div class="">

        <header>

            <h2 class="text-center">Suscríbete para recibir nuestras nuevas ofertas!!</h2>

        </header>



        <ul class="actions actiones">

        <form action="">

            <li><input type="email" placeholder="Agrega tu email"></li>

            <li><input type="submit" class="button" value="Suscríbete"></li>

            </form>



        </ul>

            </div>

        </div>

    </div>

</section>-->



 <!--   <section id="envios" class="spotlight style1 top">

        <div class="content">

            <div class="container ">

                <div class="">

                    <header>

                        <h2 class="text-center">Haz click para envios a: </h2>

                    </header>

                    <ul class="actions">

                        <li class="ven"><a href="https://rxlatinmeds.clickfunnels.com/phone-order-venezuela"

                                           class="button">Venezuela</a>

                        </li>

                        <li class="cuba"><a href="https://rxlatinmeds.clickfunnels.com/phone-order-cuba" class="button">Cuba</a>

                        </li>

                    </ul>

                </div>

            </div>

            <br>

        </div>

    </section>-->






    





<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
    
    
    
    <script src="<?php echo e(url('js/plugins/backstretch/jquery.backstretch.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/plugins/shuffle/jquery.shuffle.modernizr.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/plugins/owl-carousel/owl.carousel.js')); ?>"></script>
    
    
   
    <script type="text/javascript" src="<?php echo e(url('js/popper.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js/mdb.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>