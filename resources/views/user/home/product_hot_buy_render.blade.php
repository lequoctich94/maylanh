@foreach($product_hot_buys as $product_hot_buy)
<li class="product-listItem">
    <div class="hotBuys-container">
        <div class="left-block">
            <a
                href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}"><img
                    class="img-responsive" alt="product"
                    src="{{env('APP_URL')}}/upload/products/{{$product_hot_buy['product_id']}}/{{$product_hot_buy['product_img']}}" /></a>
            <div class="quick-view">
                <a title="Add to my wishlist" class="heart"
                    href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}"></a>
                <a title="Xem chi tiết" class="compare"
                    href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}"></a>
                <a href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}"
                    class="qv-e-button btn-quickview-1 search" title="Xem nhanh"></a>
            </div>
            <div class="add-to-cart">
                <a class="add-to-car"
                    href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}">Thêm
                    vào giỏ</a>
            </div>
        </div>
        <div class="right-block">
            <h5 class="product-name"><a
                    href="{{ route('user/product-detail',['product_name' => Str::slug($product_hot_buy->product_name), 'searchID' => $product_hot_buy->product_id])}}">{{$product_hot_buy['product_name']}}</a>
            </h5>
            <div class="content_price"><span class="price-numberBuy">(
                    {{$product_hot_buy->quantity_pay}}
                    )<span>
                        Đã Bán</span></span>
                <span class="price product-price">{{number_format($product_hot_buy->price_pay)}}đ</span>
                </br>
            </div>
        </div>
    </div>
</li>
@endforeach