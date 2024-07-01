@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert/sweetalert.css') }}">

    <style>
        div.dataTables_wrapper div.dataTables_filter {
            text-align: left !important;
        }
    </style>
@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    مديرو الموقع
@endsection



@section('content')

    <div class="card"{{-- style="padding:0 !important;" --}}>
        <div class="card-body" {{-- style="padding: 1.25rem !important;" --}}>
            <h4 class="card-title">مديرو النظام</h4>
            <div class="row mb-4">
                <h4 class="card-title col-10">إضافة مدير جديد</h4>
                <a href="{{ route('admins.create') }}" style="float: left" class="btn btn-gradient-warning btn-sm col-2"><i
                        class="mdi mdi-plus-circle"></i> أضف جديد</a>

            </div>
            <div class="row">

                <div class="col-12">
                    <table id="order-listing" class="table">
                        <?php
                        $count = 1;
                        ?>
                        @if ($admins->count() != null)
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th>الأسم</th>
                                    <th>البريد الكترونى</th>
                                    <th>التحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            <button class="btn btn-gradient-danger  btn-fw delete" style="padding: 10px"
                                                id="{{ $admin->id }}">
                                                حذف <i class="mdi mdi-delete"> </i>
                                            </button>
                                            <a class="btn btn-gradient-success  btn-fw" style="padding: 10px"
                                                href="{{ route('admins.edit', $admin->id) }}
                                                ">
                                                تعديل<i class="mdi mdi-account-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="alert alert-fill-danger">
                                    <span style="font-weight: bold"> لا يوجد بيانات لعرضها</span>
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
    <script src="{{ asset('admin/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            //--------------datatable----------------
            $('#order-listing').DataTable({
                "paging": false,
                "ordering": false,
                "info": false,
                "language": {
                    search: "بحث"
                }
            });
            //---------------end datatable--------------
            //---------------Delete--------------
            $(document).on('click', '.delete', function() {
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
                }, function() {
                    console.log(id)
                    $.ajax({
                        url: 'admins/' + id,
                        type: 'delete',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            console.log(data)
                            if (data.error == 1) {
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
                                }, function() {
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
