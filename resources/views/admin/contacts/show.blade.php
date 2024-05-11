@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert/sweetalert.css')}}">

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    الرسالة
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('contacts.index')}}">
            <span></span>كل الرسائل
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span>عرض الرسالة
    </li>
@endsection

@section('content')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
        <div class="card card-statistics social-card card-default">
            <div class="card-header header-sm">
                <div class="d-flex align-items-center">
                    <div class="wrapper d-flex align-items-center media-info text-linkedin">
                        <i class="mdi mdi-comment icon-md"></i>
                        <h2 class="card-title ml-3">الرسالة</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <img class="d-block img-sm rounded-circle mx-auto mb-2" src="{{asset('admin/avatar.jpg')}}" alt="profile image">
                <p class="text-center user-name">{{$contact->name}}</p>
                <p class="text-center mb-2 comment">{{$contact->message}}</p>
                <small class="d-block mt-4 text-center posted-date">{{$contact->created_at}}</small>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{asset('admin/plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script>

    $(document).ready(function () {
    });

</script>

@endsection
