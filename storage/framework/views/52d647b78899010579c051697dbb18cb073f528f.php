<?php $__env->startSection('content'); ?>

            <header class="major">
              <h2 class="grey satisfic-font  font12">Cambiar imagen de perfil</h2>
            </header> 
            <div class="container">
            
              <div class="col-md-6 margin-large margin-bottom-cort">
                  <form method='post' action='<?php echo e(url("user/updateprofile")); ?>' enctype='multipart/form-data'>
                <?php echo e(csrf_field()); ?>
                <div class='form-group'>
                  
                  <input type="file" name="image" />
                  <div class='text-danger'><?php echo e($errors->first('image')); ?></div>
                  <p class="p-cort">*La imagen no debe de exceder el tamaño de 1MB</p>
                </div>
                <button type='submit' class='btn btn-primary center-block'>Actualizar imagen de perfil</button>
                <button onclick="window.location.href='<?php echo e(url('/user')); ?>'" type="button" class="btn btn-primary center-block">Regresar</button>
              </form>
              </div>
            
              
            </div>
        

<?php $__env->stopSection(); ?> 

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>