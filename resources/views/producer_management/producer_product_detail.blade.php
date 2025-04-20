@extends('layouts')

@section('title','Chi Tiết Sản Phẩm Nhà Cung Cấp')

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
        <li class="breadcrumb-item displayFlex"><a
                href="{{route('producer-detail', ['producer_id'=> $product->producer_id])}}">Sản Phẩm</a>
        </li>
        <li class="breadcrumb-item active displayFlex">Chi Tiết Sản Phẩm</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">
    <input hidden="true" name="product_id" value="{{$product->product_id}}">
    <input hidden="true" name="producer_id" value="{{$product->producer->producer_id}}">
    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                        data-feather="database"></i></span></span>
            Chi Tiết Sản Phẩm: {{$product->product_name}}</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <button type="button" data-toggle="modal" data-target="#addProducerProductDetail"
                    class="btn-add-product-detail-one btn btn-primary btn-block mb-20 w-20">
                    Tạo Chi Tiết Sản Phẩm
                </button>
                @if($errors->any() && $errors->has('errorProducerProductDetailSave'))
                <div class="checkError-red">{{$errors->first('errorProducerProductDetailSave')}}</div>
                @endif
                @if($errors->any() && $errors->has('errorSizeOfProducerProductDetailSave'))
                <div class="checkError-red">{{$errors->first('errorSizeOfProducerProductDetailSave')}}</div>
                @endif
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1"
                                class="table-responsive table table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình Ảnh</th>
                                        <th>Màu</th>
                                        <th style="width:100px;">Kích Thước</th>
                                        <th>Loại Sản Phẩm</th>
                                        <th>Giá Nhập</th>
                                        <th>Ngày Tạo</th>
                                        <th>Ngày Cập Nhật</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($product_details_distincts != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($product_details_distincts as $product_detail_distinct)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td style="padding:4px;">
                                            @foreach($product_detail_distinct->product->images as $image)
                                           
                                            <img width="100" height="100" style="object-fit:cover;"
                                                src="{{env('APP_URL')}}/upload/products/{{$image->product_id}}/{{$image->img_name}}"
                                                alt="{{$image->img_name}}">
                                            @break
                                           
                                            @endforeach
                                        </td>
                                        <td name="color_id" color_id="{{$product_detail_distinct->color->color_id ?? ''}}">
                                            @if($product_detail_distinct->color && $product_detail_distinct->color->color_id)
                                            {{$product_detail_distinct->color->color_name}}
                                            @endif
                                        </td>
                                        <td class="size_id" style="width:100px;">
                                            {{$product_detail_distinct->size_id  && $product_detail_distinct->size? $product_detail_distinct->size->size_name : ''}}
                                        </td>
                                        <td>{{$product_detail_distinct->product->category->category_name}}</td>
                                        <td name="price_produced">
                                            {{number_format($product_detail_distinct->price_produced)}}đ
                                        </td>
                                        <td name="date_create">{{$product_detail_distinct->product->created_at}}</td>
                                        <td name="date_update">{{$product_detail_distinct->product->updated_at}}</td>
                                        @if($product_detail_distinct->status==1)
                                        <td name="status"><span class="badge badge-success">Hoạt Động</span></td>
                                        @else
                                        <td name="status"><span class="badge badge-danger">Tạm Ngưng</span></td>
                                        @endif
                                        <td name="action_more">
                                            <div
                                                class="action_detail {{ $product_detail_distinct->status==0 ? 'd-none': '' }}">
                                                <a class="marginRight" data-toggle="modal" data-toggle="tooltip"
                                                    data-original-title="Cập nhật ảnh"
                                                    data-target="#editImageProducerProductDetail"><i
                                                        data-toggle="tooltip" data-original-title="Sửa"
                                                        class="btn_edit_image icon-pencil text-green"
                                                        product_detail_id="{{ $product_detail_distinct->product_detail_id }}"
                                                        >
                                                    </i>
                                                </a>
                                                <a class="text-danger" data-toggle="modal"
                                                    data-original-title="Xoá Chi Tiết Sản Phẩm"
                                                    data-target="#deleteProducerProductDetail"> <i data-toggle="tooltip"
                                                        data-original-title="Xoá Chi Tiết Sản Phẩm"
                                                        class="remove_ppd icon-trash"
                                                        product_detail_id="{{ $product_detail_distinct->product_detail_id }}"></i>
                                                </a>
                                            </div>
                                            <div
                                                class="action_recover {{ $product_detail_distinct->status == 1 ? 'd-none': '' }}">
                                                <a data-toggle="modal" data-original-title="Khôi phục Chi Tiết Sản Phẩm"
                                                    data-target="#restoreProducerProductDetail" class="text-warning"> <i
                                                        data-toggle="tooltip"
                                                        data-original-title="Khôi phục Chi Tiết Sản Phẩm"
                                                        class="recover_ppd glyphicon glyphicon-circle-arrow-left"
                                                        product_detail_id="{{ $product_detail_distinct->product_detail_id }}"></i>
                                                </a>
                                            </div>
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

        </div>
    </div>
    <!-- /Row -->
    <!--Modal Add New Product Detail In Producer-->
    <div class="modal fade" id="addProducerProductDetail" tabindex="-1" role="dialog"
        aria-labelledby="addProducerProductDetail" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h6 class="modal-title text-white" id="addProducerProductDetail">Thêm Chi Tiết Sản Phẩm</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body product-body">
                    <form class="body-product"
                        action="{{route('add-producer-product-detail',['product_id'=> $product->product_id ])}}"
                        method="POST" enctype="multipart/form-data" mui>
                        @csrf
                        <div class="form-group">
                            <label for="inputProducerName">Nhà Cung Cấp</label>
                            <input type="text" name="producer_name" disabled
                                value="{{$product->producer->producer_name}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="inputProductName">Tên Sản Phẩm</label>
                            <input type="text" disabled name="product_name" value="{{$product->product_name}}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="inputCategoryName">Tên Loại Sản Phẩm</label>
                            <input type="text" disabled name="category_name"
                                value="{{$product->category->category_name}}" class="form-control">
                        </div>
                        <div class="form-group color">
                            <label for="inputColorName">Màu Sắc</label>
                            <select name="color_id" class="form-control custom-select" id="color-selected">
                                <option value="none" selected>Chọn Màu
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
                        <div class="form-group">
                            <label for="inputSize">Kích Thước</label>
                            <select class="selectpicker form-control custom-select size_add_new" multiple
                                data-live-search="true" name="size_id[]">
                                @foreach($sizes as $size)
                                <option value="{{$size->size_id}}">{{$size->size_name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
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
                                        <input id="image" name="images[]" type="file" multiple />
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="form-group">
                            <button id="add_event" class="btn-add-product-detail btn btn-primary btn-block mr-10"
                                type="submit">Tạo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Edit Image Product Detail In Producer-->
    <div class="modal fade" id="editImageProducerProductDetail" tabindex="-1" role="dialog"
        aria-labelledby="editImageProducerProductDetail" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-dark">
                    <h6 class="modal-title text-white" id="editImageProducerProductDetail">Cập Nhật Chi Tiết Sản Phẩm</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body product-body">
                    <form class="body-product"
                        action="/edit-image-producer-product-detail/{{ $product_detail_distinct->product_detail_id }}"
                        method="POST" enctype="multipart/form-data" mui>
                        @csrf
                        <!-- IMAGE -->
                        <div class="card-body">
                            <div id="carouselExampleIndicators_2" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner m-auto" id="carousel-img" style="width:250px;height:250px">
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators_2" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon text-black bg-red-dark-1"
                                        aria-hidden="true"></span>
                                    <span class="sr-only text-black">Trước</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators_2" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon text-black bg-red-dark-1"
                                        aria-hidden="true"></span>
                                    <span class="sr-only text-black">Sau</span>
                                </a>
                            </div>
                        </div>
                        <!-- IMAGE -->
                        <div class="form-group">
                            <label for="inputProductName">Tên Sản Phẩm</label>
                            <input type="text" disabled name="product_name" value="{{$product->product_name}}"
                                class="form-control">
                        </div>
                        <select name="color_id" class="form-control custom-select" id="color-selected">
                            <option value="" selected>Chọn Màu
                            </option>
                            @foreach($colors as $color)
                            <option value="{{$color->color_id}}">
                                {{$color->color_name}}
                            </option>
                            @endforeach
                        </select>

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
                        
                        <div class="form-group">
                            <label for="inputSize">Kích Thước</label>
                            <select class="form-control"
                                data-live-search="true" name="size_id">
                                @foreach($sizes as $size)
                                <option value="{{$size->size_id}}">{{$size->size_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputProductPrice">Giá Nhập (!= 0 sẽ cập nhật lại giá & nhập >-1)*</label>
                            <input type="text" id="inputProductPrice" name="price_produced" value="0"
                                class="form-control update-price_produced">
                        </div>
                        <section class="image hk-sec-wrapper">
                            <h5 class="hk-sec-title">Thêm hình ảnh cho chi tiết sản phẩm này</h5>
                            <p class="mb-40">Vui lòng chọn hình ảnh để thêm</p>
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
                            <button id="add_event" class="btn-edit-image btn btn-primary btn-block mr-10"
                                type="submit">Cập
                                Nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
    <!-- /Modal Delete Producer Product Detail -->
    <div class="modal fade" id="deleteProducerProductDetail" tabindex="-1" role="dialog"
        aria-labelledby="deleteDiscountCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProducerProductDetail">Xoá Chi Tiết Sản Phẩm Của Nhà Cung Cấp
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn xoá chi tiết sản phẩm này?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn_remove_ppd btn btn-primary">Xoá Chi Tiết</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /Modal Restore Producer Product Detail -->
<div class="modal fade" id="restoreProducerProductDetail" tabindex="-1" role="dialog"
    aria-labelledby="restoreDiscountCategory" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreProducerProductDetail">Khôi Phục Chi Tiết Sản Phẩm Của Nhà Cung Cấp
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                    muốn khôi phục chi tiết sản phẩm này?
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                    bỏ</button>
                <button type="button" id="" class="btn_recover_ppd btn btn-primary">Khôi Phục</button>
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
<script src="{{ asset('vendors4/dropzone/dist/dropzone.js')}}"></script>
<script src="{{ asset('dist/js/form-file-upload-data.js')}}"></script>
<script src="{{ asset('dist/js/validation-form.js')}}"></script>
<script src="{{ asset('js/jquery/common.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/producer_product_detail.js') }}"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endsection
