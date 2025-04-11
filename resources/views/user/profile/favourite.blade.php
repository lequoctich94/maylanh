@extends('user/layouts')

@section('title','Mã khuyến mãi')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />

<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Mã khuyến mãi" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/profile.css') }}">
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/favourite.css') }}">
@endsection

@section('body')
<div class="main">
    <div class="container">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="container bootstrap snippets bootdey">
            <div class="row">
                <div class="profile-nav col-md-3">
                    <div class="panel">
                        <div class="user-heading round">
                            <div id="user-heading">
                                <a href="#">
                                    <img src="{{env('APP_URL')}}/upload/avatar_users/{{$member->user->image}}" alt="">
                                </a>
                                <h1>{{$member->user->full_name}}</h1>
                                <p>{{$member->user->email}}</p>
                            </div>
                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="{{ route('user/profile') }}"> <i class="fa fa-user"></i>Thông
                                    tin cá nhân</a></li>
                            <li><a href="{{ route('user/change-profile') }}"> <i class="fa fa-edit"></i> Chỉnh sửa thông
                                    tin cá nhân</a></li>
                            <li><a href="{{ route('user/change-password') }}"> <i class="fa fa-edit"></i> Cập nhật mật
                                    khẩu</a></li>
                            <li><a href="{{ route('user/rate') }}"><i class='fa fa-star-o'></i>Đánh giá
                                    của tôi</a></li>
                            <li><a href="{{ route('user/voucher') }}"><i class='fa fa-eraser'></i>Mã khuyến
                                    mãi</a></li>
                            <li class="active"><a href="javascript:void(0)"><i class='fa fa-heart-o'></i>Danh sách yêu
                                    thích</a></li>
                            <li><a href="{{ route('user/activity-history') }}"><i class='fa fa-history'></i>Lịch sử hoạt
                                    động</a></li>
                            <li><a href="{{ route('user/rank') }}"><i class='fa fa-history'></i>Điểm hạng thành
                                    viên</a></li>
                            <li><a href="{{ route('user/purchase-history') }}"><i class='fa fa-list-alt'></i>Đơn
                                    mua</a></li>
                        </ul>
                    </div>
                </div>
                <div class="profile-info col-md-9">
                    <div class="panel">
                        <div class="bio-graph-heading"></div>
                        <div class="panel-body bio-graph-info">
                            <h1 class="title-favourite">Thông tin sản phẩm yêu thích</h1>
                            @if(empty($favourites))
                            <p class="empty-profile">Danh sách trống, vui lòng thêm sản phẩm vào danh sách yêu thích</p>
                            @else
                            <div class="list-favourties row">
                                <div class="col-md-12">
                                    <div class="favourite">
                                        <h4 class="favourite-heading">DANH SÁCH SẢN PHẨM YÊU THÍCH</h4>
                                        <div class="favourite-border favourite-container">
                                            @foreach($favourites as $favourity)
                                            <div class="favourite-body" style="position:relative;">
                                                @if($favourity->status ==0)
                                                <div class="productDontActive">
                                                    <div class="productDontActiveBorder">
                                                    </div>
                                                    <div class="productDontActiveName"></div>
                                                </div>
                                                @endif
                                                <div class="favourite-body-img">
                                                    <img src="{{env('APP_URL')}}/upload/products/{{$favourity->product_detail->product_id}}/{{$favourity->product_detail->product->product_img}}"
                                                        alt="favourite-images">
                                                </div>
                                                <div class="favourite-body-content">
                                                    <div class="favourite-body-contentProductName">
                                                        {{$favourity->product_detail->product->product_name}}
                                                    </div>
                                                    <div class="favourite-body-contentInfo">
                                                        <span>Phân loại:</span>
                                                        <p>: {{$favourity->product_detail->product->category->category_name}}
                                                            -
                                                            {{$favourity->product_detail->color->color_name}} -
                                                            {{$favourity->product_detail->size->size_name}}
                                                        </p>
                                                    </div>
                                                    <inp class="favourite-body-contentButton">
                                                        <a href="javascript:void(0)"
                                                            un-like="{{$favourity->product_detail_id}}"
                                                            class="btn-favourite" title="Bỏ yêu thích sản phẩm này"><i
                                                                class="fa fa-heart"></i></a>
                                                        <a href="{{ route('user/product-detail',['product_name' => Str::slug($favourity->product_detail->product->product_name), 'searchID' => $favourity->product_detail->product->product_id])}}"
                                                            class="btn btn-buyNow">Mua ngay</a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('user/app/jquery/favourite.js')}}"></script>
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
