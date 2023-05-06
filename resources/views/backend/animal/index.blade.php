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
				<h4 class="panel-title"> <i class="fas fa-paw mr-2"></i>Animal - {{ ucfirst($_GET['type']) }}</h4>
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
					<a href="{{ route('area.create') }}" class="btn btn-xs btn-info"><i class="fas fa-plus mr-2"></i>Add</a>
				</p>
				<table class="table table-striped table-bordered table-td-valign-middle datatable">
					<thead>
						<tr>
							<th width="1%">#</th>
							<th>Name</th>
							<th>Weight (KG)</th>
							<th>Height (CM)</th>
                            <th>Health</th>
							<th>Consumption</th>
							<th>Parenting</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						{{--@foreach($areas as $item)
						<tr>
							<td>{{ $item->id }}</td>
							<td><a href="#">{{ $item->name }}</a></td>
							<td>{{ $item->name_en }}</td>
							<td>{{ App\Building::find($item->building_id)->name }}</td>
							<td>{{ $item->floor_plan_image }}</td>
							<td><a href="{{ route('area.device', ['id' => $item->id, 'id='.$item->id.'&type=area']) }}" class="btn btn-xs btn-black">Device</a></td>
							<td><a href="{{ route('area.permission', ['id' => $item->id , 'id='.$item->id.'&type=area' ]) }}" class="btn btn-xs btn-white">Permission</a></td>
							<td>
								<a href="{{ route('area.edit', ['area' => $item->id]) }}" class="btn btn-xs btn-info">Edit</a>
								<button class="btn btn-xs btn-danger" onclick="$().btn_delete_item('area', '{{$item->id}}');">Delete</button>
							</td>
						</tr>
						@endforeach--}}
                        <tr>
							<td>1</td>
							<td><a href="#">A</a></td>
							<td>125</td>
							<td>120</td>
							<td><a href="" class="btn btn-xs btn-indigo">Health</a></td>
							<td><a href="" class="btn btn-xs btn-black">Consumption</a></td>
							<td><a href="" class="btn btn-xs btn-white">Parenting</a></td>
							<td>
								<a href="#" class="btn btn-xs btn-info">Edit</a>
								<button class="btn btn-xs btn-danger" onclick="$().btn_delete_item('animal', '1');">Delete</button>
							</td>
						</tr>
                        <tr>
							<td>2</td>
							<td><a href="#">B</a></td>
							<td>113</td>
							<td>125</td>
							<td><a href="" class="btn btn-xs btn-indigo">Health</a></td>
							<td><a href="" class="btn btn-xs btn-black">Consumption</a></td>
							<td><a href="" class="btn btn-xs btn-white">Parenting</a></td>
							<td>
								<a href="#" class="btn btn-xs btn-info">Edit</a>
								<button class="btn btn-xs btn-danger" onclick="$().btn_delete_item('animal', '1');">Delete</button>
							</td>
						</tr>
                        <tr>
							<td>3</td>
							<td><a href="#">C</a></td>
							<td>136</td>
							<td>130</td>
							<td><a href="" class="btn btn-xs btn-indigo">Health</a></td>
							<td><a href="" class="btn btn-xs btn-black">Consumption</a></td>
							<td><a href="" class="btn btn-xs btn-white">Parenting</a></td>
							<td>
								<a href="#" class="btn btn-xs btn-info">Edit</a>
								<button class="btn btn-xs btn-danger" onclick="$().btn_delete_item('animal', '1');">Delete</button>
							</td>
						</tr>
                        <tr>
							<td>4</td>
							<td><a href="#">D</a></td>
							<td>122</td>
							<td>120</td>
							<td><a href="" class="btn btn-xs btn-indigo">Health</a></td>
							<td><a href="" class="btn btn-xs btn-black">Consumption</a></td>
							<td><a href="" class="btn btn-xs btn-white">Parenting</a></td>
							<td>
								<a href="#" class="btn btn-xs btn-info">Edit</a>
								<button class="btn btn-xs btn-danger" onclick="$().btn_delete_item('animal', '1');">Delete</button>
							</td>
						</tr>
                        <tr>
							<td>5</td>
							<td><a href="#">E</a></td>
							<td>146</td>
							<td>135</td>
							<td><a href="" class="btn btn-xs btn-indigo">Health</a></td>
							<td><a href="" class="btn btn-xs btn-black">Consumption</a></td>
							<td><a href="" class="btn btn-xs btn-white">Parenting</a></td>
							<td>
								<a href="#" class="btn btn-xs btn-info">Edit</a>
								<button class="btn btn-xs btn-danger" onclick="$().btn_delete_item('animal', '1');">Delete</button>
							</td>
						</tr>
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