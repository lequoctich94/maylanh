@extends('user/layouts')

@section('title','Mã khuyến mãi của tôi')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />

<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Mã khuyến mãi của tôi" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/profile.css') }}">
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/voucher.css') }}">
@endsection

@section('body')
<div class="main">
    <div class="container">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="container bootstrap snippets bootdey">
            <div class="row">
                <div class="profile-nav col-md-3">
                    <div class="panel">
                        <div class="user-heading round">
                            <div id="user-heading">
                                <a href="#">
                                    <img src="{{env('APP_URL')}}/upload/avatar_users/{{$member->user->image}}" alt="">
                                </a>
                                <h1>{{$member->user->full_name}}</h1>
                                <p>{{$member->user->email}}</p>
                            </div>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="{{ route('user/profile') }}"> <i class="fa fa-user"></i>Thông
                                    tin cá nhân</a></li>
                            <li><a href="{{ route('user/change-profile') }}"> <i class="fa fa-edit"></i> Chỉnh sửa thông
                                    tin cá nhân</a></li>
                            <li><a href="{{ route('user/change-password') }}"> <i class="fa fa-edit"></i> Cập nhật mật
                                    khẩu</a></li>
                            <li><a href="{{ route('user/rate') }}"><i class='fa fa-star-o'></i>Đánh giá
                                    của tôi</a></li>
                            <li class="active"><a href="javascript:void(0)"><i class='fa fa-eraser'></i>Mã khuyến
                                    mãi</a></li>
                            <li><a href="{{ route('user/favourite') }}"><i class='fa fa-heart-o'></i>Danh sách yêu
                                    thích</a></li>
                            <li><a href="{{ route('user/activity-history') }}"><i class='fa fa-history'></i>Lịch sử hoạt
                                    động</a></li>
                            <li><a href="{{ route('user/rank') }}"><i class='fa fa-history'></i>Điểm hạng thành
                                    viên</a></li>
                            <li><a href="{{ route('user/purchase-history') }}"><i class='fa fa-list-alt'></i>Đơn
                                    mua</a></li>
                        </ul>
                    </div>
                </div>
                <div class="profile-info col-md-9">
                    <div class="panel">
                        <div class="bio-graph-heading"></div>
                        <div class="panel-body bio-graph-info">
                            <h1>Thông tin mã khuyến mãi</h1>
                            @if(empty($voucherMembers))
                            <p class="empty-profile">Danh sách trống, hiện không có mã khuyến mãi nào</p>
                            @else
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="voucher">
                                        <h4 class="voucher-heading">DANH SÁCH MÃ KHUYẾN MÃI</h4>
                                        <div class="voucher-border voucher-container">
                                            @foreach($voucherMembers as $voucherMember)
                                            <div class="voucher-body">
                                                <div class="voucher-body-img">
                                                    <img src="{{ asset('user/static.ptpstore/PTPSTOREV2/images/voucher.jpg') }}"
                                                        alt="voucher-images">
                                                </div>
                                                <div class="voucher-body-content">
                                                    <div class="voucher-body-contentTitle">
                                                        {{$voucherMember->code}}
                                                    </div>
                                                    <div class="voucher-body-contentDesc">
                                                        Khuyến mãi {{$voucherMember->voucher->sale_off * 100}}% tối đa
                                                        {{number_format($voucherMember->voucher->max_price)}} VNĐ
                                                    </div>
                                                    <div class="voucher-body-contentDate">
                                                        HSD đến ngày: {{$voucherMember->voucher->date_end}}
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".vertical-menu-content").addClass("no-home");
    $(document).ready(function () {
        //$(".menu-quick-select ul").hide();
        //$(".menu-quick-select").hover(function () { $(".menu-quick-select ul").show(); }, function () { $(".menu-quick-select ul").hide(); });
    });
</script>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".header-content").css({
        "background": ''
    });
    $("html").addClass('');
</script>
@endsection
