<?php $__env->startSection('content'); ?>
<div class="container white margin-top ">
	<h1 class="color-grey font-ch">Editar Producto</h1>
	<?php echo $__env->make('products.form', ['product' => $product, 'url' => '/products/'.$product->id, 'method' => 'PATCH'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<br>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>