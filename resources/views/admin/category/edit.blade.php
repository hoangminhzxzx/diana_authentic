@extends('layouts.layout_admin')

@section('content')
    <div class="card mx-5">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Edit Category</h3>
                        @if (session('status-not-exist'))
                            <div class="alert alert-success" role="alert">{{session('status-not-exist')}}</div>
                        @endif
                        <form role="form" method="POST" action="{{route('admin.category.update', $category->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label>Title:</label>
                                <input type="text" id="title" name="title" value="{{$category->title}}" class="form-control"
                                       placeholder="Enter Title">
                                @if ($errors->has('title'))
                                    <span class="text-red" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                                <label>Category:</label>
                                <select id="parent_id" name="parent_id" class="form-control">
                                    <option value="0">Select</option>
                                    @foreach($allCategories as $rows)
                                        <option value="{{ $rows->id }}"
                                        @if($category->parent_id == $rows->id) selected @endif
                                        >{{ $rows->title }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('parent_id'))
                                    <span class="text-red" role="alert">
                                <strong>{{ $errors->first('parent_id') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <lable>Phụ kiện</lable>
                                <input type="checkbox" name="is_accessory" @if($category->is_accessory == 1) checked @endif>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
