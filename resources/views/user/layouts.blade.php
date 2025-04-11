<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="jwt-token" content="{{ !is_null($member) ? $member->user->token : '' }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <title>PTP Store - @yield('title')</title>
    <link href="{{ asset('user/images/logo_ptpstore.png') }}" rel="shortcut icon" type="image/x-icon" />
    @yield('header')
    <script src="{{ asset('user/resources/js/jquery-1.11.3.min.js') }}">
    </script>
    <script src="{{ asset('user/resources/js/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/resources/js/select2.min8915.js?v=42') }}" type='text/javascript'></script>
    <script src="{{ asset('user/resources/js/jquery.bxslider.min8915.js?v=42') }}" type='text/javascript'></script>
    <script src="{{ asset('user/resources/js/owl.carousel/owl.carousel.min8915.js?v=42') }}" type='text/javascript'>
    </script>
    <script src="{{ asset('user/resources/js/modernizr.min8915.js?v=42') }}" type='text/javascript'></script>
    <script src="{{ asset('user/resources/js/jquery.cookie8915.js?v=42') }}" type='text/javascript'></script>
    <script src="{{ asset('user/resources/js/jquery.countdown.min8915.js?v=42') }}" type='text/javascript'></script>
    <script src="{{ asset('user/resources/js/fancybox/jquery.fancybox8915.js?v=42') }}" type='text/javascript'></script>
    <script src="{{ asset('user/resources/js/jquery.flexslider-min8915.js?v=42') }}" type='text/javascript'></script>
    <script src="{{ asset('user/resources/js/jquery.plugin8915.js?v=42') }}" type='text/javascript'></script>
    <script src="{{ asset('user/resources/js/jquery.actual.min8915.js?v=42') }}" type='text/javascript'></script>
    <script src="{{ asset('user/resources/js/jquery-ui/jquery-ui.min8915.js?v=42') }}" type='text/javascript'></script>
    <script src="{{ asset('user/resources/js/html5shiv.js') }}"></script>
    <script src="{{ asset('user/resources/js/jquery-migrate-1.2.0.min.js') }}"></script>
    <script src="{{ asset('user/resources/js/jquery.touchSwipe.min.js') }}" type='text/javascript'></script>
    <script async="" defer="defer" data-target=".product-resize" data-parent=".products-resize"
        data-img-box=".image-resize" src="{{ asset('user/resources/js/fixheightproductv28915.js?v=42') }}"></script>
    <link href="{{ asset('user/resources/js/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('user/resources/fonts/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('user/resources/css/reset8915.css?v=42') }}" rel='stylesheet' type='text/css' media='all' />
    <link href="{{ asset('user/resources/css/flexslider8915.css?v=42') }}" rel='stylesheet' type='text/css'
        media='all' />
    <link href="{{ asset('user/resources/css/animate8915.css?v=42') }}" rel='stylesheet' type='text/css' media='all' />
    <link href="{{ asset('user/resources/css/validate.css?v=42') }}" rel='stylesheet' type='text/css' media='all' />
    <link href="{{ asset('user/resources/css/jquery.bxslider8915.css?v=42') }}" rel='stylesheet' type='text/css'
        media='all' />
    <link href="{{ asset('user/resources/js/fancybox/jquery.fancybox8915.css?v=42') }}" rel='stylesheet' type='text/css'
        media='all' />
    <link href="{{ asset('user/resources/js/jquery-ui/jquery-ui8915.css?v=42') }}" rel='stylesheet' type='text/css'
        media='all' />
    <link href="{{ asset('user/resources/js/owl.carousel/owl.carousel8915.css?v=42') }}" rel='stylesheet'
        type='text/css' media='all' />
    <link href="{{ asset('user/resources/css/select2.min8915.css?v=42') }}" rel='stylesheet' type='text/css'
        media='all' />
    <script src="{{ asset('user/Scripts/common/mycard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('user/Scripts/lazyLoad/jquery.lazyload.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('user/Scripts/angularJS/angular.min.js') }}"></script>
    <script src="{{ asset('user/Scripts/angularJS/angular-sanitize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/Scripts/angular-loading-spinner/spin.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/Scripts/angular-loading-spinner/angular-spinner.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('user/Scripts/angular-loading-spinner/angular-loading-spinner.js') }}">
    </script>
    <script src="{{ asset('user/app/appMain.js') }}"></script>
    <script src="{{ asset('user/app/directives/directive.js') }}"></script>
    <script src="{{ asset('user/app/directives/angular-summernote.js') }}"></script>
    <script src="{{ asset('user/app/directives/paging.js') }}"></script>
    <script src="{{ asset('user/app/services/ajaxServices.js') }}"></script>
    <script src="{{ asset('user/app/services/alertsServices.js') }}"></script>
    <script src="{{ asset('user/resources/js/theme-script8915.js?v=42') }}" type='text/javascript'></script>
    <link href="{{ asset('user/static.ptpstore/PTPSTOREV2/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user/static.ptpstore/PTPSTOREV2/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user/css/style_custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ asset('user/app/ajaxCommon.js')}}"></script>
    <link href="{{ asset('user/static.ptpstore/PTPSTOREV2/loading.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user/static.ptpstore/PTPSTOREV2/popup.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ asset('user/app/validation.js')}}"></script>
