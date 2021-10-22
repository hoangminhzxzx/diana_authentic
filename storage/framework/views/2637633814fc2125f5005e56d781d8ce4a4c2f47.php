<ul>

    <?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <?php echo e($child->title); ?>

            <?php if(count($child->childs)): ?>
                <?php echo $__env->make('admin.category.manageChild',['childs' => $child->childs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/category/manageChild.blade.php ENDPATH**/ ?>