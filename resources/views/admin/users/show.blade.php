@extends('admin.layouts.layout')

@section('header')
    <!-- Popup CSS -->
    <link href="{{asset('admin/plugins/popup/dist/popup.css')}}" rel="stylesheet">

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

        <span></span> عرض
    </li>

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-title">الصور</h4>
                        <div class="row m-t-30">
                            <div class="col-md-3">
                                <div style="max-height: 100px">
                                    <a class="image-popup-vertical-fit"
                                       href="{{get_file($user->logo)}}">
                                        <img src="{{get_file($user->logo)}}"
                                             alt="Logo" class="img-responsive" width="50px" height="50px"/> </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered  ">
                        <thead>
                        <tr>
                            <th class="alert alert-fill-danger" colspan="2" style="text-align: center; color: white"><strong>التفاصيل</strong></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="text-nowrap" scope="row">الاسم</th>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row">رقم الجوال</th>
                            <td>{{$user->phone}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row">البريد الالكترونى</th>
                            <td>{{$user->email}}</td>
                        </tr>

                       {{-- <tr>
                            <th class="text-nowrap" scope="row">العنوان</th>
                            <td>{{$user->address}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row">المدينة</th>
                            <td>{{$user->city->ar_city_title}}</td>
                        </tr>
--}}
                        <tr>
                            <th class="text-nowrap" scope="row">الحالة</th>
                            <td>
                                @if($user->is_blocked == 0)
                                    <i class="badge badge-success">مفعل</i>
                                @elseif($user->is_blocked == 1)
                                    <i class="badge badge-danger">موقوف</i>
                                @endif
                            </td>
                        </tr>

                        {{--<tr>
                            <th class="alert alert-fill-danger" colspan="2" style="text-align: center; color: white">
                                <strong>الموقع على الخريطة</strong></th>
                        </tr>--}}
                        </tbody>
                    </table>
                  {{--  {!!$maps['html']!!}--}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    {{--POP UP--}}
    <script src="{{asset('admin/plugins/popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('admin/plugins/popup/dist/jquery.magnific-popup-init.js')}}"></script>

@endsection
