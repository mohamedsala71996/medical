@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert/sweetalert.css')}}">
    <link href="{{asset('admin/plugins/popup/dist/popup.css')}}" rel="stylesheet">

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
    التحويلات البنكية
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}

@endsection

@section('content')

    <div class="card"{{--style="padding:0 !important;"--}} >
        <div class="card-body" {{--style="padding: 1.25rem !important;"--}}>
           <div class="row mb-4" >
               <h4  class="card-title col-10"> التحويلات البنكية</h4>

           </div>
            <div class="row">

                <div class="col-12 table-responsive">
                    <table id="order-listing" class="table display nowrap " cellspacing="0" width="100%">
                        <?php
                        $count=1;
                        ?>
                        @if($payments->count()!=null)
                            <thead>
                            <tr>
                                {{--<th> #</th>--}}
                                <th>اسم البنك </th>
                                <th>صورة التحويل</th>
                                <th>القيمة</th>
                                <th>الإسم</th>
                                <th>قيمة الرصيد المضاف</th>
                                <th>الحالة</th>
                                <th>االتحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                   {{-- <td>{{$count++}}</td>--}}
                                    <td>{{$payment->name}}</td>
                                    <td>
                                        <a class="image-popup-vertical-fit"
                                           href="{{get_file($payment->image)}}">
                                            <img src="{{get_file($payment->image)}}"
                                                 alt="Logo" class="img-responsive" width="50px" height="50px"/> </a>
                                    </td>
                                    <td>{{$payment->amount}}</td>
                                    <td><a href="{{route('drivers.show',$payment->driver_id)}}">{{$payment->driver->name}}</a></td>
                                    <td>
                                        @if($payment->amount_added==0)
                                            <span class="badge badge-success">لم يتم اضافة رصيد</span>
                                        @else
                                            <span class="badge badge-success">{{$payment->amount_added}}</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($payment->status==0)
                                            <span class="badge badge-success">جديد</span>
                                            @else
                                            <span class="badge badge-success">تم المشاهدة</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($payment->status==0)
                                            <button class="btn btn-gradient-danger  btn-sm delete"
                                                    style="padding: 10px"
                                                    id="{{$payment->id}}">
                                                تحديد كمُشاهد <i class="mdi mdi-delete">  </i>
                                            </button>
                                            @endif


                                        <a class="btn btn-gradient-success  btn-sm"  style="padding: 10px"
                                           href="{{route('payments.edit',$payment->id)}}
                                                   ">
                                            إضافة رصيد<i class="mdi mdi-account-edit"></i>
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
    <script src="{{asset('admin/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin/plugins/popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('admin/plugins/popup/dist/jquery.magnific-popup-init.js')}}"></script>
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
                    text: "هل تريد هذا بالفعل؟",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "موافق",
                    cancelButtonText: "الغاء",
                    okButtonText: "تأكيد",
                    closeOnConfirm: false
                }, function () {
                    console.log(id)
                    $.ajax({
                        url: 'payments/'+id,
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
