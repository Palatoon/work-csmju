@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Add Home Assistant</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <div class="panel-body panel-form">
        <form method="POST" id="create-new-home-assistant" action="{{ route('home-assistant.store') }}" class="form-horizontal form-bordered">
            @csrf
            <div class="form-group">
                <div class="pb-1">
                    <label class="font-weight-bold" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Home Assistant Name" required value="{{ $data->name ?? '' }}" />
                </div>

                @if(isset($data->id))
                <input class="form-control" type="hidden" id="id" name="id" value="{{ $data->id ?? '' }}"/>
                @endif

                <div class="pb-1">
                    <label class="font-weight-bold" for="ip">IP Address</label>
                    <input class="form-control" type="text" id="ip" name="ip" required autofocus  value="{{ $data->ip ?? '' }}"/>
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="seat">Port</label>
                    <input class="form-control" type="number" id="port" name="port" placeholder="Port" value="{{ $data->port ?? '' }}" required>
                </div>
                <div class="pb-1">
                    <label class="font-weight-bold" for="token">Token</label>
                    <textarea class="form-control" id="token" name="token" placeholder="" rows="4">{{ $data->token  ?? '' }}</textarea>
                </div>

                <div align="right" class="col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-primary m-r-5" id="btn-add-home-assistant">Submit</button>
                    <a href="{{ route('home-assistant.index') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    @endsection