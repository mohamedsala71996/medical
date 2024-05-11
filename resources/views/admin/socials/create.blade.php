@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
   روابط التواصل الاجتماعى
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('socials.index')}}">
            <span></span>كل الروابط
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span>اضافة ربط جديد
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">اضافة رابط جديد</h4>
                <form class="forms-sample" method="post" action="{{route('socials.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>اسم موقع التواصل </label>
                        <input data-validation="required" type="text"  name="title" id="title" value="{{old('title')}}" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label> رابط موقع التواصل</label>
                        <input data-validation="required" type="text"  name="link" id="link" value="{{old('link')}}" class="form-control"/>
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
