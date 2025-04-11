@extends('user/layouts')

@section('title','Lịch sử hoạt động')

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
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/activity_history.css') }}">
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
                            <li class="active"><a href="javascript:void(0)"><i class='fa fa-history'></i>Lịch sử hoạt
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
                            <h1>Thông tin lịch sử hoạt động</h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="activityHistory wrapper-tab-section">
                                        <h4 class="activityHistory-heading">DANH SÁCH LỊCH SỬ HOẠT ĐỘNG</h4>
                                        <div class="tabs">
                                            <!-- Tab search -->
                                            <div class="tab">
                                                <input type="radio" name="css-tabs" id="tab-1"
                                                    class="tab-switch tab-search" {{$tabActive==1 ? 'checked' : '' }}>
                                                <label for="tab-1" class="tab-label">Tìm kiếm</label>
                                                <div class="tab-content">
                                                    @if(empty($activitySearchs))
                                                    <div class="tab-content-none">
                                                        Danh sách trống
                                                    </div>
                                                    @else
                                                    <div class="activityHistory-body activityHistory-container">
                                                        @php
                                                        $stt = 1;
                                                        @endphp
                                                        @foreach($activitySearchs as $activitySearch)
                                                        <div class="activityHistory-body-content">
                                                            <div class="activityHistory-body-contentSTT">{{$stt++}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDescription">
                                                                {{$activitySearch->activity}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDate">
                                                                <span>
                                                                    Thời gian
                                                                </span>
                                                                <p>: {{$activitySearch->date_created}}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Tab rate -->
                                            <div class="tab">
                                                <input type="radio" name="css-tabs" id="tab-2"
                                                    class="tab-switch tab-rate" {{$tabActive==2 ? 'checked' : '' }}>
                                                <label for="tab-2" class="tab-label">Tương tác và đánh giá</label>
                                                <div class="tab-content">
                                                    @if(empty($activityRates))
                                                    <div class="tab-content-none">
                                                        Danh sách trống
                                                    </div>
                                                    @else
                                                    <div class="activityHistory-body activityHistory-container">
                                                        @php
                                                        $stt = 1;
                                                        @endphp
                                                        @foreach($activityRates as $activityRate)
                                                        <div class="activityHistory-body-content">
                                                            <div class="activityHistory-body-contentSTT">{{$stt++}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDescription">
                                                                {{$activityRate->activity}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDate">
                                                                <span>
                                                                    Thời gian
                                                                </span>
                                                                <p>: {{$activityRate->date_created}}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Tab cart -->
                                            <div class="tab">
                                                <input type="radio" name="css-tabs" id="tab-3"
                                                    class="tab-switch tab-cart" {{$tabActive==3 ? 'checked' : '' }}>
                                                <label for="tab-3" class="tab-label">Giỏ hàng</label>
                                                <div class="tab-content">
                                                    @if(empty($activityCarts))
                                                    <div class="tab-content-none">
                                                        Danh sách trống
                                                    </div>
                                                    @else
                                                    <div class="activityHistory-body activityHistory-container">
                                                        @php
                                                        $stt = 1;
                                                        @endphp
                                                        @foreach($activityCarts as $activityCart)
                                                        <div class="activityHistory-body-content">
                                                            <div class="activityHistory-body-contentSTT">{{$stt++}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDescription">
                                                                {{$activityCart->activity}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDate">
                                                                <span>
                                                                    Thời gian
                                                                </span>
                                                                <p>: {{$activityCart->date_created}}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Tab favourite-->
                                            <div class="tab">
                                                <input type="radio" name="css-tabs" id="tab-4"
                                                    class="tab-switch tab-favourite" {{$tabActive==4 ? 'checked' : ''
                                                    }}>
                                                <label for="tab-4" class="tab-label">Yêu thích</label>
                                                <div class="tab-content">
                                                    @if(empty($activityFavourites))
                                                    <div class="tab-content-none">
                                                        Danh sách trống
                                                    </div>
                                                    @else
                                                    <div class="activityHistory-body activityHistory-container">
                                                        @php
                                                        $stt = 1;
                                                        @endphp
                                                        @foreach($activityFavourites as $activityFavourite)
                                                        <div class="activityHistory-body-content">
                                                            <div class="activityHistory-body-contentSTT">{{$stt++}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDescription">
                                                                {{$activityFavourite->activity}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDate">
                                                                <span>
                                                                    Thời gian
                                                                </span>
                                                                <p>: {{$activityFavourite->date_created}}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Tab order -->
                                            <div class="tab">
                                                <input type="radio" name="css-tabs" id="tab-5"
                                                    class="tab-switch tab-order" {{$tabActive==5 ? 'checked' : '' }}>
                                                <label for="tab-5" class="tab-label">Thanh toán hoá đơn</label>
                                                <div class="tab-content">
                                                    @if(empty($activityOrders))
                                                    <div class="tab-content-none">
                                                        Danh sách trống
                                                    </div>
                                                    @else
                                                    <div class="activityHistory-body activityHistory-container">
                                                        @php
                                                        $stt = 1;
                                                        @endphp
                                                        @foreach($activityOrders as $activityOrder)
                                                        <div class="activityHistory-body-content">
                                                            <div class="activityHistory-body-contentSTT">{{$stt++}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDescription">
                                                                {{$activityOrder->activity}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDate">
                                                                <span>
                                                                    Thời gian
                                                                </span>
                                                                <p>: {{$activityOrder->date_created}}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Tab activity -->
                                            <div class="tab">
                                                <input type="radio" name="css-tabs" id="tab-6"
                                                    class="tab-switch tab-activity" {{$tabActive==6 ? 'checked' : '' }}>
                                                <label for="tab-6" class="tab-label">Phiên hoạt động</label>
                                                <div class="tab-content">
                                                    @if(empty($activitySessions))
                                                    <div class="tab-content-none">
                                                        Danh sách trống
                                                    </div>
                                                    @else
                                                    <div class="activityHistory-body activityHistory-container">
                                                        @php
                                                        $stt = 1;
                                                        @endphp
                                                        @foreach($activitySessions as $activitySession)
                                                        <div class="activityHistory-body-content">
                                                            <div class="activityHistory-body-contentSTT">{{$stt++}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDescription">
                                                                {{$activitySession->activity}}
                                                            </div>
                                                            <div class="activityHistory-body-contentDate">
                                                                <span>
                                                                    Thời gian
                                                                </span>
                                                                <p>: {{$activitySession->date_created}}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
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
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('user/app/pagination.js')}}"></script>
<script type="text/javascript" src="{{ asset('user/app/jquery/activity_history.js')}}"></script>
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
