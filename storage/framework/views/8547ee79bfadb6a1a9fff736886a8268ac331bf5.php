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
            <form action="<?php echo e(route('client.update.account')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row" style="margin-bottom: 4rem;">
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

                        <input type="date" name="birth_day" value="<?php echo e($account_client->date_of_birth); ?>">

                        <input type="text" name="phone" placeholder="Số điện thoại" id="phone" value="<?php echo e($account_client->phone ? $account_client->phone : old('phone')); ?>">
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
                                    <option value="<?php echo e($province->id); ?>" <?php if($province->id == $account_client->province_id): ?> selected <?php endif; ?>><?php echo e($province->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <?php if($account_client->district_id): ?>
                            <select name="district" id="district" class="select_checkout" onchange="selectDistrict(this)">
                                <option value="" disabled="disabled" selected="" value="null">Quận/Huyện</option>
                                <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($district->id); ?>" <?php if($district->id == $account_client->district_id): ?> selected <?php endif; ?>><?php echo e($district->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        <?php endif; ?>

                        <?php if($account_client->ward_id): ?>
                            <select name="ward" id="ward" class="select_checkout">
                                <option value="" disabled="disabled" selected="" value="null">Phường/Xã</option>
                                <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ward->id); ?>" <?php if($ward->id == $account_client->ward_id): ?> selected <?php endif; ?>><?php echo e($ward->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        <?php endif; ?>

                        <input type="text" name="address_plus" placeholder="Số nhà, đường, ..." value="<?php echo e($account_client->address_plus); ?>">

                        <button type="submit" class="btn">Lưu</button>
                    </div>
                    <div class="col-3">

                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/account/detail.blade.php ENDPATH**/ ?>