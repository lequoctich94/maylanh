@extends('user/layouts')

@section('title','Trang Chủ')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="PTPSTORE" property="og:title" />
<meta property="og:description" />
<meta content="http://runecom02.ptpstore.vn" property="og:image" />
<meta content="http://runecom02.ptpstore.vn/" property="og:url" />
<meta content="ptpstore" property="og:site_name" />
@endsection

@section('body')
<div class="slideshow">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-9 ">
                <div id="home-slider">
                    <div class="header-top-right">
                        <div class="homeslider">
                            <ul id="contenhomeslider">
                                {{-- @for($i=0; $i < 5; $i++)  --}}
                                <li>
                                    <a href="javascript:void(0);">
                                        <img class="img-responsive" alt=""
                                            src="https://congtytuantruong.com/user/images/banner/1672771882125.png">
                                    </a>
                                    </li>
                                    {{-- @endfor --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(!empty($product_hot_favourites))
                <div class="blog-list news-home">
                    <h2 class="page-heading">
                        <span class="page-heading-title">Danh sách sản phẩm yêu thích</span>
                    </h2>
                    <div class="blog-list-wapper">
                        <ul class="owl-carousel" data-nav="true" data-margin="30" data-autoplayTimeout="1000"
                            data-autoplayHoverPause="true">
                            @foreach($product_hot_favourites as $product_hot_favourity)
                            <li class="product-box-li">
                                <div class="product-box-resize">
                                    <div class="post-thumb image-hover2">
                                        <a
                                            href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_favourity->product_name), 'searchID' => $product_hot_favourity->product_id])}}">
                                            <img src="{{env('APP_URL')}}/upload/products/{{$product_hot_favourity->product_id}}/{{$product_hot_favourity->product_img}}"
                                                alt="{{$product_hot_favourity->product_name}}">
                                        </a>
                                    </div>
                                    <div class="post-desc">
                                        <h5 class="post-title">
                                            <a
                                                href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_favourity->product_name), 'searchID' => $product_hot_favourity->product_id])}}">{{$product_hot_favourity->product_name}}</a>
                                        </h5>
                                        <div class="post-meta">
                                            <span class="date">
                                                Loại: {{$product_hot_favourity->category->category_name}}
                                            </span>
                                            <span
                                                class="favourite">{{$product_hot_favourity->quantity_favourites}}<span>
                                                    Yêu thích</span></span>
                                            <span class="comment"><span>Đã bán:
                                                </span>{{$product_hot_favourity->quantity_pay}}</span>
                                            <span class="price"><span></span
                                                    class="priceNumber">{{number_format($product_hot_favourity->price_pay)}}đ</span>
                                        </div>
                                    </div>
                                    <div class="readmore">
                                        <a
                                            href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_favourity['product_name']), 'searchID' => $product_hot_favourity->product_id])}}">Mua
                                            ngay</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                <div class="content-page">
                    <div class="container">
                        <div class="category-featured featured1">
                            <nav class="navbar nav-menu show-brand">
                                <div class="container">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <div class="navbar-brand"><a href="javascript:void(0);">
                                            <img src="{{ asset('user/images/icon/s5.png') }}" />Bán Chạy</a></div>
                                    <span class="toggle-menu"></span>
                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse">
                                        <ul id="menu-category" class="nav navbar-nav">
                                            <li id="all" class="active">
                                                <a href="javascript:void(0);" style="margin-left:0 !important;">Tất
                                                    cả sản
                                                    phẩm</a>
                                            </li>
                                            @foreach($categories as $category)
                                            <li id="{{$category->category_id}}"><a href='javascript:void(0);'
                                                    style="margin-left:0 !important;"><img width="30px" height="30px"
                                                        src='{{env("APP_URL")}}/upload/categories/{{$category->suffix_img}}' />
                                                    {{$category->category_name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div><!-- /.navbar-collapse -->
                                </div><!-- /.container-fluid -->
                            </nav>
                            <div class="product-featured clearfix">
                                <div class="row">
                                    <div class="col-sm-12 col-right-tab">
                                        <div class="product-featured-tab-content">
                                            <div class="tab-container">
                                                <div class="tab-panel active" id="tab_1">
                                                    <div class="box-left">
                                                        <div class="banner-img">
                                                            <a href="javascript:void(0)">
                                                                <img src="{{ asset('user/images/banner/banner-product1.png') }}"
                                                                    alt="Thời trang">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="box-right">
                                                        <ul id="product-hot-buy" class="product-list">
                                                            @if(empty($product_hot_buys))
                                                            <p>ICON</p>
                                                            <p>Hiện chưa có sản phẩm nào được bán</p>
                                                            @else
                                                            @foreach($product_hot_buys as $product_hot_buy)
                                                            <li class="product-listItem">
                                                                <div class="hotBuys-container">
                                                                    <div class="left-block">
                                                                        <a
                                                                            href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}"><img
                                                                                class="img-responsive" alt="product"
                                                                                src="{{env('APP_URL')}}/upload/products/{{$product_hot_buy->product_id}}/{{$product_hot_buy->product_img}}" /></a>
                                                                        <div class="quick-view">
                                                                            <a title="Add to my wishlist" class="heart"
                                                                                href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}"></a>
                                                                            <a title="Xem chi tiết" class="compare"
                                                                                href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}"></a>
                                                                            <a href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}"
                                                                                class="qv-e-button btn-quickview-1 search"
                                                                                title="Xem nhanh"></a>
                                                                        </div>
                                                                        <div class="add-to-cart">
                                                                            <a class="add-to-car"
                                                                                href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}">Mua
                                                                                ngay</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="right-block">
                                                                        <h5 class="product-name"><a
                                                                                href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}">{{$product_hot_buy->product_name}}</a>
                                                                        </h5>
                                                                        <div class="content_price"><span
                                                                                class="price-numberBuy">(
                                                                                {{$product_hot_buy->quantity_pay}}
                                                                                )<span>
                                                                                    Đã Bán</span></span>
                                                                            <span
                                                                                class="price product-price">{{number_format($product_hot_buy->price_pay)}}đ</span>
                                                                            </br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                            @endif
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

                <!-- All product -->
                @if(!empty($products))
                <div class="blog-list news-home news-homeAll">
                    <h2 class="page-heading">
                        <span class="page-heading-title">Tất cả sản phẩm</span>
                    </h2>
                    <div class="blog-list-wapper productAll">
                        <ul class="productAll-ul">
                            @foreach($products as $product)
                            <li class="product-box-li">
                                <div class="product-box-resize">
                                    <div class="post-thumb image-hoverProduct">
                                        <a class="image-hoverProductA"
                                            href="{{ route('user/product-detail',['product_name' => Str::slug($product->product_name), 'searchID' => $product->product_id])}}">
                                            <img src="{{env('APP_URL')}}/upload/products/{{$product->product_id}}/{{$product->product_img}}"
                                                alt="{{$product->product_name}}">
                                        </a>
                                    </div>
                                    <div class="post-desc">
                                        <h5 class="post-title">
                                            <a
                                                href="{{ route('user/product-detail',['product_name' => Str::slug($product->product_name), 'searchID' => $product->product_id])}}">{{$product->product_name}}</a>
                                        </h5>
                                        <div class="post-meta">
                                            <span class="date">
                                                Loại: {{$product->category->category_name}}
                                            </span>
                                            <span class="comment"><span>Đã bán: </span>{{$product->quantity_pay}}</span>
                                            <span class="price"><span></span
                                                    class="priceNumber">{{number_format($product->price_pay)}}đ</span>
                                            <div class="readmore" style="margin-top:10px;margin-right:10px !important">
                                                <a href="{{ route('user/product-detail',['product_name' => Str::slug($product->product_name), 'searchID' => $product->product_id])}}"
                                                    style="margin-top:20px;">Mua ngay</a>
                                            </div>
                                        </div>
                                    </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu-category li").click(function () {
            var category_id = $(this).attr('id');
            var take = 6;
            $("#menu-category li").removeClass('active');
            $("#menu-category").find("#" + category_id).addClass('active');
            console.log(category_id);
            loadData(category_id, take);
        });

        function loadData(category_id, take) {
            $.ajax({
                type: "get",
                url: "/product-hot-buy-by-category/" + category_id + "/" + take,
                success: function (data) {
                    if (data == '') {
                        data = '<div class="productHotBuy-null">Hiện chưa có sản phẩm được bán</div>'
                    }
                    $('#product-hot-buy >').remove();
                    $('#product-hot-buy').html(data);
                },
                error: function () {
                    showPopup(
                        "Đã xảy ra lỗi",
                        "Cannot request server",
                        "error"
                    );
                },
            });
        }
    });
</script>

@endsection

@section('scripts')
@endsection
