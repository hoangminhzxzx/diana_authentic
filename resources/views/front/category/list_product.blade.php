@extends('layouts.layout_front')
@section('title')
    {{ $category_title }}
@endsection
@section('content')
    <div class="small-container">
        <div class="row row-2" style="padding-left: 10px;">
            <h2>Áo của Diana Authentic</h2>
            <form action="{{ route('client.category.list.product', ['slug' => $slug]) }}" id="formFilterProduct">
{{--                @csrf--}}
                <select name="orderBy" style="border: 1px solid #ccc;" onchange="orderProduct(this)" data-category-slug="{{ $slug }}">
{{--                    <option value="">Mặc định</option>--}}
                    <option value="asc" @if(isset($orderBy) && $orderBy == 'asc') selected @endif>Giá tăng dần</option>
                    <option value="desc" @if(isset($orderBy) && $orderBy == 'desc') selected @endif>Giá giảm dần</option>
                </select>

                <select name="limit" style="border: 1px solid #ccc;" onchange="orderProduct(this)" data-category-slug="{{ $slug }}">
                    {{--                    <option value="">Mặc định</option>--}}
                    <option value="4" @if(isset($limit) && $limit == 4) selected @endif>4</option>
                    <option value="8" @if(isset($limit) && $limit == 8) selected @endif>8</option>
                    <option value="12" @if(isset($limit) && $limit == 12) selected @endif>12</option>
                    <option value="16" @if(isset($limit) && $limit == 16) selected @endif>16</option>
                    <option value="20" @if(isset($limit) && $limit == 20) selected @endif>20</option>
                </select>
            </form>
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
                <p>{{ number_format($product->price, 0, '.', '.') }}đ</p>
            </div>
            @endforeach
        </div>
        {{ $list_product->render('vendor.pagination.bootstrap-4') }}
{{--        <div class="page-btn">--}}
{{--            <span>1</span>--}}
{{--            <span>2</span>--}}
{{--            <span>3</span>--}}
{{--            <span>4</span>--}}
{{--            <span>&#8594;</span>--}}
{{--        </div>--}}
    </div>
@endsection
