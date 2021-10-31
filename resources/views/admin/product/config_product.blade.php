@extends('layouts.layout_admin')
@section('styles')
    {{--<link rel="stylesheet" href="{{ url('public/plugins/dropzone-5.7.0/dist/dropzone.css') }}">--}}
@endsection
@section('content')
    <div class="card mx-4">
        <div class="card-header">
            <h3>Cấu hình sản phẩm hot</h3>
        </div>
        <div class="card-body d-flex flex-wrap">
            @foreach($products as $product)
            <div class="border mr-4 mb-2 text-center p-3 card-product-hot">
                @if($product->is_hot == config('constant.PRODUCT_IS_HOT.HOT_PRODUCT_BANNER'))
                    <div class="hot-position" data-productId="{{ $product->id }}" onclick="changePosition(this)"><span>{{ $product->position }}</span></div>
                @endif
                <button class="btn-select-diana btn btn-sm @if($product->is_hot != config('constant.PRODUCT_IS_HOT.HOT_PRODUCT_BANNER')) btn-warning @else btn-success @endif" data-productId="{{ $product->id }}" onclick="configProductSelect(this)">@if($product->is_hot != config('constant.PRODUCT_IS_HOT.HOT_PRODUCT_BANNER')) Select @else Selected @endif</button>
                <img src="{{ asset($product->thumbnail) }}" alt="" class="img-thumbnail">
                <p>{{ $product->title }}</p>
{{--                <button class="btn btn-warning" onclick="configProductSelect(this)">Select</button>--}}
            </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')

@endsection
