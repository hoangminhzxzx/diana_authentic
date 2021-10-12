
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3>Danh sách danh mục</h3>
            <?php if(session('status-delete')): ?>
                <div class="alert alert-success" role="alert"><?php echo e(session('status-delete')); ?></div>
            <?php endif; ?>
            <?php if(session('status-delete-error')): ?>
                <div class="alert alert-danger" role="alert"><?php echo e(session('status-delete-error')); ?></div>
            <?php endif; ?>
        </div>
        <div class="card-body" style="background: #ffffff;">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        <span><label class="checkbox checkbox-single checkbox-all"><input type="checkbox">&nbsp;<span></span></label></span>
                    </th>
                    <th class=""><span>Tên danh mục</span></th>
                    <th><span>Hành động</span></th>
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $list_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><span><label class="checkbox checkbox-single"><input type="checkbox" value="1">&nbsp;<span></span></label></span></td>
                        <td>
                            <span><?php echo e($category->title); ?></span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.category.edit', $category->id)); ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                <i class="fas fa-pen-alt"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
                               onclick="confirmDelete('#delete-category-<?php echo e($category->id); ?>');return false;">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <form method="POST" id="delete-category-<?php echo e($category->id); ?>"
                                  action="<?php echo e(route('admin.category.delete', $category->id)); ?>"
                                  style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/category/list.blade.php ENDPATH**/ ?>