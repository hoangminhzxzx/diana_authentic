<select name="district" id="district" class="select_checkout" onchange="selectDistrict(this)">
    <option value="" disabled="disabled" selected="" value="null">Quận/Huyện</option>
    <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($district->id); ?>"><?php echo e($district->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/ajax_render/render_districts.blade.php ENDPATH**/ ?>