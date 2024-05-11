@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    الكوبونات
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('coupons.index')}}">
            <span></span>كل   الكوبونات
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span>اضافة  كوبون جديدة
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">اضافة كوبون  جديد</h4>
                <form class="forms-sample" method="post" action="{{route('coupons.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم الكوبون </label>
                                <input data-validation="required" type="text"  name="ar_title" id="ar_title" value="{{old('ar_title')}}" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> رقم الكوبون</label>
                                <input data-validation="required" type="text"  name="coupon_serial" id="coupon_serial" value="{{old('coupon_serial')}}" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> قيمة الكوبون</label>
                                <input data-validation="required,float" type="text"  name="coupon_value" id="coupon_value" value="{{old('coupon_value')}}" class="form-control"/>
                            </div>
                        </div>


                    </div>




                    <button type="submit" class="btn btn-gradient-primary mr-2">إضافة</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="{{asset('admin/plugins/dropify/dist/js/dropify.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.dropify').dropify();

        });
    </script>
@endsection
