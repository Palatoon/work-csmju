@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<!-- begin row -->
<div class="row">
	<input type="hidden" name="_token" id="room_tokend" value="{{ csrf_token() }}">
	<!-- begin col-10 -->
	<div class="col-md-3">
		<div class="panel panel-inverse">
			<div class="panel-body">
				<div class="map-float-table d-none d-xl-block p-15">
					<h4 class="m-t-0"><i class="fa fa-map-marker-alt text-danger m-r-5 mb-2"></i> Building Map</h4>
					<div class="mr-3">
						<div class="input-group m-b-10">
							<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
							<input type="text" id="search-buliding-input" class="form-control" placeholder="Building">
						</div>
						<table class="table" id="dashboard-building-list">
							<thead>
								<tr>
									<th>Building</th>
									<th class="text-right">Rooms</th>
								</tr>
							</thead>
							<tbody>
								@foreach($buildings as $item)
								<tr>
									<td data-id="{{$item->i}}" id="pinbs"><a href="backend/building/{{$item->id}}/room" class="text-dark" data-id="{{$item->id}}">{{ $item->name }}</a></td>
									<td class="text-right">{{ App\Room::where('building_id', $item->id)->get()->count() }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="maps" value="{{$item->all()}}">
	<input type="hidden" id="mapcenter" value="{{$item->mapcenter}}">
	<div class="col-md-9">
		<div class="panel">
			<div class="panel-heading">
				<h4 class="panel-title"><i class="fa fa-university"></i>&nbsp;&nbsp;University</h4>
			</div>
			<div id="map"></div>
		</div>
	</div>
</div>
@endsection
<script defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXwkrX9-doT3dBXl69qHZpOXdYTW2sfWM&callback=initMap">
</script>