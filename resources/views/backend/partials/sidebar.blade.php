<!--begin #sidebar -->
<div id="sidebar" class="sidebar">
  <!-- begin sidebar scrollbar -->
  <div data-scrollbar="true" data-height="100%">
    <!-- begin sidebar user -->
    <ul class="nav">
      <li class="nav-profile">
        <a href="javascript:;" data-toggle="nav-profile">
          <div class="cover with-shadow"></div>
          <div class="image">
            <img src="{{ asset('img/user/admin-png-4.png') }}" alt="" />
          </div>
          <div class="info">
            <b class="caret pull-right"></b>
            {{ Session::get('name') }}
            <small>{{ Session::get('email') }}</small>
          </div>
        </a>
      </li>
      <li>
        <ul class="nav nav-profile">
          <li><a href="#modal-profile" data-toggle="modal" class="dropdown-item"><i class="fa fa-user mr-2"></i> Edit Profile</a></li>
          <li><a href="{{ action('Auth\LoginController@logout') }}" class="dropdown-item"><i class="fa fa-sign-out-alt mr-2"></i> Sign Out</a></li>
        </ul>
      </li>
    </ul>
    <!-- end sidebar user -->
    <!-- begin sidebar nav -->
    <ul class="nav">
      <li class="nav-header">Navigation</li>
      <li class="{{ (request()->is('backend') || request()->is('/')) ? 'active' : '' }}">
        <a href="{{ action('Backend\DashboardController@index') }}">
          <i class="fa fa-map mr-2"></i>
          <span>Plan</span>
        </a>
      </li>
      <!-- <li class="{{ request()->segment(2) == 'map' ? 'active' : '' }}">
        <a href="{{ action('Backend\MapController@index') }}">
          <i class="fa fa-map mr-2"></i>
          <span>Map</span>
        </a>
      </li>` -->
      {{--@if(Auth::user()->can('manage-requests'))
      <li class="{{ request()->segment(2) == 'booking-request' ? 'active' : '' }}">
      <a href="{{ action('Backend\BookingRequestController@index') }}">
        <i class="fa fa-tasks mr-2"></i>
        <span>Request</span>
      </a>
      </li>
      @endif--}}
      <li class="has-sub expand">
        <a href="javascript:;">
          <b class="caret"></b>
          <i class="fas fa-paw mr-2"></i>
          <span>Animal</span>
        </a>
        <ul class="sub-menu" style="display: block;">
          @foreach(App\AnimalType::all() as $item)
          <li class="{{ request()->segment(2) == 'animal' ? 'active' : '' }}">
            <a href="{{ action('Backend\AnimalController@index', ['type'=> $item->id]) }}">
              <span>{{ ucfirst($item->name_en) }}</span>
            </a>
          </li>
          @endforeach
          <li class="{{ request()->segment(2) == 'animal' ? 'active' : '' }}">
            <a href="{{ action('Backend\AnimalController@index') }}">
              <span>All</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="has-sub expand {{ request()->segment(2) == 'power' ? 'active' : '' }}">
        <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-bolt"></i>
          <span>Power</span>
        </a>
        <ul class="sub-menu" style="display: block;">
          <li class="{{ request()->segment(3) == 'meter' ? 'active' : '' }}">
            <a href="{{ route('meter.dashboard') }}">
              <span>Meter</span>
            </a>
          </li>
          <li class="{{ request()->segment(3) == 'historical' ? 'active' : '' }}">
            <a href="javascript:;">
              <b class="caret"></b>
              <span>History</span>
            </a>
            <ul class="sub-menu" style="display: block;">
              <li class="{{ (request()->is('backend/power/historical/recently')) ? 'active' : '' }}"><a href="{{ action('Backend\HistoricalController@recently') }}">Recently</a></li>
              <li class="{{ (request()->is('backend/power/historical/hour')) ? 'active' : '' }}"><a href="{{ action('Backend\HistoricalController@hour') }}">Hour</a></li>
              <li class="{{ (request()->is('backend/power/historical/day')) ? 'active' : '' }}"><a href="{{ action('Backend\HistoricalController@day') }}">Day</a></li>
              <li class="{{ (request()->is('backend/power/historical/week')) ? 'active' : '' }}"><a href="{{ action('Backend\HistoricalController@week') }}">Week</a></li>
              <li class="{{ (request()->is('backend/power/historical/month')) ? 'active' : '' }}"><a href="{{ action('Backend\HistoricalController@month') }}">Month</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="{{ request()->segment(2) == 'report' ? 'active' : '' }}">
        <a href="{{ action('Backend\ReportController@index') }}">
          <i class="fa fa-bar-chart mr-2"></i>
          <span>Report</span>
        </a>
      </li>
      @if(Auth::user()->can('manage-settings'))
      <li class="has-sub expand">
        <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-cogs mr-2"></i>
          <span>Setting</span>
        </a>
        <ul class="sub-menu" style="display: block;">
          @if(Auth::user()->can('manage-users'))
          <li class="{{ request()->segment(2) == 'user' ? 'active' : '' }}">
            <a href="{{ action('Backend\UserController@index') }}">
              <i class="fa fa-user mr-2"></i>
              <span>User</span>
            </a>
          </li>
          @endif
          @if(Auth::user()->can('manage-farms'))
          <li class="{{ request()->segment(2) == 'farm' ? 'active' : '' }}">
            <a href="{{ action('Backend\BuildingController@index') }}">
              <i class="fa fa-signs-post mr-2"></i>
              <span>Farm</span>
            </a>
          </li>
          @endif
          @if(Auth::user()->can('manage-areas'))
          <li class="{{ request()->segment(2) == 'area' ? 'active' : '' }}">
            <a href="{{ action('Backend\AreaController@index') }}">
              <i class="fas fa-layer-group mr-2"></i>
              <span>Area</span>
            </a>
          </li>
          @endif
          @if(Auth::user()->can('manage-houses'))
          <li class="{{ request()->segment(2) == 'house' ? 'active' : '' }}">
            <a href="{{ action('Backend\RoomController@index') }}">
              <i class="fab fa-houzz mr-2"></i>
              <span>House</span>
            </a>
          </li>
          @endif
          {{--@if(Auth::user()->can('manage-houses'))
          <li class="{{ request()->segment(2) == 'home-assistant' ? 'active' : '' }}">
          <a href="{{ action('Backend\HomeAssistantController@index') }}">
            <i class="fa fa-microchip mr-2"></i>
            <span>Home Assistant</span>
          </a>
      </li>
      @endif--}}
      @if(Auth::user()->can('manage-settings'))
      <li class="{{ request()->segment(2) == 'group' ? 'active' : '' }}">
        <a href="{{ action('Backend\GroupController@index') }}">
          <i class="fa fa-users mr-2"></i>
          <span>Group</span>
        </a>
      </li>
      <li class="{{ request()->segment(2) == 'datacode' ? 'active' : '' }}">
        <a href="{{ action('Backend\DatacodeController@index') }}">
          <i class="fa fa-arrows mr-2" aria-hidden="true"></i>
          <span>Datacode</span>
        </a>
      </li>
      <li class="has-sub expand {{ request()->segment(2) == 'configuration' ? 'active' : '' }}">
        <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-cog mr-2"></i>
          <span>Setting</span>
        </a>
        <ul class="sub-menu" style="display: block;">
          <li class="{{ request()->segment(2) == 'configuration' ? 'active' : '' }}">
            <a href="{{ action('Backend\ConfigurationController@index') }}">
              <span>System</span>
            </a>
          </li>
          <li class="{{ request()->segment(2) == 'notification' ? 'active' : '' }}">
            <a href="{{ route('notification.index') }}">
              <span>Notification</span>
            </a>
          </li>
          <li class="{{ request()->segment(2) == 'house-type' ? 'active' : '' }}">
            <a href="{{ action('Backend\RoomTypeController@index') }}">
              <span>House Type</span>
            </a>
          </li>
          <li class="{{ request()->segment(2) == 'device-type' ? 'active' : '' }}">
            <a href="{{ action('Backend\DeviceTypeController@index') }}">
              <span>Device Type</span>
            </a>
          </li>
          <li class="{{ request()->segment(2) == 'animaltype' ? 'active' : '' }}">
            <a href="{{ action('Backend\AnimaltypeController@index') }}">
              <span>Animal Type</span>
            </a>
          </li>
          <li class="{{ request()->segment(2) == 'animalattribute' ? 'active' : '' }}">
            <a href="{{ action('Backend\AnimalattributeController@index') }}">
              <span>Animal Attribute</span>
            </a>
          </li>
          <li class="{{ request()->segment(2) == 'historytype' ? 'active' : '' }}">
            <a href="{{ action('Backend\HistoryTypeController@index') }}">
              <span>History Type</span>
            </a>
          </li>
        </ul>
      </li>
      @endif
      <!-- <li class="{{ request()->segment(2) == 'device' ? 'active' : '' }}">
            <a href="{{ action('Backend\DeviceController@index') }}">
              <i class="fa fa-door-closed mr-2"></i>
              <span>Device</span>
            </a>
          </li> -->
    </ul>
    </li>
    @endif
    <!-- <li class="{{ request()->segment(2) == 'map' ? 'active' : '' }}">
        <a href="{{ action('Backend\MapController@index') }}">
          <i class="fa fa-map mr-2"></i>
          <span>Map</span>
        </a>
      </li> -->
    <!-- begin sidebar minify button -->
    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left mr-2"></i></a></li>
    <!-- end sidebar minify button -->
    </ul>
    <!-- end sidebar nav -->
  </div>
  <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar