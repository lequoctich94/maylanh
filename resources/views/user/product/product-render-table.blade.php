<ul class="row product-list grid filter">
    @foreach($products as $product)
    <li class="col-md-3 col-sm-6 col-xs-12">
        <div class="product-container product-resize">
            <div class="left-block image-resize">
                <a
                    href="{{ route('user/product-detail',['product_name' => Str::slug($product->product_name), 'searchID' => $product->product_id])}}">
                    <img class="img-responsive" alt="product"
                        src="{{env('APP_URL')}}/upload/products/{{$product->product_id}}/{{$product->product_img}}" />
                </a>
                <div class="add-to-cart">
                    <a class="add-to-car"
                        href="{{ route('user/product-detail',['product_name' => Str::slug($product->product_name), 'searchID' => $product->product_id])}}">Mua
                        Ngay</a>
                </div>
            </div>
            <div class="right-block">
                <h5 class="product-name"><a
                        href="{{ route('user/product-detail',['product_name' => Str::slug($product->product_name), 'searchID' => $product->product_id])}}">{{$product->product_name}}</a>
                </h5>
                <span class="date">
                    <p>Loại Sản Phẩm: {{$product->category->category_name}}</p>
                </span>
                <span class="comment"><span>Đã bán: </span>{{$product->quantity_pay}}</span>

                <div class="content_price">
                    <span class="price product-price">{{number_format($product->price_pay)}}
                        VNĐ</span>
                </div>
            </div>
        </div>
    </li>
    @endforeach
</ul>
@if($pagination != null)
<div class="col-md-12 content_sortPagiBar pagi">
    <div class="clearfix">
        <ul class="pagination">
            <li class="pagination_previous">
                <a href="javascript:void(0)" id="previous" title="Previous &raquo;"
                    class="{{$pagination->currentPage==1 || $pagination->totalPage == 1 ? 'disable' : ''}}"><i
                        class="fa fa-chevron-left"></i></a>
            </li>
            @for($i=1;$i<=$pagination->totalPage;$i++)
                <li value="{{$i}}" class="{{$i == $pagination->currentPage ? 'active' :''}}"><a value="{{$i}}"
                        href="javascript:void(0)" id="numberPage"><span>{{$i}}</span></a></li>
                @endfor
                <li class="pagination_next">
                    <a href="javascript:void(0)" id="next"
                        class="{{$pagination->currentPage == $pagination->totalPage ? 'disable' : ''}}"
                        title="Next &raquo;">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </li>
        </ul>
    </div>
</div>
@endif
<script type="text/javascript" src="{{ asset('user/app/pagination.js')}}"></script>