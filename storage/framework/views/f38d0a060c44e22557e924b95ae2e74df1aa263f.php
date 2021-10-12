<?php if($paginator->hasPages()): ?>
    <!-- Pagination -->
    <div class="pull-right pagination">
        <ul class="pagination">
            
            <?php if($paginator->onFirstPage()): ?>
                <li class="disabled">
                    <span><i class="fa fa-angle-double-left"></i></span>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>">
                        <span><i class="fa fa-angle-double-left"></i></span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="active"><span><?php echo e($page); ?></span></li>
                        <?php elseif(($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage()): ?>
                            <li><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php elseif($page == $paginator->lastPage() - 1): ?>
                            <li class="disabled"><span><i class="fa fa-ellipsis-h"></i></span></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li>
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>">
                        <span><i class="fa fa-angle-double-right"></i></span>
                    </a>
                </li>
            <?php else: ?>
                <li class="disabled">
                    <span><i class="fa fa-angle-double-right"></i></span>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <!-- Pagination -->
<?php endif; ?>
<?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/vendor/pagination/custom_pagninate.blade.php ENDPATH**/ ?>