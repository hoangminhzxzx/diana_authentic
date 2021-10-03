@extends('layouts.layout_admin')
@section('styles')
    <style>
        .item-circle {
            min-height: 60px;
            line-height: 60px;
            background: #eee3e3;
            border-radius: 50%;
            width: 25%;
            cursor: pointer;
        }

        .item-circle:hover {
            background: #adb5bd;
        }

        .item-circle-success {
            background: #a9ded9;
        }
    </style>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Trạng thái đơn hàng</h6>
        </div>
        <div class="card-body d-flex">
            <div class="col-6 col-lg-3">
                <div class="block block-link-shadow text-center">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-success-light mx-auto">
{{--                            <i class="fa fa-check text-success"></i>--}}
                            <i class="fa fa-sync fa-spin text-warning"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
{{--                        <p class="font-w600 font-size-sm text-success mb-0">--}}
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Check đơn hàng
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="block block-link-shadow text-center" style="cursor: pointer" onclick="order_payment(148)">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-body mx-auto">
                            <i class="fa fa-sync fa-spin text-warning"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Đang giao hàng
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="block block-link-shadow text-center" style="cursor: pointer" onclick="order_payment(148)">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-body mx-auto">
                            <i class="fa fa-sync fa-spin text-warning"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Hoàn thành
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="block block-link-shadow text-center" style="cursor: pointer" onclick="order_cancel(148)">
                    <div class="block-content block-content-full">
                        <div class="item item-circle bg-body mx-auto">
                            <i class="fa fa-times text-muted"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Hủy
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
