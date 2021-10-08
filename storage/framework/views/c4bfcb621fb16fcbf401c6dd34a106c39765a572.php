<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách ORDER</h6>
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