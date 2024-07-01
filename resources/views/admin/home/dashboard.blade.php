@extends('admin.layouts.layout')

@section('header')
@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    صفحة الإحصائيات
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <h1> {{Auth::guard('admin')->user()->id}} </h1>
@endsection

@section('content')

    {{--Visits--}}
    <div class="col-12 grid-margin">
        <div class="card card-statistics">
            <div class="row">
                <div class="card-col col-xl-4 col-lg-6 col-md-6 col-6 border-right">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                            <i class="mdi mdi-account-multiple-check text-primary mr-0 mr-sm-4 icon-lg"></i>
                            <div class="wrapper text-center text-sm-left">
                                <p class="card-text mb-1">عدد المستخدمين</p>
                                <br>
                                <div class="fluid-container">
                                    <h3 class="mb-0 font-weight-medium">{{$users->count()}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-col col-xl-4 col-lg-6 col-md-6 col-6 border-right">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                            <i class="mdi mdi-doctor text-primary mr-0 mr-sm-4 icon-lg"></i>
                            <div class="wrapper text-center text-sm-left">
                                <p class="card-text mb-1">عدد الاطباء</p>
                                <br>
                                <div class="fluid-container">
                                    <h3 class="mb-0 font-weight-medium">{{$docs->count()}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-col col-xl-4 col-lg-6 col-md-6 col-6 border-right">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                            <i class="mdi mdi-doctor text-primary mr-0 mr-sm-4 icon-lg"></i>
                            <div class="wrapper text-center text-sm-left">
                                <p class="card-text mb-1">عدد اخصائيي التغذية العلاجية</p>
                                <br>
                                <div class="fluid-container">
                                    <h3 class="mb-0 font-weight-medium">{{$nutrition->count()}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{--Visits--}}

@endsection

@section('footer')
    <script>
        $(document).ready(function () {


        });
    </script>
@endsection
