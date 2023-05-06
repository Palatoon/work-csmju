<!DOCTYPE html>
<html lang="th">
<head>
  <!-- Title -->
  <title>{{ config('app.name') }} : {{ $title ?? __('layout.label.web_slogan') }}</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('img/icons8-energy-saving-bulb-24.png') }}">
  <meta property="og:url" content="{{ request()->fullUrl() }}" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="{{ config('app.name', 'Running-Hub') }} : {{ $title ?? __('layout.label.web_slogan') }}" />
  <meta property="og:description" content="{{ $title ?? __('layout.label.web_info') }}" />
  <meta property="og:image" content="{{ $img ?? asset('img/landing-share.jpg') }}" />
  <meta name="keywords" content="วิ่ง,งานวิ่ง,Running-Hub,Activity">
  <meta name="author" content="Alongkot Karpchai">
  <meta property="fb:app_id" content="{{ env('FB_CLIENT_ID')}}" />
  <link rel="stylesheet" href="{{ asset('css/all.css') }}?v={{ config('constant.version') }}">
</head>

<body class="pace-top bg-grey-transparent-3">

  <!-- Start @Container -->
  <div id="page-container">
    <!-- Start @Header -->
    @include('frontend.partials.header')
    <!-- End @Header -->

    <!-- Start @Warpper -->
    <div class="g-mt-60--xs">

      <!-- Start @Notification -->
      @include('frontend.partials.notification')
      <!-- End @Notification -->

      <!-- Start @Content -->
      @yield('content')
      <!-- End @Content -->
    </div>
    <!-- End @Warpper -->
  </div>
  <!-- End @Container -->

  <!-- Start @Footer -->
  @include('frontend.partials.footer')
  <!-- End @Footer -->

  <!-- Start @Modal -->
  @include('frontend.partials.modal-map')
  @include('frontend.partials.modal-form')
  <!-- End @Modal -->
</body>
<script type="text/javascript">
  var baseUrl = '{{ asset("") }}'; // eslint-disable-line
  var googleMapKey = '{!! env("GOOGLE_MAP_KEY") !!}'; // eslint-disable-line
  var mapboxToken = '{!! env("MAPBOX_TOKEN") !!}'; // eslint-disable-line
  var locale = '{{ !empty(app()->getLocale()) ? app()->getLocale() : config("app.fallback_locale") }}'; // eslint-disable-line
</script>
<script src="{{ asset('js/fontawesome-all.min.js') }}?v={{ config('constant.version') }}" defer></script>
<script src="{{ asset('js/fe-libs-min.js') }}?v={{ config('constant.version') }}"></script>
@if(env('APP_ENV') == 'local')
  <script src="{{ asset('js/fe-scripts.js') }}?v={{ config('constant.version') }}"></script>
@else
  <script src="{{ asset('js/fe-scripts-min.js') }}?v={{ config('constant.version') }}"></script>
@endif
@yield('script')
</html>
