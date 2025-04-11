@extends('user/layouts')

@section('title','Đăng ký')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />

<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Đăng k&#253; th&#224;nh vi&#234;n" property="og:title" />
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
                        <li class="icon-li"><strong>Đăng ký tài khoản</strong> </li>
                    </ul>
                </div>
                <script type="text/javascript">
                    $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
                </script>
                <script src="{{ asset('user/app/services/accountServices.js') }}"></script>
                <script src="{{ asset('user/app/controllers/accountController.js') }}"></script>
                <div class="register-content clearfix" ng-controller="accountController"
                    ng-init="initRegisterController()">
                    <h1 class="page-heading"><span>Đăng ký tài khoản</span></h1>
                    <div ng-if="IsError" class="alert alert-danger fade in">
                        <button data-dismiss="alert" class="close"></button>
                        <i class="fa-fw fa fa-times"></i>
                        <strong>Error!</strong>
                        <span ng-bind-html="Message"></span>
                    </div>
                    <div ng-if="IsSuccess" class="alert alert-success fade in">
                        <button data-dismiss="alert" class="close"></button>
                        <i class="fa-fw fa fa-check"></i>
                        <strong>Success!</strong> Đăng ký thành công.
                    </div>
                    <div ng-if="InValid" class="alert alert-danger fade in">
                        <button data-dismiss="alert" class="close"></button>
                        <i class="fa-fw fa fa-times"></i>
                        <strong>Error!</strong>
                        <span ng-bind-html="Message"></span>
                    </div>
                    <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12 col-xs-offset-0 col-sm-offset-0">
                        <form class="form-horizontal" id="registerAccount" method="POST"
                            action="{{ route('user/register')}}">
                            <h2><span>Thông tin tài khoản</span></h2>
                            @csrf
                            <div class="form-group username">
                                <label for="Phone" class="col-sm-3 control-label">Số điện thoại<span
                                        class="warning">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="text" id="inputUserName" class="form-control" name="phone"
                                        required="true" autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group password">
                                <label for="Password" class="col-sm-3 control-label">Mật khẩu<span
                                        class="warning">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="password" id="inputPassword" name="password" class="form-control"
                                        required="true" autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group rePassword">
                                <label for="RePassword" class="col-sm-3 control-label">Nhập
                                    lại mật
                                    khẩu<span class="warning">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="password" id="inputRePassword" name="rePassword"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="form-group email">
                                <label for="Email" class="col-sm-3 control-label">Email<span
                                        class="warning">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="email" id="inputEmail" class="form-control" name="email"
                                        required="true" autocomplete="off" />
                                </div>
                            </div>
                            <h2>Thông tin cá nhân</h2>
                            <div class="form-group fullName">
                                <label for="FullName" class="col-sm-3 control-label">Họ tên<span
                                        class="warning">(*)</span></label>
                                <div class="col-sm-9">
                                    <input type="text" id="inputFullName" name="full_name" class="form-control"
                                        required="true" />
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label">Giới tính</label>
                                <div class="col-sm-9">
                                    <select class="form-control"></select>
                                </div>
                            </div> -->
                            <div class="form-group form-inline birthDay">
                                <label class="col-sm-3 control-label control-label">Ngày sinh</label>
                                <div class="col-sm-9">
                                    <input type="date" id="inputBirthDay" name="birth_day" class="form-control"
                                        required="true" />
                                </div>
                            </div>
                            <div class="form-group address">
                                <label for="" class="col-sm-3 control-label">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <input type="text" id="inputAddress" name="address" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="submit" class="btn btn-register-account btn-primary">Đăng ký</button>
                                </div>
                            </div>
                        </form>
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
<script src="{{ asset('dist/js/validation-form.js')}}"></script>
<script type="text/javascript" src="{{ asset('user/js/jquery/register.js') }}"></script>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".header-content").css({ "background": '' });
    $("html").addClass('');
</script>
@endsection
