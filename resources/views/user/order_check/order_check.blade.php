@extends('user/layouts')

@section('title','Kiểm tra đơn hàng')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<title>Theo d&#245;i đơn h&#224;ng</title>
<meta name="description" />
<meta name="keywords" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />
<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Theo d&#245;i đơn h&#224;ng" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
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
                                    itemprop="title">Trang chủ</span></a>
                        </li>
                        <li class="icon-li"><strong>Kiểm tra đơn hàng</strong> </li>
                    </ul>
                </div>
                <script type="text/javascript">
                    $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
                </script>
                <script src="user/app/services/orderServices.js"></script>
                <script src="user/app/controllers/orderController.js"></script>
                <div class="order-tracking-content clearfix" ng-controller="orderController" ng-init="initController()">
                    <h1 class="page-heading"><span>Kiểm tra đơn hàng</span></h1>
                    <div class="order-tracking-block">
                        <div class="alert alert-danger" ng-if="Id<0">
                            Không tìm thấy đơn hàng trong hệ thống. Vui lòng kiểm tra lại mã đơn hàng hoặc số
                            điện thoại của bạn.
                        </div>
                        <form class="form-inline order-input" ng-submit="searchOrder()">
                            <div class="form-group">
                                <label>Nhập mã đơn hàng</label>
                                <input type="text" class="form-control" placeholder="Mã số đơn hàng (VD:123456789)" />
                                <button class="btn btn-primary">Xem ngay</button>
                            </div>
                        </form>
                        <div ng-if="Id>0">
                            <h2>Thông tin đơn hàng</h2>
                            <div class="row-title docs">Đơn hàng của <a href="#">Tên Khách Hàng</a><b>
                                    Mã Code</b> lúc <span class="grey">Ngày đặt hàng</span></div>
                            <div class="table-responsive clearfix order-tracking-info">
                                <table class="table table-mycart">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th colspan="2">Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in OrderDetails">
                                            <td>STT</td>
                                            <td class="image">
                                                <a href="san-pham/%7b%7bitem.ProductCode%7d%7d.html"><img
                                                        src="notfound5031.html" class="img-responsive" /></a>
                                            </td>
                                            <td>
                                                <a href="san-pham/%7b%7bitem.ProductCode%7d%7d.html">ProductName</a>
                                                <p class="note" ng-if="item.IsVariant==true">
                                                    VariantName</p>
                                            </td>
                                            <td>Price đ</td>
                                            <td>Quantity</td>
                                            <td>Amount đ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="border-right">
                                                <div class="box-customer-content">
                                                    <div class="title"><span>Thông tin giao hàng</span></div>
                                                    <div>[Anh/Chị]<b> DeliveryName</b></div>
                                                    <div>
                                                        DeliveryEmail |
                                                        DeliveryAddress |
                                                        DeliveryPhone
                                                    </div>
                                                </div>
                                                <div class="box-customer-content">
                                                    <div class="title"><span>Thông tin thanh toán</span></div>
                                                    <div>[Anh/Chị]<b>CustomerName</b></div>
                                                    <div>
                                                        CustomerEmail |
                                                        CustomerAddress |
                                                        CustomerPhone
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="4">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-left"><b>Tổng tiền thanh toán</b>
                                                            </td>
                                                            <td class="text-right ">
                                                                <b class="total-payment">
                                                                    Amount
                                                                </b>
                                                                <p class="note"></p>
                                                            </td>
                                                        </tr>
                                                        <tr class="text-center order-stt">
                                                            <td colspan="2">
                                                                <div>Trạng thái đơn hàng</div>
                                                                <div><b>ShipmentStateName</b></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                <a class="btn btn-default" href="{{ route('/login') }}">Trở về danh sách đơn
                                    hàng</a>
                                <a class="btn btn-primary" href="{{ route('index') }}">Tiếp tục mua hàng</a>
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
    $(".header-content").css({ "background": '' });
    $("html").addClass('');
</script>
@endsection
