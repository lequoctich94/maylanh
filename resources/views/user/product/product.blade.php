@extends('user/layouts')

@section('title','Sản phẩm')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Sản phẩm" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
@endsection

@section('body')
<div id="collection">
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
                            <li class="icon-li product-title"><a title="Trang Sản phẩm"
                                    href="{{ route('user/product') }}">Sản phẩm</a> </li>
                            @if($category_name != null)
                            <li class="title_heading">
                                Tìm kiếm: <span id="showName" searchID="{{$searchID}}"
                                    keyword="{{Str::slug($category_name)}})"
                                    itemprop="title">"{{$category_name}}"</span>
                            </li>
                            @elseif($keyword_search != null)
                            <li class="title_heading">
                                Tìm kiếm: <span id="showName" keyword="{{$keyword_search}}"
                                    itemprop="title">"{{$keyword_search}}"</span>
                            </li>
                            @endif

                        </ul>
                    </div>
                    <script type="text/javascript">
                        $(".link-site-more").hover(function () {
                            $(this).find(".s-c-n").show();
                        }, function () {
                            $(this).find(".s-c-n").hide();
                        });
                    </script>
                    <div class="view-product-list">
                        <h2 class="page-heading">
                            <span class="page-heading-title">Sản phẩm</span>
                        </h2>
                        <div class="browse-tags">
                            <span>Số lượng dòng:</span>
                            <span class="custom-dropdown custom-dropdown--white">
                                <select id="record-on-page" name="lblimit"
                                    class="sort-by custom-dropdown__select custom-dropdown__select--white">
                                    @if($pagination != null)
                                    @for($i=1; $i<=3;$i++) <option value="{{$i*12}}" {{$pagination->recordOnPage ==
                                        $i*12 ? 'selected' : ''}}>{{$i*12}}</option>
                                        @endfor
                                        @endif
                                </select>
                            </span>
                        </div>
                        <!-- PRODUCT LIST -->
                        <div id="pagination-response">
                            <ul class="row product-list grid filter">
                                @if(empty($products))
                                <div class="productList-null">
                                    <div class="productList-nullImage"> <img
                                            src="{{ asset('user/images/searchNull.png') }}"
                                            alt="{{ asset('user/images/searchNull.png') }}"></div>
                                    <p class="productList-nullTitle">Không tìm thấy kết quả nào</p>
                                    <span class="productList-nullDesc">Hãy thử sử dụng các từ khóa chung hơn để dễ tìm
                                        kiếm</span>
                                </div>
                                @else
                                @foreach($products as $product)
                                <li class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="product-container product-resize">
                                        <div class="left-block image-resize">
                                            <a
                                                href="{{ route('user/product-detail',['product_name' => Str::slug($product->product_name), 'searchID' => $product->product_id])}}">
                                                <img class="img-responsive" alt="product"
                                                    src="{{env('APP_URL')}}/upload/products/{{$product->product_id}}/{{$product->product_img}}" />
                                            </a>
                                            <div class="add-to-cart">
                                                <a class="add-to-car"
                                                    href="{{ route('user/product-detail',['product_name' => Str::slug($product->product_name), 'searchID' => $product->product_id])}}">Mua
                                                    Ngay</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a
                                                    href="{{ route('user/product-detail',['product_name' => Str::slug($product->product_name), 'searchID' => $product->product_id])}}">{{$product->product_name}}</a>
                                            </h5>
                                            <span class="date">
                                                <p>Loại Sản Phẩm: {{$product->category->category_name}}</p>
                                            </span>
                                            <span class="comment"><span>Đã bán: </span>{{$product->quantity_pay}}</span>
                                            <div class="content_price">
                                                <span class="price product-price">{{number_format($product->price_pay)}}
                                                    VNĐ</span>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                            @if($pagination != null)
                            <div class="col-md-12 content_sortPagiBar pagi">
                                <div class="clearfix">
                                    <ul class="pagination">
                                        <li class="pagination_previous">
                                            <a href="javascript:void(0)" id="previous" title="Previous &raquo;"
                                                class="{{$pagination->currentPage==1 || $pagination->totalPage == 1 ? 'disable' : ''}}"><i
                                                    class="fa fa-chevron-left"></i></a>
                                        </li>
                                        @for($i=1;$i<=$pagination->totalPage;$i++)
                                            <li value="{{$i}}"
                                                class="{{$i == $pagination->currentPage ? 'active' :''}}"><a
                                                    value="{{$i}}" href="javascript:void(0)"
                                                    id="numberPage"><span>{{$i}}</span></a></li>
                                            @endfor
                                            <li class="pagination_next">
                                                <a href="javascript:void(0)" id="next"
                                                    class="{{$pagination->currentPage == $pagination->totalPage ? 'disable' : ''}}"
                                                    title="Next &raquo;">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- ./PRODUCT LIST -->
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="menu-product">
                        <h3>
                            <span>
                                LOẠI SẢN PHẨM
                            </span>
                        </h3>
                        <ul class='level_0 categoryContent boxShadowSmall' id="category-menu">
                            @foreach($categories as $category)
                            <li>
                                <a searchID="{{$category->category_id}}"
                                    keyword="{{Str::slug($category->category_name)}}" href="javascript:void(0)">
                                    <i class='fa fa-arrow-circle-right'></i>
                                    {{$category->category_name}}
                                </a>
                            </li>
                            @endforeach
                        </ul class='level_0'>
                    </div>
                    <div id="left_column">
                        <div class="block left-module boxShadowSmall">
                            <p class="title_block">Sản phẩm Nổi Bật</p>
                            <div class="block_content bestSellContent">
                                <ul class="products-block best-sell">
                                    @foreach ($product_hots as $product_hot)
                                    <li class="clearfix">
                                        <div class="products-block-left">
                                            <a href="#"><img class="img-responsive"
                                                    alt="{{$product_hot['product_name']}}"
                                                    src="{{env('APP_URL')}}/upload/products/{{$product_hot['product_id']}}/{{$product_hot['product_img']}}" /></a>
                                        </div>
                                        <div class="products-block-right">
                                            <p class="product-name">
                                                <a href="#">{{$product_hot['product_name']}}</a>
                                            </p>
                                            <p class="product-price">
                                                <span class="">{{number_format($product_hot['price_pay'])}} VNĐ</span>
                                            </p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('user/app/pagination.js')}}"></script>
<script type="text/javascript" src="{{ asset('user/app/jquery/product.js')}}"></script>

<script type="text/javascript">
    $(".vertical-menu-content").addClass("no-home");
    $(document).ready(function () {
        //$(".menu-quick-select ul").hide();
        //$(".menu-quick-select").hover(function () { $(".menu-quick-select ul").show(); }, function () { $(".menu-quick-select ul").hide(); });
    });
</script>
@endsection

@section('scripts')
@endsection
