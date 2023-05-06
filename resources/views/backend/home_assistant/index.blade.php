<?php

use App\Http\Controllers\Backend\DeviceController;
?>
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
		<div class="panel panel-inverse">
			<!-- begin panel-heading -->
			<div class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-desktop mr-2"></i>Home Assistant</h4>
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
				<p align="right">
				
					<a href="{{ route('home-assistant.create') }}" class="btn btn-xs btn-success"><i class="fas fa-plus mr-2"></i>Add</a>
				</p>
				<table class="table table-striped table-bordered table-td-valign-middle datatable">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th class="text-nowrap">Name</th>
							<th class="text-nowrap">IP</th>
							<th class="text-nowrap">Port</th>
							<th class="text-nowrap">Device</th>
							<th class="text-nowrap">Actions</th>
						</tr>
					</thead>
					<tbody>

						@foreach($data as $item)
						<tr>
							<td>{{ $item->id }}</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->ip }}</td>
							<td>{{ $item->port }}</td>
							<td>
								<a href="{{ route('home-assistant.device', ['id' => $item->id , 'id='.$item->id.'&type=home-assistant']) }}" class="btn btn-xs btn-secondary" data-id="{{$item->id}}">Devices</a>
							</td>
							<td>
								<a href="{{route('home-assistant.edit', $item->id)}}" class="btn btn-xs btn-info float-left" data-id="{{$item->id}}">Edit</a>
								<a href="#" class="btn btn-xs btn-danger float-left ml-1 btn-del-home-assistant" data-id="{{$item->id}}">Delete</a>
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
@endsection




