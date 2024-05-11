@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
   رسائل الأشعارات
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('notificationMessages.index')}}">
            <span></span>كل محتوى الاشعارت
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span>اضافة محتوى  جديد
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">اضافة محتوى اشعار جديد</h4>
                <form class="forms-sample" method="post" action="{{route('notificationMessages.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم الاشعار(عربى) </label>
                                <input data-validation="required" type="text"  name="ar_title" id="ar_title" value="{{old('ar_title')}}" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> اسم الاشعار (بالانجليزية)</label>
                                <input data-validation="required" type="text"  name="en_title" id="en_title" value="{{old('en_title')}}" class="form-control"/>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>محتوى الاشعار(عربى) </label>
                                <input data-validation="required" type="text"  name="ar_desc" id="ar_desc" value="{{old('ar_desc')}}" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> محتوى الاشعار (بالانجليزية)</label>
                                <input data-validation="required" type="text"  name="en_desc" id="en_desc" value="{{old('en_desc')}}" class="form-control"/>
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
