@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">{{ucfirst($action)}} Farm</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <div class="panel-body panel-form">
        <form method="POST" id="building-form" action=" {{ route('farm.store') }}" class="form-horizontal form-bordered form-action-model" enctype="multipart/form-data">
            @csrf
            @if(isset($building))<input class="form-control" type="hidden" name="id" value="{{$building->id}}" required />@endif
            <div class="form-group">
                <div class="pb-1">
                    <label class="font-weight-bold" for="name">Farm Name</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Building Name" value="{{$building->name ?? ''}}" required autofocus />
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="name_en">Farm Name (English)</label>
                    <input class="form-control" type="text" id="name_en" name="name_en" placeholder="Building Name (English)" value="{{$building->name_en ?? ''}}" />
                </div>
                <div class="pb-1">
                    <div class="row">
                        <div class="col-sm-6 float-left">
                            <label class="font-weight-bold" for="name_en">Longitude</label>
                            <input class="form-control" type="text" id="x" name="x" placeholder="Longitude" value="{{$building->x ?? ''}}" />
                        </div>
                        <div class="col-sm-6 float-left">
                            <label class="font-weight-bold" for="name_en">Latitude</label>
                            <input class="form-control" type="text" id="y" name="y" placeholder="Latitude" value="{{$building->y ?? ''}}" />
                        </div>
                    </div>
                </div>
                <div class="pb-1">
                    <label class="font-weight-bold" for="description">Description</label>
                    <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description">{{$building->description ?? '' }}</textarea>
                </div>

                <div class="pb-1 row">
                    <label class="font-weight-bold col-12" for="floor-plan-image">Floor Plan</label><br />
                    <div class="col-12 mb-3"><input type="file" id="floor-plan-image" name="floor_plan_image" accept="image/png, image/gif, image/jpeg" /></div>
                    @if(isset($building) && Storage::disk('local')->exists($building->floor_plan_image))<div class="col-12"><img src="{{ Storage::disk('local')->url($building->floor_plan_image) }}" width="50%" /></div>@endif
                </div>

                <div align="right" class="col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-primary m-r-5 btn-action-model" data-form="building-form" data-model="building" data-action="{{ $action }}">@if($action == 'edit') Update @else {{ucfirst($action)}} @endif</button>
                    <a href="{{ route('farm.index') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>

            </div>

        </form>
    </div>

</div>
@endsection