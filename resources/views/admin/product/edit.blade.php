@extends('layouts.layout_admin')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-header">
                    @if (session('success_product'))
                        <div class="alert alert-success mt-3" role="alert">{{session('success_product')}}</div>
                    @endif
                    @if (session('status_update_variant'))
                        <div class="alert alert-success mt-3" role="alert">{{session('status_update_variant')}}</div>
                    @endif
                    @if (session('status_delete_variant'))
                        <div class="alert alert-success mt-3" role="alert">{{session('status_delete_variant')}}</div>
                    @endif
                    <h3>Update Product</h3>
                </div>
{{--                <img class="img-thumbnail" id="image" src="{{ asset($product->thumbnail) }}" style="margin-top: 1rem; max-width: 200px;" /> Ảnh sản phẩm đại diện ( Khi muốn thay đổi cần liên hệ với Bang Chủ hoặc xóa đi nhập liệu lại)--}}
                <div class="card-body">
                    <form action="{{route('admin.product.update', $product->id)}}" method="POST" id="uploadProduct" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <lable>Title</lable>
                            <input type="text" name="title" value="{{ $product->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable>Desc</lable>
                            <textarea name="desc" class="form-control" id="desc" cols="30" rows="3">{{ $product->desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <lable>Content</lable>
                            <textarea name="content" class="form-control" id="content" cols="30" rows="5">{{ $product->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <lable>Images</lable>
                        </div>
                        <div class="form-group">
                            <div id="thumbnail">
                                <img class="img-thumbnail" id="image" src="{{ asset($product->thumbnail) }}" style="margin-top: 1rem; max-width: 300px;" />
                            </div>
                            <label for="inputUpload" id="btn_upload" class="btn btn-outline-success font-weight-bolder font-size-sm mb-0" >
                                <i class="spinner spinner-success d-none mr-5"></i>
                                <span>Đổi ảnh</span>
                            </label>
{{--                            <form action="" method="POST" id="change-thumbnail" class="d-none" enctype="multipart/form-data">--}}
{{--                                @csrf--}}
                            <input type="file" class="d-none" id="inputUpload" name="thumbnail" value="" onchange="changeThumbnail(this)">
{{--                            </form>--}}
                        </div>
                        <div class="form-group">
                            <lable>Is publish</lable>
                            <select name="is_publish" id="" class="form-control">
                                <option value="0">Choose</option>
                                <option value="1" @if($product->is_publish == 1) selected @endif>Publish</option>
                                <option value="2" @if($product->is_publish == 2) selected @endif>Unpublish</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <lable>Giá sản phẩm</lable>
                            <input type="text" name="price" value="{{ $product->price }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable>Categories</lable>
                            <select name="category_id" id="" class="form-control">
                                <option value="0">Choose</option>
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}"
                                            @if($product->category_id == $item->id) selected @endif>{{$item->title}}</option>
                                @endforeach
                                <option value="{{ $category_accessory->id }}"
                                        @if(isset($product->category->id) && $product->category->id == $category_accessory->id) selected @endif>{{ $category_accessory->title }}</option>
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-outline-success w-25" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-header">
                    @if (session('success_variant'))
                        <div class="alert alert-success mt-3" role="alert">{{session('success_variant')}}</div>
                    @endif
                    <h3>Variants</h3>
                </div>
                <div class="card-body">
                    @if(isset($product->category->id) && $product->category->id != 12)
                        <form action="{{ route('admin.product.variant.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <div class="form-group color_hex">
                                <lable>Color Hex</lable>
                                <input type="text" name="color_hex" id="colorpicker_variant" value="{{ old('color_hex') }}" class="form-control">
                                @error('color_hex')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group color_name">
                                <lable>Color Name</lable>
                                <input type="text" name="color_name" value="{{ old('color_name') }}"
                                       class="form-control">
                                @error('color_name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group size">
                                <lable>Size</lable>
                                <input type="text" name="size" value="{{ old('size') }}" class="form-control">
                                @error('size')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <lable>Price</lable>--}}
{{--                                <input type="text" name="price" value="{{ old('price') }}" class="form-control">--}}
{{--                                @error('price')--}}
{{--                                <small class="text-danger">{{$message}}</small>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-outline-success w-25" value="Thêm">
                            </div>
                        </form>
                    @endif

                    @if(isset($product->category->id) && $product->category->id == 12)
                        <form action="{{ route('admin.product.variant_ass.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <div class="form-group">
                                <lable>Giá phụ kiện</lable>
                                <input type="number" name="price" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-success">
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <div class="card mx-4 mt-5">
                <div class="card-header">
                    <h4>List Variants</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                <span><label class="checkbox checkbox-single checkbox-all"><input type="checkbox">&nbsp;<span></span></label></span>
                            </th>
                            <th class=""><span>Color hex</span></th>
                            <th class=""><span>Color name</span></th>
                            <th class=""><span>Size</span></th>
                            <th class=""><span>Price</span></th>
                            <th><span>Actions</span></th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        {{$product->ProductVariants}}--}}
                        @foreach($product->ProductVariants as $item)
                        <tr>
                            <td><span><label class="checkbox checkbox-single"><input type="checkbox"
                                                                                     value="1">&nbsp;<span></span></label></span>
                            </td>
                            <td><span>{{ ($item->color)?$item->color->value:"" }}</span></td>
                            <td><span>{{ ($item->color)?$item->color->name:"" }}</span></td>
                            <td><span>{{ ($item->size)?$item->size->value:"" }}</span></td>
                            <td><span>{{$item->price?$item->price:""}}</span></td>
                            <td>
                                <a href="{{ route('admin.product.variant.edit', ['id'=>$item->id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                    <i class="fas fa-pen-alt"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
                                   onclick="confirmDelete('#delete-variant-{{ $item->id }}');return false;">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form method="POST" id="delete-variant-{{ $item->id }}"
                                      action="{{ route('admin.product.variant.delete', ['id'=>$item->id]) }}"
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
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js" type="text/javascript"></script>
    <script>
        $("#colorpicker_variant").spectrum();
    </script>
@endsection
