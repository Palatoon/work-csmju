@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<!-- begin daterange-filter -->
<div class="d-sm-flex align-items-center mb-4 row">
    <label class="col-md-1 col-form-label">Meter</label>
    <div class="col-md-5">
        <form method="post" id='ddfilter' enctype="multipart/form-data" action="{{ action('Backend\HistoricalController@week') }}">
            @csrf
            <select class="multiple-select2 form-control" name="sltSenSor" id="sltSenSor">
                <!-- multiple="multiple">-->
                <option value="" disabled selected>Select your option</option>
                @if(isset($sensor))
                @foreach($sslist as $key => $value)
                <option value="{{ $value->SensorID }}">{{ $value->Label }}</option>
                @endforeach
                @endif
            </select>
        </form>
    </div>
</div>
<!-- end daterange-filter -->

<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-xl-12">
        <!-- begin card -->
        <div class="card bg-dark border-0 mb-3">
            <div class="card-body text-white">
                <div class="mb-3 text-grey"><b>ELECTRICITY USED</b> <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Top products with units sold" data-placement="top" data-content="Products with the most individual units sold. Includes orders from all sales channels." data-original-title="" title=""></i></span></div>
                {{--<div class="row">
                    <div class="col-xl-3 col-4">
                        <h3 class="mb-1"><span data-animation="number" data-value="127.1">0</span> V</h3>
                        <div>Jul 7</div>
                        <div class="text-grey f-s-11 text-truncate"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="25.5">0.00</span>% from previous 30 days</div>
                    </div>
                    <div class="col-xl-3 col-4">
                        <h3 class="mb-1"><span data-animation="number" data-value="179.9">0</span> A</h3>
                        <div>Jul 7</div>
                        <div class="text-grey f-s-11 text-truncate"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="5.33">0.00</span>% from previous 30 days</div>
                    </div>
                    <div class="col-xl-3 col-4">
                        <h3 class="mb-1"><span data-animation="number" data-value="766.8">0</span> kWHr</h3>
                        <div>Jul 7</div>
                        <div class="text-grey f-s-11 text-truncate"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="0.323">0.00</span>% from previous 30 days</div>
                    </div>
                </div>--}}
            </div>
            <div class="card-body p-20">
                <div id="apex-area-chart"></div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col-12 -->
