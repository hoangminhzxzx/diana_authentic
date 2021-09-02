@extends('layouts.layout_front')
@section('title')
    Đặt hàng | Diana Authentic
@endsection
@section('content')
    <style>
        .text-danger {
            color: red;
        }
    </style>
    <div class="small-container" style="min-height: 400px; margin-top: 80px;">
        <div class="info-client">
            <form action="{{ route('client.insert.order') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-3">
                        <h3>Thông tin khách hàng</h3>

                        <input type="text" name="name" placeholder="Họ tên">
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <input type="email" name="email" placeholder="Email">
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <input type="number" name="phone" placeholder="Số điện thoại">
                        @error('phone')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <input type="text" name="address" placeholder="Địa chỉ giao hàng">
                        @error('address')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <textarea name="note" id="" cols="41" rows="10" placeholder="Ghi chú" style="padding-left: .5rem; padding-top: .5rem"></textarea>
                    </div>
                    <div class="col-3">
                        <h3>Thông tin đơn hàng</h3>
                        <div class="total-price">
                            <table>
                                <tr>
                                    <td style="font-weight: bold;">Sản phẩm</td>
                                    <td style="font-weight: bold;">Tổng</td>
                                </tr>
                                @foreach(Cart::content() as $item)
                                <tr>
                                    <td>{{ $item->name }} x {{ $item ->qty }}</td>
                                    <td>{{ number_format($item->subtotal, 0, '.', '.') }} VND</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Tổng đơn hàng</td>
                                    <td>{{ Cart::total() }} VND</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <input type="submit" class="btn" value="Đặt hàng" style="width: 30%; ">
                </div>
            </form>
        </div>
    </div>
@endsection