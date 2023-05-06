@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<!-- begin row -->
<div class="row">
    <div class="col-xl-2">
        <div class="panel panel-inverse" data-sortable-id="index-2">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">List</h4>
                <span class="badge bg-teal">{{ count($devices) }} devices</span>
            </div>
            <div class="panel-body bg-light" data-scrollbar="true" data-height="80vh" style="height: 80vh;">
                @foreach($devices as $item)
                @if($item->visible == true)
                <p><a href="javascript:;" class="btn btn-dark btn-sm btn-rounded btn-icon" onclick="$().btn_condition_item('datacode', '{{$item->id}}', '{{$item->name}}');"><i class="fas fa-diagram-project"></i></a> {{ $item->name }}</p>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-xl-10">
        <p>
            <!-- <a href="{{ route('house.booking', ['id' => $room->id ]) }}" class="btn btn-xs btn-info mr-2"><i class="fa fa-book mr-2"></i>Booking</a> -->
            @if(Auth::user()->roles->first()->slug == "super-admin")
            <a href="#" class="btn btn-xs btn-default visible-divice-btn"><i class="fas fa-list mr-2"></i>Device</a>
            <a href="#" class="btn btn-xs btn-warning enable-dragable"><i class="fas fa-hand-paper mr-2"></i>Move</a>
            @endif
        </p>
        <div class="card mb-3 bg-dark-darker">
            <div class="card-body p-0 plan-area" data-id="{{$room->id}}" data-model="room" @if(Storage::disk('local')->exists($room->floor_plan_image)) style="background-image: url({{ Storage::disk('local')->url($room->floor_plan_image) }});background-size:contain;" @else style="background-image: url({{ asset('img/house.png') }});background-size:contain;" @endif>
                @foreach($devices as $item)
                @if($item->visible == true)
                <div class="dragable border border-success rounded-circle item-on-off" id="dragable-device-{{$item->id}}" style="top:{{$item->x ?? 5}}%;left:{{$item->y ?? 5}}%;width:5vw;height:5vw;" data-model="room" data-item-id="{{$item->id}}" data-item-type="device">
                    <div id="dragable-header" class="p-5 dragable-device-{{$item->id}}-header" style="top:{{$item->x ?? 5}}%;left:{{$item->y ?? 5}}%;">
                        <!-- <span>{{ $item->name }}</span><br /> -->
                        <div class="device-{{$item->id}}-value" style="font-size:2.5rem;">
                        </div>
                        @if(!is_null($item->icon))
                        @if(Auth::user()->roles->first()->slug == "super-admin")
                        <div class="mt-2 device--icon device-{{$item->id}}-icon @if($item->display_status == 'hover') show-status @endif" data-id="{{ $item->id }}">
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

                @foreach($devices as $item)
                @if($item->visible == true)
                <div class="dragable @if($item->display_status == 'hover' || $item->display_status == 'hide') hide @endif" id="status-device-{{$item->id}}" style="background-color:rgba(0, 0, 0, 0.5);border-color:rgba(255, 255, 255, 0.3);border-radius:5px;color:white;top:{{$item->x ?? 5}}%;left:{{$item->y+5 ?? 5}}%;width:10vw;" data-model="room" data-item-id="{{$item->id}}" data-item-type="room">
                    <div class="text-left p-5" style="top:{{$item->x ?? 5}}%;left:{{$item->y ?? 5}}%;">
                        <p>{{ $item->name }}</p>
                        <p>Status: <span class="text-green">Running</span></p>
                        @if(isset($item->data))
                        @foreach($item->data as $data)
                        <p>{{$data->DataCode}}: {{$data->Value}}</p>
                        @endforeach
                        @endif
                    </div>
                </div>
                @endif
                @endforeach
                @if(Storage::disk('local')->exists($room->floor_plan_image))
                <img id="plan-image" src="{{ Storage::disk('local')->url($room->floor_plan_image) }}" width="100%" style="opacity:0;" />
                @else
                <img id="plan-image" src="{{ asset('img/house.png') }}" width="100%" style="opacity:0;" />
                @endif
            </div>
        </div>
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
                @foreach($devices as $item)
                <div class="col-md-6">{{$item->name}}</div>
                <div class="col-md-6 text-right">
                    <div class="switcher switcher-success">
                        <input type="checkbox" name="visible_device_{{$item->id}}" class="visible-device" data-id="{{$item->id}}" id="switcher_checkbox_{{$item->id}}" @if($item->visible == true) checked="true" @endif>
                        <label for="switcher_checkbox_{{$item->id}}"></label>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="conditionModal" tabindex="-1" role="dialog" aria-labelledby="conditionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addChartModalLabel">Config Condition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-add-condition" method="post" action="{{ route('device.storeCondition') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="input-device-id" name="device_id" value="">
                    <div class="form-group">
                        <label>Device</label>
                        <input type="text" class="form-control" id="input-device" placeholder="Device" readonly>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-info btn-xs" id="btn-add-device-condition"><i class="fa fa-plus mr-2"></i>Add Condition</button>
                    </div>
                    <div id="condition-lists">

                    </div>
                    <div id="datacode-lists">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-store-condition">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script id="tmpl-add-condition" type="text/x-jquery-tmpl">
    <div class="form-group">
        <label>Condition ${count}</label>
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" name="id[]" id="input-id-${count}">
                <select class="form-control input-datacode" id="select-datacode-${count}" name="datacode[]" required>

                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control input-condition" id="select-condition-${count}" name="condition[]" required>
                    <option value=">">{{ '>' }}</option>
                    <option value=">=">{{ '>=' }}</option>
                    <option value="<">{{ '<' }}</option>
                    <option value="<=">{{ '<=' }}</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="input-value-${count}" name="value[]" placeholder="Value" required>
            </div>
        </div>
    </div>
</script>
@endsection
@section('script')
<script>
    var floor_plan = @JSON($floor_plan);
    var count = 1;
    $.fn.btn_condition_item = function(model, id, code) {
        $("#condition-lists").html("");
        $("#datacode-lists").html("");
        $('#input-device-id').val(id);
        $('#input-device').val(code);
        $('#btn-add-device-condition').data('id', id);
        $.ajax({
            url: "{{ route('device.getCondition') }}",
            type: "post",
            data: {
                '_token': $('#global_csrf').val(),
                'id': id,
            }
        }).done(function(response) {
            //console.log(response);
            var c = 1;
            $.each(response, function(i, item) {
                item.count = c;
                $("#tmpl-add-condition").tmpl(item).appendTo("#condition-lists");
                $('#input-id-' + c).val(item.id);
                $('#select-datacode-' + c).append($('<option>', {
                    value: item.datacode_id,
                    text: item.label
                })).attr('readonly', true);
                $('#select-condition-' + c).val(item.condition);
                $('#input-value-' + c).val(item.value);
                c++;
            });
            count = c;

            $('#conditionModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
    };

    $('#btn-add-device-condition').click(function() {
        var id = $(this).data('id');
        var obj = {
            count: count
        }
        //alert(id);
        $("#tmpl-add-condition").tmpl(obj).appendTo("#datacode-lists");

        $.ajax({
            url: "{{ route('device.getDatacode') }}",
            type: "post",
            data: {
                '_token': $('#global_csrf').val(),
                'device_id': id
            }
        }).done(function(response) {
            //console.log(response);
            if (Object.keys(response).length > 0) {
                $('#select-datacode-' + count).find('option').remove();
                $.each(response, function(i, item) {
                    $('#select-datacode-' + count).append($('<option>', {
                        value: item.datacode_id,
                        text: item.label
                    }));
                });
                count++;
            }
        });
    });

    $('#form-add-condition').validate({
        rule: {
            condition: 'required',
            value: 'required',
        }
    })

    $('#btn-store-condition').click(function(ev) {
        ev.preventDefault();
        if ($('#form-add-condition').valid()) {
            swal({
                title: swal_lang.alert,
                text: 'Are you sure that you want to store this condition?',
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
                    $('#form-add-condition').submit();
                }
            });
        }
    });

    // $(window).resize(function() {
    //     location.reload();
    // });

    if (typeof $('.visible-divice-btn').length !== 'undefined') {
        $('.visible-divice-btn').click(function() {
            $('#visibleDeviceModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        $('.close-modal').click(function() {
            location.reload();
        });
    }

    if (typeof $('.show-status').length !== 'undefined') {
        $(".show-status").mouseenter(function() {
            var device = $(this);
            var device_id = device.data('id');
            $('#status-device-' + device_id).removeClass('hide');
        }).mouseleave(function() {
            var device = $(this);
            var device_id = device.data('id');
            $('#status-device-' + device_id).addClass('hide');
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

    // $.ajax({
    //     url: "/backend/device/getStatus",
    //     type: "post",
    //     data: {
    //         '_token': $('#global_csrf').val(),
    //         'id': '{{ $room->id }}',
    //         'model': "room"
    //     },
    //     beforeSend: function() {
    //         //$('.device--icon').html('<span class="mdi mdi-loading" style="font-size:2.5rem;"></span>');
    //     },
    //     success: function(response) {
    //         //console.log(response);
    //         $.each(response, function(key, val) {
    //             var color = '';
    //             if (val.icon_color != "null") {
    //                 color += 'color:' + val.icon_color + ';';
    //             }
    //             var icon = '<span class="mdi mdi-' + val.icon + '" style="font-size:2.8rem;' + color + '"></span>'
    //             // var status = '<span style="font-size:0.5vw;">' + val.status_value + '</span>';
    //             // <br /><i style="font-size:0.5vw;">' + val.status_time + '</i>';
    //             $('.device-' + val.id + '-icon').html(icon);
    //             //$('.device-' + val.id + '-status').html(status);
    //             if (val.status_value != "null") {
    //                 //alert(1);
    //                 var stt = '<span style="font-size:0.5vw;position:relative;top:-15px;">' + val.status_value + '</span>';
    //                 //<br /><i style="font-size:0.5vw;"></i> ' + val.status_time;
    //                 $('.device-' + val.id + '-status').html(stt);
    //             }
    //         });
    //     },
    //     error: function(jqXHR, textStatus, errorThrown) {
    //         //console.log(textStatus, errorThrown);
    //     }
    // });
</script>
@endsection