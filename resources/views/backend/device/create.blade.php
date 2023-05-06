@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Add Device</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <div class="panel-body panel-form">
        <form method="POST" action="{{ route('device.store') }}" class="form-horizontal form-bordered">
            @csrf
            <div class="form-group">
                <div class="pb-1">
                    <label class="font-weight-bold" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" required autofocus>
                </div>
                <div class="pb-1">
                    <label class="font-weight-bold">Device Type</label>
                    <select class="form-control" name="device_type" autofocus id="device_type">
                        <option value="">-- Select --</option>
                        @foreach($device as $a)
                        <option value="{{$a->id}}">{{$a->name}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" value="{{$_GET["type"]}}" name="type">
                <input type="hidden" value="{{$_GET["id"]}}" name="fkid">
                <div class="ac">
                    <div class="pb-1">
                        <label class="font-weight-bold" for="ip">IP Address</label>
                        <input class="form-control" type="text" id="ip" name="ip" ip-mask  autofocus />
                    </div>

                    <div class="pb-1">
                        <label class="font-weight-bold" for="mac">Mac Address</label>
                        <input class="form-control" type="text" id="mac" name="mac" maxlength="17" style="text-transform : uppercase"  autofocus />
                    </div>

                    <div class="pb-1">
                        <label class="font-weight-bold" for="serial">Serial Number</label>
                        <input class="form-control" type="text" id="serial" name="serial"  autofocus>
                    </div>

                    <div class="pb-1">
                        <label class="font-weight-bold" for="username">Username</label>
                        <input class="form-control" type="text" id="username" name="username"  autofocus>
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
                            <option value="no">No</option>
                            @foreach($home as $a)
                            <option value="{{$a->id}}">{{$a->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div align="right" class="col-md-12 col-sm-12">
                    <button type="submit" class="btn btn-sm btn-primary m-r-5">Update</button>
                    <a href="javascript:history.back()" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    @endsection


    @section('script')
    <script>
        $(document).ready(function() {
            $('#device_type').change(function() {
                var data = $('#device_type option:selected').text();
                $('#home_assistant').val('');
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