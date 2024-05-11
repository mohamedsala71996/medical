@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    اضافة بانر
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('sliders.index')}}">
            <span></span>البانر
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span>اضافة بانر جديد
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">اضافة بانر جديد</h4>
                <form class="forms-sample" method="post" action="{{route('sliders.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم البانر(عربى) </label>
                                <input  type="text"  name="ar_title" id="ar_title" value="{{old('ar_title')}}" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> اسم البانر (بالانجليزية)</label>
                                <input  type="text"  name="en_title" id="en_title" value="{{old('en_title')}}" class="form-control"/>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" value="0" name="type">
                    {{--<div class="form-group">
                        <label>اختر البانر  <span class="text-danger">*</span> </label>
                        <select data-validation="required" id="type" name="type" class="  form-control">
                            <option value="" >اختر نوع البانر </option>
                            <option value="0" >البانر الأول </option>
                            <option value="1" >البانر الثانى </option>
                        </select>
                    </div>--}}

                    <div class="form-group">
                        <label>الصورة</label>
                        <input data-validation="required" type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="" />
                        @error('image') <small class="form-control-feedback"> </small> @enderror

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
