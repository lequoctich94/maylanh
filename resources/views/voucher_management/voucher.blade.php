@extends('layouts')
@section('title','Quản Lý Mã Khuyến Mãi')
@section('header')
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Bootstrap table CSS -->
<link href="{{ asset('vendors4/bootstrap-table/dist/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />

<!-- Toggles CSS -->
<link href="{{ asset('vendors4/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('vendors4/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

<!-- Calendar CSS -->
<link href="{{ asset('vendors4/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />

<!-- Daterangepicker CSS -->
<link href="{{ asset('vendors4/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />

<!-- Custom CSS -->
<link href="{{ asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Quản Lý</a>
        </li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Quản Lý Mã
            Khuyến Mãi</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">
    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                        data-feather="archive"></i></span></span>Quản Lý Mã Khuyến Mãi</h4>
    </div>

    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <button type="button" class="btn btn-primary btn-block mb-20 w-20" data-toggle="modal"
                    data-target="#addVoucher">
                    Tạo Mã Khuyến Mãi
                </button>
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1"
                                class="table mb-0 table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã Khuyến Mãi</th>
                                        <th>Giảm (%)</th>
                                        <th>Giá Tối Đa</th>
                                        <th>Sử Dụng Tối Đa</th>
                                        <th>Ngày Bắt Đầu</th>
                                        <th>Ngày Hết Hạn</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($vouchers != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($vouchers as $voucher)
                                    @php
                                    $today_date = Carbon\Carbon::now('Asia/Ho_Chi_Minh');
                                    $start_date =
                                    Carbon\Carbon::createFromFormat('Y-m-d',$voucher->date_start);
                                    $end_date =
                                    Carbon\Carbon::createFromFormat('Y-m-d',$voucher->date_end);
                                    @endphp
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$voucher->code}}</td>
                                        <td>{{$voucher->sale_off*100}}%</td>
                                        <td>{{number_format($voucher->max_price)}}đ</td>
                                        <td>{{$voucher->max_used}} Lượt</td>
                                        <td>{{$voucher->date_start}}</td>
                                        <td>{{$voucher->date_end}}</td>
                                        <!-- status = 1: có thể sử dụng,  -1 đã sử dụng -->
                                        @if($voucher->status==1)
                                        <!-- Kiểm tra voucher đã nằm trong ngày kích hoạt -->
                                        @if($today_date < $start_date) <td><span class="badge badge-info">Chờ kích
                                                hoạt</span></td>
                                            @elseif($today_date >= $start_date && $today_date < $end_date) <td><span
                                                    class="badge badge-success">Đang Hoạt Động</span></td>
                                                @elseif($today_date >= $end_date)
                                                <td><span class="badge badge-warning">Đã hết hạn</span></td>
                                                @endif
                                                @else
                                                <td><span class="badge badge-danger">Hết lượt</span></td>
                                                @endif
                                                <td>
                                                    @if($voucher->status==1)
                                                    <a class="marginRight" data-toggle="modal"
                                                        data-original-title="Cập Nhật Mã Khuyến Mãi"
                                                        data-target="#updateVoucher">
                                                        <span data-toggle="tooltip"
                                                            data-original-title="Cập Nhật Mã Khuyến Mãi">
                                                            <i class="btn-update-voucher icon-pencil text-green"
                                                                id="{{ $voucher->code }}"></i>
                                                        </span>
                                                    </a>
                                                    @endif
                                                    <a
                                                        href="{{route('voucher-member-management',['code'=>$voucher->code])}}">
                                                        <span data-toggle="tooltip"
                                                            data-original-title="Xem Chi Tiết Mã Khuyến Mãi">
                                                            <i class="icon-eye text-green"></i>
                                                        </span>
                                                    </a>
                                                    <!-- @if($voucher->status==1)
                                                                                    <a href="#" id="{{$voucher->code}}"
                                                                                        class="remove_voucher text-warning" data-toggle="modal"
                                                                                        data-original-title="Xoá" data-target="#removeVoucher"> <i
                                                                                            class="icon-trash"></i>
                                                                                    </a>
                                                                                    @endif -->
                                                </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="9" class="text-center dataTables_empty">Danh sách
                                            khuyến mãi trống</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <div class="modal fade" id="addVoucher" tabindex="-1" role="dialog" aria-labelledby="addVoucher"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h6 class="modal-title text-white" id="addVoucher">Tạo Mã Khuyến Mãi</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('add-voucher-member')}}" method="POST">
                                @csrf
                                <div class="form-group code">
                                    <label for="inputCode">Mã</label>
                                    <input type="text" placeholder="Vui lòng nhập Mã muốn tạo" name="code"
                                        id="inputCode" class="form-control">
                                </div>
                                <div class="form-group sale_off">
                                    <label for="inputSaleOff">Giảm (% vd: 0.3 => 30%) <em>(Giá Tiền = Giá Tiền *
                                            Giảm - Ví dụ:`3.000.000` => `3.000.000 * 0.3 = `2.400.000`)</em></label>
                                    <input type="text" value="0" id="inputSaleOff" name="sale_off" class="form-control">
                                </div>
                                <div class="form-group max_price">
                                    <label for="inputMaxPrice">Giá Trị Tối Đa</label>
                                    <input type="text" value="{{number_format(0)}}" name="max_price" id="inputMaxPrice"
                                        class="form-control">
                                </div>
                                <div class="form-group max_used">
                                    <label for="inputMaxUsed">Lượt Tối Đa <em>( Số lượt tối đa cho toàn bộ người
                                            dùng )</em></label>
                                    <input type="number" value="1" min="1" name="max_used" id="inputMaxUsed"
                                        class="form-control">
                                </div>
                                <div class="form-group date_start">
                                    <label for="inputDateStart">Ngày Bắt Đầu</label>
                                    <input type="date" name="date_start" id="inputDateStart"
                                        class="form-control datepicker">
                                </div>
                                <div class="form-group date_end">
                                    <label for="inputDateEnd">Ngày Kết Thúc</label>
                                    <input type="date" name="date_end" id="inputDateEnd"
                                        class="form-control datepicker1">
                                </div>
                                <div class="row">
                                    <div class="col-sm checked_member">
                                        <div class="form-group custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_checked_all"
                                                id="isAll">
                                            <label class="custom-control-label" for="isAll">Tất Cả</label>
                                        </div>
                                        <div class="table-wrap">
                                            <table id="datable_11" class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>ID</th>
                                                        <th>Số Điện Thoại</th>
                                                        <th>Họ Tên</th>
                                                        <th>Hạng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($members as $member)
                                                    <tr>
                                                        <td>
                                                            <input id="isCheckedElement" class="custom_check"
                                                                name="isCheckedElement[]" type="checkbox"
                                                                value="{{$member->member_id}}">
                                                        </td>
                                                        <td>{{$member->member_id}}</td>
                                                        <td>{{$member->user->username}}</td>
                                                        <td>{{$member->user->full_name}}</td>
                                                        <td>{{$member->rank->rank_name}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn-add-voucher btn btn-primary btn-block mr-10" type="submit">Tạo Mã
                                        Giảm Giá</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <section class="hk-sec-wrapper boxShadowSmall">
                <h5 class="hk-sec-title">Thống Kê Số Lượng Sử Dụng</h5>
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã Khuyến Mãi</th>
                                            <th>Lượt Sử Dụng</th>
                                            <th>% Giảm</th>
                                            <th>Giá Tối Đa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($vouchers != [])
                                        <p class="d-none">{{$i=1}}</p>
                                        @foreach($vouchers as $voucher)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{$voucher->code}}</td>
                                            <td>
                                                <div class="progress progress-bar-xs mb-0 ">
                                                    <div class="progress-bar progress-bar-danger" style="width: 35%">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$voucher->sale_off*100}} %</td>
                                            <td>{{number_format($voucher->max_price)}} VNĐ</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="odd">
                                            <td valign="top" colspan="5" class="text-center dataTables_empty">Danh sách
                                                khuyến mãi trống</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /Row -->

    <!--Modal Remove Voucher-->
    <div class="modal fade" id="removeVoucher" tabindex="-1" role="dialog" aria-labelledby="removeVoucher"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeVoucher">Xoá Mã Khuyến Mãi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn xoá mã khuyến mãi?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-remove-voucher btn btn-primary">Xoá
                        mã khuyến mãi</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Recover Voucher-->
    <div class="modal fade" id="recoverVoucher" tabindex="-1" role="dialog" aria-labelledby="recoverVoucher"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recoverVoucher">Khôi Phục Mã Khuyến Mãi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn khôi phục mã khuyến mãi?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-recover-voucher btn btn-primary">Khôi phục
                        mã khuyến mãi</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Container -->

<!-- Modal Update Voucher -->
<div class="modal fade" id="updateVoucher" tabindex="-1" role="dialog" aria-labelledby="updateVoucher"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Cập Nhật Mã Khuyến Mãi</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update-voucher-member')}}" method="POST">
                    @csrf
                    <input type="text" hidden="true" name="code" id="inputCodeHidden">
                    <div class="form-group">
                        <label for="inputCode">Mã</label>
                        <input type="text" disabled placeholder="Vui lòng nhập Mã muốn tạo" name="code" id="inputCode"
                            class="form-control">
                    </div>
                    <div class="form-group sale_off">
                        <label for="inputSaleOf">% Giảm</label>
                        <input type="text" id="inputSaleOff" name="sale_off" class="form-control">
                    </div>
                    <div class="form-group max_price">
                        <label for="inputMaxPrice">Giá Trị Tối Đa</label>
                        <input type="text" value="{{number_format(0)}}" name="max_price" id="inputMaxPrice"
                            class="form-control">
                    </div>
                    <div class="form-group max_used">
                        <label for="inputMaxUsed">Lượt Tối Đa</label>
                        <input type="number" min="1" name="max_used" id="inputMaxUsed" class="form-control">
                    </div>
                    <div class="form-group date_start">
                        <label for="inputDateStart">Ngày Bắt Đầu</label>
                        <input type="date" name="date_start" id="inputDateStart" class="form-control datepicker">
                    </div>
                    <div class="form-group date_end">
                        <label for="inputDateEnd">Ngày Kết Thúc</label>
                        <input type="date" name="date_end" id="inputDateEnd" class="form-control datepicker1">
                    </div>
                    <div class="form-group">
                        <button class="btn-update-voucher btn btn-primary btn-block mr-10" type="submit">Cập
                            Nhật</button>
                    </div>
                </form>
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
<script src="{{ asset('vendors4/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('vendors4/jquery-ui.min.js')}}"></script>
<script src="{{ asset('vendors4/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{ asset('dist/js/fullcalendar-data.js')}}"></script>
<script src="{{ asset('vendors4/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('vendors4/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ asset('dist/js/daterangepicker-data.js')}}"></script>
<script src="{{ asset('vendors4/peity/jquery.peity.min.js')}}"></script>
<script src="{{ asset('dist/js/peity-data.js')}}"></script>
<script src="{{ asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
<script src="{{ asset('dist/js/toggle-data.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<script type='text/javascript' src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.min.js"></script>
<script src="{{ asset('dist/js/validation-form.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/voucher.js') }}"></script>
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