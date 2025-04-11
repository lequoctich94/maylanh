@extends('user/layouts')

@section('title','Đánh giá của tôi')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />

<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Đánh giá của tôi" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/profile.css') }}">
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/rate.css') }}">
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
                            <li class="active"><a href="javascript:void(0)"><i class='fa fa-star-o'></i>Đánh giá
                                    của tôi</a></li>
                            <li><a href="{{ route('user/voucher') }}"><i class='fa fa-eraser'></i>Mã khuyến
                                    mãi</a></li>
                            <li><a href="{{ route('user/favourite') }}"><i class='fa fa-heart-o'></i>Danh sách yêu
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
                            <h1>Thông tin sản phẩm đánh giá</h1>
                            @if(empty($rates))
                            <p class="empty-profile">Danh sách trống, vui lòng mua sản phẩm và đánh giá</p>
                            @else
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="rate">
                                        <h4 class="rate-heading">DANH SÁCH SẢN PHẨM ĐÁNH GIÁ</h4>
                                        <div class="rate-border rate-container">
                                            @foreach($rates as $rate)
                                            <div class="rate-body">
                                                <div class="rate-body-img">
                                                    <img src="{{env('APP_URL')}}/upload/products/{{$rate->product_id}}/{{$rate->product->product_img}}"
                                                        alt="rate-images">
                                                </div>
                                                <div class="rate-body-content">
                                                    <div class="rate-body-contentProductName">
                                                        {{$rate->product->product_name}}
                                                    </div>
                                                    <div class="rate-body-contentInfo">
                                                        <span>Phân loại</span>
                                                        <div>: {{$rate->product->category_id}}</div>
                                                    </div>
                                                    <div class="rate-body-contentInfo">
                                                        <span>Số sao</span>
                                                        <div
                                                            class="media-body-star-item d-flex align-items-center flex-row">
                                                            :
                                                            @for($i=$rate->star; $i >1;$i--)
                                                            <i class="fa fa-star rating-color"></i>
                                                            @endfor ({{$rate->like}})
                                                        </div>
                                                    </div>
                                                    <div class="rate-body-contentInfo">
                                                        <span>Số lượng yêu thích</span>
                                                        <div>
                                                            : ({{$rate->like}})
                                                        </div>
                                                    </div>
                                                    <div class="rate-body-contentInfo">
                                                        <span>Nội dung bình luận</span>
                                                        <div>
                                                            : {{$rate->comment}}
                                                        </div>
                                                    </div>
                                                    <div class="rate-body-contentInfo">
                                                        <span>
                                                            Thời gian
                                                        </span>
                                                        <div>: {{$rate->date_rate}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
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
