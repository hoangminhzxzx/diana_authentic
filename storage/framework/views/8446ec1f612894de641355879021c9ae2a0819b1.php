<?php $__env->startSection('title'); ?>
    Giỏ hàng
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="small-container cart-page">
        <?php if(Cart::count() > 0): ?>
        <table class="table-cart-info">
            <tr>
                <th>Sản phẩm</th>
                <th class="column-item-dia">Số lượng</th>
                <th>Giá tiền</th>
            </tr>

                <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="item-cart-single">
                <td>
                    <div class="cart-info">
                        <a href="<?php echo e(route('client.product.detail', $item->options->slug)); ?>"><img src="<?php echo e(url($item->options->thumbnail)); ?>" alt=""></a>
                        <div>
                            <p><?php echo e($item->name); ?> <span class="" style="font-size: .7rem;">(size <?php echo e($item->options->size); ?>, màu <?php echo e($item->options->color); ?>)</span></p>
                            <small>Giá: <?php echo e(number_format($item->price, 0, '.', '.')); ?></small>
                            <a href="#" onclick="removeItemCart(this)" data-rowId="<?php echo e($item->rowId); ?>">Xóa</a>
                        </div>
                    </div>
                </td>
                <input type="hidden" id="rowIdItem-<?php echo e($item->id); ?>" value="<?php echo e($item->rowId); ?>">
                <input type="hidden" id="idItem-<?php echo e($item->id); ?>" value="<?php echo e($item->id); ?>">
                <td><input type="number" min="1" max="<?php echo e($item->options->qty_in_stock); ?>" id="qtyItem-<?php echo e($item->id); ?>" value="<?php echo e($item->qty); ?>" onchange="changeQty(<?php echo e($item->id); ?>,this)" style="width: 50px;"></td>
                <td id="subTotal-<?php echo e($item->id); ?>"><?php echo e(number_format($item->subtotal, 0, '.', '.')); ?> VND</td>
            </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>Tổng giá trị đơn hàng</td>
                    <td id="totalCart"><?php echo e(Cart::total()); ?> VND</td>
                </tr>
            </table>
        </div>
        <?php else: ?>
            <div style="text-align: center;" >
                <img src="<?php echo e(asset('/public/no-item-in-cart.png')); ?>" alt="">
                <p style="text-align: center;">Chưa có sản phẩm nào trong giỏ hàng</p>
                <a href="<?php echo e(route('homeFront')); ?>" class="btn">Tiếp tục xem hàng !!!</a>
            </div>
        <?php endif; ?>
    </div>
<?php if(Cart::count() > 0): ?>
    <div style="text-align: center;">
        <a href="<?php echo e(route('client.checkout')); ?>" id="btn-checkout" class="btn">Thanh toán</a>
    </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/cart_info.blade.php ENDPATH**/ ?>