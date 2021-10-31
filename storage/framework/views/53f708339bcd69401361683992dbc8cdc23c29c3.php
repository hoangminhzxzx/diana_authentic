<?php $__currentLoopData = json_decode($stock->images, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <img src="<?php echo e(url($image)); ?>" alt="" class="img-thumbnail" width="70">
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/stock/images_stock_ajax.blade.php ENDPATH**/ ?>