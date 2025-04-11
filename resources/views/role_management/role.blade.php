@extends('layouts')

@section('title','Quyền Người Dùng')

@section('header')

<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Bootstrap table CSS -->
<link href="{{ asset('vendors4/bootstrap-table/dist/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />

<!-- Toggles CSS -->
<link href="{{ asset('vendors4/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('vendors4/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

<!-- Custom CSS -->
<link href="{{ asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">

@endsection

@section('body')


<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Quản Lý</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Quyền Người Dùng</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <h5 class="hk-sec-title">Danh Sách Quyền Người Dùng</h5>
                <a href="#">
                    <button type="button" class="btn btn-primary btn-block mt-50 mb-20 w-20" data-toggle="modal"
                        data-target="#addRole">
                        Thêm quyền mới
                    </button>
                </a>
                @if($errors->any() && $errors->has('errorRoleId'))
                <div class="checkError-red">{{$errors->first('errorRoleId')}}</div>
                @endif
                @if($errors->any() && $errors->has('errorRoleName'))
                <div class="checkError-red">{{$errors->first('errorRoleName')}}</div>
                @endif
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1" class="table table-striped table-bordered hover w-100 display pb-30">
                                <thead style="text-align:center">
                                    <tr>
                                        <th>STT</th>
                                        <th>ID</th>
                                        <th>Tên Quyền</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center">
                                    @if($roles != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ $role->role_id }}</td>
                                        @if($role->role_id=="AD")
                                        <td class="badge badge-danger"
                                            style="display:flex;align-items:center;width:100px">{{ $role->role_name }}
                                        </td>
                                        @else
                                        <td class="badge badge-success"
                                            style="display:flex;align-items:center;width:100px">{{ $role->role_name }}
                                        </td>
                                        @endif
                                        @if($role->status==1)
                                        <td><span class="badge badge-success">Còn Hoạt Động</span> </td>
                                        @else
                                        <td><span class="badge badge-danger">Ngừng Hoạt Động</span> </td>
                                        @endif
                                        @if($role->role_id=="AD")
                                        <td></td>
                                        @else
                                        <td>
                                            <a class="marginRight" href="javascript:void(0)" data-toggle="modal"
                                                data-original-title="Cập Nhật Quyền Người Dùng"
                                                data-target="#updateRole">
                                                <span data-toggle="tooltip"
                                                    data-original-title="Cập Nhật Quyền Người Dùng">
                                                    <i class="btn_update_role icon-pencil"
                                                        id="{{ $role->role_id }}"></i>
                                                </span>
                                            </a>
                                            @if($role->status==1)
                                            <a class="remove_role text-danger" id="{{ $role->role_id }}"
                                                data-toggle="modal" data-original-title="Xoá Quyền Người Dùng"
                                                data-target="#deleteRole">
                                                <span data-toggle="tooltip" data-original-title="Xoá Quyền Người Dùng">
                                                    <i class="icon-trash"></i>
                                                </span> </a>
                                            @else
                                            <a data-toggle="modal" data-original-title="Khôi phục Quyền Người Dùng"
                                                data-target="#restoreRole" class="recover_role text-warning"><span
                                                    data-toggle="tooltip"
                                                    data-original-title="Khôi Phục Quyền Người Dùng">
                                                    <i class="recover_role glyphicon glyphicon-circle-arrow-left"
                                                        id="{{ $role->role_id }}"></i>
                                                </span> </a>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="text-center dataTables_empty">Danh sách
                                            trống</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /Row -->

</div>
<!-- /Container -->

<div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="addRole" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Tạo Quyền Người Dùng Mới</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add-role')}}" method="POST">
                    @csrf
                    <div class="form-group role_id">
                        <label for="inputRoleId">ID Quyền</label>
                        <input type="text" placeholder="Vui lòng nhập ID Quyền" name="role_id" id="inputRoleId"
                            class="form-control">
                    </div>
                    <div class="form-group role_name">
                        <label for="inputRoleName">Tên Quyền</label>
                        <input type="text" placeholder="Vui lòng nhập Tên Quyền" name="role_name" id="inputRoleName"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn_submit_add_role btn-primary btn btn-block mr-10" type="submit">Tạo Quyền
                            Người Dùng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateRole" tabindex="-1" role="dialog" aria-labelledby="updateRole" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Chỉnh Sửa Quyền</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update-role')}}" method="POST">
                    @csrf
                    <input type="text" name="role_id" id="inputRoleId" hidden=true>
                    <div class="form-group role_name">
                        <label for="inputRoleNameUpdate">Tên Quyền</label>
                        <input type="text" placeholder="Vui lòng nhập Tên Quyền Người Dùng" name="role_name"
                            id="inputRoleNameUpdate" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn_submit_update_role btn btn-primary btn-block mr-10" type="submit">Cập
                            Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /Row -->
<div class="modal fade" id="deleteRole" tabindex="-1" role="dialog" aria-labelledby="deleteRole" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRole">Xoá Quyền Người Dùng
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                    muốn xoá Quyền Người Dùng này?
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                    bỏ</button>
                <button type="button" id="" class="btn_remove_role btn btn-primary">Xoá Quyền Người Dùng</button>
            </div>
        </div>
    </div>
</div>

<!-- /Row -->
<div class="modal fade" id="restoreRole" tabindex="-1" role="dialog" aria-labelledby="restoreRole" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreRole">Khôi Phục Quyền Người Dùng
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                    muốn khôi phục Quyền Người Dùng này?
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                    bỏ</button>
                <button type="button" id="" class="btn_recover_role btn btn-primary">Khôi Phục</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('footer-script')
<script src="{{ asset('vendors4/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('vendors4/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{ asset('vendors4/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('dist/js/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('dist/js/feather.min.js')}}"></script>
<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
<script src="{{ asset('vendors4/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script src="{{ asset('vendors4/peity/jquery.peity.min.js')}}"></script>
<script src="{{ asset('dist/js/peity-data.js')}}"></script>
<script src="{{ asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
<script src="{{ asset('dist/js/toggle-data.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<script src="{{ asset('dist/js/validation-form.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/role.js') }}"></script>
<script src="{{ asset('vendors4/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('dist/js/dataTables-data.js')}}"></script>
@endsection
