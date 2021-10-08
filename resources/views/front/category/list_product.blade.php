@extends('layouts.layout_front')
@section('title')
    {{ $category_title }}
@endsection
@section('content')
    <div class="small-container">
        <div class="row row-2">
            <h2>All Products</h2>
            <select name="" id="">
                <option value="">Mặc định</option>
                <option value="">Giá tăng dần</option>
                <option value="">Giá giảm dần</option>
            </select>
        </div>
        <div class="row" style="justify-content: unset;">
            @foreach($list_product as $product)
            <div class="col-4">
                <a href="{{ route('client.product.detail', ['slug' => $product->slug]) }}"><img src="{{ url($product->thumbnail) }}" alt=""></a>
                <h4>{{ $product->title }}</h4>
{{--                <div class="rating">--}}
{{--                    <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                    <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                    <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                    <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                    <i class="fa fa-star-o" aria-hidden="true"></i>--}}
{{--                </div>--}}
                <p>{{ number_format($product->price, 0, '.', '.') }}</p>
            </div>
            @endforeach
        </div>
{{--        <div class="page-btn">--}}
{{--            <span>1</span>--}}
{{--            <span>2</span>--}}
{{--            <span>3</span>--}}
{{--            <span>4</span>--}}
{{--            <span>&#8594;</span>--}}
{{--        </div>--}}
    </div>
@endsection
