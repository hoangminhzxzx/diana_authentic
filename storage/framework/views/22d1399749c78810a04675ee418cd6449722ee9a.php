<select name="ward" id="ward" class="select_checkout">
    <option value="" disabled="disabled" selected="" value="null">Phường/Xã</option>
    <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($ward->id); ?>"><?php echo e($ward->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/ajax_render/render_wards.blade.php ENDPATH**/ ?>