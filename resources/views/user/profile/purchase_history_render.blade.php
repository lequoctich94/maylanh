@if(empty($bills))
<div class="tab-content-none">
    Danh sách trống
</div>
@else
@foreach($bills as $bill)
<div class="purchaseHistory-body-content">
    <div class="purchaseHistory-body-contentImg">
        <img src="{{env('APP_URL')}}/upload/invoices/invoice.png" alt="invoice">
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
        @if($bill->status != -2 && $bill->status != -4)
        <div class="purchaseHistory-body-contentMainItem">
            <span>Ngày duyệt hàng</span>
            <p>{{$bill->date_confirm != null ? $bill->date_confirm : "Chưa Duyệt"}}</p>
        </div>
        <div class="purchaseHistory-body-contentMainItem">
            <span>Ngày lấy hàng</span>
            <p>{{$bill->date_delivery != null ? $bill->date_delivery : "Chưa Giao"}}</p>
        </div>
        <div class="purchaseHistory-body-contentMainItem">
            <span>Ngày nhận</span>
            <p>{{$bill->date_receipt != null ? $bill->date_receipt : "Chưa Nhận"}}</p>
        </div>
        @elseif($bill->status == -2)
        <div class="purchaseHistory-body-contentMainItem">
            <span>Ngày huỷ đơn</span>
            <p>{{$bill->date_cancel}}</p>
        </div>
        @else
        <div class="purchaseHistory-body-contentMainItem">
            <span>Ngày từ chối</span>
            <p>{{$bill->date_cancel}}</p>
        </div>
        @endif
        @if($bill->status == -2 || $bill->status==-4)
        <div class="purchaseHistory-body-contentMainItem">
            <span>Lý do huỷ đơn</span>
            <p>{{$bill->message}}</p>
        </div>
        @endif
        <div class="purchaseHistory-body-contentMainButton">
            <button type="button" name="bill_detail" bill_id="{{$bill->bill_id}}" class="btn btn-billDetail"
                data-toggle="modal" data-target="#billDetailModal">Chi
                tiết hoá đơn</button>
            @if($status == -1)
            <textarea name="message" id="message" class="form-group-rateDesc"
                placeholder="Nhập lí do huỷ đơn của bạn"></textarea>
            <button type="button" name="remove_bill" bill_id="{{$bill->bill_id}}" class="btn btn-refuseBill">Huỷ
                đơn</button>
            @endif
        </div>
    </div>
</div>
@endforeach
@endif