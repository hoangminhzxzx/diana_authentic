@extends('layouts.layout_admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>List Category</h3>
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
                    <th>
                        <span><label class="checkbox checkbox-single checkbox-all"><input type="checkbox">&nbsp;<span></span></label></span>
                    </th>
                    <th class=""><span>Title</span></th>
                    <th><span>Actions</span></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($list_category as $category)
                    <tr>
                        <td><span><label class="checkbox checkbox-single"><input type="checkbox" value="1">&nbsp;<span></span></label></span></td>
                        <td>
                            <span>{{$category->title}}</span>
                        </td>
                        <td>
                            <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                <i class="fas fa-pen-alt"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
                               onclick="confirmDelete('#delete-category-{{$category->id}}');return false;">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <form method="POST" id="delete-category-{{$category->id}}"
                                  action="{{route('admin.category.delete', $category->id)}}"
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
@endsection
