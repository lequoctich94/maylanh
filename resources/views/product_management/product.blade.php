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
        <li class="breadcrumb-item displayFlex"><a href="#">Quản Lý</a></li>
        <li class="breadcrumb-item active displayFlex" aria-current="page">Sản Phẩm</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                        data-feather="database"></i></span></span>Danh Sách Sản Phẩm Trong Kho</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">

        <div class="col-xl-12">
            <section class="hk-sec-wrapper boxShadowSmall">
                <a href="{{ route('add-product-management') }}">
                    <button type="button" class="btn btn-primary mb-20 w-20">
                        Nhập Sản Phẩm
                    </button>
                </a>
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1" class="table table-striped table-bordered hover display">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình Ảnh</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Loại Sản Phẩm</th>
                                        <th>Nhà Cung Cấp</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($products != [])
                                    <p class="d-none">{{$i=1}}</p>
                                    @foreach($products as $product)
                                    <td>{{$i++}}</td>
                                    <td style="padding:4px;width:150px;height:150px;">
                                        <img width="100%" height="100%" style="object-fit:cover;border-radius:2px;"
                                            src="{{env('APP_URL')}}/upload/products/{{$product->product_id}}/{{$product->product_img}}"
                                            alt="{{$product->product_name}}">
                                    </td>
                                    <td style="text-align:left">
                                        <h6>{{$product->product_name}}</h6>
                                    </td>
                                    <td>{{$product->category->category_name}}
                                    </td>
                                    <td>{{$product->producer->producer_name}}
                                    </td>
                                    <td>
                                        <a
                                            href="{{route('product-rate-management',['product_id'=>$product->product_id])}}">
                                            <span data-toggle="tooltip" data-original-title="Xem chi tiết đánh giá">
                                                <i class="icon-star text-green"></i>
                                            </span>
                                        </a>
                                        <a class="mr-10"
                                            href="{{route('product-detail-management',['product_id'=>$product->product_id])}}">
                                            <span data-toggle="tooltip" data-original-title="Xem Chi Tiết">
                                                <i class="icon-eye text-green"></i>
                                            </span>
                                        </a>
                                    </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="odd">
                                        <td valign="top" colspan="7" class="text-center dataTables_empty">Danh sách
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
<script type="text/javascript" src="{{ asset('js/jquery/product.js') }}"></script>
@endsection
