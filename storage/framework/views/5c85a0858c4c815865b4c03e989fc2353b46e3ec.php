
<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card mx-4">
    <div class="card-header">
        <h3>Tạo sản phẩm</h3>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.product.store')); ?>" method="POST" enctype="multipart/form-data" id="uploadProduct" class="">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <lable>Tên sản phẩm</lable>
                <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control">
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <lable>Mô tả ngắn</lable>
                <textarea name="desc" class="form-control" id="desc" cols="30" rows="3"></textarea>
                <?php $__errorArgs = ['desc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <lable>Chi tiết sản phẩm</lable>
                <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
            </div>








            <div class="form-group">
                <lable>Ảnh đại diện</lable>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <div class="form-group">
                <lable>Kích hoạt</lable>
                <select name="is_publish" id="" class="form-control">
                    <option value="0">Choose</option>
                    <option value="1">Publish</option>
                    <option value="2">Unpublish</option>
                </select>
            </div>
            <div class="form-group">
                <lable>Giá sản phẩm</lable>
                <input type="text" name="price" class="form-control">
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="text-danger"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <lable>Danh mục cha</lable>
                <select name="category_id" id="" class="form-control">
                    <option value="0">Choose</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-outline-success w-25" value="Add">
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>









































<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/product/add.blade.php ENDPATH**/ ?>