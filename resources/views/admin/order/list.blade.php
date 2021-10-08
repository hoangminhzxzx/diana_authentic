@extends('layouts.layout_admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách ORDER</h6>
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
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td><b>{{ $order->customer_name }}</b></td>
                            <td>{{ $order->customer_phone }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->created_at }}</td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
