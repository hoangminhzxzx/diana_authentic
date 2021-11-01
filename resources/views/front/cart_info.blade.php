@extends('layouts.layout_front')
@section('title')
    Giỏ hàng
@endsection
@section('content')
{{--    {{ dd(Cart::content()) }}--}}
    <div class="small-container cart-page">
        @if(Cart::count() > 0)
        <table class="table-cart-info">
            <tr>
                <th>Sản phẩm</th>
                <th class="column-item-dia">Số lượng</th>
                <th>Giá tiền</th>
            </tr>
{{--            @if(Cart::count() > 0)--}}
                @foreach(Cart::content() as $item)
            <tr class="item-cart-single">
                <td>
                    <div class="cart-info">
                        <a href="{{ route('client.product.detail', $item->options->slug) }}"><img src="{{ url($item->options->thumbnail) }}" alt=""></a>
                        <div>
                            <p>{{ $item->name }} <span class="" style="font-size: .7rem;">(size {{ $item->options->size }}, màu {{ $item->options->color }})</span></p>
                            <small>Giá: {{ number_format($item->price, 0, '.', '.') }}</small>
                            <a href="#" onclick="removeItemCart(this)" data-rowId="{{ $item->rowId }}">Xóa</a>
                            <p><span class="" style="font-size: .7rem;">Trong kho còn : {{ $item->options->qty_in_stock }}</span></p>
                        </div>
                    </div>
                </td>
                <input type="hidden" id="rowIdItem-{{ $item->id }}" value="{{ $item->rowId }}">
                <input type="hidden" id="idItem-{{ $item->id }}" value="{{ $item->id }}">
                <td><input type="number" min="1" max="{{ $item->options->qty_in_stock }}" id="qtyItem-{{ $item->id }}" value="{{ $item->qty }}" onchange="changeQty({{ $item->id }},this)" style="width: 50px;"></td>
                <td id="subTotal-{{ $item->id }}">{{ number_format($item->subtotal, 0, '.', '.') }} VND</td>
            </tr>
                @endforeach
{{--            @endif--}}
        </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>Tổng giá trị đơn hàng</td>
                    <td id="totalCart">{{ Cart::total() }} VND</td>
                </tr>
            </table>
        </div>
        @else
            <div style="text-align: center;" >
                <img src="{{ asset('/public/no-item-in-cart.png') }}" alt="">
                <p style="text-align: center;">Chưa có sản phẩm nào trong giỏ hàng</p>
                <a href="{{ route('homeFront') }}" class="btn">Tiếp tục xem hàng !!!</a>
            </div>
        @endif
    </div>
@if(Cart::count() > 0)
    <div style="text-align: center;">
        <a href="{{ route('client.checkout') }}" id="btn-checkout" class="btn">Thanh toán</a>
    </div>
@endif

@endsection

