@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert/sweetalert.css') }}">

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
    الشروط والأحكام
@endsection

@section('nav-links')
    {{-- اضافة زرار --}}
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <h4 class="card-title col-10">الشروط والأحكام</h4>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="order-listing" class="table display nowrap" cellspacing="0" width="100%">
                        {{-- @if ($terms->count() != 0) --}}
                            <thead>
                                <tr>
                                    <th>المحتوى بالعربية</th>
                                    <th>المحتوى بالإنجليزية</th>
                                    <th>التحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse ($terms as $term) --}}
                                @if ($terms)
                                    <tr>
                                        <td>{{ $term->ar_content }}</td>
                                        <td>{{ $term->en_content }}</td>
                                        <td>
                                            <button class="btn btn-gradient-danger btn-sm delete" style="padding: 10px" id="{{ $term->id }}">
                                                حذف <i class="mdi mdi-delete"></i>
                                            </button>
                                            <a href="{{ route('terms.edit', $term->id) }}" class="btn btn-gradient-success btn-sm" style="padding: 10px">
                                                تعديل <i class="mdi mdi-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @else
                            </tbody>
                        {{-- @else --}}
                            <div class="alert alert-fill-danger">
                                <span style="font-weight: bold">لا يوجد بيانات لعرضها</span>
                            </div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    {{-- <script src="{{ asset('admin/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#order-listing').DataTable({
                "paging": true,
                "ordering": true,
                "info": false,
                "language": {
                    search: "بحث"
                }
            });

            $(document).on('click', '.delete', function() {
                var id = $(this).attr('id');
                swal({
                    title: "تحذير",
                    text: "هل تريد حذف العنصر؟",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "حذف",
                    cancelButtonText: "الغاء",
                    closeOnConfirm: false
                }, function() {
                    $.ajax({
                        url: 'terms/' + id,
                        type: 'delete',
                        data: {
                            id: id
                        },
                        success: function(data) {
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
        });
    </script> --}}
@endsection
