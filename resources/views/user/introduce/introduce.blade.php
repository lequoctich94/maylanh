@extends('user/layouts')

@section('title','Giới thiệu')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Giới thiệu" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
@endsection

@section('body')
<div id="page">
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="menu-about">
                        <h3>
                            <span>
                                Giới thiệu
                            </span>
                        </h3>
                        <ul>
                            <li><a href="{{ route('user/about-us') }}">Về ch&#250;ng t&#244;i</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="breadcrumb clearfix">
                        <ul>
                            <li itemtype="http://shema.org/Breadcrumb" itemscope="" class="home">
                                <a title="Đến trang chủ" href="{{ route('user/index')}}" itemprop="url"><span
                                        itemprop="title">Trang
                                        chủ</span></a>
                            </li>
                            <li class="icon-li"><strong>Giới thiệu</strong> </li>
                        </ul>
                    </div>
                    <script type="text/javascript">
                        $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
                    </script>
                    <div id="layout-page">
                        <div class="header-page clearfix">
                            <h1>Giới thiệu</h1>
                        </div>
                        <div class="content-page">
                            <div>
                                <div>
                                    <div>
                                        <p>Trang giới thiệu giúp bạn có thể hiểu rõ hơn về shop chúng tôi.</p>
                                        <p>Shop chuyên cung cấp các mẫu thời trang phù hợp với mọi lứa tuổi như:</p>
                                        <p>Giày, Dép, Quần Áo, Thiết Bị Linh Kiện Điện Tử, Nón,...</p>
                                        <br>
                                        <p>Một số thông tin về <em
                                                title="CÔNG TY TNHH THỜI TRANG TRẺ PTPSTORE">PTPSTORE</em></p>
                                        <div>
                                            <ul>
                                                <li>Là một cửa hàng thời trang trẻ</li>
                                                <li>Chuyên cung cấp các mẫu thời trang đủ các loại</li>
                                                <li>Cửa hàng tại <em>65 Đ. Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Thành
                                                        phố Hồ
                                                        Chí Minh 700000</em>
                                                </li>
                                                <li>Hoạt động vào tháng 4 năm 2022</li>
                                                <li>Hơn một năm kinh doanh online</li>
                                                <li>Đội ngũ cừa hàng: <em title="Phạm Tấn Tài">T.TAFI</em> | <em
                                                        title="Trần Minh Phường">MP.K57</em></li>
                                                <li>Xem thêm thông tin liên hệ <a href="{{ route('user/contact') }}"
                                                        title="Liên hệ"><em>tại
                                                            đây</em></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
@endsection

@section('scripts')
<script type="text/javascript">
    $(".header-content").css({ "background": '' });
    $("html").addClass('');
</script>
@endsection
