<div class="col-sm">
    <div class="table-wrap">
        <table class="table table-hover w-100 display">
            <thead id="header-hot-rate">
                <tr>
                    <th>STT</th>
                    <th>Hình Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Loại Sản Phẩm</th>
                    <th>Nhà Cung Cấp</th>
                    <th>Lượt Đánh Giá</th>
                </tr>
            </thead>
            <tbody id="body-hot-rate">
                @if($product_hot_rates==[])
                <tr class="odd">
                    <td valign="top" colspan="6" class="text-center dataTables_empty">Danh sách
                        trống</td>
                </tr>
                @else
                <p class="d-none">{{$i=1}}</p>
                @foreach($product_hot_rates as $product_hot_rate)
                <tr>
                    <td>{{$i++}}</td>
                    <td>
                        <img width="140" height="150"
                            src="{{env('APP_URL')}}/upload/products/{{$product_hot_rate['product_id']}}/{{$product_hot_rate['product_img']}}"
                            alt="{{$product_hot_rate['product_name']}}">
                    </td>
                    <td>{{$product_hot_rate['product_name']}}</td>
                    <td>{{$product_hot_rate['category']['category_name']}}</td>
                    <td>{{$product_hot_rate['producer']['producer_name']}}</td>
                    <td>{{$product_hot_rate['quantity_rates']}}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
