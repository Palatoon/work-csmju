@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->
<!-- begin panel -->
<div class="vertical-box mb-10">
    <!-- begin calendar -->
    <div class="row">
        <div class="col-md-2">
            <form id="room-celendar-form" method="post" action="{{ action('Backend\RoomController@booking', ['id'=> $room->id]) }}">
                <input type="hidden" id="token" name="_token" value="{{ Session::token() }}">
                <input type="hidden" id="main_room" name="main_room" value="{{ $room->id }}">
                <input type="hidden" id="room_array_list" name="room_array_list">
                <div class="form-group row m-b-10">
                    <div class="col-md-12">
                        <div class="panel panel-inverse">
                            <div class="panel-body">
                                <div class="input-group m-b-10">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search mr-2"></i></span></div>
                                    <input type="text" id="search-room-input" class="form-control" placeholder="Room">
                                </div>
                                <div class="input-group m-b-10">
                                    <button type="button" class="btn btn-block btn-info" id="view-select-room"><i class="fas fa-calendar-alt mr-2"></i>Compare</button>
                                </div>
                                <!-- <table class="table table-striped table-bordered table-td-valign-middle" id="room-list-datatable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <i class="fas fa-layer-group mr-2"></i>{{ $area->name }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($room_in_same_buliding as $r)
                                        <tr>
                                            <td class="row" @if($r->id == $room->id) style="pointer-events: none;" @endif>
                                                <div class="col-2 text-right">
                                                    <input type="checkbox" class="switch-room" id="switcher_checkbox_{{ $r->id }}" data-id="{{ $r->id }}" @if(isset($active_room) && in_array($r->id , $active_room)) checked @endif>
                                                    <label for="switcher_checkbox_{{ $r->id }}"></label>
                                                </div>
                                                <div class="col-10">
                                                    <a href="/backend/room/{{$r->id}}/booking" data-id="{{$r->id}}"><i class="fa fa-door-closed mr-2"></i>{{ $r->name }}</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table> -->
                                <div style="overflow:auto;">
                                    <div id="jstree-default" class="pt-3 pb-3">
                                        <ul>
                                            <li data-jstree='{ "checkbox_disabled": true, "opened": true }'>
                                                {{ $building->name }}
                                                @foreach($tree as $t)
                                                <ul>
                                                    <li @if($t->id == $area->id) data-jstree='{ "opened":true, "checkbox_disabled": true, "selected": true, "type": "area" }' @else data-jstree='{ "checkbox_disabled": true, "type": "area" }' @endif>{{ $t->name }}
                                                        <ul>
                                                            @foreach($t->rooms as $r)
                                                            @if($r->disable == true)
                                                            <li data-jstree='{ "checkbox_disabled": true, "disabled": true, "type": "room" }'>{{ $r->name }}</li>
                                                            @else
                                                            <li @if(in_array($r->id, $active_room)) data-jstree='{ "selected": true, "checkbox": true, "type": "room" }' @else data-jstree='{ "checkbox": true, "type": "room"}' @endif><a href="{{ action('Backend\RoomController@booking', ['id' => $r->id]) }}">{{ $r->name }}</a></li>
                                                            @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="panel panel-inverse text-center hide" id="multiple-calendar-control">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <h5>Calendar Control</h5>
                        </div>
                        <div class="col-12 mb-1">
                            <div class="input-group m-b-10">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-calendar-alt mr-2"></i></span></div>
                                <input type="text" id="calendar-date" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-12 mb-3"><button type="button" class="btn btn-block btn-info btn-calendar-today"><i class="fas fa-calendar-check mr-2"></i>Today</button></div>
                        <div class="col-6"><button type="button" class="btn btn-block btn-info btn-calendar-previous"><i class="fa fa-backward mr-2"></i>Previous</button></div>
                        <div class="col-6"><button type="button" class="btn btn-block btn-info btn-calendar-next">Next<i class="fa fa-forward mr-2"></i></button></div>
                    </div>
                </div>
            </div>
        </div>
        @switch(count($active_room))
        @case(1)
        <div class="col-md-10" id="calendar" class="calendar"></div>
        @break

        @case(2)
        @foreach($active_room as $ar)
        <div class="col-md-5 text-center">
            <h3 class="btn btn-block btn-info"><i class="fas fa-calendar-alt mr-2"></i>{{ \App\Room::find($ar)->name }}</h3>
            <div id="calendar_{{ $ar }}" data-name="{{ \App\Room::find($ar)->name }}" class="calendar"></div>
        </div>
        @endforeach
        @break
        @case(3)
        @foreach($active_room as $ar)
        <div class="col-md-3 text-center">
            <h3 class="btn btn-block btn-info"><i class="fas fa-calendar-alt mr-2"></i>{{ \App\Room::find($ar)->name }}</h3>
            <div id="calendar_{{ $ar }}" data-name="{{ \App\Room::find($ar)->name }}" class="calendar"></div>
        </div>
        @endforeach
        @break

        @default
        @foreach($active_room as $ar)
        <div class="col-md-2 text-center">
            <h3 class="btn btn-block btn-info"><i class="fas fa-calendar-alt mr-2"></i>{{ \App\Room::find($ar)->name }}</h3>
            <div id="calendar_{{ $ar }}" data-name="{{ \App\Room::find($ar)->name }}" class="calendar"></div>
        </div>
        @endforeach
        @endswitch
    </div>
    <!-- end calendar -->
    <hr />
</div>
<!-- end panel -->
<!-- end row -->
<script>
    var event = @json($event);
    var main_room = @json($room);
    var multi_room = @json($multi_room);
</script>
@endsection