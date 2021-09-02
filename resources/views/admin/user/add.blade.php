@extends('layouts.layout_admin')
@section('content')
    <div class="card mx-4 w-50">
        <div class="card-header">
            <h3>Create User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <lable>Username</lable>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control">
                    @error('username')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <lable>Password</lable>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    @foreach($roles as $role)
                    {{ strtoupper($role->role_name) }} <input type="checkbox" class="-check" name="role_id[]" value="{{ $role->id }}"> <br>
                        <br>
                    @endforeach
{{--                    <select name="role_id" id="" class="form-control">--}}
{{--                        <option value="">Choose Role</option>--}}
{{--                        @foreach($roles as $role)--}}
{{--                        <option value="{{ $role->id}}">{{ $role->role_name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
                </div>
                @error('role_id')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-outline-success w-25" value="Add">
                </div>
            </form>
        </div>
    </div>
@endsection
