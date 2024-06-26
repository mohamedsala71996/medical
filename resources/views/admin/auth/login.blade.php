<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$settings->ar_title}}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('admin')}}/assets/css/style.css">
    <link href="{{asset('admin/validation/toastr.min.css')}}" rel="stylesheet">

    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('admin')}}/assets/images/favicon.png" />
</head>
<body class="rtl">
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-right p-5">
                        <div class="brand-logo text-center" >
                            @php
                                $setting=\App\Models\Setting::first();
                            @endphp
                            <img src="{{asset('upload/'.$setting->logo)}}">
                        </div>
                        <form class="pt-3" method="Post" id="loginform" action="{{ route('admin.login.submit') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input datat-validation="required,email" name="email" type="email" class="form-control form-control-lg" value="{{ old('email') }}" id="exampleInputEmail1" placeholder="البريد الإلكترونى">
                            </div>
                            <div class="form-group">
                                <input datat-validation="required" type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="كلمة المرور">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">تسجيل الدخول</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('admin')}}/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('admin')}}/assets/js/off-canvas.js"></script>
<script src="{{asset('admin')}}/assets/js/hoverable-collapse.js"></script>
<script src="{{asset('admin')}}/assets/js/misc.js"></script>
<script src="{{asset('admin/validation/toastr.min.js')}}"></script>
<script src="{{asset('admin/validation/jquery.form-validator.js')}}"></script>

<!-- endinject -->
<script>
    $.validate({

    });
</script>
</body>
@toastr_render
</html>