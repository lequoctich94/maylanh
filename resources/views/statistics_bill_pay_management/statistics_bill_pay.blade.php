@extends('layouts')

@section('title','Thống Kê Hoá Đơn Bán')

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
        <li class="breadcrumb-item"><a href="javascript:void(0)">Thống kê</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Hoá Đơn Bán</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container mt-xl-50 mt-sm-30 mt-15">
    <!-- Title -->
    <div class="hk-pg-header align-items-top">
        <div>
            <h2 class="hk-pg-title font-weight-600 mb-10">Thống Kê Hoá Đơn Bán</h2>
        </div>
    </div>
    <!-- /Title -->

    <div class="row mb-5">
        <div class="col-xl-12">
            <div class="hk-row">
                <div class="col-sm-12">
                    <div class="card-group hk-dash-type-2">
                        <div class="card card-sm">
                            <div class="card-body boxShadowSmall">
                                <div class="d-flex justify-content-between mb-5">
                                    <div>
                                        <span class="d-block font-15 text-dark font-weight-500">SỐ LƯỢNG HOÁ ĐƠN BÁN
                                            TRONG THÁNG: {{Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('m')}}</span>
                                    </div>
                                    <div>
                                        <span class="text-success font-14 font-weight-500">
                                            @if(count($total_quantity) > '15')
                                            <p>Tăng 22%</p>
                                            @else
                                            <p></p>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block display-4 text-dark mb-5">
                                        @if($total_quantity)
                                        <p>{{count($total_quantity)}}</p>
                                        @else
                                        <p>Không có hoá đơn</p>
                                        @endif
                                    </span>
                                    <!-- <small class="d-block">Tăng 120 hoá đơn bán</small> -->
                                </div>
                            </div>
                        </div>
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-5">
                                    <div>
                                        <span class="d-block font-15 text-dark font-weight-500">Sản phẩm bán chạy
                                            nhất tháng</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block display-4 text-dark mb-5"><span class="counter-anim"
                                            style="font-size:35px;">
                                            @if($top_product->isNotEmpty())
                                            {{ $top_product[0]->product_name }}
                                            @else
                                            <p>Không có sản phẩm</p>
                                            @endif
                                        </span></span>
                                    <!-- <small class="d-block">Bán được 1200 sản phẩm / 1000 đơn</small> -->
                                </div>
                            </div>
                        </div>
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-5">
                                    <div>
                                        <span class="d-block font-15 text-dark font-weight-500">Tổng doanh thu hoá đơn
                                            tháng này</span>
                                    </div>
                                    <div>
                                        <span class="text-warning font-14 font-weight-500">
                                            @if($total_price > "3000000")
                                            <p>Tăng 24%</p>
                                            @else
                                            <p></p>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block display-4 text-dark mb-5">
                                        {{ number_format($total_price) }} VNĐ
                                    </span>
                                    @if($total_price > "3000000")
                                    <small class="d-block">Tăng {{ number_format($total_price - $total_price*0.24) }}VNĐ
                                        với tháng trước</small>
                                    @else
                                    <small class="d-block">Doanh thu ở mức trung bình</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!-- Bar Chart Start -->
    <div class="container">
        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon">
                        <i data-feather="bar-chart"></i></span></span>Biểu đồ thống kê</h4>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="boxShadowSmall card row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <!-- <div class="hk-sec-title mb-40">
                        <h6>Thống kê biểu đồ theo tiêu chí</h6>
                    </div>
                    <div class="form-filter-chart row mb-20">
                        <form action="" autocomplete="off" class="d-flex">
                            <label class="p-3">Lọc theo tiêu chí</label>
                            <div class="form-group row-xl-6 ml-40"
                                style="display:flex;flex-direction:row;align-items:center">
                                <select class="form-control mr-30 w-200p" id="billChartMonth" class="billChartMonth">
                                    <option selected value="{{ date('m') }}">Tháng {{ date('m') }}</option>
                                    <option value="01">Tháng 01</option>
                                    <option value="02">Tháng 02</option>
                                    <option value="03">Tháng 03</option>
                                    <option value="04">Tháng 04</option>
                                    <option value="05">Tháng 05</option>
                                    <option value="06">Tháng 06</option>
                                    <option value="07">Tháng 07</option>
                                    <option value="08">Tháng 08</option>
                                    <option value="09">Tháng 09</option>
                                    <option value="10">Tháng 10</option>
                                    <option value="11">Tháng 11</option>
                                    <option value="12">Tháng 12</option>
                                </select>
                                <br>
                                <select name="year" class="form-control mr-30 w-200p" id="billChartYear"
                                    class="billChartYear">
                                    <option selected value="{{  date('Y')  }}">Năm {{ date('Y') }}</option>
                                    @for ($year = date('Y'); $year > date('Y') - 50; $year--)
                                    <option value="{{$year}}">
                                        Năm {{$year}}
                                    </option>
                                    @endfor
                                </select>
                                <button type="button" id="btn-filter-bill-chart"
                                    class="btn btn btn-primary btn-sm w-100 h-80">Lọc
                                    kết quả</button>
                            </div>
                        </form>
                    </div>  -->
                    <h5 class="hk-sec-title">Biểu đồ thống kê hoá đơn bán</h5>
                    <div class="row">
                        <div class="col-sm">
                            <div id="statistics_bill_pays" class="echart" style="height:294px;"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- Bar Chart End -->
    <br>

    <!--Form Select Statistisc Bill Pay Management-->
    <div class="card boxShadowSmall">
        <div class="card-header-action p-3 mb-3">
            <h6>Thống kê theo tiêu chí</h6>
        </div>
        <div class="row form-filter p-3 col-xl-12">
            <form action="" autocomplete="off" class="d-flex w-600p">
                <div class="form-group col-xl-6 ml-20" style="margin-right:350px;">
                    <div id="date_start">
                        <label for="inputDateStart">Từ ngày</label>
                        <input type="date" name="date_start" value="{{ $date_time }}" id="inputDateStart"
                            class="form-control">
                    </div>
                    <br />
                    <div id="date_end">
                        <label for="inputDateEnd">Đến Ngày</label>
                        <input type="date" name="date_end" value="{{ $date_time }}" id="inputDateEnd"
                            class="form-control">
                    </div>
                    <button type="button" id="btn-filter-date" class="btn btn btn-primary btn-sm mt-3">Lọc kết
                        quả</button>
                </div>
                <div class="form-group col-xl-6 ml-80">
                    <label>Lọc theo tiêu chí</label>
                    <select class="form-control" id="billWeek">
                        <option class="text-center" selected
                            value="{{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->weekOfMonth }}">Tuần
                            {{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->weekOfMonth }}</option>
                        <option value="1">Tuần 1</option>
                        <option value="2">Tuần 2</option>
                        <option value="3">Tuần 3</option>
                        <option value="4">Tuần 4</option>
                    </select>
                    <br>
                    <select class="form-control" id="billMonth">
                        <option class="text-center" selected value="{{ date('m') }}">Tháng {{ date('m') }}</option>
                        <option value="01">Tháng 1</option>
                        <option value="02">Tháng 2</option>
                        <option value="03">Tháng 3</option>
                        <option value="04">Tháng 4</option>
                        <option value="05">Tháng 5</option>
                        <option value="06">Tháng 6</option>
                        <option value="07">Tháng 7</option>
                        <option value="08">Tháng 8</option>
                        <option value="09">Tháng 9</option>
                        <option value="10">Tháng 10</option>
                        <option value="11">Tháng 11</option>
                        <option value="12">Tháng 12</option>
                    </select>
                    <br>
                    <select name="year" class="form-control" id="billYear">
                        <option class="text-center" selected value="{{  date('Y')  }}">Năm {{ date('Y') }}</option>
                        @for ($year = date('Y'); $year > date('Y') - 50; $year--)
                        <option value="{{$year}}">
                            Năm {{$year}}
                        </option>
                        @endfor
                    </select>
                    <button type="button" id="btn-filter-cycle" class="btn btn btn-primary btn-sm mt-3">Lọc kết
                        quả</button>
                </div>
            </form>
        </div>

        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <section class="hk-sec-wrapper" id="all-bill-pay-in-month">
                        <div class="row">
                            <div class="col-sm">
                                <div class="table-wrap">
                                    <!-- Title -->
                                    <div class="hk-pg-header">
                                        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon">
                                                    <i data-feather="database"></i></span></span>Danh Sách Hoá Đơn Đã
                                            Bán
                                            Được Trong Tháng</h4>
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
                                                        <li id="delivered" class="nav-item">
                                                            <a id="head-input-total"
                                                                class="nav-link delivered text-white">Tổng Số Tiền Đã
                                                                Thanh Toán:
                                                                <span id="inputTotal">{{number_format($total)}}đ</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                    <!-- /Title -->
                                    <table class="display table table-striped table-bordered hover w-100 display pb-30">
                                        <thead class="title-bill">
                                            <tr>
                                                <th>STT</th>
                                                <th>ID Hoá Đơn</th>
                                                <th>Khách Hàng</th>
                                                <th>Ngày Mua</th>
                                                <th>Số Điện Thoại</th>
                                                <th>Tổng Tiền</th>
                                                <th>Số Lượng</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="body-bill">
                                            @if($bill_pay_month==[])
                                            <tr class="odd">
                                                <td valign="top" colspan="8" class="text-center dataTables_empty">Danh
                                                    sách trống</td>
                                            </tr>
                                            @else
                                            <p class="d-none">{{$i=1}}</p>
                                            @foreach($bill_pay_month as $bill_pay)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{ $bill_pay->bill_id }}</td>
                                                <td>{{ $bill_pay->member->user->full_name }}</td>
                                                <td>{{ $bill_pay->date_order }}</td>
                                                <td>{{ $bill_pay->member->user->phone}}</td>
                                                <td>{{ number_format($bill_pay->total_price) }}đ</td>
                                                <td>{{ $bill_pay->total_quantity }}</td>
                                                <td>
                                                    <a class="mr-25"
                                                        href="{{route('bill-pay-detail-management',['bill_id'=>$bill_pay->bill_id ])}}"
                                                        data-toggle="tooltip" data-original-title="Xem Chi Tiết"><i
                                                            class="icon-eye text-green"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
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
        <br>
    </div>

    <br>
    <!-- Row -->
    <div class="row mt-5">
        <div class="col-xl-12">
            <div class="hk-row">
                <div class="col-sm-12">
                    <div class="card boxShadowSmall">
                        <div class="card-header card-header-action">
                            <h6>Hoá Đơn Bán Theo Trạng Thái</h6>
                        </div>
                        <div class="card-body pa-0">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Trạng Thái</th>
                                                <th class="w-40">Đợt Trước</th>
                                                <th class="w-25">Đợt Sau</th>
                                                <th>Trend</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Đơn Hàng Giao Thành Công</td>
                                                <td>
                                                    <div class="progress-wrap lb-side-left mnw-125p">
                                                        <div class="progress-lb-wrap">
                                                            <label class="progress-label mnw-50p">30.000</label>
                                                            <div class="progress progress-bar-rounded progress-bar-xs">
                                                                <div class="progress-bar bg-primary w-70"
                                                                    role="progressbar" aria-valuenow="70"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>43.000</td>
                                                <td>
                                                    <div id="sparkline_1">Khuyến Mãi Tết</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Đơn Hàng Bị Huỷ</td>
                                                <td>
                                                    <div class="progress-wrap lb-side-left mnw-125p">
                                                        <div class="progress-lb-wrap">
                                                            <label class="progress-label mnw-50p">3.000</label>
                                                            <div class="progress progress-bar-rounded progress-bar-xs">
                                                                <div class="progress-bar bg-success w-70"
                                                                    role="progressbar" aria-valuenow="70"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>12.000</td>
                                                <td>
                                                    <div id="sparkline_2">Dịch Covid 19</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Đánh giá 5 sao</td>
                                                <td>
                                                    <div class="progress-wrap lb-side-left mnw-125p">
                                                        <div class="progress-lb-wrap">
                                                            <label class="progress-label mnw-50p">22.000</label>
                                                            <div class="progress progress-bar-rounded progress-bar-xs">
                                                                <div class="progress-bar bg-warning w-60"
                                                                    role="progressbar" aria-valuenow="70"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>28.000</td>
                                                <td>
                                                    <div id="sparkline_3">Sản Phẩm Gói Kỹ</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Đơn Hàng Đã Từ Chối</td>
                                                <td>
                                                    <div class="progress-wrap lb-side-left mnw-125p">
                                                        <div class="progress-lb-wrap">
                                                            <label class="progress-label mnw-50p">600</label>
                                                            <div class="progress progress-bar-rounded progress-bar-xs">
                                                                <div class="progress-bar bg-danger w-55"
                                                                    role="progressbar" aria-valuenow="70"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>1.200</td>
                                                <td>
                                                    <div id="sparkline_4">Không Phù Hợp</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
</div>
<!-- /Container -->

@endsection

<!-- /HK Wrapper  -->
@section('footer-script')
<script src="{{ asset('vendors4/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('vendors4/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{ asset('vendors4/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
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
<script src="{{ asset('vendors4/echarts/dist/echarts-en.min.js') }}"></script>
<script src="{{ asset('dist/js/barcharts-data.js') }}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/statistics_bill_pay.js') }}"></script>
@endsection
