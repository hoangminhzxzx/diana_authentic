

<?php $__env->startSection('content'); ?>
    <div class="card mx-5">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Edit Category</h3>
                        <?php if(session('status-not-exist')): ?>
                            <div class="alert alert-success" role="alert"><?php echo e(session('status-not-exist')); ?></div>
                        <?php endif; ?>
                        <form role="form" method="POST" action="<?php echo e(route('admin.category.update', $category->id)); ?>"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                                <label>Title:</label>
                                <input type="text" id="title" name="title" value="<?php echo e($category->title); ?>" class="form-control"
                                       placeholder="Enter Title">
                                <?php if($errors->has('title')): ?>
                                    <span class="text-red" role="alert">
                                <strong><?php echo e($errors->first('title')); ?></strong>
                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group <?php echo e($errors->has('parent_id') ? 'has-error' : ''); ?>">
                                <label>Category:</label>
                                <select id="parent_id" name="parent_id" class="form-control">
                                    <option value="0">Select</option>
                                    <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($rows->id); ?>"
                                        <?php if($category->parent_id == $rows->id): ?> selected <?php endif; ?>
                                        ><?php echo e($rows->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('parent_id')): ?>
                                    <span class="text-red" role="alert">
                                <strong><?php echo e($errors->first('parent_id')); ?></strong>
                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <lable>Phụ kiện</lable>
                                <input type="checkbox" name="is_accessory" <?php if($category->is_accessory == 1): ?> checked <?php endif; ?>>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/category/edit.blade.php ENDPATH**/ ?>