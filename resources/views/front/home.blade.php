@extends('layouts.layout_front')
@section('title')
    Trang chủ
@endsection
@section('poster')
    <div class="row">
        <div class="col-2">
            <h1>Diana Authentic <br>Sản Phẩm </h1>
            @if(isset($product_banners[0]) && $product_banners)
{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> Lorem ipsum dolor sit amet, consectetur adipisicing.</p>--}}
                <p>{{ $product_banners[0]->title }}</p>
                <a href="{{ route('client.product.detail', ['slug' => $product_banners[0]->slug]) }}" class="btn">Mua ngay &#8594;</a>
            @endif
        </div>
        <div class="col-2">
            @if(isset($product_banners[0]) && $product_banners[0])
               <img src="{{url($product_banners[0]->thumbnail)}}">
{{--                <img src="{{url('public/images/image2.png')}}">--}}
            @endif
        </div>
    </div>
@endsection
@section('content')
    <!-- featured categories -->
{{--    <div class="categories">--}}
{{--        <div class="small-container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-4">--}}
{{--                    <img src="{{url('public/images/category-1.jpg')}}" alt="">--}}
{{--                </div>--}}
{{--                <div class="col-4">--}}
{{--                    <img src="{{url('public/images/category-2.jpg')}}" alt="">--}}
{{--                </div>--}}
{{--                <div class="col-4">--}}
{{--                    <img src="{{url('public/images/category-3.jpg')}}" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- hot products -->
    <div class="small-container">
        <h2 class="title">Sản phẩm hot</h2>
        <div class="row" style="justify-content: unset;">
            @if (isset($list_products_hot) && $list_products_hot)
            @foreach($list_products_hot as $item)
                    <div class="col-4">
                        <a href="{{ route('client.product.detail', ['slug'=>$item->slug]) }}"><img src="{{url($item->thumbnail)}}" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center">{{ $item->title }}</h4>
                        <p>{{ number_format($item->price, 0, '.', '.') }}đ</p>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('client.product.detail', ['slug'=>$item->slug]) }}"><img src="{{url($item->thumbnail)}}" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center">{{ $item->title }}</h4>
                        <p>{{ number_format($item->price, 0, '.', '.') }}đ</p>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('client.product.detail', ['slug'=>$item->slug]) }}"><img src="{{url($item->thumbnail)}}" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center">{{ $item->title }}</h4>
                        <p>{{ number_format($item->price, 0, '.', '.') }}đ</p>
                    </div>
            @endforeach
            @endif
        </div>
    </div>

    <!-- hot products -->
    <div class="small-container">
        <h2 class="title">Sản phẩm bán chạy</h2>
        <div class="row" style="justify-content: unset;">
            @if (isset($list_products_hot) && $list_products_hot)
                @foreach($list_products_hot as $item)
                    <div class="col-4">
                        <a href="{{ route('client.product.detail', ['slug'=>$item->slug]) }}"><img src="{{url($item->thumbnail)}}" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center">{{ $item->title }}</h4>
                        <p>{{ number_format($item->price, 0, '.', '.') }}đ</p>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('client.product.detail', ['slug'=>$item->slug]) }}"><img src="{{url($item->thumbnail)}}" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center">{{ $item->title }}</h4>
                        <p>{{ number_format($item->price, 0, '.', '.') }}đ</p>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('client.product.detail', ['slug'=>$item->slug]) }}"><img src="{{url($item->thumbnail)}}" style="max-width: 200px;"></a>
                        <h4 class="product-title text-center">{{ $item->title }}</h4>
                        <p>{{ number_format($item->price, 0, '.', '.') }}đ</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- offer -->
    @if(isset($product_banners[1]) && $product_banners[1])
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="{{ url($product_banners[1]->thumbnail) }}" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Sản phẩm tiếp theo của Diana Authentic</p>
                    <h1>{{ $product_banners[1]->title }}</h1>
                    <small>{!! $product_banners[1]->desc !!}</small>
                    <a href="{{ route('client.product.detail', ['slug' => $product_banners[1]->slug]) }}" class="btn">Mua ngay &#8594;</a>
                </div>
            </div>
        </div>
    </div>
    @endif

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
