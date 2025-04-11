@extends('layouts')

@section('title','Quản Lý Khách Hàng')

@section('header')
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Bootstrap table CSS -->
<link href="{{ asset('vendors4/bootstrap-table/dist/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Toggles CSS -->
<link href="{{ asset('vendors4/jquery-toggles/css/toggles.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('vendors4/jquery-toggles/css/themes/toggles-light.css') }}" rel="stylesheet" type="text/css">

<!-- Custom CSS -->
<link href="{{ asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Quản Lý</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Khách Hàng</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">
    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                        data-feather="archive"></i></span></span>Quản Lý Khách Hàng</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1" class="table table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình Ảnh</th>
                                        <th>ID</th>
                                        <th>Tên Khách Hàng</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Điểm Tích Luỹ</th>
                                        <th>Cấp Bậc</th>
                                        <th>Quyền</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center">
                                    @if($members != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($members as $member)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td><img class="avatar-xl circle" style="width:50px;height:50px"
                                                src="{{env('APP_URL')}}/upload/avatar_users/{{$member->user->image}}">
                                        </td>
                                        <td>{{$member->member_id}}</td>
                                        <td>{{$member->user->full_name}}</td>
                                        <td>{{$member->user->phone}}</td>
                                        <td>{{$member->current_point}}</td>
                                        <td>{{$member->rank->rank_name}}</td>
                                        <td><span class=" badge badge-info">{{$member->user->role->role_name}}</span>
                                        </td>
                                        @if($member->status==1)
                                        <td><span class="badge badge-success">Còn Hoạt Động</span> </td>
                                        @else
                                        <td><span class="badge badge-danger">Ngừng Hoạt Động</span> </td>
                                        @endif
                                        <td style="text-align:center;">
                                            @if($member->status==1)
                                            <a href="javascript:void(0)" id="{{$member->member_id}}"
                                                class="block_member text-warning" data-toggle="modal"
                                                data-toggle="tooltip" data-original-title="Khoá Tài Khoản"
                                                data-target="#blockMember">
                                                <span data-toggle="tooltip" data-original-title="Khoá Tài Khoản"><i
                                                        class="icon-trash"></i></span>
                                            </a>
                                            @else
                                            <a href="javascript:void(0)" class="unlock_member text-warning"
                                                id="{{$member->member_id}}" data-toggle="modal" data-toggle="tooltip"
                                                data-original-title="Khôi Phục Tài Khoản" data-target="#unlockMember">
                                                <i data-toggle="tooltip" data-original-title="Khôi Phục Tài Khoản"
                                                    class="glyphicon glyphicon-circle-arrow-left"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="10" class="text-center dataTables_empty">Danh sách
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
    <!--Modal Block Member-->
    <div class="modal fade" id="blockMember" tabindex="-1" role="dialog" aria-labelledby="blockMember"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeProducer">Khoá Khách Hàng
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn khoá khách hàng này?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-block-member btn btn-primary">Khoá</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Unlock Member-->
    <div class="modal fade" id="unlockMember" tabindex="-1" role="dialog" aria-labelledby="unlockMember"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recoverProducer">Khôi Phục Khách Hàng
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn khôi phục khách hàng này?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-unlock-member btn btn-primary">Khôi phục</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /Container -->
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
<script type="text/javascript" src="{{ asset('js/jquery/member.js') }}"></script>
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
