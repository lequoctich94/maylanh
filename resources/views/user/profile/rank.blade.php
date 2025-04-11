@extends('user/layouts')

@section('title','Điểm hạng thành viên')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />

<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Điểm hạng thành viên" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/profile.css') }}">
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/rank.css') }}">
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
                            <li><a href="{{ route('user/voucher') }}"><i class='fa fa-eraser'></i>Mã
                                    khuyến
                                    mãi</a></li>
                            <li><a href="{{ route('user/favourite') }}"><i class='fa fa-heart-o'></i>Danh sách yêu
                                    thích</a></li>
                            <li><a href="{{ route('user/activity-history') }}"><i class='fa fa-history'></i>Lịch sử hoạt
                                    động</a></li>
                            <li class="active"><a href="javascript:void(0)"><i class='fa fa-history'></i>Điểm hạng thành
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
                            <h1>Thông tin điểm hạng thành viên</h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="rank wrapper-tab-section">
                                        <div class="rank-point rank-point-container">
                                            <div class="rank-point-content">
                                                <div class="rank-point-contentBox">
                                                    <div class="rank-point-contentImg">
                                                        <img src="{{env('APP_URL')}}/upload/avatar_users/{{$member->user->image}}"
                                                            alt="{{$member->user->full_name}}"
                                                            title="{{$member->user->full_name}}">
                                                    </div>
                                                    <div class="rank-point-contentID">
                                                        {{$member->member_id}}
                                                    </div>
                                                    <div class="rank-point-contentRankName">
                                                        {{$member->user->full_name}}
                                                    </div>
                                                </div>
                                                <div class="rank-point-contentPointAccumulation">
                                                    <div class="rank-point-contentPointAccumulationS">
                                                        {{$member->rank->point}}
                                                    </div>
                                                    @if(!empty($next_rank))
                                                    <input type="range" min="{{$member->rank->point}}"
                                                        max="{{$next_rank->point}}"
                                                        value="{{$member->current_point}}" />
                                                    <div class="rank-point-contentPointAccumulationE">
                                                        {{$next_rank->point}}
                                                    </div>
                                                    @else
                                                    <input type="range" min="{{$member->rank->point}}"
                                                        max="{{$member->current_point}}"
                                                        value="{{$member->current_point}}" />
                                                    <div class="rank-point-contentPointAccumulationE">
                                                        {{$member->current_point}}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="rank-point-contentBottomBox">
                                                    <div class="rank-point-contentCurrentPoint">
                                                        {{$member->rank->rank_name}}
                                                    </div>
                                                    @if(!empty($next_rank))
                                                    <div class="rank-point-contentCurrentPoint">
                                                        {{$next_rank->rank_name}}
                                                    </div>
                                                </div>
                                                {{-- {{dd($member)}} --}}
                                                <div class="rank-point-contentCurrentPointBoxCenter">
                                                    <div class="rank-point-contentCurrentPointCenter">
                                                        Điểm hiện tại {{$member->current_point}}
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @if(empty($ranks))
                                        <p>Danh sách trống</p>
                                        @else
                                        <div class="tabs">
                                            @php
                                            $index = 0
                                            @endphp
                                            @foreach($ranks as $rank)
                                            <div class="tab">
                                                <input type="radio" name="css-tabs" id="tab-{{++$index}}" {{$index==1
                                                    ? 'checked' : '' }} class="tab-switch">
                                                <label for="tab-{{$index}}"
                                                    class="tab-label">{{$rank->rank_name}}</label>
                                                <div class="tab-content">
                                                    {{-- {{dd($rank)}} --}}
                                                    @if($rank->discount_categories->isEmpty())
                                                    <div class="tab-content-none">
                                                        Danh sách trống
                                                    </div>
                                                    @else
                                                    <div class="rank-body rank-container">
                                                        @foreach($rank->discount_categories as $discount)
                                                        <div class="rank-body-content">
                                                            <div class="rank-body-contentImg"><img
                                                                    src="{{ asset('user/static.ptpstore/PTPSTOREV2/images/voucher.jpg') }}"
                                                                    alt="voucher-images">
                                                            </div>
                                                            <div class="rank-body-contentTitle">
                                                                Ưu đãi giảm giá loại
                                                                <em>{{$discount->category->category_name}}</em>
                                                            </div>
                                                            <div class="rank-body-contentSubTitle">
                                                                Giảm giá {{$discount->percent_price * 100}}%
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                            <!-- <div class="tab">
                                                <input type="radio" name="css-tabs" id="tab-1" checked
                                                    class="tab-switch">
                                                <label for="tab-1" class="tab-label">Đồng</label>
                                                <div class="tab-content">
                                                    <div class="rank-body rank-container">
                                                        <div class="rank-body-content">
                                                            <div class="rank-body-contentImg"><img
                                                                    src="{{ asset('user/static.ptpstore/PTPSTOREV2/images/voucher.jpg') }}"
                                                                    alt="voucher-images"></div>
                                                            <div class="rank-body-contentTitle">
                                                                Ưu đãi giảm giá loại <em>Giày</em>
                                                            </div>
                                                            <div class="rank-body-contentSubTitle">
                                                                Giảm giá 30% tối đa 30.000đ
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
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
