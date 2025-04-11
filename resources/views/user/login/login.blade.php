@extends('user/layouts')

@section('title','Đăng nhập')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Đăng nhập" property="og:title" />
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
                        <li class="icon-li"><strong>Đăng nhập</strong> </li>
                    </ul>
                </div>
                <div class="login-content clearfix">
                    <h1 class="page-heading"><span>Đăng nhập hệ thống</span></h1>
                    @if($errors->any() && $errors->has('errorUserLogin'))
                    <div class="alert alert-danger fade in">
                        <button data-dismiss="alert" class="close"></button>
                        <i class="fa-fw fa fa-times"></i>
                        <strong>{{$errors->first('errorUserLogin')}}</strong>
                        <span ng-bind-html="Message"></span>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success fade in">
                        <button data-dismiss="alert" class="close"></button>
                        <i class="fa-fw fa fa-check"></i>
                        <strong>Thành công!</strong> {{session('success')}}
                    </div>
                    @endif
                    <!-- 
                    <div ng-if="InValid" class="alert alert-danger fade in">
                        <button data-dismiss="alert" class="close"></button>
                        <i class="fa-fw fa fa-times"></i>
                        <strong>Error!</strong>
                        <span ng-bind-html="Message"></span>
                    </div> -->
                    <div class="col-md-6 col-md-offset-3 col-xs-12 col-sm-12 col-xs-offset-0 col-sm-offset-0">
                        <form class="form-horizontal" method="POST" action="{{ route('user/login')}}">
                            @csrf
                            <div class="form-group">
                                <label for="number" class="col-sm-4 control-label">Số Điện Thoại</label>
                                <div class="col-sm-8">
                                    <input type="text" name="username" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Password" class="col-sm-4 control-label">Mật khẩu</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                    <a href="{{ route('user/forgot-password') }}">Quên mật khẩu?</a>
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