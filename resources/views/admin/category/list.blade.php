@extends('layouts.layout_admin')
@section('content')
    <div class="row text-center mb-5">
        <div class="col-6 offset-1">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách danh mục</h3>
                    @if (session('status-delete'))
                        <div class="alert alert-success" role="alert">{{session('status-delete')}}</div>
                    @endif
                    @if (session('status-delete-error'))
                        <div class="alert alert-danger" role="alert">{{session('status-delete-error')}}</div>
                    @endif
                </div>
                <div class="card-body" style="background: #ffffff;">
                    <table class="table">
                        <thead>
                        <tr>
                            {{--                    <th>--}}
                            {{--                        <span><label class="checkbox checkbox-single checkbox-all"><input type="checkbox">&nbsp;<span></span></label></span>--}}
                            {{--                    </th>--}}
                            <th class=""><span>Tên danh mục</span></th>
                            <th><span>Hành động</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list_category as $category)
                            <tr class="row-category">
                                {{--                        <td><span><label class="checkbox checkbox-single"><input type="checkbox" value="1">&nbsp;<span></span></label></span></td>--}}
                                <td>
                                    <span>{{$category->title}}</span>
                                </td>
                                <td>
                                    <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>
                                    <a class="btn btn-icon btn-light btn-hover-danger btn-sm"
                                       onclick="deleteCategory(this,{{ $category->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    {{--                            <form method="POST" id="delete-category-{{$category->id}}"--}}
                                    {{--                                  action="{{route('admin.category.delete', $category->id)}}"--}}
                                    {{--                                  style="display: none;">--}}
                                    {{--                                @csrf--}}
                                    {{--                            </form>--}}
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
