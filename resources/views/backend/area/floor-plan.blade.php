@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->
<script>
</script>
<!-- begin row -->
<div class="row">
    <div class="col-xl-12">
        @if(Auth::user()->roles->first()->slug == "super-admin")
        <p align="right">
            <a href="#" class="btn btn-xs btn-default mr-2 visible-house-btn"><i class="fab fa-houzz mr-2"></i>House</a>
            <a href="#" class="btn btn-xs btn-default mr-2 visible-divice-btn"><i class="fas fa-list mr-2"></i>Device</a>
            <a href="#" class="btn btn-xs btn-warning enable-dragable"><i class="fas fa-hand-paper mr-2"></i>Move</a>
        </p>
        @endif
        @if(!is_null($area->ha_id))
        <iframe id="NewFrame" src="https://ha.lanna.co.th/{{$area->ha_url}}?access_token={{$area->ha_token}}" style="width:100%;Height:80vh;"></iframe>
        @else
        <div class="card mb-3 bg-dark-darker">
            <div class="card-body p-0 plan-area" data-id="{{$area->id}}" data-model="area" @if(Storage::disk('local')->exists($area->floor_plan_image)) style="background-image: url({{ Storage::disk('local')->url($area->floor_plan_image) }});background-size:contain;" @else style="background-image: url({{ asset('img/house.png') }});background-size:contain;" @endif>
                @foreach($rooms as $item)
                @if($item->visible == true)
                <div class="p-1 border border-success dragable" id="dragable-room-{{$item->id}}" style="resize: both;overflow: auto;background-color:rgba(0,255, 0, 0.3);border-color:rgba(255, 255, 255, 0.3);border-radius:5px;top:{{$item->x ?? 5}}%;left:{{$item->y ?? 5}}%;width:5vw;height:7vw;" data-model="area" data-item-id="{{$item->id}}" data-item-type="room">
                    <div id="dragable-header" class="center dragable-room-{{$item->id}}-header" style="top:{{$item->x ?? 5}}%;left:{{$item->y ?? 5}}%;">
                        {{--<h5 @if($item->display_status == 'hover') class="show-status" @endif data-id="{{ $item->id }}">{{ $item->name }}</h5>--}}
                        <h3 class="fab fa-houzz mb-3 @if($item->display_status == 'hover') show-status @endif" data-id="{{ $item->id }}"></h3>
                        {{--@if(isset($item) && Storage::disk('local')->exists($item->floor_plan_image))
                        <div class="mt-1 room-image-link">
                            <a href="{{ route('house.floor-plan', ['id' => $item->id ]) }}">
                        <img src="{{ Storage::disk('local')->url($item->floor_plan_image) }}" width="100%" />
                        </a>
                    </div>
                    <div class="mt-1 p-3">
                        <a href="{{ route('house.floor-plan', ['id' => $item->id ]) }}" class="btn btn-default btn-xs btn-block">Floor Plan</a>
                        @if($item->disable == false)
                        <a href="{{ route('house.booking', ['id' => $item->id ]) }}" class="btn btn-default btn-xs btn-block">Booking</a>
                        @endif
                    </div>
                    @else
                    <div class="mt-1 room-image-link">
                        <a href="{{ route('house.floor-plan', ['id' => $item->id ]) }}"><img src="{{ asset('img/house.png') }}" width="100%" /></a>
                    </div>
                    <div class="mt-1 p-3">
                        <a href="{{ route('house.floor-plan', ['id' => $item->id ]) }}" class="btn btn-default btn-xs btn-block">Floor Plan</a>
                    </div>
                    @endif --}}
                    <div class="">
                        <a href="{{ route('house.floor-plan', ['id' => $item->id ]) }}" class="btn btn-info btn-icon btn-xl mb-2" aria-details="Floo plan"><i class="fa fa-object-group fa-lg" aria-hidden="true"></i></a>
                    </div>
                    <div class="">
                        <a href="{{ route('house.chart', ['id' => $item->id ]) }}" class="btn btn-danger btn-icon btn-xl"><i class="fa fa-area-chart fa-lg" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

            @foreach($rooms as $item)
            <div class="p-1 dragable @if($item->display_status == 'hover' || $item->display_status == 'hide') hide @endif" id="status-room-{{$item->id}}" style="background-color:rgba(0, 0, 0, 0.5);border-color:rgba(255, 255, 255, 0.3);border-radius:5px;color:white;top:{{$item->x ?? 5}}%;left:{{$item->y + 7 ?? 5}}%;width:10vw;" data-model="room" data-item-id="{{$item->id}}" data-item-type="room">
                <div id="dragable-header" class="dragable-room-{{$item->id}}-header text-left p-5" style="top:{{$item->x ?? 5}}%;left:{{$item->y ?? 5}}%;">
                    <p>{{ $item->name }}</p>
                    <p>Status: <span class="text-green">Running</span></p>
                    <p>Temperature: 31°C</p>
                    <!-- <p>Precipitation: 31%</p> -->
                    <p>Humidity: 59%</p>
                    <p>Wind: 11 km/h</p>
                    <p>Animal: 50</p>
                    <p>Device: {{ rand(10,30) }}</p>
                </div>
            </div>
            @endforeach

            @foreach($devices as $item)
            @if($item->visible == true)
            <div class="dragable border-round" id="dragable-device-{{$item->id}}" style="top:{{$item->x ?? 5}}%;left:{{$item->y ?? 5}}%;" data-model="area" data-item-id="{{$item->id}}" data-item-type="device">
                <div id="dragable-header" class="p-5 dragable-device-{{$item->id}}-header" style="top:{{$item->x ?? 5}}%;left:{{$item->y ?? 5}}%;">
                    <!-- <span>{{ $item->name }}</span><br /> -->
                    <div class="device-{{$item->id}}-value" style="font-size:2.5rem;">
                    </div>
                    @if(!is_null($item->icon))
                    @if(Auth::user()->roles->first()->slug == "super-admin")
                    <div class="device--icon device-{{$item->id}}-icon">
                        <span class="mdi mdi-{{ $item->icon }}" style="font-size:2.8rem;@if(!is_null($item->icon_color))color:{{$item->icon_color}};@endif"></span>
                    </div>
                    @else
                    <div class="device--icon device-{{$item->id}}-icon">
                        <span class="mdi mdi-{{ $item->icon }}" style="font-size:2.8rem;@if(!is_null($item->icon_color))color:{{$item->icon_color}};@endif"></span>
                    </div>
                    @endif
                    @endif
                    @if(Storage::disk('local')->exists($item->image))
                    <img src="{{ Storage::disk('local')->url($item->image) }}" width="50px">
                    @endif
                    @if(isset($item->status))
                    <div class="device-{{$item->id}}-status">
                        <span style="font-size:0.5vw;position:relative;top:-15px;">@if(!is_null($item->status->value)){{ $item->status->value }}@endif</span><br />
                        {{--<i style="font-size:0.5vw;">{{ date('H:i:s d/m/Y', strtotime($item->status->created_at)) }}</i>--}}
                    </div>
                    @else<div class="device-{{$item->id}}-status"></div>
                    @endif
                </div>
            </div>
            @endif
            @endforeach
            @if(Storage::disk('local')->exists($area->floor_plan_image))
            <img id="plan-image" src="{{ Storage::disk('local')->url($area->floor_plan_image) }}" width="100%" style="opacity:0;" />
            @else
            <img id="plan-image" src="{{ asset('img/house.png') }}" width="100%" style="opacity:0;" />
            @endif
        </div>
    </div>
    @endif
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="visibleDeviceModal" tabindex="-1" role="dialog" aria-labelledby="visibleDeviceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visibleDeviceLabel">Visible Device</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                @if(count($devices) > 0)
                @foreach($devices as $item)
                <div class="col-md-6">{{$item->name}}</div>
                <div class="col-md-6 text-right">
                    <div class="switcher switcher-success">
                        <input type="checkbox" name="visible_device_{{$item->id}}" class="visible-device" data-id="{{$item->id}}" id="switcher_checkbox_{{$item->id}}" @if($item->visible == true) checked="true" @endif>
                        <label for="switcher_checkbox_{{$item->id}}"></label>
                    </div>
                </div>
                @endforeach
                @else
                <i>Device not found</i>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="visibleHouseModal" tabindex="-1" role="dialog" aria-labelledby="visibleHouseLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visibleHouseLabel">Visible House</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(count($rooms) > 0)
                <table class="" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Display Status</th>
                            <th>Visible</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $item)
                        <tr>
                            <td><i class="fab fa-houzz mr-2"></i>{{$item->name}}</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="visible-room form-check-input" type="radio" id="flexRadioDefault1_{{$item->id}}" name="display_status_{{$item->id}}" data-id="{{$item->id}}" value="always" @if($item->display_status == 'always') checked="true" @endif>
                                    <label class="form-check-label" for="flexRadioDefault1_{{$item->id}}">
                                        Always
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="visible-room form-check-input" type="radio" id="flexRadioDefault2_{{$item->id}}" name="display_status_{{$item->id}}" data-id="{{$item->id}}" value="hover" @if($item->display_status == 'hover') checked="true" @endif>
                                    <label class="form-check-label" for="flexRadioDefault2_{{$item->id}}">
                                        Hover
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="visible-room form-check-input" type="radio" id="flexRadioDefault3_{{$item->id}}" name="display_status_{{$item->id}}" data-id="{{$item->id}}" value="hide" @if($item->display_status == 'hide') checked="true" @endif>
                                    <label class="form-check-label" for="flexRadioDefault3_{{$item->id}}">
                                        Hide
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="switcher switcher-success">
                                    <input type="checkbox" name="visible_room_{{$item->id}}" class="visible-room" data-id="{{$item->id}}" id="switcher_checkbox_{{$item->id}}" @if($item->visible == true) checked="true" @endif>
                                    <label for="switcher_checkbox_{{$item->id}}"></label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <i>House not found</i>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.close-modal').click(function() {
            location.reload();
        });

        if (typeof $('.visible-divice-btn').length !== 'undefined') {
            $('.visible-divice-btn').click(function() {
                $('#visibleDeviceModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        }

        if (typeof $('.visible-house-btn').length !== 'undefined') {
            $('.visible-house-btn').click(function() {
                $('#visibleHouseModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

        }

        if (typeof $('.show-status').length !== 'undefined') {

            $(".show-status").mouseenter(function() {
                var room = $(this);
                var room_id = room.data('id');
                $('#status-room-' + room_id).removeClass('hide');
            }).mouseleave(function() {
                var room = $(this);
                var room_id = room.data('id');
                $('#status-room-' + room_id).addClass('hide');
            });
        }

        if (typeof $('.visible-device').length !== 'undefined') {
            $('.visible-device').click(function() {
                var status;
                var old_status;
                var chk = $(this);
                var device_id = chk.data('id');
                if (!$(this).is(':checked')) {
                    status = false;
                    old_status = true;
                } else {
                    status = true;
                    old_status = false;
                }
                $.ajax({
                    url: "/backend/device/update_visible",
                    type: "post",
                    data: {
                        '_token': $('#global_csrf').val(),
                        'id': device_id,
                        'visible': status
                    },
                    success: function(response) {
                        //console.log(response);
                        if (response != true) {
                            toastr.error(toastr_lang.update_fail);
                            if (old_status == true) {
                                chk.prop('checked', true);
                            } else {
                                chk.removeAttr('checked');
                            }
                        } else {
                            toastr.success(toastr_lang.update_success);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }

                });
            });
        }

        if (typeof $('.visible-room').length !== 'undefined') {
            $('.visible-room').click(function() {
                var status;
                var old_status;
                var chk = $(this);
                var room_id = chk.data('id');
                var v = chk.val();
                $.ajax({
                    url: "/backend/house/update_display_status",
                    type: "post",
                    data: {
                        '_token': $('#global_csrf').val(),
                        'id': room_id,
                        'display_status': v
                    },
                    success: function(response) {
                        //console.log(response);
                        if (response != true) {
                            toastr.error(toastr_lang.update_fail);
                        } else {
                            toastr.success(toastr_lang.update_success);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }

                });
            });
        }
    });
</script>
@endpush