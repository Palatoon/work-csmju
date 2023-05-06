@extends('layouts.backend')
@section('title', $route)
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-xl-12">
        <!-- begin panel -->
        <div class="panel" data-sortable-id="table-basic-7">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title"><i class="fa fa-cube"></i> Meter</h4>
                <div class="panel-heading-btn">
                    @if(Session::get('role') == 1)
                    <a href="#modal-dialog" data-toggle="modal" class="btn btn-icon btn-circle btn-green"><i class="fa fa-plus"></i></a>
                    @endif
                    <a href="javascript:;" class="btn btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <!-- begin table-responsive -->
                <div class="table-responsive">
                    <table class="table table-striped m-b-0" id="data-table-default">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Location</th>
                                <th class="text-nowrap">Floor</th>
                                <th class="text-nowrap">Room</th>
                                @if(Session::get('role') == 1)
                                <th class="text-nowrap">Loop Time</th>
                                <th class="text-nowrap">License</th>
                                <th class="text-nowrap">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($sensor))
                            @foreach($sensor as $key => $value)
                            <tr>
                                <td class="with-img">
                                    <img src="{{ $value->Image != '' ? $value->Image : asset('img/custom/AC-380V-5A.jpg') }}" class="img-rounded height-30" />
                                </td>
                                <td>{{ $value->Label }}</td>
                                <td>{{ $value->Location }}</td>
                                <td>{{ $value->Floor }}</td>
                                <td>{{ $value->Room }}</td>
                                @if(Session::get('role') == 1)
                                <td>{{ $value->Loop_Time }}<a href="#" class="text-black edit-loop-time-modal" data-id="{{$value->SensorID}}" data-time="{{$value->Loop_Time}}"><i class="fa fa-edit ml-5"></i></a></td>
                                <td>
                                    <div class="switcher switcher-success">
                                        <input type="checkbox" name="license_active_{{$value->SensorID}}" class="license-active" data-id="{{$value->SensorID}}" id="switcher_checkbox_{{$value->SensorID}}" @if($value->active_license == true) checked="true" @endif>
                                        <label for="switcher_checkbox_{{$value->SensorID}}"></label>
                                    </div>
                                </td>
                                <td><a href="javascript:;" class="btn btn-xs btn-danger text-white">Remove</a></td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-12 -->
</div>
<!-- end row -->
<!-- #modal-dialog -->
<div class="modal fade" id="modal-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Meter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ action('Backend\MeterController@create') }}" class="margin-bottom-0">
                    @csrf

                    <label class="control-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <label class="control-label">{{ __('Location') }} <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" required autocomplete="location">
                            @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <label class="control-label">{{ __('Floor') }} <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input id="floor" type="text" class="form-control @error('floor') is-invalid @enderror" name="floor" autocomplete="floor">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <label class="control-label">{{ __('Room') }} <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input id="room" type="text" class="form-control @error('room') is-invalid @enderror" name="room" autocomplete="room">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="register-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateLoopTimeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Loop Time (Minute)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ action('Backend\MeterController@updateLoopTime') }}" class="margin-bottom-0">
                    @csrf
                    <input type="hidden" name="SensorID" id="lp_sensor_id">
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input type="number" min="0" class="form-control" id="lp_loop_time" name="Loop_Time" required autofocus>
                        </div>
                    </div>
                    <div class="register-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var handleDataTableDefault = function() {
        "use strict";

        if ($('#data-table-default').length !== 0) {
            $('#data-table-default').DataTable();
        }
    };

    var TableManageDefault = function() {
        "use strict";
        return {
            init: function() {
                handleDataTableDefault();
            }
        };
    }();

    $(document).ready(function() {
        TableManageDefault.init();
        if (typeof $('.edit-loop-time-modal').length !== 'undefined') {
            $('.edit-loop-time-modal').click(function() {
                var id = $(this).data('id');
                var time = $(this).data('time');
                $('#lp_sensor_id').val(id);
                $('#lp_loop_time').val(time);
                $('#updateLoopTimeModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        }
    });
</script>
@endsection