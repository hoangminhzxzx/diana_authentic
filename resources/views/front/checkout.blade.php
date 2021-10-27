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

                        <input type="text" name="name" placeholder="Họ tên" id="name" value="{{ (isset($account_client) && $account_client) ? $account_client->name : '' }}">
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                        <input type="email" name="email" placeholder="Email" id="email" value="{{ (isset($account_client) && $account_client) ? $account_client->email : '' }}">
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                        <input type="number" name="phone" placeholder="Số điện thoại" id="phone" value="{{ (isset($account_client) && $account_client) ? $account_client->phone : '' }}">
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
                                    <option value="{{ $province->id }}" @if((isset($account_client) && $account_client) && $account_client->province_id == $province->id) selected @endif>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if((isset($account_client) && $account_client) && $account_client->district_id)
                            <select name="district" id="district" class="select_checkout" onchange="selectDistrict(this)">
                                <option value="" disabled="disabled" selected="" value="null">Quận/Huyện</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}" @if($district->id == $account_client->district_id) selected @endif>{{ $district->name }}</option>
                                @endforeach
                            </select>
                        @endif

                        @if((isset($account_client) && $account_client) && $account_client->ward_id)
                            <select name="ward" id="ward" class="select_checkout">
                                <option value="" disabled="disabled" selected="" value="null">Phường/Xã</option>
                                @foreach($wards as $ward)
                                    <option value="{{ $ward->id }}" @if($ward->id == $account_client->ward_id) selected @endif>{{ $ward->name }}</option>
                                @endforeach
                            </select>
                        @endif

                        <input type="text" id="province" name="address_street_plus" placeholder="Số nhà, đường, ..." value="{{ (isset($account_client) && $account_client) ? $account_client->address_plus : '' }}">

                        <textarea name="note" id="note" cols="41" rows="10" placeholder="Ghi chú" style="padding-left: .5rem; padding-top: .5rem"></textarea>
                    </div>
                    <div class="col-3 bill-infor">
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
                    <input type="button" onclick="orderSubmit(this)" class="btn-checkout-order" value="Đặt hàng" >
                </div>
            </form>
        </div>
    </div>
@endsection