</head>

<body ng-app="appMain" class="home option2">
    <div id="fb-root"></div>
    <div class="wrapper page-home">
        <div id="header" class="header">
            <script src="{{ asset('user/Scripts/common/login.js') }}" type="text/javascript"></script>
            <section class="top-link clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav navbar-nav topmenu-contact">
                                <li><i class="fa fa-hand-o-right"></i> <span>PTPSTORE Mua sắm không âu lo - Luôn đặt uy
                                        tín & Chất lượng lên đầu</span></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right topmenu hidden-xs hidden-sm">

                                <li class="order-cart"><a href="{{ route('user/cart') }}"><i
                                            class="fa fa-shopping-cart"></i>
                                        Giỏ
                                        hàng</a></li>
                                @if(!empty($member))
                                <li class="account-login" disable>
                                    <a href="{{ route('user/profile') }}" class="full-name-user"
                                        style="color:#49c2c2;font-size:16px;font-weight:bold">
                                        {{$member->user->full_name}} </a>
                                </li>
                                @else
                                <li class="account-login"><a href="{{ route('user/login') }}"><i
                                            class="fa fa-sign-in"></i>
                                        Đăng
                                        nhập </a></li>
                                <li class="account-register"><a href="{{ route('user/register') }}"><i
                                            class="fa fa-key"></i> Đăng ký
                                    </a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- MAIN HEADER -->
            <div class="container main-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 logo">
                        <a href="{{ route('user/index') }}" class="logo" title="ptpstore">
                            <img src="{{ asset('user/images/logo2.png')}}" alt="ptpstore" title="ptpstore">
                        </a>
                        <h1 style="display: none;">
                            PTPSTORE
                        </h1>
                    </div>
                    <div class="col-xs-7 col-sm-7 header-search-box">
                        <div class="search-box boxShadowSmall">
                            <form class="search form-inline">
                                <div class="form-group input-serach inputSearchCustom">
                                    <input type="text" name="keyword" class="search_box" id="txtsearch"
                                        placeholder="Nhập từ kh&#243;a t&#236;m kiếm..." />
                                </div>
                                <button id="btnsearch" class="pull-right btn-search">
                                    <span class="hidden-400">Tìm kiếm</span>
                                    <span class="show-400"><i class="fa fa-search" aria-hidden="true"></i></span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-2 group-button-header new-login">
                        <div class="btn-cart" id="cart-block">
                            <a title="Giỏ hàng" href="{{route('user/cart')}}">Giỏ hàng</a>
                            <span class="text-show">Giỏ hàng</span>
                            <span id="quantity-into-cart-1" class=" notify notify-right">{{!empty($carts) ?
                                $carts->count() : '0'}}</span>
                        </div>
                        <div class="hamburger-menu">
                            <a title="{{!empty($member)?$member->user->full_name : 'Đăng Nhập'}}"
                                href="{{route('user/profile')}}" class="btn-menu"></a>
                            @if(!empty($member))
                            <ul class="hamburger-menu-ul">
                                <li class="hamburger-menu-li">
                                    <a href="{{ route('user/profile') }}" class="hamburger-menu-link">
                                        Thông tin cá nhân
                                    </a>
                                </li>
                                <li class="hamburger-menu-li">
                                    <a href="{{ route('user/purchase-history') }}" class="hamburger-menu-link">
                                        Đơn mua
                                    </a>
                                </li>
                                <li class="hamburger-menu-li"><span class="hamburger-menu-link">
                                        <form action="{{route('user/logout')}}" method="POST">
                                            @csrf
                                            <button class="dropdown-item"><i class="fa fa-sign-in"></i>
                                                Đăng Xuất
                                            </button>
                                        </form>
                                    </span>
                                </li>
                            </ul>
                            @endif
                        </div>
                        <input id="member_id" value="{{ !empty($member) ? $member->member_id : ''}}" hidden />
                    </div>
                </div>
            </div>
            <div id="nav-top-menu" class="nav-top-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3" id="box-vertical-megamenus">
                            <div class="box-vertical-megamenus menu-quick-select">
                                <h4 class="title click-menu">
                                    <span class="title-menu">Danh mục sản phẩm</span>
                                    <span class="btn-open-mobile pull-right home-page"><i class="fa fa-bars"></i></span>
                                </h4>
                                @if(!empty($categories))
                                <div class="vertical-menu-content is-home">
                                    <ul class='vertical-menu-list'>
                                        @foreach($categories as $category)
                                        <li class="level0">
                                            <a class=''
                                                href="{{ route('user/product') }}?keyword={{Str::slug($category->category_name)}}&searchID={{$category->category_id}}"><img
                                                    class='icon-menu'
                                                    src='{{env("APP_URL")}}/upload/categories/{{$category->suffix_img}}'
                                                    alt='{{$category->category_name}}'>
                                                <span>{{$category->category_name}}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul class='vertical-menu-list'>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div id="main-menu-new" class="col-sm-12 col-md-9 main-menu">
                            <nav class="navbar navbar-default">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                            data-target="#new-menu" aria-expanded="false" aria-controls="navbar">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <a class="navbar-brand" href="javascript:void(0)">MENU</a>
                                    </div>
                                    <div id="new-menu" class="navbar-collapse collapse">
                                        <ul class='menu t-menu nav'>
                                            <li class="level0"><a class='' href="{{ route('user/index') }}"><span>Trang
                                                        chủ</span></a></li>
                                            <li class="level0"><a class=''
                                                    href="{{ route('user/introduce')}}"><span>Giới
                                                        thiệu</span></a></li>
                                            <li class="level0"><a class='' href="{{route('user/product')}}"><span>Sản
                                                        phẩm</span></a></li>
                                            <li class="level0"><a class='' href="{{ route('user/policy') }}"><span>Chính
                                                        sách bảo mật
                                                    </span></a>
                                            </li>
                                            <li class="level0"><a class=''
                                                    href="{{ route('user/trading-guide') }}"><span>Hướng dẫn mua hàng
                                                    </span></a>
                                            </li>
                                            <li class="level0"><a class='' href="{{ route('user/contact') }}"><span>Liên
                                                        hệ</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--/.nav-collapse -->
                                </div>
                            </nav>
                        </div>
                    </div>
                    <a href="{{ route('user/cart')}}">
                        <!-- CART ICON ON MMENU -->
                        <div id="shopping-cart-box-ontop">
                            <span class="icon-cart-ontop"></span>
                            <span id="quantity-into-cart-2" class="cart-items-count">{{!empty($carts) ? $carts->count()
                                :
                                '0'}}</span>
                            <span class="text" style="white-space:nowrap">Giỏ hàng</span>
                            <div class="shopping-cart-box-ontop-content">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @yield('body')
        <!-- <div id="preloader">
            <div id="loader"></div>
        </div> -->
        <div id="show-popup" class="popup-container popup center">
            <div class="icon">
                <i id="type-message" class="fa fa-exclamation-triangle red"></i>
            </div>
            <div class="title">
                <p id="title-popup">Success!!</p>
            </div>
            <div class="description">
                <p id="message-popup">Nội dung thành công</p>
            </div>
            <div class="dismiss-btn">
                <button id="dismiss-popup-btn">
                    Đóng
                </button>
            </div>
        </div>
        <div class="partner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!--Begin-->
                        <div class="row banner-bottom">
                            <h4 style="width:100%;border-bottom: 3px solid #fdffff;
                                padding-left:15px;font-size:22px;font-weight:400;
                                color:rgb(136, 136, 136);padding-bottom:10px;padding-top:10px;">
                                <span class="title-menu">Bạn có điều này không?</span>
                            </h4>
                            <div class="banner-bottomContainer">
                                <div class="banner-bottomContainerImg">
                                    <img src="{{ asset('user/resources/img/banner-bottom-1.png') }}"
                                        alt="{{ asset('user/resources/img/banner-bottom-1.png') }}">
                                </div>
                                <div class="banner-bottomContainerImg">
                                    <img src="{{ asset('user/resources/img/banner-bottom-2.png') }}"
                                        alt="{{ asset('user/resources/img/banner-bottom-2.png') }}">
                                </div>
                                <div class="banner-bottomContainerImg">
                                    <img src="{{ asset('user/resources/img/banner-bottom-3.png') }}"
                                        alt="{{ asset('user/resources/img/banner-bottom-3.png') }}">
                                </div>
                                <div class="banner-bottomContainerImg">
                                    <img src="{{ asset('user/resources/img/banner-bottom-4.png') }}"
                                        alt="{{ asset('user/resources/img/banner-bottom-4.png') }}">
                                </div>
                                <div class="banner-bottomContainerImg">
                                    <img src="{{ asset('user/resources/img/banner-bottom-5.png') }}"
                                        alt="{{ asset('user/resources/img/banner-bottom-5.png') }}">
                                </div>
                                <div class="banner-bottomContainerImg">
                                    <img src="{{ asset('user/resources/img/banner-bottom-6.png') }}"
                                        alt="{{ asset('user/resources/img/banner-bottom-6.png') }}">
                                </div>
                            </div>
                        </div>
                        <!--End-->
                        <!--Begin-->
                        <div class="services2">
                            <ul>
                                <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                                    <div class="service-wapper">
                                        <div class="row">
                                            <div class="col-sm-6 image">
                                                <div class="icon">
                                                    <img src="{{ asset('user/resources/img/icon-s18915.png?v=42')}}"
                                                        alt="service">
                                                </div>
                                                <h3 class="title">Giá trị lớn</h3>
                                            </div>
                                            <div class="col-sm-6 text">
                                                Chúng tôi cung cấp giá cả cạnh tranh nhất trên từng sản phẩm, phù
                                                hợp
                                                với mọi túi tiền.
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                                    <div class="service-wapper">
                                        <div class="row">
                                            <div class="col-sm-6 image">
                                                <div class="icon">
                                                    <img src="{{ asset('user/resources/img/icon-s28915.png?v=42')}}"
                                                        alt="service">
                                                </div>
                                                <h3 class="title">Giao hàng</h3>
                                            </div>
                                            <div class="col-sm-6 text">
                                                Giao hàng tận nơi, sản phẩm sẽ có mặt tại nhà bạn từ 3 đến 5 ngày
                                                làm
                                                việc.
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                                    <div class="service-wapper">
                                        <div class="row">
                                            <div class="col-sm-6 image">
                                                <div class="icon">
                                                    <img src="{{ asset('user/resources/img/icon-s38915.png?v=42')}}"
                                                        alt="service">
                                                </div>
                                                <h3 class="title">Sản phẩm</h3>
                                            </div>
                                            <div class="col-sm-6 text">
                                                Sản phẩm chính hãng, bảo hành trên toàn quốc.
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                                    <div class="service-wapper">
                                        <div class="row">
                                            <div class="col-sm-6 image">
                                                <div class="icon">
                                                    <img src="{{ asset('user/resources/img/icon-s48915.png?v=42')}}"
                                                        alt="service">
                                                </div>
                                                <h3 class="title">Hỗ trợ</h3>
                                            </div>
                                            <div class="col-sm-6 text">
                                                Hỗ trợ 24/7. <br>Phone: +84 0306 191 4**.<br>Emal:
                                                ptpstore5794@gmail.com
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                                    <div class="service-wapper">
                                        <div class="row">
                                            <div class="col-sm-6 image">
                                                <div class="icon">
                                                    <img src="{{ asset('user/resources/img/icon-s58915.png?v=42')}}"
                                                        alt="service">
                                                </div>
                                                <h3 class="title">Ứng dụng</h3>
                                            </div>
                                            <div class="col-sm-6 text">
                                                Cài đặt ứng dụng khi mua hàng sẽ được giảm giá đặc biệt từ 5 đến
                                                10%.
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                                    <div class="service-wapper">
                                        <div class="row">
                                            <div class="col-sm-6 image">
                                                <div class="icon">
                                                    <img src="{{ asset('user/resources/img/icon-s68915.png?v=42')}}"
                                                        alt="service">
                                                </div>
                                                <h3 class="title">Thanh toán</h3>
                                            </div>
                                            <div class="col-sm-6 text">
                                                Thanh toán khi nhận hàng. <br>Phương thức thanh toán đa dạng
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--End-->
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <footer id="footer">
                <div class="container">
                    <!-- introduce-box -->
                    <div id="introduce-box" class="row">
                        <div class="col-md-3">
                            <div id="address-box">
                                <a href="{{ route('user/index') }}"><img src="{{ asset('user/images/logo2.png') }}"
                                        alt="logo" /></a>
                                <div id="address-list">
                                    <div class="tit-name">Địa chỉ:</div>
                                    <div class="tit-contain">65 Đ. Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Thành phố Hồ Chí
                                        Minh 700000</div>
                                    <div class="tit-name">Điện thoại:</div>
                                    <div class="tit-contain">+84 0306 191 4**</div>
                                    <div class="tit-name">Email:</div>
                                    <div class="tit-contain">ptpstore5794@gmail.com</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="introduce-title">Về ch&#250;ng t&#244;i</div>
                                    <ul class="introduce-list">
                                        <li class="item">
                                            <a href="{{ route('user/introduce') }}">
                                                Giới thiệu
                                            </a>
                                        </li>
                                        <li class="item">
                                            <a href="{{ route('user/policy') }}">
                                                Ch&#237;nh s&#225;ch bảo mật
                                            </a>
                                        </li>
                                        <li class="item">
                                            <a href="{{ route('user/contact') }}">
                                                Li&#234;n hệ
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <div class="introduce-title">Trợ gi&#250;p</div>
                                    <ul class="introduce-list">
                                        <li class="item">
                                            <a href="{{ route('user/trading-guide') }}">
                                                Hướng dẫn thanh to&#225;n
                                            </a>
                                        </li>
                                        <li class="item">
                                            <a href="{{route('user/delivery-and-exchange') }}">
                                                Chính sách giao h&#224;ng
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div id="contact-box">
                                <div class="introduce-title">Đăng ký nhận tin</div>
                                <form class='contact-form'>
                                    <div class="input-group" id="mail-box">
                                        <input type="email" placeholder="Đăng ký email" required="required" />
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn-send">Gửi</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </form>
                                <div class="introduce-title introduce-link">Liên kết</div>
                                <div class="social-link">
                                    <a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
                                    <a href="javascript:void(0);"><i class="fa fa-youtube"></i></a>
                                    <a href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
                                    <a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /#introduce-box -->
                    <!-- #trademark-box -->
                    <div id="trademark-box" class="row">
                        <div class="col-sm-12">
                            <ul id="trademark-list">
                                <li id="payment-methods">Phương thức thanh toán</li>
                                <li class="trademark-list-img"><img src="{{asset('user/images/zalopay.jpg')}}"
                                        alt="Thanh Toán Bằng ZaloPay" title="Thanh Toán Bằng ZaloPay"></li>
                                <li class="trademark-list-img"><img src="{{asset('user/images/tienmat.png')}}"
                                        alt="Thanh Toán Bằng Tiền Mặt" title="Thanh Toán Bằng Tiền Mặt"></li>
                            </ul>
                        </div>
                    </div> <!-- /#trademark-box -->
                    <p class="cpr text-center">
                        &copy; Bản quyền thuộc về <a href="http://ptpstore.vn/" style="color: #0f9ed8"
                            target="_blank">PTPSTORE</a> | <a target="_blank" href="https://www.ptpstore.vn/">Powered by
                            PTPSTORE.VN</a>.
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <div style="display: none;" id="loading-mask">
        <div id="loading_mask_loader" class="loader">
            <img alt="Loading..." src="{{ asset('user/images/ajax-loader-main.gif') }}" />
            <div>
                Please wait...
            </div>
        </div>
    </div>
    <a href="#" class="scroll_top" title="Scroll to Top" style="display: none;">Scroll</a>
</body>
<script type="text/javascript" src="{{ asset('user/app/validation.js')}}"></script>
<script type="text/javascript">
    $("button#btnsearch").on("click", function () {
        keyword = $("input[name=keyword]").val();
        if (keyword == '') {
            window.location.href = "/product";
        } else {
            window.location.href = "/product?keyword=" + keyword;
        }

    })
</script>

</html>
@yield('script')
