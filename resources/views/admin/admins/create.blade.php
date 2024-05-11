@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    اضافة مدير
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">

            <span></span>اضافة مدير جديد
    </li>
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">اضافة مدير جديد</h4>
                <form class="forms-sample" method="post" action="{{route('admins.store')}}" enctype="multipart/form-data">
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
                        <input data-validation="required" type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="" />
                        @error('image') <small class="form-control-feedback"> </small> @enderror

                    </div>

                    <input type="hidden" name="admin_type"  value="0" >
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
