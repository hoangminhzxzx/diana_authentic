@extends('layouts.layout_admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Ảnh đại diện</th>
                        <th>Trạng thái kích hoạt</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_product as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td><b>{{ $product->category->title }}</b></td>
                        <td><img src="{{ url($product->thumbnail) }}" alt="" class="img-thumbnail" width="120"></td>
                        <td>
                            @if($product->is_publish == 1)
                                Kích hoạt
                            @endif
                            @if($product->is_publish == 2)
                                Không kích hoạt
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                <i class="fas fa-pen-alt"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
                               onclick="confirmDelete('#delete-product-{{$product->id}}');return false;">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <form method="POST" id="delete-product-{{$product->id}}"
                                  action="{{route('admin.product.delete', $product->id)}}"
                                  style="display: none;">
                                @csrf
                            </form>
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
