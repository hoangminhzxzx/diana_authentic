<?php $__env->startSection('styles'); ?>
    <style>
        .item-circle {
            min-height: 60px;
            line-height: 60px;
            background: #eee3e3;
            border-radius: 50%;
            width: 25%;
            cursor: pointer;
        }
        .item-circle:hover {
            background: #d6e2ed;
        }

        .item-circle-success {
            background: #e6ecf3;

            min-height: 60px;
            line-height: 60px;
            border-radius: 50%;
            width: 25%;
            cursor: pointer;
        }
        .item-circle-success:hover {
            background: #d6e2ed;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <input type="hidden" value="<?php echo e($order_master->id); ?>" id="order_id">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Trạng thái đơn hàng</h6>
        </div>
        <div class="card-body d-flex">
            <div class="col-6 col-lg-3">
                <div class="block block-link-shadow text-center">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-success-light mx-auto" onclick="checkOrder(this)">

                            <i class="fa fa-sync fa-spin text-warning <?php if($order_master->status != 1): ?> d-none <?php endif; ?>"></i>
                            <i class="far fa-check-circle text-success <?php if($order_master->status != 2): ?> d-none <?php endif; ?>" style="font-size: 20px;"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">

                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Check đơn hàng
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="block block-link-shadow text-center" style="cursor: pointer" onclick="order_payment(148)">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-body mx-auto">
                            <i class="fa fa-sync fa-spin text-warning"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Đang giao hàng
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="block block-link-shadow text-center" style="cursor: pointer" onclick="order_payment(148)">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-body mx-auto">
                            <i class="fa fa-sync fa-spin text-warning"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Hoàn thành
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="block block-link-shadow text-center" style="cursor: pointer" onclick="order_cancel(148)">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-body mx-auto">
                            <i class="fa fa-times text-muted"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Hủy
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cart shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h6>
        </div>
        <div class="cart-body py-3">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Têm khách hàng</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Tên sản phẩm</th>
                    <th>Option</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá</th>
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $order_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($k+1); ?></td>
                        <td><?php echo e($order_master->customer_name); ?></td>
                        <td><?php echo e($order_master->customer_phone); ?></td>
                        <td><?php echo e($order_master->email); ?></td>
                        <td><b><?php echo e($item->product_title); ?></b></td>
                        <td><?php echo e($item->color); ?> - <?php echo e($item->size); ?></td>
                        <td><img src="<?php echo e(url($item->product_thumbnail)); ?>" alt="" class="img-thumbnail" width="120"></td>
                        <td><?php echo e(number_format($item->price, 0, '.', '.')); ?> VND</td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="info-more" style="padding: 0 3rem;">
                <h4 class="border-bottom-primary">Tổng đơn hàng</h4>
                <b class="mb-1"><?php echo e(number_format($order_master->total_price, 0, '.', '.')); ?> VND</b>

                <h4 class="border-bottom-success">Địa chỉ giao hàng</h4>
                <p><?php echo e($order_master->address); ?></p>

                <h4 class="border-bottom-danger">Note của đơn hàng</h4>
                <p><?php echo e($order_master->note); ?></p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/order/detail.blade.php ENDPATH**/ ?>