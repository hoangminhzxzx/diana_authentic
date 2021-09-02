@extends('layouts.layout_admin')
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
{{--                <input type="text" name="desc" class="form-control">--}}
                <textarea name="desc" class="form-control" id="desc" cols="30" rows="3"></textarea>
                @error('desc')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <lable>Content</lable>
{{--                <input type="text" name="content" class="form-control">--}}
                <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group d-none">
                <lable>Images</lable>
                <input type="text" name="images" class="form-control">
            </div>
            <div class="form-group">
                <lable>Thumbnail</lable>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
{{--            <div class="dz-default dz-message">--}}
{{--                <span>Upload Thumbnail</span>--}}
{{--            </div>--}}
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
{{--    <script>--}}
    {{--    Dropzone.options.dropzone =--}}
    {{--        {--}}
    {{--            maxFilesize: 1,--}}
    {{--            renameFile: function(file) {--}}
    {{--                var dt = new Date();--}}
    {{--                var time = dt.getTime();--}}
    {{--                return time+file.name;--}}
    {{--            },--}}
    {{--            acceptedFiles: ".jpeg,.jpg,.png,.gif",--}}
    {{--            addRemoveLinks: true,--}}
    {{--            timeout: 50000,--}}
    {{--            removedfile: function(file)--}}
    {{--            {--}}
    {{--                var name = file.upload.filename;--}}
    {{--                $.ajax({--}}
    {{--                    headers: {--}}
    {{--                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
    {{--                    },--}}
    {{--                    type: 'POST',--}}
    {{--                    url: '{{ url("image/delete") }}',--}}
    {{--                    data: {filename: name},--}}
    {{--                    success: function (data){--}}
    {{--                        console.log("File has been successfully removed!!");--}}
    {{--                    },--}}
    {{--                    error: function(e) {--}}
    {{--                        console.log(e);--}}
    {{--                    }});--}}
    {{--                var fileRef;--}}
    {{--                return (fileRef = file.previewElement) != null ?--}}
    {{--                    fileRef.parentNode.removeChild(file.previewElement) : void 0;--}}
    {{--            },--}}

    {{--            success: function(file, response)--}}
    {{--            {--}}
    {{--                console.log(response);--}}
    {{--            },--}}
    {{--            error: function(file, response)--}}
    {{--            {--}}
    {{--                return false;--}}
    {{--            }--}}
    {{--        };--}}
    {{--</script>--}}
@endsection
