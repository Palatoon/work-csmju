@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<!-- begin row -->
<div class="row">
    <div class="col-xl-12">
        <!-- begin row -->
        <div class="row">
            @if(isset($meter_datas))
            @foreach($meter_datas as $key => $value)
            <!-- begin col-6 -->
            <div class="col-sm-4">
                <!-- begin card -->
                <div class="card border-0 bg-dark text-white text-truncate mb-3">
                    <!-- begin card-body -->
                    <div class="card-body">
                        <!-- begin title -->
                        <div class="mb-3 text-grey row">
                            <div class="col-xl-6">
                                <form method="post" enctype="multipart/form-data" id="recently-report-{{ $value->SensorID }}" action="{{ action('Backend\HistoricalController@recently') }}">
                                    @csrf
                                    <input type="hidden" name="sltSenSor" value="{{ $value->SensorID }}">
                                    <b class="mb-3">{{ $value->label }}</b>
                                    @if(round(abs(strtotime(date('Y-m-d H:i:s')) - strtotime($value->time)) / 60,2) < 10) <span class="ml-2 text-green">
                                        <i class="fa fa-check-circle"></i> ON
                                        </span>
                                        @elseif($value->time == "")
                                        <span class="ml-2 text-orange">
                                            <i class="fa fa-unlink"></i> UNLINK
                                        </span>
                                        @else
                                        <span class="ml-2 text-red">
                                            <i class="fa fa-power-off"></i> OFF
                                        </span>
                                        @endif
                                </form>
                            </div>
                            <div class="col-xl-6">
                                @if(!is_null($value->room) || !is_null($value->area) || !is_null($value->building))
                                <pre class="text-right text-yellow"><i class="fa fa-map-marker "></i> <i>{{ $value->room."," ?? ""}} {{ $value->area."," ?? ""}} {{ $value->building ?? ""}}</i></pre>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-1">
                            <h2 class="text-white mb-0"><span data-animation="number" data-value="{{ abs($value->elecu) ?? 0 }}">0</span> Unit</h2>
                            <div class="ml-auto">
                                <button class="btn btn-sm btn-danger select-meter" data-id="{{ $value->SensorID }}"><i class="fa fa-chart-line"></i> Chart</button>
                            </div>
                        </div>
                        <div class="mb-4 text-grey">
                            ฿<span class="text-yellow" data-animation="number" data-value="{{ number_format((float)($value->elecu*$price), 2, '.', '') ?? 0 }}">0</span>
                        </div>
                        <div class="d-flex mb-2 row">
                            <div class="col col-xs-6"><i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                Phase 1</div>
                            <div class="col col-xs-2 text-right text-pink f-w-600"><span data-animation="number" data-value="{{ abs($value->elecp1) ?? 0 }}">0</span> kW</div>
                            <div class="col col-xs-2 text-right text-blue f-w-600"><span data-animation="number" data-value="{{ abs($value->eleci1) ?? 0 }}">0</span> A</div>
                            <div class="col col-xs-2 text-right text-white f-w-600"><span data-animation="number" data-value="{{ abs($value->elecv1) ?? 0 }}">0</span> V</div>
                        </div>
                        <div class="d-flex mb-2 row">
                            <div class="col col-xs-6"><i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                Phase 2</div>
                            <div class="col col-xs-2 text-right text-pink f-w-600"><span data-animation="number" data-value="{{ abs($value->elecp2) ?? 0 }}">0</span> kW</div>
                            <div class="col col-xs-2 text-right text-blue f-w-600"><span data-animation="number" data-value="{{ abs($value->eleci2) ?? 0 }}">0</span> A</div>
                            <div class="col col-xs-2 text-right text-white f-w-600"><span data-animation="number" data-value="{{ abs($value->elecv2) ?? 0 }}">0</span> V</div>
                        </div>
                        <div class="d-flex mb-2 row">
                            <div class="col col-xs-6"><i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                                Phase 3</div>
                            <div class="col col-xs-2 text-right text-pink f-w-600"><span data-animation="number" data-value="{{ abs($value->elecp3) ?? 0 }}">0</span> kW</div>
                            <div class="col col-xs-2 text-right text-blue f-w-600"><span data-animation="number" data-value="{{ abs($value->eleci3) ?? 0 }}">0</span> A</div>
                            <div class="col col-xs-2 text-right text-white f-w-600"><span data-animation="number" data-value="{{ abs($value->elecv3) ?? 0 }}">0</span> V</div>
                        </div>
                    </div>
                    <!-- end card-body -->
                    <div class="card-footer bg-dark text-muted">
                        @if($value->time != '')
                        <i class="fa fa-clock"></i> Last data update {{ $value->time ?? "" }}
                        @else
                        <i class="fa fa-unlink"></i> Unlink data
                        @endif
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col-6 -->
            @endforeach
            @endif
            @if(isset($meters))
            <div class="col-sm-12 mt-3">
                <div class="panel" data-sortable-id="table-basic-7">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-cube"></i> Meter</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <!-- <a href="javascript:;" class="btn btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> -->
                            <a href="javascript:;" class="btn btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p align="right">
                            <a href="{{ url('/backend/power/meter/add' ) }}" class="btn btn-xs btn-info"><i class="fas fa-plus mr-2"></i>Add</a>
                        </p>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>SensorID</th>
                                    <th>Label</th>
                                    <th>TokenGuid</th>
                                    <th>Building</th>
                                    <th>Area</th>
                                    <th>Room</th>
                                    <th>Status</th>
                                    <th>Notify</th>
                                    <th>License</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($meters as $key => $value)
                                <tr>
                                    <td>{{ $value->SensorID }}</td>
                                    <td>{{ $value->Label }}</td>
                                    <td>{{ $value->TokenGuid }}</td>
                                    <td>{{ $value->building }}</td>
                                    <td>{{ $value->area }}</td>
                                    <td>{{ $value->room }}</td>
                                    <td>{{ $value->Status }}</td>
                                    <td>{{ $value->Notify }}</td>
                                    <td>{{ $value->active_license }}</td>
                                    <td>
                                        <a href="{{ url('/backend/power/meter/'.$value->SensorID.'/edit') }}" class="btn btn-xs btn-info float-left">Edit</a>
                                        <a href="javascript:;" class="btn btn-xs btn-danger float-left ml-1" onclick="meterDelete({{$value->SensorID}})">Delete</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- end row -->
    </div>
    <!-- end col-12 -->
