@extends('layouts')

@section('title','Trang Chủ')

@section('header')
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- vector map CSS -->
<link href="{{ asset('vendors4/vectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" type="text/css" />

<!-- Toggles CSS -->
<link href="{{ asset('vendors4/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('vendors4/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

<!-- Toastr CSS -->
<link href="{{ asset('vendors4/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">

<!-- Custom CSS -->
<link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('body')
<!-- Container -->
<div class="container mt-xl-50 mt-sm-30 mt-15">
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="hk-row">
                <div class="col-sm-12">
                    <div class="card-group hk-dash-type-2">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-5">
                                    <div>
                                        <span class="d-block font-15 text-dark font-weight-500">Số lượng thành
                                            viên</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block display-4 text-dark mb-5"><span class="counter-anim">
                                            {{$quantity_member}}
                                        </span></span>
                                </div>
                            </div>
                        </div>
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-5">
                                    <div>
                                        <span class="d-block font-15 text-dark font-weight-500">SỐ LƯỢNG HOÁ ĐƠN BÁN
                                            TRONG THÁNG: {{Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('m')}}</span>
                                    </div>
                                    <div>
                                        <span class="text-success font-14 font-weight-500">
                                            @if($total_quantity > 15)
                                            <p>Tăng 22%</p>
                                            @else
                                            <p></p>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block display-4 text-dark mb-5">
                                        {{$total_quantity}}
                                    </span>
                                    <!-- <small class="d-block">Tăng 120 hoá đơn bán</small> -->
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
            <!-- <section class="hk-sec-wrapper">
                <h5 class="hk-sec-title">Biểu đồ thống kê hoá đơn bán</h5>
                <div class="row">
                    <div class="col-sm">
                        <div id="statistics_bill_pays" class="echart" style="height:294px;"></div>
                    </div>
                </div>
            </section> -->
            <section class="hk-sec-wrapper">
                <h6 class="hk-sec-title">Biểu Đồ Thống Kê Sản Phẩm Theo Năm</h6>
                <div class="row">
                    <div class="col-sm">
                        <div id="e_chart_54" class="echart" style="height:294px;"></div>
                    </div>
                </div>
            </section>
            <div class="hk-row">
                <div class="col-xl-12">
                    <section class="hk-sec-wrapper">
                        <h5 class="hk-sec-title">5 Sản Phẩm Được Yêu Thích Nhiều Nhất</h5>
                        <div class="row">
                            <div class="col-sm">
                                <div class="table-wrap">
                                    <table class="table table-hover w-100 display">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Hình Ảnh</th>
                                                <th>Tên Sản Phẩm</th>
                                                <th>Loại Sản Phẩm</th>
                                                <th>Nhà Cung Cấp</th>
                                                <th>Lượt Thích</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($product_hot_favourites==[])
                                            <tr class="odd">
                                                <td valign="top" colspan="6" class="text-center dataTables_empty">Danh
                                                    sách trống</td>
                                            </tr>
                                            @else
                                            <p class="d-none">{{$i=1}}</p>
                                            @foreach($product_hot_favourites as $hot_product)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>
                                                    <img width="140" height="150"
                                                        src="{{env('APP_URL')}}/upload/products/{{$hot_product['product_id']}}/{{$hot_product['product_img']}}"
                                                        alt="{{$hot_product['product_name']}}">
                                                </td>
                                                <td>{{$hot_product['product_name']}}</td>
                                                <td>{{$hot_product['category']['category_name']}}</td>
                                                <td>{{$hot_product['producer']['producer_name']}}</td>
                                                <td>{{$hot_product['quantity_favourites']}}</td>
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
            <div class="hk-row">
                <div class="col-xl-12">
                    <section class="hk-sec-wrapper">
                        <div id="piechart"></div>
                    </section>
                </div>
            </div>
            <div class="card">
                <div class="card-header card-header-action">
                    <h6>Thống Kê Đánh Giá</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-center h-100 justify-content-center text-center">
                                <div>
                                    <div class="d-flex align-items-center  justify-content-center text-dark">
                                        <span
                                            class="counter-anim display-2">{{$rate_of_products['quantityAvgRates']}}</span>
                                        <span class="review-star starred ml-10">
                                            <span class="feather-icon"><i data-feather="star"></i></span>
                                        </span>
                                    </div>
                                    <span class="font-18">Tất cả có {{$rate_of_products['quantityAllRates']}} lượt đánh
                                        giá</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="progress-wrap lb-side-left mt-5">
                                <div class="progress-lb-wrap mb-10">
                                    <label class="progress-label mnw-50p">5.0<i
                                            class="zmdi zmdi-star text-light-20 ml-5"></i></label>
                                    <div class="progress progress-bar-rounded progress-bar-xs">
                                        <div class="progress-bar bg-success w-{{$rate_of_products['arrRateOfNumberStar']['5']['percent']}}"
                                            role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-lb-wrap mb-10">
                                    <label class="progress-label mnw-50p">4.0<i
                                            class="zmdi zmdi-star text-light-20 ml-5"></i></label>
                                    <div class="progress progress-bar-rounded progress-bar-xs">
                                        <div class="progress-bar bg-primary w-{{$rate_of_products['arrRateOfNumberStar']['4']['percent']}}"
                                            role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-lb-wrap mb-10">
                                    <label class="progress-label mnw-50p">3.0<i
                                            class="zmdi zmdi-star text-light-20 ml-5"></i></label>
                                    <div class="progress progress-bar-rounded progress-bar-xs">
                                        <div class="progress-bar bg-warning w-{{$rate_of_products['arrRateOfNumberStar']['3']['percent']}}"
                                            role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-lb-wrap mb-10">
                                    <label class="progress-label mnw-50p">2.0<i
                                            class="zmdi zmdi-star text-light-20 ml-5"></i></label>
                                    <div class="progress progress-bar-rounded progress-bar-xs">
                                        <div class="progress-bar bg-warning w-{{$rate_of_products['arrRateOfNumberStar']['2']['percent']}}"
                                            role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-lb-wrap mb-10">
                                    <label class="progress-label mnw-50p">1.0<i
                                            class="zmdi zmdi-star text-light-20 ml-5"></i></label>
                                    <div class="progress progress-bar-rounded progress-bar-xs">
                                        <div class="progress-bar bg-danger w-{{$rate_of_products['arrRateOfNumberStar']['1']['percent']}}"
                                            role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
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

<!-- /HK Wrapper -->
@section('footer-script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ asset('vendors4/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('vendors4/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{ asset('vendors4/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('dist/js/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
<script src="{{ asset('dist/js/feather.min.js')}}"></script>
<script src="{{ asset('vendors4/echarts/dist/echarts-en.min.js')}}"></script>
<script src="{{ asset('dist/js/barcharts-data.js') }}"></script>
<script src="{{ asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
<script src="{{ asset('dist/js/toggle-data.js')}}"></script>
<script src="{{ asset('vendors4/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{ asset('vendors4/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('vendors4/jquery.sparkline/dist/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('vendors4/vectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script src="{{ asset('vendors4/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{ asset('dist/js/vectormap-data.js')}}"></script>
<script src="{{ asset('vendors4/owl.carousel/dist/owl.carousel.min.js')}}"></script>
<script src="{{ asset('vendors4/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<script src="{{ asset('dist/js/dashboard-data.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/index.js') }}"></script>
@endsection
