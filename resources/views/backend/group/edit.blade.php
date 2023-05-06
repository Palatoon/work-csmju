@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->
<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Add Group Settings</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body panel-form">
        <form method="POST" action="{{ route('group.update', $item->id) }}" class="form-horizontal form-bordered" id="create-form">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <div class="pb-1">
                    <label class="font-weight-bold" for="sid">ID</label>
                    <input class="form-control" type="text" id="sid" name="sid" value="{{$item->group_id}}" readonly />
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="name">Group Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{$item->name}}" required />
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="disting">DistinguishedName</label>
                    <input class="form-control" type="text" id="disting" name="disting" value="{{$item->ou}}" required readonly>
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="hours">Hours/Week</label>
                    <input class="form-control" type="number" id="hours" name="hours" min="0" value="{{$item->hour}}" required>
                </div>

                <div align="right" class="col-md-12 col-sm-12">
                    <button type="submit" class="btn btn-sm btn-primary m-r-5" id="btn-add-device">Update</button>
                    <a href="{{ url('/backend/group') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    @endsection

    @section('script')

    <script>
        $('#btn-add-device').click(function(ev) {
            ev.preventDefault();
            swal({
                title: 'Alert',
                text: 'Are you sure that you want to edit settings?',
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
                        className: 'btn btn-info',
                        closeModal: true
                    }
                }
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $("#create-form").submit();
                }
            });
        });
    </script>
    @endsection