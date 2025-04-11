@extends('layouts')
@section('title',"Nhà Cung Cấp")
@section('header')
<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Bootstrap table CSS -->
<link href="{{ asset('vendors4/bootstrap-table/dist/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />

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
        <li class="breadcrumb-item active displayFlex" aria-current="page">Danh Sách Hãng Sản Xuất</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">
    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                        data-feather="archive"></i></span></span>Danh Sách Hãng Sản Xuất</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <button type="button" data-toggle="modal" data-target="#addProducer"
                    class="btn_add_producer btn btn-primary btn-block mb-20 w-20">
                    Thêm Hãng Sản Xuất
                </button>
                @if($errors->any() && $errors->has('errorProducerSave'))
                <div class="checkError-red">{{$errors->first('errorProducerSave')}}</div>
                @endif
                @if($errors->any() && $errors->has('errorProducerUpdate'))
                <div class="checkError-red">{{$errors->first('errorProducerUpdate')}}</div>
                @endif
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1"
                                class="table mb-0 table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID</th>
                                        <th>Tên Nhà Cung Cấp</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Địa Chỉ</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($producers != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach( $producers as $producer)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$producer->producer_id}}</td>
                                        <td>
                                            <h6>{{$producer->producer_name}}</h6>
                                        </td>
                                        <td>{{$producer->phone}}</td>
                                        <td>{{$producer->address}}</td>
                                        <td>
                                            @if($producer->status==1)
                                            <span class="badge badge-success">Hoạt Động</span>
                                            @else
                                            <span class="badge badge-danger">Ngưng Hoạt Động</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="marginRight"
                                                href="{{route('producer-detail',['producer_id'=>$producer->producer_id])}}"
                                                data-toggle="tooltip" data-original-title="Danh Sách Sản Phẩm"><i
                                                    class="icon-eye text-green"></i>
                                            </a>
                                            <a class="marginRight" data-toggle="modal"
                                                data-original-title="Cập nhật nhà cung cấp"
                                                data-target="#updateProducer"><i data-toggle="tooltip"
                                                    data-original-title="Cập nhật Thông Tin Hãng"
                                                    class="btn_update_producer icon-pencil text-green"
                                                    id="{{$producer->producer_id}}"></i>
                                            </a>
                                            @if($producer->status==1)
                                            <a href="#" id="{{$producer->producer_id}}"
                                                class="remove_producer text-warning" data-toggle="modal"
                                                data-original-title="Xoá" data-target="#removeProducer"> <i
                                                    data-toggle="tooltip" data-original-title="Xoá"
                                                    class="icon-trash"></i>
                                            </a>
                                            @else
                                            <a href="#" class="recover_producer text-warning"
                                                id="{{$producer->producer_id}}" data-toggle="modal"
                                                data-original-title="Khôi Phục Nhà Cung Cấp"
                                                data-target="#recoverProducer"> <i data-toggle="tooltip"
                                                    data-original-title="Khôi Phục Nhà Cung Cấp"
                                                    class="glyphicon glyphicon-circle-arrow-left"></i>
                                            </a>
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
            <div class="modal fade" id="addProducer" tabindex="-1" role="dialog" aria-labelledby="addProducer"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Thêm Nhà Cung Cấp</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('add-producer')}}" method="POST">
                                @csrf
                                <div class="form-group producer_name">
                                    <label for="inputProducerName">Tên Nhà Cung Cấp</label>
                                    <input type="text" placeholder="Vui lòng nhập Tên Nhà Cung Cấp" name="producer_name"
                                        id="inputProducerName" class="form-control">
                                </div>

                                <div class="form-group phone">
                                    <label for="inputProducerPhone">Số Điện Thoại</label>
                                    <input type="text" placeholder="Vui lòng nhập Số Điện Thoại" name="phone"
                                        id="inputProducerPhone" class="form-control">
                                </div>
                                <div class="form-group address">
                                    <label for="inputProducerAddress">Địa Chỉ</label>
                                    <input type="text" placeholder="Vui lòng nhập Địa Chỉ" name="address"
                                        id="inputProducerAddress" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn-add-producer btn btn-primary btn-block mr-10" type="submit">Tạo
                                        Nhà Cung
                                        Cấp</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Row -->

    <!--Modal Update Producer-->
    <div class="modal fade" id="updateProducer" tabindex="-1" role="dialog" aria-labelledby="updateProducer"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Cập Nhật Nhà Cung Cấp</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('update-producer')}}" method="POST">
                        @csrf
                        <input type="text" hidden="true" name="producer_id" id="inputProducerId">
                        <div class="form-group producer_name">
                            <label for="inputProducerName">Tên Nhà Cung Cấp</label>
                            <input type="text" placeholder="Vui lòng nhập Tên Nhà Cung Cấp" name="producer_name"
                                id="inputProducerName" class="form-control">
                        </div>

                        <div class="form-group phone">
                            <label for="inputProducerPhone">Số Điện Thoại</label>
                            <input type="text" placeholder="Vui lòng nhập Số Điện Thoại" name="phone"
                                id="inputProducerPhone" class="form-control">
                        </div>
                        <div class="form-group address">
                            <label for="inputProducerAddress">Địa Chỉ</label>
                            <input type="text" placeholder="Vui lòng nhập Địa Chỉ" name="address"
                                id="inputProducerAddress" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn-update-producer btn btn-primary btn-block mr-10" type="submit">Cập
                                Nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Remove Producer-->
    <div class="modal fade" id="removeProducer" tabindex="-1" role="dialog" aria-labelledby="removeProducer"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeProducer">Xoá Nhà Cung Cấp
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn xoá nhà cung cấp này?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-remove-producer btn btn-primary">Xoá
                        nhà cung cấp</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Recover Producer-->
    <div class="modal fade" id="recoverProducer" tabindex="-1" role="dialog" aria-labelledby="recoverProducer"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recoverProducer">Khôi Phục Nhà Cung Cấp
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                        muốn khôi phục nhà cung cấp này?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" id="" class="btn-recover-producer btn btn-primary">Khôi phục
                        nhà cung cấp</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /Container -->

@endsection

@section('footer-script')
<script src="{{ asset('vendors4/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('vendors4/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{ asset('vendors4/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('dist/js/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('dist/js/feather.min.js')}}"></script>
<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
<script src="{{ asset('vendors4/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script src="{{ asset('vendors4/peity/jquery.peity.min.js')}}"></script>
<script src="{{ asset('dist/js/peity-data.js')}}"></script>
<script src="{{ asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
<script src="{{ asset('dist/js/toggle-data.js')}}"></script>
<script src="{{ asset('dist/js/init.js')}}"></script>
<script src="{{ asset('dist/js/validation-form.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery/producer.js') }}"></script>
<script src="{{ asset('vendors4/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('vendors4/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('dist/js/dataTables-data.js')}}"></script>
@endsection
