@extends('layouts.layout_front')
@section('title')
    Account
@endsection
@section('content')

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
{{--                            <input type="submit" class="btn" value="Login">--}}
                            <button type="button" class="btn" id="btnLogin">Đăng nhập</button>
                            <a href="{{ route('client.restore.password') }}">Quên mật khẩu</a>
                        </form>
                        <form action="" id="RegForm">
                            <input type="text" name="username" placeholder="Username">
                            <input type="email" name="email" placeholder="Email">
                            <input type="password" name="password" placeholder="Password">
{{--                            <input type="submit" class="btn" value="Register">--}}
                            <button type="button" class="btn" id="btnRegister">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
@endsection
