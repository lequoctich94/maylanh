@extends('layouts')

@section('title','Thêm Sản Phẩm')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Data Table CSS -->
<link href="{{ asset('vendors4/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors4/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet"
    type="text/css" />

<!-- Bootstrap Dropzone CSS -->
<link href="{{ asset('vendors4/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
<!-- Bootstrap Dropzone CSS -->

<!-- <link href="{{ asset('vendors4/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" /> -->

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
        <li class="breadcrumb-item displayFlex">Quản Lý</li>
        <li class="breadcrumb-item active displayFlex" aria-current="page"><a
                href="{{ route('product-management') }}">Sản Phẩm</a>
        </li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Thêm Sản Phẩm Mới</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                        data-feather="database"></i></span></span>Nhập Sản Phẩm</h4>
        <span class="pg-title-icon boxShadowLarge">
            <div style="display:flex;align-items:flex-end;justify-content:flex-end;flex-direction: column;">
                <div class="d-lg-flex">
                    <h6 class="font-weight-normal pr-1">Sản Phẩm Đã Chọn</h6>
                    <a href="#" id="listCartOrder" data-toggle="modal" data-target="#listCart" class="feather-icon">
                        <i data-feather="shopping-cart"></i>
                        <p class="shopping-cart-quantity">
                            {{request()->session()->has("cart") ?
                            count(request()->session()->get("cart")) : "0" }}
                        </p>
                    </a>
                </div>
                <label for="inputTime"><em style="color:rgb(227, 17, 17);font-size:15px;">(*Sản phẩm trong giỏ hàng sẽ
                        được làm mới nếu
                        bạn
                        chuyển
                        đổi
                        NCC khác)</em></label>
            </div>
        </span>

    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <div class="row">
                    <div class="col-sm">
                        <div class="choose">
                            <div class="form-group">
                                <label for="inputTime">Nhà Cung Cấp <em style="color:rgb(227, 17, 17);">(*Chọn nhà cung
                                        cấp)</em></label>
                                <select name="producerName" class="form-control custom-select">
                                    <option value="none" selected>Chọn Nhà Cung Cấp</option>
                                    @foreach($producers as $producer)
                                    <option value="{{$producer->producer_id}}">
                                        {{$producer->producer_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4 form-group">
                                <label for="inputTime">Loại Sản Phẩm <em style="color:rgb(227, 17, 17);">(*Chọn loại sản
                                        phẩm thuộc nhà cung
                                        cấp)</em></label>
                                <select name="categoryName" class="form-control custom-select">
                                    <option value="none" selected>Chọn Loại Sản Phẩm</option>
                                </select>
                            </div>
                        </div>
                        <div class="container d-flex mt-2">
                            <div name="listProduct" class="row boxListProduct">
                                <p class="align-center">Danh Sách Trống</p>
                            </div>
                        </div>
                        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProduct"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark">
                                        <h6 class="modal-title text-white" id="addProduct">Nhập
                                            Sản Phẩm</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div id="carouselExampleIndicators" class="carousel slide"
                                                data-ride="carousel">
                                                <div class="carousel-inner m-auto" id="carousel-img"
                                                    style="width:250px;height:250px">
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                                    role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon text-black bg-red-dark-1"
                                                        aria-hidden="true"></span>
                                                    <span class="sr-only text-black">Trước</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleIndicators"
                                                    role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon text-black bg-red-dark-1"
                                                        aria-hidden="true"></span>
                                                    <span class="sr-only text-black">Sau</span>
                                                </a>
                                            </div>
                                        </div>
                                        <input type="text" class="product_id" name="product_id" hidden="true">
                                        <div class="form-group">
                                            <label for="inputProductName">Tên Sản Phẩm</label>
                                            <input type="text" disabled id="inputProductName"
                                                class="form-control product_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputCategory">Tên Loại</label>
                                            <input type="text" disabled id="inputCategory"
                                                class="form-control category_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputProducer">Nhà Cung Cấp</label>
                                            <input type="text" disabled id="inputProducer"
                                                class="form-control producer_name">
                                        </div>
                                        <div class="form-group color_name">
                                            <label for="inputColor">Màu</label>
                                            <select class="form-control custom-select" id="color_id" name="color_id">
                                            </select>
                                        </div>
                                        <div class="form-group d-none" id="size">
                                            <label for="inputSize">Kích Thước</label>
                                            <select class="selectpicker form-control custom-select" multiple
                                                data-live-search="true"
                                                data-none-selected-text="Vui lòng chọn kích thước..." name="size_id[]"
                                                id="size_id">
                                            </select>
                                        </div>
                                        <div class="form-group quantity">
                                            <label for="inputQuantity">Số lượng</label>
                                            <input type="number" value="1" min="1" max="99" name="quantity"
                                                id="inputQuantity" class="form-control">
                                        </div>
                                        <div class="form-group price_pay">
                                            <label for="inputTime">Giá Bán *(Giá sản phẩm trong kho sẽ được cập nhật
                                                theo giá
                                                nhập hàng gần nhất)</label>
                                            <input type="text" name="price_pay" id="inputPricePay" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button id="add-product-to-cart" class="btn btn-primary btn-block mr-10"
                                                type="button" value="submit">Nhập Hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="modal fade" id="listCart" tabindex="-1" role="dialog" aria-labelledby="listCart"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Giỏ Hàng</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="cart" action="{{route('order-product-in-stock')}}" method="POST">
                                @csrf
                                <table class="table mb-0" id="infor-product">
                                    <tbody>
                                        <tr>
                                            <th>Hình Ảnh</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Kích Thước</th>
                                            <th>Màu</th>
                                            <th>Giá Nhập</th>
                                            <th>Giá Bán</th>
                                            <th>Số Lượng</th>
                                            <th>Tổng Nhập</th>
                                            <th></th>
                                        </tr>
                                    </tbody>
                                    <tfoot class="addToCart-bottom boxShadowSmall">
                                        <tr>
                                            <td class="text-right" colspan="4"><small
                                                    class="pr-2 text-left font-weight-500">Tổng
                                                    Tiền:</small><span class="text-light font-weight-500 total-price">0
                                                    VNĐ</span>
                                            </td>
                                            <td class="text-right" colspan="2"><small
                                                    class="pr-2 text-left font-weight-500">Tổng
                                                    Số Lượng:</small><span
                                                    class="text-light font-weight-500 total-quantity">0</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- /Row -->

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
<script src="{{ asset('vendors4/dropzone/dist/dropzone.js')}}"></script>
<script src="{{ asset('dist/js/form-file-upload-data.js')}}"></script>
<script src="{{ asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
<script src="{{ asset('dist/js/toggle-data.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<script type='text/javascript' src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8/jquery.validate.min.js"></script>
<script src="{{ asset('dist/js/validation-form.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/add_product.js') }}"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

@endsection