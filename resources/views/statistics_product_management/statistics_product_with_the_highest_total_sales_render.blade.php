<div class="row mb-30">
    <div class="col-sm">
        <nav class="navbar navbar-expand-xl navbar-dark bg-dark navbar-demo" style="border-radius:5px;    background: rgb(63, 151, 119);
                            background: linear-gradient(
                                330deg,
                                rgb(89, 182, 205) 56%,
                                rgb(38, 177, 205) 100%
                                );">
            <div class="collapse navbar-collapse" id="navbarSupportedColor1">
                <ul class="navbar-nav">
                    <li id="delivered" class="nav-item">
                        <a id="head-input-total" class="nav-link delivered text-white">Tổng Doanh Thu:
                            <span id="inputTotal">{{number_format($total)}}đ</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <table class="table table-hover w-100 display">
                <thead id="header-product">
                    <tr>
                        <th>STT</th>
                        <th>Hình Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Loại Sản Phẩm</th>
                        <th>Nhà Cung Cấp</th>
                        <th>Đã Bán</th>
                        <th>Doanh Thu</th>
                    </tr>
                </thead>
                <tbody id="top-product">
                    @if($statistics_products==[])
                    <tr class="odd">
                        <td valign="top" colspan="7" class="text-center dataTables_empty">Danh sách
                            trống</td>
                    </tr>
                    @else
                    <p class="d-none">{{$i=1}}</p>
                    @foreach($statistics_products as $statistics_product)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <img width="140" height="150"
                                src="{{env('APP_URL')}}/upload/products/{{$statistics_product['product_id']}}/{{$statistics_product['product_img']}}"
                                alt="{{$statistics_product['product_name']}}">
                        </td>
                        <td>{{$statistics_product['product_name']}}</td>
                        <td>{{$statistics_product['category']['category_name']}}</td>
                        <td>{{$statistics_product['producer']['producer_name']}}</td>
                        <td>{{$statistics_product['quantity_sells']}}</td>
                        <td>{{number_format($statistics_product['total_sells'])}}đ</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
