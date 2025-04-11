@extends('layouts')

@section('title','Thống kê sản phẩm')

@section('header')
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Data Table CSS -->
<link href="{{ asset('vendors4/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors4/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet"
    type="text/css" />

<!-- Tablesaw table CSS -->
<link href="{{ asset('vendors4/tablesaw/dist/tablesaw.css')}}" rel="stylesheet" type="text/css" />

<!-- Toggles CSS -->
<link href="{{ asset('vendors4/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('vendors4/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

<!-- Custom CSS -->
<link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('body')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Thống Kê</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Sản Phẩm</li>
    </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall" id="best-seller">
                <h5 class="hk-sec-title">5 SẢN PHẨM CÓ DOANH THU CAO NHẤT</h5>
                <!--Form Select Top 5 Best Seller-->
                <div class="card">
                    <div class="card-header-action p-3 mb-3">
                        <h6>Thống kê theo tiêu chí</h6>
                    </div>
                    <div class="row form-filter p-3 col-xl-12">
                        <form action="" autocomplete="off" class="d-flex w-600p">
                            <div class="form-group col-xl-6 ml-20" style="margin-right:350px;">
                                <div id="date_start">
                                    <label for="inputDateStart">Từ ngày</label>
                                    <input type="date" name="date_start" value="{{ $dateNow }}" id="inputDateStart"
                                        class="form-control">
                                </div>
                                <br />
                                <div id="date_end">
                                    <label for="inputDateEnd">Đến Ngày</label>
                                    <input type="date" name="date_end" value="{{ $dateNow }}" id="inputDateEnd"
                                        class="form-control">
                                </div>
                                <button type="button" id="btn-filter-date" class="btn btn btn-primary btn-sm mt-3">Lọc
                                    kết quả</button>
                            </div>
                            <div class="form-group col-xl-6 ml-80">
                                <label>Lọc theo tiêu chí</label>
                                <select class="form-control" id="week-selected">
                                    <option class="text-center" selected
                                        value="{{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->weekOfMonth }}">Tuần
                                        {{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->weekOfMonth }}</option>
                                    <option value="1">Tuần 1</option>
                                    <option value="2">Tuần 2</option>
                                    <option value="3">Tuần 3</option>
                                    <option value="4">Tuần 4</option>
                                </select>
                                <br>
                                <select class="form-control" id="month-selected">
                                    <option class="text-center" selected value="{{ date('m') }}">Tháng {{ date('m') }}
                                    </option>
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
                                <select name="year" class="form-control" id="year-selected">
                                    <option class="text-center" selected value="{{  date('Y')  }}">Năm {{ date('Y') }}
                                    </option>
                                    @for ($year = date('Y'); $year > date('Y') - 50; $year--)
                                    <option value="{{$year}}">
                                        Năm {{$year}}
                                    </option>
                                    @endfor
                                </select>
                                <button type="button" id="btn-filter-cycle" class="btn btn btn-primary btn-sm mt-3">Lọc
                                    kết quả</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="statistics_product_width_the_highest_total_sales">
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
                                            <a id="head-input-total" class="nav-link delivered text-white">Tổng Doanh
                                                Thu:
                                                <span id="inputTotal">{{number_format($total)}}đ</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <table class="table table-hover w-100 display">
                                    <thead id="header-product">
                                        <tr>
                                            <th>STT</th>
                                            <th>Hình Ảnh</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Loại Sản Phẩm</th>
                                            <th>Nhà Cung Cấp</th>
                                            <th>Đã Bán</th>
                                            <th>Doanh Thu</th>
                                        </tr>
                                    </thead>
                                    <tbody id="top-product">
                                        @if($statistics_products==[])
                                        <tr class="odd">
                                            <td valign="top" colspan="7" class="text-center dataTables_empty">Danh sách
                                                trống</td>
                                        </tr>
                                        @else
                                        <p class="d-none">{{$i=1}}</p>
                                        @foreach($statistics_products as $statistics_product)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>
                                                <img width="140" height="150"
                                                    src="{{env('APP_URL')}}/upload/products/{{$statistics_product['product_id']}}/{{$statistics_product['product_img']}}"
                                                    alt="{{$statistics_product['product_name']}}">
                                            </td>
                                            <td>{{$statistics_product['product_name']}}</td>
                                            <td>{{$statistics_product['category']['category_name']}}</td>
                                            <td>{{$statistics_product['producer']['producer_name']}}</td>
                                            <td>{{$statistics_product['quantity_sells']}}</td>
                                            <td>{{number_format($statistics_product['total_sells'])}}đ</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="hk-sec-wrapper boxShadowSmall">
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
                                        <td valign="top" colspan="6" class="text-center dataTables_empty">Danh sách
                                            trống</td>
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
            <section class="hk-sec-wrapper boxShadowSmall" id="hot-rate">
                <h5 class="hk-sec-title">5 Sản Phẩm Có Số Lượt Đánh Giá Nhiều Nhất</h5>
                <!--Form Select Top 5 Product Hot Rate-->
                <div class="card">
                    <div class="card-header-action p-3 mb-3">
                        <h6>Thống kê theo tiêu chí</h6>
                    </div>
                    <div class="row form-filter p-3 col-xl-12">
                        <form action="" autocomplete="off" class="d-flex w-600p">
                            <div class="form-group col-xl-6 ml-20" style="margin-right:350px;">
                                <div id="date_start">
                                    <label for="inputDateStart">Từ ngày</label>
                                    <input type="date" name="date_start" value="{{ $dateNow }}" id="inputDateStart"
                                        class="form-control">
                                </div>
                                <br />
                                <div id="date_end">
                                    <label for="inputDateEnd">Đến Ngày</label>
                                    <input type="date" name="date_end" value="{{ $dateNow }}" id="inputDateEnd"
                                        class="form-control">
                                </div>
                                <button type="button" id="btn-filter-date" class="btn btn btn-primary btn-sm mt-3">Lọc
                                    kết quả</button>
                            </div>
                            <div class="form-group col-xl-6 ml-80">
                                <label>Lọc theo tiêu chí</label>
                                <select class="form-control" id="week-selected">
                                    <option class="text-center" selected
                                        value="{{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->weekOfMonth }}">Tuần
                                        {{ Carbon\Carbon::now('Asia/Ho_Chi_Minh')->weekOfMonth }}</option>
                                    <option value="1">Tuần 1</option>
                                    <option value="2">Tuần 2</option>
                                    <option value="3">Tuần 3</option>
                                    <option value="4">Tuần 4</option>
                                </select>
                                <br>
                                <select class="form-control" id="month-selected">
                                    <option class="text-center" selected value="{{ date('m') }}">Tháng {{ date('m') }}
                                    </option>
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
                                <select name="year" class="form-control" id="year-selected">
                                    <option class="text-center" selected value="{{  date('Y')  }}">Năm {{ date('Y') }}
                                    </option>
                                    @for ($year = date('Y'); $year > date('Y') - 50; $year--)
                                    <option value="{{$year}}">
                                        Năm {{$year}}
                                    </option>
                                    @endfor
                                </select>
                                <button type="button" id="btn-filter-cycle" class="btn btn btn-primary btn-sm mt-3">Lọc
                                    kết quả</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="statistics_of_product_with_the_most_review" class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table class="table table-hover w-100 display">
                                <thead id="header-hot-rate">
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình Ảnh</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Loại Sản Phẩm</th>
                                        <th>Nhà Cung Cấp</th>
                                        <th>Lượt Đánh Giá</th>
                                    </tr>
                                </thead>
                                <tbody id="body-hot-rate">
                                    @if($product_hot_rates==[])
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="text-center dataTables_empty">Danh sách
                                            trống</td>
                                    </tr>
                                    @else
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($product_hot_rates as $product_hot_rate)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            <img width="140" height="150"
                                                src="{{env('APP_URL')}}/upload/products/{{$product_hot_rate['product_id']}}/{{$product_hot_rate['product_img']}}"
                                                alt="{{$product_hot_rate['product_name']}}">
                                        </td>
                                        <td>{{$product_hot_rate['product_name']}}</td>
                                        <td>{{$product_hot_rate['category']['category_name']}}</td>
                                        <td>{{$product_hot_rate['producer']['producer_name']}}</td>
                                        <td>{{$product_hot_rate['quantity_rates']}}</td>
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
    <section class="hk-sec-wrapper boxShadowSmall">
        <h6 class="hk-sec-title">Biểu Đồ Thống Kê Sản Phẩm Theo Năm</h6>
        <div class="row">
            <div class="col-sm">
                <div id="e_chart_54" class="echart" style="height:294px;"></div>
            </div>
        </div>
    </section>
    <div class="card boxShadowSmall">
        <div class="card-header card-header-action">
            <h6>Thống Kê Đánh Giá</h6>
            <!-- <div class="d-flex align-items-center card-action-wrap">
                <button class="btn btn-secondary btn-sm">Thống Kê Đánh Giá</button>
            </div> -->
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <div class="d-flex align-items-center h-100 justify-content-center text-center">
                        <div>
                            <div class="d-flex align-items-center  justify-content-center text-dark">
                                <span class="counter-anim display-2">{{$rate_of_products['quantityAvgRates']}}</span>
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
                                    role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="progress-lb-wrap mb-10">
                            <label class="progress-label mnw-50p">4.0<i
                                    class="zmdi zmdi-star text-light-20 ml-5"></i></label>
                            <div class="progress progress-bar-rounded progress-bar-xs">
                                <div class="progress-bar bg-primary w-{{$rate_of_products['arrRateOfNumberStar']['4']['percent']}}"
                                    role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="progress-lb-wrap mb-10">
                            <label class="progress-label mnw-50p">3.0<i
                                    class="zmdi zmdi-star text-light-20 ml-5"></i></label>
                            <div class="progress progress-bar-rounded progress-bar-xs">
                                <div class="progress-bar bg-warning w-{{$rate_of_products['arrRateOfNumberStar']['3']['percent']}}"
                                    role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="progress-lb-wrap mb-10">
                            <label class="progress-label mnw-50p">2.0<i
                                    class="zmdi zmdi-star text-light-20 ml-5"></i></label>
                            <div class="progress progress-bar-rounded progress-bar-xs">
                                <div class="progress-bar bg-warning w-{{$rate_of_products['arrRateOfNumberStar']['2']['percent']}}"
                                    role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="progress-lb-wrap mb-10">
                            <label class="progress-label mnw-50p">1.0<i
                                    class="zmdi zmdi-star text-light-20 ml-5"></i></label>
                            <div class="progress progress-bar-rounded progress-bar-xs">
                                <div class="progress-bar bg-danger w-{{$rate_of_products['arrRateOfNumberStar']['1']['percent']}}"
                                    role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
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
<script src="{{ asset('vendors4/echarts/dist/echarts-en.min.js')}}"></script>
<script src="{{ asset('dist/js/barcharts-data.js')}}"></script>
<script src="{{ asset('vendors4/tablesaw/dist/tablesaw.jquery.js')}}"></script>
<script src="{{ asset('dist/js/tablesaw-data.js')}}"></script>
<script src="{{ asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
<script src="{{ asset('dist/js/toggle-data.js')}}"></script>
<script src="{{ asset('vendors4/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{ asset('vendors4/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/statistics_product.js') }}"></script>
@endsection
