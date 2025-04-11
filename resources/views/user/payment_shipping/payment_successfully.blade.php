@extends('user/layouts')

@section('title','Thanh Toán Thành Công')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Thanh to&#225;n v&#224; Thành Công" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/payment_shipping.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection

@section('body')
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb clearfix">
                    <ul>
                        <li itemtype="http://shema.org/Breadcrumb" itemscope="" class="home">
                            <a title="Đến trang chủ" href="{{ route('user/index') }}" itemprop="url"><span
                                    itemprop="title">Trang
                                    chủ</span></a>
                        </li>
                        <li class="icon-li"><strong>Thanh toán</strong> </li>
                        <li class="icon-li"><strong>Thanh toán thành công</strong> </li>
                    </ul>
                </div>
                <div class="payment-content">
                    <h1 class="page-heading"><span>Thanh toán thành công</span></h1>
                    <div class="steps clearfix">
                        <ul class="clearfix">
                            <li
                                class="cart active col-md-2 col-xs-12 col-sm-4 col-md-offset-3 col-sm-offset-0 col-xs-offset-0">
                                <span><i class="glyphicon glyphicon-shopping-cart"></i></span><span>Giỏ hàng của
                                    tôi</span><span class="step-number"><a>1</a></span>
                            </li>
                            <li class="payment active col-md-2 col-xs-12 col-sm-4"><span><i
                                        class="glyphicon glyphicon-usd"></i></span><span>Thanh toán</span><span
                                    class="step-number"><a>2</a></span></li>
                            <li class="finish active col-md-2 col-xs-12 col-sm-4"><span><i
                                        class="glyphicon glyphicon-ok"></i></span><span>Hoàn tất</span><span
                                    class="step-number"><a>3</a></span></li>
                        </ul>
                    </div>
                    <form class="payment-block clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12 payment-step step3">
                            <div class="payment-success payment-success-body">
                                <div class="payment-success-title">Chúc mừng bạn đã thanh toán thành công</div>
                                <div class="payment-success-img">
                                    <img src="{{ asset('user/images/Logo.png') }}" alt="LogoPTPSTORE">
                                </div>
                                <div class="payment-success-desc">
                                    Cảm ơn bạn đã tin tưởng và đặt hàng từ shop chúng tôi, đơn hàng sẽ
                                    sớm được giao đến bạn
                                    trong
                                    thời gian nhanh nhất.</div>
                                <p>Xin chân thành cảm ơn!</p>
                                <div class="payment-success-groupButton">
                                    <a href="{{ route('user/index') }}" class="btn btn-backHome">Trở về trang
                                        chủ</a>
                                    <a href="{{ route('user/purchase-history') }}" class="btn btn-backBill">Danh
                                        sách đơn hàng</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('user/app/jquery/payment.js')}}"></script>
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
