

<?php $__env->startSection('content'); ?>
    <div class="card mx-5">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Danh sách danh mục</h3>
                        <ul id="tree1">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <?php echo e($category->title); ?>

                                    <?php if(count($category->childs)): ?>
                                        <?php echo $__env->make('admin.category.manageChild',['childs' => $category->childs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Tạo danh mục mới</h3>
                        <form role="form" id="category" method="POST" action="<?php echo e(route('add.category')); ?>"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
                                <label>Tên:</label>
                                <input type="text" id="title" name="title" value="" class="form-control"
                                       placeholder="Enter Title">
                                <?php if($errors->has('title')): ?>
                                    <span class="text-red" role="alert">
                                <strong><?php echo e($errors->first('title')); ?></strong>
                            </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group <?php echo e($errors->has('parent_id') ? 'has-error' : ''); ?>">
                                <label>Danh mục cha:</label>
                                <select id="parent_id" name="parent_id" class="form-control">
                                    <option value="0">Select</option>
                                    <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($rows->id); ?>"><?php echo e($rows->title); ?></option>
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
                                <input type="checkbox" name="is_accessory">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/category/categoryTreeview.blade.php ENDPATH**/ ?>