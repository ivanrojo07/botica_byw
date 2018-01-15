




<?php $__env->startSection('content'); ?>
    <section id="four" class="wrapper style1 special fade-up">
        <div class="container">
            <header class="major">
                <h2 class="grey satisfic-font font1">Agrega tu Dirección de Envio</h2>
            </header>

        </div>
        <div class="container">


            <?php if($errors->any()): ?>
                <div class="alert alert-danger text-left">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(url('/user/direccion/create')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                <div class="form-group col-lg-4">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre"
                           value="<?php echo e(old('name')); ?>">
                </div>

                <div class="form-group col-lg-4">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                           value="<?php echo e(old('email')); ?>"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="telefono">Telefono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono"
                           value="<?php echo e(old('telefono')); ?>"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="contaco">Telefono del Contacto:</label>
                    <input type="text" class="form-control" name="contacto" id="contacto" placeholder="Numero del Contacto"
                           value="<?php echo e(old('contacto')); ?>"/>
                </div>


                <div class="form-group col-lg-4">
                    <label for="pais">País:</label>
                    <input type="text" class="form-control" name="pais" id="pais" placeholder="País"
                           value="<?php echo e(old('pais')); ?>"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="estado">Estado:</label>
                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado"
                           value="<?php echo e(old('estado')); ?>"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad"
                           value="<?php echo e(old('ciudad')); ?>"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="municipio">Municipio:</label>
                    <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Municipio"
                           value="<?php echo e(old('municipio')); ?>"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="calle">Calle:</label>
                    <input type="text" class="form-control" name="calle" id="calle" placeholder="Calle"
                           value="<?php echo e(old('calle')); ?>"/>
                </div>


                <div class="form-group col-lg-2">
                    <label for="num_ext">Núm Exterior:</label>
                    <input type="text" class="form-control" name="num_ext" id="num_ext" placeholder="Número Exterior"
                           value="<?php echo e(old('num_ext')); ?>"/>
                </div>

                <div class="form-group col-lg-2">
                    <label for="num_int">Núm Interior:</label>
                    <input type="text" class="form-control" name="num_int" id="num_int" placeholder="Número Interior"
                           value="<?php echo e(old('num_int')); ?>"/>
                </div>

                <div class="form-group col-lg-2">
                    <label for="colonia">Colonia:</label>
                    <input type="text" class="form-control" name="colonia" id="colonia" placeholder="Colonia"
                           value="<?php echo e(old('colonia')); ?>"/>
                </div>

                <div class="form-group col-lg-2">
                    <label for="codigop">C.P:</label>
                    <input type="text" class="form-control" name="codigop" id="codigop" placeholder="Código Postal"
                           value="<?php echo e(old('codigop')); ?>"/>
                </div>


                <div class="form-group col-lg-4">
                    <label for="entre1">Entre Calle:</label>
                    <input type="text" class="form-control" name="entre1" id="entre1" placeholder="Entre Calle?"
                           value="<?php echo e(old('entre1')); ?>"/>
                </div>


                <div class="form-group col-lg-4">
                    <label for="entre2">Y Entre Calle:</label>
                    <input type="text" class="form-control" name="entre2" id="entre2" placeholder="Y Entre Calle"
                           value="<?php echo e(old('entre2')); ?>"/>
                </div>

                <div class="form-group col-lg-4">
                    <label for="references">Referencias Adicionales:</label>
                    <input type="text" class="form-control" name="references" id="references"
                           placeholder="Referencias Adicionales"
                           value="<?php echo e(old('references')); ?>"/>
                </div>

                <div class=" col-md-12 pull-center">
                    <br>
                    <a href="<?php echo e(url('/user/direccion')); ?>" class="btn btn-warning">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar Dirección</button>
                </div>


            </form>

        </div>

    </section>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>