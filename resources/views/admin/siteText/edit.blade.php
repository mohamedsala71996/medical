@extends('admin.layouts.layout')

@section('header')

@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    معلومات النظام
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('siteTexts.index')}}">
            <span></span>كل معلومات النظام
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span>تعديل
    </li>

@endsection

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">تعديل </h4>
                <form class="forms-sample" method="post" action="{{route('siteTexts.update',$siteText->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>العنوان  </label>
                        <input data-validation="required" type="text"  name="title" id="title" value="{{$siteText->title}}" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label>التفاصيل</label>
                        <textarea data-validation="required"  name="content" id="content" class="form-control">{{$siteText->content}}</textarea>
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
