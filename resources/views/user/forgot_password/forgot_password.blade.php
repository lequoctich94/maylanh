@extends('user/layouts')

@section('title','Quên Mật Khẩu')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Lấy lại mật khẩu" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
@endsection

@section('body')
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="menu-account">
                    <h3>
                        <span>
                            Tài khoản
                        </span>
                    </h3>
                    <ul>
                        <li><a href="{{ route('user/login') }}"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                        <li><a href="{{ route('user/register') }}"><i class="fa fa-key"></i> Đăng ký</a></li>
                        <li><a href="{{ route('user/forgot-password') }}"><i class="fa fa-key"></i> Quên mật khẩu</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="breadcrumb clearfix">
                    <ul>
                        <li itemtype="http://shema.org/Breadcrumb" itemscope="" class="home">
                            <a title="Đến trang chủ" href="{{ route('user/index') }}" itemprop="url"><span
                                    itemprop="title">Trang
                                    chủ</span></a>
                        </li>
                        <li class="icon-li"><strong>Quên mật khẩu</strong> </li>
                    </ul>
                </div>
                <div class="foget-password-content clearfix">
                    <h1 class="page-heading"><span>Quên mật khẩu</span></h1>
                    <div class="alert alert-danger fade in error-inline d-none">
                        <button data-dismiss="alert" class="close"></button>
                        <i class="fa-fw fa fa-times"></i>
                        <strong>Lỗi</strong>
                        <span name="message-error">abc</span>
                    </div>
                    <div class="alert alert-success fade in success-inline d-none">
                        <button data-dismiss="alert" class="close"></button>
                        <i class="fa-fw fa fa-check"></i>
                        <strong>Xác nhận</strong>
                        <span name="message-success">Vui lòng check email để hoàn thành quá trình lấy lại mật
                            khẩu.</span>
                    </div>

                    <div class="alert alert-info fade in">
                        <button data-dismiss="alert" class="close"></button>
                        <i class="fa-fw fa fa-check"></i>
                        Điền vào SĐT của bạn để yêu cầu một mật khẩu mới. Mã xác nhận sẽ được gửi đến Email liên
                        kết với SĐT này để xác minh số điện thoại của bạn.
                    </div>

                    <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12 col-xs-offset-0 col-sm-offset-0">
                        <form class="form-horizontal" id="form-forgot-password"
                            action="{{ route('user/reset-password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Số Điện Thoại: </label>
                                <div class="col-sm-8">
                                    <input name="username" type="number" min="1" pattern="[0-9]*"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="form-group confirm-code d-none">
                                <label class="col-sm-4 control-label">Mã xác nhận</label>
                                <div class="col-sm-8">
                                    <input name="confirm_code" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="button" is-sended="false" class="btn btn-primary forgot-password">Gửi
                                        mật khẩu</button>
                                    <a href="{{ route('user/login') }}">Quay lại đăng nhập</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('user/app/jquery/forgot_password.js')}}"></script>
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