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
				<h4 class="panel-title"><i class="fab fa-houzz mr-2"></i>House</h4>
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
					<a href="{{ route('house.create') }}" class="btn btn-xs btn-success"><i class="fas fa-plus mr-2"></i>Add</a>
				</p>
				<table class="table table-striped table-bordered table-td-valign-middle datatable">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th class="text-nowrap">Name</th>
							<th class="text-nowrap">Name (English)</th>
							<th class="text-nowrap">Seat</th>
							<th class="text-nowrap">Type</th>
							<th class="text-nowrap">Area</th>
							<th class="text-nowrap">Building</th>
							<th class="text-nowrap">Booking</th>
							<th class="text-nowrap">Device</th>
							<th class="text-nowrap">Permission</th>
							<th class="text-nowrap">Disable</th>
							<th class="text-nowrap">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($rooms as $item)
						<tr>
							<td>{{ $item->id }}</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->name_en }}</td>
							<td>{{ $item->seat }}</td>
							<td>{{ App\RoomType::find($item->room_type_id)->name }}</td>
							<td>{{ $item->area }}</td>
							<td>{{ $item->building }}</td>
							<td>
								@if($item->disable == false)<a href="{{ route('house.booking', ['id' => $item->id ]) }}" class="btn btn-xs btn-warning">Booking</a>@endif
							</td>
							<td>
								<a href="{{ route('house.device', ['id' => $item->id , 'id='.$item->id.'&type=room']) }}" class="btn btn-xs btn-secondary" data-id="{{$item->id}}">Devices</a>
							</td>
							<td>
								<a href="{{ route('house.permission', ['id' => $item->id, 'id='.$item->id.'&type=room']) }}" class="btn btn-xs btn-white">Permission</a>
							</td>
							<td>
								<div class="btn-group ml-1">
									@if($item->disable == true)
									<a href="javascript:;" class="btn btn-sm btn-danger">{{ 'Disable' }}</a>
									@else
									<a href="javascript:;" class="btn btn-sm btn-lime">{{ 'Enable' }}</a>
									@endif
									<a href="#" data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle" aria-expanded="false"><b class="caret"></b></a>
									<div class="dropdown-menu dropdown-menu-right">
										@if($item->disable != true)<a href="javascript:;" class="dropdown-item disable-room" data-token="{{ Session::token() }}" data-id="{{$item->id}}" data-value="true">Disable</a>@endif
										@if($item->disable != false)<a href="javascript:;" class="dropdown-item disable-room" data-token="{{ Session::token() }}" data-id="{{$item->id}}" data-value="false">Enable</a>@endif
									</div>
								</div>
							</td>
							<td>
								<a href="{{ route('house.edit', ['house' => $item]) }}" class="btn btn-xs btn-info">Edit</a>
								<button class="btn btn-xs btn-danger" data-id="{{$item->id}}" value="{{$item->id}}" onclick="btn_reject_room(this.value);">Delete</button>
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