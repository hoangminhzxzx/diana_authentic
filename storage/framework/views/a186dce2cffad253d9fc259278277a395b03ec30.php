<?php $__env->startSection('styles'); ?>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card mx-4">
        <div class="card-header">
            <h3>Cấu hình sản phẩm hot</h3>
        </div>
        <div class="card-body d-flex flex-wrap">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border mr-4 mb-2 text-center p-3" style="width: 15%; box-shadow: 1px 1px 5px 0px;">
                <img src="<?php echo e(asset($product->thumbnail)); ?>" alt="" class="" height="100">
                <p><?php echo e($product->title); ?></p>
                <button class="btn btn-warning">Select</button>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/product/config_product.blade.php ENDPATH**/ ?>