<?php if(Session::has('feedback')): ?>
    <div class="alert <?php echo e(Session::get('alert_type')); ?>">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo e(Session::get('feedback')); ?></strong>
    </div>
<?php endif; ?>