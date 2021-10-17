@extends('layouts.layout_front')
@section('title')
    Khôi phục mật khẩu
@endsection
@section('content')

    <!-- ------------- account-page ------------ -->
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <a href=""><img src="" width="100%" alt=""></a>
                </div>
                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span id="restart_password" style="width: 100% !important;">Khôi phục mật khẩu</span>
                            <hr id="Indicator" style="width: 100% !important; transform: unset !important;">
                        </div>
                        <form action="" id="restoreForm" style="top: 80px;">
                            <input type="email" name="emailReg" placeholder="Email đăng ký">
                            <button type="button" class="btn" id="btnRestore">Gửi yêu cầu</button>
                            <span class="" id="span_error_email" style="color: tomato; font-size: 12px; width: 100%;"></span>
                            <span class="" id="span_success_email" style="font-size: 12px; width: 100%;"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
