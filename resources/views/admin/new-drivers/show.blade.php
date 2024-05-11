@extends('admin.layouts.layout')

@section('header')
    <!-- Popup CSS -->
    <link href="{{asset('admin/plugins/popup/dist/popup.css')}}" rel="stylesheet">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    السائقون
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('newDrivers.index')}}">
            <span></span>طلبات السائقين
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
                                    <label>الصورة</label><br>
                                    <a class="image-popup-vertical-fit"
                                       href="{{get_file($driver->logo)}}">
                                        <img src="{{get_file($driver->logo)}}"
                                             alt="Logo" class="img-responsive" width="50px" height="50px"/> </a>
                                </div>
                            </div>
                            @if($driver->driving_license_image!=null)
                                <div class="col-md-3">
                                    <label>صورة الرخصة</label><br>
                                    <div style="max-height: 100px">
                                        <a class="image-popup-vertical-fit"
                                           href="{{get_file($driver->driving_license_image)}}">
                                            <img src="{{get_file($driver->driving_license_image)}}"
                                                 alt="Logo" class="img-responsive" width="50px" height="50px"/> </a>
                                    </div>
                                </div>
                            @endif
                            @if($driver->national_image!=null)
                                <div class="col-md-3">
                                    <div style="max-height: 100px">
                                        <label>صورة الهوية</label><br>
                                        <a class="image-popup-vertical-fit"
                                           href="{{get_file($driver->national_image)}}">
                                            <img src="{{get_file($driver->national_image)}}"
                                                 alt="Logo" class="img-responsive" width="50px" height="50px"/> </a>
                                    </div>
                                </div>
                            @endif

                            @if($driver->car!=null)
                                <div class="col-md-3">
                                    <label>صورة الترخيص الأولى</label><br>
                                    <div style="max-height: 100px">
                                        <a class="image-popup-vertical-fit"
                                           href="{{get_file($driver->car->licence_plate1)}}">
                                            <img src="{{get_file($driver->car->licence_plate1)}}"
                                                 alt="Logo" class="img-responsive" width="50px" height="50px"/> </a>
                                    </div>
                                </div>


                                <div class="col-md-3 mt-2" >
                                    <div style="max-height: 100px">
                                        <label>صورة الترخيص الثانية</label><br>
                                        <a class="image-popup-vertical-fit"
                                           href="{{get_file($driver->car->licence_plate2)}}">
                                            <img src="{{get_file($driver->car->licence_plate2)}}"
                                                 alt="Logo" class="img-responsive" width="50px" height="50px"/> </a>
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <div style="max-height: 100px">
                                        <label>صورة الترخيص الثالثة</label><br>
                                        <a class="image-popup-vertical-fit"
                                           href="{{get_file($driver->car->licence_plate3)}}">
                                            <img src="{{get_file($driver->car->licence_plate3)}}"
                                                 alt="Logo" class="img-responsive" width="50px" height="50px"/> </a>
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <div style="max-height: 100px">
                                        <label>صورة الترخيص الرابعة</label><br>
                                        <a class="image-popup-vertical-fit"
                                           href="{{get_file($driver->car->licence_plate4)}}">
                                            <img src="{{get_file($driver->car->licence_plate4)}}"
                                                 alt="Logo" class="img-responsive" width="50px" height="50px"/> </a>
                                    </div>
                                </div>
                            @endif

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
                            <th class="text-nowrap" scope="row">الإسم</th>
                            <td>{{$driver->name}}</td>
                        </tr>
                        @if($driver->birthday!=null)
                            <tr>
                                <th class="text-nowrap" scope="row">تاريخ الميلاد</th>
                                <td>{{$driver->birthday}}</td>
                            </tr>
                        @endif

                        <tr>
                            <th class="text-nowrap" scope="row">رقم الجوال</th>
                            <td>{{$driver->phone}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row">البريد الالكترونى</th>
                            <td>{{$driver->email}}</td>
                        </tr>

                        <tr>
                            <th class="text-nowrap" scope="row">النوع</th>
                            <td>
                                @if($driver->gender == 'female')
                                    <i class="badge badge-success">أنثى</i>
                                @elseif($driver->gender == 'male')
                                    <i class="badge badge-danger">ذكر</i>
                                @else
                                    <i class="badge badge-danger">لم يتم الإضافة</i>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th class="text-nowrap" scope="row">الحالة</th>
                            <td>
                                @if($driver->block == 0)
                                    <i class="badge badge-success">مفعل</i>
                                @elseif($driver->block == 1)
                                    <i class="badge badge-danger">موقوف</i>
                                @endif
                            </td>
                        </tr>
                        @if($driver->car !=null)
                        <tr>
                            <th class="text-nowrap" scope="row">رقم السيارة</th>
                            <td>{{$driver->car->number}}</td>
                        </tr>
                        @endif
                        <tr>
                            <th class="text-nowrap" scope="row">الرصيد</th>
                            <td>{{$driver->balance}}</td>
                        </tr>

                        <tr>
                            <th class="text-nowrap" scope="row">حالة السيارة</th>
                            <td>
                                @if($driver->car !=null)
                                    <i class="badge badge-success">تم التأكد</i>
                                @else
                                    <i class="badge badge-danger">لم يتم التأكد</i>
                                @endif
                            </td>
                        </tr>

                        @if($driver->car !=null)
                            <tr>
                                <th class="text-nowrap" scope="row">الفئة</th>
                                <td>{{$driver->car->brand}}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row">المويل</th>
                                <td>{{$driver->car->model}}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row">اللون</th>
                                <td>{{$driver->car->color}}</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>

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
