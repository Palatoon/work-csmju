@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Add Command</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <div class="panel-body panel-form">
        <form method="POST" id="create-new-command" action="{{ route('device-type.commandstore') }}" class="form-horizontal form-bordered">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 text-right"><a href="#" id="btnadd"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></div>
                </div>
                <input type="hidden" name="id" value="{{$id}}">


                <div id="addcommands">

                    <div class="row">
                        @if($data->isEmpty())<input type="hidden" name="editid[]" value="">@endif
                        <div class="col-sm-4">
                            <div class="pb-1">
                                <label class="font-weight-bold">Command Name</label>
                                @if($data->isEmpty())<input class="form-control" type="text" id="name" name="name[]" placeholder="Command Name">@endif
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="pb-1">
                                <label class="font-weight-bold">Command Value</label>
                                @if($data->isEmpty())<input class="form-control" type="text" id="value" name="value[]" placeholder="Command Value">@endif
                            </div>
                        </div>
                        <div class="col-sm-1">

                        </div>
                    </div>
                    @foreach($data as $r)
                    <div class="row">
                        <input type="hidden" name="editid[]" value="{{$r->id ?? ''}}">
                        <div class="col-sm-4">
                            <div class="pb-1">
                                <input class="form-control" type="text" id="name" name="name[]" placeholder="Command Name" value="{{$r->command_name ?? ''}}">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="pb-1">
                                <input class="form-control" type="text" id="value" name="value[]" placeholder="Command Value" value="{{$r->command_value ?? ''}}">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="pb-1">
                                <a href="#" onclick="delcommand({{$r->id}})"><i class="fa fa-trash text-danger mt-2" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div align="right" class="col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-primary m-r-5" id="btn-add-device-command">Submit</button>
                    <a href="{{ route('device-type.index') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    @endsection

    @section('script')
    <script>
        $('#btnadd').click(function() {
            var id = makeid(4);
            $('#addcommands').append("<div class='row' id='"+ id +"'><input type='hidden' name='editid[]' value=''><div class='col-sm-4'><div class='pb-1'><input class='form-control' type='text' id='name' name='name[]' placeholder='Command Name'></div></div><div class='col-sm-7'><div class='pb-1'><input class='form-control' type='text' id='value' name='value[]' placeholder='Command Value'></div></div><div class='col-sm-1'><a href='#' onclick='delrow(\""+id+"\")'><i class='fa fa-trash text-danger mt-2' aria-hidden='true'></i></a></div></div>");
        });


        function makeid(length) {
            var result = "";
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return result;
        }


        delrow = (id) => {
            $('#' + id).remove();
        }



        delcommand = (id) => {
            swal({
                title: 'Alert',
                text: 'Are you sure that you want to delete this command?',
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
                        url: "commanddelete",
                        type: "post",
                        dataType: "json",
                        data: {
                            '_token': $('meta[name=csrf-token]').attr('content'),
                            'id': id
                        },
                        success: function(response) {
                            if (response) {
                                swal("Success!", "", "success").then((isConfirm) => {
                                    location.reload()
                                });
                            } else {
                                swal("Error!", "", "error");
                            }
                        }
                    })
                }
            });
        }
    </script>
    @endsection