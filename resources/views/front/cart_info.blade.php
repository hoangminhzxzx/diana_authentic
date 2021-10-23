@extends('layouts.layout_front')
@section('title')
    Giỏ hàng
@endsection
@section('content')
{{--    {{ dd(Cart::content()) }}--}}
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá tiền</th>
            </tr>
            @if(Cart::count() > 0)
                @foreach(Cart::content() as $item)
            <tr class="item-cart-single">
                <td>
                    <div class="cart-info">
                        <a href="{{ route('client.product.detail', $item->options->slug) }}"><img src="{{ url($item->options->thumbnail) }}" alt=""></a>
                        <div>
                            <p>{{ $item->name }}</p>
                            <small>Giá: {{ $item->price }}</small>
                            <a href="#" onclick="removeItemCart(this)" data-rowId="{{ $item->rowId }}">Xóa</a>
                        </div>
                    </div>
                </td>
                <input type="hidden" id="rowIdItem-{{ $item->id }}" value="{{ $item->rowId }}">
                <input type="hidden" id="idItem-{{ $item->id }}" value="{{ $item->id }}">
                <td><input type="number" min="1" max="{{ $item->options->qty_in_stock }}" id="qtyItem-{{ $item->id }}" value="{{ $item->qty }}" onchange="changeQty({{ $item->id }},this)"></td>
                <td id="subTotal-{{ $item->id }}">{{ number_format($item->subtotal, 0, '.', '.') }} VND</td>
            </tr>
                @endforeach
            @endif
        </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>Tổng giá trị đơn hàng</td>
                    <td id="totalCart">{{ Cart::total() }} VND</td>
                </tr>
            </table>
        </div>
    </div>
@if(Cart::count() > 0)
    <div style="text-align: center;">
        <a href="{{ route('client.checkout') }}" id="btn-checkout" class="btn">Thanh toán</a>
    </div>
@endif

@endsection

