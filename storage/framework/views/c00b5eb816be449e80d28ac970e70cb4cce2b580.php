
<?php $__env->startSection('content'); ?>


<br>
<br>
<br>
<br>
<div  class="container">
    <header class="major">
      <h2 class="grey satisfic-font font1">Contactanos</h2>
    </header>
  </div>
<div class="row">
  <div class="10u$ 12u$(medium) important(medium) faq">
    
<?php echo Form::open(array('route' => 'contact_store', 'class' => 'form')); ?>

<?php if(Session::has('message')): ?>
    <div class="alert alert-info">
      <?php echo e(Session::get('message')); ?>

    </div>
<?php endif; ?>
      <?php if($errors->any()): ?>
            <div class="alert alert-danger text-left">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
 
<div class="form-group">
    <?php echo Form::label('Nombre:'); ?>

    <?php echo Form::text('name', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Coloca aqui tu nombre')); ?>

</div>

<div class="form-group">
    <?php echo Form::label('Email:'); ?>

    <?php echo Form::text('email', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Coloca Aqui tu Email')); ?>

</div>

<div class="form-group">
    <?php echo Form::label('Mensaje:'); ?>

    <?php echo Form::textarea('message', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Coloca aqui tu mensaje')); ?>

</div>

<div class="form-group">
    <?php echo Form::submit('Enviar', 
      array('class'=>'btn btn-primary')); ?>

</div>
<?php echo Form::close(); ?>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>