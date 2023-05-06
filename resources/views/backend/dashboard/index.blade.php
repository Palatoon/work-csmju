@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<!-- begin row -->
<div class="row">
	@foreach($buildings as $key1 => $value1)
	<div class="col-xl-3 col-lg-6">
		<div class="card border-0 mb-3 bg-dark-darker text-white">
			<div class="card-body">
				<div class="mb-3 text-grey">
					<i class="fa fa-signs-post"></i>
					<b>{{ $value1->name }}</b>
				</div>
				@if(Storage::disk('local')->exists($value1->floor_plan_image))
				<div class="mb-2">
					<a class="hover11" href="{{ route('farm.floor-plan', ['id' => $value1->id ]) }}">
						<figure><img class="rounded border border-success" src="{{ Storage::disk('local')->url($value1->floor_plan_image) }}" width="100%" />
						</figure>
					</a>
				</div>
				@endif
				<h3 class="m-b-10"><span data-animation="number" data-value="{{ count($value1->area) }}" class="mr-2">{{ count($value1->area) }}</span>area</h3>
			</div>
			<div class="widget-list widget-list-rounded inverse-mode mb-2">
				@foreach($value1->area as $key2 => $value2)
				<a href="{{ route('area.floor-plan', ['id' => $value1->id ]) }}" class="widget-list-item rounded-0 p-t-3">
					<div class="widget-list-media icon">
						<i class="fas fa-layer-group bg-indigo text-white"></i>
					</div>
					<div class="widget-list-content">
						<div class="widget-list-title">{{ $value2->name }}</div>
					</div>
					<div class="widget-list-action text-nowrap text-grey">
						<span data-animation="number" data-value="{{ count($value2->room) }}" class="mr-2">{{ count($value2->room) }}</span>house
					</div>
				</a>
				@endforeach
			</div>
		</div>
	</div>
	@endforeach
</div>
<script type="text/javascript">
	var buildings = @json($buildings);
</script>
@endsection