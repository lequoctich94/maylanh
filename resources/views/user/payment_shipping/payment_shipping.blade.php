@extends('user/layouts')

@section('title','Thanh Toán Vận Chuyển')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Thanh to&#225;n v&#224; vận chuyển" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/payment_shipping.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection

@section('body')
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="breadcrumb clearfix">
                    <ul>
                        <li itemtype="http://shema.org/Breadcrumb" itemscope="" class="home">
                            <a title="Đến trang chủ" href="{{ route('user/index') }}" itemprop="url"><span
                                    itemprop="title">Trang
                                    chủ</span></a>
                        </li>
                        <li class="icon-li"><strong>Thanh toán</strong> </li>
                    </ul>
                </div>
                <div class="payment-content">
                    <h1 class="page-heading"><span>Thanh toán</span></h1>
                    <div class="steps clearfix">
                        <ul class="clearfix">
                            <li
                                class="cart active col-md-2 col-xs-12 col-sm-4 col-md-offset-3 col-sm-offset-0 col-xs-offset-0">
                                <span><i class="glyphicon glyphicon-shopping-cart"></i></span><span>Giỏ hàng của
                                    tôi</span><span class="step-number"><a>1</a></span>
                            </li>
                            <li class="payment active col-md-2 col-xs-12 col-sm-4"><span><i
                                        class="glyphicon glyphicon-usd"></i></span><span>Thanh toán</span><span
                                    class="step-number"><a>2</a></span></li>
                            <li class="finish col-md-2 col-xs-12 col-sm-4"><span><i
                                        class="glyphicon glyphicon-ok"></i></span><span>Hoàn tất</span><span
                                    class="step-number"><a>3</a></span></li>
                        </ul>
                    </div>
                    <form class="payment-block clearfix">
                        <div class="col-md-6 col-sm-12 col-xs-12 payment-step step2">
                            <h4>1. Địa chỉ thanh toán và giao hàng</h4>
                            <div class="step-preview clearfix">
                                <h2 class="title">Thông tin thanh toán</h2>
                                <div class="info-user">
                                    <label>Người đặt hàng:<span>{{$member->user->full_name}}</span> </label>
                                    <div class="info-user-group">
                                        <p>Tên người nhận:</p>
                                        <span><input name="nameRecipient" type="text"
                                                value="{{$member->user->full_name}}">
                                        </span>
                                    </div>
                                    <div class="info-user-group">
                                        <p>Sđt người nhận:</p>
                                        <span><input name="phoneRecipient" type="text"
                                                value="{{$member->user->phone}}"></span>
                                    </div>
                                    <label>Email:<span>{{$member->user->email}}</span></label>
                                    <label>Địa chỉ:<span
                                            address="{{$member->user->address}}">{{$member->user->address}}</span></label>
                                    <label style="display:flex;align-items:center;">
                                        <p style="padding-bottom:20px;">Hình thức thanh toán:</p>
                                        <span>
                                            <div class="custom-select" style="width:280px;">
                                                <select id="" style="font-size:14px !important;">
                                                    <option value="1" default>Thanh toán bằng tiền mặt</option>
                                                    <option value="2" disabled>Thanh toán bằng Zalo Pay</option>
                                                </select>
                                                </select>
                                            </div>
                                        </span>
                                    </label>
                                    <button type="button" class="btn btn-chooseAddress" data-toggle="modal">Địa chỉ giao
                                        hàng</button>
                                    <button type="button" class="btn btn-addAddress" data-target="#addAddress"
                                        data-toggle="modal">Thêm địa chỉ
                                        mới</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 payment-step step1">
                            <h4>2. Thông tin đơn hàng</h4>
                            <div class="step-preview">
                                <div class="cart-info">
                                    <div class="cart-items">
                                        @php
                                        $totalAllPricePay = 0;
                                        $totalAllPriceDiscount = 0;
                                        $totalPriceDiscount=0;
                                        @endphp
                                        @foreach($carts as $cart)
                                        <div class="cart-item clearfix">
                                            <span class="image pull-left" style="margin-right:10px;">
                                                <img src="{{env('APP_URL')}}/upload/products/{{$cart->product_detail->product_id}}/{{$cart->product_detail->product->product_img}}"
                                                    class="img-responsive" />
                                            </span>
                                            <div class="product-info pull-left">
                                                <div class="product-name">
                                                    {{$cart->product_detail->product->product_name}}
                                                    x <span>{{$cart->quantity}}</span>
                                                </div>
                                                <div class="note">
                                                    <span>Loại:
                                                        <label>{{$cart->product_detail->product->category->category_name}}</label></span>
                                                    <span>Chi Tiết: <label>{{$cart->product_detail->color->color_name}}
                                                            -
                                                            {{$cart->product_detail->size->size_name}}</label></span>
                                                    @if(!empty($discount_map) &&
                                                    $discount_map->contains('category_id',$cart->product_detail->product->category_id))
                                                    <span>Ưu đãi hạng:
                                                        <label>{{number_format($cart->price_pay
                                                            *
                                                            $discount_map[$cart->product_detail->product->category_id]->percent_price)}}đ
                                                            ({{$discount_map[$cart->product_detail->product->category_id]->percent_price
                                                            * 100}}%)
                                                            /1 SP</label></span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if( !empty($discount_map) &&
                                            $discount_map->contains('category_id',$cart->product_detail->product->category_id))
                                            @php
                                            $pricePay = $cart->price_pay * $cart->quantity;
                                            $discount =
                                            $discount_map[$cart->product_detail->product->category_id]->percent_price*$pricePay;
                                            $totalPriceDiscount += $discount;
                                            $priceDiscount = $pricePay - $discount;
                                            $totalAllPriceDiscount += $priceDiscount;
                                            $totalAllPricePay += $pricePay;
                                            @endphp
                                            <div class="price-group">
                                                <span class="price price-discount">{{
                                                    number_format($pricePay)}}₫</span>
                                                <span class="price price-default">
                                                    {{number_format($priceDiscount)}}₫</span>
                                            </div>
                                            @else
                                            @php
                                            $pricePay = $cart->price_pay * $cart->quantity;
                                            $totalAllPriceDiscount += $pricePay;
                                            $totalAllPricePay += $pricePay;
                                            @endphp
                                            <span class="price">{{number_format($pricePay)}}₫</span>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="total-price">
                                        Tổng Tiền <label class="total-price-label"> {{number_format($totalAllPricePay)}}
                                            ₫</label>
                                    </div>
                                    @if(!is_null($voucher))
                                    <div class="total-price">
                                        Mã khuyến mãi: {{$voucher['voucher_id']}} <label><i
                                                class="fa fa-info-circle info-detail"
                                                title="Đã áp dụng mã khuyến mãi giảm tối đa {{number_format($voucher['value_voucher'])}}đ"
                                                aria-hidden="true"></i> -
                                            {{number_format($voucher['value_voucher'])}} ₫</label>
                                    </div>
                                    @endif
                                    <div class="total-price">
                                        Ưu Đãi Hạng <label><i class="fa fa-info-circle info-detail"
                                                title="Áp dụng mã khuyến mãi theo loại dựa trên hạng hiện có"
                                                aria-hidden="true"></i> -{{number_format($totalPriceDiscount)}}
                                            ₫</label>
                                    </div>
                                    <div class="total-payment" total-payment="{{ !is_null($voucher) ? $totalAllPriceDiscount-
                                            $voucher['value_voucher'] : $totalAllPriceDiscount }}">
                                        Thành Tiền <span>
                                            {{ !is_null($voucher) ? number_format($totalAllPriceDiscount-
                                            $voucher['value_voucher']) : number_format($totalAllPriceDiscount) }}
                                            ₫</span>
                                    </div>
                                    <div class="group-butotn-step">
                                        <div class="button-backCart">
                                            <button class="btn btn-backCart" type="button">Quay lại giỏ hàng</button>
                                        </div>
                                        <div class="button-submit">
                                            <button class="btn btn-order" type="button">Đặt hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal fade" id="chooseAddress" tabindex="-1" role="dialog"
                        aria-labelledby="chooseAddress" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                        aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="chooseAddress">Địa chỉ giao hàng</h4>
                                </div>
                                <div class="modal-body list-address">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-close" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="addAddress" tabindex="-1" role="dialog" aria-labelledby="addAddress"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                        aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="addAddress">Thêm địa chỉ giao hàng mới</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form">
                                        <div class="form-group custom-input-body">
                                            <input name="info-detail" class="form-control custom-input"
                                                placeholder="Địa chỉ cụ thể" type="text" />
                                        </div>
                                        <div class="custom-select">
                                            <select name="city-select" id="">
                                                <option value="none" selected disable>--- Vui lòng chọn Thành Phố ---
                                                </option>
                                                {{-- @foreach($cities as $city)
                                                <option value="{{$city->idProvince}}">{{$city->name}}</option>
                                                @endforeach --}}
                                                <option value="0">Hà Nội</option>
                                                <option value="1">Hải Phòng</option>
                                            </select>
                                        </div>
                                        <div class="custom-select">
                                            <select name="district-select" id="">
                                                <option value="none" selected disable>--- Vui lòng chọn Huyện ---
                                                </option>
                                                <option value="0">Huyện Hà Nội</option>
                                                <option value="1">Huyện Hải Phòng</option>
                                            </select>
                                        </div>
                                        <div class="custom-select">
                                            <select name="commune-select" id="">
                                                <option value="none" selected disable>--- Vui lòng chọn Quận ---
                                                </option>
                                                <option value="0">Quận Hà Nội</option>
                                                <option value="1">Quận Hải Phòng</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-add-address">Thêm Địa
                                        Chỉ</button>
                                    <button type="button" class="btn btn-close" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('user/app/jquery/payment.js')}}"></script>
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
