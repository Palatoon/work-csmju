@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-10 -->
    <div class="col-xl-12">
        <!-- begin panel -->
        <div class="panel">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title"><i class="fas fa-list mr-2"></i>Device Type</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <table class="table table-striped table-bordered table-td-valign-middle datatable">
                    <p align="right">
                        <a href="{{ route('device-type.create') }}" class="btn btn-xs btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
                    </p>
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Name (English)</th>
                            <!-- <th class="text-nowrap">Description</th> -->
                            <th class="text-nowrap">Data Code</th>
                            <th class="text-nowrap">Default Unit</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($devicetypes as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->name_en }}</td>
                            <td>
                                @foreach($item->code as $item3)
                                <span class="badge badge-dark">{{$item3->DataLabel}}</span>
                                @endforeach
                            </td>
                            <!-- <td>{{ $item->description }}</td> -->
                            <td>{{ $item->default_unit }}</td>
                            <td>
                                @foreach($item->status as $item2)
                                <div class="p-3">
                                    <span class="badge badge-pill" @if(!is_null($item2->icon_color)) style="font-size:1rem;background:{{$item2->icon_color}};" @else style="font-size:1rem;" @endif>@if(!is_null($item2->icon))<span class="mdi mdi-{{ $item2->icon }} mr-2"></span>@endif{{ $item2->name }}</span> {{ $item2->image }}
                                    <a href="#" onclick="$().btn_type_status('edit', '{{$item}}', '{{$item2}}');">edit</a>
                                    <a href="#" class="text-red" onclick="$().btn_delete_item('device-type-status', '{{$item2->id}}');">delete</a>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                <button class="btn btn-xs btn-grey text-dark" onclick="$().btn_manage_datacode('{{$item}}');">+ Data Code</button>
                                <button class="btn btn-xs btn-warning" onclick="$().btn_type_status('create', '{{$item}}', null);">+ Status</button>
                                @if(($item->name != "Access Control" && $item->name_en != "Access Control") && ($item->name != "Camera" && $item->name_en != "Camera"))
                                <a class="btn btn-xs btn-danger" href="{{ route('device-type.command',$item->id) }}">+ Command</button>
                                    @endif
                                    <a href="{{ route('device-type.edit', ['device_type' => $item->id]) }}" class="btn btn-xs btn-info ml-1" data-id="{{$item->id}}">Edit</a>
                                    @if($item->is_default != 1)
                                    <button class="btn btn-xs btn-danger" data-id="{{$item->id}}" value="{{$item->id}}" onclick="$().btn_reject_roomtype(this.value, {{$item->is_default}});">Delete</button>
                                    @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-10 -->
</div>
<!-- end row -->
<div class="modal fade" id="manageDataCodeModal" tabindex="-1" role="dialog" aria-labelledby="manageDataCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageDataCodeModalLabel">Manage Data Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="device_type_id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <select class="form-control" id="select-datacode">
                                @foreach($datacodes as $item)
                                <option value="{{$item->id}}">{{ $item->DataLabel }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="add_datacode"><i class="fas fa-plus mr-2"></i>Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" value="" name="datacodes" id="datacode-list">
                        <ul id="jquery-tagIt-datacode" class="inverse">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save-datacode">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#jquery-tagIt-datacode').tagit({
        allowDuplicates: false,
        removeConfirmation: true,
        editOnClick: true,
        triggerKeys: ['enter'],
        focus: function() {
            return false;
        },
    });

    $(document).ready(function() {});

    var datacode_list = [];

    $.fn.btn_manage_datacode = function(item) {
        datacode_list = [];
        $('#device_type_id').val('');
        $("#select-datacode").val($("#select-datacode option:first").val());
        $('#jquery-tagIt-datacode').html('<input type="text" class="ui-widget-content ui-autocomplete-input" autocomplete="off">');

        var type = JSON.parse(item);
        var datacodes = type.code;
        $('#device_type_id').val(type.id);
        //console.log(datacodes);
        $.each(datacodes, function(i, code) {
            datacode_list.push(code.id + '');

            var list = '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-editable">' +
                '<span class="tagit-label">' + code.DataLabel + '</span>' +
                '<a class="tagit-close" data-id="' + code.id + '"><span class="text-icon">×</span>' +
                '<span class="ui-icon ui-icon-close"></span></a></li>';

            $('#jquery-tagIt-datacode').prepend(list);

            $('.tagit-close').click(function(ev) {
                var id = $(this).data('id') + '';
                const index = datacode_list.indexOf(id);
                if (index > -1) {
                    datacode_list.splice(index, 1);
                }
                this.closest('li').remove();
            });
        });

        $('#manageDataCodeModal').modal({
            backdrop: 'static',
            keyboard: false
        });

        $('#add_datacode').click(function(ev) {

            var id = $('#select-datacode').find(':selected').val();
            var code = $('#select-datacode').find(':selected').text();

            if (jQuery.inArray(id, datacode_list) == -1) {
                datacode_list.push(id + '');
                var list = '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-editable">' +
                    '<span class="tagit-label">' + code + '</span>' +
                    '<a class="tagit-close" data-id="' + id + '"><span class="text-icon">×</span>' +
                    '<span class="ui-icon ui-icon-close"></span></a></li>';

                $('#jquery-tagIt-datacode').prepend(list);
                $('.tagit-close').click(function(ev) {
                    var id = $(this).data('id') + '';
                    const index = datacode_list.indexOf(id);
                    if (index > -1) {
                        datacode_list.splice(index, 1);
                    }
                    this.closest('li').remove();
                });
            }
        });
    };

    $('#btn-save-datacode').click(function(ev) {
        //if (datacode_list.length > 0) {
        $.ajax({
            "url": "{{ route('device-type.datacode_store') }}",
            "method": "POST",
            "data": {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'device_type_id': $('#device_type_id').val(),
                'datacode_list': datacode_list
            },
        }).done(function(response) {
            //console.log(response);
            toastr.success("Successfully");
            setInterval(function() {
                location.reload();
            }, 3000);
        });
        // } else {
        //     toastr.success("Please select datacode");
        // }
    });
</script>
@endpush