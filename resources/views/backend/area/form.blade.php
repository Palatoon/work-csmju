@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">{{ucfirst($action)}} Area</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body panel-form">
        <form method="POST" id="area-form" action="{{ route('area.store') }}" class="form-horizontal form-bordered form-action-model" enctype="multipart/form-data">
            @csrf
            @if(isset($area))<input class="form-control" type="hidden" name="id" value="{{$area->id}}" required />@endif
            <div class="form-group">
                <div class="pb-1">
                    <label class="font-weight-bold" for="building">Building</label>
                    <select id="building" name="building_id" class="form-control">
                        @foreach($buildings as $item)
                        <option value="{{$item->id}}" @if(isset($area) && $area->building_id == $item->id) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="name">Area Name</label>
                    <input class="form-control" type="text" id="area-name" name="name" placeholder="Area Name" value="{{$area->name ?? ''}}" required />
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="name_en">Area Name (English)</label>
                    <input class="form-control" type="text" id="area-name_en" name="name_en" placeholder="Area Name (English)" value="{{$area->name_en ?? ''}}">
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="email">Email</label>
                    <input class="form-control" type="email" id="area-search_area_email" name="email" list="list_user_email" placeholder="Email" value="{{$area->email ?? ''}}" autocomplete="off">
                    <datalist id="list_user_email">
                    </datalist>
                </div>
                <div class="pb-1">
                    <div class="row">
                        <div class="col-sm-6 float-left">
                            <label class="font-weight-bold" for="name_en">Longitude</label>
                            <input class="form-control" type="text" id="area-x" name="x" placeholder="Longitude" value="{{$area->x ?? '' }}" />
                        </div>
                        <div class="col-sm-6 float-left">
                            <label class="font-weight-bold" for="name_en">Latitude</label>
                            <input class="form-control" type="text" id="area-y" name="y" placeholder="Latitude" value="{{$area->y ?? '' }}" />
                        </div>
                    </div>
                </div>
                <div class="pb-1">
                    <label class="font-weight-bold" for="description">Description</label>
                    <textarea class="form-control" id="area-description" name="description" placeholder="Description" rows="4">{{$area->description ?? ''}}</textarea>
                </div>

                <div class="pb-1 row">
                    <label class="font-weight-bold col-12" for="floor-plan-image">Floor Plan</label><br />
                    <div class="col-12 mb-3"><input type="file" id="area-floor-plan-image" name="floor_plan_image" accept="image/png, image/gif, image/jpeg" /></div>
                    @if(isset($area) && Storage::disk('local')->exists($area->floor_plan_image))<div class="col-12"><img src="{{ Storage::disk('local')->url($area->floor_plan_image) }}" width="50%" /></div>@endif
                </div>

                <div align="right" class="col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-primary m-r-5 btn-action-model" data-form="area-form" data-model="area" data-action="{{ $action }}">@if($action == 'edit') Update @else {{ucfirst($action)}} @endif</button>
                    <a href="{{ route('area.index') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection