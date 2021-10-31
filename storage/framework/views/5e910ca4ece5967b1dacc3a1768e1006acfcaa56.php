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
        <input type="hidden"
               value="<?php if (isset($is_accessory) && $is_accessory == 1) { echo $is_accessory; } else echo 0; ?>"
               name="is_accessory" id="is_accessory">
        <div class="row" style="align-items: unset;">
            <div class="col-2">
                <div style="text-align: center;">
                    <img src="<?php echo e(url($product->thumbnail)); ?>" id="ProductImg">
                </div>
                <?php if($product->images): ?>
                    <div class="small-img-row thumb-image-slider">
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        

                        <div class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    
                                    <li class="splide__slide">
                                        <img src="<?php echo e(url($product->thumbnail)); ?>" width="100%" class="small-img">
                                    </li>
                                    <?php $__currentLoopData = json_decode($product->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="splide__slide">
                                            <img src="<?php echo e(url($image)); ?>" class="small-img">
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-2">
                
                
                <input type="hidden" id="product_id" value="<?php echo e($product->id); ?>">
                <p>Trang chủ / <?php echo e($product->category->title); ?></p>
                <h1><?php echo e($product->title); ?></h1>
                <h4><?php echo e(number_format($product->price, 0, '.', '.')); ?> VNĐ</h4>
                <?php if($is_accessory == 0): ?>
                    <input type="hidden" value="" id="valueSize" name="size">
                    <select id="chooseSize" onchange="chooseSize(this)" style="border: 1px solid #ccc;">
                        <option value="nothing">Chọn size</option>
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
                <input type="number" value="1" min="1" max="" name="qty"
                       style="margin-top: 1rem; border: 1px solid #000; border: 1px solid #ccc; display: none;">
                <input type="button" onclick="addToCart(this)" class="btn" value="Thêm vào giỏ hàng" id=""
                       style="width: 100%;">
                <?php if($product->content): ?>
                    <h3>Chi tiết sản phẩm <i class="fa fa-indent"></i></h3>
                <?php endif; ?>
                
                
                <div><?php echo $product->content; ?></div>
                
            </div>
        </div>
    </div>

    <!-- ---------------title------------- -->
    <div class="small-container">
        <div class="row row-2" style="margin-bottom: 0px;">
            <h2>Sản phẩm liên quan</h2>
            <a href="<?php echo e(route('client.category.list.product', ['slug' => $category_slug])); ?>"
               style="text-decoration: underline;">Xem thêm</a>
        </div>
        <div class="row" style="justify-content: unset;">
            <?php $__currentLoopData = $list_product_more; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-4">
                    <a href="<?php echo e(route('client.product.detail', ['slug'=>$item->slug])); ?>"><img
                            src="<?php echo e(url($item->thumbnail)); ?>" style="max-width: 200px;"></a>
                    <h4 class="product-title text-center"><?php echo e($item->title); ?></h4>
                    <p><?php echo e(number_format($item->price, 0, '.', '.')); ?>đ</p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function () {
            var splide = new Splide('.splide', {
                type: 'loop',
                perPage: 3,
                perMove: 1,
            });

            splide.mount();

            splide.on('active', function (index) {
                // do something
                let image_main = document.getElementById('ProductImg');
                let slide_active = index.slide,
                    src_slide_active = slide_active.firstElementChild.getAttribute('src');
                image_main.setAttribute('src', src_slide_active);
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/product/detail.blade.php ENDPATH**/ ?>