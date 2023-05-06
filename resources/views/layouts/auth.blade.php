<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Smart Farm Portal</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />

  <!-- ================== BEGIN BASE CSS STYLE ================== -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="{{ asset('css/default/app.min.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link href="{{ asset('css/custom.css') }}?v={{ config('constant.version') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
  <!-- ================== END BASE CSS STYLE ================== -->

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="{{ asset('js/app.min.js') }}?v={{ config('constant.version') }}"></script>
  <script src="{{ asset('js/theme/default.min.js') }}?v={{ config('constant.version') }}"></script>
  <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}?v={{ config('constant.version') }}"></script>
  <!-- ================== END BASE JS ================== -->
</head>

<body class="pace-top">

  <!-- begin #page-loader -->
  <div id="page-loader" class="fade show">
    <span class="spinner"></span>
  </div>
  <!-- end #page-loader -->

  <!-- begin #page-container -->
  <div id="page-container" class="fade">
    @yield('content')
  </div>
  <!-- end page container -->

</body>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
@yield('script')
<script>
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