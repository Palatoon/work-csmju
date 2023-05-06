<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Title -->
  <title>Smart Farm Portal</title>
  <!-- Required Meta Tags Always Come First -->

  <meta charset="utf-8" />
  <!-- <meta http-equiv="refresh" content="2400;url=/logout"> -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <meta property="og:url" content="{{ request()->fullUrl() }}" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="{{ config('app.name', 'Laravel') }} : {{ $title ?? __('layout.label.web_slogan') }}" />
  <meta property="og:description" content="{{ $title ?? __('layout.label.web_info') }}" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('img/icons8-door-to-door-delivery-24.png') }}">

  <!-- ================== BEGIN BASE CSS STYLE ================== -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.9.55/css/materialdesignicons.min.css" integrity="sha512-vIgFb4o1CL8iMGoIF7cYiEVFrel13k/BkTGvs0hGfVnlbV6XjAA0M0oEHdWqGdAVRTDID3vIZPOHmKdrMAUChA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="{{ asset('css/default/app.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <!-- ================== END BASE CSS STYLE ================== -->

  <!-- ================== BEGIN THEME LEVEL STYLE ================== -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
  <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/fullcalendar/dist/fullcalendar.print.css') }}?v={{ config('constant.version') }}" rel="stylesheet" media='print' />
  <link href="{{ asset('plugins/fullcalendar/dist/fullcalendar.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/summernote/dist/summernote.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/tag-it/css/jquery.tagit.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/jstree/dist/themes/default/style.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <!-- ================== END THEME LEVEL STYLE ================== -->

  <!-- ================== BEGIN VENDOR STYLE ================== -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <!-- ================== END VENDOR STYLE ================== -->

  <!-- ================== BEGIN CUSTOM STYLE ================== -->
  <link href="{{ asset('css/custom.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <!-- ================== END CUSTOM STYLE ================== -->

  <!-- ================== BEGIN THEME JS ================== -->
  <script src="{{ asset('js/app.min.js') }}?v={{ config('constant.version') }}"></script>
  <script src="{{ asset('js/theme/default.min.js') }}?v={{ config('constant.version') }}"></script>
  <!-- ================== END THEME JS ================== -->

  @if(Config::get('app.locale') == 'en')
  <script>
    var lang_checker = "en";
  </script>
  @else
  <script>
    var lang_checker = "th";
  </script>
  @endif

  @if(!Auth::check())
  <script>
    window.location = "/logout";
  </script>
  @endif

  <!-- ================== BEGIN CUSTOM JS ================== -->
  <script src="{{ asset('js/custom-language.js') }}?v={{ config('constant.version') }}"></script>
  <!-- ================== END CUSTOM JS ================== -->
</head>

<body class="pace-top page-with-light-sidsebar">
  <input type="hidden" id="global_csrf" value="{{ Session::token() }}">
  <!-- begin #page-loader -->
  <div id="page-loader" class="fade show"><span class="spinner"></span></div>
  <!-- end #page-loader -->

  <!-- begin #page-container -->
  <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

    <!-- Start @Header -->
    @include('backend.partials.header')
    <!-- End @Header -->

    <!-- Start @Sidebar -->
    @include('backend.partials.sidebar')
    <!-- End @Sidebar -->

    <!-- begin #content -->
    <div id="content" class="content">

      <!-- Start @Breadcrumb -->
      @include('backend.partials.breadcrumb')
      <!-- End @Breadcrumb -->

      <!-- Start @Body -->
      @yield('content')
      <!-- End @Body -->

      <!-- begin scroll to top btn -->
      <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
      <!-- end scroll to top btn -->
    </div>
  </div>
  <!-- end page container -->

  <!-- Start @ModalForm -->
  @include('backend.partials.modal')
  <!-- End @ModalForm -->
</body>

