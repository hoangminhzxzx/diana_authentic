@extends('layouts.layout_admin')
@section('content')
    <div class="row mx-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
                    <form action="{{ route('admin.product.list') }}" method="GET">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" name="filter_keyword" value="{{ $filter_keyword ? $filter_keyword : '' }}" class="form-control" placeholder="Tìm kiếm sản phẩm">
                            </div>
                            <div class="col-2">
                                <select name="filter_status" id="" class="form-control">
                                    <option value="">Trạng thái</option>
                                    <option value="on" @if ($filter_status == 'on') selected @endif>Kích hoạt</option>
                                    <option value="off" @if ($filter_status == 'off') selected @endif>Vô hiệu hóa</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <select name="filter_category" id="" class="form-control">
                                    <option value="">Danh mục</option>
                                    @foreach($categories as $category)
                                        <option class="@if($category->parent_id == 0) font-weight-bold @endif" value="{{ $category->id }}" @if($category->id == $filter_category) selected @endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <select name="sort_view" id="" class="form-control">
                                    <option value="">Lượt view</option>
                                    <option value="asc" @if(isset($sort_view) && $sort_view == 'asc') selected @endif>Tăng dần</option>
                                    <option value="desc" @if(isset($sort_view) && $sort_view == 'desc') selected @endif>Giảm dần</option>
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
                                <th>Ảnh đại diện</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Trạng thái kích hoạt</th>
                                <th>Ngày tạo</th>
                                <th>Lượt xem</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list_product as $product)
                                <tr class="row-product-{{ $product->id }}">
                                    <td><img src="{{ url($product->thumbnail) }}" alt="" class="img-thumbnail" width="120"></td>
                                    <td>{{ $product->title }}</td>
                                    <td><b>{{ $product->category->title }}</b></td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                   onchange="setPublishProduct(this, {{ $product->id }})"
                                                   id="set-publish-{{ $product->id }}"
                                                   @if ($product->is_publish == 1) checked @endif>
                                            <label class="custom-control-label" for="set-publish-{{ $product->id }}"></label>
                                        </div>
                                    </td>
                                    <td>{{ substr($product->created_at, 0, 10) }}</td>
                                    <td>{{ number_format($product->total_view, 0, '.', '.') }}</td>
                                    <td>
                                        <a href="{{route('admin.product.edit', $product->id)}}"
                                           class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                            <i class="fas fa-pen-alt"></i>
                                        </a>
                                        <a class="btn btn-icon btn-light btn-hover-danger btn-sm"
                                           onclick="deleteProduct(this, {{ $product->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            {{ $list_product->render('vendor.pagination.bootstrap-4') }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
