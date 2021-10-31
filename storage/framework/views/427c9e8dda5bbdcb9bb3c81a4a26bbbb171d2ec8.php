<tr class="row-stock-<?php echo e($stock->id); ?>">
    <td id="div_images_<?php echo e($stock->id); ?>">
        <?php if($stock->images): ?>
        <?php $__currentLoopData = json_decode($stock->images, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <img src="<?php echo e(url($image)); ?>" alt="" class="img-thumbnail" width="70">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </td>
    <td><?php echo e(number_format($stock->input, 0, '.', '.')); ?></td>
    <td><?php echo e(number_format($stock->total_price, 0, '.', '.')); ?> VNĐ</td>
    <td><?php echo e($stock->note); ?></td>
    <td><?php echo e(substr($stock->created_at, 0, 10)); ?></td>
    <td>
        <a href="<?php echo e(route('admin.stock.edit', $stock->id)); ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
            <i class="fas fa-pen-alt"></i>
        </a>



        <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
           onclick="confirmDelete('#delete-stock-<?php echo e($stock->id); ?>');return false;">
            <i class="fas fa-trash-alt"></i>
        </a>
        <form method="POST" id="delete-stock-<?php echo e($stock->id); ?>"
              action="<?php echo e(route('admin.stock.delete', $stock->id)); ?>"
              style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
    </td>
</tr>
<?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/stock/row_stock_ajax.blade.php ENDPATH**/ ?>