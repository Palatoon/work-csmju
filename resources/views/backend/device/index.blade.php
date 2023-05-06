<?php

use App\Http\Controllers\Backend\DeviceController;
?>
@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->
<style>
	.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
	}

	/* Hide default HTML checkbox */
	.switch input {
		opacity: 0;
		width: 0;
		height: 0;
	}

	/* The slider */
	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 26px;
		width: 26px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	input:checked+.slider {
		background-color: #2196F3;
	}

	input:focus+.slider {
		box-shadow: 0 0 1px #2196F3;
	}

	input:checked+.slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 34px;
	}

	.slider.round:before {
		border-radius: 50%;
	}
</style>

<!-- begin row -->
<div class="row">
	<!-- begin col-10 -->
	<div class="col-xl-12">
		<!-- begin panel -->
		<div class="panel panel-inverse">
			<!-- begin panel-heading -->
			<div class="panel-heading">
				<h4 class="panel-title"><i class="fas fa-desktop mr-2"></i>Devices</h4>
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
					<a href="#" class="btn btn-xs btn-info" onclick="syncnow({{$model->id}})"><i class="fas fa-sync-alt"></i>&nbsp;&nbsp;Sync</a>
					<a href="{{ route('device.create' , ['id' => $model->id , 'type' => $_GET["type"]]) }}" class="btn btn-xs btn-success"><i class="fas fa-plus mr-2"></i>Add</a>
				</p>
				<table class="table table-striped table-bordered table-td-valign-middle datatable">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th class="text-nowrap">Name</th>
							<th class="text-nowrap">Type</th>
							<th class="text-nowrap">IP</th>
							<th class="text-nowrap">MAC</th>
							<th class="text-nowrap">Serial Number</th>
							<th class="text-nowrap">Actions</th>
						</tr>
					</thead>
					<tbody>

						@foreach($data as $item)

						<tr>
							<td>{{ $item->id }}</td>
							<td>{{ $item->name }}</td>
							<td>{{ App\Device::find($item->id)->device_name($item->device_type_id) }}</td>
							<td>{{ $item->ip }}</td>
							<td>{{ $item->macaddress }}</td>
							<td>{{ $item->serial_id }}</td>
							<td>
								<a href="{{route('device.edit', [$item->id , 'area='.$_GET["id"].'&type='.$_GET["type"]])}}" class="btn btn-xs btn-info float-left" data-id="{{$item->id}}">Edit</a>
								@if(App\Device::find($item->id)->device_name($item->device_type_id) != "Access Control" && App\Device::find($item->id)->device_name($item->device_type_id) != "Camera")
								<button class="btn btn-xs btn-warning float-left ml-1" onclick="setdevice({{$_GET["id"]}},{{$item->id}})">Setting</button>
								@endif
								<a href="#" class="btn btn-xs btn-danger float-left ml-1" onclick="delDevice({{$item->id}})" data-id="{{$item->id}}">Delete</a>
								@if(App\Device::find($item->id)->device_name($item->device_type_id) == "Access Control" || App\Device::find($item->id)->device_name($item->device_type_id) == "Camera")
								<a href="#" onclick="listusers({{ $item->id }})"><i class="fas fa-users float-right pt-1"></i></a>
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
@endsection




