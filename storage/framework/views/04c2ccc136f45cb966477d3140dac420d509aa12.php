<?php echo Form::open(['url' => $url, 'method' => $method, 'files' => true]); ?>
<div class="container">
    <div class="form-group">
        <?php echo e(Form::text('title', $product->title, ['class' => 'form-control', 'placeholder'=>'Titulo....'])); ?>
    </div>
    <div class="form-group">
        <select name="category_id" id="category_id" class="form-control">
            <option value="">Selecciona una opción</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php echo e(($product->category_id == $category->id) ? 'selected' : ''); ?>>
                    <?php echo e($category->title); ?>
                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        
    </div>
    <div class="form-group">
        <?php echo e(Form::number('pricing', (is_object($product->cat) && $product->cat->title == 'Promociones') ? $product->promotion_pricing : $product->pricing, ['class' => 'form-control', 'placeholder'=>'Precio de tu producto....'])); ?>
    </div>
    <div class="form-group">
        <?php echo e(Form::file('cover')); ?>
    </div>
    <div class="form-group">
        <?php echo e(Form::textarea('description', $product->description, ['class' => 'form-control', 'placeholder'=>'Describe tu producto....'])); ?>
    </div>
    <div class="form-group text-right">
        <input type="submit" value="Enviar" class="btn btn-success">
        <button onclick="window.location.href='<?php echo e(url('/products')); ?>'" type="button" class="btn btn-primary">Regresar
        </button>

    </div>
</div>
<?php echo Form::close(); ?>