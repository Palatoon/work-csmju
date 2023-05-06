@extends('layouts.auth')

@section('content')
<!-- begin login -->
<div class="login login-with-news-feed">
    <!-- begin news-feed -->
    <div class="news-feed">
        <div class="news-image" style="background-image: url({{ asset('img/james-baltz-jAt6cN6zl8M-unsplash.jpg') }})"></div>
        <div class="news-caption">
            <h4 class="caption-title"><b>Smartfarm Portal</b></h4>
            <p>
                SmartFarm provides complete farm management solution with robust and flexible system for farm data management.
            </p>
        </div>
    </div>
    <!-- end news-feed -->
    <!-- begin right-content -->
    <div class="right-content">
        <!-- begin login-header -->
        <div class="login-header">
            <div class="brand">
                <span class="logo" style="background-color: #00acac;"></span> <b>Smartfarm Portal</b>
                <small>smartfarm management</small>
            </div>
            <div class="icon">
                <i class="fab fa-pagelines"></i>
            </div>
        </div>
        <!-- end login-header -->
        <!-- begin login-content -->
        <div class="login-content">
            <form method="POST" action="{{ route('login') }}" class="margin-bottom-0">
                @csrf

                <div class="form-group m-b-15">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror form-control-lg" placeholder="Username" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus />

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group m-b-15">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror form-control-lg" placeholder="Password" name="password" required autocomplete="current-password" />

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <!-- <div class="checkbox checkbox-css m-b-30">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div> -->
                <div class="login-buttons">
                    <button type="submit" class="btn btn-success btn-block btn-lg">{{ __('Login') }}</button>
                </div>
                <!-- <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                    Not a member yet? Click <a href="{{ route('register') }}">here</a> to register.
                </div> -->
                <hr />
                <p class="text-center text-grey-darker mb-0">
                    &copy; Smartfarm Portal All Right Reserved 2022
                </p>
            </form>
        </div>
        <!-- end login-content -->
    </div>
    <!-- end right-container -->
</div>
<!-- end login -->

<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
@endsection