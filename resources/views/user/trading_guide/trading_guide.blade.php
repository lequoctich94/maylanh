@extends('user/layouts')

@section('title', "Hướng Dẫn Giao Dịch")

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta content="Hướng dẫn thanh to&#225;n" name="description" />
<meta content="Hướng dẫn thanh to&#225;n" name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Hướng dẫn thanh to&#225;n" property="og:title" />
<meta content="Hướng dẫn thanh to&#225;n" property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/trading_guide.css') }}">
@endsection

@section('body')
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="breadcrumb clearfix">
                    <ul>
                        <li class="home">
                            <a title="Đến trang chủ" href="{{ route('user/index') }}"><span itemprop="title">Trang
                                    chủ</span></a>
                        </li>
                        <li class="icon-li"><strong>Hướng dẫn thanh to&#225;n</strong> </li>
                    </ul>
                </div>
                <script type="text/javascript">
                    $(".link-site-more").hover(function () {
                        $(this).find(".s-c-n").show();
                    }, function () {
                        $(this).find(".s-c-n").hide();
                    });
                </script>
                <div class="tradingGuide">
                    <h1 class="tradingGuide-title">
                        Hướng dẫn thanh to&#225;n
                    </h1>
                    <div class="tradingGuide-box">
                        <div class="tradingGuide-boxDesc">
                            <span>B.1</span>: Chọn vào nút <em>Mua ngay</em> sản phẩm cần mua (Ảnh chỉ là minh hoạ)
                        </div>
                        <div class="tradingGuide-boxImage">
                            <img src="{{ asset('user/images/trading-guide-1.png') }}" alt="">
                        </div>
                    </div>
                    <div class="tradingGuide-box">
                        <div class="tradingGuide-boxDesc">
                            <span>B.2</span>: Lựa chọn lần lượt các thuộc tính: <em>Màu sắc</em> -> <em>Kích thước</em>
                            -> <em>Số lượng</em> cần
                            mua.
                            <span>Nhấn nút <em>mua ngay</em> để vào thanh toán ngay</span>
                            <span>Nhấn nút <em>thêm vào giỏ hàng</em> để mua sau</span>
                        </div>
                        <div class="tradingGuide-boxImage">
                            <img src="{{ asset('user/images/trading-guide-2.png') }}" alt="">
                        </div>
                    </div>
                    <div class="tradingGuide-box">
                        <div class="tradingGuide-boxDesc">
                            <span>B.3</span>: Tick chọn sản phẩm, chọn <em>mã khuyến mãi</em> (nếu có) & nhấn vào nút
                            <em>thanh toán</em>
                            để
                            thanh toán ngay.
                        </div>
                        <div class="tradingGuide-boxImage">
                            <img src="{{ asset('user/images/trading-guide-3.png') }}" alt="">
                        </div>
                    </div>
                    <div class="tradingGuide-box">
                        <div class="tradingGuide-boxDesc">
                            <span>B.4</span>: Nhập các thông tin đơn hàng và nhấn vào nút đặt ngay để đặt hàng nào...
                        </div>
                        <div class="tradingGuide-boxImage">
                            <img src="{{ asset('user/images/trading-guide-4.png') }}" alt="">
                        </div>
                    </div>
                    <div class="tradingGuide-box">
                        <div class="tradingGuide-boxDesc">
                            <span>B.4</span>: Khi đặt hàng thành công có thể theo dõi đơn đã đặt tại "Danh sách đơn
                            hàng"
                            hoặc về trang chủ để mua hàng tiếp.
                        </div>
                        <div class="tradingGuide-boxImage">
                            <img src="{{ asset('user/images/trading-guide-5.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <script src="{{ asset('user/app/services/moduleServices.js') }}"></script>
                <script src="{{ asset('user/app/controllers/moduleController.js') }}"></script>
                <!--Begin-->
                <div class="box-support-online" ng-controller="moduleController"
                    ng-init="initSupportOnlineController('Shop','SupportOnlines')">
                    <h3><span>Hỗ trợ trực tuyến</span></h3>
                    <div class="support-online-block">
                        <div class="support-hotline">
                            HOTLINE<br><span>0306 191 4**</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".menu-quick-select ul").hide();
        $(".menu-quick-select").hover(function () {
            $(".menu-quick-select ul").show();
        }, function () {
            $(".menu-quick-select ul").hide();
        });
    });
</script>
@endsection

@section('script')
<script type="text/javascript">
    $(".header-content").css({
        "background": ''
    });
    $("html").addClass('');
</script>
@endsection