</div>
<!-- end row -->
@endsection
@section('script')
<script src="{{ asset('plugins/apexcharts/dist/apexcharts.min.js') }}"></script>
<script type="text/javascript">
    $('#sltSenSor').val('{{$filter}}');
    var IoTData = @JSON($sensor);

    var t = [];
    var time = [];
    var v1 = [];
    var v2 = [];
    var v3 = [];
    var I1 = [];
    var I2 = [];
    var I3 = [];
    var P1 = [];
    var P2 = [];
    var P3 = [];
    var U = [];
    if (IoTData) {
        if (IoTData.length < 80) {
            for (var i = IoTData.length; i <= 80; i += 10) {
                v1.push(0);
                v2.push(0);
                v3.push(0);
                I1.push(0);
                I2.push(0);
                I3.push(0);
                P1.push(0);
                P2.push(0);
                P3.push(0);
                U.push(0);
                time.push("--/--");
            }
        }
        for (var i = 0; i < IoTData.length; i++) {
            switch (IoTData[i].DataCode) {
                case "ELECV1":
                    v1.push(IoTData[i].Value);
                    break;
                case "ELECV2":
                    v2.push(IoTData[i].Value);
                    break;
                case "ELECV3":
                    v3.push(IoTData[i].Value);
                    break;
                case "ELECI1":
                    I1.push(IoTData[i].Value);
                    break;
                case "ELECI2":
                    I2.push(IoTData[i].Value);
                    break;
                case "ELECI3":
                    I3.push(IoTData[i].Value);
                    break;
                case "ELECP1":
                    P1.push(IoTData[i].Value);
                    break;
                case "ELECP2":
                    P2.push(IoTData[i].Value);
                    break;
                case "ELECP3":
                    P3.push(IoTData[i].Value);
                    break;
                case "ELECU":
                    U.push(IoTData[i].Value);
                    var d2 = new Date(IoTData[i].Timestamp);
                    d2 = d2.setDate(d2.getDate() - 6);
                    time.push(moment(new Date(d2)).format("DD/MM") + " - " + moment(new Date(IoTData[i].Timestamp)).format("DD/MM"));
                    break;
                default:
                    ;
                    break;
            }
        }
    }
    console.log(v1);
    var handleAreaChart = function() {
        "use strict";

        var handleGetDate = function(minusDate) {
            /*var d = new Date();
            d = d.setDate(d.getDate() - minusDate);
            console.log(d);
            return d;*/
        };
        var options = {
            chart: {
                height: 400,
                type: 'area',
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0,
                    tools: {
                        download: true,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true,
                        customIcons: []
                    },
                    autoSelected: 'zoom'
                },
                events: {
                    legendClick: function(chartContext, seriesIndex, config) {
                        var serie = config['config']['series'];
                        var showY = config['config']['yaxis'];
                        console.log(serie[0]['data'].length);
                        console.log(serie[1]['data'].length);
                        console.log(serie[2]['data'].length);
                        switch (seriesIndex) {
                            case 0:
                                if (serie[0]['data'].length > 0 && serie[1]['data'].length > 0 && serie[2]['data'].length > 0) {
                                    showY[1].show = true;
                                } else if (serie[0]['data'].length > 0 && serie[1]['data'].length > 0 && serie[2]['data'].length == 0) {
                                    showY[1].show = true;
                                } else if (serie[0]['data'].length > 0 && serie[1]['data'].length == 0 && serie[2]['data'].length > 0) {
                                    showY[2].show = true;
                                } else if (serie[0]['data'].length == 0) {
                                    showY[1].show = false;
                                    showY[2].show = false;
                                } else {};
                                break;
                            case 1:
                                if (serie[0]['data'].length == 0 && serie[1]['data'].length == 0 && serie[2]['data'].length == 0) {
                                    showY[1].show = true;
                                } else if (serie[0]['data'].length == 0 && serie[1]['data'].length > 0 && serie[2]['data'].length > 0) {
                                    showY[2].show = true;
                                } else if (serie[0]['data'].length == 0 && serie[1]['data'].length == 0 && serie[2]['data'].length > 0) {
                                    showY[1].show = true;
                                    showY[2].show = false;
                                } else {};
                                break;
                            case 2:
                                if (serie[0]['data'].length == 0 && serie[1]['data'].length == 0 && serie[2]['data'].length == 0) {
                                    showY[2].show = true;
                                } else {};
                                break;
                            case 3:
                                if (serie[3]['data'].length > 0 && serie[4]['data'].length > 0 && serie[5]['data'].length > 0) {
                                    showY[4].show = true;
                                    //console.log("aasdasdadsadasd");
                                } else if (serie[3]['data'].length > 0 && serie[4]['data'].length > 0 && serie[5]['data'].length == 0) {
                                    showY[4].show = true;
                                } else if (serie[3]['data'].length > 0 && serie[4]['data'].length == 0 && serie[5]['data'].length > 0) {
                                    showY[5].show = true;
                                } else if (serie[3]['data'].length == 0) {
                                    showY[4].show = false;
                                    showY[5].show = false;
                                } else {};
                                break;
                            case 4:
                                if (serie[3]['data'].length == 0 && serie[4]['data'].length == 0 && serie[5]['data'].length == 0) {
                                    showY[4].show = true;
                                } else if (serie[3]['data'].length == 0 && serie[4]['data'].length > 0 && serie[5]['data'].length > 0) {
                                    showY[5].show = true;
                                } else if (serie[3]['data'].length == 0 && serie[4]['data'].length == 0 && serie[5]['data'].length > 0) {
                                    showY[4].show = true;
                                    showY[5].show = false;
                                } else {};
                                break;
                            case 5:
                                if (serie[3]['data'].length == 0 && serie[4]['data'].length == 0 && serie[5]['data'].length == 0) {
                                    showY[5].show = true;
                                } else {};
                                break;
                            case 6:
                                if (serie[6]['data'].length > 0 && serie[7]['data'].length > 0 && serie[8]['data'].length > 0) {
                                    showY[7].show = true;
                                } else if (serie[6]['data'].length > 0 && serie[7]['data'].length > 0 && serie[8]['data'].length == 0) {
                                    showY[7].show = true;
                                } else if (serie[6]['data'].length > 0 && serie[7]['data'].length == 0 && serie[8]['data'].length > 0) {
                                    showY[8].show = true;
                                } else if (serie[6]['data'].length == 0) {
                                    showY[7].show = false;
                                    showY[8].show = false;
                                } else {};
                                break;
                            case 7:
                                if (serie[6]['data'].length == 0 && serie[7]['data'].length == 0 && serie[8]['data'].length == 0) {
                                    showY[7].show = true;
                                } else if (serie[6]['data'].length == 0 && serie[7]['data'].length > 0 && serie[8]['data'].length > 0) {
                                    showY[8].show = true;
                                } else if (serie[6]['data'].length == 0 && serie[7]['data'].length == 0 && serie[8]['data'].length > 0) {
                                    showY[7].show = true;
                                    showY[8].show = false;
                                } else {};
                                break;
                            case 8:
                                if (serie[6]['data'].length == 0 && serie[7]['data'].length == 0 && serie[8]['data'].length == 0) {
                                    showY[8].show = true;
                                } else {};
                                break;
                            case 9:
                                ;
                            default:
                                ;
                                break;
                        }



                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: [COLOR_RED, COLOR_PINK, COLOR_ORANGE, COLOR_GREEN_LIGHTER, COLOR_LIME, COLOR_AQUA_LIGHTER, COLOR_TEAL, COLOR_MUTED_DARKER, COLOR_WHITE, COLOR_YELLOW_LIGHTER],
            series: [{
                name: 'Volt1',
                data: v1,
            }, {
                name: 'Volt2',
                data: v2,
            }, {
                name: 'Volt3',
                data: v3,
            }, {
                name: 'Current1',
                data: I1,
            }, {
                name: 'Current2',
                data: I2,
            }, {
                name: 'Current3',
                data: I3,
            }, {
                name: 'Power1',
                data: P1,
            }, {
                name: 'Power2',
                data: P2,
            }, {
                name: 'Power3',
                data: P3,
            }, {
                name: 'Unit',
                data: U,
            }],
            legend: {
                position: 'top',
                labels: {
                    colors: COLOR_WHITE,
                },
            },
            xaxis: {
                type: 'category',
                categories: time,

                labels: {
                    style: {
                        colors: COLOR_WHITE,
                    }
                },
                axisBorder: {
                    show: true,
                    color: COLOR_WHITE,
                    height: 1,
                    width: '100%',
                    offsetX: 0,
                    offsetY: -1
                },
                axisTicks: {
                    show: true,
                    borderType: 'solid',
                    color: COLOR_WHITE,
                    height: 6,
                    offsetX: 0,
                    offsetY: 0
                }
            },
            yaxis: [{
                    seriesName: 'V1',
                    show: true,
                    max: 320,
                    title: {
                        text: "Volt",
                        show: true,
                        style: {
                            color: COLOR_RED,
                        }
                    },
                    axisBorder: {
                        show: true,
                        color: COLOR_RED
                    },
                    labels: {
                        show: true,
                        style: {
                            color: COLOR_RED,
                        }
                    }
                },
                {
                    seriesName: 'V1',
                    show: false,
                    max: 320
                },
                {
                    seriesName: 'V1',
                    show: false,
                    max: 320
                },
                {
                    seriesName: 'Current',
                    show: true,
                    max: 50,
                    title: {
                        text: "Current",
                        show: true,
                        style: {
                            color: COLOR_LIME,
                        }
                    },
                    axisBorder: {
                        show: true,
                        color: COLOR_LIME,
                    },
                    labels: {
                        show: true,
                        style: {
                            color: COLOR_LIME,
                        }
                    }
                },
                {
                    seriesName: 'Current',
                    show: false,
                    max: 50
                },
                {
                    seriesName: 'Current',
                    show: false,
                    max: 50
                }, {
                    seriesName: 'Power',
                    show: true,
                    max: 15,
                    title: {
                        text: "Power",
                        show: true,
                        style: {
                            color: COLOR_BLUE_LIGHTER,
                        }
                    },
                    axisBorder: {
                        show: true,
                        color: COLOR_BLUE_LIGHTER,
                    },
                    labels: {
                        show: true,
                        style: {
                            color: COLOR_BLUE_LIGHTER,
                        }
                    }
                },
                {
                    seriesName: 'Power',
                    show: false,
                    max: 15
                },
                {
                    seriesName: 'Power',
                    show: false,
                    max: 15
                },
                {
                    seriesName: 'Unit',
                    showAlways: true,
                    opposite: true,
                    title: {
                        text: 'Unit',
                        show: true,
                        style: {
                            color: COLOR_YELLOW_LIGHTER,
                        }
                    },
                    axisBorder: {
                        show: true,
                        color: COLOR_YELLOW_LIGHTER,
                    },
                    labels: {
                        show: true,
                        style: {
                            color: COLOR_YELLOW_LIGHTER,
                        }
                    }
                }
            ]
        };

        var chart = new ApexCharts(
            document.querySelector('#apex-area-chart'),
            options
        );

        chart.render();
    };
    var handleSelect2 = function() {
        $(".default-select2").select2();
        $(".multiple-select2").select2({
            placeholder: "Select a state"
        });

    };
    $(".multiple-select2").change(function() {
        console.log($(this).val());
        $("#ddfilter").submit();

    });
    var DashboardV3 = function() {
        "use strict";
        return {
            //main function
            init: function() {
                handleAreaChart();
                handleSelect2();
            }
        };
    }();

    $(document).ready(function() {
        DashboardV3.init();
    });
</script>
@endsection