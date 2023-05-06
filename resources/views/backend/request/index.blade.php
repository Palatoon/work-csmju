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
				<h4 class="panel-title"><i class="fa fa-tasks"></i>&nbsp;&nbsp;Booking Request</h4>
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
				<table class="table table-striped table-bordered table-td-valign-middle" id="request-list-datatable">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th class="text-nowrap">QR</th>
							<th class="text-nowrap">Booker</th>
							<th class="text-nowrap">Title</th>
							<th class="text-nowrap">Room</th>
							<th class="text-nowrap">Time</th>
							<th class="text-nowrap">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($requests as $item)
						<tr>
							<td>{{ $item->id }}</td>
							<td class="text-center"><img src="https://chart.googleapis.com/chart?cht=qr&amp;chl={{ $item->qrcode }}&chs=500x500&chld=L|0" class="img-responsive" width="100px"></td>
							<td>{{ $item->user($item->booker)->name }}</td>
							<td>{{ $item->title }}</td>
							<td>{{ $item->room($item->room)->name }}</td>
							<td>{{ date('H:i', strtotime($item->start)) }} - {{ date('H:i d/m/Y', strtotime($item->end)) }}</td>
							<td class="text-center">
								@if(!is_null($item->status))
								@switch($item->status)
								@case(1)
								<span class="label label-success">Approved</span>
								@break
								@case(0)
								@if($item->cancel == 1)
								<span class="label label-default">Cancel</span>
								@else
								<span class="label label-warning">Reject</span>
								@endif
								@break
								@default

								@endswitch
								@else
								@if(!is_null($item->calendar_id))
								<p>Updated</p>
								<a href="#" class="btn btn-xs btn-info btn-request-update" data-id="{{$item->id}}" data-token="{{ Session::token() }}">Approve</a>
								<a href="#" class="btn btn-xs btn-danger btn-request-cancel" data-id="{{$item->id}}" data-token="{{ Session::token() }}">Reject</a>
								@else
								<a href="#" class="btn btn-xs btn-info btn-request-approve" data-id="{{$item->id}}" data-token="{{ Session::token() }}">Approve</a>
								<a href="#" class="btn btn-xs btn-danger btn-request-reject" data-id="{{$item->id}}" data-token="{{ Session::token() }}">Reject</a>
								@endif
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