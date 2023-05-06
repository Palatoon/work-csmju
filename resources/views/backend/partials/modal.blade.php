<!-- Modal -->
<!-- <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h1><i class="fa fa-door-open mr-2 mb-3"></i> Room Booking</h1>
                <form>
                    <div class="form-group m-b-15">
                        <input id="modal-username" type="text" class="form-control form-control-lg" placeholder="Username" name="username" autocomplete="off" autofocus />
                    </div>
                    <div class="form-group m-b-15">
                        <input id="modal-password" type="password" class="form-control form-control-lg" placeholder="Password" name="password" autocomplete="off" autofocus />
                    </div>
                    <div class="login-buttons">
                        <button type="button" class="btn btn-red btn-block btn-lg" id="modal-login-btn" data-token="{{ Session::token() }}">{{ __('Login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="create-new-booking-form" method="post" action="{{ action('Backend\BookingRequestController@store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="booking_id" id="booking_id" value="">
                    <input type="hidden" name="booker" value="{{ Session::get('uid') }}">
                    <input type="hidden" name="room_id" id="room_id" value="">
                    <fieldset>
                        <div class="form-group">
                            <label for="room_name">Room</label>
                            <input type="text" class="form-control" id="room_name" placeholder="Name" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="booking_title">Name</label>
                            <input type="text" class="form-control" id="booking_title" name="title" placeholder="Name" value="Booking">
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="datepicker-start">Start</label>
                                <input type="text" class="form-control" id="datepicker-start" name="start" placeholder="Date Start" required autocomplete="off">
                            </div>
                            <div class="col-6">
                                <label for="datepicker-end">End</label>
                                <input type="text" class="form-control" id="datepicker-end" name="end" placeholder="Date End" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="booking_detail">Detail</label>
                            <textarea class="summernote" id="booking_detail" name="detail" rows="7"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10">
                                <div class="input-group m-b-10">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-users"></i></span></div>
                                    <input type="text" id="search-participant" class="form-control" list="list_participant" placeholder="Participant (Please enter 3 or more characters)" autocomplete="off">
                                    <datalist id="list_participant">
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-block btn-success" id="add_participant"><i class="fas fa-user-plus mr-2"></i>Add</button>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" value="" name="participants" id="participant-list">
                                <ul id="jquery-tagIt-participant" class="inverse">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="checkbox checkbox-css">
                                    <input type="checkbox" name="online_meeting" id="onlineMeeting" value="true" checked="false">
                                    <label for="onlineMeeting">Join a meeting in Teams</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-danger hide" id="cancel-booking-btn" data-token="{{ Session::token() }}">Cancel Booking</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create-new-booking" data-token="{{ Session::token() }}">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createEventModal2" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Building</h5>
                <button type="button" class="close" data-dismiss="modal" id="btn-cancel-building2" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal form-bordered" id="create-new-building2" method="POST" action="{{ route('farm.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Building Name * : </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Building Name" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Building Name (English): </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="name_en" placeholder="Building Name (English)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Description: </label>
                        <div class="col-lg-8">
                            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description"></textarea>
                        </div>
                    </div>

                    <input type="hidden" id="xlocation" name="x">
                    <input type="hidden" id="ylocation" name="y">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancel-buildings">Close</button>
                <button type="button" class="btn btn-primary" id="btn-add-building2">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createEventModal3" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Configuration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal form-bordered" id="btn-add-config" method="POST" action="{{ route('configuration.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Configuration Name * : </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="names" name="name" placeholder="ConfigurationName" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Value: </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="value" placeholder="Value">
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Type: </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="type" placeholder="Type">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Default: </label>
                        <div class="col-lg-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isdefault" value="1">
                                <label class="form-check-label" for="auto_approve">true</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isdefault" value="0" checked="">
                                <label class="form-check-label" for="auto_approve">false</label>
                            </div>
                        </div>
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-add-configs">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Configuration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal form-bordered" id="btn-edit-config" method="POST" action="{{ route('configuration.update') }}">
                    @csrf
                    <!-- <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Configuration Name * : </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="setting-label" name="name" autofocus>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Value: </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="setting-value" name="value">
                        </div>
                    </div>
                    <!-- 
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Unit: </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="types" name="type">
                        </div>
                    </div>
                 
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Default: </label>
                        <div class="col-lg-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="isdefaults" name="isdefault" value="1" > 
                                <label class="form-check-label" for="auto_approve">true</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="isdefaultes" name="isdefault" value="0">
                                <label class="form-check-label" for="auto_approve">false</label>
                            </div>
                        </div>
                    </div> -->
                    <input type="hidden" name="id" id="setting-id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-edit-configs">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createEventModal5" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Configuration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 modal_body_map">
                        <div class="location-map" id="location-map">
                            <div style="width: 600px; height: 400px;" id="map_canvas"></div>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal form-bordered" id="btn-editmap-config" method="POST" action="{{ route('configuration.update') }}">
                    @csrf
                    <input type="hidden" id="mapnames" name="name">
                    <input type="hidden" id="mapvalue" name="value">
                    <input type="hidden" id="mapid" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-map-configs">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h1><i class="fa fa-door-open mr-2 mb-3"></i> Room Booking</h1>
                <form>
                    <div class="form-group m-b-15">
                        <input id="modal-username" type="text" class="form-control form-control-lg" placeholder="Username" name="username" autocomplete="off" autofocus />
                    </div>
                    <div class="form-group m-b-15">
                        <input id="modal-password" type="password" class="form-control form-control-lg" placeholder="Password" name="password" autocomplete="off" autofocus />
                    </div>
                    <div class="login-buttons">
                        <button type="button" class="btn btn-red btn-block btn-lg" id="modal-login-btn" data-token="{{ Session::token() }}">{{ __('Login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="typeStatusModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="type-name"></span> status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-type-status" class="form-horizontal form-bordered" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <input id="edit_type_status_id" type="hidden" name="" value="" />
                    <input id="type_status_id" type="hidden" name="" value="" />
                    <div class="form-group m-b-15">
                        <input type="text" class="form-control" placeholder="Name" name="name" autocomplete="off" />
                    </div>
                    <div class="form-group m-b-15">
                        <label class="font-weight-bold" for="status-image">Status Image</label><br />
                        <input type="file" id="status-image" name="status_image" accept="image/png, image/gif, image/jpeg" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-red btn-block btn-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>







<div class="modal fade" id="modalcamera" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personcount">Persons</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{ asset('img/loading.gif') }}">
                <h5><strong class="text-uppercase">{{ trans('message.pwlo') }}</strong></h5>
                <h5 class="text-danger">{{ trans('message.pdcp') }}</h5>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalsetdevice" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personcount">Setting Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="room_id" id="st_room_id">
                    <input type="hidden" name="device_id" id="st_device_id">
                    <div class="col pt-2">Start Time</div>
                    <div class="col">
                        <label class="switch">
                            <input type="checkbox" name="" value="" id="st_time">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col pt-2">End Time</div>
                    <div class="col">
                        <label class="switch">
                            <input type="checkbox" name="" value="" id="ed_time">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>







<div class="modal fade" id="notifyModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal form-bordered" id="edit-notify" method="POST" action="{{route('notification.update') }}">
                    @csrf
                    <input type="hidden" id="notify_id" name="notify_id">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Name * : </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="notify_name" name="notify_name" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Unit: </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="notify_unit" name="notify_unit">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Value: </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="notify_value" name="notify_value">
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Type: </label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="types" name="type">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Notify: </label>
                        <div class="col-lg-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="notify_active" name="isdefault" value="1">
                                <label class="form-check-label" for="auto_approve">true</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="notify_unactive" name="isdefault" value="0">
                                <label class="form-check-label" for="auto_approve">false</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-edit-notify">Save changes</button>
            </div>
        </div>
    </div>
</div>









