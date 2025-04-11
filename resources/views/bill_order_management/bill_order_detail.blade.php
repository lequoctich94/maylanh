@extends('layouts')

@section('title','Chi Tiết Hoá Đơn Bán')

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
        <li class="breadcrumb-item">Quản Lý</li>
        <li class="breadcrumb-item displayFlex"><a href="{{ route('bill-order-management') }}">Hoá Đơn Nhập</a></li>
        <li class="breadcrumb-item displayFlex" aria-current="page">Chi Tiết Hoá Đơn Nhập</li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">
            {{$bill_order_details[0]->bill_order->bill_order_id}}
        </li>
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
                                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                                                data-feather="database"></i></span></span>Danh Sách Chi Tiết Hoá Đơn
                                    Nhập
                                </h4>
                            </div>
                            <!-- /Title -->
                            <table id="datable_1"
                                class="display table table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình Ảnh</th>
                                        <th>ID Sản Phẩm</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Số Lượng</th>
                                        <th>Giá Nhập</th>
                                        <th>Giá Bán</th>
                                        <th>Tổng Tiền Nhập</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($bill_order_details != [])
                                    <p class="d-none">
                                    <p class="d-none">{{$i=1}}</p>
                                    </p>
                                    @foreach($bill_order_details as $bill_order_detail)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <img width="80" height="80"
                                                src="{{env('APP_URL')}}/upload/products/{{ $bill_order_detail->product_detail->product->product_id}}/{{$bill_order_detail->product_detail->product->product_img}}"
                                                alt="{{ $bill_order_detail->product_detail->product->product_img}}">
                                        </td>
                                        <td>{{ $bill_order_detail->product_detail->product_id}}</td>
                                        <td>{{ $bill_order_detail->product_detail->product->product_name}}
                                            {{$bill_order_detail->product_detail->color->color_name}}
                                            {{$bill_order_detail->product_detail->size->size_name}}
                                        </td>
                                        <td>{{ $bill_order_detail->quantity}}</td>
                                        <td>{{ number_format($bill_order_detail->price_order)}}đ</td>
                                        <td>{{ number_format($bill_order_detail->price_pay)}}đ</td>
                                        <td>{{ number_format($bill_order_detail->total_price)}}đ</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="8" class="text-center dataTables_empty">Danh sách
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
