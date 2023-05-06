@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Add Device Type</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <div class="panel-body panel-form">
        <form method="POST" id="create-new-device-type" action="{{ route('device-type.store') }}" class="form-horizontal form-bordered">
            @csrf
            <div class="form-group">
                <div class="pb-1">
                    <label class="font-weight-bold" for="name">Device Type Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ $device->name  ?? '' }}" placeholder="RDevice Type Name" required />
                </div>
                @if(isset($device->id))
                <input type="hidden" value="{{ $device->id  ?? '' }}" name="id">
                @endif
                <div class="pb-1">
                    <label class="font-weight-bold" for="name_en">Device Type Name (English)</label>
                    <input class="form-control" type="text" id="name_en" value="{{ $device->name_en  ?? '' }}" name="name_en" placeholder="Device Type Name (English)">
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="detail">Description</label>
                    <textarea class="form-control" id="des" name="des" placeholder="" rows="4">{{ $device->description  ?? '' }}</textarea>
                </div>

                <div align="right" class="col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-primary m-r-5" id="btn-add-device-type">Submit</button>
                    <a href="{{ route('device-type.index') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    @endsection
