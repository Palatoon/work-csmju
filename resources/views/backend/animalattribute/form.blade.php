@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Add Animal Attribute</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body panel-form">
        <form method="POST" id="create-new-attribute-type" action="{{ route('animalattribute.store') }}" class="form-horizontal form-bordered">
            @csrf
            @if (isset($animalattribute))
                    <input class="form-control" type="hidden" name="id" value="{{ $animalattribute ->id}}" required />
                @endif
        <div class="form-group">
                <div class="pb-1">
                    <label class="font-weight-bold" for="name">Animal Attribute Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ $animalattribute->name  ?? '' }}" placeholder="Animal Attribute Name" required />
                </div>
                <div class="pb-1">
                    <label class="font-weight-bold" for="name_en">Animal Attribute Name (English)</label>
                    <input class="form-control" type="text" id="name_en" value="{{ $animalattribute->name_en  ?? '' }}" name="name_en" placeholder="Animal Attribute Name (English)">
                </div>
                <div class="pb-1">
                    <label class="font-weight-bold" for="unit">Unit</label>
                    <input class="form-control" type="text" id="unit" value="{{ $animalattribute->unit  ?? '' }}" name="unit" placeholder="Unit">
                </div>
                <div align="right" class="col-md-12 col-sm-12">
                    <button type="submit" class="btn btn-sm btn-primary m-r-5" id="btn-add-animal-attribute">Submit</button>
                    <a href="{{ route('animalattribute.index') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    @endsection
    