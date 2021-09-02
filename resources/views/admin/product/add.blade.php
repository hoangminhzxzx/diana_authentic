@extends('layouts.layout_admin')
@section('styles')
<link rel="stylesheet" href="{{ url('public/plugins/dropzone-5.7.0/dist/dropzone.css') }}">
@endsection
@section('content')
<div class="card mx-4">
    <div class="card-header">
        <h3>Create Product</h3>
    </div>
    <div class="card-body">
        <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data" id="uploadProduct" class="">
            @csrf
            <div class="form-group">
                <lable>Title</lable>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                @error('title')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <lable>Desc</lable>
                <textarea name="desc" class="form-control" id="desc" cols="30" rows="3"></textarea>
                @error('desc')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <lable>Content</lable>
                <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
            </div>
{{--            <div class="form-group">--}}
{{--                <form action="{{ route('admin.upload.images.dz') }}" class="dropzone">--}}
{{--                    @csrf--}}
{{--                    <div class="fallback">--}}
{{--                        <input name="file" type="file" multiple />--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
            <div class="form-group">
                <lable>Thumbnail</lable>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <div class="form-group">
                <lable>Is publish</lable>
                <select name="is_publish" id="" class="form-control">
                    <option value="0">Choose</option>
                    <option value="1">Publish</option>
                    <option value="2">Unpublish</option>
                </select>
            </div>
            <div class="form-group">
                <lable>Giá sản phẩm</lable>
                <input type="text" name="price" class="form-control">
                @error('price')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <lable>Categories</lable>
                <select name="category_id" id="" class="form-control">
                    <option value="0">Choose</option>
                    @foreach($categories as $item)
                    <option value="{{$item->id}}">{{$item->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-outline-success w-25" value="Add">
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ url('public/plugins/dropzone-5.7.0/dist/dropzone.js') }}"></script>
@endsection
