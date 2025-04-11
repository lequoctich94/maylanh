@if(empty($bill_detail_maps))
<div class="tab-content-none">
    Danh sách trống
</div>
@else
@foreach($bill_detail_maps as $bill_detail_map)
@foreach($bill_detail_map as $bill_detail)
<div class="modal-body-billDetail">
    <div class="modal-body-billDetailImg">
        @foreach($bill_detail->product_detail->product->images as $image)
        @if($image->product_id == $bill_detail->product_detail->product->product_id &&
        $image->color_id == $bill_detail->product_detail->color->color_id)
        <img width="180" height="100" style="object-fit:cover;"
            src="{{env('APP_URL')}}/upload/products/{{$image->product_id}}/{{$image->img_name}}"
            alt="{{$bill_detail->product_detail->product->product_name}}">
        @break
        @endif
        @endforeach
    </div>
    <div class="modal-body-billDetailContent">
        <div class="modal-body-billDetailContentProdName">
            {{$bill_detail->product_detail->product->product_name}} x{{$bill_detail->quantity}}
        </div>
        <div class="modal-body-billDetailContentProdClassify">
            PL: <p> {{$bill_detail->product_detail->product->category->category_name}} -
                ({{$bill_detail->product_detail->color->color_name}}) -
                ({{$bill_detail->product_detail->size->size_name}})</p>
        </div>
        <div class="modal-body-billDetailContentProdPrice">
            Giá bán: <p>{{number_format($bill_detail->price)}}đ</p>
        </div>
        @php
        $totalPrice = $bill_detail->price;
        @endphp
        @if($bill_detail->price_discount != 0)
        <div class="modal-body-billDetailContentProdPrice">
            Giá giảm hạng: -<p>{{number_format($bill_detail->price_discount)}}đ</p>
        </div>
        @php
        $totalPrice -= $bill_detail->price_discount;
        @endphp
        @endif
        @if(!is_null($bill_detail->bill->code))
        <div class="modal-body-billDetailContentProdPrice">
            Giá khuyến mãi: -<p>
                @if($bill_detail->bill->total_price>=
                $bill_detail->bill->voucher->max_price)
                {{number_format($bill_detail->bill->voucher->max_price)}}
                @php
                $totalPrice -= $bill_detail->bill->voucher->max_price;
                @endphp
                @else
                {{number_format($bill_detail->bill->total_price * $bill_detail->bill->voucher->sale_off) }}
                @php
                $totalPrice -= $bill_detail->bill->total_price * $bill_detail->bill->voucher->sale_off;
                @endphp
                @endif
                đ
            </p>
        </div>
        @endif
        <div class="modal-body-billDetailContentProdPrice">
            Tổng tiền: <p>{{number_format($totalPrice)}}đ</p>
        </div>
    </div>
</div>
@endforeach
@if($bill_detail_map[0]->bill->status == 1)
@if($bill_detail_map[0]->rate_status == 0)
<div class="rateContainer">
    <div class="form-group">
        <div class="form-group-containerDesc">
            <textarea name="comment" id="comment" class="form-group-rateDesc"
                placeholder="Nhập nội dung đánh giá của bạn"></textarea>
        </div>
        <div class="rate-productDetail">
            <label for="input-star" class="control-label form-group-rateTitle">Số sao đánh giá:
            </label>
            <input id="input-star" name="input-star" class="rating rating-loading" data-min="0" data-max="5"
                data-step="1" data-star-captions='["Poor", "Fair","Good","Very Good","Excellent"]'>
        </div>
    </div>
    <button type="button" name="rate_product" bill_id="{{$bill_detail_map[0]->bill->bill_id}}"
        product_id="{{$bill_detail_map[0]->product_detail->product_id}}" class="btn btn-rateProduct">Đánh
        giá</button>
</div>
@else
<button class="btn btn-rated" disabled>Đã đánh giá</button>
@endif
@endif
@endforeach
@endif
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.1/css/star-rating.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.1/js/star-rating.min.js"></script>
