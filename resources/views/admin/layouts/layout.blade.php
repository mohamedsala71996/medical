<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$settings->ar_title}}</title>
    {{--CSS Files--}}
    @include('admin.layouts._css')
    @yield('header')
    <style>
        .dropdown .dropdown-menu .dropdown-item:hover{
            color: #4c3d3d !important;
        }
    </style>
    <link href="{{asset('admin/validation/toastr.min.css')}}" rel="stylesheet">
{{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
--}}
    <link rel="shortcut icon" href="{{get_file($settings->logo)}}" />
</head>
<body class="rtl {{get_slider_theme(admin()->user())}} ">
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
@include('admin.inc._navbar')
<!-- partial -->
    <div class="container-fluid page-body-wrapper">
    {{--Color Setting--}}
    @include('admin.inc._setting')

    <!-- partial:partials/_sidebar.html -->
    @include('admin.inc._sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="page-header">
                    <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> @yield('page-title') </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            {{--This is for make nav --}}
                            <li class="breadcrumb-item " aria-current="page">
                                <a href="{{route('admin.dashboard')}}">
                                    <span></span>الرئيسية
                                </a>

                            </li>
                            @yield('nav-links')
                        </ul>
                    </nav>
                </div>
                @include('admin.inc._flash')
                {{--Content --}}
                @yield('content')
                {{--Content --}}
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        @include('admin.inc._footer')
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('admin.layouts._js')


{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
--}}
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr.options.escapeHtml = false;
    var pusher = new Pusher('0b4339d2fa08549457c0', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('new-order-channel');
    channel.bind('App\\Events\\OrderEvent', function(data) {
        var url_="{{url('admin/allOrders')}}"+'/'+data.order_id
        toastr.success(
            '<a style="color:#fff" href="'+url_+'">'+data.message+'</a>',
            '<a style="color:#fff" href="'+url_+'">'+data.title+'</a>');
        $('#new_order').addClass('count-indicator');
    });
    userId = '{{auth()->user()->id}}';
    Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        console.log(notification);
    });
    var channel = pusher.subscribe('new-order-channel');
    channel.bind('App\\Events\\OrderEvent', function(data) {
        var url_="{{url('admin/allOrders')}}"+'/'+data.order_id
        toastr.success(
            '<a style="color:#fff" href="'+url_+'">'+data.message+'</a>',
            '<a style="color:#fff" href="'+url_+'">'+data.title+'</a>');
        $('#new_order').addClass('count-indicator');
    });

    var askingForHelpChannel = pusher.subscribe('askingForHelp');
    askingForHelpChannel.bind('App\\Events\\AskingForHelpEvent', function(data) {
        var url_="{{url('admin/askingForHelp')}}"+'/'+data.askingForHelp_id
        toastr.success(
            '<a style="color:#fff" href="'+url_+'">'+data.message+'</a>',
            '<a style="color:#fff" href="'+url_+'">'+data.title+'</a>');
        $('#new_order').addClass('count-indicator');
    });

</script>
@yield('footer')
</body>
@toastr_render
</html>
