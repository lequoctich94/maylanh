@extends('layouts')

@section('title','Quản lý cấp bậc')

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
        <li class="breadcrumb-item"><a href="javascript:void(0)">Quản lý</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Cấp bậc</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <h5 class="hk-sec-title">Danh Sách Cấp Bậc</h5>
                <button type="button" class="btn btn-primary btn-block mt-50 mb-20 w-20" data-toggle="modal"
                    data-target="#addRank">
                    Tạo cấp bậc
                </button>
                @if($errors->any() && $errors->has('errorRank'))
                <div class="checkError-red">{{$errors->first('errorRank')}}</div>
                @endif
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1" class="table table-striped table-bordered hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>ID Cấp Bậc</th>
                                        <th>Tên Cấp Bậc</th>
                                        <th>Hạn Mức</th>
                                        <th>Trạng Thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($ranks != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($ranks as $rank)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td scope="row">{{ $rank->rank_id }}</td>
                                        <td>{{ $rank->rank_name }}</td>
                                        <td>{{ $rank->point }}</td>
                                        @if($rank->status==0)
                                        <td><span class="badge badge-danger">Ngừng Hoạt Động</span> </td>
                                        @else
                                        <td><span class="badge badge-success">Còn Hoạt Động</span> </td>
                                        @endif
                                        <td style="text-align:center;">
                                            <a href="{{route('discount-category-management',['rank_id'=>$rank->rank_id])}}"
                                                class="marginRight text-green">
                                                <span data-toggle="tooltip" data-original-title="Xem Chi Tiết"><i
                                                        class="icon-eye"></i></span>
                                            </a>
                                            <a class="marginRight" href="#" data-toggle="modal"
                                                data-original-title="Cập Nhật Cấp Bậc" data-target="#updateRank"> <span
                                                    data-toggle="tooltip" data-original-title="Cập Nhật Cấp Bậc">
                                                    <i class="btn_update_rank icon-pencil"
                                                        id="{{ $rank->rank_id }}"></i>
                                                </span>
                                            </a>
                                            @if($rank->status==1)
                                            <a data-toggle="modal" data-original-title="Xoá Cấp Bậc"
                                                data-target="#deleteRank" class="text-danger"> <span
                                                    data-toggle="tooltip" data-original-title="Xoá Cấp Bậc">
                                                    <i class="remove_rank icon-trash" id="{{ $rank->rank_id }}"></i>
                                                </span>
                                            </a>
                                            @else
                                            <a data-toggle="modal" data-original-title="Khôi phục"
                                                data-target="#restoreRank" class="text-warning"> <span
                                                    data-toggle="tooltip" data-original-title="Khôi Phục Cấp Bậc">
                                                    <i class="recover_rank glyphicon glyphicon-circle-arrow-left"
                                                        id="{{ $rank->rank_id }}"></i>
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

<!-- /Modal Add Rank -->
<div class="modal fade" id="addRank" tabindex="-1" role="dialog" aria-labelledby="addRank" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Tạo Cấp Bậc Mới</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add-rank')}}" method="POST">
                    @csrf
                    <div class="form-group rank_id">
                        <label for="inputRankID">ID Cấp Bậc</label>
                        <input type="text" placeholder="Vui lòng nhập ID Cấp Bậc" name="rank_id" id="inputRankID"
                            class="form-control">
                    </div>
                    <div class="form-group" id="rank_name_add">
                        <label for="inputRankNameAdd">Tên Cấp Bậc</label>
                        <input type="text" placeholder="Vui lòng nhập Tên Cấp Bậc" name="rank_name"
                            id="inputRankNameAdd" class="form-control">
                    </div>
                    <div class="form-group point">
                        <label for="inputPoint">Hạn Mức</label>
                        <input type="number" min="0" value="0" placeholder="Vui lòng nhập Hạn Mức" name="point"
                            id="inputPoint" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn_submit_add_rank btn-primary btn-block mr-10" type="submit">Tạo Cấp
                            Bậc</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /Modal Update Rank -->
<div class="modal fade" id="updateRank" tabindex="-1" role="dialog" aria-labelledby="updateRank" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Chỉnh Sửa Cấp Bậc</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update-rank')}}" method="POST">
                    @csrf
                    <input type="text" hidden="true" name="rank_id" id="inputRankID">
                    <div class="form-group">
                        <label for="inputRankID">ID Cấp Bậc</label>
                        <input type="text" placeholder="Vui lòng nhập ID Cấp Bậc" name="rank_id" id="inputRankID"
                            class="form-control" disabled="true">
                    </div>
                    <div class="form-group rank_name_update">
                        <label for="inputRankNameUpdate">Tên Cấp Bậc</label>
                        <input type="text" placeholder="Vui lòng nhập Tên Cấp Bậc" name="rank_name"
                            id="inputRankNameUpdate" class="form-control">
                    </div>
                    <div class="form-group point_update">
                        <label for="inputPoint">Hạn Mức</label>
                        <input type="number" min="0" value="0" placeholder="Vui lòng nhập Hạn Mức" name="point"
                            id="inputPoint" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn_submit_update_rank btn-primary btn-block mr-10" type="submit">Cập
                            Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /Modal Delete Rank -->
<div class="modal fade" id="deleteRank" tabindex="-1" role="dialog" aria-labelledby="deleteRank" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRank">Xoá Cấp Bậc
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                    muốn xoá cấp bậc này?
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                    bỏ</button>
                <button type="button" id="" class="btn_remove_rank btn btn-primary">Xoá Cấp Bậc</button>
            </div>
        </div>
    </div>
</div>

<!-- /Modal Restore Rank -->
<div class="modal fade" id="restoreRank" tabindex="-1" role="dialog" aria-labelledby="restoreRank" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRank">Khôi Phục Cấp Bậc
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-normal">Hãy chắc chắn rằng bạn
                    muốn khôi phục cấp bậc này?
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ
                    bỏ</button>
                <button type="button" id="" class="btn_recover_rank btn btn-primary">Khôi Phục</button>
            </div>
        </div>
    </div>
</div>


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
<script type="text/javascript" src="{{ asset('js/jquery/rank.js') }}"></script>
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
