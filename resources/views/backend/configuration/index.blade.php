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
				<h4 class="panel-title"><i class="fa fa-cog mr-2"></i>System</h4>
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
				<table class="table table-striped table-td-valign-middle">
					<!-- <p align="right">
						<button class="btn btn-xs btn-success fa fa-plus" id="create-new-config">&nbsp;&nbsp;Add</button> 
						 {{--<a href="{{ route('setting.create') }}" class="btn btn-xs btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>--}}
					</p> -->
					<thead>
						<tr>
							<th class="hide" width="1%">#</th>
							<th class="text-nowrap">Name</th>
							<th class="text-nowrap">Value</th>
							<th class="text-nowrap">Unit</th>
							<!-- <th class="text-nowrap">Notify</th> -->
							<th class="text-nowrap">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $item)
						<tr>
							<td class="hide">{{ $item->id }}</td>
							<td>{{ $item->name_th ?? $item->name_en }}</td>
							<td>@if($item->name == 'admin-password') ********** @else {{ $item->value }} @endif</td>
							<td>{{ $item->unit_th ?? $item->unit }}</td>
							<!-- <td>{{ $item->notify_status == 1 ? 'True' : '' }}</td> -->
							<td>
								@if($item->name == 'map-center-lat-long')
								<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#createEventModal5" onclick="$().btn_map_config({{$item->id}},'{{$item->name}}','{{$item->value}}');">Map</button>
								@else
								<button class="btn btn-xs btn-info" onclick="btn_edit_config({{$item->id}},'{{$item->name}}','{{$item->value}}','{{$item->type}}','{{$item->isdefault}}');"> Edit</button>
								@endif
								@if(!$item->is_default == 1)
								<button class="btn btn-xs btn-danger" value="{{$item->id}}" onclick="$().btn_reject_config(this.value);">Delete</button>
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
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXwkrX9-doT3dBXl69qHZpOXdYTW2sfWM&callback=initializeGMap"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
@endsection