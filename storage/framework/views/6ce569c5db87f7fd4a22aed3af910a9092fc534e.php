<?php $__env->startSection('title'); ?>
    Trang chủ
<?php $__env->stopSection(); ?>
<?php $__env->startSection('poster'); ?>
    <div class="row">
        <div class="col-2">
            <h1>Diana Authentic <br>Sản Phẩm </h1>
            <?php if(isset($product_banners[0]) && $product_banners): ?>

                <p><?php echo e($product_banners[0]->title); ?></p>
                <a href="<?php echo e(route('client.product.detail', ['slug' => $product_banners[0]->slug])); ?>" class="btn">Mua ngay &#8594;</a>
            <?php endif; ?>
        </div>
        <div class="col-2">
            <?php if(isset($product_banners[0]) && $product_banners[0]): ?>
               <img src="<?php echo e(url($product_banners[0]->thumbnail)); ?>">

            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- featured categories -->
















    <!-- hot products -->
    <div class="small-container" style="margin-top: 2rem;">
        <h2 class="title">Sản phẩm hot</h2>
        <div class="row" style="justify-content: unset;">
            <?php if(isset($list_products_hot) && $list_products_hot): ?>
            <?php $__currentLoopData = $list_products_hot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-4">
                        <a href="<?php echo e(route('client.product.detail', ['slug'=>$item->slug])); ?>"><img src="<?php echo e(url($item->thumbnail)); ?>" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center"><?php echo e($item->title); ?></h4>
                        <p><?php echo e(number_format($item->price, 0, '.', '.')); ?>đ</p>
                    </div>
                    <div class="col-4">
                        <a href="<?php echo e(route('client.product.detail', ['slug'=>$item->slug])); ?>"><img src="<?php echo e(url($item->thumbnail)); ?>" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center"><?php echo e($item->title); ?></h4>
                        <p><?php echo e(number_format($item->price, 0, '.', '.')); ?>đ</p>
                    </div>
                    <div class="col-4">
                        <a href="<?php echo e(route('client.product.detail', ['slug'=>$item->slug])); ?>"><img src="<?php echo e(url($item->thumbnail)); ?>" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center"><?php echo e($item->title); ?></h4>
                        <p><?php echo e(number_format($item->price, 0, '.', '.')); ?>đ</p>
                    </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- hot products -->
    <div class="small-container">
        <h2 class="title">Sản phẩm bán chạy</h2>
        <div class="row" style="justify-content: unset;">
            <?php if(isset($list_products_hot) && $list_products_hot): ?>
                <?php $__currentLoopData = $list_products_hot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-4">
                        <a href="<?php echo e(route('client.product.detail', ['slug'=>$item->slug])); ?>"><img src="<?php echo e(url($item->thumbnail)); ?>" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center"><?php echo e($item->title); ?></h4>
                        <p><?php echo e(number_format($item->price, 0, '.', '.')); ?>đ</p>
                    </div>
                    <div class="col-4">
                        <a href="<?php echo e(route('client.product.detail', ['slug'=>$item->slug])); ?>"><img src="<?php echo e(url($item->thumbnail)); ?>" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center"><?php echo e($item->title); ?></h4>
                        <p><?php echo e(number_format($item->price, 0, '.', '.')); ?>đ</p>
                    </div>
                    <div class="col-4">
                        <a href="<?php echo e(route('client.product.detail', ['slug'=>$item->slug])); ?>"><img src="<?php echo e(url($item->thumbnail)); ?>" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center"><?php echo e($item->title); ?></h4>
                        <p><?php echo e(number_format($item->price, 0, '.', '.')); ?>đ</p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- offer -->
    <?php if(isset($product_banners[1]) && $product_banners[1]): ?>
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="<?php echo e(url($product_banners[1]->thumbnail)); ?>" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Sản phẩm tiếp theo của Diana Authentic</p>
                    <h1><?php echo e($product_banners[1]->title); ?></h1>
                    <small><?php echo $product_banners[1]->desc; ?></small>
                    <a href="<?php echo e(route('client.product.detail', ['slug' => $product_banners[1]->slug])); ?>" class="btn">Mua ngay &#8594;</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ----testimonial-------- -->














































    <!-- -------brands----------- -->





















<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/home.blade.php ENDPATH**/ ?>