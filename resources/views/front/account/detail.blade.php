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
            <form action="" method="post" id="form-pending-order">
                @csrf
                <div class="row">

                    <div class="col-3">
                        <h3>Cập nhật thông tin <span>{{ $account_client->name }}</span></h3>

                        <input type="text" name="name" placeholder="Họ tên" id="name" value="{{ $account_client->name }}">
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                        <input type="email" name="email" placeholder="Email" id="email" disabled value="{{ $account_client->email }}">
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                        <input type="number" name="phone" placeholder="Số điện thoại" id="phone" value="{{ $account_client->phone }}">
                        @error('phone')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                        <div class="address_vn" style="margin-top: 10px;">
                            <select name="province" id="province" class="select_checkout" onchange="selectProvince(this)">
                                <option value="" disabled="disabled" selected="" value="null">Tỉnh/Thành Phố</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="text" id="province" name="address_street_plus" placeholder="Số nhà, đường, ...">

                        <textarea name="note" id="note" cols="41" rows="10" placeholder="Ghi chú" style="padding-left: .5rem; padding-top: .5rem">

                        </textarea>
                    </div>
                    <div class="col-3">
{{--                        <h3>Thông tin đơn hàng</h3>--}}

                    </div>

                </div>
                <div class="row">

                </div>
            </form>
        </div>
    </div>
@endsection
