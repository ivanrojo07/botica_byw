<?php $__env->startSection('content'); ?>

    <section id="four" class="wrapper style1 special fade-up">

        <div id="productos" class="container">





            <?php if($category_selected): ?>

                <header class="major">

                    <h2 class="grey satisfic-font font1">

                        <?php echo e($category_selected->title); ?>


                    </h2>

                </header>

            <?php endif; ?>



            <form action="<?php echo e(url('Products1')); ?>" method="GET">

                <div class="row uniform">

                    <div class="col-lg-3">

                        <h1 class="grey">Categoría</h1>

                        <select name="category" id="category" class="form-control">

                            <option value="all" selected>Todas</option>

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($category->slug); ?>"

                                        <?php echo e(($category_selected && $category_selected->slug ==  $category->slug) ? 'selected' : ''); ?>>

                                    <?php echo e($category->title); ?>


                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                    </div>



                    <div class="col-lg-3">

                        <h1 class="grey">

                            Nombre Producto

                        </h1>

                        <input type="text" name="title" id="title" class="form-control" value="<?php echo e($title); ?>"

                               style="height: 36px !important;"/>

                    </div>



                    <div class="col-lg-3">

                        <h1 class="grey">

                            Precio Máximo

                        </h1>

                        <input type="number" name="max_price" id="max_price" class="form-control"

                               value="<?php echo e($max_price); ?>"/>

                    </div>



                    <div class="col-lg-3">

                        <h1 class="grey">

                            Fecha de Creación

                        </h1>

                        <select name="order_created_at" id="order_created_at" class="form-control">

                            <option value="">Selecciona una opción</option>

                            <option value="asc" <?php echo e(($order_created_at == 'asc') ? 'selected' : ''); ?>>

                                Ascendente

                            </option>

                            <option value="desc" <?php echo e(($order_created_at == 'desc') ? 'selected' : ''); ?>>

                                Descendente

                            </option>

                        </select>

                    </div>

                </div>



                <br/>



                <button type="submit" class="btn btn-primary">

                    Filtrar

                </button>



                <a href="<?php echo e(url('Products1?category=all')); ?>" class="btn btn-info">

                    Limpiar Filtros

                </a>



            </form>



            <?php echo $__env->make('feedback', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



            <hr/>



            <?php if(Session::has('favorite_status')): ?>

                <div class="alert alert-success">

                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                    <strong>

                        <?php echo e(Session::get('favorite_status')); ?>


                        <a href="<?php echo e(url('user/my-favorite-products')); ?>">, Ir a mis Favoritos</a>

                    </strong>

                </div>

                <br/>

            <?php endif; ?>





            <div class="box alt ">

                <div class="row uniform">



                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php echo $__env->make("products.product", ["product" => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                    <?php if(!count($products)): ?>

                        <div class="col-lg-12 alert alert-warning">

                            <strong>No hay productos disponibles.</strong>

                        </div>

                    <?php endif; ?>





                </div>

            </div>


                <div class="pagination">

                    <?php echo e($products->links('vendor.pagination.simple-default')); ?>


                </div>



               <footer class="major">

                    <ul class="actions">

                        <li><a href="<?php echo e(url('/products')); ?>" class="button blue-template1">Ver todos los Productos</a>

                        </li>

                    </ul>

                </footer>




    </section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>