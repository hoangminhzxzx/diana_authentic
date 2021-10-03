
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
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Ảnh đại diện</th>
                        <th>Trạng thái kích hoạt</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $list_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($product->title); ?></td>
                        <td><b><?php echo e($product->category->title); ?></b></td>
                        <td><img src="<?php echo e(url($product->thumbnail)); ?>" alt="" class="img-thumbnail" width="120"></td>
                        <td>
                            <?php if($product->is_publish == 1): ?>
                                Kích hoạt
                            <?php endif; ?>
                            <?php if($product->is_publish == 2): ?>
                                Không kích hoạt
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.product.edit', $product->id)); ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                <i class="fas fa-pen-alt"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
                               onclick="confirmDelete('#delete-product-<?php echo e($product->id); ?>');return false;">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <form method="POST" id="delete-product-<?php echo e($product->id); ?>"
                                  action="<?php echo e(route('admin.product.delete', $product->id)); ?>"
                                  style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
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