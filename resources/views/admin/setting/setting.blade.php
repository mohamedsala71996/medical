@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    الاعدادات
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}

@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">تعديل البيانات</h4>
                <form class="forms-sample" method="post" action="{{route('setting.update',1)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group" @error('ar_title') has-danger @enderror>
                        <label for="ar_title">الإسم باللغة العربية</label>
                        <input data-validation="required" name="ar_title" value="{{$setting->ar_title}}" type="text" class="form-control" id="ar_title" placeholder="اسم المؤسسة بالعربية">
                        @error('ar_title') <small class="form-control-feedback"> </small> @enderror
                    </div>
                    <div class="form-group" @error('en_title') has-danger @enderror>
                        <label for="en_title">الإسم باللغة الانجليزية</label>
                        <input data-validation="required" type="en_title" class="form-control" value="{{$setting->en_title}}" name="en_title" id="en_title" placeholder="اسم المؤسسة باللغة الانجليزية">
                        @error('en_title') <small class="form-control-feedback"> </small> @enderror

                    </div>


                    <div class="form-group">
                        <label>الشعار </label>
                        <input  type="file" name="logo" id="input-file-now-custom-1" class="dropify" data-default-file="{{asset('upload').'/'.$settings['logo']}}" />
                        @error('logo') <small class="form-control-feedback"> </small> @enderror

                    </div>



                    <button type="submit" class="btn btn-gradient-primary mr-2">تعديل</button>
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
