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
        <div class="row">
            <div class="col-2">
                <img src="{{ url($product->thumbnail) }}" id="ProductImg">
                <div class="small-img-row">
                    <div class="small-img-col">
                        <img src="{{ url($product->thumbnail) }}" width="100%" class="small-img" onclick="changeImagePreview(this)" style="height: 96%;">
                    </div>
                    @foreach(json_decode($product->images) as $image)
                    <div class="small-img-col">
                        <img src="{{ url($image) }}" width="100%" class="small-img" onclick="changeImagePreview(this)">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-2">
                {{--                <form action="{{ route('client.product.detail.step2', ['id'=>$product->id]) }}" method="POST">--}}
                {{--                    @csrf--}}
                <input type="hidden" id="product_id" value="{{ $product->id }}">
                <p>Trang chủ / {{ $product->category->title }}</p>
                <h1>{{ $product->title }}</h1>
                <h4>$50.00</h4>
                <input type="hidden" value="" id="valueSize" name="size">
                <select id="chooseSize" onchange="chooseSize(this)">
                    <option value="">Select size</option>
                    @foreach($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>
                @error('size')
                <small style="color: indianred;">{{$message}}</small>
                @enderror
                <input type="number" value="1" min="1" name="qty" style="margin-top: 1rem;">
                <input type="button" onclick="addToCart(this)" class="btn" value="Thêm vào giỏ hàng" id="" style="width: 100%;">
                <h3>Chi tiết sản phẩm <i class="fa fa-indent"></i></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nesciunt odit beatae veniam autem
                    iste id est possimus laborum iusto.</p>
                {{--                </form>--}}
            </div>
        </div>
    </div>

    <!-- ---------------title------------- -->
    <div class="small-container">
        <div class="row row-2">
            <h2>Related Products</h2>
            <p>View More</p>
        </div>
    </div>

@endsection