<!-- ================== BEGIN THEME JS ================== -->
<script src="{{ asset('plugins/gritter/js/jquery.gritter.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.time.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.resize.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.pie.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/d3/d3.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/nvd3/build/nv.d3.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/apexcharts/dist/apexcharts.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/moment/moment.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jquery-migrate/dist/jquery-migrate.min.js') }}?v={{ config('constant.version') }}"></script>
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
<script src="{{ asset('plugins/fullcalendar/dist/fullcalendar.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/summernote/dist/summernote.min.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('plugins/jstree/dist/jstree.min.js') }}?v={{ config('constant.version') }}"></script>
<!-- ================== END THEME JS ================== -->

<!-- ================== BEGIN VENDOR JS ================== -->
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
<!-- ================== END VENDOR JS ================== -->

<!-- ================== BEGIN CUSTOM JS ================== -->
<script src="{{ asset('js/custom-action.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('js/custom-booking.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('js/custom-calendar.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('js/custom-datatable.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('js/custom-datepicker.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('js/custom-form-validate.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('js/custom-global.js') }}?v={{ config('constant.version') }}"></script>
<script src="{{ asset('js/mask.ip-input.js') }}?v={{ config('constant.version') }}"></script>
<!-- ================== END CUSTOM JS ================== -->



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
</script>

@stack('scripts')

@if(Session::has('message'))
<script>
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
</script>
@endif
<script>
  var nl = 0;
  window.onload = function() {
    // var audio = new Audio('https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3');
    // // Setup all nodes
    // // ...
    getNotification();

    setInterval(() => {
      getNotification();
    }, 3000);
  }

  function sendMarkRequest(id = null) {
    return $.ajax("{{ route('markNotification') }}", {
      method: 'POST',
      data: {
        _token,
        id
      }
    });
  }
  $(function() {
    $('.mark-as-read').click(function() {
      let request = sendMarkRequest($(this).data('id'));
      request.done(() => {
        $(this).parents('div.alert').remove();
      });
    });
    $('#mark-all').click(function() {
      let request = sendMarkRequest();
      request.done(() => {
        $('div.alert').remove();
      })
    });
  });

  function timeSince(date) {

    var seconds = Math.floor((new Date() - date) / 1000);

    var interval = seconds / 31536000;

    if (interval > 1) {
      return Math.floor(interval) + " years ago";
    }
    interval = seconds / 2592000;
    if (interval > 1) {
      return Math.floor(interval) + " months ago";
    }
    interval = seconds / 86400;
    if (interval > 1) {
      return Math.floor(interval) + " days ago";
    }
    interval = seconds / 3600;
    if (interval > 1) {
      return Math.floor(interval) + " hours ago";
    }
    interval = seconds / 60;
    if (interval > 1) {
      return Math.floor(interval) + " minutes ago";
    }
    return Math.floor(seconds) + " seconds ago";
  }

  function getNotification() {
    $.ajax({
      url: "{{ route('notification.get-all') }}",
      type: "post",
      data: {
        "_token": "{{ csrf_token() }}",
      },
      success: function(response) {
        $('#user-notification-list').html("");
        var content = "";
        if (response.length > 0) {
          if (nl != response.length) {
            //$('#notification-icon').addClass('shake');\
            // audio.resume().then(() => {
            //     //console.log('Playback resumed successfully');
            // });s
          }
          nl = response.length;
          $('.user-notification-count').html(response.length);
          $.each(response, function(i, item) {
            content = content + '<a href="javascript:;" class="dropdown-item media">' +
              '<div class="media-left"><i class="fas fa-exclamation-triangle media-object bg-gray-500"></i></div>' +
              '<div class="media-body">' +
              '<h6 class="media-heading">' + item.data.activity.name + ' <i class="fa fa-exclamation-circle text-danger"></i></h6>' +
              '<div class="text-muted fs-10px">' + timeSince(new Date(item.created_at)) + '</div>' +
              '</div>' +
              '</a>';
          });
          $('#user-notification-list').html(content);
        } else {
          $('.user-notification-count').html(0);
          $('#user-notification-list').html("No notification found");
        }
      }
    });
  }
</script>

</html>