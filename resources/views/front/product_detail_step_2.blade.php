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
                <form action="{{ route('client.product.add_to_cart') }}" method="POST">
                    @csrf
                    <p>Trang chủ / {{ $product->category->title }}</p>
                    <h1>{{ $product->title }}</h1>
                    <h4>$50.00</h4>
                    <input type="hidden" name="size" value="{{ $size_name_choose->id }}">
                    <input type="text" disabled value="{{ $size_name_choose->name }}"> <a href="{{ route('client.product.detail.step1', $product->id) }}">Change size</a>
                    <div class="form-group" style="margin-top: .5rem;">
                        <label for="">Chọn Màu</label>
                        <div style="display: flex;">
                            <input type="hidden" id="valueColor" name="color" value="">
                            @foreach($option_colors as $color)
                                <div onclick="chooseColor(this)" data-color="{{ $color->id }}" style="background: {{ $color->value }}; width: 30px; height: 30px; border-radius: 50%; margin-top: .5rem; cursor: pointer; margin-right: .5rem;"></div>
                            @endforeach
                        </div>
                        @error('color')
                        <small style="color: indianred;">{{$message}}</small>
                        @enderror
                    </div>
                    <p id="demo"></p>

                    {{--                @foreach($list_variants['colors'] as $color)--}}
                    {{--                <div style="background: {{ $color->value }}; width: 30px; height: 30px; border-radius: 50%; margin-top: .5rem;"></div>--}}
                    {{--                @endforeach--}}
                    <input type="number" value="1" min="1" name="qty">
                    {{--                    <a href="#" class="btn">Add To Cart</a>--}}
                    <input type="submit" class="btn" value="Thêm vào giỏ hàng">
                    <h3>Chi tiết sản phẩm <i class="fa fa-indent"></i></h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nesciunt odit beatae veniam autem
                        iste id est possimus laborum iusto.</p>
                </form>
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

