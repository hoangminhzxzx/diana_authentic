
<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php if(session('status_add_user')): ?>
                <div class="alert alert-success mt-3" role="alert"><?php echo e(session('status_add_user')); ?></div>
            <?php endif; ?>
            <?php if(session('status_update_user')): ?>
                <div class="alert alert-success mt-3" role="alert"><?php echo e(session('status_update_user')); ?></div>
            <?php endif; ?>
            <?php if(session('status_delete_user')): ?>
                <div class="alert alert-success mt-3" role="alert"><?php echo e(session('status_delete_user')); ?></div>
            <?php endif; ?>
            <h6 class="m-0 font-weight-bold text-primary">List User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->username); ?></td>
                        <td><?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($r->role_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.user.edit', $user->id)); ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                <i class="fas fa-pen-alt"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
                               onclick="confirmDelete('#delete-user-<?php echo e($user->id); ?>');return false;">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <form method="POST" id="delete-user-<?php echo e($user->id); ?>"
                                  action="<?php echo e(route('admin.user.delete', $user->id)); ?>"
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

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/user/index.blade.php ENDPATH**/ ?>