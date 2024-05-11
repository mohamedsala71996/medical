
<!-- plugins:js -->
<script src="{{asset('admin')}}/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="{{asset('admin/assets/vendors/js/raphael-2.1.4.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/justgage.js')}}"></script>

<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('admin')}}/assets/vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('admin')}}/assets/js/off-canvas.js"></script>
<script src="{{asset('admin')}}/assets/js/hoverable-collapse.js"></script>
<script src="{{asset('admin')}}/assets/js/misc.js"></script>
<script src="{{asset('admin')}}/assets/js/settings.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
{{--<script src="{{asset('admin')}}/assets/js/dashboard.js"></script>--}}
{{--<script src="{{asset('admin')}}/assets/js/todolist.js"></script>--}}


<!-- End custom js for this page -->
<script src="{{asset('admin/validation/jquery.form-validator.js')}}"></script>
<script src="{{asset('admin/validation/toastr.min.js')}}"></script>


<script>
    //function of change slider language
    function change_slider_color(slider_color) {
        console.log(slider_color)
        $.ajax({
            url: '{{route('changeSliderColor')}}',
            type: 'POST',
            data: {slider_color: slider_color},
            success: function (data) {
                if (data==1) {
                    //success
                } else {
                    //errors
                    console.log('errors')
                }
            }
        });

    }//end function

    //function of change header language
    function change_header_color(header_theme) {
        console.log(header_theme)
        $.ajax({
            url: '{{route('changeHeaderColor')}}',
            type: 'POST',
            data: {header_theme: header_theme},
            success: function (data) {
                if (data==1) {
                    //success
                } else {
                    //errors
                    console.log('errors')
                }
            }
        });

    }
</script>