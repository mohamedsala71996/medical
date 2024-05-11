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
    الطلبات
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}

@endsection

@section('content')

    <div class="card"{{--style="padding:0 !important;"--}} >
        <div class="card-body" {{--style="padding: 1.25rem !important;"--}}>
            @if($orders->count()!=null)
                <div class="row mb-4" >
                    <div class="col-6">
                        <div class="form-group">
                            <label>اختر الحالة</label>
                            <select data-validation="required" id="customSearchForStatus" name="customSearchForStatus" class="select2  form-control">
                                <option value="" >اختر الحالة</option>
                                <option value="طلب جديد" >طلب جديد</option>
                                <option value="طلب ملغى" >طلب ملغى</option>
                                <option value="طلب منتهى" >طلب منتهى</option>

                            </select>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="order-listing" class="table display nowrap " cellspacing="0" width="100%">
                        <?php
                        $count=1;
                        ?>
                        @if($orders->count()!=null)
                            <thead>
                            <tr>
                                <th> #</th>
                                <th> اسم صاحب الطلب</th>
                                <th>رقم الجوال</th>
                                <th>التاريخ </th>
                                <th>السعر</th>
                                <th>الحالة</th>
                                <th class="none">التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                     <td>{{$count++}}</td>
                                    <td>@if($order->user){{$order->user->name}}@endif</td>
                                    <td>@if($order->user){{$order->user->phone}}@endif</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->total_cost}}</td>
                                    <td>
                                        @if(in_array($order->status,[0]))
                                            <i class="badge badge-success"> طلب جديد</i>
                                        @elseif(in_array($order->status,[2]))
                                            <i class="badge badge-success"> السائق متوجه للعميل</i>
                                        @elseif(in_array($order->status,[3]))
                                            <i class="badge badge-success"> جارى التوصيل</i>
                                        @elseif($order->status == 1)
                                            <i class="badge badge-danger">طلب ملغى</i>
                                        @elseif( in_array($order->status,[4,5]))
                                            <i class="badge badge-danger">طلب منتهى</i>
                                        @endif
                                    </td>


                                    <td>
                                        <a class="btn btn-gradient-warning  btn-sm"  style="padding: 10px"
                                           href="{{route('allOrders.show',$order->id)}}
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
            $('#customSearchForStatus').on('change', function () {
                table.search(this.value).draw();
            });
            //---------------end datatable--------------
        });
    </script>

@endsection
