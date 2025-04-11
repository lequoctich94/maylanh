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
        <li class="breadcrumb-item"><a href="{{route('index')}}">Quản Lý</a></li>
        <li class="breadcrumb-item displayFlex" aria-current="page"><a href="{{route('voucher-management')}}">Quản Lý Mã
                Khuyến
                Mãi</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">{{$voucher_members[0]->code}}</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <h5 class="hk-sec-title">Danh Sách Khách Hàng Thuộc Mã: {{$voucher_members[0]->code}}</h5>
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1"
                                class="table mb-0 table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID</th>
                                        <th>Họ Tên</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Hạng</th>
                                        <th>Trạng Thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($voucher_members != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($voucher_members as $voucher_member)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$voucher_member->member->member_id}}</td>
                                        <td>{{$voucher_member->member->user->full_name}}</td>
                                        <td>{{$voucher_member->member->user->phone}}</td>
                                        <td>{{$voucher_member->member->rank->rank_name}}</td>
                                        @php
                                        $today_date = Carbon\Carbon::now('Asia/Ho_Chi_Minh');
                                        $start_date =
                                        Carbon\Carbon::createFromFormat('Y-m-d',$voucher_member->voucher->date_start);
                                        $end_date =
                                        Carbon\Carbon::createFromFormat('Y-m-d',$voucher_member->voucher->date_end);
                                        @endphp
                                        <!-- status = 1: có thể sử dụng,  -1 đã sử dụng -->
                                        @if($voucher_member->status==1)
                                        <!-- Kiểm tra voucher đã nằm trong ngày kích hoạt -->
                                        @if($today_date < $start_date) <td><span class="badge badge-info">Chờ kích
                                                hoạt</span></td>
                                            @elseif($today_date >= $start_date && $today_date < $end_date) <td><span
                                                    class="badge badge-success">Đang Hoạt Động</span></td>
                                                @elseif($today_date >= $end_date)
                                                <td><span class="badge badge-warning">Đã hết hạn</span></td>
                                                @endif
                                                @else
                                                <td><span class="badge badge-info">Đã sử dụng</span></td>
                                                @endif
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="text-center dataTables_empty">Danh sách
                                            khuyến mãi trống</td>
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

@endsection

@section('footer-script')
<script src="{{ asset('vendors4/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('vendors4/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{ asset('vendors4/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('dist/js/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('dist/js/feather.min.js')}}"></script>
<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
<script src="{{ asset('vendors4/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script src="{{ asset('dist/js/bootstrap-table-data.html')}}"></script>
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
<script type="text/javascript" src="{{ asset('js/jquery/voucher_member.js') }}"></script>
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
