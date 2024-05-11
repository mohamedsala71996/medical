<!-- plugins:css -->
<link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="{{asset('admin')}}/assets/vendors/css/vendor.bundle.base.css">
<!-- End plugin css for this page -->
<!-- Layout styles -->
<link rel="stylesheet" href="{{asset('admin')}}/assets/css/style.css">

@if(app()->isLocale('en'))

@else

@endif


<style>
    .form-error{
        color: red;
        font-weight: bold;
    }
</style>