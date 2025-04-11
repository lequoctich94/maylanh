@extends('user/layouts')

@section('title','Giao Hàng Đổi Trả')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta content="Giao h&#224;ng - Đổi trả" name="description" />
<meta content="Giao h&#224;ng - Đổi trả" name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Giao h&#224;ng - Đổi trả" property="og:title" />
<meta content="Giao h&#224;ng - Đổi trả" property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/delivery_and_exchange.css') }}">
@endsection

@section('body')
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="breadcrumb clearfix">
                    <ul>
                        <li class="home">
                            <a title="Đến trang chủ" href="{{ route('user/index') }}"><span>Trang
                                    chủ</span></a>
                        </li>
                        <li class="icon-li"><strong>Giao h&#224;ng</strong> </li>
                    </ul>
                </div>
                <script type="text/javascript">
                    $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
                </script>
                <div class="page-option deliveryExchange">
                    <h1 class="deliveryExchange-title">
                        Giao h&#224;ng
                    </h1>
                    <div class="page-option-block">
                        <div class="deliveryExchange-subDesc">
                            Siêu Mua dự kiến sẽ giao hàng trong vòng 24h  đối với các khu vực nội thành Hồ Chí
                            Minh và trong vòng 2 - 7 ngày đối với các tỉnh thành trên toàn quốc, không kể ngày
                            chủ nhật, ngày nghỉ lễ, và thời gian chậm chuyến do tai nạn, thiên tai dịch họa bất
                            khả kháng...... Các khu vực xa trung tâm tỉnh, thành phố (căn cứ theo toàn trình
                            tuyến của Bưu điện Việt Nam) sẽ có thời gian vận chuyển lâu hơn tùy thuộc địa điểm
                            cụ thể.</div>
                        <div class="deliveryExchange-subDesc">
                            Bởi việc vận chuyển hàng hóa tới các tỉnh thành trên toàn quốc do các đơn vị cung
                            cấp dịch vụ vận chuyển thực hiện, nên chúng tôi không bảo đảm chắc chắn và không
                            chịu trách nhiệm về bất kỳ tổn thất, chi phí thiệt hại, hoặc bất cứ chi phí phát
                            sinh nào khác do việc giao hàng chậm trễ gây ra.
                        </div>
                        <div class="deliveryExchange-subDesc">
                            Các đơn vị cung cấp dịch vụ vận chuyển làm việc theo nguyên tắc giao hàng và nhận
                            thanh toán. Đây không phải là một bộ phận thuộc hệ thống Siêu Mua, vì vậy quý khách
                            hàng vui lòng thanh toán khi sản phẩm giao tới còn nguyên đai, nguyên kiện, nguyên
                            băng dính niêm phong, chưa có dấu hiệu bóc mở..., đầy đủ chứng từ hóa đơn của Siêu
                            Mua. Trường hợp sau khi nhận sản phẩm nếu quý khách phát hiện giao nhầm, thiếu sản
                            phẩm có lỗi xin vui lòng thông báo ngay với bộ phận CSKH của Siêu Mua, chúng tôi cam
                            kết sẽ xử lý ngay lập tức theo yêu cầu hoàn trả, đổi sản phẩm của quý khách.Nếu quý
                            khách vắng mặt ở nơi giao hàng, hoặc không thể liên hệ để giao hàng đơn hàng có thể
                            sẽ bị hủy.
                        </div>
                        <div class="deliveryExchange-subDesc">
                            Việc giao hàng sẽ được tiến hành ngay khi chúng tôi xác nhận được giao dịch với quý
                            khách. Nếu trong đợt giao hàng đầu tiên người nhận hàng không có mặt, chúng tôi sẽ
                            liên hệ đến quý khách để sắp xếp thời gian giao hàng khác thuận tiện hơn. Nếu đợt
                            giao hàng thứ hai bị hoãn với cùng lý do, xin quý khách vui lòng đến TT CSKH của
                            chúng tôi tại <strong style="margin: 0px; padding: 0px;">65 Đ. Huỳnh Thúc Kháng, Bến Nghé,
                                Quận 1, Thành phố Hồ Chí Minh 700000</strong> để nhận hàng trong thời gian hoạt
                            động: <strong style="margin: 0px; padding: 0px;">Thứ 2 - Thứ 7: 8h00 - 22h00, Chủ nhật: 8h00
                                -
                                20h00.</strong>
                        </div>
                        <div class="deliveryExchange-subDesc">
                            Để kiểm tra lộ trình đơn hàng của mình, quý khách vui lòng cung cấp cho bộ phận CSKH
                            của Siêu Mua mã số đơn hàng đã được gửi cho khách hàng trong thư xác nhận.
                        </div>
                        <div class="deliveryExchange-subDesc">
                            Sau khi thanh toán và nhận hàng Khách hàng vui lòng kiểm tra ngay sau đó đồng thời
                            giữ lại bao bì đóng gói hay thông tin đính kèm khi Siêu Mua gửi để Siêu Mua có thể
                            xử lý chính xác và kịp thời nếu kiện hàng của Quý Khách có sự cố.
                        </div>
                        <div class="deliveryExchange-subDesc">
                            <strong style="margin: 0px; padding: 0px;">Lưu ý:</strong>
                        </div>
                        <div class="deliveryExchange-subDesc">
                            + Trường hợp không thể giao hàng theo thời gian đã định Siêu Mua sẽ thông báo cho
                            khách hàng về sự chậm trễ này trong thời gian sớm nhất.
                        </div>
                        <div class="deliveryExchange-subDesc">
                            + Trường hợp giao hàng chậm, Siêu Mua chấp nhận vô điều kiện về việc hủy nhận hàng
                            của khách hàng, trừ khi có thỏa thuận khác giữa khách hàng và Siêu Mua.</div>
                        <div class="deliveryExchange-subDesc">
                            + Trường hợp khách hàng hủy nhận hàng vì lý do giao hàng chậm, trong vòng tối đa 7
                            ngày kể từ ngày khách hàng hủy nhận hàng Siêu Mua sẽ trả lại tiền cho khách hàng.
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
