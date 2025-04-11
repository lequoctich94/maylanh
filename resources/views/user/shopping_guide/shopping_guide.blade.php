@extends('user/layouts')

@section('title', "Hướng Dẫn Mua Hàng")

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta content="Hướng dẫn mua h&#224;ng" name="description" />
<meta content="Hướng dẫn mua h&#224;ng" name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Hướng dẫn mua h&#224;ng" property="og:title" />
<meta content="Hướng dẫn mua h&#224;ng" property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
@endsection

@section('body')
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-9">

                <div class="breadcrumb clearfix">
                    <ul>
                        <li itemtype="http://shema.org/Breadcrumb" itemscope="" class="home">
                            <a title="Đến trang chủ" href="{{ route('user/index') }}" itemprop="url"><span
                                    itemprop="title">Trang
                                    chủ</span></a>
                        </li>
                        <li class="icon-li"><strong>Hướng dẫn mua h&#224;ng</strong> </li>
                    </ul>
                </div>
                <script type="text/javascript">
                    $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
                </script>
                <div class="page-option">
                    <h1 class="title">
                        <span>Hướng dẫn mua h&#224;ng</span>
                    </h1>
                    <div class="page-option-block">
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 16px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            <strong style="border: 0px; margin: 0px; padding: 0px;">Bước 1:</strong>
                        </p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 14px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            Chọn sản phẩm, màu sắc, số lượng muốn mua.... Sau đó click vào nút <strong
                                style="border: 0px; margin: 0px; padding: 0px;">"MUA NGAY"</strong></p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 14px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            <img src="../../www.mydeal.vn/img/step-1.html"
                                style="border: 0px; margin: 0px; padding: 0px; font-size: 0px; color: transparent; vertical-align: middle;" />
                        </p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 16px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            <strong style="border: 0px; margin: 0px; padding: 0px;">Bước 2:</strong>
                        </p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 14px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            Hệ thống dẫn bạn vào trang giỏ hàng, vui lòng kiểm tra tên sản phẩm, số lượng, màu
                            sắc, giá tiền, tổng tiền....Tại đây bạn có thể thay đổi màu sắc, số lượng, xóa sản
                            phẩm không muốn mua hoặc có thể trở về trang chủ để tiếp tục mua hàng. Nếu muốn
                            thanh toán đơn hàng, vui lòng click vào nút <strong
                                style="border: 0px; margin: 0px; padding: 0px;">"Đặt hàng"</strong></p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 14px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            <img src="../../www.mydeal.vn/img/step-2.html"
                                style="border: 0px; margin: 0px; padding: 0px; font-size: 0px; color: transparent; vertical-align: middle;" />
                        </p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 16px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            <strong style="border: 0px; margin: 0px; padding: 0px;">Bước 3:</strong>
                        </p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 14px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            Hệ thống dẫn bạn vào trang thông tin mua hàng. Nếu bạn đã có tài khoản tại
                            mydeal.vn, vui lòng chọn <strong style="border: 0px; margin: 0px; padding: 0px;">"Đăng
                                nhập"</strong>. Nếu bạn
                            muốn đăng ký tài khoảng, vui lòng chọn <strong
                                style="border: 0px; margin: 0px; padding: 0px;">"Đăng ký"</strong>. Nếu muốn đặt
                            hàng nhanh mà không cần đăng ký, vui lòng nhập đầy đủ thông tin vào bảng mẫu bên
                            dưới:</p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 14px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            <img src="../../www.mydeal.vn/img/step-3.html"
                                style="border: 0px; margin: 0px; padding: 0px; font-size: 0px; color: transparent; vertical-align: middle;" />
                        </p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 14px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            Để kết thúc đặt hàng, vui lòng chọn <strong
                                style="border: 0px; margin: 0px; padding: 0px;">"Hoàn tất đặt hàng"</strong></p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 16px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            <strong style="border: 0px; margin: 0px; padding: 0px;">Bước 4:</strong>
                        </p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 14px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            Hệ thống thông báo bạn đặt hàng thành công. Chúc mừng bạn !</p>
                        <p
                            style="border: 0px; margin: 0px 0px 20px; padding: 0px; font-size: 14px; color: rgb(51, 51, 51); font-family: Arial, Tahoma, Verdana; line-height: 20px;">
                            <img src="../../www.mydeal.vn/img/step-4.html"
                                style="border: 0px; margin: 0px; padding: 0px; font-size: 0px; color: transparent; vertical-align: middle;" />
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <script src="user/app/services/moduleServices.js"></script>
                <script src="user/app/controllers/moduleController.js"></script>
                <!--Begin-->
                <div class="box-support-online" ng-controller="moduleController"
                    ng-init="initSupportOnlineController('Shop','SupportOnlines')">
                    <h3><span>Hỗ trợ trực tuyến</span></h3>
                    <div class="support-online-block">
                        <div class="support-hotline">
                            HOTLINE<br><span>Hotline</span>
                        </div>
                        <div class="support-item" ng-repeat="item in SupportOnlines">
                            <div class="name">
                                FullName <b>Phone</b>
                            </div>
                            <ul>
                                <li ng-if="item.Skype!=''&&item.Skype!=null">
                                    <a ng-href="" title="FullName">
                                        <img width="70"
                                            src="user/www.skypeassets.com/i/scom/images/skype-buttons/chatbutton_32px.png">
                                    </a>
                                </li>
                                <li ng-if="item.Viber!=''&&item.Viber!=null" class="social">
                                    <a href="" title="FullName" target="_blank"> <img src="user/images/icon-viber.png"
                                            alt="Viber"></a>
                                    <span class="phone"><a href="" title="FullName" target="_blank">Viber </a></span>
                                </li>
                                <li ng-if="item.Zalo!=''&&item.Zalo!=null" class="social">
                                    <a href="" title="FullName" target="_blank"> <img src="user/images/icon-zalo.png"
                                            alt="Zalo"></a>
                                    <span class="phone"><a href="" title="FullName" target="_blank">Zalo </a></span>
                                </li>
                                <li ng-if="item.Facebook!=''&&item.Facebook!=null" class="social">
                                    <a href="../notfounda3e5.html" title="FullName" target="_blank">
                                        <img src="user/images/icon-facebook.png" alt="Facebook"></a>
                                    <span class="phone"><a href="../notfounda3e5.html" title="FullName"
                                            target="_blank">FullName </a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--End-->
                <script type="text/javascript">
                    window.Shop = { "Name": "CÔNG TY TNHH PHÁT TRIỂN CÔNG NGHỆ RUNTIME", "Email": "run02@runtime.vn", "Phone": "(08) 66 85 85 38", "Logo": "/Uploads/shop2198/images/logo2.png", "Fax": "(08) 66 85 85 38", "Website": "http://www.runtime.vn", "Hotline": "0908 77 00 95", "Address": "1005 Quang Trung, P.14, Q.Gò Vấp, Tp.HCM", "Fanpage": null, "Google": null, "Facebook": null, "Youtube": null, "Twitter": null, "IsBanner": false, "IsFixed": false, "BannerImage": null };
                    window.SupportOnlines = [];
                </script>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".menu-quick-select ul").hide();
        $(".menu-quick-select").hover(function () { $(".menu-quick-select ul").show(); }, function () { $(".menu-quick-select ul").hide(); });
    });
</script>
@endsection

@section('script')
<script type="text/javascript">
    $(".header-content").css({ "background": '' });
    $("html").addClass('');
</script>
@endsection
