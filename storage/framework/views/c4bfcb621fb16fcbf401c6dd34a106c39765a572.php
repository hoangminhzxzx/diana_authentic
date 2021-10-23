<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách ORDER</h6>
            <form action="<?php echo e(route('admin.order.list')); ?>" method="GET">
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="filter_keyword" value="<?php echo e($filter_keyword ? $filter_keyword : ''); ?>" class="form-control" placeholder="Tìm kiếm order">
                    </div>
                    <div class="col-4">
                        <select name="filter_status" id="" class="form-control">
                            <option value="">Trạng thái</option>
                            <option value="1" <?php if($filter_status == 1): ?> selected <?php endif; ?>>Đặt hàng</option>
                            <option value="2" <?php if($filter_status == 2): ?> selected <?php endif; ?>>Check order</option>
                            <option value="3" <?php if($filter_status == 3): ?> selected <?php endif; ?>>Shipping</option>
                            <option value="4" <?php if($filter_status == 4): ?> selected <?php endif; ?>>Complete</option>
                            <option value="5" <?php if($filter_status == 5): ?> selected <?php endif; ?>>Cancle</option>
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
                        <th>Mã Đơn Hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Created_at</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>#<?php echo e($order->id); ?></td>
                            <td><b><?php echo e($order->customer_name); ?></b></td>
                            <td><?php echo e($order->customer_phone); ?></td>
                            <td><?php echo e($order->email); ?></td>
                            <td><?php echo e($order->created_at); ?></td>
                            <td>
                                <?php if($order->status == 1): ?>
                                    <span class="badge badge-success">Order</span>
                                <?php endif; ?>
                                <?php if($order->status == 2): ?>
                                    <span class="badge badge-warning">Check Order</span>
                                <?php endif; ?>
                                <?php if($order->status == 3): ?>
                                    <span class="badge badge-primary">Đang giao hàng</span>
                                <?php endif; ?>
                                <?php if($order->status == 4): ?>
                                    <span class="badge badge-info">Hoàn thành</span>
                                <?php endif; ?>
                                <?php if($order->status == 5): ?>
                                    <span class="badge badge-danger">Hủy đơn hàng</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.order.detail', $order->id)); ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                    <i class="fas fa-pen-alt"></i>
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


<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/order/list.blade.php ENDPATH**/ ?>