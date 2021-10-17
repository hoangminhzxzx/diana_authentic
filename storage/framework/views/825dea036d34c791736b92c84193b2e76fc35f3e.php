<?php $__env->startSection('title'); ?>
    Đổi mật khẩu
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- ------------- account-page ------------ -->
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <a href=""><img src="" width="100%" alt=""></a>
                </div>
                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span id="restart_password" style="width: 100% !important;">Đổi mật khẩu</span>
                            <hr id="Indicator" style="width: 100% !important; transform: unset !important;">
                        </div>
                        <form action="" id="updateRestorePassForm" style="top: 80px;">
                            <input type="hidden" id="hidden_info" data-account-client-id="<?php echo e($account_client->id); ?>" data-account-client-password="<?php echo e($account_client->password); ?>" data-account-client-email="<?php echo e($account_client->email); ?>">
                            <input type="password" name="password" placeholder="Password">
                            <input type="password" name="confirm_password" placeholder="Confirm password">
                            <button type="button" class="btn" id="btnUpdateRestorePassForm">Lưu</button>
                            <span class="" id="span_error" style="color: tomato; font-size: 12px; width: 100%;"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/account/change_password_restore.blade.php ENDPATH**/ ?>