@extends('layouts.layout_admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if (session('status_add_user'))
                <div class="alert alert-success mt-3" role="alert">{{session('status_add_user')}}</div>
            @endif
            @if (session('status_update_user'))
                <div class="alert alert-success mt-3" role="alert">{{session('status_update_user')}}</div>
            @endif
            @if (session('status_delete_user'))
                <div class="alert alert-success mt-3" role="alert">{{session('status_delete_user')}}</div>
            @endif
            <h6 class="m-0 font-weight-bold text-primary">List User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>@foreach($user->roles as $r) {{ $r->role_name }} @endforeach</td>
                        <td>
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
                                <i class="fas fa-pen-alt"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm"
                               onclick="confirmDelete('#delete-user-{{ $user->id }}');return false;">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <form method="POST" id="delete-user-{{ $user->id }}"
                                  action="{{ route('admin.user.delete', $user->id) }}"
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
    <!-- /.container-fluid -->
@endsection
