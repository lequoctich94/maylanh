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
        <li class="breadcrumb-item active displayFlex" aria-current="page">Hoá Đơn Nhập</li>
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
                                            <i data-feather="database"></i></span></span>Danh Sách Hoá Đơn Nhập</h4>
                            </div>
                            <!-- /Title -->
                            <table id="datable_1"
                                class="display table table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID Hoá Đơn</th>
                                        <th>Kho</th>
                                        <th>Nhà Cung Cấp</th>
                                        <th>Khách Hàng</th>
                                        <th>Số Lượng</th>
                                        <th>Tổng Tiền</th>
                                        <th>Ngày đặt</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($bill_orders != [])
                                    <!-- <p class="d-none"><p class="d-none">{{$i=1}}</p></p> -->
                                    @foreach($bill_orders as $bill_order)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ $bill_order->bill_order_id }}</td>
                                        <td>{{ $bill_order->stock->address }}</td>
                                        <td>{{ $bill_order->producer->producer_name }}</td>
                                        <td>{{ $bill_order->user->full_name }}</td>
                                        <td>{{ $bill_order->amount }}</td>
                                        <td>{{ number_format($bill_order->total_price) }} đ</td>
                                        <td>{{ $bill_order->date_order }}</td>
                                        <td>
                                            <a
                                                href="{{route('bill-order-detail-management',['bill_order_id'=>$bill_order->bill_order_id ])}}">
                                                <span data-toggle="tooltip" data-original-title="Xem Chi Tiết"></span>
                                                <i class="icon-eye text-green"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="9" class="text-center dataTables_empty">Danh sách
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
<script src="{{ asset('vendors4/pdfmake/build/pdfmake.min.js')}}"></script>
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
@endsection
