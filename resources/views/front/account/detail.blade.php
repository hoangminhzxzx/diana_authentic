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
            <form action="{{ route('client.update.account') }}" method="post">
                @csrf
                <div class="row" style="margin-bottom: 4rem;">
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

                        <input type="date" name="birth_day" value="{{ $account_client->date_of_birth }}">

                        <input type="text" name="phone" placeholder="Số điện thoại" id="phone" value="{{ $account_client->phone ? $account_client->phone : old('phone') }}">
                        @error('phone')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                        <div class="address_vn" style="margin-top: 10px;">
                            <select name="province" id="province" class="select_checkout" onchange="selectProvince(this)">
                                <option value="" disabled="disabled" selected="" value="null">Tỉnh/Thành Phố</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}" @if($province->id == $account_client->province_id) selected @endif>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if($account_client->district_id)
                            <select name="district" id="district" class="select_checkout" onchange="selectDistrict(this)">
                                <option value="" disabled="disabled" selected="" value="null">Quận/Huyện</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}" @if($district->id == $account_client->district_id) selected @endif>{{ $district->name }}</option>
                                @endforeach
                            </select>
                        @endif

                        @if($account_client->ward_id)
                            <select name="ward" id="ward" class="select_checkout">
                                <option value="" disabled="disabled" selected="" value="null">Phường/Xã</option>
                                @foreach($wards as $ward)
                                    <option value="{{ $ward->id }}" @if($ward->id == $account_client->ward_id) selected @endif>{{ $ward->name }}</option>
                                @endforeach
                            </select>
                        @endif

                        <input type="text" name="address_plus" placeholder="Số nhà, đường, ..." value="{{ $account_client->address_plus }}">

                        <button type="submit" class="btn">Lưu</button>
                    </div>
                    <div class="col-3">
{{--                        sau này thêm thắt cái gì ở đây --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
