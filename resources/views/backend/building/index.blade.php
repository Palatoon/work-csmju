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
				<h4 class="panel-title"><i class="fa fa-signs-post mr-2"></i>Farm</h4>
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
					<a href="{{ route('farm.create') }}" class="btn btn-xs btn-info" ><i class="fas fa-plus mr-2"></i>Add</a>
				</p>
				<table class="table table-striped table-bordered table-td-valign-middle datatable">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th class="text-nowrap">Name</th>
							<th class="text-nowrap">Name (English)</th>
							<th class="text-nowrap">Description</th>
							<th class="text-nowrap">Permission</th>
							<th class="text-nowrap">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($buildings as $item)
						<tr>
							<td>{{ $item->id }}</td>
							<td><a href="{{ route('farm.room', ['id' => $item->id]) }}">{{ $item->name }}</a></td>
							<td>{{ $item->name_en }}</td>
							<td>{{ $item->description }}</td>
							<td><a href="{{ route('farm.permission', ['id' => $item->id, 'id='.$item->id.'&type=building' ]) }}" class="btn btn-xs btn-white">Permission</a></td>
							<td>
								<a href="{{ route('farm.edit', ['farm' => $item->id]) }}" class="btn btn-xs btn-info" data-id="{{$item->id}}">Edit</a>
								<button class="btn btn-xs btn-danger" data-id="{{$item->id}}" value="{{$item->id}}" onclick="$().btn_reject_building(this.value);">Delete</button>
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
