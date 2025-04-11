@extends('layouts')

@section('title','Thống Kê Thành Viên')

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
        <li class="breadcrumb-item"><a href="javascript:void(0)">Thống Kê</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Thành Viên</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <h5 class="hk-sec-title">Danh Sách Xếp Hạng Thành Viên Có Điểm Cao Nhất</h5>
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table class="table table-hover w-100 display">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình Ảnh</th>
                                        <th>Họ Tên</th>
                                        <th>Ngày Sinh</th>
                                        <th>Mức Điểm</th>
                                        <th>Cấp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($members==[])
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="text-center dataTables_empty">Danh sách
                                            trống</td>
                                    </tr>
                                    @else
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($members as $member)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            <img class="avatar-xl circle" style="width:50px;height:50px"
                                                src="{{env('APP_URL')}}/upload/avatar_users/{{$member->user->image}}">
                                        </td>
                                        <td>{{$member->user->full_name}}</td>
                                        <td>{{ $member->user->birth_day}}</td>
                                        <td>{{$member->current_point}}</td>
                                        <td>{{$member->rank->rank_name}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="tablet-top-member hk-sec-wrapper boxShadowSmall" id="top-member-buy-the-most">
                <h5 class="hk-sec-title">Danh Sách Thành Viên Mua Hàng Nhiều Nhất</h5>
                <!--Form Select Top Member Buy The Most-->
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
                <div id="statistics_of_members_buy_the_most">
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
                                            <a id="head-input-total" class="nav-link delivered text-white">Tổng Số Tiền
                                                Đã
                                                Thanh Toán:
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
                                    <thead id="header-member">
                                        <tr>
                                            <th>STT</th>
                                            <th>Hình Ảnh</th>
                                            <th>Họ Tên</th>
                                            <th>Lượng Đơn</th>
                                            <th>Tổng Tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody id="top-member">
                                        @if($topMembers==[])
                                        <tr class="odd">
                                            <td valign="top" colspan="6" class="text-center dataTables_empty">Danh sách
                                                trống</td>
                                        </tr>
                                        @else
                                        <p class="d-none">{{$i=1}}</p>
                                        @foreach($topMembers as $member)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>
                                                <img class="avatar-xl circle" style="width:50px;height:50px"
                                                    src="{{env('APP_URL')}}/upload/avatar_users/{{$member['user']['image']}}">
                                            </td>
                                            <td>{{$member['user']['full_name']}}</td>
                                            <td>{{$member['quantity_bill']}}</td>
                                            <td>{{number_format($member['total_bill'])}}đ</td>
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
                <div id="piechart"></div>
            </section>
        </div>
    </div>
    <!-- /Row -->
</div>
<!-- /Container -->

@endsection

@section('footer-script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
<script src="{{ asset('vendors4/jquery.sparkline/dist/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('dist/js/sparkline-data.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/statistics_member.js') }}"></script>
@endsection
