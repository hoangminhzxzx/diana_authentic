@extends('layouts.layout_admin')
@section('styles')
{{--<link rel="stylesheet" href="{{ url('public/plugins/dropzone-5.7.0/dist/dropzone.css') }}">--}}
@endsection

@section('content')
<div class="card mx-4 mb-5">
    <div class="card-header">
        <h3>Tạo sản phẩm</h3>
    </div>
    <div class="card-body">
        <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data" id="uploadProduct" class="">
            @csrf
            <div class="form-group">
                <lable>Tên sản phẩm</lable>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                @error('title')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <lable>Mô tả ngắn</lable>
                <textarea name="desc" class="form-control" id="desc" cols="30" rows="3"></textarea>
                @error('desc')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <lable>Chi tiết sản phẩm</lable>
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
                <lable>Ảnh đại diện</lable>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <div class="form-group">
                <lable>Kích hoạt</lable>
                <select name="is_publish" id="" class="form-control">
                    <option value="0">Choose</option>
                    <option value="1">Publish</option>
                    <option value="2">Unpublish</option>
                </select>
            </div>
            <div class="form-group">
                <lable>Giá sản phẩm</lable>
                <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                @error('price')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <lable>Danh mục cha</lable>
                <select name="category_id" id="" class="form-control">
                    <option value="">Choose</option>
                    @foreach($categories as $item)
                    <option value="{{$item->id}}">{{$item->title}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-outline-success w-25" value="Add">
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
{{--    <script src="{{ url('public/plugins/dropzone-5.7.0/dist/dropzone.js') }}"></script>--}}
{{--<script>--}}
{{--    tinymce.init({--}}
{{--        path_absolute : "http://localhost/diana_authentic_shop/",--}}
{{--        selector: "textarea",--}}
{{--        plugins: [--}}
{{--                "advlist autolink lists link image charmap print preview hr anchor pagebreak",--}}
{{--                "searchreplace wordcount visualblocks visualchars code fullscreen",--}}
{{--                "insertdatetime media nonbreaking save table contextmenu directionality",--}}
{{--                "emoticons template paste textcolor colorpicker textpattern"--}}
{{--            ],--}}
{{--        toolbar: "insertfile undo redo | styleselect | bold italic |lignleft aligncenter alignright alignjustify | bullist numlist outdent indent |image",--}}
{{--        file_picker_callback: function (callback, value, meta) {--}}
{{--            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;--}}
{{--            let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;--}}

{{--            let type = 'image' === meta.filetype ? 'Images' : 'Files',--}}
{{--                url  = '/laravel-filemanager?editor=tinymce5&type=' + type;--}}

{{--            // tinymce.activeEditor.windowManager.openUrl({--}}
{{--            //     url : url,--}}
{{--            //     title : 'Filemanager',--}}
{{--            //     width : x * 0.8,--}}
{{--            //     height : y * 0.8,--}}
{{--            //     onMessage: (api, message) => {--}}
{{--            //         callback(message.content);--}}
{{--            //     }--}}
{{--            // });--}}

{{--            tinyMCE.activeEditor.windowManager.open({--}}
{{--                url : url,--}}
{{--                title : 'Filemanager',--}}
{{--                width : x * 0.8,--}}
{{--                height : y * 0.8,--}}
{{--                onMessage: (api, message) => {--}}
{{--                    callback(message.content);--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
@endsection
