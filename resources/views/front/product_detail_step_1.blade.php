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
                {{--                <div class="small-img-row">--}}
                {{--                    <div class="small-img-col">--}}
                {{--                        <img src="images/gallery-1.jpg" width="100%" class="small-img">--}}
                {{--                    </div>--}}
                {{--                    <div class="small-img-col">--}}
                {{--                        <img src="images/gallery-2.jpg" width="100%" class="small-img">--}}
                {{--                    </div>--}}
                {{--                    <div class="small-img-col">--}}
                {{--                        <img src="images/gallery-3.jpg" width="100%" class="small-img">--}}
                {{--                    </div>--}}
                {{--                    <div class="small-img-col">--}}
                {{--                        <img src="images/gallery-4.jpg" width="100%" class="small-img">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <div class="col-2">
{{--                <form action="{{ route('client.product.detail.step2', ['id'=>$product->id]) }}" method="POST">--}}
{{--                    @csrf--}}
                    <input type="hidden" id="product_id" value="{{ $product->id }}">
                    <p>Trang chủ / {{ $product->category->title }}</p>
                    <h1>{{ $product->title }}</h1>
                    <h4>$50.00</h4>
                    <input type="hidden" value="" id="valueSize" name="size">
                    <select id="chooseSize">
                        <option value="">Select size</option>
                        @foreach($list_variants['sizes'] as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                    @error('size')
                    <small style="color: indianred;">{{$message}}</small>
                    @enderror
                    <input type="submit" class="btn" value="Chọn Màu" id="submitStep1" style="width: 100%;">
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

