@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    تعديل الحساب الشخصى
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">تعديل الحساب الشخصى</h4>
                <form class="forms-sample" method="post" action="{{route('admins.update',$admin->id)}}" enctype="multipart/form-data">
                  @csrf
                    @method('PUT')
                    <div class="form-group" @error('name') has-danger @enderror>
                        <label for="name">الاسم</label>
                        <input data-validation="required" name="name" value="{{admin()->user()->name}}" type="text" class="form-control" id="name" placeholder="الاسم">
                        @error('name') <small class="form-control-feedback"> </small> @enderror
                    </div>
                    <div class="form-group" @error('email') has-danger @enderror>
                        <label for="email">البريد الالكترونى</label>
                        <input data-validation="required,email" type="email" class="form-control" value="{{admin()->user()->email}}" name="email" id="email" placeholder="البريد الالكترونى">
                        @error('email') <small class="form-control-feedback"> </small> @enderror

                    </div>
                    <div class="form-group" @error('phone') has-danger @enderror>
                        <label for="phone">رقم الجوال</label>
                        <input data-validation="required,number" type="text" class="form-control" value="{{admin()->user()->phone}}" name="phone" id="phone" placeholder="رقم الجوال">
                        @error('phone') <small class="form-control-feedback"> </small> @enderror

                    </div>

                    <div class="form-group">
                        <label>صورتك الشخصية</label>
                        <input  type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="{{get_file($admin->image)}}" />
                        @error('image') <small class="form-control-feedback"> </small> @enderror

                    </div>

                    <input type="hidden" name="admin_type" value="{{$admin->admin_type}}">
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
