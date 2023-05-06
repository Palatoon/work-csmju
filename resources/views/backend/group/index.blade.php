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
		<div class="panel">
			<!-- begin panel-heading -->
			<div class="panel-heading">
				<h4 class="panel-title"><i class="fa fa-users mr-2"></i>Group</h4>
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

				<table class="table table-striped table-bordered table-td-valign-middle datatable">
					<p align="right">
						<a href="{{ route('group.create') }}" class="btn btn-xs btn-success"><i class="fas fa-plus mr-2"></i>Add</a>
					</p>
					<thead>
						<tr>
							<th width="1%">#</th>
							<!-- <th class="text-nowrap">Group ID</th> -->
							<th>Group Name</th>
							<th class="text-nowrap">Address</th>
							<th>Hours / Week</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $item)

						<tr>
							<td>{{ $item->id }}</td>
							<!-- <td>{{ $item->group_id }}</td> -->
							<td>{{ $item->name }}</td>
							<td>{{ $item->ou }}</td>
							<td>{{ $item->hour }}</td>
							<td>
								<a href="{{ route('group.edit', ['group' => $item->id]) }}" class="btn btn-xs btn-info float-left">Edit</a>
								<form action="{{ route('group.destroy', $item->id)}}" method="post" id="del-form">
									@csrf
									@method('DELETE')
									<button class="btn btn-xs btn-danger float-left ml-1" id="btn-del-permission" type="submit">Delete</button>
								</form>
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



@section('script')
<script>
	$('#btn-del-permission').click(function(ev) {
		ev.preventDefault();
		swal({
			title: 'Alert',
			text: 'Are you sure that you want to delete permission?',
			icon: 'error',
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
				$("#del-form").submit();
			}
		});
	});
</script>
@endsection