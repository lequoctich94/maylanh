@extends('layouts')

@section('title','Sản Phẩm')

@section('header')
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Data Table CSS -->
<link href="{{ asset('vendors4/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors4/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet"
    type="text/css" />

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
        <li class="breadcrumb-item displayFlex"><a href="{{route('index')}}">Quản Lý</a></li>
        <li class="breadcrumb-item displayFlex" aria-current="page"><a href="{{route('product-management')}}">Sản
                Phẩm</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Chi Tiết Sản Phẩm</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                        data-feather="database"></i></span></span>Danh Sách Sản Phẩm</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">

        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                @if(!empty($stock_details))
                <form action="{{ route('remove-product-in-stock') }}" method="POST">
                    @csrf
                    <input hidden="true" name="product_id" value="{{$stock_details[0]->product_detail->product_id}}">

                    @if($stock_details[0]->status == 1)
                    <input hidden="true" name="status" value="0">
                    <button type="submit" class="btn btn-primary mb-20 w-20">
                        Ngưng Hoạt Động Tất Cả Sản Phẩm
                    </button>
                    @else
                    <input hidden="true" name="status" value="1">
                    <button type="submit" class="btn btn-primary mb-20 w-20">
                        Khôi Phục Tất Cả Sản Phẩm
                    </button>
                    @endif
                </form>
                @endif
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table-responsive display table table-striped table-bordered hover w-100 display pb-30">
                                    <thead class="title-bill">
                                        <tr>
                                            <th>STT</th>
                                            <th>Hình Ảnh</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Loại Sản Phẩm</th>
                                            <th>Giá Nhập</th>
                                            <th>Giá Bán</th>
                                            <th>Giảm Giá</th>
                                            <th>Giá Sau Giảm</th>
                                            <th>Tồn kho</th>
                                            <th>Trạng Thái</th>
                                            {{-- <th>Chuc nang</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($stock_details != [])
                                        <p class="d-none">{{$i=1}}</p>
                                        @foreach($stock_details as $stock_detail)
                                        <tr id="{{$stock_detail->product_detail->color->color_id}}">
                                            <td>{{$i++}}</td>
                                            <td class="image-data" style="padding:4px;">
                                                <img width="100" height="100" style="object-fit:cover;border-radius:2px;"
                                                    src="{{env('APP_URL')}}/upload/products/{{$stock_detail->product_detail->product->product_id}}/{{$image[$stock_detail->product_detail->color->color_id]->img_name}}"
                                                    alt="">
                                            </td>
                                            <td>
                                                <h6>
                                                    {{$stock_detail->product_detail->product->product_name}} -
                                                    {{$stock_detail->product_detail->color->color_name}} -
                                                    {{$stock_detail->product_detail->size->size_name}}
                                                </h6>
                                            </td>
                                            <td>{{$stock_detail->product_detail->product->category->category_name}}
                                            </td>
                                            <td class="price_produced">
                                                <strong>{{number_format($stock_detail->product_detail->price_produced)}}₫</strong>
                                            </td>
                                            
                                            <td class="price_pay">
                                                <strong>{{number_format($stock_detail->price_pay)}}₫</strong>
                                            </td>
                                            <td class="sale_off">
                                                <strong>{{number_format($stock_detail->sale_off*100)}}%</strong>
                                            </td>
                                            <td class="price_sale_off">
                                                <strong>{{number_format($stock_detail->price_pay - $stock_detail->price_pay*$stock_detail->sale_off)}}</strong>
                                            </td>
                                            @if($stock_detail->quantity > 0)
                                            <td class="quantity">{{$stock_detail->quantity}}</td>
                                            @else
                                            <td><span class="badge badge-danger">Hết Hàng</span></td>
                                            @endif
                                            @if($stock_detail->status==1)
                                            <td><span class="badge badge-success">Hoạt Động</span></td>
                                            @else
                                            <td><span class="badge badge-danger">Ngưng Hoạt Động</span></td>
                                            @endif
                                            <td>
                                                <a href="javascript:void()"
                                                    id="{{$stock_detail->product_detail->product_detail_id}}"
                                                    class="update_product_detail_in_stock" data-toggle="modal"
                                                    data-target="#updateProduct"
                                                    data-original-title="Cập Nhật Chi Tiết Sản Phẩm">
                                                    <span data-toggle="tooltip"
                                                        data-original-title="Cập Nhật Chi Tiết Sản Phẩm"><i
                                                            class="icon-pencil text-green"></i></span>
                                                </a>
                                                @if($stock_detail->status==1)
                                                <a href="javascript:void()"
                                                    id="{{$stock_detail->product_detail->product_detail_id}}"
                                                    class="order_product_detail_in_stock" data-toggle="modal"
                                                    data-target="#orderProduct" data-original-title="Nhập Thêm Sản Phẩm">
                                                    <span data-toggle="tooltip" data-original-title="Nhập Thêm Sản Phẩm">
                                                        <i class="icon-plus text-green"></i>
                                                    </span>
                                                </a>
                                                <a href="javascript:void()"
                                                    id="{{$stock_detail->product_detail->product_detail_id}}"
                                                    class="remove_product_detail_in_stock text-warning" data-toggle="modal"
                                                    data-original-title="Tắt Hoạt Động Chi Tiết Sản Phẩm"
                                                    data-target="#removeProduct">
                                                    <span data-toggle="tooltip"
                                                        data-original-title="Tắt Hoạt Động Chi Tiết Sản Phẩm"><i
                                                            class="icon-trash"></i></span>
                                                </a>
                                                @else
                                                <a href="javascript:void()"
                                                    id="{{$stock_detail->product_detail->product_detail_id}}"
                                                    class="recover_product_detail_in_stock text-warning" data-toggle="modal"
                                                    data-original-title="Khôi Phục Chi Tiết Sản Phẩm"
                                                    data-target="#recoverProduct">
                                                    <span data-toggle="tooltip"
                                                        data-original-title="Khôi Phục Chi Tiết Sản Phẩm"><i
                                                            class="glyphicon glyphicon-circle-arrow-left"></i></span>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="odd">
                                            <td valign="top" colspan="9" class="text-center dataTables_empty">Danh sách
                                                trống</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!--Modal Update Product-->
    <div class="modal fade" id="updateProduct" tabindex="-1" role="dialog" aria-labelledby="updateProduct"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProduct">Cập Nhật Sản Phẩm
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('update-product')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- IMAGE -->
                        <div class="card-body">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner m-auto" id="carousel-img" style="width:250px;height:250px">
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon text-black bg-red-dark-1"
                                        aria-hidden="true"></span>
                                    <span class="sr-only text-black">Trước</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon text-black bg-red-dark-1"
                                        aria-hidden="true"></span>
                                    <span class="sr-only text-black">Sau</span>
                                </a>
                            </div>
                        </div>
                        <!-- IMAGE -->

                        <input type="text" name="product_detail_id" id="product_detail_id" hidden=true>
                        <div class="form-group">
                            <label for="inputProductName">Tên Sản Phẩm</label>
                            <input type="text" name="product_name" id="inputProductName" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputCategoryName">Loại Sản Phẩm</label>
                            <input type="text" name="category_name" id="inputCategoryName" class="form-control"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputProducerName">Nhà Cung Cấp</label>
                            <input type="text" name="producer_name" id="inputProducerName" class="form-control"
                                disabled>
                        </div>
                        <div class="form-group" id="color_id">
                            <label for="inputColor">Màu Sắc</label>
                            <input type="text" name="color_id" id="inputColor" class="form-control" disabled>
                        </div>
                        <div class="form-group" id="size_id">
                            <label for="inputSize">Kích Thước</label>
                            <input type="text" name="size_id" id="inputSize" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputProductPrice">Giá Nhập</label>
                            <input type="text" name="price" id="inputProductPrice" class="form-control" disabled>
                        </div>
                        <div class="form-group price_pay">
                            <label for="inputPricePay">Giá Bán</label>
                            <input type="text" name="price_pay" id="inputPricePay" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputQuantity">Tồn Kho</label>
                            <input type="text" name="quantity" id="inputQuantity" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputSaleOff">Giảm giá</label>
                            <input type="text" name="sale_off" id="inputSaleOff" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn-update-product btn btn-primary btn-block" type="submit">Cập nhật Sản
                                Phẩm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Order Product Detail-->
    <div class="modal fade" id="orderProduct" tabindex="-1" role="dialog" aria-labelledby="orderProduct"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderProduct">Nhập Chi Tiết Sản Phẩm
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('order-product-again-in-stock')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- IMAGE -->
                        <div class="card-body">
                            <div id="carouselExampleIndicators_1" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner m-auto" id="carousel-img" style="width:250px;height:250px">
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators_1" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon text-black bg-red-dark-1"
                                        aria-hidden="true"></span>
                                    <span class="sr-only text-black">Trước</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators_1" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon text-black bg-red-dark-1"
                                        aria-hidden="true"></span>
                                    <span class="sr-only text-black">Sau</span>
                                </a>
                            </div>
                        </div>
                        <!-- IMAGE -->
                        <input type="text" name="product_detail_id" id="product_detail_id" hidden=true>
                        <div class="form-group">
                            <label for="inputProductName">Tên Sản Phẩm</label>
                            <input type="text" name="product_name" id="inputProductName" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputCategoryName">Loại Sản Phẩm</label>
                            <input type="text" name="category_name" id="inputCategoryName" class="form-control"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputProducerName">Nhà Cung Cấp</label>
                            <input type="text" name="producer_name" id="inputProducerName" class="form-control"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputQuantity">Tồn Kho</label>
                            <input type="text" name="quantity" id="inputQuantity" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputProductPrice">Giá Nhập</label>
                            <input type="text" name="price" id="inputProductPrice" class="form-control" disabled>
                        </div>
                        <div class="form-group" id="color_id">
                            <label for="inputColor">Màu Sắc</label>
                            <input type="text" name="color_id" id="inputColor" class="form-control" disabled>
                        </div>
                        <div class="form-group" id="size_id">
                            <label for="inputSize">Kích Thước</label>
                            <input type="text" name="size_id" id="inputSize" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputPricePay">Giá Bán</label>
                            <input type="text" name="price_pay" id="inputPricePay" class="form-control" readonly>
                        </div>
                        <div class="form-group quantity_order">
                            <label for="inputQuantity">Số lượng</label>
                            <input type="number" min="1" name="quantity" id="inputQuantity" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn-order-product btn btn-primary btn-block" type="submit">Nhập Sản
                                Phẩm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Remove Product-->
    <!-- /Row -->
    <div class="modal fade" id="removeProduct" tabindex="-1" role="dialog" aria-labelledby="removeProduct"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeProduct">Ngưng Hoạt Động Sản Phẩm
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn ngưng hoạt động sản phẩm?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-remove-product btn btn-primary">Xác Nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Recover Product-->
    <!-- /Row -->
    <div class="modal fade" id="recoverProduct" tabindex="-1" role="dialog" aria-labelledby="recoverProduct"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recoverProduct">Khôi phục lại sản phẩm
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn khôi phục lại?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-recover-product btn btn-primary">Khôi phục lại</button>
                </div>
            </div>
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
<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('vendors4/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('vendors4/jszip/dist/jszip.min.js')}}"></script>
<script src="{{ asset('vendors4/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{ asset('vendors4/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('dist/js/dataTables-data.js')}}"></script>
<script src="{{ asset('dist/js/feather.min.js')}}"></script>
<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
<script src="{{ asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
<script src="{{ asset('dist/js/toggle-data.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<script type='text/javascript' src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.min.js"></script>
<script src="{{ asset('dist/js/validation-form.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/product_detail.js') }}"></script>
@endsection