</div>
<!-- end row -->

<svg width="0" height="0" version="1.1" class="gradient-mask" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="gradientGauge">
            <stop class="color-red" offset="0%" />
            <stop class="color-yellow" offset="17%" />
            <stop class="color-green" offset="40%" />
            <stop class="color-yellow" offset="87%" />
            <stop class="color-red" offset="100%" />
        </linearGradient>
    </defs>
</svg>

<script type="text/javascript">
    var IoTData = @JSON($chart_data);
    var hourly_usage = @JSON($hourly_usages);

    var MeterDashboard = function() {
        "use strict";
        return {
            init: function() {}
        };
    }();

    $(document).ready(function() {
        MeterDashboard.init();

        $('.select-meter').click(function() {
            $('#recently-report-' + $(this).data('id')).submit();
        });
    });




    meterDelete = (id) => {

        swal({
            title: 'Alert',
            text: 'Are you sure that you want to delete this meter?',
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
                    className: 'btn btn-warning',
                    closeModal: true
                }
            }
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    method: 'get',
                    url: id + '/delete',
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success('The data was deleted successfully.');
                            setTimeout(() => {
                                window.location.reload()
                            }, 2000);
                        } else {
                            toastr.error('The data delete fail.');
                        }
                    }
                })

            }
        })
    }
</script>

@endsection