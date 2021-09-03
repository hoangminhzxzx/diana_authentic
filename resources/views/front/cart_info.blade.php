@extends('layouts.layout_front')
@section('title')
    Giỏ hàng
@endsection
@section('content')
{{--    {{ Cart::content() }}--}}
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            @if(Cart::count() > 0)
                @foreach(Cart::content() as $item)
            <tr class="item-cart-single">
                <td>
                    <div class="cart-info">
                        <a href="#"><img src="{{ url($item->options->thumbnail) }}" alt=""></a>
                        <div>
                            <p>{{ $item->name }}</p>
                            <small>Giá: {{ $item->price }}</small>
{{--                            <a href="#" onclick="confirmDelete('#form_remove_item_cart_{{ $item->id }}');return false;">Remove</a>--}}
                            <a href="#" onclick="removeItemCart(this)" data-rowId="{{ $item->rowId }}">Remove</a>
{{--                            <form id="form_remove_item_cart_{{ $item->id }}" method="POST" action="{{ route('client.product.remove', $item->rowId) }}" style="display: none;">--}}
{{--                                @csrf--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </td>
                <input type="hidden" id="rowIdItem-{{ $item->id }}" value="{{ $item->rowId }}">
                <input type="hidden" id="idItem-{{ $item->id }}" value="{{ $item->id }}">
                <td><input type="number" min="1" id="qtyItem-{{ $item->id }}" value="{{ $item->qty }}" onchange="changeQty({{ $item->id }},this)"></td>
                <td id="subTotal-{{ $item->id }}">{{ $item->subtotal }} VND</td>
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
{{--                <tr>--}}
{{--                    <td>Total</td>--}}
{{--                    <td>$150.00</td>--}}
{{--                </tr>--}}
            </table>
        </div>
    </div>
{{--<form action="" style="text-align: center;">--}}
{{--    <input id="btn-checkout" type="submit" name="checkout" value="Checkout" class="btn">--}}
{{--</form>--}}
@if(Cart::count() > 0)
    <div style="text-align: center;">
        <a href="{{ route('client.checkout') }}" id="btn-checkout" class="btn">Checkout</a>
    </div>
@endif

@endsection

