<!-- begin #header -->
<div id="header" class="header navbar-default">
    <!-- begin navbar-header -->
    <div class="navbar-header">
        <a href="{{ action('Backend\DashboardController@index') }}" class="navbar-brand"><img src="{{ asset('img/3474044.png') }}">&nbsp;<b style="color:#00acac;">Smartfarm</b>&nbsp;Portal</a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- end navbar-header -->
    <!-- begin header-nav -->
    <ul class="navbar-nav navbar-right">
        <li class="navbar-form">
            <form action="" method="POST" name="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter keyword" />
                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                <i class="fa fa-bell"></i>
                <span class="label">5</span>
            </a>
            <div class="dropdown-menu media-list dropdown-menu-right">
                <div class="dropdown-header">NOTIFICATIONS (<span class="user-notification-count"></span>)</div>
                <div class="text-center w-300px py-3" id="user-notification-list">

                </div>
            </div>
        </li>
        <li class="dropdown navbar-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('img/user/admin-png-4.png') }}" alt="" />
                <span class="d-none d-md-inline">{{ Session::get('name') }}</span> <b class="caret"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <!-- <a href="#modal-profile" data-toggle="modal" class="dropdown-item">Edit Profile</a> -->
                <!-- <div class="dropdown-divider"></div> -->
                <a href="{{ action('Auth\LoginController@logout') }}" class="dropdown-item">Sign Out</a>
            </div>
        </li>
    </ul>
    <!-- end header-nav -->
</div>
<!-- end #header -->