@extends('layouts.layout_front')
@section('title')
    Đổi mật khẩu
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
                            <span id="restart_password" style="width: 100% !important;">Đổi mật khẩu</span>
                            <hr id="Indicator" style="width: 100% !important; transform: unset !important;">
                        </div>
                        <form action="" id="updateRestorePassForm" style="top: 80px;">
                            <input type="hidden" id="hidden_info" data-account-client-id="{{ $account_client->id }}" data-account-client-password="{{ $account_client->password }}" data-account-client-email="{{ $account_client->email }}">
                            <input type="password" name="password" placeholder="Password">
                            <input type="password" name="confirm_password" placeholder="Confirm password">
                            <button type="button" class="btn" id="btnUpdateRestorePassForm">Lưu</button>
                            <span class="" id="span_error" style="color: tomato; font-size: 12px; width: 100%;"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
