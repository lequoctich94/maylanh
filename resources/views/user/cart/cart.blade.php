@extends('user/layouts')

@section('title','Giỏ hàng')

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
<meta content="Giỏ h&#224;ng" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/custom_cart.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection

@section('body')
<div id="cart">
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb clearfix">
                        <ul>
                            <li itemtype="http://shema.org/Breadcrumb" itemscope="" class="home">
                                <a title="Đến trang chủ" href="{{ route('user/index') }}" itemprop="url"><span
                                        itemprop="title">Trang chủ</span></a>
                            </li>
                            <li class="icon-li"><strong>Giỏ hàng</strong> </li>
                        </ul>
                    </div>
                    <script type="text/javascript">
                        $(".link-site-more").hover(function () {
                            $(this).find(".s-c-n").show();
                        }, function () {
                            $(this).find(".s-c-n").hide();
                        });
                    </script>
                    <script src="{{ asset('user/app/services/orderServices.js') }}"></script>
                    <script src="{{ asset('user/app/controllers/orderController.js') }}"></script>
                    <div class="cart-content" ng-controller="orderController" ng-init="initOrderCartController()">
                        <h1 class="page-heading"><span>Giỏ hàng của tôi</span></h1>
                        <div class="steps clearfix">
                            <ul class="clearfix">
                                <li
                                    class="cart active col-md-2 col-xs-12 col-sm-4 col-md-offset-3 col-sm-offset-0 col-xs-offset-0">
                                    <span><i class="glyphicon glyphicon-shopping-cart"></i></span><span>Giỏ hàng
                                        của tôi</span><span class="step-number"><a>1</a></span>
                                </li>
                                <li class="payment col-md-2 col-xs-12 col-sm-4"><span><i
                                            class="glyphicon glyphicon-usd"></i></span><span>Thanh
                                        toán</span><span class="step-number"><a>2</a></span></li>
                                <li class="finish col-md-2 col-xs-12 col-sm-4"><span><i
                                            class="glyphicon glyphicon-ok"></i></span><span>Hoàn tất</span><span
                                        class="step-number"><a>3</a></span></li>
                            </ul>
                        </div>
                        <div class="cart-block-info">
                            <div class="cart-info table-responsive table-wrap">
                                <table class="table table-striped table-bordered hover display">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Hình ảnh sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th style="width:140px">Loại sản phẩm</th>
                                            <th style="width:120px">Màu sắc & Kích thước</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(empty($carts))
                                        <tr id="is-empty" class="tbody-tr">
                                            <td colspan="9">
                                                <p class="text-center"> Danh sách trống, vui lòng nhập thêm sản phẩm</p>
                                            </td>
                                        </tr>
                                        @else
                                        @foreach($carts as $cart)
                                        <tr class="tbody-tr" cart_id="{{$cart->cart_id}}">
                                            <td style="height:100%;position: relative;">
                                                @if($cart->status ==0)
                                                <div class="productDontActive">
                                                    <div class="productDontActiveBorder">
                                                    </div>
                                                    <div class="productDontActiveName"></div>
                                                </div>
                                                @else
                                                <input style="margin-top:40px;cursor: pointer;
                                                width: 20px;
                                                height: 20px;" isSelected type="checkbox">
                                                @endif
                                            </td>
                                            <td>
                                                @foreach($cart->product_detail->product->images as $image)
                                                @if($image->product_id == $cart->product_detail->product->product_id &&
                                                $image->color_id == $cart->product_detail->color->color_id)
                                                <img width="180" height="100" style="object-fit:cover;"
                                                    src="{{env('APP_URL')}}/upload/products/{{$image->product_id}}/{{$image->img_name}}"
                                                    alt="{{$cart->product_detail->product->product_name}}">
                                                @break
                                                @endif
                                                @endforeach
                                            </td>
                                            <td class="tbody-td des">
                                                <a href="#">{{$cart->product_detail->product->product_name}}</a>
                                            </td>
                                            <td class="tbody-td des">
                                                {{$cart->product_detail->product->category->category_name}}
                                            </td>
                                            <td class="tbody-td des">
                                                {{$cart->product_detail->color->color_name}} -
                                                {{$cart->product_detail->size->size_name}}
                                            </td>
                                            <td price_pay="{{$cart->price_pay}}" class="tbody-td price">
                                                {{number_format($cart->price_pay)}}đ
                                            </td>
                                            <td class="tbody-td quantity" style="width:100px">
                                                <div class="number-input">
                                                    <button id="stepDown"></button>
                                                    <input class="quantity" oldValue="{{$cart->quantity}}" min="1"
                                                        max="99" name="quantity" value="{{$cart->quantity}}"
                                                        type="number" pattern="[1-9]+">
                                                    <button id="stepUp" class="plus"></button>
                                                </div>
                                            </td>
                                            <td class="tbody-td totalPrice">
                                                {{number_format($cart->price_pay * $cart->quantity)}}đ
                                            </td>
                                            <td style="text-align:center;height:100%;">
                                                <a remove-product-to-cart href="javascript:void(0)">
                                                    <i class="glyphicon glyphicon-trash" style="margin-top:40px;cursor: pointer;
                                                        font-size:18px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                            <div class="cart-fixed">
                                <div class="cart-fixed-top border-bottom">
                                    <div class="cart-topVoucher">
                                        <span class="cart-topVoucher-text"><i class="fa fa-credit-card-alt"
                                                aria-hidden="true"></i> PTPStore Voucher</span>
                                        <!-- <span class="btn btn-chooseVoucher">Chọn mã khuyến mãi</span> -->
                                        <button voucher-selected="" type="button" class="btn btn-chooseVoucher"
                                            data-toggle="modal">Chọn mã khuyến
                                            mãi</button>
                                    </div>
                                </div>
                                <div class="cart-fixed-top border-bottom pt-10">
                                    <div class="cart-topVoucher">
                                        <span class="cart-topVoucher-text"><i class="fa fa-credit-card-alt"
                                                style="color:#30c1bf;" aria-hidden="true"></i> Áp dụng voucher</span>
                                        <span value-voucher-selected="0" class="cart-topVoucher-number">0đ</span>
                                    </div>
                                </div>
                                <div class="cart-fixed-bottom">
                                    <div class="cart-bottomElementCheck">
                                        <div class="cart-check">
                                            <input isAllSelected type="checkbox">
                                            <span number-selected="0">Chọn tất cả (0)</span>
                                        </div>
                                        <div class="cart-delete">
                                            <a href="javascript:void(0);" class="btn btn-delete">Xoá tất cả</a>
                                        </div>
                                        <div class="cart-favourite">
                                            <a href="javascript:void(0);" class="btn btn-favourite">Lưu vào danh sách
                                                yêu
                                                thích</a>
                                        </div>
                                        <div class="cart-totalPrice">
                                            <span>Tổng tiền:</span>
                                            <p total-all-price="0" class="total-all-price">
                                                0đ
                                            </p>
                                            <p price-discount="0" class="price-discount">
                                                (-0đ)
                                            </p>
                                        </div>
                                    </div>
                                    <div class="cart-bottomElementButton">
                                        <div class="text-right">
                                            <a class="comeback" href="{{ route('user/product') }}">Tiếp tục
                                                mua hàng</a>
                                            <a class="button-default" id="checkout" href="javascript:void(0);">Tiến
                                                hành thanh toán</a>
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
<div class="modal fade" id="chooseVoucher" tabindex="-1" role="dialog" aria-labelledby="chooseVoucher"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="chooseVoucher">Mã Khuyến Mãi</h4>
            </div>
            <div class="modal-body">
                @if(empty($voucherMembers))
                <div class="modal-body-voucher">
                    <p>Hiện bạn không có mã khuyến mãi nào</p>
                </div>
                @else
                @foreach($voucherMembers as $voucherMember)

                @php
                $today_date = Carbon\Carbon::now('Asia/Ho_Chi_Minh');
                $start_date =
                Carbon\Carbon::createFromFormat('Y-m-d',$voucherMember->voucher->date_start);
                $end_date =
                Carbon\Carbon::createFromFormat('Y-m-d',$voucherMember->voucher->date_end);
                $isExist = false;
                @endphp

                @if($today_date >= $start_date && $today_date < $end_date) @php $isExist=true @endphp <div
                    class="modal-body-voucher">
                    <i id="tag-voucher" class="fa fa-credit-card-alt" aria-hidden="true"></i>
                    <div class="modal-body-voucherItem">
                        <div class="modal-body-voucherItemText">
                            <span class="modal-body-voucherItemTitle">{{$voucherMember->code}}</span>
                            <span class="modal-body-voucherItemDesc">Khuyến mãi
                                {{$voucherMember->voucher->sale_off * 100}}% tối đa
                                {{number_format($voucherMember->voucher->max_price)}}đ</span>
                            <span class="modal-body-voucherItemDesc">Hạn sử dụng: đến ngày
                                {{$voucherMember->voucher->date_end}}</span>
                        </div>
                        <div class="modal-body-voucherItemButton">
                            <button type="button" sale-off="{{$voucherMember->voucher->sale_off}}"
                                max-price="{{$voucherMember->voucher->max_price}}" voucher-id="{{$voucherMember->code}}"
                                class="btn btn-chooseVoucherDetail" data-dismiss="modal">Chọn mã ưu
                                đãi</button>
                        </div>
                    </div>
            </div>
            @else
            @endif
            @endforeach
            <!-- Voucher đã hết hạn hoặc chưa kích hoạt -->
            @if(!$isExist)
            <div class="modal-body-voucher">
                <p>Hiện bạn không có mã khuyến mãi nào</p>
            </div>
            @endif
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-close" data-dismiss="modal">Đóng</button>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="{{ asset('user/app/jquery/cart.js')}}"></script>
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
