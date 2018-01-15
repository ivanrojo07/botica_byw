
<?php $__env->startSection("content"); ?>
<header class="big-padding  satisfic-font">
  <h1 class="grey text-center">Tu compra ha sido completada!</h1>
</header>
<div class="container">
  <div class="card large-padding">
    <h3 class="text-center grey">Tu pago fue  <span class="<?php echo e($order->status); ?>"><?php echo e($order->status); ?></span></h3>
    <p>Corrobora  los detalles de tu envio:</p>
    <div class="row">
      <div class="col-xs-6">Correo</div>
      <div class="col-xs-6"><?php echo e($order->email); ?></div>
    </div>
    <div class="row">
      <div class="col-xs-6">Direccion</div>
      <div class="col-xs-6"><?php echo e($order->address()); ?></div>
    </div>
     <div class="row">
      <div class="col-xs-6">Codigo Postal</div>
      <div class="col-xs-6"><?php echo e($order->postal_code); ?></div>
    </div>
     <div class="row">
      <div class="col-xs-6">Ciudad</div>
      <div class="col-xs-6"><?php echo e($order->city); ?></div>
    </div>
     <div class="row">
      <div class="col-xs-6">Estado y País</div>
      <div class="col-xs-6"><?php echo e("$order->country_code $order->state"); ?></div>
    </div>
    <div class="row">
      <div class="col-xs-6">El total de tu compra es:</div>
      <div class="col-xs-6">$<?php echo e($order->total); ?>usd</div>
    </div>
    <p class="text-center"><strong>El tiempo estimado de la entrega es de 5 a 7 dias habiles</strong></p>
   <!-- <div class="text-center">
      <a href="<?php echo e(url('/compras', $shopping_cart->customid)); ?>">Link permanente de tu compra</a>
    </div><-->
      <button onclick="window.location.href='<?php echo e(url('/user/my-orders')); ?>'" type="button" class="btn btn-primary center-block">Regresar</button>

      <br>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>