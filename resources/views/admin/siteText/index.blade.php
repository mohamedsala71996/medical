@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.css')}}">

    <style>
        div.dataTables_wrapper div.dataTables_filter {
            text-align: left !important;
        }
        .dataTables_length {
            display: none !important;
        }
    </style>
@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    معلومات التطبيق
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}

@endsection

@section('content')

    <div class="card"{{--style="padding:0 !important;"--}} >
        <div class="card-body" {{--style="padding: 1.25rem !important;"--}}>
            <div class="row mb-4" >
                <h4  class="card-title col-10">معلومات النظام</h4>

            </div>
            <div class="row">

                <div class="col-12 table-responsive">
                    <table id="" class="table display nowrap " cellspacing="0" width="100%">
                        <?php
                        $count=1;
                        ?>
                        @if($siteTexts->count()!=null)
                            <thead>
                            <tr>
                                <th>عنوان النص </th>
                                <th>اللغة</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($siteTexts as $siteText)
                                <tr>
                                    <td>{{$siteText->title}}</td>
                                    <td>
                                        {!! $siteText->lang_text!!}
                                    </td>
                                    <td>
                                        <a class="btn btn-gradient-success  btn-sm"  style="padding: 10px"
                                           href="{{route('siteTexts.edit',$siteText->id)}}
                                                   ">
                                            تعديل<i class="mdi mdi-account-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            @else

                                <div class="alert alert-fill-danger">
                                    <span style="font-weight: bold">  لا يوجد بيانات لعرضها</span>
                                </div>

                            @endif

                            </tbody>
                    </table>
                    {{-- {{$users->links()}}--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{asset('admin/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(document).ready(function () {
            //--------------datatable----------------
            $('#order-listing').DataTable({
                "paging":   true,
                "ordering": true,
                "info":     false,
                "language": {
                    search: "بحث"
                }
            });
            //---------------end datatable-------------
        });
    </script>

@endsection
