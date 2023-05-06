@extends('layouts.backend')
@section('content')

<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->

<!-- begin row -->
<div class="row">
	@foreach($areas as $key1 => $value1)
	<div class="col-xl-4 col-lg-6">
		<div class="card border-0 mb-3 bg-dark-darker text-white">
			<div class="card-body">
				<div class="mb-3 text-grey">
					<i class="fas fa-layer-group"></i>
					<b>{{ $value1->name }}</b>
				</div>
				@if(Storage::disk('local')->exists($value1->floor_plan_image))
				<div class="mb-2">
					<a class="hover11" href="{{ route('area.floor-plan', ['id' => $value1->id ]) }}">
						<figure><img class="rounded border border-success" src="{{ Storage::disk('local')->url($value1->floor_plan_image) }}" width="100%" />
						</figure>
					</a>
				</div>
				@endif
				<h3 class="m-b-10"><span data-animation="number" data-value="{{ count($value1->room) }}" class="mr-2">{{ count($value1->room) }}</span>House</h3>
				<!-- <div class="text-grey m-b-1"><i class="fa fa-caret-up"></i> <span data-animation="number" data-value="45.76">45.76</span>% increased</div> -->
			</div>
			<div class="widget-list widget-list-rounded inverse-mode mb-2">
				@foreach($value1->room as $key2 => $value2)
				@if(!$value2->disable)
				<a href="{{ route('house.booking', ['id' => $value2->id ]) }}" class="widget-list-item rounded-0 p-t-3">
					@else
					<a href="#" class="widget-list-item rounded-0 p-t-3">
						@endif
						<div class="widget-list-media icon">
							<i class="fab fa-houzz bg-indigo text-white"></i>
						</div>
						<div class="widget-list-content">
							<div class="widget-list-title">{{ $value2->name }}</div>
						</div>
						<div class="widget-list-action text-nowrap text-grey">
							<span data-animation="number" data-value="{{ $value2->seat }}" class="mr-2">{{ $value2->seat }}</span>Animal
						</div>
					</a>
					@endforeach
			</div>
		</div>
	</div>
	@endforeach
</div>
<script type="text/javascript">
	var buildings = @json($areas);
</script>
@endsection