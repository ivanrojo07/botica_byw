<?php $__env->startSection('content'); ?>

    <section id="four" class="wrapper style1 special fade-up">

        <div class="container">

            <header class="major">

                <h2 class="grey satisfic-font font1">

                    Ventas

                </h2>

                <p class="pprofile">

                    Viazualiza los productos vendidos, TOTAL DE (<?php echo e($count_products); ?>) PRODUCTOS Vendidos

                </p>

            </header>





            <br/>



            <form action="<?php echo e(url('admin/sales')); ?>" method="GET">

                <div class="row uniform">

                    <div class="col-lg-4">

                        <h1 class="grey">Usuario</h1>

                        <select name="user" id="user" class="form-control">

                            <option value="all" selected>Todos</option>

                            <option value="0"

                                    <?php echo e(($user_selected && $user_selected ==  0) ? 'selected' : ''); ?>>

                                Invitado

                            </option>

                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($user->id); ?>"

                                        <?php echo e(($user_selected && $user_selected ==  $user->id) ? 'selected' : ''); ?>>

                                    <?php echo e($user->email); ?>


                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                    </div>



                    <div class="col-lg-4">

                        <h1 class="grey">

                            Nombre Producto

                        </h1>

                        <input type="text" name="title" id="title" class="form-control" value="<?php echo e($title); ?>"

                               style="height: 36px !important;"/>

                    </div>



                    <div class="col-lg-4">

                        <h1 class="grey">

                            Cantidad

                        </h1>

                        <input type="number" name="qty" id="qty" class="form-control"

                               value="<?php echo e($qty); ?>"/>

                    </div>



                </div>



                <br/>



                <button type="submit" class="btn btn-primary">

                    Filtrar

                </button>



                <a href="<?php echo e(url('admin/sales?user=all')); ?>" class="btn btn-info">

                    Limpiar Filtros

                </a>



            </form>



        </div>



        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <?php if(count($sales)): ?>

                        <table class="table table-hover table-striped">

                            <thead>

                            <tr>

                                <td># Carrito</td>

                                <td>Usuario</td>

                                <td>Nombre Producto</td>

                                <td>Cantidad</td>

                                <td>Código Proveedor</td>

                            </tr>

                            </thead>

                            <tbody>

                            <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>

                                    <td>

                                        <?php echo e($sale->shoppingcart->id); ?>


                                    </td>

                                    <td>

                                        <?php echo e(($sale->shoppingcart->user_id != null )

                                            ? '#'.$sale->shoppingcart->user->id . ' ' . $sale->shoppingcart->user->email

                                            : 'Invitado'); ?>


                                    </td>

                                    <td>
                                        <?php if(count($sale->product) == 0): ?>
                                            
                                            no existe el producto
                                        <?php else: ?>
                                            <?php echo e($sale->product->title); ?>

                                            
                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php echo e($sale->qty); ?>


                                    </td>

                                    <td>
                                        <?php if(count($sale->product) == 0): ?>
                                            
                                            no existe el producto
                                        <?php else: ?>
                                            <?php echo e($sale->product->codigo_proveedor); ?>

                                            
                                        <?php endif; ?>

                                    </td>

                                </tr>

                                

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>

                        </table>

                    <?php else: ?>

                        <div class="alert alert-warning">

                            No hay productos vendidos

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            



            <div class="pagination">

                <?php echo e($sales->links()); ?>


            </div>



        </div>



    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>