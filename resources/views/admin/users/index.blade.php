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
  العملاء
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}

@endsection

@section('content')

    <div class="card"{{--style="padding:0 !important;"--}} >
        <div class="card-body" {{--style="padding: 1.25rem !important;"--}}>
            <div class="row mb-4" >
                <h4  class="card-title col-10">العملاء</h4>

            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="order-listing" class="table display nowrap " cellspacing="0" width="100%">
                        <?php
                        $count=1;
                        ?>
                        @if($users->count()!=null)
                            <thead>
                            <tr>
                                {{--<th> #</th>--}}
                                <th>الأسم</th>
                                <th>الجوال </th>
                                <th>الصورة</th>
                                <th>الحالة</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                   {{-- <td>{{$count++}}</td>--}}
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>
                                        <img src="{{get_file($user->logo)}}" width="50px" height="50px" >

                                    </td>
                                    <td>
                                        @if($user->is_blocked==0)
                                            <span class="badge badge-success"> مفعل</span>
                                        @else
                                            <span class="badge badge-danger"> موقوف</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-gradient-danger  btn-sm delete"
                                                style="padding: 10px"
                                                id="{{$user->id}}">
                                            حذف <i class="mdi mdi-delete">  </i>
                                        </button>
                                        <a href="{{route('users.active',$user->id)}}" class="btn btn-gradient-success  btn-sm"  style="padding: 10px">

                                            @if($user->is_blocked==0)
                                                ايقاف
                                            @else
                                                تفعيل
                                            @endif
                                             <i class="mdi mdi-account-tie"></i>
                                        </a>

<!--                                        <a class="btn btn-gradient-warning  btn-sm"  style="padding: 10px"
                                           href="{{route('users.show',$user->id)}}
                                                   ">
                                             عرض<i class="mdi mdi-view-agenda"></i>
                                        </a>-->
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
                        url: 'users/'+id,
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
