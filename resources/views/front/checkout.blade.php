@extends('layouts.layout_front')
@section('title')
    Đặt hàng | Diana Authentic
@endsection
@section('content')
{{--    {{ dd(Cart::content()) }}--}}
    <style>
        .text-danger {
            color: red;
        }
    </style>
    <div class="small-container" style="min-height: 400px; margin-top: 80px;">
        <div class="info-client">
{{--            <form action="{{ route('client.insert.order') }}" method="post">--}}
            <form action="" method="post" id="form-pending-order">
                @csrf
                <div class="row">

                    <div class="col-3">
                        <h3>Thông tin khách hàng</h3>

                        <input type="text" name="name" placeholder="Họ tên" id="name">
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                        <input type="email" name="email" placeholder="Email" id="email">
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                        <input type="number" name="phone" placeholder="Số điện thoại" id="phone">
                        @error('phone')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

{{--                        <input type="hidden" name="address[]" id="address_client" placeholder="Địa chỉ giao hàng" value="">--}}
{{--                        @error('address')--}}
{{--                        <small class="text-danger">{{$message}}</small>--}}
{{--                        @enderror--}}

                        <div class="address_vn" style="margin-top: 10px;">
                            <select name="province" id="province" class="select_checkout" onchange="selectProvince(this)">
                                <option value="" disabled="disabled" selected="" value="null">Tỉnh/Thành Phố</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="text" id="province" name="address_street_plus" placeholder="Số nhà, đường, ...">

                        <textarea name="note" id="note" cols="41" rows="10" placeholder="Ghi chú" style="padding-left: .5rem; padding-top: .5rem"></textarea>
                    </div>
                    <div class="col-3">
                        <h3>Thông tin đơn hàng</h3>
                        <div class="total-price">
                            <table style="font-size: 13px;">
                                <tr>
                                    <td style="font-weight: bold;">Sản phẩm</td>
                                    <td style="font-weight: bold;">Màu - Size</td>
                                    <td style="font-weight: bold;">Tổng (VNĐ)</td>
                                </tr>
                                @foreach(Cart::content() as $item)
                                <tr>
                                    <td>{{ $item->name }} x {{ $item ->qty }}</td>
                                    <td>{{ $item->options->color }} - {{ $item->options->size }}</td>
                                    <td>{{ number_format($item->subtotal, 0, '.', '.') }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Tổng đơn hàng</td>
                                    <td></td>
                                    <td>{{ Cart::total() }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="row">
{{--                    <input type="submit" class="btn" value="Đặt hàng" style="width: 30%; ">--}}
                    <input type="button" onclick="orderSubmit(this)" class="btn" value="Đặt hàng" style="width: 30%; ">
                </div>
            </form>
        </div>
    </div>
@endsection
