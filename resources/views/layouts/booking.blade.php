<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>Room Booking</title>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }} : {{ $title ?? __('layout.label.web_slogan') }}" />
    <meta property="og:description" content="{{ $title ?? __('layout.label.web_info') }}" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/icons8-door-to-door-delivery-24.png') }}">

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('css/default/app.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('plugins/jvectormap-next/jquery-jvectormap.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/gritter/css/jquery.gritter.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/nvd3/build/nv.d3.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/tag-it/css/jquery.tagit.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/fullcalendar/dist/fullcalendar.print.css') }}?v={{ config('constant.version') }}" rel="stylesheet" media='print' />
    <link href="{{ asset('plugins/fullcalendar/dist/fullcalendar.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/fullcalendar/dist/fullcalendar.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/tag-it/css/jquery.tagit.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/jstree/dist/themes/default/style.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('js/app.min.js') }}?v={{ config('constant.version') }}"></script>
    <script src="{{ asset('js/theme/default.min.js') }}?v={{ config('constant.version') }}"></script>
    <!-- ================== END BASE JS ================== -->

    <style>
        .error {
            height: calc(1.5em + 14px + 2px) !important;
            color: red;
        }
    </style>

</head>

<body class="pace-top page-with-light-sidsebar" style="overflow: hidden;background:white;">

    <!-- Start @Body -->
    @yield('content')
    <!-- End @Body -->

    <!-- Start @ModalForm -->
    @include('backend.partials.modal')
    <!-- End @ModalForm -->
</body>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('plugins/gritter/js/jquery.gritter.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.time.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.resize.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.pie.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jvectormap-next/jquery-jvectormap.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jvectormap-next/jquery-jvectormap-world-mill.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}?v={{ config('constant.version') }}"></script>

<script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}?v={{ config('constant.version') }}"></script>

<script src="{{ asset('plugins/d3/d3.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/nvd3/build/nv.d3.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jvectormap-next/jquery-jvectormap.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jvectormap-next/jquery-jvectormap-world-mill.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/apexcharts/dist/apexcharts.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/moment/moment.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}?v={{ config('constant.version') }}"></script>

<script src="{{ asset('plugins/jquery-migrate/dist/jquery-migrate.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/moment/moment.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jquery.maskedinput/src/jquery.maskedinput.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/bootstrap-select/dist/js/bootstrap-select.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/tag-it/js/tag-it.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/bootstrap-show-password/dist/bootstrap-show-password.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/clipboard/dist/clipboard.min.js') }}?v={{ config('constant.version') }}"></script>

<script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}?v={{ config('constant.version') }}"></script>

<script src="{{ asset('plugins/moment/moment.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/fullcalendar/dist/fullcalendar.min.js') }}?v={{ config('constant.version') }}"></script>

<script src="{{ asset('plugins/jvectormap-next/jquery-jvectormap.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jvectormap-next/jquery-jvectormap-world-mill.js') }}?v={{ config('constant.version') }}"></script>

<script src="{{ asset('plugins/summernote/dist/summernote.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/tag-it/js/tag-it.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jstree/dist/jstree.min.js') }}?v={{ config('constant.version') }}"></script>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="{{ asset('plugins/jstree/dist/jstree.min.js') }}?v={{ config('constant.version') }}"></script>

<script src="{{ asset('js/custom.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('js/custom2.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ url('js/mask.ip-input.js')}}"></script>
<script src="{{ asset('js/map.js') }}?v={{ config('constant.version') }}"></script>

<!-- ================== END PAGE LEVEL JS ================== -->
@yield('script')
<script>
   var session_login_email = "{{ Session::get('email') }}";
  var session_admin_email = "{{ Session::get('admin-username') }}";
  var session_booking_per_week = "{{ Session::get('booking-per-week') }}";
  var session_booking_per_day = "{{ Session::get('booking-per-day') }}";
  var session_booking_ahead_day = "{{ Session::get('booking-ahead-day') }}";
  var session_booking_hour_max = "{{ Session::get('booking-hour-max') }}";
  var session_booking_hour_min = "{{ Session::get('booking-hour-min') }}";
  var session_max_participant;
  var session_before_start = "{{ Session::get('before-start') }}";
  var session_after_start = "{{ Session::get('after-start') }}";
  var session_time_step = "{{ Session::get('time-step') }}";

    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>

</html>