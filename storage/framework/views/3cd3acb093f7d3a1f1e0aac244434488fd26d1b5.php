<?php $__env->startSection('title', 'Productos Facilito'); ?>



<?php $__env->startSection('content'); ?>

    <!-- Banner -->

    <div id="index-header">

        <section id="banner">

            <div class="content">

                <header>
           

                    <div class="info-header">
                        <h2 class="satisfic-font">TuFarmaciaLatina.com</h2>

                        <p>Enviamos a toda Latinoamerica Incluyendo a VENEZUELA Y CUBA.</p>

                        <p class="satisfic-font"><a href="<?php echo e(url('/seguimiento')); ?>">¡Dale Seguimiento a tu pedido!</a></p>

                    </div>



                    <div id="slider">

                        <ul>

                            <?php $__currentLoopData = $products_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li>

                                    

                                    <div class="slider-container">

    <?php if($product->extension): ?>

        <img class="bt1" src="<?php echo e(url("/img_prod/$product->id.$product->extension")); ?>" class="product_avatar">

    <?php else: ?>

        <img class="bt1" src="<?php echo e(asset('img/12.jpg')); ?>" class="product_avatar">

    <?php endif; ?>

    

        <h4> <?php echo e($product->title); ?>


                                        </h4>

                                         <p class="costo orangep">

                                            <?php echo e($product->pricing); ?> USD

                                        </p>

                                        <a class="btn btn-primary" href="<?php echo e(url('/Products1')); ?>">Ver Promociones</a>



                                       



                                    </div>

                                </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                           

                        </ul>

                    </div>

                </header>

                <span class="image"></span>

            </div>





        </section>

    </div>

    <!-- One -->

    <section id="one" class="spotlight style1 left">



        <div class="content">


            <header>

                <h2>Servicios</h2>

            </header>

            <p>En TuFarmaciaLatina todos los servicios que ofrecemos cuentan con el respaldo sanitario y la seriedad de

                profesionales de alto nivel, que aporta un valor añadido para prevenir la enfermedad, incrementar su

                nivel de salud y aportar información.</p>

            <ul class="actions">

                <li><a href="<?php echo e(url('/servicios')); ?>" class="button">Servicios</a></li>

            </ul>

        </div>



    </section>



    <!-- Two -->

    <section id="two" class="spotlight style2 right">



        <div class="content">

            <header>

                <h2>Servicio de Atención Social</h2>

            </header>

            <p>Parte de nuestro servicio esta destinado a ayudar a las personas que no tengan recursos. Este servicio

                social se trabaja conjuntamente con las Iglesias Cristianas. Algunos productos necesitan la Prescripción

                de su Doctor. No Prescribimos Recetas para Medicinas solo suplimos la venta de la medicina y el envío a

                su familiar en su país.</p>

            <ul class="actions">

                <li><a href="#" class="button">Leer Mas</a></li>

            </ul>

        </div>



    </section>



    <!-- Three -->

    <section id="three" class="spotlight style3 left	">

        <div class="content">

            <header>

                <h2>Entregamos en toda América Latina incluyendo VENEZUELA y CUBA.</h2>



            </header>

            <p> El tiempo de despacho se realizara una vez el pago sea confirmado.En el caso de Cuba usted puede recoger

                su Medicina en Cuba de 5 a 7 días laborables en Provincia Habana en los puntos de recogidas. De 7-10

                días en las provincias del interior. Usted puede optar por ir a recoger su paquete o que se lo entreguen

                en su casa.

            <ul class="actions">

                <li><a href="#" class="button">Envios</a></li>

            </ul>

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

            <?php if(count($categories)): ?>

                <div class="box alt">

                    <div class="row uniform category">

                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <section

                                    class="<?php echo e(((($index+1)%3) == 0) ? '4u$ 6u(medium) 12u$(xsmall)' : '4u 6u(medium) 12u$(xsmall)'); ?>">

                                <a href="<?php echo e(url('/Products1?category=' . $category->slug)); ?>">

                                    <h3 class="grey">

                                        <?php echo e($category->title); ?>


                                    </h3>

                                    <p class="grey">

                                        <?php echo e($category->description); ?>


                                    </p>

                                </a>

                            </section>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                </div>

            <?php else: ?>

                <div class="alert alert-warning">

                    No hay categorías disponibles.

                </div>

            <?php endif; ?>





            <footer class="major">

                <ul class="actions">

                    <li><a href="<?php echo e(url('/Products1')); ?>" class="button blue-template1">Ver Mas Productos</a></li>

                </ul>

            </footer>

        </div>

    </section>







<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>