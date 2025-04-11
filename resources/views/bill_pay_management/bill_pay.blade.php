@extends('layouts')

@section('title','Hoá Đơn Bán')

@section('header')
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Data Table CSS -->
<link href="{{ asset('vendors4/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors4/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet"
    type="text/css" />

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
        <li class="breadcrumb-item active displayFlex" aria-current="page">Hoá Đơn Bán</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <!-- Title -->
                            <div class="hk-pg-header">
                                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon">
                                            <i data-feather="database"></i></span></span>Danh Sách Hoá Đơn Bán</h4>
                            </div>
                            <div class="row mb-30">
                                <div class="col-sm">
                                    <nav class="navbar navbar-expand-xl navbar-dark bg-dark navbar-demo" style="border-radius:5px;    background: rgb(63, 151, 119);
                                                background: linear-gradient(
                                                    330deg,
                                                    rgb(89, 182, 205) 56%,
                                                    rgb(38, 177, 205) 100%
                                                );">
                                        <div class="collapse navbar-collapse" id="navbarSupportedColor1">
                                            <ul class="navbar-nav">
                                                <li id="waiting" class="nav-item active">
                                                    <a class="nav-link waiting_confirm" href="javaScript:void(0)">Chờ
                                                        Duyệt</a>
                                                </li>
                                                <li id="ready" class="nav-item">
                                                    <a class="nav-link ready_delivery" href="javaScript:void(0)">Chuẩn
                                                        Bị Đơn</a>
                                                </li>
                                                <li id="pending" class="nav-item">
                                                    <a class="nav-link pending_delivery" href="javaScript:void(0)">Đang
                                                        Giao</a>
                                                </li>
                                                <li id="delivered" class="nav-item">
                                                    <a class="nav-link delivered" href="javaScript:void(0)">Đã Giao</a>
                                                </li>
                                                <li id="cancelled" class="nav-item">
                                                    <a class="nav-link cancelled" href="javaScript:void(0)">Đã Huỷ</a>
                                                </li>
                                                <li id="refused" class="nav-item">
                                                    <a class="nav-link refused" href="javaScript:void(0)">Đã Từ Chối</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>

                            <!-- /Title -->
                            <table
                                class="table-responsive display table table-striped table-bordered hover w-100 display pb-30">
                                <thead class="title-bill">
                                    <tr>
                                        <th>STT</th>
                                        <th>ID</th>
                                        <th>Khách Hàng</th>
                                        <th>Ngày Đặt Hàng</th>
                                        <th>Ngày Duyệt</th>
                                        <th>Ngày Lấy Hàng</th>
                                        <th>Ngày Nhận</th>
                                        <th>Ngày Huỷ</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Tổng Tiền</th>
                                        <th>SL</th>
                                        <th>Trạng Thái</th>
                                        <th class="reasons d-none">Lý do</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="body-bill">
                                    @if($bill_pays != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($bill_pays as $bill_pay)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ $bill_pay->bill_id }}</td>
                                        <td>{{ $bill_pay->member->user->full_name }}</td>
                                        <td>{{ $bill_pay->date_order }}</td>
                                        @if($bill_pay->status==2)
                                        <td>{{ $bill_pay->date_confirm }}</td>
                                        @else
                                        <td>Chưa Duyệt</td>
                                        @endif
                                        @if($bill_pay->status==0)
                                        <td>{{ $bill_pay->date_delivery }}</td>
                                        @else
                                        <td>Chưa Lấy Hàng</td>
                                        @endif
                                        @if($bill_pay->status==1)
                                        <td>{{ $bill_pay->date_receipt }}</td>
                                        @else
                                        <td>Chưa Giao</td>
                                        @endif
                                        @if($bill_pay->status==-2 || $bill_pay->status==4)
                                        <td>{{ $bill_pay->date_cancel }}</td>
                                        @else
                                        <td>Chưa Huỷ</td>
                                        @endif
                                        <td>{{ $bill_pay->member->user->phone}}</td>
                                        <td>{{ number_format($bill_pay->total_price) }}đ</td>
                                        <td>{{ $bill_pay->total_quantity }}</td>
                                        @if($bill_pay->status== 0)
                                        <td><span class="badge badge-info">Đang Giao</span></td>
                                        @elseif($bill_pay->status==1)
                                        <td><span class="badge badge-info">Đã Giao</span></td>
                                        @elseif($bill_pay->status==2)
                                        <td><span class="badge badge-info">Đang C.Bị Đơn</span></td>
                                        @elseif($bill_pay->status==-1)
                                        <td><span class="badge badge-info">Chờ Duyệt</span></td>
                                        @elseif($bill_pay->status==-2)
                                        <td><span class="badge badge-danger">Đã Huỷ</span></td>
                                        @elseif($bill_pay->status== -4)
                                        <td><span class="badge badge-danger">Đã T.Chối</span></td>
                                        @endif
                                        <td>
                                            <a class="marginRight"
                                                href="{{route('bill-pay-detail-management',['bill_id'=>$bill_pay->bill_id ])}}"><span>
                                                    <i data-toggle="tooltip" data-original-title="Xem Chi Tiết hoá đơn"
                                                        class="icon-eye text-green"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="13" class="text-center dataTables_empty">Danh sách
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


</div>
<!-- /Container -->

@endsection

<!-- /HK Wrapper  -->
@section('footer-script')
<script src="{{ asset('vendors4/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('vendors4/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{ asset('vendors4/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('dist/js/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('vendors4/jszip/dist/jszip.min.js')}}"></script>
<script src="{{ asset('vendors4/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('dist/js/dataTables-data.js')}}"></script>
<script src="{{ asset('dist/js/feather.min.js')}}"></script>
<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
<script src="{{ asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
<script src="{{ asset('dist/js/toggle-data.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/bill_pay.js') }}"></script>
@endsection
