@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">
    <!-- iCheck Skins CSS -->
    <link href="{{asset('admin/plugins/icheck/skins/all.css')}}" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="{{asset('admin/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>

    <style>

        .select2-container .select2-selection--single{
            padding: 1px !important;
        }
    </style>
@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
   مستخدمو الخدمة
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('users.index')}}">
            <span></span>كل المستخدمين
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span>اضافة مستخدم جديد
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">اضافة مستخدم جديد</h4>
                <form class="forms-sample" method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group" @error('name') has-danger @enderror>
                        <label for="name">الاسم</label>
                        <input data-validation="required" name="name" value="{{old('name')}}" type="text" class="form-control" id="name" placeholder="الاسم">
                        @error('name') <small class="form-control-feedback"> </small> @enderror
                    </div>
                    <div class="form-group" @error('email') has-danger @enderror>
                        <label for="email">البريد الالكترونى</label>
                        <input data-validation="required,email" type="email" class="form-control" value="{{old('email')}}" name="email" id="email" placeholder="البريد الالكترونى">
                        @error('email') <small class="form-control-feedback"> </small> @enderror

                    </div>
                    <div class="form-group" @error('phone_code') has-danger @enderror>
                        <label for="phone">كود الجوال</label>
                        <select data-validation="required" id="phone_code" name="phone_code" class="select2 m-b-10 form-control">
                            <option value="" >اختر الكود</option>
                            @foreach ($codes as $code)
                                <option value="{{ $code->phone_code }}"
                                        {{ old('phone_code') == $code->phone_code ? 'selected' : "" }}>
                                    ( {{ $code->phone_code }} +)
                                </option>
                            @endforeach
                        </select>
                        @error('phone_code') <small class="form-control-feedback"> </small> @enderror

                    </div>
                    <div class="form-group" @error('phone') has-danger @enderror>
                        <label for="phone">رقم الجوال</label>
                        <input data-validation="required,number" type="text" class="form-control" value="{{old('phone')}}" name="phone" id="phone" placeholder="رقم الجوال">
                        @error('phone') <small class="form-control-feedback"> </small> @enderror

                    </div>

                    <div class="form-group" @error('password') has-danger @enderror>
                        <label for="password">كلمة المرور</label>
                        <input data-validation="required" name="password" value="" type="password" class="form-control" id="password" placeholder="كلمة المرور ">
                        @error('password') <small class="form-control-feedback"> </small> @enderror
                    </div>

                    <div class="form-group">
                        <label>الصورة</label>
                        <input data-validation="required" type="file" name="logo" id="input-file-now-custom-1" class="dropify" data-default-file="" />
                        @error('logo') <small class="form-control-feedback"> </small> @enderror
                    </div>
                  {{--  <input type="hidden" value="1" name="country_id">--}}

                  {{--  <div class="form-group">
                        <label>اختر النوع</label>
                        <select data-validation="required" id="gender" name="gender" class="select2 m-b-10 form-control">
                            <option value="" >اختر النوع</option>
                            <option value="male" >ذكر</option>
                            <option value="female" >أنثى</option>

                        </select>
                        @error('gender') <small class="form-control-feedback"> </small> @enderror

                    </div>--}}


                    {{--<div class="form-group">
                        <label>اختر المدينة</label>
                        <select data-validation="required" id="city_id" name="city_id" class="select2 m-b-10 form-control">
                            <option value="" >اختر المدينة</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id_city}}" >{{$city->ar_city_title}}</option>
                            @endforeach
                        </select>
                        @error('city_id') <small class="form-control-feedback"> </small> @enderror

                    </div>--}}

                    {{--Location--}}
{{--                    <div class="form-group">--}}
{{--                        <label>احداثيات الموقع</label>--}}
{{--                        {!!$maps['html']!!}--}}
{{--                    </div>--}}

                   {{-- <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>خط الطول </label>
                                <input type="text" readonly name="longitude" id="longitude" value="" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> دائرة العرض </label>
                                <input type="text" readonly name="latitude" id="latitude" value="" class="form-control"/>
                            </div>
                        </div>

                    </div>--}}
                    {{--Location--}}


                    <button type="submit" class="btn btn-gradient-primary mr-2">إضافة</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="{{asset('admin/plugins/dropify/dist/js/dropify.min.js')}}"></script>
    <!-- icheck -->
    <script src="{{asset('admin/plugins/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('admin/plugins/icheck/icheck.init.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('admin/plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
            $(".select2").select2();
        });
    </script>
    {{------------------------------------The MAP-------------------------------------------------}}

@endsection
