
<?php $__env->startSection('title'); ?>
    Cám Ơn Đã Đặt Hàng
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="small-container" style="min-height: 400px; margin-top: 80px;">
        <h3><b>Đặt hàng thành công !</b></h3>
        <p>Vui lòng để ý điện thoại và Email, chúng tôi sẽ liên hệ với bạn sớm nhất !</p>
        <p>Bấm vào <a href="<?php echo e(route('homeFront')); ?>" style="color: #4da6dc;">đây</a> để quay lại Trang Chủ</p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/thank.blade.php ENDPATH**/ ?>