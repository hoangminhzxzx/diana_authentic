<?php $__env->startSection('title'); ?>
    Account
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- ------------- account-page ------------ -->
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <a href=""><img src="" width="100%" alt=""></a>
                </div>
                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span id="login">Login</span>
                            <span id="register">Register</span>
                            <hr id="Indicator">
                        </div>
                        <form action="" id="LoginForm">
                            <input type="text" name="username" placeholder="Username">
                            <input type="password" name="password" placeholder="Password">

                            <button type="button" class="btn" id="btnLogin">Đăng nhập</button>
                            <a href="<?php echo e(route('client.restore.password')); ?>">Forgot password</a>
                        </form>
                        <form action="" id="RegForm">
                            <input type="text" name="username" placeholder="Username">
                            <input type="email" name="email" placeholder="Email">
                            <input type="password" name="password" placeholder="Password">

                            <button type="button" class="btn" id="btnRegister">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        var LoginForm = document.getElementById("LoginForm");
        var RegForm = document.getElementById("RegForm");
        var Indicator = document.getElementById("Indicator");

        $("#register").click(function(){
            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";
        });
        $("#login").click(function(){
            RegForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout_front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xamp\htdocs\diana_authentic\resources\views/front/account/account.blade.php ENDPATH**/ ?>