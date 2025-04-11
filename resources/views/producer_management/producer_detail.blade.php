@extends('layouts')

@section('title','Sản Phẩm Nhà Cung Cấp')

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

<!-- Bootstrap Dropzone CSS -->
<link href="{{ asset('vendors4/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />

<!-- Custom CSS -->
<link href="{{ asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="{{route('index')}}">Quản Lý</a></li>
        <li class="breadcrumb-item displayFlex"><a href="{{route('producer-management')}}">Nhà Cung Cấp</a></li>
        <li class="breadcrumb-item active displayFlex">Sản Phẩm</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                        data-feather="database"></i></span></span>
            Danh Sách Sản Phẩm</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <button type="button" data-toggle="modal" data-target="#addProduct"
                    class="btn-add-product-one btn btn-primary btn-block mb-20 w-20">
                    Tạo Sản Phẩm
                </button>
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1" class="table table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình ảnh</th>
                                        <th style="width:200px">Tên Sản Phẩm</th>
                                        <th style="width:100px">Loại Sản Phẩm</th>
                                        <th style="width:180px">Nhà Cung Cấp</th>
                                        <th>Ngày Tạo</th>
                                        <th>Ngày Cập Nhật</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($products != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td style="padding:4px;">
                                            <img width="100" height="100" style="object-fit:cover;"
                                                src="{{env('APP_URL')}}/upload/products/{{$product->product_id}}/{{$product->product_img}}"
                                                alt="{{$product->product_name}}">
                                        </td>
                                        <td style="width:200px">{{$product->product_name}}</td>
                                        <td style="width:100px">{{$product->category->category_name}}</td>
                                        <td style="width:180px">{{$product->producer->producer_name}}</td>
                                        <td>{{$product->created_at}}</td>
                                        <td>{{$product->updated_at}}</td>
                                        @if($product->status==1)
                                        <td><span class="badge badge-success">Hoạt Động</span></td>
                                        @else
                                        <td><span class="badge badge-danger">Tạm Ngưng</span></td>
                                        @endif
                                        <td style="text-align:center;">
                                            @if($product->status == 1)
                                            <a href="{{route('producer-product-detail',['product_id'=>$product->product_id ])}}"
                                                data-toggle="tooltip" data-original-title="Xem Chi Tiết"><i
                                                    class="icon-eye text-green"></i>
                                            </a>
                                            <a class="text-danger" data-toggle="modal"
                                                data-original-title="Xoá Sản Phẩm" data-target="#deleteProducerProduct">
                                                <i data-toggle="tooltip" data-original-title="Xoá Sản Phẩm"
                                                    class="remove_product icon-trash"
                                                    product_id="{{ $product->product_id }}"></i>
                                            </a>
                                            @else
                                            <a data-toggle="modal" data-original-title="Khôi phục Sản Phẩm"
                                                data-target="#restoreProducerProductDetail" class="text-warning"> <i
                                                    data-toggle="tooltip" data-original-title="Khôi phục Sản Phẩm"
                                                    class="recover_product glyphicon glyphicon-circle-arrow-left"
                                                    product_id="{{ $product->product_id }}"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="10" class="text-center dataTables_empty">Danh sách
                                            trống</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProduct"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Thêm Sản Phẩm</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body product-body">
                            <form class="body-product" action="{{route('add-product')}}" method="POST"
                                enctype="multipart/form-data" mui>
                                @csrf
                                <input type="text" hidden="true" name="producer_id" value="{{$producer_id}}">
                                <div class="form-group category">
                                    <label for="inputCategory">Chọn Loại</label>
                                    <select name="category_id" class="form-control custom-select list-category"
                                        id="category-selected">
                                        <option value="none" selected>Chọn Loại Sản Phẩm
                                        </option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->category_id}}">
                                            {{$category->category_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group product_name">
                                    <label for="inputProductName">Tên Sản Phẩm</label>
                                    <input type="text" name="product_name" id="inputProductName" class="form-control">
                                </div>

                                <div class="form-group d-none">
                                    <label for="inputSize">Kích Thước</label>
                                    <select class="selectpicker form-control custom-select" multiple
                                        data-live-search="true" name="size_id[]" id="size_id">
                                    </select>
                                </div>

                                <div class="form-group color">
                                    <label for="inputColor">Màu Sắc</label>
                                    <select class="form-control custom-select" name="color_id" id="color-selected">
                                        <option value="none" selected>Chọn Màu Sắc
                                        </option>
                                        @foreach($colors as $color)
                                        <option value="{{$color->color_id}}">
                                            {{$color->color_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group product_name">
                                    <label for="inputProductName">Công Suất</label>
                                    <div class="d-flex">
                                        <input type="text" name="power" id="power" class="form-control col-sm-4 mr-2">
                                        <select class="form-control custom-select" name="power_unit" id="power_unit" style="width:150px">
                                            <option value="1">
                                                HP
                                            </option>
                                            <option value="2">
                                                W
                                            </option>
                                            <option value="3">
                                                KW
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group description">
                                    <label for="inputDescription">Mô tả sản phẩm</label>
                                    <div class="input-group">
                                        <textarea id="inputDescription" class="form-control" name="description" rows="5"
                                            placeholder="Nhập mô tả sản phẩm..." aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                                <div class="form-group price_produced">
                                    <label for="inputProductPriceProduced">Giá Nhập</label>
                                    <input type="text" id="inputProductPriceProduced" name="price_produced"
                                        name="price_produced" value="0" class="form-control price_produced">
                                </div>
                                <section class="image hk-sec-wrapper">
                                    <h5 class="hk-sec-title">Chọn hình ảnh của Sản Phẩm</h5>
                                    <p class="mb-40">Vui lòng chọn ảnh để hiện thị Sản Phẩm (Kích Thước: 1024x1024)</p>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="fallback">
                                                <input name="images[]" type="file" multiple id="image"
                                                    accept="image/png,image/jpeg,image/bmp,image/gif" />
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="form-group">
                                    <button id="add_event" class="btn-add-product btn btn-primary btn-block mr-10"
                                        type="submit">Tạo</button>
                                </div>
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
<script src="{{ asset('dist/js/jquery.slimscroll.js')}}"></script>
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
<script src="{{ asset('vendors4/dropzone/dist/dropzone.js')}}"></script>
<script src="{{ asset('dist/js/form-file-upload-data.js')}}"></script>
<script src="{{ asset('dist/js/validation-form.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/producer_detail.js')}}"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

@endsection