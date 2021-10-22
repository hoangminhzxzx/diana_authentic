<?php $__env->startSection('title'); ?>
    <?php echo e($category_title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="small-container">
        <div class="row row-2" style="padding-left: 10px;">
            <h2>Áo của Diana Authentic</h2>
            <form action="<?php echo e(route('client.category.list.product', ['slug' => $slug])); ?>" id="formFilterProduct">

                <select name="orderBy" style="border: 1px solid #ccc;" onchange="orderProduct(this)" data-category-slug="<?php echo e($slug); ?>">

                    <option value="asc" <?php if(isset($orderBy) && $orderBy == 'asc'): ?> selected <?php endif; ?>>Giá tăng dần</option>
                    <option value="desc" <?php if(isset($orderBy) && $orderBy == 'desc'): ?> selected <?php endif; ?>>Giá giảm dần</option>
                </select>

                <select name="limit" style="border: 1px solid #ccc;" onchange="orderProduct(this)" data-category-slug="<?php echo e($slug); ?>">
                    
                    <option value="4" <?php if(isset($limit) && $limit == 4): ?> selected <?php endif; ?>>4</option>
                    <option value="8" <?php if(isset($limit) && $limit == 8): ?> selected <?php endif; ?>>8</option>
                    <option value="12" <?php if(isset($limit) && $limit == 12): ?> selected <?php endif; ?>>12</option>
                    <option value="16" <?php if(isset($limit) && $limit == 16): ?> selected <?php endif; ?>>16</option>
                    <option value="20" <?php if(isset($limit) && $limit == 20): ?> selected <?php endif; ?>>20</option>
                </select>
            </form>
        </div>
        <div class="row" style="justify-content: unset;">
            <?php $__currentLoopData = $list_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-4">
                <a href="<?php echo e(route('client.product.detail', ['slug' => $product->slug])); ?>"><img src="<?php echo e(url($product->thumbnail)); ?>" alt=""></a>
                <h4><?php echo e($product->title); ?></h4>







                <p><?php echo e(number_format($product->price, 0, '.', '.')); ?>đ</p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo e($list_product->render('vendor.pagination.bootstrap-4')); ?>








    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/category/list_product.blade.php ENDPATH**/ ?>