<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Ảnh đại diện</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Trạng thái kích hoạt</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $list_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="row-product-<?php echo e($product->id); ?>">
                        <td><img src="<?php echo e(url($product->thumbnail)); ?>" alt="" class="img-thumbnail" width="120"></td>
                        <td><?php echo e($product->title); ?></td>
                        <td><b><?php echo e($product->category->title); ?></b></td>
                        <td>







                            <!-- switch -->
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" onchange="setPublishProduct(this, <?php echo e($product->id); ?>)" id="set-publish-<?php echo e($product->id); ?>" <?php if($product->is_publish == 1): ?> checked <?php endif; ?>>
                                <label class="custom-control-label" for="set-publish-<?php echo e($product->id); ?>"></label>
                            </div>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.product.edit', $product->id)); ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                <i class="fas fa-pen-alt"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm" onclick="deleteProduct(this, <?php echo e($product->id); ?>)">
                                <i class="fas fa-trash-alt"></i>
                            </a>









                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/product/index.blade.php ENDPATH**/ ?>