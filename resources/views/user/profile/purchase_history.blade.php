@extends('user/layouts')

@section('title','Lịch sử mua hàng')

@section('header')
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta charset="UTF-8" />
<meta name="description" />
<meta name="keywords" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="fb:app_id" content="227481454296289" />

<meta content="vi_VN" property="og:locale" />
<meta content="website" property="og:type" />
<meta content="Lịch sử mua hàng" property="og:title" />
<meta property="og:description" />
<meta property="og:image" />
<meta property="og:url" />
<meta content="ptpstore" property="og:site_name" />
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/profile.css') }}">
<link rel="stylesheet" href="{{ asset('user/static.ptpstore/PTPSTOREV2/purchase_history.css') }}">
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
                            <li><a href="{{ route('user/rank') }}"><i class='fa fa-history'></i>Điểm hạng thành
                                    viên</a></li>
                            <li class="active"><a href="javascript:void(0)"><i class='fa fa-list-alt'></i>Đơn
                                    mua</a></li>
                        </ul>
                    </div>
                </div>
                <div class="profile-info col-md-9">
                    <div class="panel">
                        <div class="bio-graph-heading"></div>
                        <div class="panel-body bio-graph-info">
                            <h1>Thông tin đơn mua</h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="purchaseHistory wrapper-tab-section">
                                        <h4 class="purchaseHistory-heading">DANH SÁCH LỊCH SỬ ĐƠN MUA</h4>
                                        <div class="tabs">
                                            <div class="tab">
                                                <input type="radio" value="waiting_confirm -1" name="css-tabs"
                                                    id="tab-1" class="tab-switch" {{$status==-1 ? 'checked' : '' }}>
                                                <label for="tab-1" class="tab-label">Chờ xác nhận</label>
                                                <div class="tab-content">
                                                    <div class="purchaseHistory-body purchaseHistory-container"
                                                        id="waiting_confirm">
                                                        @if(empty($bills))
                                                        <div class="tab-content-none">
                                                            Danh sách trống
                                                        </div>
                                                        @else
                                                        @foreach($bills as $bill)
                                                        <div class="purchaseHistory-body-content">
                                                            <div class="purchaseHistory-body-contentImg">
                                                                <img src="{{env('APP_URL')}}/upload/invoices/invoice.png"
                                                                    alt="invoice">
                                                            </div>
                                                            <div class="purchaseHistory-body-contentMain">
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Mã hoá đơn</span>
                                                                    <p>{{$bill->bill_id}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng số lượng</span>
                                                                    <p>{{$bill->total_quantity}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng Tiền</span>
                                                                    <p>{{number_format($bill->total_price)}}đ</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Địa chỉ nhận</span>
                                                                    <p>{{$bill->shipping_address}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày đặt hàng</span>
                                                                    <p>{{$bill->date_order}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày duyệt hàng</span>
                                                                    <p>{{$bill->date_confirm != null ? $bill->date_confirm : "Chưa Duyệt"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày lấy & giao hàng</span>
                                                                    <p>{{$bill->date_delivery != null ? $bill->date_delivery : "Chưa Giao"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày nhận</span>
                                                                    <p>{{$bill->date_receipt != null ? $bill->date_receipt : "Chưa Nhận"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainButton">
                                                                    <button type="button" name="bill_detail"
                                                                        bill_id="{{$bill->bill_id}}"
                                                                        class="btn btn-billDetail" data-toggle="modal"
                                                                        data-target="#billDetailModal">Chi
                                                                        tiết hoá đơn</button>
                                                                    <textarea name="message" id="message"
                                                                        class="form-group-rateDesc"
                                                                        placeholder="Nhập lí do huỷ đơn của bạn"></textarea>
                                                                    <button type="button" name="remove_bill"
                                                                        bill_id="{{$bill->bill_id}}"
                                                                        class="btn btn-refuseBill">Huỷ
                                                                        đơn</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab">
                                                <input type="radio" value="ready_delivery 2" name="css-tabs" id="tab-2"
                                                    class="tab-switch" {{$status==2 ? 'checked' : '' }}>
                                                <label for="tab-2" class="tab-label">Chuẩn bị giao hàng</label>
                                                <div class="tab-content">
                                                    <div class="purchaseHistory-body purchaseHistory-container"
                                                        id="ready_delivery">
                                                        @if(empty($bills))
                                                        <div class="tab-content-none">
                                                            Danh sách trống
                                                        </div>
                                                        @else
                                                        @foreach($bills as $bill)
                                                        <div class="purchaseHistory-body-content">
                                                            <div class="purchaseHistory-body-contentImg">
                                                                <img src="{{env('APP_URL')}}/upload/invoices/invoice.png"
                                                                    alt="invoice">
                                                            </div>
                                                            <div class="purchaseHistory-body-contentMain">
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Mã hoá đơn</span>
                                                                    <p>{{$bill->bill_id}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng số lượng</span>
                                                                    <p>{{$bill->total_quantity}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng Tiền</span>
                                                                    <p>{{number_format($bill->total_price)}}đ</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Địa chỉ nhận</span>
                                                                    <p>{{$bill->shipping_address}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày đặt hàng</span>
                                                                    <p>{{$bill->date_order}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày duyệt hàng</span>
                                                                    <p>{{$bill->date_confirm != null ? $bill->date_confirm : "Chưa Duyệt"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày lấy hàng</span>
                                                                    <p>{{$bill->date_delivery != null ? $bill->date_delivery : "Chưa Giao"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày nhận</span>
                                                                    <p>{{$bill->date_receipt != null ? $bill->date_receipt : "Chưa Nhận"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainButton">
                                                                    <button type="button" name="bill_detail"
                                                                        bill_id="{{$bill->bill_id}}"
                                                                        class="btn btn-billDetail" data-toggle="modal"
                                                                        data-target="#billDetailModal">Chi
                                                                        tiết hoá đơn</button>
                                                                    <textarea name="message" id="message"
                                                                        class="form-group-rateDesc"
                                                                        placeholder="Nhập lí do huỷ đơn của bạn"></textarea>
                                                                    <button type="button" name="remove_bill"
                                                                        bill_id="{{$bill->bill_id}}"
                                                                        class="btn btn-refuseBill">Huỷ
                                                                        đơn</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab">
                                                <input type="radio" value="pending_delivery 0" name="css-tabs"
                                                    id="tab-3" class="tab-switch" {{$status==0 ? 'checked' : '' }}>
                                                <label for="tab-3" class="tab-label">Đang giao</label>
                                                <div class="tab-content">
                                                    <div class="purchaseHistory-body purchaseHistory-container"
                                                        id="pending_delivery">
                                                        @if(empty($bills))
                                                        <div class="tab-content-none">
                                                            Danh sách trống
                                                        </div>
                                                        @else
                                                        @foreach($bills as $bill)
                                                        <div class="purchaseHistory-body-content">
                                                            <div class="purchaseHistory-body-contentImg">
                                                                <img src="{{env('APP_URL')}}/upload/invoices/invoice.png"
                                                                    alt="invoice">
                                                            </div>
                                                            <div class="purchaseHistory-body-contentMain">
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Mã hoá đơn</span>
                                                                    <p>{{$bill->bill_id}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng số lượng</span>
                                                                    <p>{{$bill->total_quantity}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng Tiền</span>
                                                                    <p>{{number_format($bill->total_price)}}đ</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Địa chỉ nhận</span>
                                                                    <p>{{$bill->shipping_address}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày đặt hàng</span>
                                                                    <p>{{$bill->date_order}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày duyệt hàng</span>
                                                                    <p>{{$bill->date_confirm != null ? $bill->date_confirm : "Chưa Duyệt"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày lấy & giao hàng</span>
                                                                    <p>{{$bill->date_delivery != null ? $bill->date_delivery : "Chưa Giao"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày nhận</span>
                                                                    <p>{{$bill->date_receipt != null ? $bill->date_receipt : "Chưa Nhận"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainButton">
                                                                    <button type="button" name="bill_detail"
                                                                        bill_id="{{$bill->bill_id}}"
                                                                        class="btn btn-billDetail" data-toggle="modal"
                                                                        data-target="#billDetailModal">Chi
                                                                        tiết hoá đơn</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab">
                                                <input type="radio" value="delivered 1" name="css-tabs" id="tab-4"
                                                    class="tab-switch" {{$status==1 ? 'checked' : '' }}>
                                                <label for="tab-4" class="tab-label">Đã giao</label>
                                                <div class="tab-content">
                                                    <div class="purchaseHistory-body purchaseHistory-container"
                                                        id="delivered">
                                                        @if(empty($bills))
                                                        <div class="tab-content-none">
                                                            Danh sách trống
                                                        </div>
                                                        @else
                                                        @foreach($bills as $bill)
                                                        <div class="purchaseHistory-body-content">
                                                            <div class="purchaseHistory-body-contentImg">
                                                                <img src="{{env('APP_URL')}}/upload/invoices/invoice.png"
                                                                    alt="invoice">
                                                            </div>
                                                            <div class="purchaseHistory-body-contentMain">
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Mã hoá đơn</span>
                                                                    <p>{{$bill->bill_id}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng số lượng</span>
                                                                    <p>{{$bill->total_quantity}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng Tiền</span>
                                                                    <p>{{number_format($bill->total_price)}}đ</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Địa chỉ nhận</span>
                                                                    <p>{{$bill->shipping_address}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày đặt hàng</span>
                                                                    <p>{{$bill->date_order}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày duyệt hàng</span>
                                                                    <p>{{$bill->date_confirm != null ? $bill->date_confirm : "Chưa Duyệt"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày lấy & giao hàng</span>
                                                                    <p>{{$bill->date_delivery != null ? $bill->date_delivery : "Chưa Giao"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày nhận</span>
                                                                    <p>{{$bill->date_receipt != null ? $bill->date_receipt : "Chưa Nhận"}}
                                                                    </p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainButton">
                                                                    <button type="button" name="bill_detail"
                                                                        bill_id="{{$bill->bill_id}}"
                                                                        class="btn btn-billDetail" data-toggle="modal"
                                                                        data-target="#billDetailModal">Chi
                                                                        tiết hoá đơn</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" tab">
                                                <input type="radio" value="cancelled -2" name="css-tabs" id="tab-5"
                                                    class="tab-switch" {{$status==-2 ? 'checked' : '' }}>
                                                <label for="tab-5" class="tab-label">Đã huỷ</label>
                                                <div class="tab-content">
                                                    <div class="purchaseHistory-body purchaseHistory-container"
                                                        id="cancelled">
                                                        @if(empty($bills))
                                                        <div class="tab-content-none">
                                                            Danh sách trống
                                                        </div>
                                                        @else
                                                        @foreach($bills as $bill)
                                                        <div class="purchaseHistory-body-content">
                                                            <div class="purchaseHistory-body-contentImg">
                                                                <img src="{{env('APP_URL')}}/upload/invoices/invoice.png"
                                                                    alt="invoice">
                                                            </div>
                                                            <div class="purchaseHistory-body-contentMain">
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Mã hoá đơn</span>
                                                                    <p>{{$bill->bill_id}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng số lượng</span>
                                                                    <p>{{$bill->total_quantity}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng Tiền</span>
                                                                    <p>{{number_format($bill->total_price)}}đ</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Địa chỉ nhận</span>
                                                                    <p>{{$bill->shipping_address}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày đặt hàng</span>
                                                                    <p>{{$bill->date_order}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày huỷ</span>
                                                                    <p>{{$bill->date_cancel}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Lý do huỷ đơn</span>
                                                                    <p>{{$bill->message}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainButton">
                                                                    <button type="button" name="bill_detail"
                                                                        bill_id="{{$bill->bill_id}}"
                                                                        class="btn btn-billDetail" data-toggle="modal"
                                                                        data-target="#billDetailModal">Chi
                                                                        tiết hoá đơn</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab">
                                                <input type="radio" value="refused -4" name="css-tabs" id="tab-6"
                                                    class="tab-switch" {{$status==-4 ? 'checked' : '' }}>
                                                <label for="tab-6" class="tab-label">Đã từ chối</label>
                                                <div class="tab-content">
                                                    <div class="purchaseHistory-body purchaseHistory-container"
                                                        id="refused">
                                                        @if(empty($bills))
                                                        <div class="tab-content-none">
                                                            Danh sách trống
                                                        </div>
                                                        @else
                                                        @foreach($bills as $bill)
                                                        <div class="purchaseHistory-body-content">
                                                            <div class="purchaseHistory-body-contentImg">
                                                                <img src="{{env('APP_URL')}}/upload/invoices/invoice.png"
                                                                    alt="invoice">
                                                            </div>
                                                            <div class="purchaseHistory-body-contentMain">
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Mã hoá đơn</span>
                                                                    <p>{{$bill->bill_id}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng số lượng</span>
                                                                    <p>{{$bill->total_quantity}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Tổng Tiền</span>
                                                                    <p>{{number_format($bill->total_price)}}đ</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Địa chỉ nhận</span>
                                                                    <p>{{$bill->shipping_address}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày đặt hàng</span>
                                                                    <p>{{$bill->date_order}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Ngày từ chối</span>
                                                                    <p>{{$bill->date_cancel}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainItem">
                                                                    <span>Lý do từ chối</span>
                                                                    <p>{{$bill->message}}</p>
                                                                </div>
                                                                <div class="purchaseHistory-body-contentMainButton">
                                                                    <button type="button" name="bill_detail"
                                                                        bill_id="{{$bill->bill_id}}"
                                                                        class="btn btn-billDetail" data-toggle="modal"
                                                                        data-target="#billDetailModal">Chi
                                                                        tiết hoá đơn</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="billDetailModal" tabindex="-1" role="dialog"
                                                aria-labelledby="billDetailModal" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="billDetailModal"
                                                                style="color:#89817f;font-weight:400">Danh sách hoá
                                                                đơn chi tiết
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body modal-body-container" id="bill_detail">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-close"
                                                                data-dismiss="modal">Đóng</button>
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
    </div>
</div>
<script type="text/javascript" src="{{ asset('user/app/pagination.js')}}"></script>
<script type="text/javascript" src="{{ asset('user/app/jquery/bill.js')}}"></script>
<script type="text/javascript">
$(".vertical-menu-content").addClass("no-home");
$(document).ready(function() {
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