@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    الصلاحيات
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('permissions.index')}}">
            <span></span>كل الصلاحيات
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span> تعديل اسم الصلاحية
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">اضافة صلاحية جديدة</h4>
                <form class="forms-sample" method="post" action="{{route('permissions.update',$permission->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> اسم الصلاحية (بالانجليزية)</label>
                                <input data-validation="required" type="text"  name="name" id="name" value="{{$permission->name}}" class="form-control"/>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>اختر الجارد أو الجدول  <span class="text-danger">*</span> </label>
                        <select data-validation="required" id="guard_name" name="guard_name" class="  form-control">
                            @foreach($guards as $key=>$value)
                                <option {{$key==$permission->guard_name?'selected':''}} value="{{$key}}" >{{$key}}</option>
                            @endforeach
                        </select>
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
