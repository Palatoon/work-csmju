@extends('layouts.backend')
@section('content')
<style>
    .apexcharts-gridline:nth-child(2) {
        stroke-dasharray: 10;
    }
</style>
<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->
<!-- begin row -->
<div class="row">
    <div class="col-xl-12">
        <button class="btn btn-info mb-3" id="btn-add-chart"><i class="fa fa-plus mr-2"></i>Add Chart</button>
    </div>
    @foreach($chart as $item)
    <!-- begin col-10 -->
    <div class="col-xl-6">
        <!-- begin panel -->
        <div class="panel panel-default">
            {{--<div class="panel-heading text-success">{{ $item->name }}
        </div>--}}
        <div class="panel-body">
            <div id="chart-item-{{$item->id}}" class="chart-item" data-name="{{ $item->name }}" data-type_id="{{ $item->chart_type_id }}" data-id="{{ $item->id }}">

            </div>
        </div>
    </div>
    <!-- end panel -->
</div>
<!-- end col-10 -->
@endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="addChartModal" tabindex="-1" role="dialog" aria-labelledby="addChartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addChartModalLabel">Add Chart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-add-chart" method="post" action="{{ route('report.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" name="chart_type_id">
                                    @foreach($chart_types as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-info" id="btn-add-chart-device"><i class="fa fa-plus mr-2"></i>Add Device</button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Device {1}</label>
                                        <select class="form-control selectpicker select-device" id="select-device-1" data-no="1" name="device_id[]" data-live-search="true">
                                            <option value="">Select</option>
                                            @foreach($devices as $item)
                                            <option value="{{ $item->id }}" data-id="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Datacode</label>
                                        <select class="form-control select-datatcode" id="select-datacode-1" name="datacode_id[]">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="device-lists">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-store-chart">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script id="tmpl-add-device" type="text/x-jquery-tmpl">
    <div class="col-md-6">
        <div class="form-group">
            <label>Device {${count}}</label>
            <select class="form-control select-device" id="select-device-${count}" data-no="${count}" name="device_id[]" data-live-search="true">
                <option value="">Select</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Datacode</label>
            <select class="form-control select-datatcode" id="select-datacode-${count}" name="datacode_id[]">
                <option value="">Select</option>
            </select>
        </div>
    </div>
</script>
<!-- end row -->
@endsection


@push('scripts')
<script>
    var count = 2;
    $(document).ready(function() {
        renderDatacode(1);

        $('#btn-add-chart-device').click(function() {
            var obj = {
                count: count
            }
            $("#tmpl-add-device").tmpl(obj).appendTo("#device-lists");

            $.ajax({
                url: "{{ route('device.getDevice') }}",
                type: "post",
                data: {
                    '_token': $('#global_csrf').val(),
                }
            }).done(function(response) {
                //console.log(count);
                if (Object.keys(response).length > 0) {
                    $('#select-device-' + count).find('option').remove();
                    $('#select-device-' + count).append($('<option>', {
                        value: "",
                        text: "Select"
                    }));
                    $.each(response, function(i, item) {
                        $('#select-device-' + count).append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });

                    renderDatacode(count);
                    count++;
                }
            });
        });

        $('#btn-add-chart').click(function() {
            $('#addChartModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        $('#btn-store-chart').click(function(ev) {
            ev.preventDefault();
            if ($('#form-add-chart').valid()) {
                swal({
                    title: swal_lang.alert,
                    text: 'Are you sure that you want to create this chart?',
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
                            text: swal_lang.confirm,
                            value: true,
                            visible: true,
                            className: 'btn btn-warning',
                            closeModal: true
                        }
                    }
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $('#form-add-chart').submit();
                    }
                });
            }
        });

        $('#form-add-chart').validate({
            submitHandler: function(form) {
                form.submit();
            },
            ignore: [],
            rules: {
                name: {
                    required: true,
                },
                "device_id[]": {
                    required: true,
                },
                "datacode_id[]": {
                    required: true,
                }
            }
        });

        $('.chart-item').each(function(i, obj) {
            var id = $(this).data('id');
            var type_id = $(this).data('type_id');
            var name = $(this).data('name');
            var color = [];
            $.ajax({
                url: "{{ route('report.getChartData') }}",
                type: "post",
                data: {
                    '_token': $('#global_csrf').val(),
                    'id': id
                }
            }).done(function(response) {
                //console.log(response);
                switch (type_id) {
                    case 1:
                        CreateLineChart("#chart-item-" + id, name, response.series, response.label, response.data, response.color, response.condition)
                        break;
                    case 2:
                        CreateBarChart("#chart-item-" + id, name, response.series, response.label, response.data, response.color, response.condition);
                        break;
                    case 3:
                        CreatePieChart("#chart-item-" + id, name, response.series, response.label, response.data, response.color, response.condition);
                        break;
                }
            });
            //console.log(id);
        });
    });

    function renderDatacode(id) {
        $('#select-device-' + id).on('change', function(ev) {
            ev.stopImmediatePropagation()
            var id = $(this).find(":selected").val();
            var no = $(this).data('no');
            $('#select-device-' + no).val(id);
            $('#select-device-' + count).selectpicker('refresh');
            //console.log($('#select-device-' + no).val());
            $.ajax({
                url: "{{ route('device.getDatacode') }}",
                type: "post",
                data: {
                    '_token': $('#global_csrf').val(),
                    'device_id': id,
                }
            }).done(function(response) {
                //console.log(response);
                $('#select-datacode-' + no).find('option').remove();
                $.each(response, function(i, item) {
                    $('#select-datacode-' + no).append($('<option>', {
                        value: item.datacode_id,
                        text: item.label
                    }));
                });
                $('#select-datacode-' + no).rules("add ", "required ");
                $(".select-datatcode").each(function() {
                    $(this).rules('add', {
                        required: true
                    });
                });
            });
        });
    }

    function CreatePieChart(id, name, series, label, data, color, condition) {

        var options = {
            title: {
                text: name,
            },
            series: data,
            colors: color,
            chart: {
                //width: $(id).width() * 0.9,
                height: 350,
                type: 'pie',
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0,
                    tools: {
                        download: true
                    }
                }
            },
            labels: label,
            // legend: {
            //     horizontalAlign: "bottom",
            //     offsetX: 50
            // },
            legend: {
                horizontalAlign: "bottom",
                position: 'bottom',
                offsetX: 40
            }
        };
        var chart = new ApexCharts(document.querySelector(id), options);
        chart.render();
        return chart;
    }

    function CreateBarChart(id, name, series, label, data, color, condition) {
        var series_arr = [];
        $.each(series, function(i, item) {
            series_arr.push({
                name: item,
                data: data[i]
            })
        });

        var options = {
            title: {
                text: name,
            },
            series: series_arr,
            colors: color,
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    // endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: label[0],
            },
            // yaxis: {
            //     title: {
            //         text: '$ (thousands)'
            //     }
            // },
            // fill: {
            //     opacity: 1
            // },
            // tooltip: {
            //     y: {
            //         formatter: function(val) {
            //             return "$ " + val + " thousands"
            //         }
            //     }
            // }
            legend: {
                horizontalAlign: "bottom",
                offsetX: 40
            }
        };
        var chart = new ApexCharts(document.querySelector(id), options);
        chart.render();
        return chart;
    }

    function CreateLineChart(id, name, series, label, data, color, condition) {
        var series_arr = [];
        var condition_arr = [];
        $.each(series, function(i, item) {
            series_arr.push({
                name: item,
                data: data[i]
            })
        });

        $.each(condition, function(i, item) {
            $.each(item, function(i2, item2) {
                condition_arr.push({
                    y: item2.value,
                    borderColor: '#ff0000',
                    label: {
                        borderColor: '#ff0000',
                        style: {
                            color: '#fff',
                            background: '#ff0000'
                        },
                        text: item2.label + ' ' + item2.condition + ' ' + item2.value
                    }
                });
            });
        });

        var options = {
            title: {
                text: name,
            },
            series: series_arr,
            colors: color,
            chart: {
                height: 350,
                type: "line",
                show: true,
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0,
                    tools: {
                        download: true,
                    },
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: "20%"
                }
            },
            xaxis: {
                categories: label[1]
            },
            legend: {
                horizontalAlign: "bottom",
                offsetX: 40
            },
            grid: {
                show: true,
                borderColor: '#ddd',
                strokeDashArray: 0,
                position: 'back',
                row: {
                    colors: undefined,
                    opacity: 0.5
                },
                column: {
                    colors: undefined,
                    opacity: 0.5
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            annotations: {
                yaxis: condition_arr
            }
        };
        var chart = new ApexCharts(document.querySelector(id), options);
        chart.render();
        return chart;
    }
</script>
@endpush('scripts')