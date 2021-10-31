@extends('layouts.layout_admin')
@section('content')
    <div class="row mx-4">
        <div class="col-12 mb-5">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách ORDER</h6>
                    <form action="{{ route('admin.order.list') }}" method="GET">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" name="filter_keyword" value="{{ $filter_keyword ? $filter_keyword : '' }}" class="form-control" placeholder="Tìm kiếm order">
                            </div>
                            <div class="col-4">
                                <select name="filter_status" id="" class="form-control">
                                    <option value="">Trạng thái</option>
                                    <option value="1" @if($filter_status == 1) selected @endif>Đặt hàng</option>
                                    <option value="2" @if($filter_status == 2) selected @endif>Check order</option>
                                    <option value="3" @if($filter_status == 3) selected @endif>Shipping</option>
                                    <option value="4" @if($filter_status == 4) selected @endif>Complete</option>
                                    <option value="5" @if($filter_status == 5) selected @endif>Cancle</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Mã Đơn Hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Created_at</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($orders)
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_code }}</td>
                                        <td><b>{{ $order->customer_name }}</b></td>
                                        <td>{{ $order->customer_phone }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            @if($order->status == 1)
                                                <span class="badge badge-success">Order</span>
                                            @endif
                                            @if($order->status == 2)
                                                <span class="badge badge-warning">Check Order</span>
                                            @endif
                                            @if($order->status == 3)
                                                <span class="badge badge-primary">Đang giao hàng</span>
                                            @endif
                                            @if($order->status == 4)
                                                <span class="badge badge-info">Hoàn thành</span>
                                            @endif
                                            @if($order->status == 5)
                                                <span class="badge badge-danger">Hủy đơn hàng</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.order.detail', $order->id)}}" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                                <i class="fas fa-pen-alt"></i>
                                            </a>
                                            {{--                                <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"--}}
                                            {{--                                   onclick="confirmDelete('#delete-product-{{$product->id}}');return false;">--}}
                                            {{--                                    <i class="fas fa-trash-alt"></i>--}}
                                            {{--                                </a>--}}
                                            {{--                                <form method="POST" id="delete-product-{{$product->id}}"--}}
                                            {{--                                      action="{{route('admin.product.delete', $product->id)}}"--}}
                                            {{--                                      style="display: none;">--}}
                                            {{--                                    @csrf--}}
                                            {{--                                </form>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $orders->render('vendor.pagination.bootstrap-4') }}
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

