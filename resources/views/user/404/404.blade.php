@extends('user/layouts')

@section('title','404 - Not Found')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="404-Page Not Found" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
@endsection

@section('body')
<div class="container text-center">
    <div class="notFound">
        <img src="{{ asset('user/images/search-not-found.png') }}"
            alt="{{ asset('user/images/search-not-found.png') }}">
        <h1 class="text-danger">
            404<br />
        </h1>
        <h3 class="text-danger">
            OOPS! KHÔNG TÌM THẤY TRANG!
        </h3>
        <span>Xin lỗi, nhưng chúng tôi không tìm thấy.</span>
        <p>Hãy chắc chắn rằng URL bạn nhập không sai.</p>
        <div><a class="btn btn-404backHome" href="{{ route('user/index') }}">ĐI ĐẾN TRANG CHỦ</a></div>
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

@section('script')
<script type="text/javascript">
    $(".header-content").css({ "background": '' });
    $("html").addClass('');
    $(document).ready(function () {
        $("img.lazy-img").each(function () {
            //$(this).attr("data-original", $(this).attr("src"));
            //$(this).attr("src", "/Images/blank.gif");
        });
        $("img.lazy-img").lazyload({
            effect: "fadeIn",
            threshold: 200
        });
    });
</script>
@endsection
