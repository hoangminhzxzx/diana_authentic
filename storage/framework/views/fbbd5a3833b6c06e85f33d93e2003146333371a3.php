<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row mx-4">
        <div class="col-12 mb-5">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách member Diana Authentic</h6>
                    <form action="<?php echo e(route('admin.member.index')); ?>" method="GET">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" name="filter_keyword"
                                       value="<?php echo e($keyword ? $keyword : ''); ?>" class="form-control"
                                       placeholder="Tìm kiếm hội viên">
                            </div>
                            <div class="col-4">
                                <select name="filter_status" id="" class="form-control">
                                    <option value="">Rank</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <?php if(isset($members) && $members): ?>
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ngày đăng ký</th>
                                <th>Rank</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(($member->name) ? $member->name : 'member name'); ?></td>
                                <td><?php echo e(($member->phone) ? $member->phone : 'member phone'); ?></td>
                                <td><?php echo e($member->email); ?></td>
                                <td><?php echo e(substr($member->created_at, 0, 10)); ?></td>
                                <td><span class="badge-success">Comming soon</span></td>
                                <td>
                                    <a class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3" data-toggle="modal" data-target="#modalDetail-<?php echo e($member->id); ?>">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modalDetail-<?php echo e($member->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="max-width: 700px !important;;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo e($member->name ? $member->name : 'member name'); ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-3">Email : </div>
                                                    <div class="col-md-9"><?php echo e($member->email); ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Username : </div>
                                                    <div class="col-md-9"><?php echo e($member->username); ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Phone : </div>
                                                    <div class="col-md-9"><?php echo e($member->phone); ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Sinh nhật : </div>
                                                    <div class="col-md-9"><?php echo e($member->date_of_birth); ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Địa chỉ : </div>
                                                    <div class="col-md-9"><?php echo e($member->address); ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 text-success">Tổng Pay : </div>
                                                    <div class="col-md-9 text-success"><?php echo e(number_format($member->total_pay, 0,'.','.')); ?> VNĐ</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Rank : </div>
                                                    <div class="col-md-9"><span class="badge-success">Coming soon</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($members->render('vendor.pagination.bootstrap-4')); ?>

                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
























<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/member/index.blade.php ENDPATH**/ ?>