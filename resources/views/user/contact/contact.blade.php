@extends('user/layouts')

@section('title','Liên hệ')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Li&#234;n hệ" property="og:title" />
<meta property="og:description" />
<meta content="http://runecom02.runtime.vn" property="og:image" />
<meta content="http://runecom02.runtime.vn/lien-he.html" property="og:url" />
<meta content="ptpstore" property="og:site_name" />
@endsection

@section('body')
<div id="page">
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">

                    <script src="{{ asset('user/app/services/moduleServices.js') }}"></script>
                    <script src="{{ asset('user/app/controllers/moduleController.js') }}"></script>
                    <!--Begin-->
                    <div class="box-support-online" ng-controller="moduleController"
                        ng-init="initSupportOnlineController('Shop','SupportOnlines')">
                        <h3><span>Hỗ trợ trực tuyến</span></h3>
                        <div class="support-online-block">
                            <div class="support-hotline">
                                HOTLINE<br><span>+84 123 456 789</span>
                            </div>
                        </div>
                    </div>
                    <!--End-->
                    <script type="text/javascript">
                        window.Shop = { "Name": "CÔNG TY TNHH PHÁT TRIỂN CÔNG NGHỆ RUNTIME", "Email": "run02@runtime.vn", "Phone": "(08) 66 85 85 38", "Logo": "/Uploads/shop2198/images/logo2.png", "Fax": "(08) 66 85 85 38", "Website": "http://www.runtime.vn", "Hotline": "0908 77 00 95", "Address": "1005 Quang Trung, P.14, Q.Gò Vấp, Tp.HCM", "Fanpage": null, "Google": null, "Facebook": null, "Youtube": null, "Twitter": null, "IsBanner": false, "IsFixed": false, "BannerImage": null };
                        window.SupportOnlines = [];
                    </script>
                </div>
                <div class="col-md-9">
                    <div class="breadcrumb clearfix">
                        <ul>
                            <li itemtype="http://shema.org/Breadcrumb" itemscope="" class="home">
                                <a title="Đến trang chủ" href="{{ route('user/index') }}" itemprop="url"><span
                                        itemprop="title">Trang
                                        chủ</span></a>
                            </li>
                            <li class="icon-li"><strong>Liên hệ</strong> </li>
                        </ul>
                    </div>
                    <script type="text/javascript">
                        $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
                    </script>
                    <script
                        src="http://maps.google.com/maps/api/js?key=AIzaSyBO93-_2pxx4UBTNduADxfoWpsFrHAFKsA&amp;sensor=true"
                        type="text/javascript"></script>
                    <script src="{{ asset('user/app/services/contactServices.js') }}"></script>
                    <script src="{{ asset('user/app/controllers/contactController.js')}}"></script>
                    <!--Begin-->
                    <div class="contact-shop contact-content">
                        <div id="layout-page">
                            <div class="header-contact header-page clearfix">
                                <h1>Liên hệ</h1>
                            </div>
                            <div class="content-contact content-page clearfix">
                                <div class="map clearfix">
                                    <div class="map-canvas" id="map_canvas"></div>
                                    <div class="map-information" ng-if="Maps.length>1">
                                        <ul class="clearfix">
                                            <li ng-repeat="item in Maps">
                                                <div>
                                                    <a onclick="; return false;" href="javascript:void(0)">
                                                        Name
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-7" id="col-left contactFormWrapper">
                                    <h3>Viết nhận xét</h3>
                                    <hr class="line-left" />
                                    <p>
                                        Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và chúng tôi
                                        sẽ liên lạc lại với bạn sớm nhất có thể .
                                    </p>
                                    <form class='contact-form'>
                                        <div class="form-group">
                                            <label for="contactFormName" class="sr-only">Tên</label>
                                            <input required type="text" id="contactFormName"
                                                class="form-control input-lg" name="contact[name]"
                                                placeholder="Tên của bạn" autocapitalize="words" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="contactFormEmail" class="sr-only">Email</label>
                                            <input required type="email" name="contact[email]"
                                                placeholder="Email của bạn" id="contactFormEmail"
                                                class="form-control input-lg" autocorrect="off" autocapitalize="off"
                                                value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="contactFormTitle" class="sr-only">Tiêu đề</label>
                                            <input required type="text" id="contactFormTitle"
                                                class="form-control input-lg" name="contact[title]"
                                                placeholder="Tiêu đề" autocapitalize="words" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="contactFormMessage" class="sr-only">Nội dung</label>
                                            <textarea required rows="6" name="contact[body]" class="form-control"
                                                placeholder="Viết bình luận" id="contactFormMessage"></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-lg" value="Gửi liên hệ" />
                                    </form>
                                </div>
                                <div class="col-md-5" id="col-right">
                                    <h3>Chúng tôi ở đây</h3>
                                    <hr class="line-right" />
                                    <h3 class="name-company">PTP STORE</h3>
                                    <p>Mua sắm an toàn - không âu lo</p>
                                    <ul class="info-address">
                                        <li>
                                            <i class="glyphicon glyphicon-map-marker"></i>
                                            <span>65 Đ. Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh
                                                700000</span>
                                        </li>
                                        <li>
                                            <i class="glyphicon glyphicon-envelope"></i>
                                            <span>ptpstore5794@gmail.com</span>
                                        </li>
                                        <li>
                                            <i class="glyphicon glyphicon-phone-alt"></i>
                                            <span>+84 0306 191 4**</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        var map;
                        var infowindow;
                        var marker = new Array();
                        var old_id = 0;
                        var infoWindowArray = new Array();
                        var infowindow_array = new Array();
                        function initialize() {
                            var defaultLatLng = new google.maps.LatLng(10.7716003, 106.700996, 18);

                            var myOptions = { zoom: 16, center: defaultLatLng, scrollwheel: true, mapTypeId: google.maps.MapTypeId.ROADMAP };
                            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                            map.setCenter(defaultLatLng);

                            if (Maps.length <= 0) {
                                var arrLatLng = new google.maps.LatLng(10.7716003, 106.700996, 18);
                                var myHtml = "<div class='map-description'> <strong>" + firstMap.Name + "</strong><br/>Địa chỉ: <span>" + firstMap.Address + "</span><br/>Điện thoại: <span>" + firstMap.Phone + "</span><br/></div>";
                                infoWindowArray[firstMap.Id] = myHtml;
                                loadMarker(arrLatLng, infoWindowArray[firstMap.Id], firstMap.Id);
                            }

                            $.each(Maps, function (index, it) {
                                var arrLatLng = new google.maps.LatLng(it.PosX, it.PosY);
                                var myHtml = "<div class='map-description'> <strong>" + it.Name + "</strong><br/>Địa chỉ: <span>" + it.Address + "</span><br/>Điện thoại: <span>" + it.Phone + "</span><br/></div>";
                                infoWindowArray[it.Id] = myHtml;
                                loadMarker(arrLatLng, infoWindowArray[it.Id], it.Id);
                            });


                            moveToMaker(firstMap.Id);
                        }
                        function loadMarker(myLocation, myInfoWindow, id) {
                            marker[id] = new google.maps.Marker({ position: myLocation, map: map, visible: true });
                            var popup = myInfoWindow;
                            infowindow_array[id] = new google.maps.InfoWindow({ content: popup });
                            google.maps.event.addListener(marker[id], 'click', function () {
                                if (id == old_id) return;
                                if (old_id > 0)
                                    infowindow_array[old_id].close();
                                infowindow_array[id].open(map, marker[id]);
                                old_id = id;
                            });
                            google.maps.event.addListener(infowindow_array[id], 'closeclick', function () { old_id = 0; });
                        }
                        function moveToMaker(id) {
                            var location = marker[id].position;
                            map.setCenter(location);
                            if (old_id > 0)
                                infowindow_array[old_id].close();
                            infowindow_array[id].open(map, marker[id]);
                            old_id = id;
                        }
                    </script>
                    <!--End-->
                    <script type="text/javascript">
                        var firstMap = { "Id": 2198, "ShopId": 0, "Name": "CÔNG TY TNHH THỜI TRANG TRẺ PTPSTORE", "Address": " 65 Đ. Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh 700000", "Phone": "0306 191 4**", "PosX": 10.844895933994351, "PosY": 106.636744831799320, "Index": 0, "Inactive": false };
                        var Maps = [];
                        window.Maps = Maps;
                        window.Shop = { "Name": "CÔNG TY TNHH THỜI TRANG TRẺ PTPSTORE", "Email": "ptpstore5794@gmail.com", "Phone": "(08) 0306 191 4**", "Logo": "/Uploads/shop2198/images/logo2.png", "Fax": "(84) 0306 191 4**", "Website": "http://www.runtime.vn", "Hotline": "0306 191 4**", "Address": " 65 Đ. Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh 700000", "Fanpage": null, "Google": null, "Facebook": null, "Youtube": null, "Twitter": null, "IsBanner": false, "IsFixed": false, "BannerImage": null };
                        $(document).ready(function () {
                            initialize();
                        });
                    </script>
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
@endsection

@section('user/Scripts')
<script type="text/javascript">
    $(".header-content").css({ "background": '' });
    $("html").addClass('');
</script>
@endsection
