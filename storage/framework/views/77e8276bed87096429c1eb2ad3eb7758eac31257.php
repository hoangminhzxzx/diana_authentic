<div class="form-group" style="margin-top: .5rem;" id="group_color">
    <label for="">Chọn Màu</label>
    <div style="display: flex;">
        <input type="hidden" id="valueColor" name="color" value="">
        <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div onclick="chooseColor(this)" data-color="<?php echo e($color->id); ?>" style="background: <?php echo e($color->value); ?>; width: 30px; height: 30px; border-radius: 50%; margin-top: .5rem; cursor: pointer; margin-right: .5rem;"></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php $__errorArgs = ['color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <small style="color: indianred;"><?php echo e($message); ?></small>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/product/render_list_color.blade.php ENDPATH**/ ?>