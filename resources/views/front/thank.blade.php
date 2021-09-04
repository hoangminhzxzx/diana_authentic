@extends('layouts.layout_front')
@section('title')
    Cám Ơn Đã Đặt Hàng
@endsection

@section('content')
    <div class="small-container" style="min-height: 400px; margin-top: 80px;">
        <h3><b>Đặt hàng thành công !</b></h3>
        <p>Vui lòng để ý điện thoại và Email, chúng tôi sẽ liên hệ với bạn sớm nhất !</p>
        <p>Bấm vào <a href="{{ route('homeFront') }}" style="color: #4da6dc;">đây</a> để quay lại Trang Chủ</p>
    </div>
@endsection
