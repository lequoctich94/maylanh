@extends('layouts')

@section('title','Đánh Giá Sản Phẩm')

@section('header')
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Data Table CSS -->
<link href="{{ asset('vendors4/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors4/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet"
    type="text/css" />

<!-- Toggles CSS -->
<link href="{{ asset('vendors4/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('vendors4/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

<!-- Custom CSS -->
<link href="{{ asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item displayFlex"><a href="#">Quản Lý</a></li>
        <li class="breadcrumb-item displayFlex"><a href="{{ route('product-management') }}">Sản Phẩm</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Đánh Giá Sản Phẩm</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                        data-feather="database"></i></span></span>Danh Sách Đánh giá</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="boxShadowSmall card card-lg">
                <h6 class="card-header">
                    Đánh Giá Sản Phẩm
                </h6>
                <div class="card-body mb-2" style="box-shadow: rgba(56, 56, 56, 0.15) 2.4px 2.4px 3.2px;">
                    <div class="d-flex align-items-lg-start justify-content-around">
                        <div
                            style="max-width:30%;border:1px solid rgb(0, 255, 242); box-shadow: 0.5rem 0.5rem rgb(97, 200, 204), -0.5rem -0.5rem rgb(204, 232, 233);">
                            <img src="{{env('APP_URL')}}/upload/products/{{ $product->product_id }}/{{ $product->product_img }}"
                                width="250px" height="250px" alt="{{ $product->product_img }}">
                        </div>
                        <div style="max-width:70%;line-height:45px">
                            <h2>{{ $product->product_name }}</h2>
                            <span>Mô tả: <h5>{{ $product->description }}</h5> </span>
                            <span>Nhà cung cấp: <h6 class="fw-bold text-red">{{ $product->producer->producer_name}}</h6>
                            </span>
                        </div>
                    </div>
                </div>
                <h6 class="card-header">
                    Chi Tiết Đánh Giá
                </h6>
                <div class="card-body">
                    <div class="user-activity">
                        @if($rates != [])
                        @foreach($rates as $rate)
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar avatar-sm">
                                    <img src="{{env('APP_URL')}}/upload/avatar_users/{{ $rate->member->user->image}}"
                                        alt="user" class="avatar-img rounded-circle">
                                </div>
                            </div>
                            <div class="media-body">
                                <div>
                                    <span class="d-block mb-5"><span
                                            class="font-weight-500 text-dark text-capitalize">{{
                                            $rate->member->user->full_name }}</span>
                                        <span class="pl-5">{{ $rate->comment }}</span></span>
                                    <span class="d-block font-13 text-dark d-flex pt-2" style="letter-spacing: 2px">
                                        (
                                        @if($rate->star==1)
                                        <div style="color:rgb(248, 197, 11)" class="d-flex align-items-center flex-row">
                                            <i class="fa fa-star rating-color"></i>
                                        </div>
                                        @elseif($rate->star==2)
                                        <div style="color:rgb(248, 197, 11)" class="d-flex align-items-center flex-row">
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                        </div>
                                        @elseif($rate->star==3)
                                        <div style="color:rgb(248, 197, 11)" class="d-flex align-items-center flex-row">
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                        </div>
                                        @elseif($rate->star==4)
                                        <div style="color:rgb(248, 197, 11)" class="d-flex align-items-center flex-row">
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                        </div>
                                        @else
                                        <div style="color:rgb(248, 197, 11)" class="d-flex align-items-center flex-row">
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                        </div>
                                        @endif
                                        )
                                    </span>
                                    <p class="pt-2">{{ date('d-m-Y', strtotime($rate->date_rate)) }}</p>
                                    <span class="d-inline-flex align-items-center pt-2"
                                        style="padding:5px;border-radius:5px;box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;">{{
                                        $rate->like }}
                                        <p class="pl-1 text-danger"><i class="fa fa-heart"></i></p>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>Không có đánh giá nào.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
</div>
<!-- /Container -->
@endsection

<!-- /HK Wrapper  -->
@section('footer-script')
<script src="{{ asset('vendors4/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('dist/js/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('vendors4/jszip/dist/jszip.min.js')}}"></script>
<script src="{{ asset('vendors4/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('dist/js/dataTables-data.js')}}"></script>
<script src="{{ asset('dist/js/feather.min.js')}}"></script>
<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
<script src="{{ asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
<script src="{{ asset('dist/js/toggle-data.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
@endsection
