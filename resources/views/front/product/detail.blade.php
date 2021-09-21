@extends('layouts.layout_front')
@section('title')
    Chi tiết sản phẩm
@endsection
@section('content')
    <style>
        .active_color {
            border: 2px solid blue;
        }
    </style>
    <!-- -------------- single product --------------------->
    <div class="small-container single-product">
        <input type="hidden" value="@php if (isset($is_accessory) && $is_accessory == 1) { echo $is_accessory; } else echo 0; @endphp" name="is_accessory" id="is_accessory">
        <div class="row" style="align-items: unset;">
            <div class="col-2">
                <img src="{{ url($product->thumbnail) }}" id="ProductImg">
                <div class="small-img-row">
                    <div class="small-img-col">
                        <img src="{{ url($product->thumbnail) }}" width="100%" class="small-img" onclick="changeImagePreview(this)" style="height: 96%;">
                    </div>
                    @if($product->images)
                    @foreach(json_decode($product->images) as $image)
                    <div class="small-img-col">
                        <img src="{{ url($image) }}" width="100%" class="small-img" onclick="changeImagePreview(this)">
                    </div>
                    @endforeach
                        @endif
                </div>
            </div>
            <div class="col-2">
                {{--                <form action="{{ route('client.product.detail.step2', ['id'=>$product->id]) }}" method="POST">--}}
                {{--                    @csrf--}}
                <input type="hidden" id="product_id" value="{{ $product->id }}">
                <p>Trang chủ / {{ $product->category->title }}</p>
                <h1>{{ $product->title }}</h1>
                <h4>{{ number_format($product->price, 0, '.', '.') }} VNĐ</h4>
                @if($is_accessory == 0)
                <input type="hidden" value="" id="valueSize" name="size">
                <select id="chooseSize" onchange="chooseSize(this)" style="border: 1px solid #ccc;">
                    <option value="">Chọn size</option>
                    @if(isset($sizes) && $sizes)
                    @foreach($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                    @endif
                </select>
                @endif
                @error('size')
                <small style="color: indianred;">{{$message}}</small>
                @enderror
                <input type="number" value="1" min="1" name="qty" style="margin-top: 1rem; border: 1px solid #000; border: 1px solid #ccc;">
                <input type="button" onclick="addToCart(this)" class="btn" value="Thêm vào giỏ hàng" id="" style="width: 100%;">
                <h3>Chi tiết sản phẩm <i class="fa fa-indent"></i></h3>
{{--                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nesciunt odit beatae veniam autem--}}
{{--                    iste id est possimus laborum iusto.</p>--}}
                <div>{!! $product->content !!}</div>
                {{--                </form>--}}
            </div>
        </div>
    </div>

    <!-- ---------------title------------- -->
    <div class="small-container">
        <div class="row row-2">
            <h2>Sản phẩm liên quan</h2>
            <a href="">Xem thêm</a>
        </div>
    </div>

@endsection
