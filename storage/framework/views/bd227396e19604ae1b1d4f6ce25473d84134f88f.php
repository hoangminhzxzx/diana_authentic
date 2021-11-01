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
            <?php if($order_master->status != config('constant.ORDER_STATUS.ORDER_CANCLE')): ?>
            <div class="col-6 col-lg-3" id="box_check_order">
                <div class="block block-link-shadow text-center">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-success-light mx-auto" <?php if($order_master->status == config('constant.ORDER_STATUS.ORDER')): ?> onclick="checkOrder(this)" <?php endif; ?> id="step_check_order">
                            <?php if($order_master->status < config('constant.ORDER_STATUS.CHECK_ORDER') || $order_master->status == config('constant.ORDER_STATUS.ORDER_CANCLE')): ?>
                                <i class="fa fa-sync fa-spin text-warning"></i>
                            <?php endif; ?>
                            <?php if($order_master->status >= config('constant.ORDER_STATUS.CHECK_ORDER') && $order_master->status != config('constant.ORDER_STATUS.ORDER_CANCLE')): ?>
                                <i class="far fa-check-circle text-success" style="font-size: 20px;"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">

                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Check đơn hàng
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3" id="box_shipping_order">
                <div class="block block-link-shadow text-center" style="cursor: pointer">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-body mx-auto" <?php if($order_master->status == config('constant.ORDER_STATUS.CHECK_ORDER')): ?> onclick="confirmShipOrder(this)" <?php endif; ?> id="step_confirm_shipping">
                            <?php if($order_master->status < config('constant.ORDER_STATUS.ORDER_SHIPPING') || $order_master->status == config('constant.ORDER_STATUS.ORDER_CANCLE')): ?>
                                <i class="fa fa-sync fa-spin text-warning"></i>
                            <?php endif; ?>
                            <?php if($order_master->status >= config('constant.ORDER_STATUS.ORDER_SHIPPING') && $order_master->status != config('constant.ORDER_STATUS.ORDER_CANCLE')): ?>
                                <i class="far fa-check-circle text-success" style="font-size: 20px;"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Đang giao hàng
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3" id="box_complete_order">
                <div class="block block-link-shadow text-center" style="cursor: pointer">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-body mx-auto" <?php if($order_master->status == config('constant.ORDER_STATUS.ORDER_SHIPPING')): ?> onclick="confirmCompleteOrder(this)" <?php endif; ?> id="step_confirm_complete">
                            <?php if($order_master->status < config('constant.ORDER_STATUS.ORDER_COMPLETE') || $order_master->status == config('constant.ORDER_STATUS.ORDER_CANCLE')): ?>
                                <i class="fa fa-sync fa-spin text-warning"></i>
                            <?php endif; ?>
                            <?php if($order_master->status == config('constant.ORDER_STATUS.ORDER_COMPLETE')): ?>
                                <i class="far fa-check-circle text-success" style="font-size: 20px;"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Hoàn thành
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($order_master->status != config('constant.ORDER_STATUS.ORDER_COMPLETE') && $order_master->status != config('constant.ORDER_STATUS.ORDER_CANCLE')): ?>
                <div class="col-6 col-lg-3" id="box_cancle_order">
                    <div class="block block-link-shadow text-center" style="cursor: pointer">
                        <div class="block-content block-content-full">
                            <div class="item item-circle bg-body mx-auto" id="cancle_order" onclick="cancleOrder(this)">
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
            <?php endif; ?>


                    <div class="col-6 col-lg-3 <?php if($order_master->status != config('constant.ORDER_STATUS.ORDER_CANCLE')): ?> d-none <?php endif; ?>" id="box_cancled_order">
                        <div class="block block-link-shadow text-center" style="cursor: pointer">
                            <div class="block-content block-content-full">
                                <div class="item item-circle bg-body mx-auto">

                                </div>
                            </div>
                            <div class="block-content py-2 bg-body-light">
                                <p class="font-w600 font-size-sm text-muted mb-0">
                                    Order đã hủy
                                </p>
                            </div>
                        </div>
                    </div>

        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h6>
        </div>
        <div class="cart-body py-3">
            <div class="pl-4">
                <p>Tên khách hàng : <?php echo e($order_master->customer_name); ?></p>
                <p>Phone : <?php echo e($order_master->customer_phone); ?></p>
                <p>Email : <?php echo e($order_master->email); ?></p>
            </div>
            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>



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



                        <td><a href="<?php echo e(route('admin.product.edit', ['id' => $item->product_id])); ?>" target="_blank"><b><?php echo e($item->product_title ? $item->product_title : ''); ?></b></a></td>
                        <td><?php echo e($item->color); ?> - <?php echo e($item->size); ?></td>
                        <td><img src="<?php echo e($item->product_thumbnail ? url($item->product_thumbnail) : ''); ?>" alt="" class="img-thumbnail" width="120"></td>
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