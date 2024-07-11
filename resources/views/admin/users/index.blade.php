@extends('admin.layouts.layout')

@section('header')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

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
    العملاء
@endsection

@section('nav-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <h4 class="card-title col-10">العملاء</h4>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="order-listing" class="table display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>الأسم</th>
                                <th>البريد الالكتروني</th>
                                <th>الجوال </th>
                                <th>الصورة</th>
                                <th>الحالة</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() > 0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            <img src="{{ asset($user->image) }}" width="50px" height="50px">
                                        </td>
                                        <td>
                                            @if ($user->is_approved == 1)
                                                <span class="badge badge-success">مفعل</span>
                                            @else
                                                <span class="badge badge-danger">موقوف</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#approveModal-{{ $user->id }}">التفاصيل</button>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="approveModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="approveModalLabel">تفاصيل العميل</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>الاسم:</label>
                                                        <p>{{ $user->name }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>البريد الالكتروني:</label>
                                                        <p>{{ $user->email }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>الجوال:</label>
                                                        <p>{{ $user->phone }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>الحالة:</label>
                                                        @if($user->is_approved == 1)
                                                            <p><span class="badge badge-success">مفعل</span></p>
                                                        @else
                                                            <p><span class="badge badge-danger">موقوف</span></p>
                                                        @endif
                                                    </div>

                                                    <form action="{{ route('users.updateApproval', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="form-group">
                                                            <label>تفعيل / إلغاء التفعيل:</label>
                                                            <select name="is_approved" class="form-control">
                                                                <option value="1" {{ $user->is_approved == 1 ? 'selected' : '' }}>مفعل</option>
                                                                <option value="0" {{ $user->is_approved == 0 ? 'selected' : '' }}>موقوف</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-success">حفظ</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-fill-danger">
                                    <span style="font-weight: bold">لا يوجد بيانات لعرضها</span>
                                </div>
                            @endif
                        </tbody>
                    </table>
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('admin/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/datatables.net/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

@endsection
