@extends('layouts.layout_admin')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-header">
                    @if (session('success_variant'))
                        <div class="alert alert-success mt-3" role="alert">{{session('success_variant')}}</div>
                    @endif
                    <h3>Variants</h3>
                </div>
                <div class="card-body">
                    @if($product->category_id != 12)
                        <form action="{{ route('admin.product.variant.update', $variant->id) }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <div class="form-group color_hex">
                                <lable>Color Hex</lable>
                                <input type="text" name="color_hex" id="colorpicker_variant" value="{{ $variant->color?$variant->color->value:"" }}" class="form-control">
                                @error('color_hex')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group color_name">
                                <lable>Color Name</lable>
                                <input type="text" name="color_name" value="{{ $variant->color?$variant->color->name:"" }}"
                                       class="form-control">
                                @error('color_name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group size">
                                <lable>Size</lable>
                                <input type="text" name="size" value="{{ $variant->size?$variant->size->value:"" }}" class="form-control">
                                @error('size')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <lable>Price</lable>--}}
{{--                                <input type="text" name="price" value="{{ $variant->price?$variant->price:"" }}" class="form-control">--}}
{{--                                @error('price')--}}
{{--                                <small class="text-danger">{{$message}}</small>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
                            <div class="form-group size">
                                <lable>Số lượng</lable>
                                <input type="text" name="qty" value="{{ $variant->qty ? $variant->qty : old('qty') }}" class="form-control">
                                @error('qty')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-outline-success w-25" value="Save">
                            </div>
                        </form>
                    @endif

                    @if($product->category_id == 12)
                        <form action="{{ route('admin.product.variantAss.update', $variant->id) }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <div class="form-group">
                                <lable>Giá phụ kiện</lable>
                                <input type="number" name="price" class="form-control" value="{{ $variant->price?$variant->price:"" }}">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-success">
                            </div>
                        </form>
                    @endif
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
