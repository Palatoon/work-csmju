@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Edit House Type</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <div class="panel-body panel-form">
        <form method="POST" id="update-roomtype" action="{{ route('house-type.update') }}" class="form-horizontal form-bordered">
            @csrf
            <div class="form-group">
                @if(isset($room))<input class="form-control" type="hidden" name="id" value="{{ $edit['id'] }}" required />@endif
                <div class="pb-1">
                    <label class="font-weight-bold" for="name">House Type Name</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="House Type Name" value="{{$edit['name'] ?? ''}}" required />
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="name_en">House Type Name (English)</label>
                    <input class="form-control" type="text" id="name_en" name="name_en" placeholder="House Type Name (English)" value="{{$edit['name_en'] ?? ''}}">
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="description">Description</label>
                    <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description">{{$edit['description'] ?? '' }}</textarea>
                </div>

                <div align="right" class="col-md-12 col-sm-12">
                    <input class="form-control" type="hidden" name="id" value="{{$edit['id'] ?? ''}}" required />
                    <button type="submit" class="btn btn-sm btn-primary m-r-5" id="btn-edit-roomtype">Update</button>
                    <a href="{{ route('house-type.index') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    @endsection
    <script>
        function approve() {
            document.getElementById("approver").disabled = true;
        }

        function unapprove() {
            document.getElementById("approver").disabled = false;
        }
    </script>