@section('script')
<script>
	delDevice = (id) => {
		swal({
			title: 'Alert',
			text: 'Are you sure that you want to delete device?',
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
				//console.log(id)
				$.ajax({
					url: "/smartfarm-portal/public/backend/device/remove/" + id,
					type: "get",
					success: function(data) {
						if (data == "true") {
							toastr.success('Delete device successfull!');
							setTimeout(() => {
								window.location.reload()
							}, 2000)
						}
					}
				});
			}
		});
	}


	syncnow = (id) => {
		swal({
			title: 'Alert',
			text: 'Are you sure that you want to sync user to device?',
			icon: 'warning',
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
				$.ajax({
					url: 'https://ws.lanna.co.th/api/booking/room/' + id,
					method: 'post',
					type: 'json',
					beforeSend: function() {
						toastr.success('Processing data!');
					},
					success: function() {
						toastr.success('Sync user successfull!');
					}
				});
			}
		});
	};

	listusers = (id) => {
		$('#modalcamera').modal('show');
		$('.modal-body').html('');

		$.ajax({
			url: 'https://ws.lanna.co.th/api/booking/device/' + id + '/User',
			method: 'get',
			type: 'json',
			success: function(data) {
				var sum = 1;
				var html = "<table class=\"table table-striped table-bordered table-td-valign-middle datatable\"><thead><tr><th width=\"1%\">#</th><th class=\"text-nowrap\">EmployeeNo</th><th class=\"text-nowrap\">Name</th><th class=\"text-nowrap\">numOfFace</th></tr></thead><tbody>";
				$.each(data, function(i, d) {
					html += "<tr><td>" + (i + 1) + "</td><td>" + d.employeeNo + "</td><td>" + d.name + "</td><td>" + d.numOfFace + "</td></tr>";
					sum++;
				});
				html += "</tbody></table>";
				$('.modal-body').append(html);
				$('#personcount').html('Persons : ' + (sum - 1));
				$('.datatable').DataTable({
					responsive: true,
					pageLength: 10,
					retrieve: true,
				});
			}
		});
	};






	setdevice = (room, device) => {
		var st = "";
		var ed = "";

		$.ajax({
			url: "/backend/device/getdeviceinit/" + device,
			type: "get",
			success: function(data) {
				$('#modalsetdevice').modal('show');
				$('#st_time').prop('checked', false);
				$('#ed_time').prop('checked', false);
				$('#st_room_id').val(room);
				$('#st_device_id').val(device);
				if (data != "null") {
					if (data.start_time == 1) {
						$('#st_time').prop('checked', true);
					}
					if (data.end_time == 1) {
						$('#ed_time').prop('checked', true);
					}
				}

				// $('#st_time').click(function() {
				// 	var datax = {
				// 		'_token': $('meta[name=csrf-token]').attr('content'),
				// 		'room_id': $('#st_room_id').val(),
				// 		'device_id': $('#st_device_id').val(),
				// 		'st_time': $('#st_time').prop('checked'),
				// 		'ed_time': $('#ed_time').prop('checked'),
				// 	};
				// 	$.ajax({
				// 		url: "/backend/device/adddeviceinit",
				// 		type: "post",
				// 		dataType: 'json',
				// 		data: datax,
				// 		success: function(data) {
				// 			console.log(data);
				// 		}
				// 	})
				// });

				// $('#ed_time').click(function() {
				// 	var datax = {
				// 		'_token': $('meta[name=csrf-token]').attr('content'),
				// 		'room_id': $('#st_room_id').val(),
				// 		'device_id': $('#st_device_id').val(),
				// 		'st_time': $('#st_time').prop('checked'),
				// 		'ed_time': $('#ed_time').prop('checked'),
				// 	};
				// 	$.ajax({
				// 		url: "/backend/device/adddeviceinit",
				// 		type: "post",
				// 		dataType: 'json',
				// 		data: datax,
				// 		success: function(data) {
				// 			console.log(data);
				// 		}
				// 	})
				// });




			}
		});
	}


	$('#modalsetdevice').on('hidden.bs.modal', function(e) {
		var datax = {
			'_token': $('meta[name=csrf-token]').attr('content'),
			'room_id': $('#st_room_id').val(),
			'device_id': $('#st_device_id').val(),
			'st_time': $('#st_time').prop('checked'),
			'ed_time': $('#ed_time').prop('checked'),
		};
		$.ajax({
			url: "/backend/device/adddeviceinit",
			type: "post",
			dataType: 'json',
			data: datax,
			success: function(data) {

			}
		})
	});
</script>
@endsection