@extends('user/layouts')

@section('title','Cập nhật mật khẩu')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />

<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Cập nhật mật khẩu" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/profile.css') }}">
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
                            <li class="active"><a href="javascript:void(0)"> <i class="fa fa-edit"></i>
                                    Cập nhật mật
                                    khẩu</a></li>
                            <li><a href="{{ route('user/rate') }}"><i class='fa fa-star-o'></i>Đánh giá
                                    của tôi</a></li>
                            <li><a href="{{ route('user/voucher') }}"><i class='fa fa-eraser'></i>Mã khuyến
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
                    <div class="bio-graph-heading"></div>
                    <div class="panel">
                        <div class="panel-body bio-graph-info">
                            <h1>Thông tin cập nhật mật khẩu</h1>
                            <input hidden value="{{$member->user->username}}" name="username">
                            <div class="form-body-item">
                                <div class="form-group">
                                    <label for="">Mật khẩu cũ: </label>
                                    <input type="password" class="form-control" name="password_old"
                                        placeholder="Nhập mật khẩu cũ" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-body-item">
                                <div class="form-group">
                                    <label for="">Mật khẩu mới: </label>
                                    <input type="password" class="form-control" name="password_new"
                                        placeholder="Nhập mật khẩu mới" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-body-item">
                                <div class="form-group">
                                    <label for="">Nhập lại mật khẩu mới: </label>
                                    <input type="password" class="form-control" name="re_password_new"
                                        placeholder="Nhập lại mật khẩu mới" autocomplete="off" required>
                                </div>
                            </div>
                            <button class="btn btn-successCustom form-body-btn btn-change-password" type="button">Cập
                                nhật mật
                                khẩu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('user/app/jquery/profile_info.js')}}"></script>
<script type="text/javascript">
$(".vertical-menu-content").addClass("no-home");
$(document).ready(function() {
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