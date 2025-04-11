@extends('layouts')

@section('body')
<!-- Main Content -->
<div class="hk-pg-wrapper hk-auth-wrapper">
    <header class="d-flex justify-content-end align-items-center">
        <div class="btn-group btn-group-sm">
            <a href="#" class="btn btn-outline-secondary">Help</a>
            <a href="#" class="btn btn-outline-secondary">About Us</a>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 pa-0">
                <div class="auth-form-wrap pt-xl-0 pt-70">
                    <div class="auth-form w-xl-25 w-sm-50 w-100">
                        <a class="auth-brand text-center d-block mb-45" href="#">
                            <img class="brand-img" src="{{ asset(dist/img/logo-ptpstore.png)}}" alt="ptpstore" />
                        </a>
                        <form>
                            <h1 class="display-4 mb-10 text-center">404. That's an error.</h1>
                            <p class="mb-30 text-center">We are sorry but requested page does not exist. You can
                                <a href="dashboard1.html"><u>return to homepage</u></a> or make search below to
                                find the correct page.
                            </p>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control form-control-lg filled-input rounded-input bg-white"
                                        placeholder="Search and hit Enter" type="text">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><span class="feather-icon"><i
                                                    data-feather="arrow-right"></i></span></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Main Content -->
@endsection
