@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
   تغيير كلمة المرور
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">تغيير كلمة المرور</h4>
                <form class="forms-sample" method="post" action="{{url('admin/profile/password/change')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$admin->id}}">

                    <div class="form-group" @error('password') has-danger @enderror>
                        <label for="password">كلمة المرور الجديدة</label>
                        <input data-validation="required" name="password" value="" type="password" class="form-control" id="password" placeholder="كلمة المرور الجديدة">
                        @error('password') <small class="form-control-feedback"> </small> @enderror
                    </div>

                    <div class="form-group" @error('password') has-danger @enderror>
                        <label for="password">تأكيد كلمة المرور الجديدة</label>
                        <input data-validation="required" name="password_confirmation" value="" type="password" class="form-control" id="password" placeholder="تأكيد كلمة المرور الجديدة">
                        @error('password') <small class="form-control-feedback"> </small> @enderror
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

