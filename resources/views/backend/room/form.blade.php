@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">{{ucfirst($action)}} Room</h4>
    </div>

    <div class="panel-body panel-form">
        <form method="POST" id="room-form" action="{{ route('house.store') }}" class="form-horizontal form-bordered form-action-model" enctype="multipart/form-data">
            @csrf
            @if(isset($room))<input class="form-control" type="hidden" name="id" value="{{ $room->id }}" required />@endif
            <div class="form-group">
                <div class="pb-1">
                    <label class="font-weight-bold" for="name">House Name</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Room Name" value="{{ $room->name ?? NULL }}" required />
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="name_en">House Name (English)</label>
                    <input class="form-control" type="text" id="name_en" name="name_en" placeholder="Room Name (English)" value="{{ $room->name_en ?? NULL }}">
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="email">Email</label>
                    <input class="form-control" type="email" id="search_room_email" name="email" list="list_user_email" placeholder="Email" required value="{{ $room->email ?? NULL }}" autocomplete="off">
                    <datalist id="list_user_email">
                    </datalist>
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="seat">Seat</label>
                    <input class="form-control" type="number" id="seat" name="seat" placeholder="Seat" value="{{ $room->seat ?? NULL }}" required>
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="detail">Detail</label>
                    <textarea class="form-control" id="detail" name="detail" placeholder="" rows="4">{{ $room->detail ?? NULL }}</textarea>
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="room_type_id">House Type</label>
                    <select class="form-control js-example-basic-single" id="room_type_id" name="room_type_id">
                        @foreach ($room_types as $item)
                        <option value="{{ $item->id }}" @if(isset($room->room_type) && $room->room_type == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="area_id">Area</label>
                    <select class="form-control js-example-basic-single" id="area_id" name="area_id">
                        @foreach ($areas as $item)
                        <option value="{{ $item->id }}" @if(isset($room->area) && $room->area == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="auto_approve">AutoApprove</label><br/>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="auto_approve" value="1" @if(isset($room->auto_approve) && $room->auto_approve == '1' ) checked @endif onclick="approve(true)">
                        <label class="form-check-label" for="auto_approve">True</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="auto_approve" value="0" @if(isset($room->auto_approve) && $room->auto_approve == '0' ) checked @endif onclick="approve(false)">
                        <label class="form-check-label" for="auto_approve">False</label>
                    </div>
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="approver">Approver</label>
                    <select class="form-control js-example-basic-single" id="approver" name="approver" @if(isset($room->auto_approve) && $room->auto_approve == '1' ) disabled @endif>
                        <option value="">Select</option>
                        @foreach ($approvers as $item)
                        <option value="{{ $item->id }}" @if(isset($room->approver) && $room->approver == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- <div class="pb-1">
                    <label class="font-weight-bold" for="ha">Home Assistant</label>
                    <select id="ha" name="ha_id" class="form-control">
                        <option value="">None</option>
                        @foreach($has as $item)
                        <option value="{{$item->id}}" @if(isset($area) && $area->ha_id == $item->id) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="pb-1">
                    <label class="font-weight-bold" for="ha_url">Home Assistant URL / Tag</label>
                    <input class="form-control" type="text" id="ha_url" name="ha_url" placeholder="Home Assistant URL" value="{{$area->ha_url ?? ''}}" />
                </div> -->

                <div class="pb-1">
                    <label class="font-weight-bold" for="floor-plan-image">Floor Plan</label><br />
                    <div class="mb-3"><input type="file" id="floor-plan-image" name="floor_plan_image" accept="image/png, image/gif, image/jpeg" /></div><br />
                    @if(isset($room) && Storage::disk('local')->exists($room->floor_plan_image))
                    <img src="{{ Storage::disk('local')->url($room->floor_plan_image) }}" width="50%" />
                    @endif
                </div>

                <div align="right" class="col-md-12 col-sm-12">
                <button type="button" class="btn btn-sm btn-primary m-r-5 btn-action-model" data-form="room-form" data-model="room" data-action="{{ $action }}">@if($action == 'edit') Update @else {{ucfirst($action)}} @endif</button>
                    <a href="{{ route('house.index') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection