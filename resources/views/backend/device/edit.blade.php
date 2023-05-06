@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Edit Device</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <div class="panel-body panel-form">
        <form method="POST" id="create-new-roomtype" action="{{ route('device.update', $data->id) }}" class="form-horizontal form-bordered">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <div class="pb-1">
                    <label class="font-weight-bold" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ $data->name }}" required autofocus>
                </div>
                <div class="pb-1">
                    <label class="font-weight-bold">Device Type</label>
                    <select class="form-control" name="device_type" id="device_type" autofocus>
                        @foreach($device as $d)
                        <option value="{{$d->id}}" @if($data->device_type_id == $d->id) selected @endif>{{$d->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="{{$_GET["type"]}}" name="type">
                <input type="hidden" value="{{$_GET["area"]}}" name="fkid">

                <div class="ac">
                    <div class="pb-1">
                        <label class="font-weight-bold" for="ip">IP Address</label>
                        <input class="form-control" type="text" id="ip" name="ip" ip-mask value="{{ $data->ip }}" autofocus />
                    </div>

                    <div class="pb-1">
                        <label class="font-weight-bold" for="mac">Mac Address</label>
                        <input class="form-control" type="text" id="mac" name="mac" value="{{ $data->macaddress }}" maxlength="17" style="text-transform : uppercase" autofocus />
                    </div>

                    <div class="pb-1">
                        <label class="font-weight-bold" for="serial">Serial Number</label>
                        <input class="form-control" type="text" id="serial" name="serial" value="{{ $data->serial_id }}" autofocus>
                    </div>



                    <div class="pb-1">
                        <label class="font-weight-bold" for="username">Username</label>
                        <input class="form-control" type="text" id="username" name="username" value="{{ $data->username }}" autofocus>
                    </div>

                    <div class="pb-1">
                        <label class="font-weight-bold" for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password" value="" autofocus>
                    </div>
                </div>
                <div class="nonac">
                    <div class="pb-1">
                        <label class="font-weight-bold">Home Assistant</label>
                        <select class="form-control" name="home_assistant" autofocus id="home_assistant">
                            <option value="">-- Select --</option>
                            <option value="no" @if($data->home_assistant_id == null) selected @endif>No</option>
                            @foreach($home as $a)
                            <option value="{{$a->id}}" @if($data->home_assistant_id == $a->id) selected @endif>{{$a->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div align="right" class="col-md-12 col-sm-12">
                    <button type="submit" class="btn btn-sm btn-primary m-r-5" id="btn-add-device">Update</button>
                    <a href="javascript:history.back()" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    @endsection


    @section('script')
    <script>
        $(document).ready(function() {
            var data = $('#device_type option:selected').text();
            if (data === "Access Control" || data === "Camera") {
                $('.ac').show();
                $('.nonac').hide();
            } else {
                $('.nonac').show();
                $('.ac').hide();
            }



            var data = $('#home_assistant option:selected').text();
            if (data === "No") {
                $('.ac').show();
                $('.nonac').hide();
            }

            $('#device_type').change(function() {
                var data = $('#device_type option:selected').text();
                if (data === "Access Control" || data === "Camera") {
                    $('.ac').show();
                    $('.nonac').hide();
                } else {
                    $('.nonac').show();
                    $('.ac').hide();
                }

            });


            $('#home_assistant').change(function() {
                var data = $('#home_assistant option:selected').text();
                if (data === "No") {
                    $('.ac').show();
                    $('.nonac').hide();
                }
            });
        });
    </script>

    @endsection