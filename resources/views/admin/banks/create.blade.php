@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/dropify/dist/css/dropify.min.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    حسابات البنوك
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('banks.index')}}">
            <span></span>كل   حسابات البنوك
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span>اضافة   حساب البنوك جديدة
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">اضافة حساب  جديد</h4>
                <form class="forms-sample" method="post" action="{{route('banks.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>اسم البنك </label>
                                <input data-validation="required" type="text"  name="bank_name" id="bank_name" value="{{old('bank_name')}}" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> اسم الحساب</label>
                                <input data-validation="required" type="text"  name="account_name" id="account_name" value="{{old('account_name')}}" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> رقم الحساب</label>
                                <input data-validation="required" type="text"  name="account_number" id="account_number" value="{{old('account_number')}}" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> رقم الأيبان</label>
                                <input data-validation="required" type="text"  name="IBN" id="IBN" value="{{old('IBN')}}" class="form-control"/>
                            </div>
                        </div>

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
