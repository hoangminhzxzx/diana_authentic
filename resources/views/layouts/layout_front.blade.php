<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('public/css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="{{ route('homeFront') }}"><img src="{{url('public/images/logo_diana1.png')}}" width="140px" alt=""></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="{{ route('homeFront') }}">Trang chủ</a></li>
                    <li><a href="">Áo</a></li>
                    <li><a href="">Quần</a></li>
                    <li><a href="">Giày</a></li>
                    <li><a href="">Túi xách</a></li>
                    <li><a href="">Giới thiệu</a></li>
                    <li><a href="">Liên hệ</a></li>
                    <li><a href="">Tài khoản</a></li>
                </ul>
            </nav>
            <a href="{{ route('client.cart') }}"><img src="{{url('public/images/cart_1.png')}}" width="30px" height="30px" alt=""></a>
            <img src="{{url('public/images/menu.png')}}" onclick="menutoggle()" class="menu-icon" alt="">
        </div>
        @yield('poster')
    </div>
</div>

@yield('content')

<!-- ----------footer---------- -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-2">
                <img src="{{url('public/images/logo_diana1.png')}}" alt="">
                <p>Our Purpose Is To Sustainably Make the Pleasure and Benefits of Sports Accessible to the Many</p>
            </div>
            <div class="footer-col-3">
                <h3>Useful Links</h3>
                <ul>
                    <li><a href="">Coupons</a></li>
                    <li><a href="">Blog Post</a></li>
                    <li><a href="">Return Policy</a></li>
                    <li><a href="">Join Affiliate</a></li>
                </ul>
            </div>
            <div class="footer-col-4">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="">Facebook</a></li>
                    <li><a href="">Twitter</a></li>
                    <li><a href="">Instagram</a></li>
                    <li><a href="">Youtube</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="copyright">Dev by Hoàng Công Minh</p>
    </div>
</div>

<script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{url('public/js/front.js')}}"></script>
</body>
</html>