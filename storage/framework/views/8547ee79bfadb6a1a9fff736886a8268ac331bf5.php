<?php $__env->startSection('title'); ?>
    Đặt hàng | Diana Authentic
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
    <style>
        .text-danger {
            color: red;
        }
    </style>
    <div class="small-container" style="min-height: 400px; margin-top: 80px;">
        <div class="info-client">
            <form action="" method="post" id="form-pending-order">
                <?php echo csrf_field(); ?>
                <div class="row">

                    <div class="col-3">
                        <h3>Cập nhật thông tin <span><?php echo e($account_client->name); ?></span></h3>

                        <input type="text" name="name" placeholder="Họ tên" id="name" value="<?php echo e($account_client->name); ?>">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <input type="email" name="email" placeholder="Email" id="email" disabled value="<?php echo e($account_client->email); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <input type="number" name="phone" placeholder="Số điện thoại" id="phone" value="<?php echo e($account_client->phone); ?>">
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="address_vn" style="margin-top: 10px;">
                            <select name="province" id="province" class="select_checkout" onchange="selectProvince(this)">
                                <option value="" disabled="disabled" selected="" value="null">Tỉnh/Thành Phố</option>
                                <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($province->id); ?>"><?php echo e($province->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <input type="text" id="province" name="address_street_plus" placeholder="Số nhà, đường, ...">

                        <textarea name="note" id="note" cols="41" rows="10" placeholder="Ghi chú" style="padding-left: .5rem; padding-top: .5rem">

                        </textarea>
                    </div>
                    <div class="col-3">


                    </div>

                </div>
                <div class="row">

                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/account/detail.blade.php ENDPATH**/ ?>