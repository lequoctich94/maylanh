<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="jwt-token" content="{{ !is_null($admin) ? $admin->token : '' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>PTP Store - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('dist/img/logo_ptpstore.png')}}" type="image/x-icon">
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />
    @yield('header')
    <link rel="stylesheet" href="{{ asset('dist/css/error.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/style_custom_admin.css') }}">
    <link href="{{ asset('user/static.ptpstore/PTPSTOREV2/popup.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->


    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span
                    class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="{{ route('index') }}">
                <div class="d-inline-flex align-items-center">
                    <img class="brand-img d-inline-block" src="{{env('APP_URL')}}/upload/logo/logo_ptpstore.png"
                        width="30" height="30" alt="ptpstore" />
                    <span class="nav-link-text font-22 text-grey ml-1">PTP Store</span>
                </div>
            </a>
            <ul class="navbar-nav hk-navbar-content">
                <li class="nav-item">
                    <a id="settings_toggle_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span
                            class="feather-icon"><i data-feather="settings"></i></span></a>
                </li>
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="{{env('APP_URL')}}/upload/avatar_users/{{$admin->image}}" alt="user"
                                        class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
                                <span>{{$admin->full_name}}<i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX"
                        data-dropdown-out="flipOutX">
                        <a class="dropdown-item" href="{{route('index')}}"><i
                                class="dropdown-icon zmdi zmdi-account"></i><span>Thông Tin Cá Nhân</span></a>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="dropdown-item"><i class="dropdown-icon zmdi zmdi-power"></i><span>Đăng
                                    Xuất</span></button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i
                            data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Nhập Tìm Kiếm">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i
                            data-feather="x"></i></span></a>
            </div>
        </form>
        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-dark">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i
                        data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('index')}}">
                                <span class="feather-icon"><i data-feather="activity"></i></span>
                                <span class="nav-link-text">Trang Chủ</span>
                            </a>
                        </li>
                        <div class="nav-header">
                            <span>Thống Kê</span>
                            <span>ST</span>
                        </div>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse"
                                data-target="#statistisc_dropdown">
                                <span class="feather-icon"><i data-feather="pie-chart"></i></span>
                                <span class="nav-link-text">Thống Kê</span>
                            </a>
                            <ul id="statistisc_dropdown" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('statistic-bill-pay-management') }}">Hoá
                                                Đơn Bán</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('statistics-product-management')}}">Sản
                                                Phẩm</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('statistics-member')}}">Thành Viên</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <div class="nav-header">
                            <span>Quản Lý</span>
                            <span>MA</span>
                        </div>

                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse"
                                data-target="#product_dropdown">
                                <span class="feather-icon"><i data-feather="briefcase"></i></span>
                                <span class="nav-link-text">Sản Phẩm</span>
                            </a>
                            <ul id="product_dropdown" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('product-management')}}">
                                                <span class="feather-icon"><i data-feather="briefcase"></i></span>
                                                <span class="nav-link-text">Sản Phẩm</span>
                                            </a>
                                        </li>
                                        
                                       
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse"
                                data-target="#bill_dropdown">
                                <span class="feather-icon"><i data-feather="book"></i></span>
                                <span class="nav-link-text">Hoá Đơn</span>
                            </a>
                            <ul id="bill_dropdown" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('bill-pay-management')}}">
                                                <span class="feather-icon"><i data-feather="book"></i></span>
                                                <span class="nav-link-text">Hoá Đơn Bán</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('bill-order-management')}}">
                                                <span class="feather-icon"><i data-feather="archive"></i></span>
                                                <span class="nav-link-text">Hoá Đơn Nhập</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse"
                                data-target="#member_dropdown">
                                <span class="feather-icon"><i data-feather="hash"></i></span>
                                <span class="nav-link-text">Thành Viên</span>
                            </a>
                            <ul id="member_dropdown" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('voucher-management')}}">
                                                <span class="feather-icon"><i data-feather="credit-card"></i></span>
                                                <span class="nav-link-text">Mã Khuyến Mãi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('member-management')}}">
                                                <span class="feather-icon"><i data-feather="users"></i></span>
                                                <span class="nav-link-text">Khách Hàng Thành Viên</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('rank-management')}}">
                                                <span class="feather-icon"><i data-feather="slack"></i></span>
                                                <span class="nav-link-text">Cấp Bậc</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('role-management')}}">
                                                <span class="feather-icon"><i data-feather="user-check"></i></span>
                                                <span class="nav-link-text">Quyền Người Dùng</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('producer-management')}}">
                                <span class="feather-icon"><i data-feather="pocket"></i></span>
                                <span class="nav-link-text">Quản Lí Hàng Hóa</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('category-management')}}">
                                <span class="feather-icon"><i data-feather="server"></i></span>
                                <span class="nav-link-text">Quản Lí Loại Sản Phẩm</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('size-and-color-management')}}">
                                <span class="feather-icon"><i data-feather="book-open"></i></span>
                                <span class="nav-link-text">Thuộc Tính Sản Phẩm</span>
                            </a>
                        </li>
                </div>
            </div>
        </nav>

        <!-- /Vertical Nav -->

        <!-- Setting Panel -->
        <div class="hk-settings-panel">
            <div class="nicescroll-bar position-relative">
                <div class="settings-panel-wrap">
                    <div class="settings-panel-head">
                        <div class="d-inline-flex align-items-center">
                            <img class="brand-img d-inline-block" src="{{env('APP_URL')}}/upload/logo/logo_ptpstore.png"
                                width="30" height="30" alt="ptpstore" />
                            <span class="nav-link-text font-22 text-grey ml-1">PTP Store</span>
                        </div>
                        <a href="javascript:void(0);" id="settings_panel_close" class="settings-panel-close"><span
                                class="feather-icon"><i data-feather="x"></i></span></a>
                    </div>
                    <hr>
                    <h6 class="mb-5">Danh Mục</h6>
                    <p class="font-14">Bạn có thể chuyển đổi chế độ: Sáng & Tối</p>
                    <div class="button-list hk-nav-select mb-10">
                        <button type="button" id="nav_light_select"
                            class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                                    class="fa fa-sun-o"></i> </span><span class="btn-text">Chế độ: Sáng</span></button>
                        <button type="button" id="nav_dark_select"
                            class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span
                                class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Chế độ:
                                Xanh</span></button>
                    </div>
                    <hr>
                    <h6 class="mb-5">Thanh Công Cụ</h6>
                    <p class="font-14">Bạn có thể chuyển đổi chế độ: Sáng & Tối</p>
                    <div class="button-list mb-10">
                        <button type="button" id="navtop_light_select"
                            class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span
                                class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Chế độ:
                                Sáng</span></button>
                        <button type="button" id="navtop_dark_select"
                            class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                                    class="fa fa-moon-o"></i> </span><span class="btn-text">Chế độ: Tối</span></button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Ẩn/Hiện Thanh Công Cụ Khi Cuộn</h6>
                        <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary scroll-nav-switch">
                        </div>
                    </div>
                    <button id="reset_settings" class="btn btn-primary btn-block btn-reset mt-30">Đặt Lại</button>
                </div>
            </div>
        </div>
        <!-- /Setting Panel -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            @yield('body')
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
            <!-- Footer -->
            <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>PTP STORE by<a href="{{route('index')}}" class="text-dark"> TT.MP.Dev</a> ©
                                <span id="date"></span>
                                <script>
                                var dt = new Date();
                                document.getElementById("date").innerHTML = dt.getFullYear();
                                </script>
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery/logout.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery/datepicker.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('user/app/validation.js')}}"></script>
    @yield('footer-script')
</body>

</html>