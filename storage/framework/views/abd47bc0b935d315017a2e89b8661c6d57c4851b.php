<?php echo $__env->make('feedback', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(url('carrito')); ?>" method="POST" class="inline-block" enctype='multipart/form-data'>
    <?php echo e(csrf_field()); ?>

   
    <div class="form-group">
        <label for=""><strong>Selecciona el archivo de tu receta en formato (pdf, jpg, png o jpeg):</strong></label>
        <input class="btn btn-primary" type="file" name="receta_file" value="" placeholder="receta"/>
    </div>
 <?php if(Auth::guest()): ?>
                   <label class=""> <strong>Inicia session para administrar tus direcciones.</strong></label>
 <?php else: ?>
    <?php if($direccion_default): ?>
        <div class="form-group">
            <input type="hidden" name="direccion_default" value="<?php echo e($direccion_default->id); ?>"/>
            <label for="">
               <strong>La direccion que colocaste predeterminada es:</strong>
            </label>

            <table class="table">
                <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Email</td>
                    <td>País</td>
                    <td>Estado, Municipio</td>
                    <td>Calle, Número</td>
                    <td>Colonia</td>
                    <td>C.P</td>
                    <td>Entre Calles</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <?php echo e($direccion_default->name); ?>

                    </td>
                    <td>
                        <?php echo e($direccion_default->email); ?>

                    </td>
                    <td>
                        <?php echo e($direccion_default->pais); ?>

                    </td>
                    <td>
                        <?php echo e($direccion_default->estado . ', ' . $direccion_default->municipio); ?>

                    </td>
                    <td>
                        <?php echo e($direccion_default->calle . ', Ext:' . $direccion_default->num_ext . ', Int:' . $direccion_default->num_int); ?>

                    </td>
                    <td>
                        <?php echo e($direccion_default->colonia); ?>

                    </td>
                    <td>
                        <?php echo e($direccion_default->codigop); ?>

                    </td>
                    <td>
                        <?php echo e($direccion_default->entre1 . ' Y ' . $direccion_default->entre2); ?>

                    </td>
                    <td>

                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <br/>
        
        <?php else: ?>
        <div class="form-group">
        <label for="">Si no has establecido tu direccion favor de ingresar al siguiente link</label>
        <a class="btn btn-success" href="<?php echo e(url('/user/direccion')); ?>">Direcciones</a>
    </div>
    
    <?php endif; ?>
    <?php endif; ?>
    <?php if($total > 0): ?>
        <input type="submit" class="btn btn-success special Special" value="Pagar con Paypal">
    <?php endif; ?>

</form>

<br>
<br><br><br>