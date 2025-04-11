@extends('layouts')

@section('title','Chi Tiết Hoá Đơn Bán')

@section('header')
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

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
        <li class="breadcrumb-item"><a href="javascript:void(0)">Quản Lý</a></li>
        <li class="breadcrumb-item displayFlex"><a href="{{ route('bill-pay-management') }}">Hoá Đơn Bán</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Chi Tiết Hoá Đơn Bán</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">


    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <div class="row">
                    <div class="col-sm">
                        <div id="datable_1" class="table-wrap">
                            <!-- Title -->
                            <div class="hk-pg-header">
                                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon">
                                            <i data-feather="database"></i></span></span>Danh Sách Hoá Đơn Bán</h4>
                            </div>
                            <input type="text" name="bill_id" id="bill_id"
                                value="{{ $bill_pay_details[0]->bill->bill_id}}" hidden=true>
                            <input type="text" name="member_id" id="member_id"
                                value="{{ $bill_pay_details[0]->bill->member->member_id }}" hidden=true>
                            <input type="text" name="total_price_point" id="total_price_point"
                                value="{{ $bill_pay_details[0]->bill->total_price }}" hidden=true>
                            <input type="text" name="current_point_old" id="current_point_old"
                                value="{{ $bill_pay_details[0]->bill->member->current_point }}" hidden=true>
                            <!-- Container -->
                            <div class="container">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-xl-12">
                                        <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                                            <div class="invoice-from-wrap">
                                                <div class="row">
                                                    <div class="col-md-7 mb-20">
                                                        <h4 style="color:rgb(89, 182, 205)" class="font-weight-600">
                                                            PTPStore</h4>
                                                        <br>
                                                        <h6 class="mb-5">Từ {{$admin->full_name}}</h6>
                                                        <address>
                                                            <span class="d-block">{{ $stock->address }}</span>
                                                            <span class="d-block">{{ $admin->email }}</span>
                                                        </address>
                                                    </div>
                                                    <div class="col-md-5 mb-20">
                                                        <h4 class="mb-35 font-weight-600"
                                                            style="color:rgb(89, 182, 205)">Hoá Đơn/ Biên Lai</h4>
                                                        <span class="d-block">Mã Đơn:<span class="pl-10 text-dark">{{
                                                                $bill_pay_details[0]->bill->bill_id}}</span></span>
                                                        <span class="d-block">Ngày Lập Hoá Đơn:<span
                                                                class="pl-10 text-dark">{{
                                                                $bill_pay_details[0]->bill->date_order}}</span></span>
                                                        @if($bill_pay_details[0]->bill->status==0 ||
                                                        $bill_pay_details[0]->bill->status==1)
                                                        <span class="d-block">Ngày Duyệt Đơn:<span
                                                                class="pl-10 text-dark">{{
                                                                $bill_pay_details[0]->bill->date_confirm}}</span></span>
                                                        @else
                                                        <span class="d-block">Ngày Duyệt Đơn:<span
                                                                class="pl-10 text-dark">Chưa Duyệt</span></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mt-0">
                                            <div class="invoice-to-wrap">
                                                <div class="row">
                                                    <div class="col-md-7 mb-30">
                                                        <span class="d-block text-uppercase mb-5 font-13">Đến</span>
                                                        <h6 class="mb-5">
                                                            {{ $bill_pay_details[0]->bill->shipping_address }}
                                                        </h6>
                                                        <address>
                                                            <span class="d-block">Khách Hàng:
                                                                {{ $bill_pay_details[0]->bill->member->user->full_name
                                                                }}</span>
                                                            <span class="d-block">Người Nhận:
                                                                {{ $bill_pay_details[0]->bill->receiver }}</span>
                                                            <span class="d-block">Số Điện Thoại:
                                                                {{ $bill_pay_details[0]->bill->shipping_phone }}</span>
                                                        </address>
                                                    </div>
                                                    <div class="col-md-5 mb-30">
                                                        <span class="d-block text-uppercase mb-5 font-13">THÔNG TIN
                                                            THANH TOÁN</span>
                                                        <span class="d-block">
                                                            @if($bill_pay_details[0]->bill->payment == 0)
                                                            {{ $bill_pay_details[0]->bill->receiver }}
                                                            @else
                                                            {{ $bill_pay_details[0]->bill->member->user->full_name }}
                                                            @endif
                                                        </span>
                                                        <span class="d-block">
                                                            @if($bill_pay_details[0]->bill->payment == 0)
                                                            <h6>Thanh Toán Khi Nhận Hàng</h6>
                                                            @else
                                                            <p>Zalo Pay</p>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5>Chi Tiết Hoá Đơn</h5>
                                            <hr>
                                            <div class="invoice-details">
                                                <div class="table-wrap">
                                                    <div class="table-responsive">
                                                        <table id="table-bill"
                                                            class="table table-striped table-border mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="w-30">Tên Sản Phẩm</th>
                                                                    <th class="text-right">Số Lượng</th>
                                                                    <th class="text-right">Tiền</th>
                                                                    <th class="text-right">Giảm Giá</th>
                                                                    <th class="text-right">Tổng Tiền</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                $total_discount=0;
                                                                @endphp
                                                                @if($bill_pay_details != [])
                                                                @foreach($bill_pay_details as $bill_pay_detail)
                                                                @php
                                                                $total_discount+=$bill_pay_detail->price_discount
                                                                @endphp
                                                                <tr>
                                                                    <td>{{
                                                                        $bill_pay_detail->product_detail->product->product_name}}
                                                                        -
                                                                        {{
                                                                        $bill_pay_detail->product_detail->size->size_name}}
                                                                        -
                                                                        {{
                                                                        $bill_pay_detail->product_detail->color->color_name}}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        {{ $bill_pay_detail->quantity}}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        {{ number_format($bill_pay_detail->price)}}
                                                                        VNĐ
                                                                    </td>
                                                                    <td class="text-right">
                                                                        {{ number_format($bill_pay_detail->price_discount)}}VNĐ
                                                                    </td>
                                                                    <td class="text-right">
                                                                        @php
                                                                         $total = $bill_pay_detail->total_price - $bill_pay_detail->price_discount;
                                                                        @endphp
                                                                        {{
                                                                        number_format($total)}}
                                                                        VNĐ
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr class="odd">
                                                                    <td valign="top" colspan="6"
                                                                        class="text-center dataTables_empty">Danh sách
                                                                        trống</td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                            {{-- {{dd($bill_pay_details[0]->bill->voucher->sale_off)}} --}}
                                                            <tfoot class="border-bottom border-1">
                                                                <tr class="bg-transparent">
                                                                    <td colspan="4" class="text-right text-light">
                                                                        Tổng
                                                                        Số lượng</td>
                                                                    <td class="text-right">
                                                                        {{$bill_pay_details[0]->bill->total_quantity}}
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-transparent">
                                                                    <td colspan="4" class="text-right text-light">
                                                                        Tổng
                                                                        Tiền</td>
                                                                    <td class="text-right">
                                                                        @php
                                                                        $totalold = 0;
                                                                        if(isset( $bill_pay_details[0]->bill->voucher->max_price )){
                                                                            if($bill_pay_details[0]->bill->total_price >= $bill_pay_details[0]->bill->voucher->max_price){   
                                                                                $totalold =  $bill_pay_details[0]->bill->total_price + $bill_pay_details[0]->bill->total_price * $bill_pay_details[0]->bill->voucher->sale_off; 
                                                                            }else{
                                                                                $totalold =  $bill_pay_details[0]->bill->total_price + $bill_pay_details[0]->bill->voucher->max_price;                                                     
                                                                            }
                                                                        }else{
                                                                            $totalold = $bill_pay_details[0]->bill->total_price;
                                                                        }
                                                                        @endphp
                                                                        {{number_format($totalold)}}VNĐ
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-transparent">
                                                                    <td colspan="4"
                                                                        class="text-right text-light border-top-0">
                                                                        Khuyến Mãi</td>
                                                                    @if($bill_pay_details[0]->bill->code == null)
                                                                    <td class="text-right border-top-0">
                                                                        Không áp dụng
                                                                    </td>
                                                                    @else <td class="text-right border-top-0">
                                                                        {{ $bill_pay_details[0]->bill->code}} </br>
                                                                        @if($bill_pay_details[0]->bill->total_price>=
                                                                        $bill_pay_details[0]->bill->voucher->max_price)
                                                                        {{
                                                                        number_format($bill_pay_details[0]->bill->voucher->max_price)
                                                                        }}
                                                                        @else
                                                                        {{
                                                                        number_format($bill_pay_details[0]->bill->total_price
                                                                        *
                                                                        $bill_pay_details[0]->bill->voucher->sale_off)
                                                                        }}
                                                                        @endif
                                                                        VNĐ
                                                                    </td>
                                                                    @endif
                                                                </tr>
                                                                <tr class="bg-transparent">
                                                                    <td colspan="4"
                                                                        class="text-right text-light border-top-0">
                                                                        Giảm Theo Loại</td>
                                                                    <td class="text-right border-top-0">
                                                                        {{number_format($total_discount) }} VNĐ
                                                                    </td>
                                                                </tr>
                                                                <tr class="text-right">
                                                                    <td colspan="4" class="text-right font-weight-600"
                                                                        style="font-size:20px;color:rgb(67, 67, 67);">
                                                                        Tổng Cộng</td>
                                                                    <td class="text-right font-weight-600">
                                                                        <p style="font-size:18px !important;">
                                                                            {{-- @if($bill_pay_details[0]->bill->code ==
                                                                            null) --}}
                                                                            {{
                                                                            number_format($bill_pay_details[0]->bill->total_price)
                                                                            }}
                                                                            {{-- @else
                                                                            @if($bill_pay_details[0]->bill->total_price>=
                                                                            $bill_pay_details[0]->bill->voucher->max_price)
                                                                            {{
                                                                            number_format($bill_pay_details[0]->bill->total_price
                                                                            -
                                                                            $bill_pay_details[0]->bill->voucher->max_price)}}
                                                                            @else
                                                                            {{
                                                                            number_format($bill_pay_details[0]->bill->total_price
                                                                            - $bill_pay_details[0]->bill->total_price *
                                                                            $bill_pay_details[0]->bill->voucher->sale_off) }}
                                                                            @endif
                                                                            @endif --}}
                                                                        </p>
                                                                        VNĐ
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="invoice-sign-wrap text-right"
                                                    style="position: relative;padding-top:20px !important;padding-bottom:190px !important">
                                                    <img class="img-fluid d-inline-block"
                                                        style="width:160px;height:80px;"
                                                        src="{{ asset('dist/img/signature.png') }}" alt="sign" />
                                                    <br>
                                                    <div
                                                        style="position: absolute;right:0;display:flex;align-items:center;">
                                                        @if($bill_pay_details[0]->bill->status == -1)
                                                        <div class="formDelivery boxShadowSmall">
                                                            <button type="submit" value="2"
                                                                class="btn-confirm-bill d-block font-14 btn btn-primary text-white mr-3">
                                                                Duyệt Đơn
                                                            </button>
                                                            <div class="formDeliveryRefuse">
                                                                <textarea name="message" id="message"
                                                                    class="form-group-rateDesc"
                                                                    placeholder="Nhập nội dung từ chối"></textarea>
                                                                <button type="submit"
                                                                    class="btn-refuse-bill d-block font-14 btn btn-danger text-white">
                                                                    Từ chối
                                                                </button>
                                                            </div>
                                                        </div>
                                                        @elseif($bill_pay_details[0]->bill->status == 2)
                                                        <div class="formDelivery boxShadowSmall">
                                                            <button type="submit" value="0"
                                                                class="btn-confirm-bill d-block font-14 btn btn-primary text-white mr-3">
                                                                Xác nhận giao
                                                            </button>
                                                            <div class="formDeliveryRefuse">
                                                                <textarea name="message" id="message"
                                                                    class="form-group-rateDesc"
                                                                    placeholder="Nhập nội dung từ chối"></textarea>
                                                                <button type="submit"
                                                                    class="btn-refuse-bill d-block font-14 btn btn-danger text-white">
                                                                    Từ chối
                                                                </button>
                                                            </div>
                                                        </div>
                                                        @elseif($bill_pay_details[0]->bill->status == 0)
                                                        <button type="submit"
                                                            class="btn-delivered-bill d-block font-14 btn btn-primary text-white mr-3">
                                                            Hoàn Tất
                                                        </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <!-- /Row -->
                            </div>
                            <!-- /Container -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


</div>
<!-- /Container -->

@endsection

<!-- /HK Wrapper  -->
@section('footer-script')
<script src="{{ asset('vendors4/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('vendors4/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{ asset('vendors4/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('dist/js/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('vendors4/jszip/dist/jszip.min.js')}}"></script>
<script src="{{ asset('vendors4/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{ asset('vendors4/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{ asset('dist/js/feather.min.js')}}"></script>
<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
<script src="{{ asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
<script src="{{ asset('dist/js/toggle-data.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/bill_pay_detail.js') }}"></script>
@endsection
