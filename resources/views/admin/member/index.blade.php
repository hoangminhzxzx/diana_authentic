@extends('layouts.layout_admin')
@section('styles')

@endsection
@section('content')
    <div class="row mx-4">
        <div class="col-12 mb-5">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách member Diana Authentic</h6>
                    <form action="{{ route('admin.member.index') }}" method="GET">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" name="filter_keyword"
                                       value="{{ $keyword ? $keyword : '' }}" class="form-control"
                                       placeholder="Tìm kiếm hội viên">
                            </div>
                            <div class="col-4">
                                <select name="filter_status" id="" class="form-control">
                                    <option value="">Rank</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if(isset($members) && $members)
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ngày đăng ký</th>
                                <th>Rank</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                            <tr>
                                <td>{{ ($member->name) ? $member->name : 'member name' }}</td>
                                <td>{{ ($member->phone) ? $member->phone : 'member phone' }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ substr($member->created_at, 0, 10) }}</td>
                                <td><span class="badge-success">Comming soon</span></td>
                                <td>
                                    <a class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3" data-toggle="modal" data-target="#modalDetail-{{ $member->id }}">
                                        <i class="fas fa-pen-alt"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modalDetail-{{ $member->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="max-width: 700px !important;;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $member->name ? $member->name : 'member name' }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-3">Email : </div>
                                                    <div class="col-md-9">{{ $member->email }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Username : </div>
                                                    <div class="col-md-9">{{ $member->username }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Phone : </div>
                                                    <div class="col-md-9">{{ $member->phone }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Sinh nhật : </div>
                                                    <div class="col-md-9">{{ $member->date_of_birth }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Địa chỉ : </div>
                                                    <div class="col-md-9">{{ $member->address }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 text-success">Tổng Pay : </div>
                                                    <div class="col-md-9 text-success">{{ number_format($member->total_pay, 0,'.','.') }} VNĐ</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Rank : </div>
                                                    <div class="col-md-9"><span class="badge-success">Coming soon</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{ $members->render('vendor.pagination.bootstrap-4') }}
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
{{--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
{{--        Launch demo modal--}}
{{--    </button>--}}

{{--    <!-- Modal -->--}}
{{--    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    ...--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
