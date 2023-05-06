<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>
  <meta name="description" content="@lang('landing.slogan')"/>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Link section -->
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
  <link href="{{ asset('css/all.css') }}" rel="stylesheet">
  <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
  <script src="{{ asset('js/fontawesome-all.min.js') }}?v={{ config('constant.version') }}"></script>
</head>
<body id="top">
  <div class="site-wrapper">
    <div class="site-wrapper-inner">
      <div class="cover-container">
        <!-- Start @Content -->
        @yield('content')
        <!-- End @Content -->
      </div>
    </div>
  </div>
<script type="text/javascript">
  var baseUrl = '{{ asset("") }}'; // eslint-disable-line
  var locale = '{{ !empty(app()->getLocale()) ? app()->getLocale() : config("app.fallback_locale") }}'; // eslint-disable-line
</script>
<script src="{{ asset('js/landing.js') }}?v={{ config('constant.version') }}"></script>
</body>
</html>
