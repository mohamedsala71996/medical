@extends('admin.layouts.layout')

@section('header')
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
    رسائل التواصل
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}

@endsection

@section('content')

    <div class="card"{{--style="padding:0 !important;"--}} >
        <div class="card-body" {{--style="padding: 1.25rem !important;"--}}>

            <div class="row mb-4" >
                <h4  class="card-title col-10">رسائل التواصل</h4>
{{--
                <a href="{{route('products.create')}}" style="float: left" class="btn btn-gradient-warning btn-sm col-2" ><i class="mdi mdi-plus-circle"></i>  أضف جديد</a>
--}}
                <div class="col-2"></div>

            </div>

            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="order-listing" class="table display nowrap " cellspacing="0" width="100%">
                        <?php
                        $count=1;
                        ?>
                        @if($contacts->count()!=null)
                            <thead>
                            <tr>
                                {{--<th> #</th>--}}
                                <th> اسم المُرسل</th>
                                <th>رقم الجوال</th>
                                <th>البريد الالكترونى</th>
                                <th>الحالة</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    {{-- <td>{{$count++}}</td>--}}
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>
                                        @if($contact->is_read==0)
                                            <span class=" badge badge-gradient-danger">جديد</span>
                                            @else
                                            <span class="badge badge-gradient-info">مقروء</span>
                                        @endif
                                    </td>

                                    <td>
                                        <button class="btn btn-gradient-danger  btn-sm delete"
                                                style="padding: 10px"
                                                id="{{$contact->id}}">
                                            حذف <i class="mdi mdi-delete">  </i>
                                        </button>
                                        <a class="btn btn-gradient-primary  btn-sm"  style="padding: 10px"
                                           href="{{route('contacts.show',$contact->id)}}
                                                   ">
                                            عرض<i class="mdi mdi-view-agenda"></i>
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

    <script>
        $(document).ready(function () {
            //--------------datatable----------------
            var table= $('#order-listing').DataTable({
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
                        url: 'contacts/'+id,
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

            //---------------Delete-------------
        });
    </script>

@endsection
