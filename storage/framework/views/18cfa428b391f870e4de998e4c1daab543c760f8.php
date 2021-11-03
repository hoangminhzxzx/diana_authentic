<tr>







    <td><span><?php echo e(($item->color)?$item->color->value:""); ?></span></td>
    <td><span><?php echo e(($item->color)?$item->color->name:""); ?></span></td>
    <td><span><?php echo e(($item->size)?$item->size->value:""); ?></span></td>
    <td><span><?php echo e(($item->qty)?$item->qty:""); ?></span></td>
    <td>
        <a href="<?php echo e(route('admin.product.variant.edit', ['id'=>$item->id])); ?>"
           class="btn btn-icon btn-light btn-hover-primary btn-sm mr-1">
            <i class="fas fa-pen-alt"></i>
        </a>
        <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
           onclick="confirmDelete('#delete-variant-<?php echo e($item->id); ?>');return false;">
            <i class="fas fa-trash-alt"></i>
        </a>
        <form method="POST" id="delete-variant-<?php echo e($item->id); ?>"
              action="<?php echo e(route('admin.product.variant.delete', ['id'=>$item->id])); ?>"
              style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
    </td>
</tr>
<?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/product/row_variant_ajax.blade.php ENDPATH**/ ?>