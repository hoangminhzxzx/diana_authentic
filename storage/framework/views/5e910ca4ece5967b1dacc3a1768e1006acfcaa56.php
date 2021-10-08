
<?php $__env->startSection('title'); ?>
    Chi tiết sản phẩm
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .active_color {
            border: 2px solid blue;
        }
    </style>
    <!-- -------------- single product --------------------->
    <div class="small-container single-product">
        <input type="hidden" value="<?php if (isset($is_accessory) && $is_accessory == 1) { echo $is_accessory; } else echo 0; ?>" name="is_accessory" id="is_accessory">
        <div class="row" style="align-items: unset;">
            <div class="col-2">
                <img src="<?php echo e(url($product->thumbnail)); ?>" id="ProductImg">
                <div class="small-img-row">
                    <div class="small-img-col">
                        <img src="<?php echo e(url($product->thumbnail)); ?>" width="100%" class="small-img" onclick="changeImagePreview(this)" style="height: 96%;">
                    </div>
                    <?php if($product->images): ?>
                    <?php $__currentLoopData = json_decode($product->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="small-img-col">
                        <img src="<?php echo e(url($image)); ?>" width="100%" class="small-img" onclick="changeImagePreview(this)">
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                </div>
            </div>
            <div class="col-2">
                
                
                <input type="hidden" id="product_id" value="<?php echo e($product->id); ?>">
                <p>Trang chủ / <?php echo e($product->category->title); ?></p>
                <h1><?php echo e($product->title); ?></h1>
                <h4><?php echo e(number_format($product->price, 0, '.', '.')); ?> VNĐ</h4>
                <?php if($is_accessory == 0): ?>
                <input type="hidden" value="" id="valueSize" name="size">
                <select id="chooseSize" onchange="chooseSize(this)" style="border: 1px solid #ccc;">
                    <option value="">Chọn size</option>
                    <?php if(isset($sizes) && $sizes): ?>
                    <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($size->id); ?>"><?php echo e($size->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
                <?php endif; ?>
                <?php $__errorArgs = ['size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small style="color: indianred;"><?php echo e($message); ?></small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <input type="number" value="1" min="1" name="qty" style="margin-top: 1rem; border: 1px solid #000; border: 1px solid #ccc;">
                <input type="button" onclick="addToCart(this)" class="btn" value="Thêm vào giỏ hàng" id="" style="width: 100%;">
                <h3>Chi tiết sản phẩm <i class="fa fa-indent"></i></h3>


                <div><?php echo $product->content; ?></div>
                
            </div>
        </div>
    </div>

    <!-- ---------------title------------- -->
    <div class="small-container">
        <div class="row row-2">
            <h2>Sản phẩm liên quan</h2>
            <a href="">Xem thêm</a>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/product/detail.blade.php ENDPATH**/ ?>