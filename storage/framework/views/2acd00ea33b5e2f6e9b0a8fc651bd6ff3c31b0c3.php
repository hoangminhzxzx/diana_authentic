<?php $__env->startSection('title'); ?>
    <?php echo e($category_title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="small-container">
        <div class="row row-2">
            <h2>All Products</h2>
            <select name="" id="">
                <option value="">Mặc định</option>
                <option value="">Giá tăng dần</option>
                <option value="">Giá giảm dần</option>
            </select>
        </div>
        <div class="row" style="justify-content: unset;">
            <?php $__currentLoopData = $list_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-4">
                <a href="<?php echo e(route('client.product.detail', ['slug' => $product->slug])); ?>"><img src="<?php echo e(url($product->thumbnail)); ?>" alt=""></a>
                <h4><?php echo e($product->title); ?></h4>







                <p><?php echo e(number_format($product->price, 0, '.', '.')); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo e($list_product->render('vendor.pagination.bootstrap-4')); ?>








    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/category/list_product.blade.php ENDPATH**/ ?>