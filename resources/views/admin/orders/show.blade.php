@extends('admin.layouts.layout')

@section('header')
    <!-- Popup CSS -->
    <link href="{{asset('admin/plugins/popup/dist/popup.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/owl.carousel.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/owl.theme.default.min.css')}}" rel="stylesheet" type="text/css">
<style>
     #map-canvas {
         height: 350px;
        width:100%;
        margin: 0px;
        padding: 0px
    }
</style>
@endsection


@section('page-title')
    {{-- عنوان الصفحة --}}
    عرض طلب
@endsection


@section('nav-links')
    {{-- اضافة زرار--}}
    <li class="breadcrumb-item " aria-current="page">
        <a href="{{route('allOrders.index')}}">
            <span></span>كل الطلبات
        </a>

    </li>
    <li class="breadcrumb-item " aria-current="page">

        <span></span> عرض
    </li>

@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered  ">
                        <thead>
                        <tr>
                            <th class="alert alert-fill-danger" colspan="2" style="text-align: center; color: white"><strong>التفاصيل</strong></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="text-nowrap" scope="row"> اسم طالب الخدمة</th>
                            <td><a href="{{route('users.show',$order->user->id)}}" >{{$order->user->name}}</a></td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row"> رقم الجوال</th>
                            <td>{{$order->user->name}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row"> البريد الإلكترونى</th>
                            <td>{{$order->user->email}}</td>
                        </tr>

                        @if($order->driver!=null)
                            <tr>
                                <th class="text-nowrap" scope="row">  اسم السائق </th>
                                <td><a href="{{route('drivers.show',$order->driver->id)}}" >{{$order->driver->name}} </a></td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row"> رقم جوال السائق</th>
                                <td>{{$order->driver->phone}}</td>
                            </tr>

                            <tr>
                                <th class="text-nowrap" scope="row">  البريد الإلكترونى للسائق</th>
                                <td>{{$order->driver->email}}</td>
                            </tr>

                        @else
                        @endif


                        <tr>
                            <th class="text-nowrap" scope="row"> نسبة التطبيق</th>
                            <td>{{$order->app_pay_amount}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row">القيمة المالية</th>
                            <td>{{$order->total_cost}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row">توقيت الطلب </th>
                            <td>
                                {{$order->created_at}}
                            </td>
                        </tr>

                        <tr>
                            <th class="text-nowrap" scope="row">الحالة</th>
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
                        </tr>

                        <tr>
                            <th class="text-nowrap" scope="row">توقيت بداية التوصيل </th>
                            <td>
                                {{$order->start_time??"لم يتم التحديد"}}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-nowrap" scope="row">توقيت نهاية التوصيل </th>
                            <td>
                                {{$order->end_time??"لم يتم التحديد"}}
                            </td>
                        </tr>
                        @if($order->end_time)
                        <tr>
                            <th class="text-nowrap" scope="row">الوقت المستغرق </th>
                            <td>
                                @php
                                        $time = new DateTime($order->start_time);
                                        $diff = $time->diff(new DateTime($order->end_time));
                                        $minutes = ($diff->days * 24 * 60) +
                                                   ($diff->h * 60) + $diff->i;

                                @endphp
                                   {{$minutes}} دقيقة
                            </td>
                        </tr>
                        @endif


                        <tr>
                            <th class="text-nowrap" scope="row">طريقة الدفع المختارة</th>
                            <td>
                                {{$order->payment_method=='cash'?'كاش':'credit card'}}
                            </td>
                        </tr>

                        <tr>
                            <th class="text-nowrap" scope="row">تقييم العميل</th>
                            <td>
                                {{$order->client_rate==0?'لم يتم التقييم':$order->client_rate/5}}
                            </td>
                        </tr>


                        <tr>
                            <th colspan="2" style="text-align: center; background-color:#636c72; color: white">
                                <strong>الموقع على الخريطة</strong></th>
                        </tr>
                        </tbody>

                    </table>
                    <input type="button" id="routebtn" value="أظهر على الخريطة"  class="form-control btn btn-danger"/>
                    <div id="map-canvas"></div>


                </div>
            </div>


        </div>
    </div>

@endsection

@section('footer')
    {{--POP UP--}}
    <script src="{{asset('admin/plugins/popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('admin/plugins/popup/dist/jquery.magnific-popup-init.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/owl.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/owl-carousel.js')}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4l5QxL27z4w0uuD_5X3g0IRhaUdvb0Q4"></script>

    <script>
        function mapLocation() {
            var directionsDisplay;
            var directionsService = new google.maps.DirectionsService();
            var map;

            function initialize() {
                directionsDisplay = new google.maps.DirectionsRenderer();
                var chicago = new google.maps.LatLng('{{$order->from_latitude}}','{{$order->from_longitude}}');
                var mapOptions = {
                    zoom: 7,
                    center: chicago
                };
                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                directionsDisplay.setMap(map);
                google.maps.event.addDomListener(document.getElementById('routebtn'), 'click', calcRoute);
            }

            function calcRoute() {
                var start = new google.maps.LatLng('{{$order->from_latitude}}','{{$order->from_longitude}}');
                //var end = new google.maps.LatLng(38.334818, -181.884886);
                var end = new google.maps.LatLng('{{$order->to_latitude}}','{{$order->to_longitude}}');
                var request = {
                    origin: start,
                    destination: end,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                        directionsDisplay.setMap(map);
                    } else {
                        alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
                    }
                });
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        }
        mapLocation();
    </script>
@endsection
