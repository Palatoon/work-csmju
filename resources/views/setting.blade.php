@extends('layouts.auth')

@section('content')
<!-- begin register -->
<div class="login login-with-news-feed">
    <!-- begin news-feed -->
    <div class="news-feed">
        <div class="news-image" style="background-image: url({{ asset('img/login-bg/login-bg-11.jpg') }})"></div>
        <div class="news-caption">
            <h4 class="caption-title"><b>Settings</b></h4>
            <p>
                As a Color Admin app administrator, you use the Color Admin console to manage your organization’s account, such as add new users, manage security settings, and turn on the services you want your team to access.
            </p>
        </div>
    </div>
    <!-- end news-feed -->
    <!-- begin right-content -->
    <div class="right-content">
        <!-- begin register-header -->
        <div class="login-header">
            <div class="brand">
                <span class="logo" style="background-color: #ff5b57;"></span> <b>Settings</b>
                <small>responsive bootstrap 4 admin template</small>
            </div>
            <div class="icon">
                <i class="fas fa-cogs"></i>
            </div>
        </div>
        <!-- end register-header -->
        <!-- begin register-content -->
        <div class="login-content">
            <form action="{{route('settings.store')}}" method="post" class="margin-bottom-0" id="settings-form" onsubmit="return:confirm()">
                @csrf
                <label class="control-label">Domain/Server <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="Domain" name="domain" placeholder="Domain/Server" required />
                    </div>
                </div>
                <label class="control-label">Domain Suffix <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="Suffix" name="suffix" placeholder="Domain Suffix" required />
                    </div>
                </div>
                <label class="control-label">Organizational Unit <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="Organization" name="organization" placeholder="Organizational Unit" required />
                    </div>
                </div>
                <label class="control-label">Admin User <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="Username" name="admin-username" placeholder="Admin User" required />
                    </div>
                </div>
                <label class="control-label">Password <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12">
                        <input type="password" class="form-control" id="Password" name="admin-password" placeholder="Password" required />
                    </div>
                </div>
                <div class="register-buttons">
                    <button type="submit" class="btn btn-danger btn-block btn-lg" id="btn-submit-setting">Submit</button>
                </div>
                <hr />
                <p class="text-center mb-0">
                    &copy; Color Admin All Right Reserved 2020
                </p>
            </form>
        </div>
        <!-- end register-content -->
    </div>
    <!-- end right-content -->
</div>
<!-- end register -->
@endsection



@section('script')
<script>
$('#btn-submit-setting').click(function(ev) {

    if($('#domain').val() == ""){
        $('#domain').focus();
    }
    else if($('#suffix').val() == ""){
        $('#suffix').focus();
    }
    else if($('#ou').val() == ""){
        $('#ou').focus();
    }
    else if($('#username').val() == ""){
        $('#username').focus();
    }
    else if($('#password').val() == ""){
        $('#password').focus();
    }else{
            ev.preventDefault();
            swal({
                title: 'Alert',
                text: 'Are you sure that you want to add settings?',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: 'Cancel',
                        value: null,
                        visible: true,
                        className: 'btn btn-default',
                        closeModal: true,
                    },
                    confirm: {
                        text: 'Confirm',
                        value: true,
                        visible: true,
                        className: 'btn btn-info',
                        closeModal: true
                    }
                }
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $("#settings-form").submit();
                }
            });
        });
    }
		</script>
@endsection