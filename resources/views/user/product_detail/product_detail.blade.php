@extends('user/layouts')

@section('title','Chi Tiết Sản phẩm')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta content="Chi tiết sản phẩm" name="description" />
<meta content="Chi tiết sản phẩm" name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Chi tiết sản phẩm" property="og:title" />
<meta content="Chi tiết sản phẩm" property="og:description" />
<meta content="ptpstore" property="og:site_name" />

<link rel="stylesheet" href="{{ asset('user/product_detail/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/owl.theme.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/meanmenu.min.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/lib/css/nivo-slider.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/lib/css/preview.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/magic.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/style.css') }}">
<link rel="stylesheet" href="{{ asset('user/product_detail/css/responsive.css') }}">
<script src="{{ asset('user/product_detail/js/vendor/modernizr-2.8.3.min.js') }}"></script>
@endsection

@section('body')
@if(!empty($stock_detail))
<div id="product">
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="breadcrumb clearfix w-80">
                        <ul>
                            <li class="home">
                                <a title="Đến trang chủ" href="{{ route('user/index') }}"><span i>Trang chủ</span></a>
                            </li>
                            <li class="icon-li">
                                <div class="link-site-more">
                                    <a title="{{$stock_detail->product_detail->product->category->category_name}}"
                                        href="{{ route('user/product') }}">
                                        <span>{{$stock_detail->product_detail->product->category->category_name}}</span>
                                    </a>
                                </div>
                            </li>
                            <li class="icon-li">
                                <div class="link-site-more">
                                    <a title="{{$stock_detail->product_detail->product->product_name}}"
                                        href="{{ route('user/product') }}">
                                        <span
                                            class="link-site-more-productName">{{$stock_detail->product_detail->product->product_name}}</span>
                                    </a>
                                </div>
                            </li>
                            <li class="productname icon-li"><strong>Chi tiết sản phẩm</strong> </li>
                        </ul>
                    </div>
                    <!-- single product details start -->
                    <div class="single-product-details">
                        <div class="container single-product-details-container">
                            <div class="row">
                                <div class="col-sm-6" style="overflow:hidden !important;padding-right:0;">
                                    <p style="display:none">{{ $i=0 }}</p>
                                    <div class="single-product-img tab-content">
                                        @foreach($images as $image)
                                        <div class="single-pro-main-image tab-pane {{$stock_detail->product_detail->product->product_img == $image->img_name ? 'active' : ''}}"
                                            id="product-detail-image-{{ $i++ }}">
                                            <a href="javascript:void(0)"><img class="optima_zoom"
                                                    style="position:absolute"
                                                    src="{{env('APP_URL')}}/upload/products/{{$image->product_id}}/{{$image->img_name}}"
                                                    data-zoom-image="{{env('APP_URL')}}/upload/products/{{$image->product_id}}/{{$image->img_name}}"
                                                    alt="optima" /></a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <p style="display:none">{{ $i=0 }}</p>
                                    <div class="product-page-slider">
                                        @foreach($images as $image)
                                        <div class="single-product-slider">
                                            <a href="#product-detail-image-{{ $i++ }}" data-toggle="tab">
                                                <img src="{{env('APP_URL')}}/upload/products/{{$image->product_id}}/{{$image->img_name}}"
                                                    alt="{{$image->product->product_name}}">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="single-product-details">
                                        <h3 class="product-name">
                                            {{$stock_detail->product_detail->product->product_name}}
                                            {{-- {{dd($stock_detail->sale_off)}} --}}
                                            @if($stock_detail->sale_off != 0.0)
                                                <img src="{{asset("images/sale-tag.png")}}" width="30">
                                            @endif
                                        </h3>
                                        <div class="list-product-info">
                                            <div class="price-rating">
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>(<span
                                                        class="avg_star">{{number_format($stock_detail->avg_star,1)}}</span>)
                                                </div>
                                            </div>
                                            <div class=" price-rating">
                                                <div class="ratings">
                                                    <a href="javascript:void(0)" class="review">Đánh giá:<span
                                                            class="quantity_rate">{{$stock_detail->quantity_rate}}</span></a>
                                                </div>
                                            </div>
                                            <div class="price-rating">
                                                <div class="ratings">
                                                    <p class="review">Đã bán:<span
                                                            class="quantity_pay">{{$stock_detail->quantity_pay}}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" available">
                                            <p>Số lượng tồn: <span id="quantity-into-stock">Vui lòng chọn chi
                                                    tiết
                                                    để xem thông tin</span></p>
                                        </div>
                                        <div class="item-price">
                                            <input hidden name="price_pay" value="{{$stock_detail->price_pay}}">
                                            @if($stock_detail->sale_off != 0)
                                            <p> <del style="font-size: 18px ">{{number_format($stock_detail->price_pay)}}</del> {{number_format($stock_detail->price_pay - $stock_detail->price_pay * $stock_detail->sale_off)}} VNĐ <span>( - {{$stock_detail->sale_off*100}}%)</span></p>
                                            @else
                                            <p>{{number_format($stock_detail->price_pay)}}</p>
                                            @endif
                                        </div>
                                        <div class="action">
                                            <ul class="add-to-links">
                                                <li id="status-favourite"
                                                    status-login="{{!empty($member) ? 'true' : 'false'}}">Thêm vào danh
                                                    sách sản phẩm yêu thích:
                                                    @if(!empty($isFavourity) && $isFavourity)
                                                    <a href="javascript:void(0)"
                                                        un-like="{{$stock_detail->product_detail_id}}"
                                                        title="Đã yêu thích sản phẩm"><i class="fa fa-heart"
                                                            style="color:#e03550;"></i></a>
                                                    @else
                                                    <a href="javascript:void(0)"
                                                        like="{{$stock_detail->product_detail_id}}"
                                                        title="Chưa yêu thích sản phẩm"><i class="fa fa-heart"
                                                            style="color:rgb(223, 223, 223);"></i>
                                                    </a>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="select-catagory">
                                            <div class="color-select color-select-body">
                                                <label class="required">
                                                    <em title="Bắt buộc lựa chọn">*</em> Màu sắc:
                                                </label>
                                                <div class="color-selectContainer">
                                                    <!-- color-selectItem-active -->
                                                    @foreach($colors as $color)
                                                    <button type="button" color_id="{{$color->color_id}}"
                                                        class="color-selectItem">
                                                        {{$color->color_name}}
                                                    </button>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="size-select size-select-body">
                                                <label class="required">
                                                    <em title="Bắt buộc lựa chọn">*</em> Kích thước:</br>
                                                </label>
                                                <div class="size-selectContainer">
                                                    <!-- size-selectItem-active -->
                                                    @foreach($sizes as $size)
                                                    <button type="button" size_id="{{$size->size_id}}"
                                                        class="size-selectItem">
                                                        {{$size->size_name}}
                                                    </button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-item">
                                            <div class="single-cart">
                                                <div class="single-cart-quantity">
                                                    <label>Số lượng:</label>
                                                    <div class="quantity">
                                                        <input name="quantity-buy" pattern="[1-9]{2}" type="number"
                                                            min="1" max="99" maxlength="2" step="1" value="1">
                                                    </div>
                                                </div>
                                                <div class="single-cart-groupButton">
                                                    <button type="button" id="add-product-to-cart"
                                                        status-login="{{!empty($member) ? 'true' : 'false'}}"
                                                        class="cart-btn cart-add-toCart">Thêm vào giỏ hàng</button>
                                                    <button type="button" id="buy-product"
                                                        status-login="{{!empty($member) ? 'true' : 'false'}}"
                                                        class="cart-btn cart-buy-now">Mua
                                                        Ngay</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single product details end -->
                    <!-- single product tab start -->
                    <div class="single-product-tab-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="single-product-tab">
                                        <ul class="single-product-tab-navigation" role="tablist">
                                            <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1"
                                                    role="tab" data-toggle="tab">Mô tả sản
                                                    phẩm</a></li>
                                            <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab2"
                                                    data-toggle="tab">Đánh giá</a></li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content single-product-page">
                                            <div role="tabpanel" class="tab-pane fade in active" id="tab1">
                                                <div class="single-p-tab-content">
                                                    <div class="infor-description">
                                                        <p>Sản phẩm được chọn lọc từ <span
                                                                title="CÔNG TY TNHH THỜI TRANG PTPSTORE">PTPSTORE</span>
                                                        </p>
                                                    </div>
                                                    <div class="infor-description">
                                                        <p>{{$stock_detail->product_detail->product->description}}
                                                        </p>
                                                    </div>
                                                    <div class="infor-description">
                                                        <p>Nhà cung cấp:<span>
                                                                {{$stock_detail->product_detail->product->producer->producer_name}}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="tab2">
                                                <div class="single-p-tab-content">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="rate-product hidden-xs">
                                                                @if(!empty($rates))
                                                                @foreach($rates as $rate)
                                                                <div class="media">
                                                                    <div class="media-img-wrap">
                                                                        <div class="avatar avatar-sm">
                                                                            <img src="{{env('APP_URL')}}/upload/avatar_users/{{ $rate->member->user->image}}"
                                                                                alt="user"
                                                                                class="avatar-img rounded-circle">
                                                                        </div>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <span class="media-body-top d-block mb-5">
                                                                            <span
                                                                                class="font-weight-600 text-dark text-capitalize"
                                                                                style="font-weight:bold">{{
                                                                                $rate->member->user->full_name
                                                                                }}
                                                                            </span>
                                                                            <span class="pl-5">{{ $rate->comment
                                                                                }}
                                                                            </span>
                                                                        </span>
                                                                        <span
                                                                            class="d-block media-body-star font-13 text-dark d-flex pt-2"
                                                                            style="letter-spacing: 2px">
                                                                            (<div
                                                                                class="media-body-star-item d-flex align-items-center flex-row">
                                                                                @for($i=$rate->star; $i>0; $i--)
                                                                                <i class="fa fa-star rating-color"></i>
                                                                                @endfor
                                                                            </div>)
                                                                        </span>
                                                                        <p class="pt-3">Bình luận vào ngày: <em>{{
                                                                                date('d-m-Y',
                                                                                strtotime($rate->date_rate)) }}</em>
                                                                        </p>
                                                                        <div class="d-flex align-items-center pt-2"
                                                                            style="display:flex;">
                                                                            Số lượng yêu thích bình luận:
                                                                            <div class="pl-3 text-danger"
                                                                                style="display:flex;
                                                                                justify-content:center;height:50px;width:50px;margin-left:5px;position:relative;font-size:20px;color:rgb(218, 44, 44); border-radius:5px;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                                                                <i class="fa fa-heart"></i>
                                                                                <p class="media-like">{{ $rate->like
                                                                                    }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                                @else
                                                                <p style="font-size:16px;color:rgb(156, 156, 156);">
                                                                    Không có đánh giá
                                                                    nào.</p>
                                                                @endif
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
                    <!-- single product tab end -->
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<script type="text/javascript" src="{{ asset('user/app/validation.js')}}"></script>
<script type="text/javascript" src="{{ asset('user/app/ajaxCommon.js')}}"></script>
<script type="text/javascript" src="{{ asset('user/app/jquery/product_detail.js')}}"></script>
<script type="text/javascript">
    $(".vertical-menu-content").addClass("no-home");
    $(document).ready(function () {
        //$(".menu-quick-select ul").hide();
        //$(".menu-quick-select").hover(function () { $(".menu-quick-select ul").show(); }, function () { $(".menu-quick-select ul").hide(); });
    });
</script>

<script src="{{ asset('user/product_detail/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('user/product_detail/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('user/product_detail/js/wow.min.js') }}"></script>
<script src="{{ asset('user/product_detail/js/jquery-price-slider.js') }}"></script>
<script src="{{ asset('user/product_detail/lib/js/jquery.nivo.slider.js') }}"></script>
<script src="{{ asset('user/product_detail/lib/home.js') }}"></script>
<script src="{{ asset('user/product_detail/js/jquery.meanmenu.js') }}"></script>
<script src="{{ asset('user/product_detail/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('user/product_detail/js/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('user/product_detail/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('user/product_detail/js/plugins.js') }}"></script>
<script src="{{ asset('user/product_detail/js/main.js') }}"></script>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".header-content").css({
        "background": ''
    });
    $("html").addClass('');
</script>
@endsection
