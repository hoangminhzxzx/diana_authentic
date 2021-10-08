
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-header">
                    <?php if(session('success_variant')): ?>
                        <div class="alert alert-success mt-3" role="alert"><?php echo e(session('success_variant')); ?></div>
                    <?php endif; ?>
                    <h3>Variants</h3>
                </div>
                <div class="card-body">
                    <?php if($product->category_id != 12): ?>
                        <form action="<?php echo e(route('admin.product.variant.update', $variant->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($product->id); ?>" name="product_id">
                            <div class="form-group color_hex">
                                <lable>Color Hex</lable>
                                <input type="text" name="color_hex" id="colorpicker_variant" value="<?php echo e($variant->color?$variant->color->value:""); ?>" class="form-control">
                                <?php $__errorArgs = ['color_hex'];
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
                            <div class="form-group color_name">
                                <lable>Color Name</lable>
                                <input type="text" name="color_name" value="<?php echo e($variant->color?$variant->color->name:""); ?>"
                                       class="form-control">
                                <?php $__errorArgs = ['color_name'];
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
                            <div class="form-group size">
                                <lable>Size</lable>
                                <input type="text" name="size" value="<?php echo e($variant->size?$variant->size->value:""); ?>" class="form-control">
                                <?php $__errorArgs = ['size'];
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







                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-outline-success w-25" value="Save">
                            </div>
                        </form>
                    <?php endif; ?>

                    <?php if($product->category_id == 12): ?>
                        <form action="<?php echo e(route('admin.product.variantAss.update', $variant->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="<?php echo e($product->id); ?>" name="product_id">
                            <div class="form-group">
                                <lable>Giá phụ kiện</lable>
                                <input type="number" name="price" class="form-control" value="<?php echo e($variant->price?$variant->price:""); ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-success">
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js" type="text/javascript"></script>
    <script>
        $("#colorpicker_variant").spectrum();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/variant/edit.blade.php ENDPATH**/ ?>