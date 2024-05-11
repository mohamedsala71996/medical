@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
   التحويلات البنكية
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('payments.index')}}">
            <span></span>كل التحويلات البنكية
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span>   التحويلات البنكية
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">تعديل </h4>
                <form class="forms-sample" method="post" action="{{route('payments.update',$payment->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{$payment->driver_id}}" name="user_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>قيمة الرصيد المضاف </label>
                                <input data-validation="required,float" type="text"  name="balance" id="balance" value="{{old('balance')}}" class="form-control"/>
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
    <script src="{{asset('admin/plugins/dropify/dist/js/dropify.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.dropify').dropify();

        });
    </script>
@endsection
