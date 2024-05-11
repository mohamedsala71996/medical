@extends('admin.layouts.layout')

@section('header')
    <link href="{{asset('admin/plugins/popup/dist/popup.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert/sweetalert.css')}}">

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
   البانر
@endsection




@section('content')


    <div class="card"{{--style="padding:0 !important;"--}} >
        <div class="card-body" {{--style="padding: 1.25rem !important;"--}}>
            <div class="row mb-4" >
                <h4  class="card-title col-10">البانر</h4>
                <a href="{{route('sliders.create')}}" style="float: left" class="btn btn-gradient-warning btn-sm col-2" ><i class="mdi mdi-plus-circle"></i>  أضف جديد</a>

            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="" class="table display nowrap " cellspacing="0" width="100%">
                                <?php
                                $count=1;
                                ?>
                                @if($sliders->count()!=null)
                                    <thead>
                                    <tr>

                                        <th>صورة البانر </th>
                                        <th>نوع البانر </th>
                                        <th class="text-center">
                                           التحكم
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sliders as $slider)
                                        <tr>
                                            <td class="" >
                                                <a class="image-popup-vertical-fit"
                                                   href="{{get_file($slider->image)}}">
                                                    <img src="{{get_file($slider->image)}}"
                                                         alt="Logo" class="img-responsive" width="100px" height="200px"/> </a>

                                            </td>
                                            <td>
                                                @if($slider->type==0)
                                                    <span class="badge badge-gradient-info ">البانر الأول</span>
                                                    @else
                                                    <span class="badge badge-gradient-primary ">البانر الثانى</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-gradient-danger  btn-sm delete"
                                                        style="padding: 10px"
                                                        id="{{$slider->id}}">
                                                    حذف <i class="mdi mdi-delete">  </i>
                                                </button>
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
                    </div>
            </div>
        </div>
    </div>


@endsection

@section('footer')
    <script src="{{asset('admin/plugins/popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('admin/plugins/popup/dist/jquery.magnific-popup-init.js')}}"></script>

    <script src="{{asset('admin/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('admin/plugins/sweetalert/sweetalert.min.js')}}"></script>

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
            //---------------end datatable--------------
            //---------------Delete--------------
            $(document).on('click', '.delete', function () {
                var id = $(this).attr('id');
                console.log(id)
                swal({
                    title: "تحذير",
                    text: "هل تريد حذف العنصر؟",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "حذف",
                    cancelButtonText: "الغاء",
                    okButtonText: "تأكيد",
                    closeOnConfirm: false
                }, function () {
                    console.log(id)
                    $.ajax({
                        url: 'sliders/'+id,
                        type: 'delete',
                        data: {id: id},
                        success: function (data) {
                            console.log(data)
                            if (data.error==1) {
                                swal({
                                    title: "خطأ",
                                    text: "فشل العملية !!",
                                    type: "error",
                                    confirmButtonText: "موافق"
                                });
                            } else {
                                swal({
                                    title: "بنجاح!!",
                                    text: "لقد تمت العملية بنجاح",
                                    type: "success",
                                    confirmButtonText: "موافق"
                                }, function () {
                                    location.reload();
                                });
                            }
                        }
                    });
                });
            });
            //---------------Delete--------------
        });
    </script>

@endsection
