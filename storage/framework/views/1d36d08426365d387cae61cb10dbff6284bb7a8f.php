<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(url('public/css/style.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(url('/public/plugins/custom/sweetalert2/dist/sweetalert2.css')); ?>">
</head>
<body>
<?php
    $categories = \App\Model\Category::query()->where('parent_id', '=', 0)->get();
?>
<div class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="<?php echo e(route('homeFront')); ?>"><img src="<?php echo e(url('public/images/logo_diana1.png')); ?>" width="140px" alt=""></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="<?php echo e(route('homeFront')); ?>">Trang chủ</a></li>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('client.category.list.product', $category->slug)); ?>"><?php echo e($category->title); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                    <li><a href="">Giới thiệu</a></li>
                    <li><a href="">Liên hệ</a></li>
                    <?php if(session()->has('client_login')): ?>
                        <li class="dropdown" onclick="showSubMenu(this)">
                            <a href="#" id="more_action">Tài khoản</a>
                            <ul class="d-none" id="sub_menu">
                                <li class="item-single-menu">
                                    <a href="<?php echo e(route('client.account.detail')); ?>" class="">Hồ sơ</a>
                                </li>
                                <li class="item-single-menu">
                                    <a href="#" class="" id="btn_logout">Đăng xuất</a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="<?php echo e(route("client.account.client")); ?>">Đăng nhập</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <a href="<?php echo e(route('client.cart')); ?>"  style="position: relative;">
                <img src="<?php echo e(url('public/images/cart_1.png')); ?>" width="30px" height="30px" alt="">
                <div class="count_item_cart"><?php echo e((\Gloudemans\Shoppingcart\Facades\Cart::count() > 0 && \Gloudemans\Shoppingcart\Facades\Cart::count()) ? \Gloudemans\Shoppingcart\Facades\Cart::count() : null); ?></div>
            </a>
            <img src="<?php echo e(url('public/images/menu.png')); ?>" onclick="menutoggle()" class="menu-icon" alt="">
        </div>
        <?php echo $__env->yieldContent('poster'); ?>
    </div>
</div>

<?php echo $__env->yieldContent('content'); ?>

<!-- ----------footer---------- -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-2">
                <img src="<?php echo e(url('public/images/logo_diana1.png')); ?>" alt="">
                <p>Hệ thống Diana Authentic đang demo</p>
            </div>









            <div class="footer-col-4">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="">Facebook</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="copyright">Dev by Minh Bé Tý</p>
    </div>
</div>

<script src="<?php echo e(url('public/js/jquery-3.6.0.min.js')); ?>"></script>
<script src="<?php echo e(url('public/js/front.js')); ?>"></script>

<script src="<?php echo e(url('/public/plugins/custom/sweetalert2/dist/sweetalert2.js')); ?>"></script>


<script src="<?php echo e(url('/public/plugins/custom/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/layouts/layout_front.blade.php ENDPATH**/ ?>