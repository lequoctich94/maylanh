<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>PTP Store I Login</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Toggles CSS -->
    <link href="{{ asset('vendors4/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendors4/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->

    <!-- HK Wrapper -->
    <div class="hk-wrapper">

        <!-- Main Content -->
        <div class="hk-pg-wrapper hk-auth-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 pa-0">
                        <div class="auth-form-wrap pt-xl-0 pt-70">
                            <div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
                                <a class="auth-brand text-center d-block mb-20" href="#">
                                    <img class="brand-img" src="{{ asset('dist/img/logo_ptpstore.png')}}"
                                        alt="ptpstore" />
                                </a>
                                <form action="{{ route('login')}}" method="post">
                                    @csrf
                                    <h1 class="display-4 text-center mb-10">Chào Mừng Đến Với PTP Store</h1>
                                    <p class="text-center mb-30">Vui lòng đăng nhập để truy cập vào trang web</p>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Nhập tài khoản" type="text"
                                            name="username">
                                        @if($errors->has('username'))
                                        <p class="text-red">{{$errors->first('username')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Nhập mật khẩu" type="password"
                                                name="password">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><span class="feather-icon"><i
                                                            data-feather="eye-off"></i></span></span>
                                            </div>
                                        </div>
                                        @if($errors->has('password'))
                                        <p class="text-red">{{$errors->first('password')}}</p>
                                        @endif
                                    </div>
                                    <div class="custom-control custom-checkbox mb-25">
                                        <input class="custom-control-input" id="same-address" type="checkbox" checked>
                                        <label class="custom-control-label font-14" for="same-address">Ghi nhớ tài
                                            khoản</label>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Đăng Nhập</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->
    <script src="{{ asset('vendors4/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('vendors4/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('vendors4/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('dist/js/jquery.slimscroll.js')}}"></script>
    <script src="{{ asset('dist/js/feather.min.js')}}"></script>
    <script src="{{ asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
    <script src="{{ asset('dist/js/init.js')}}"></script>
</body>

</html>
