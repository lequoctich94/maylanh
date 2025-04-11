@extends('layouts')

@section('title','Màu - Kích Thước')

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
        <li class="breadcrumb-item">Quản Lý</li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Màu - Kích Thước</li>
    </ol>
</nav>
<!-- /Breadcrumb -->
@if($errors->has('color_error'))
<p>{{$errors->first('color_error')}}</p>
@endif
<!-- Container -->
<div class="container">
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <div class="row">
                    <div class="col-sm">
                        <!-- Title -->
                        <div class="hk-pg-header">
                            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                                            data-feather="database"></i></span></span>Dánh Sách Màu</h4>
                        </div>
                        <!-- /Title -->
                        <a href="javascript:void(0)">
                            <button type="button" class="btn_add_color btn btn-primary btn-inline mb-20"
                                data-toggle="modal" data-target="#addColor">
                                Thêm Màu Mới
                            </button>
                        </a>
                        @if($errors->any() && $errors->has('errorColorSave'))
                        <div class="checkError-red">{{$errors->first('errorColorSave')}}</div>
                        @endif
                        @if($errors->any() && $errors->has('errorColorUpdate'))
                        <div class="checkError-red">{{$errors->first('errorColorUpdate')}}</div>
                        @endif
                        <div class="table-wrap">
                            <table id="datable_1" class="table table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID Màu</th>
                                        <th>Tên Màu</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($colors != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($colors as $color)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ $color->color_id }}</td>
                                        <td>{{ $color->color_name }}</td>
                                        @if($color->status==1)
                                        <td><span class="badge badge-success">Còn Hoạt Động</span></td>
                                        @else
                                        <td><span class="badge badge-danger">Ngưng Hoạt Động</span></td>
                                        @endif
                                        <td style="text-align:center;">
                                            <a href="javascript:void(0)" id="{{$color->color_id}}"
                                                class="btn_update_color marginRight" data-toggle="modal"
                                                data-target="#updateColor" data-original-title="Cập Nhật Màu Sắc">
                                                <span data-toggle="tooltip" data-original-title="Cập Nhật Màu Sắc"><i
                                                        class="icon-pencil text-green"></i></span>
                                            </a>
                                            @if($color->status==1)
                                            <a href="javascript:void(0)" id="{{$color->color_id}}"
                                                class="remove_color text-warning" data-toggle="modal"
                                                data-original-title="Xoá Màu Sắc" data-target="#removeColor">
                                                <span data-toggle="tooltip" data-original-title="Xoá Màu Sắc"><i
                                                        class="icon-trash"></i></span>
                                            </a>
                                            @else
                                            <a href="javascript:void(0)" id="{{$color->color_id}}"
                                                class="recover_color text-warning" data-toggle="modal"
                                                data-original-title="Khôi Phục Màu Sắc" data-target="#recoverColor">
                                                <span data-toggle="tooltip" data-original-title="Phôi Phục Màu Sắc"><i
                                                        class="glyphicon glyphicon-circle-arrow-left"></i></span>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class=" text-center dataTables_empty">Danh sách màu
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

    <!--Modal Add Color-->
    <div class="modal fade" id="addColor" tabindex="-1" role="dialog" aria-labelledby="addColor" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Thêm Màu Mới</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('add-color')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group color_name">
                            <label for="inputColorName">Tên Màu</label>
                            <input type="text" placeholder="Vui Lòng điền màu cần thêm" name="color_name"
                                id="inputColorName" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn-add-color btn btn-primary btn-block mr-10" type="submit">Thêm Màu
                                Mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Remove Color-->
    <div class="modal fade" id="removeColor" tabindex="-1" role="dialog" aria-labelledby="removeColor"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeColor">Xoá Màu
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn xoá màu này?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-remove-color btn btn-primary">Xoá
                        màu</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Update Color-->
    <div class="modal fade" id="updateColor" tabindex="-1" role="dialog" aria-labelledby="updateColor"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h6 class="modal-title text-white" id="updateColor">Cập Nhật Màu Mới</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('update-color')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="color_id" id="color_id" hidden=true>
                        <div class="form-group color_name">
                            <label for="inputColorName">Tên Màu</label>
                            <input type="text" placeholder="Vui Lòng điền màu cần cập nhật" name="color_name"
                                id="inputColorName" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn-update-color btn btn-primary btn-block mr-10" type="submit">Cập Nhật Màu
                                Mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Recover Color-->
    <div class="modal fade" id="recoverColor" tabindex="-1" role="dialog" aria-labelledby="recoverColor"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recoverColor">Khôi Phục Màu
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn khôi phục màu này?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-recover-color btn btn-primary">Khôi phục
                        màu</button>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <div class="row">
                    <div class="col-sm">
                        <!-- Title -->
                        <div class="hk-pg-header">
                            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                                            data-feather="database"></i></span></span>Dánh Sách Kích Thước</h4>
                        </div>
                        <!-- /Title -->
                        <a href="javascript:void(0)">
                            <button type="button" class="btn_add_size btn btn-primary btn-inline mb-20"
                                data-toggle="modal" data-target="#addSize">
                                Thêm Kích Thước Mới
                            </button>
                        </a>
                        @if($errors->any() && $errors->has('errorSizeSave'))
                        <div class="checkError-red">{{$errors->first('errorSizeSave')}}</div>
                        @endif
                        @if($errors->any() && $errors->has('errorSizeUpdate'))
                        <div class="checkError-red">{{$errors->first('errorSizeUpdate')}}</div>
                        @endif
                        <div class="table-wrap">
                            <table id="datable_11" class="table table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID Kích Thước</th>
                                        <th>Tên Kích Thước</th>
                                        <th>Loại Sản Phẩm</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($sizes != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($sizes as $size)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $size->size_id }}</td>
                                        <td>{{ $size->size_name }}</td>
                                        <td>{{ $size->category->category_name }}</td>
                                        @if($size->status==1)
                                        <td><span class="badge badge-success">Còn Hoạt Động</span></td>
                                        @else
                                        <td><span class="badge badge-danger">Ngưng Hoạt Động</span></td>
                                        @endif
                                        <td style="text-align:center;">
                                            <a href="javascript:void(0)" id="{{$size->size_id}}"
                                                class="btn_update_size marginRight" data-toggle="modal"
                                                data-target="#updateSize" data-original-title="Cập Nhật Kích Thước">
                                                <span data-toggle="tooltip" data-original-title="Cập Nhật Kích Thước"><i
                                                        class="icon-pencil text-green"></i></span>
                                            </a>
                                            @if($size->status==1)
                                            <a href="javascript:void(0)" id="{{$size->size_id}}"
                                                class="remove_size text-warning" data-toggle="modal"
                                                data-original-title="Xoá Kích Thước" data-target="#removeSize">
                                                <span data-toggle="tooltip" data-original-title="Xoá Kích Thước"><i
                                                        class="icon-trash"></i></span>
                                            </a>
                                            @else
                                            <a href="javascript:void(0)" id="{{$size->size_id}}"
                                                class="recover_size text-warning" data-toggle="modal"
                                                data-original-title="Khôi Phục Kích Thước" data-target="#recoverSize">
                                                <span data-toggle="tooltip"
                                                    data-original-title="Khôi Phục Kích Thước"><i
                                                        class="glyphicon glyphicon-circle-arrow-left"></i></span>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="text-center dataTables_empty">Danh sách
                                            kích thước trống</td>
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

    <!--Model Add Size-->
    <div class="modal fade" id="addSize" tabindex="-1" role="dialog" aria-labelledby="addSize" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Thêm Kích Thước Mới</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('add-size')}}" method="POST">
                        @csrf
                        <div class="form-group size_name">
                            <label for="inputSizeName">Tên Kích Thước</label>
                            <input type="text" placeholder="Vui Lòng điền màu cần thêm" name="size_name"
                                id="inputSizeName" class="form-control">
                        </div>
                        <div class="form-group category">
                            <label for="inputCategoryName">Loại Sản Phẩm</label>
                            <select name="category_id" class="form-control custom-select" id="category-selected">
                                <option value="none" selected>Chọn Loại Sản Phẩm</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->category_id }}">
                                    {{ $category->category_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn-add-size btn btn-primary btn-block mr-10" type="submit">Thêm Kích Thước
                                Mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Update Size-->
    <div class="modal fade" id="updateSize" tabindex="-1" role="dialog" aria-labelledby="updateSize" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h6 class="modal-title text-white" id="updateSize">Cập Nhật Kích Thước</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('update-size')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="size_id" id="size_id" hidden=true>
                        <div class="form-group size_name">
                            <label for="inputSizeName">Tên Kích Thước</label>
                            <input type="text" placeholder="Vui Lòng điền kích thước cần cập nhật" name="size_name"
                                id="inputSizeName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputCategoryName">Loại Sản Phẩm</label>
                            <input type="text" name="category_name" id="inputCategoryName" class="form-control"
                                disabled>
                        </div>
                        <div class="form-group">
                            <button class="btn-update-size btn btn-primary btn-block mr-10" type="submit">Cập Nhật Kích
                                Thước</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Remove Size-->
    <div class="modal fade" id="removeSize" tabindex="-1" role="dialog" aria-labelledby="removeSize" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeSize">Xoá Kích Thước
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn xoá sản phẩm?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-remove-size btn btn-primary">Xoá
                        kích thước</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Recover Size-->
    <div class="modal fade" id="recoverSize" tabindex="-1" role="dialog" aria-labelledby="recoverSize"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recoverSize">Khôi Phục Kích Thước
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn khôi phục kích thước này?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-recover-size btn btn-primary">Khôi phục
                        kích thước</button>
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
<script type="text/javascript" src="{{ asset('js/jquery/size_and_color.js') }}"></script>
@endsection