<?php $__env->startSection('content'); ?>
    <div class="row mx-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
                    <form action="<?php echo e(route('admin.product.list')); ?>" method="GET">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" name="filter_keyword" value="<?php echo e($filter_keyword ? $filter_keyword : ''); ?>" class="form-control" placeholder="Tìm kiếm sản phẩm">
                            </div>
                            <div class="col-1">
                                <select name="filter_status" id="" class="form-control">
                                    <option value="">Trạng thái</option>
                                    <option value="on" <?php if($filter_status == 'on'): ?> selected <?php endif; ?>>Kích hoạt</option>
                                    <option value="off" <?php if($filter_status == 'off'): ?> selected <?php endif; ?>>Vô hiệu hóa</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <select name="filter_category" id="" class="form-control">
                                    <option value="">Danh mục</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option class="<?php if($category->parent_id == 0): ?> font-weight-bold <?php endif; ?>" value="<?php echo e($category->id); ?>" <?php if($category->id == $filter_category): ?> selected <?php endif; ?>><?php echo e($category->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-1">
                                <select name="sort_view" id="" class="form-control">
                                    <option value="">Lượt view</option>
                                    <option value="asc" <?php if(isset($sort_view) && $sort_view == 'asc'): ?> selected <?php endif; ?>>Tăng dần</option>
                                    <option value="desc" <?php if(isset($sort_view) && $sort_view == 'desc'): ?> selected <?php endif; ?>>Giảm dần</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                        </div>
                    </form>
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
                                <th>Ngày tạo</th>
                                <th>Lượt xem</th>
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
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                   onchange="setPublishProduct(this, <?php echo e($product->id); ?>)"
                                                   id="set-publish-<?php echo e($product->id); ?>"
                                                   <?php if($product->is_publish == 1): ?> checked <?php endif; ?>>
                                            <label class="custom-control-label" for="set-publish-<?php echo e($product->id); ?>"></label>
                                        </div>
                                    </td>
                                    <td><?php echo e(substr($product->created_at, 0, 10)); ?></td>
                                    <td><?php echo e(number_format($product->total_view, 0, '.', '.')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.product.edit', $product->id)); ?>"
                                           class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                            <i class="fas fa-pen-alt"></i>
                                        </a>
                                        <a class="btn btn-icon btn-light btn-hover-danger btn-sm"
                                           onclick="deleteProduct(this, <?php echo e($product->id); ?>)">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($list_product->render('vendor.pagination.bootstrap-4')); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/product/index.blade.php ENDPATH**/ ?>