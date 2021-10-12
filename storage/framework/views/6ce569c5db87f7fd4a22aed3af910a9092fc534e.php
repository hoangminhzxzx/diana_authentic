<?php $__env->startSection('title'); ?>
    Trang chủ
<?php $__env->stopSection(); ?>
<?php $__env->startSection('poster'); ?>
    <div class="row">
        <div class="col-2">
            <h1>Diana Authentic <br>Sản Phẩm </h1>
            <?php if(isset($product_banner) && $product_banner): ?>

                <p><?php echo e($product_banner->title); ?></p>
                <a href="<?php echo e(route('client.product.detail', ['slug' => $product_banner->slug])); ?>" class="btn">Mua ngay &#8594;</a>
            <?php endif; ?>
        </div>
        <div class="col-2">
            <?php if(isset($product_banner) && $product_banner): ?>
               <img src="<?php echo e(url($product_banner->thumbnail)); ?>">

            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- featured categories -->
    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-4">
                    <img src="<?php echo e(url('public/images/category-1.jpg')); ?>" alt="">
                </div>
                <div class="col-4">
                    <img src="<?php echo e(url('public/images/category-2.jpg')); ?>" alt="">
                </div>
                <div class="col-4">
                    <img src="<?php echo e(url('public/images/category-3.jpg')); ?>" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- featured products -->
    <div class="small-container">
        <h2 class="title">Sản phẩm hot</h2>
        <div class="row" style="justify-content: unset;">
            <?php $__currentLoopData = $list_products_hot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-4">
                <a href="<?php echo e(route('client.product.detail', ['slug'=>$item->slug])); ?>"><img src="<?php echo e(url($item->thumbnail)); ?>" style="max-width: 200px;"></a>
                <h4 class="product-title text-center"><?php echo e($item->title); ?></h4>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>









    </div>

    <!-- offer -->
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="<?php echo e(url('public/images/exclusive.png')); ?>" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                    <h1>Lorem ipsum dolor sit.</h1>
                    <small>The Mi Smart Band 4 featured a 39.9% larger (than Mi Band 3) AMOLED color full-touch display with adjustable brightness, so everything is clear as can</small>
                    <a href="" class="btn">Mua ngay &#8594;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ----testimonial-------- -->














































    <!-- -------brands----------- -->





















<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/home.blade.php ENDPATH**/ ?>