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
    <link rel="stylesheet" href="{{ url('/public/plugins/custom/sweetalert2/dist/sweetalert2.css') }}">

    <link rel="stylesheet" href="{{ url('/public/plugins/custom/splide/dist/css/splide.min.css') }}">
    <link rel="stylesheet" href="{{ url('/public/plugins/custom/splide/dist/css/themes/splide-default.min.css') }}">
    <link rel="stylesheet" href="{{ url('/public/plugins/custom/splide/dist/css/splide-core.min.css') }}">
</head>
<body>
@php
    $categories = \App\Model\Category::query()->where('parent_id', '=', 0)->get();
@endphp
<div class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="{{ route('homeFront') }}"><img src="{{url('public/images/logo_diana1.png')}}" width="140px" alt=""></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="{{ route('homeFront') }}">Trang chủ</a></li>
                    @foreach($categories as $category)
                        <li><a href="{{ route('client.category.list.product', $category->slug) }}">{{ $category->title }}</a></li>
                    @endforeach
{{--                    <li><a href="">Áo</a></li>--}}
{{--                    <li><a href="">Quần</a></li>--}}
{{--                    <li><a href="">Giày</a></li>--}}
{{--                    <li><a href="">Túi xách</a></li>--}}
                    <li><a href="">Giới thiệu</a></li>
                    <li><a href="">Liên hệ</a></li>
                    @if(session()->has('client_login'))
                        <li class="dropdown" onclick="showSubMenu(this)">
                            <a href="#" id="more_action">Tài khoản</a>
                            <ul class="d-none" id="sub_menu">
                                <li class="item-single-menu">
                                    <a href="{{ route('client.account.detail') }}" class="">Hồ sơ</a>
                                </li>
                                <li class="item-single-menu">
                                    <a href="{{ route('client.account.changPassword') }}" class="">Đổi mật khẩu</a>
                                </li>
                                <li class="item-single-menu">
                                    <a href="#" class="" id="btn_logout">Đăng xuất</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route("client.account.client") }}">Đăng nhập</a></li>
                    @endif
                </ul>
            </nav>
            <a href="{{ route('client.cart') }}"  style="position: relative;">
                <img src="{{url('public/images/cart_1.png')}}" width="30px" height="30px" alt="">
                <div class="count_item_cart">{{ (\Gloudemans\Shoppingcart\Facades\Cart::count() > 0 && \Gloudemans\Shoppingcart\Facades\Cart::count()) ? \Gloudemans\Shoppingcart\Facades\Cart::count() : null }}</div>
            </a>
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
                <p>Hệ thống Diana Authentic đang demo</p>
            </div>
{{--            <div class="footer-col-3">--}}
{{--                <h3>Useful Links</h3>--}}
{{--                <ul>--}}
{{--                    <li><a href="">Coupons</a></li>--}}
{{--                    <li><a href="">Blog Post</a></li>--}}
{{--                    <li><a href="">Return Policy</a></li>--}}
{{--                    <li><a href="">Join Affiliate</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
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

<script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{url('public/js/front.js')}}"></script>

<script src="{{ url('/public/plugins/custom/sweetalert2/dist/sweetalert2.js') }}"></script>

{{--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
<script src="{{ url('/public/plugins/custom/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ url('/public/plugins/custom/splide/dist/js/splide.js') }}"></script>
@yield('scripts')
</body>
</html>
