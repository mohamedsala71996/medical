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

        <span></span>تعديل محفظة
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="ajax-loader mb-1">
                    <img src="{{ asset('5.gif') }}" class="img-responsive" />
                </div>
                <h4 class="card-title">تعديل محفظة </h4>
                <form id="example-form" class="forms-sample" method="post" action="{{route('wallets.update',$wallet->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
{{--
                    <input type="hidden" name="id" value="{{$id}}">
--}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>اسم السائق </label>
                                <input  readonly type="text"  name="name" id="name" value="@if($wallet->driver){{$wallet->driver->name}}@endif" class="form-control"/>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" @error('email') has-danger @enderror>
                                <label for="email">الرصيد</label>
                                <input data-validation="required,double" type="number" class="form-control" value="{{$wallet->balance}}" name="balance" id="balance" placeholder="البريد الالكترونى">
                                @error('email') <small class="form-control-feedback"> </small> @enderror

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
