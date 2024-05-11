@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">
    <!-- iCheck Skins CSS -->
    <link href="{{asset('admin/plugins/icheck/skins/all.css')}}" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="{{asset('admin/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/imageuploadify.min.css')}}" rel="stylesheet" type="text/css">

    <style>

        .select2-container .select2-selection--single{
            padding: 1px !important;
        }
        .ajax-loader {
            visibility: hidden;
            background-color: rgba(255,255,255,0.7);
            position: absolute;
            z-index: +100 !important;
            width: 100%;
            height:100%;
        }

        .ajax-loader img {
            position: relative;
            top:50%;
            left:50%;
        }
    </style>
@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    السائقون
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('drivers.index')}}">
            <span></span>كل السائقين
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span>تعديل سائق
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="ajax-loader mb-1">
                    <img src="{{ asset('5.gif') }}" class="img-responsive" />
                </div>
                <h4 class="card-title">تعديل سائق </h4>
                <form id="example-form" class="forms-sample" method="post" action="{{route('drivers.update',$driver->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$driver->id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم السائق </label>
                                <input data-validation="required" type="text"  name="name" id="name" value="{{$driver->name}}" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ الميلاد </label>
                                <input data-validation="required" type="date"  name="birthday" id="birthday" value="{{$driver->birthday}}" class="form-control"/>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" @error('email') has-danger @enderror>
                                <label for="email">البريد الالكترونى</label>
                                <input data-validation="required,email" type="email" class="form-control" value="{{$driver->email}}" name="email" id="email" placeholder="البريد الالكترونى">
                                @error('email') <small class="form-control-feedback"> </small> @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" @error('phone_code') has-danger @enderror>
                                <label for="phone">كود الجوال</label>
                                <select data-validation="required" id="phone_code" name="phone_code" class="select2 m-b-10 form-control">
                                    <option value="" >اختر الكود</option>
                                    @foreach ($codes as $code)
                                        <option value="{{ $code->phone_code }}"
                                                {{ $driver->phone_code == $code->phone_code ? 'selected' : "" }}>
                                            ( {{ $code->phone_code }} +)
                                        </option>
                                    @endforeach
                                </select>
                                @error('phone_code') <small class="form-control-feedback"> </small> @enderror

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" @error('phone') has-danger @enderror>
                                <label for="phone">رقم الجوال</label>
                                <input data-validation="required,number" type="text" class="form-control" value="{{$driver->phone}}" name="phone" id="phone" placeholder="رقم الجوال">
                                @error('phone') <small class="form-control-feedback"> </small> @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" @error('national_number') has-danger @enderror>
                                <label for="national_number">الرقم القومى</label>
                                <input data-validation="required" type="text" class="form-control" value="{{$driver->national_number}}" name="national_number" id="national_number" placeholder="الرقم القومى">
                                @error('national_number') <small class="form-control-feedback"> </small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" @error('password') has-danger @enderror>
                                <label for="password">كلمة المرور</label>
                                <input  name="password" value="" type="password" class="form-control" id="password" placeholder="كلمة المرور ">
                                @error('password') <small class="form-control-feedback"> </small> @enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>اختر النوع</label>
                        <select data-validation="required" id="gender" name="gender" class="select2 m-b-10 form-control">
                            <option value="" >اختر النوع</option>
                            <option {{$driver->gender=='male'?'selected':''}} value="male" >ذكر</option>
                            <option {{$driver->gender=='female'?'selected':''}} value="female" >أنثى</option>

                        </select>
                        @error('gender') <small class="form-control-feedback"> </small> @enderror

                    </div>




                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" @error('brand') has-danger @enderror>
                                <label for="brand">فئة السيارة</label>
                                <input data-validation="required" type="text" class="form-control" value="{{$driver->car->brand}}" name="brand" id="brand" placeholder="فئة السيارة">
                                @error('brand') <small class="form-control-feedback"> </small> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" @error('model') has-danger @enderror>
                                <label for="brand">الموديل</label>
                                <input data-validation="required" type="text" class="form-control" value="{{$driver->car->model}}" name="model" id="model" placeholder="الموديل">
                                @error('model') <small class="form-control-feedback"> </small> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" @error('color') has-danger @enderror>
                                <label for="brand">اللون</label>
                                <input data-validation="required" type="text" class="form-control" value="{{$driver->car->color}}" name="color" id="color" placeholder="اللون">
                                @error('color') <small class="form-control-feedback"> </small> @enderror
                            </div>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>الصورة</label>
                                <input  type="file" name="logo" id="input-file-now-custom-1" class="dropify" data-default-file="{{get_file($driver->logo)}}" />
                                @error('logo') <small class="form-control-feedback"> </small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>صورة الهوية</label>
                                <input  type="file" name="national_image" id="input-file-now-custom-1" class="dropify" data-default-file="{{get_file($driver->national_image)}}" />
                                @error('national_image') <small class="form-control-feedback"> </small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>صورة الرخصة</label>
                                <input  type="file" name="driving_license_image" id="input-file-now-custom-1" class="dropify" data-default-file="{{get_file($driver->national_image)}}" />
                                @error('driving_license_image') <small class="form-control-feedback"> </small> @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>لوحة الترخيض الأولى</label>
                                <input  type="file" name="licence_plate1" id="input-file-now-custom-1" class="dropify" data-default-file="{{get_file($driver->car->licence_plate1)}}" />
                                @error('licence_plate1') <small class="form-control-feedback"> </small> @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>لوحة الترخيض الثانية</label>
                                <input  type="file" name="licence_plate2" id="input-file-now-custom-1" class="dropify" data-default-file="{{get_file($driver->car->licence_plate2)}}" />
                                @error('licence_plate2') <small class="form-control-feedback"> </small> @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>لوحة الترخيض الثالثة</label>
                                <input  type="file" name="licence_plate3" id="input-file-now-custom-1" class="dropify" data-default-file="{{get_file($driver->car->licence_plate3)}}" />
                                @error('licence_plate3') <small class="form-control-feedback"> </small> @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>لوحة الترخيض الرابعة</label>
                                <input  type="file" name="licence_plate4" id="input-file-now-custom-1" class="dropify" data-default-file="{{get_file($driver->car->licence_plate4)}}" />
                                @error('licence_plate4') <small class="form-control-feedback"> </small> @enderror
                            </div>

                        </div>
                    </div>



                    <button type="submit" class="btn btn-gradient-primary mr-2">تعديل</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="{{asset('admin/plugins/toast-master/js/jquery.toast.js')}}"></script>

    <script src="{{asset('admin/plugins/dropify/dist/js/dropify.min.js')}}"></script>
    <!-- icheck -->
    <script src="{{asset('admin/plugins/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('admin/plugins/icheck/icheck.init.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('admin/plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/imageuploadify.min.js')}}"></script>

    <script>
        function myToast(heading, text, position, loaderBg, icon, hideAfter, stack) {
            "use strict";
            $.toast({
                heading: heading,
                text: text,
                position: position,
                loaderBg: loaderBg,
                icon: icon,
                hideAfter: hideAfter,
                stack: stack
            });
        }
        $(document).ready(function () {
            $('.dropify').dropify();
            $(".select2").select2();
            /* $('#more-images').imageuploadify();
             //---------------------Form Submit------------------
             $(document).on('submit','#example-form',function( e ) {
                 e.preventDefault();
                 var form_data = new FormData($('#example-form')[0]);
             $.ajax({
                 url: ,
                 type: 'post',
                 beforeSend: function(){
                     $('.ajax-loader').css("visibility", "visible");
                 },
                 contentType: false,
                 processData: false,
                 dataType: 'json',
                 data: form_data,
                 success: function (data) {
                     $('.ajax-loader').css("visibility", "hidden");
                     if (data.error.length > 0) {
                         var error_html = '';
                         data.error.forEach(function (error) {
                             error_html += "<div class='alert alert-danger'>" + error + "</div>";
                         });
                         myToast('لم تتم العملية', data.error, 'buttom-left', '#ff6849', 'error', 3500, 6);
                     } else {
                         $('#example-form')[0].reset();
                         myToast('عملية ناجحة', data.success, 'buttom-left', '#ff6849', 'success', 3500, 6);
                     }
                 }//success
             });
             });*/
            //-------------------end form submit---------------
        });
    </script>
    {{------------------------------------The MAP-------------------------------------------------}}

@endsection
