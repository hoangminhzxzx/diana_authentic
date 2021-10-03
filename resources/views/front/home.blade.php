@extends('layouts.layout_front')
@section('title')
    Trang chủ
@endsection
@section('poster')
    <div class="row">
        <div class="col-2">
            <h1>Diana Authentic <br>Sản Phẩm </h1>
            @if($product_banner)
{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> Lorem ipsum dolor sit amet, consectetur adipisicing.</p>--}}
                <p>{{ $product_banner->title }}</p>
                <a href="{{ route('client.product.detail', ['slug' => $product_banner->slug]) }}" class="btn">Mua ngay &#8594;</a>
            @endif
        </div>
        <div class="col-2">
            @if($product_banner)
               <img src="{{url($product_banner->thumbnail)}}">
{{--                <img src="{{url('public/images/image2.png')}}">--}}
            @endif
        </div>
    </div>
@endsection
@section('content')
    <!-- featured categories -->
    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-4">
                    <img src="{{url('public/images/category-1.jpg')}}" alt="">
                </div>
                <div class="col-4">
                    <img src="{{url('public/images/category-2.jpg')}}" alt="">
                </div>
                <div class="col-4">
                    <img src="{{url('public/images/category-3.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- featured products -->
    <div class="small-container">
        <h2 class="title">Sản phẩm của Diana Authentic</h2>
        <div class="row" style="justify-content: center;">
            @foreach($list_products as $item)
            <div class="col-4">
                <a href="{{ route('client.product.detail', ['slug'=>$item->slug]) }}"><img src="{{url($item->thumbnail)}}" style="max-width: 200px;"></a>
                <h4 class="product-title text-center">{{ $item->title }}</h4>
{{--                <p>$5.00</p>--}}
            </div>
            @endforeach
        </div>

{{--        <h2 class="title">Latest Products</h2>--}}
{{--        <div class="row">--}}
{{--            <div class="col-4">--}}
{{--                <img src="{{url('public/images/product-5.jpg')}}" alt="">--}}
{{--                <h4 class="product-title">Red Printed T-Shirt</h4>--}}
{{--                <p>$5.00</p>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

    <!-- offer -->
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="{{url('public/images/exclusive.png')}}" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                    <h1>Lorem ipsum dolor sit.</h1>
                    <small>The Mi Smart Band 4 featured a 39.9% larger (than Mi Band 3) AMOLED color full-touch display with adjustable brightness, so everything is clear as can</small>
                    <a href="" class="btn">Mua ngay &#8594;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ----testimonial-------- -->
{{--    <div class="testimonial">--}}
{{--        <div class="small-container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-3">--}}
{{--                    <i class="fa fa-quote-left"></i>--}}
{{--                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam commodi, aliquam, illo odit dolorem in cupiditate quae iusto nostrum et inventore? Magnam.</p>--}}
{{--                    <div class="rating">--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star-o"></i>--}}
{{--                    </div>--}}
{{--                    <img src="{{url('public/images/user-1.png')}}" alt="">--}}
{{--                    <h3>Sean Parker</h3>--}}
{{--                </div>--}}
{{--                <div class="col-3">--}}
{{--                    <i class="fa fa-quote-left"></i>--}}
{{--                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam commodi, aliquam, illo odit dolorem in cupiditate quae iusto nostrum et inventore? Magnam.</p>--}}
{{--                    <div class="rating">--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star-o"></i>--}}
{{--                    </div>--}}
{{--                    <img src="{{url('public/images/user-2.png')}}" alt="">--}}
{{--                    <h3>Mike Smith</h3>--}}
{{--                </div>--}}
{{--                <div class="col-3">--}}
{{--                    <i class="fa fa-quote-left"></i>--}}
{{--                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam commodi, aliquam, illo odit dolorem in cupiditate quae iusto nostrum et inventore? Magnam.</p>--}}
{{--                    <div class="rating">--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <i class="fa fa-star-o"></i>--}}
{{--                    </div>--}}
{{--                    <img src="{{url('public/images/user-3.png')}}" alt="">--}}
{{--                    <h3>Mabel Joe</h3>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- -------brands----------- -->
{{--    <div class="brands">--}}
{{--        <div class="small-container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-5">--}}
{{--                    <img src="{{url('public/images/logo-godrej.png')}}" alt="">--}}
{{--                </div>--}}
{{--                <div class="col-5">--}}
{{--                    <img src="{{url('public/images/logo-oppo.png')}}" alt="">--}}
{{--                </div>--}}
{{--                <div class="col-5">--}}
{{--                    <img src="{{url('public/images/logo-coca-cola.png')}}" alt="">--}}
{{--                </div>--}}
{{--                <div class="col-5">--}}
{{--                    <img src="{{url('public/images/logo-paypal.png')}}" alt="">--}}
{{--                </div>--}}
{{--                <div class="col-5">--}}
{{--                    <img src="{{url('public/images/logo-philips.png')}}" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
