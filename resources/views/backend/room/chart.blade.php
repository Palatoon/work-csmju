@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<!-- begin row -->
<div class="row">
    <div class="col-lg-3">
        <div class="row">
            <div class="col-md-12">
                <div id="reportrange" class="mb-3" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>
            <div class="col-md-6">
                <div class="widget widget-stats bg-success">
                    <div class="stats-icon"><i class="fas fa-paw"></i></div>
                    <div class="stats-info">
                        <h4>Animals</h4>
                        <p>45</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="widget widget-stats bg-indigo">
                    <div class="stats-icon"><i class="fa-solid fa-cube"></i></div>
                    <div class="stats-info">
                        <h4>Device</h4>
                        <p>22</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="widget widget-stats bg-info">
                    <div class="stats-icon"><i class="fa-solid fa-water"></i></div>
                    <div class="stats-info">
                        <h4>Water</h4>
                        <p>60%</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="widget widget-stats bg-warning">
                    <div class="stats-icon"><i class='fa-solid fa-mask-face'></i></div>
                    <div class="stats-info">
                        <h4>AQI (PM<sub>2.5</sub>)</h4>
                        <p>60</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card border-0 text-truncate mb-3 ">
                    <!-- begin card-body -->
                    <div class="card-body">
                        <!-- begin title -->
                        <div class="mb-3  f-s-13">
                            <b class="mb-3"><i class="fas fa-temperature-high mr-2"></i>Temperature</b>
                            <span class="ml-2 text-muted"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Conversion Rate" data-placement="top" data-content="Percentage of sessions that resulted in orders from total number of sessions." data-original-title="" title=""></i></span>
                        </div>
                        <!-- end title -->
                        <!-- begin conversion-rate -->
                        <div class="d-flex align-items-center mb-1">
                            <h2 class="mb-0"><span data-animation="number" data-value="25.0">0.00</span>°C</h2>
                            <div class="ml-auto">
                                <div id="conversion-rate-sparkline"></div>
                            </div>
                        </div>
                        <!-- end conversion-rate -->
                        <!-- begin percentage -->
                        <div class="mb-3">
                            <i class="fa fa-caret-down"></i> <span data-animation="number" data-value="0.50">0.00</span>% compare to last week
                        </div>
                        <!-- end percentage -->
                        <!-- begin info-row -->
                        <div class="d-flex mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                Max
                            </div>
                            <div class="d-flex align-items-center ml-auto">
                                <div class="f-s-12"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="262">0</span>%</div>
                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="37.9">0.00</span>°C</div>
                            </div>
                        </div>
                        <!-- end info-row -->
                        <!-- begin info-row -->
                        <div class="d-flex mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                Average
                            </div>
                            <div class="d-flex align-items-center ml-auto">
                                <div class="f-s-12"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="11">0</span>%</div>
                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="27.5">0.00</span>°C</div>
                            </div>
                        </div>
                        <!-- end info-row -->
                        <!-- begin info-row -->
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                                Min
                            </div>
                            <div class="d-flex align-items-center ml-auto">
                                <div class="f-s-12"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="57">0</span>%</div>
                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="21.9">0.00</span>°C</div>
                            </div>
                        </div>
                        <!-- end info-row -->
                    </div>
                    <!-- end card-body -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="card border-0 text-truncate mb-3 ">
                    <!-- begin card-body -->
                    <div class="card-body">
                        <!-- begin title -->
                        <div class="mb-3  f-s-13">
                            <b class="mb-3"><i class="fas fa-water mr-2"></i>Humidity</b>
                            <span class="ml-2 text-muted"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Conversion Rate" data-placement="top" data-content="Percentage of sessions that resulted in orders from total number of sessions." data-original-title="" title=""></i></span>
                        </div>
                        <!-- end title -->
                        <!-- begin conversion-rate -->
                        <div class="d-flex align-items-center mb-1">
                            <h2 class="mb-0"><span data-animation="number" data-value="60.1">0.00</span>%</h2>
                            <div class="ml-auto">
                                <div id="conversion-rate-sparkline"></div>
                            </div>
                        </div>
                        <!-- end conversion-rate -->
                        <!-- begin percentage -->
                        <div class="mb-3">
                            <i class="fa fa-caret-down"></i> <span data-animation="number" data-value="0.50">0.00</span>% compare to last week
                        </div>
                        <!-- end percentage -->
                        <!-- begin info-row -->
                        <div class="d-flex mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                Max
                            </div>
                            <div class="d-flex align-items-center ml-auto">
                                <div class="f-s-12"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="262">0</span>%</div>
                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="77.1">0.00</span>%</div>
                            </div>
                        </div>
                        <!-- end info-row -->
                        <!-- begin info-row -->
                        <div class="d-flex mb-2">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                Average
                            </div>
                            <div class="d-flex align-items-center ml-auto">
                                <div class="f-s-12"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="11">0</span>%</div>
                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="62.3">0.00</span>%</div>
                            </div>
                        </div>
                        <!-- end info-row -->
                        <!-- begin info-row -->
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                                Min
                            </div>
                            <div class="d-flex align-items-center ml-auto">
                                <div class="f-s-12"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="57">0</span>%</div>
                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="57.6">0.00</span>%</div>
                            </div>
                        </div>
                        <!-- end info-row -->
                    </div>
                    <!-- end card-body -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-2">
                    <div class="card-body">
                        <div id="apex-line-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-2">
                    <div class="card-body">
                        <div id="apex-line-chart-hum"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-2">
                    <div class="card-body">
                        <div id="apex-line-chart-pm"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-2">
                    <div class="card-body">
                        <div id="apex-column-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const randomArrayInRange = (min, max, n) => Array.from({
        length: n
    }, () => Math.floor(Math.random() * (max - min + 1)) + min);

    // Example
    var arr_hum_min = randomArrayInRange(50, 59, 7);
    var arr_hum_max = randomArrayInRange(61, 72, 7);
    var arr_pm_min = randomArrayInRange(30, 50, 7);
    var arr_pm_max = randomArrayInRange(70, 120, 7);

    $('#apex-line-chart').empty();
    var options = {
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        title: {
            text: 'Average High & Low Temperature',
            align: 'center'
        },
        colors: ['blue', 'green'],
        dataLabels: {
            enabled: true,
            background: {
                borderWidth: 0
            },
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        series: [{
            name: 'High - 2022',
            data: [28, 29, 33, 36, 32, 32, 33]
        }, {
            name: 'Low - 2022',
            data: [12, 11, 14, 18, 17, 13, 13]
        }],
        // grid: {
        //     row: {
        //         colors: ['red', 'green'], // takes an array which will be repeated on columns
        //         opacity: 0.5
        //     },
        // },
        markers: {
            size: 4
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
        },
        yaxis: {
            min: 5,
            max: 40
        },
        legend: {
            show: true,
            position: 'top',
            offsetY: -10,
            horizontalAlign: 'right',
            floating: true,
        }
    };

    var chart = new ApexCharts(
        document.querySelector('#apex-line-chart'),
        options
    );

    chart.render();

    $('#apex-line-chart-hum').empty();
    var options = {
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        title: {
            text: 'Average High & Low Humidity',
            align: 'center'
        },
        colors: ['blue', 'green'],
        dataLabels: {
            enabled: true,
            background: {
                borderWidth: 0
            },
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        series: [{
            name: 'High - 2022',
            data: arr_hum_min
        }, {
            name: 'Low - 2022',
            data: arr_hum_max
        }],
        markers: {
            size: 4
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
        },
        legend: {
            show: true,
            position: 'top',
            offsetY: -10,
            horizontalAlign: 'right',
            floating: true,
        }
    };

    var chart = new ApexCharts(
        document.querySelector('#apex-line-chart-hum'),
        options
    );

    chart.render();

    $('#apex-line-chart-pm').empty();
    var options = {
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        title: {
            text: 'Average High & Low Particulate Matter 2.5',
            align: 'center'
        },
        colors: ['blue', 'green'],
        dataLabels: {
            enabled: true,
            background: {
                borderWidth: 0
            },
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        series: [{
            name: 'High - 2022',
            data: arr_pm_min
        }, {
            name: 'Low - 2022',
            data: arr_pm_max
        }],
        markers: {
            size: 4
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
        },
        legend: {
            show: true,
            position: 'top',
            offsetY: -10,
            horizontalAlign: 'right',
            floating: true,
        }
    };

    var chart = new ApexCharts(
        document.querySelector('#apex-line-chart-pm'),
        options
    );

    chart.render();

    $('#apex-column-chart').empty();
    var options = {
        chart: {
            height: 350,
            type: 'bar'
        },
        title: {
            text: 'Water Consumption',
            align: 'center'
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['#49b6d6']
        },
        colors: ['#49b6d6'],
        series: [{
            name: 'Water',
            data: [44, 55, 57, 56, 61, 58, 63]
        }], 
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
        },
        yaxis: {
            title: {
                text: '$ (ml)'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " ml"
                }
            }
        }
    };

    var chart = new ApexCharts(
        document.querySelector('#apex-column-chart'),
        options
    );

    chart.render();

    $('#apex-bar-chart').empty();
    var options = {
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                horizontal: true,
                dataLabels: {
                    position: 'top',
                },
            }
        },
        dataLabels: {
            enabled: true,
            offsetX: -6
        },
        colors: ['orange', 'red'],
        stroke: {
            show: true,
            width: 1,
            colors: ['pink']
        },
        series: [{
            data: [44, 55, 41, 64, 22, 43, 21]
        }, {
            data: [53, 32, 33, 52, 13, 44, 32]
        }],
        xaxis: {
            categories: [2013, 2014, 2015, 2016, 2017, 2018, 2019]
        }
    };

    var chart = new ApexCharts(
        document.querySelector('#apex-bar-chart'),
        options
    );

    chart.render();

    var options = {
        chart: {
            type: 'line',
            width: 160,
            height: 28,
            sparkline: {
                enabled: true
            }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        fill: {
            type: 'gradient',
            gradient: {
                opacityFrom: 1,
                opacityTo: 1,
                colorStops: [{
                        offset: 0,
                        color: 'red',
                        opacity: 1
                    },
                    {
                        offset: 50,
                        color: 'orange',
                        opacity: 1
                    },
                    {
                        offset: 100,
                        color: 'lime',
                        opacity: 1
                    }
                ]
            },
        },
        series: [{
            data: [2.68, 2.93, 2.04, 1.61, 1.88, 1.62, 2.80]
        }],
        labels: ['Jun 23', 'Jun 24', 'Jun 25', 'Jun 26', 'Jun 27', 'Jun 28', 'Jun 29'],
        xaxis: {
            crosshairs: {
                width: 1
            },
        },
        tooltip: {
            theme: 'dark',
            fixed: {
                enabled: false
            },
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function(seriesName) {
                        return ''
                    }
                },
                formatter: (value) => {
                    return value + '%'
                },
            },
            marker: {
                show: false
            }
        },
        responsive: [{
            breakpoint: 1500,
            options: {
                chart: {
                    width: 120
                }
            }
        }, {
            breakpoint: 1300,
            options: {
                chart: {
                    width: 100
                }
            }
        }, {
            breakpoint: 1200,
            options: {
                chart: {
                    width: 160
                }
            }
        }, {
            breakpoint: 900,
            options: {
                chart: {
                    width: 120
                }
            }
        }, {
            breakpoint: 576,
            options: {
                chart: {
                    width: 180
                }
            }
        }, {
            breakpoint: 400,
            options: {
                chart: {
                    width: 120
                }
            }
        }]
    }
    if ($('#conversion-rate-sparkline').length !== 0) {
        new ApexCharts(document.querySelector("#conversion-rate-sparkline"), options).render();
    }

    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>
@endpush