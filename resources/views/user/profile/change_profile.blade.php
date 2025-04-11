@extends('user/layouts')

@section('title','Cập nhật thông tin cá nhân')

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
<meta content="Cập nhật thông tin cá nhân" property="og:title" />
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
                                    <img name="avatar"
                                        src="{{env('APP_URL')}}/upload/avatar_users/{{$member->user->image}}" alt="">
                                </a>
                                <h1 class="full-name-user">{{$member->user->full_name}}</h1>
                                <p class="email-user">{{$member->user->email}}</p>
                            </div>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="{{ route('user/profile') }}"> <i class="fa fa-user"></i>Thông
                                    tin cá nhân</a></li>
                            <li class="active"><a href="javascript:void(0)"> <i class="fa fa-edit"></i>Chỉnh sửa thông
                                    tin cá nhân</a></li>
                            <li><a href="{{ route('user/change-password') }}"> <i class="fa fa-edit"></i>Cập nhật mật
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
                            <h1>Thông tin cập nhật thông tin cá nhân</h1>
                            <input hidden value="{{$member->user->username}}" name="username">
                            <div class="col-md-8">
                                <div class="form-body-item">
                                    <div class="form-group">
                                        <label for="">Họ và tên: </label>
                                        <input type="text" class="form-control" name="full_name"
                                            placeholder="Nhập họ và tên thay đổi của bạn"
                                            value="{{$member->user->full_name}}" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-body-item">
                                    <div class="form-group">
                                        <label for="">Số điện thoại: </label>
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="Nhập số điện thoại thay đổi"
                                            value="********{{Str::substr($member->user->phone, Str::length($member->user->phone)-2,Str::length($member->user->phone))}}"
                                            autocomplete="off" disabled>
                                    </div>
                                </div>
                                <div class="form-body-item">
                                    <div class="form-group">
                                        <label for="">Email: </label>
                                        <input type="text" class="form-control" name="email"
                                            placeholder="Nhập email thay đổi" value="{{$member->user->email}}"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-body-item">
                                    <div class="form-group">
                                        <label for="">Địa chỉ: </label>
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Nhập địa chỉ thay đổi" value="{{$member->user->address}}"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-body-item">
                                    <div class="form-group">
                                        <label for="">Ngày sinh: </label>
                                        <input type="date" value="{{$member->user->birth_day}}" class="form-control"
                                            name="birth_day" autocomplete="off" required>
                                    </div>
                                </div>
                                <button class="btn btn-successCustom form-body-btn btn-change-profile" type="button">Cập
                                    nhật thông
                                    tin</button>
                            </div>
                            <div class="col-md-4">
                                <div class="profile-images-card">
                                    <label>Cập nhật ảnh đại diện</label>
                                    <div class="profile-images">
                                        <img src="{{env('APP_URL')}}/upload/avatar_users/{{$member->user->image}}"
                                            id="upload-img">
                                    </div>
                                    <div class="custom-file">
                                        <label for="fileUpload">Chọn ảnh</label>
                                        <input is-upload="false" type="file" id="fileUpload">
                                    </div>
                                    <div class="custom-file submit-file d-none">
                                        <label for="submitUpload">Xác nhận</label>
                                        <button type="button" id="submitUpload">
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