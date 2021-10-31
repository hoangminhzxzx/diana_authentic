<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <!-- Page Heading -->
    
    
    
    

    <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Lượt truy cập
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($statistic->view, 0, '.', '.')); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-eye fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Doanh thu
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($statistic->total_sales, 0, '.', '.')); ?>

                                    VNĐ
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Số order hoàn thành
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div
                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo e(number_format($count_order_complete, 0, '.', '.')); ?></div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Số order bị hủy
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e(number_format($count_order_cancle, 0, '.', '.')); ?></div>
                            </div>
                            <div class="col-auto">

                                <i class="far fa-window-close fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if(isset($product_top_view) && $product_top_view): ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Sản phẩm có lượt view cao nhất
                                    </div>

                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <a <?php if($product_top_view->is_publish == 1): ?> href="<?php echo e(route('client.product.detail', ['slug' => $product_top_view->slug])); ?>" target="_blank" <?php endif; ?> class="">
                                            <?php echo e($product_top_view->title); ?>

                                        </a>
                                    </div>
                                    <span class="text-muted d-block" style="font-size: 0.8rem;"><?php if($product_top_view->is_publish == 0): ?> Sản phẩm đang bị vô hiệu hóa <?php endif; ?></span>
                                </div>
                                <div class="col-auto">
                                    <?php echo e(number_format($product_top_view->total_view, 0, '.', '.')); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(isset($product_top_sales) && $product_top_sales): ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Sản phẩm có doanh thu cao nhất
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <a <?php if($product_top_sales_info->is_publish == 1): ?> href="<?php echo e(route('client.product.detail', ['slug' => $product_top_sales_info->slug])); ?>" target="_blank" <?php endif; ?>><?php echo e($product_top_sales_info->title); ?></a>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo e(number_format($product_top_sales->total_sales, 0, '.', '.')); ?> VNĐ
                                    </div>
                                    <span class="text-muted d-block" style="font-size: 0.8rem;"><?php if($product_top_sales_info->is_publish == 0): ?> Sản phẩm đang bị vô hiệu hóa <?php endif; ?></span>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Content Row -->

        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        

        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        

        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        

        
        

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>