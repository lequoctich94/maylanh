@extends('layouts')
@section('title','Quản Lý Giảm Giá Theo Cấp Bậc')

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
        <li class="breadcrumb-item displayFlex" aria-current="page"><a href="{{route('rank-management')}}">Quản Lý Cấp
                Bậc</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">{{$rank_id}}</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">


    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <h5 class="hk-sec-title">Danh Sách Ưu Đãi Của Cấp: {{$rank_id}}</h5>
                <button type="button" class="btn btn-primary btn-block mt-50 mb-20 w-20" data-toggle="modal"
                    data-target="#addDiscountCategory">
                    Thêm ưu đãi
                </button>
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1" class="table table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mục Giảm Giá</th>
                                        <th>Phần Trăm Giảm</th>
                                        <th>Hạng</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($discount_categories != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($discount_categories as $discount_category)
                                    <tr>
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$discount_category->category->category_name}}</td>
                                        <td>{{$discount_category->percent_price}}%</td>
                                        <td>{{$discount_category->rank->rank_name}}</td>
                                        @if($discount_category->status==1)
                                        <td><span class="badge badge-success">Còn Hoạt Động</span></td>
                                        @else
                                        <td><span class="badge badge-danger">Ngừng Hoạt Động</span></td>
                                        @endif
                                        <td style="text-align: center;">
                                            <a href="javascript:void(0)" data-toggle="modal"
                                                data-original-title="Cập Nhật Giảm Giá Loại"
                                                data-target="#updateDiscountCategory" class="marginRight">
                                                <span data-toggle="tooltip"
                                                    data-original-title="Cập Nhật Giảm Giá Loại">
                                                    <i class="btn_update_discount_category icon-pencil"
                                                        id="{{ $discount_category->discount_id }}"></i>
                                                </span>
                                            </a>
                                            @if($discount_category->status==1)
                                            <a data-toggle="modal" data-original-title="Xoá Giảm Giá Loại"
                                                data-target="#deleteDiscountCategory" class="text-danger">
                                                <span data-toggle="tooltip" data-original-title="Xoá Giảm Giá Loại">
                                                    <i class="remove_discount icon-trash"
                                                        id="{{ $discount_category->discount_id }}"></i>
                                                </span> </a>
                                            @else
                                            <a data-toggle="modal" data-original-title="Khôi phục Giảm Giá Loại"
                                                data-target="#restoreDiscountCategory" class="text-warning"> <span
                                                    data-toggle="tooltip" data-original-title="Khôi phục Giảm Giá Loại">
                                                    <i class="recover_discount glyphicon glyphicon-circle-arrow-left"
                                                        id="{{ $discount_category->discount_id }}"></i>
                                                </span> </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="text-center dataTables_empty">Danh sách
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

</div>
<!-- /Container -->

<!-- /Modal Add Discount Category -->
<div class="modal fade" id="addDiscountCategory" tabindex="-1" role="dialog" aria-labelledby="addDiscountCategory"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Tạo Ưu Đãi Cho Bậc {{$rank_id}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add-discount-category')}}" method="POST">
                    @csrf
                    <input type="text" hidden="true" name="rank_id" value="{{$rank_id}}">
                    <div class="form-group category-add">
                        <label for="inputCategory">Chọn Loại</label>
                        <select name="category_id" class="form-control custom-select list-category"
                            id="category-id-selected">
                            <option value="none" selected>Chọn Loại Sản Phẩm</option>
                            @foreach($categories as $category)
                            <option value="{{$category->category_id}}">
                                {{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group percent-price-input">
                        <label for="inputPoint">Mức Giảm</label>
                        <input type="text" value="0" placeholder="Vui lòng nhập Mức Giảm" name="percent_price"
                            id="inputPercentPriceAdd" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn_submit_add_discount btn btn-primary btn-block mr-10" type="submit">Tạo Ưu
                            Đãi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /Modal Update Discount Category -->
<div class="modal fade" id="updateDiscountCategory" tabindex="-1" role="dialog" aria-labelledby="updateDiscountCategory"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Cập Nhật Ưu Đãi Cho Bậc {{$rank_id}}
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update-discount-category')}}" method="POST">
                    @csrf
                    <input type="text" hidden="true" name="discount_id" id="inputDiscountId">
                    <div class="form-group category">
                        <label for="inputCategory">Loại Sản Phẩm</label>
                        <select name="category_id" class="form-control custom-select list-category"
                            id="selectCategoryId">

                        </select>
                    </div>
                    <div class="form-group percent-price-update">
                        <label for="inputPercentPrice">Mức Giảm</label>
                        <input type="text" placeholder="Vui lòng nhập Mức Giảm" name="percent_price"
                            id="inputPercentPriceUpdate" class="form-control">
                    </div>
                    <input type="text" hidden="true" name="rank_id" value="{{$rank_id}}">
                    <div class="form-group">
                        <label for="inputPercentPrice">Hạng</label>
                        <input type="text" placeholder="Vui lòng nhập Mức Giảm" name="rank_name" id="inputRankName"
                            class="form-control" disabled="true">
                    </div>
                    <div class="form-group">
                        <button class="btn_submit_update_discount btn btn-primary btn-block mr-10" type="submit">Cập
                            Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /Modal Delete Discount Category -->
<div class="modal fade" id="deleteDiscountCategory" tabindex="-1" role="dialog" aria-labelledby="deleteDiscountCategory"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDiscountCategory">Xoá Ưu Đãi Cho Loại Sản Phẩm
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                    muốn xoá ưu đãi cho loại sản phẩm này?
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                    bỏ</button>
                <button type="button" id="" class="btn_remove_discount btn btn-primary">Xoá Ưu Đãi</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- /Modal Restore Discount Category -->
<div class="modal fade" id="restoreDiscountCategory" tabindex="-1" role="dialog"
    aria-labelledby="restoreDiscountCategory" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreDiscountCategory">Khôi Phục Ưu Đãi Cho Loại Sản Phẩm
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                    muốn khôi phục ưu đãi cho loại sản phẩm này?
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                    bỏ</button>
                <button type="button" id="" class="btn_recover_discount btn btn-primary">Khôi Phục</button>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

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
<script type="text/javascript" src="{{ asset('js/jquery/discount_category.js') }}"></script>
@endsection
