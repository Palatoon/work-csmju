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
                    <h4 class="panel-title"><i class="fas fa-list mr-2"></i>Animal </h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-td-valign-middle datatable">
                        <p align="right">
                            <a href="{{ route('animalall.create', ['type_id' => $type]) }}"
                                class="btn btn-xs btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
                        </p>
                        <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Name (English)</th>
                                <th class="text-nowrap">Type</th>
                                <th class="text-nowrap">Attribute</th>
                                <th class="text-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($animal as $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->name_en }}</td>
                                    <td>{{ $item->type->name_en }}</td>
                                    <td>
                                        {{-- {{$item->animal_attributes_name}}
                                        {{$item->value}} --}}
                                        {{-- {{$item->attributes}} --}}
                                        @foreach ($item->attributes as $itemAttribute)
                                            @if ($itemAttribute->attribute)
                                                {{$itemAttribute->attribute->animal_attributes_name}}
                                            @endif
                                            {{$itemAttribute->value}}
                                        @endforeach
                                        
                                    </td>
                                    <td>
                                        <a href="{{ route('animalall.edit', ['animalall' => $item->id]) }}"
                                            class="btn btn-xs btn-info">Edit</a>
                                        <button class="btn btn-xs btn-danger"
                                            onclick="$().btn_delete_item('animalall', '{{ $item->id }}');">Delete</button>
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
