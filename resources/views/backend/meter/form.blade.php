@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->
<style>
    .btn-light:not(:disabled):not(.disabled).active {
        background-color: #00ff00;
        color: #FFF;
    }

    .btn-light2 {
        color: #212529;
        background-color: #f2f3f4;
        border-color: #f2f3f4;
        -webkit-box-shadow: 0;
        box-shadow: 0
    }

    .btn-light2:hover {
        color: #212529;
        background-color: #d6dadd;
        border-color: #d6dadd
    }

    .btn-light2.focus,
    .btn-light2:focus {
        box-shadow: 0 0 0 0 rgba(211, 212, 214, .5)
    }

    .btn-light2.disabled,
    .btn-light2:disabled {
        color: #212529;
        background-color: #f2f3f4;
        border-color: #f2f3f4
    }

    .btn-light2:not(:disabled):not(.disabled).active,
    .btn-light2:not(:disabled):not(.disabled):active,
    .show>.btn-light.dropdown-toggle {
        background-color: #ee000e;
        color: #FFF;
    }

    .btn-light2:not(:disabled):not(.disabled).active:focus,
    .btn-light2:not(:disabled):not(.disabled):active:focus,
    .show>.btn-light2.dropdown-toggle:focus {
        box-shadow: 0 0 0 0 rgba(211, 212, 214, .5)
    }
</style>
<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Add Meter</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body panel-form">
        <form method="POST" id="meter-form" action="{{ route('meter.create') }}" class="form-horizontal form-bordered form-action-model" enctype="multipart/form-data">
            @csrf
            @if(isset($data))<input class="form-control" type="hidden" name="id" value="{{$data->SensorID}}" required />@endif
            <div class="form-group">
                <div class="pb-1">
                    <label class="font-weight-bold" for="building">Building</label>
                    <select id="meter_building" name="meter_building" class="form-control">
                        @foreach($buildings as $item)
                        <option value="{{$item->id}}" @if(isset($data) && $data->building == $item->id) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="pb-1">
                    <label class="font-weight-bold" for="area">Area</label>
                    <select id="eter_area" name="meter_area" class="form-control">
                        @foreach($areas as $item)
                        <option value="{{$item->id}}" @if(isset($data) && $data->area == $item->id) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>



                <div class="pb-1">
                    <label class="font-weight-bold" for="building">Room</label>
                    <select id="meter_room" name="meter_room" class="form-control">
                        @foreach($rooms as $item)
                        <option value="{{$item->id}}" @if(isset($data) && $data->room == $item->id) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="pb-1">
                    <label class="font-weight-bold" for="name">Meter Name</label>
                    <input class="form-control" type="text" id="meter_name" name="meter_name" placeholder="Meter Name" value="{{$data->Label ?? ''}}" required />
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="name_en">Token GUID</label>
                    <input class="form-control" type="text" id="meter_guid" name="meter_guid" placeholder="Token GUID" value="{{$data->TokenGuid ?? ''}}">
                </div>

                <div class="pb-1">
                    <div class="col-sm-4 float-left">

                        <label class="font-weight-bold mr-3" for="meter_status">Status</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-light @if(isset($data) && $data->Status == 1)active @endif" onclick="setValue(1, 1)">
                                <input type="radio" name="meter_status" id="meter_status" value="{{ (isset($data)) ? $data->Status : 0 }}" autocomplete="off" checked>Active
                            </label>
                            <label class="btn btn-light2 @if(isset($data) && $data->Status == 0)active @elseif($action == 'add')active @endif" onclick="setValue(1, 0)">
                                <input type="radio" name="" id="" value="{{ (isset($data)) ? $data->Status : 0 }}" autocomplete="off">
                                Unactive
                            </label>
                        </div>
                        <!-- <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="meter_status" value="1" @if(isset($data) && $data->Status == 1) checked @endif onclick="approve(true)">
                            <label class="form-check-label" for="meter_status">True</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="meter_status" value="0" @if(isset($data) && $data->Status == 0) checked @elseif($action == 'add') checked @endif onclick="approve(false)">
                            <label class="form-check-label" for="meter_status">False</label>
                        </div> -->
                    </div>

                    <div class="col-sm-4 float-left">
                        <label class="font-weight-bold mr-3" for="meter_notify">Notification</label>

                        
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-light @if(isset($data) && $data->Notify == 1)active @endif" onclick="setValue(2, 1)">
                                <input type="radio" name="meter_notify" id="meter_notify" value="{{ (isset($data)) ? $data->Notify : 0 }}" autocomplete="off" checked>Active
                            </label>
                            <label class="btn btn-light2 @if(isset($data) && $data->Notify == 0)active @elseif($action == 'add')active @endif" onclick="setValue(2, 0)">
                                <input type="radio" name="" id="" value="0" autocomplete="off">
                                Unactive
                            </label>
                        </div>
                        <!-- <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="meter_notify" value="1" @if(isset($data) && $data->Notify == 1) checked @endif onclick="approve(true)">
                            <label class="form-check-label" for="meter_notify">True</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="meter_notify" value="0" @if(isset($data) && $data->Notify == 0) checked @elseif($action == 'add') checked @endif onclick="approve(false)">
                            <label class="form-check-label" for="meter_notify">False</label>
                        </div> -->
                    </div>


                    <div class="col-sm-4 float-left">
                        <label class="font-weight-bold mr-3" for="meter_license">License</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-light @if(isset($data) && $data->active_license == 1)active @endif" onclick="setValue(3, 1)">
                                <input type="radio" name="meter_license" id="meter_license" value="{{ (isset($data)) ? $data->active_license : 0 }}" autocomplete="off" checked>Active
                            </label>
                            <label class="btn btn-light2 @if(isset($data) && $data->active_license == 0)active @elseif($action == 'add')active @endif" onclick="setValue(3, 0)">
                                <input type="radio" name="" id="" value="0" autocomplete="off">
                                Unactive
                            </label>
                        </div>
                        <!-- <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="meter_license" value="1" @if(isset($data) && $data->active_license == 1) checked @endif onclick="approve(true)">
                            <label class="form-check-label" for="meter_license">True</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="meter_license" value="0" @if(isset($data) && $data->active_license == 0) checked @elseif($action == 'add') checked @endif onclick="approve(false)">
                            <label class="form-check-label" for="meter_license">False</label>
                        </div> -->

                    </div>
                </div>



                <div class="pb-1 row">
                    <label class="font-weight-bold col-12" for="meter-image">Image</label><br />
                    <div class="col-12 mb-3"><input type="file" id="meter-image" name="meter_image" accept="image/png, image/gif, image/jpeg" /></div>
                    @if(isset($data) && $data->Image != null)<div class="col-12"><img src="{{ url('img/meter/'.$data->Image) }}" width="50%" /></div>@endif
                </div>

                <div align="right" class="col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-primary m-r-5 btn-action-model" data-form="meter-form" data-model="meter" data-action="{{ $action }}">@if($action == 'edit') Update @else {{ucfirst($action)}} @endif</button>
                    <a href="{{ route('meter.dashboard') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection




@section('script')

<script>
    setValue = (id, val) => {
        switch (id) {
            case 1:
                $('#meter_status').val(val);
                break;
            case 2:
                $('#meter_notify').val(val);
                break;
            case 3:
                $('#meter_license').val(val);
                break;
        }
    }
</script>
@endsection