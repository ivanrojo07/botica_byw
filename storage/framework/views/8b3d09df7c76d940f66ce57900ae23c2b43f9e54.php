<?php $__env->startSection('content'); ?>
<section id="four" class="wrapper style1 special fade-up">
					<div class="container">
						
			<div id="productos" class="container">
		<header class="major">
			<h2 class="grey satisfic-font font1">Aqui podras darle seguimiento a tu Pedido</h2>
		</header>
	</div>				
			
			<div class="10u$ 12u$(medium) important(medium) faq">
	<section id="content">
		
		
 <?php if(Auth::guest()): ?>
                   <h3 class="center">Para poder darle seguimiento es necesario que inicies session.</h3>
                <?php else: ?>

 <h3 class="center">Consulta el status de tu paquete.</h3>
<?php endif; ?>
<br><br><br><br>
				</section>
		</div>



			</div>
						
					</div>
				</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>