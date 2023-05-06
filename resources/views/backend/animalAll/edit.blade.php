@extends('layouts.backend')
@section('content')
    <!-- Start @Header -->
    @include('backend.partials.header-title')
    <!-- End @Header -->

    <div class="panel panel-inverse">

        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Add Animal</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                        class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="panel-body panel-form">
            <form method="POST" id="animal-form" action="{{ route('animalall.store') }}"
                class="form-horizontal form-bordered">
                @csrf
                @if (isset($animal_data))
                    {{-- <input class="form-control" type="hidden" name="id" value="{{ $animal_data->animal_id }}" required /> --}}
                @endif
                <div class="form-group">
                    <div class="pb-1">
                        <label class="font-weight-bold" for="name">Animal Name</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="{{ $animal_data[$animal_id]['animal_name'] ?? ''}}" placeholder="Animal Name" required />
                    </div>
                    <div class="pb-1">
                        <label class="font-weight-bold" for="name_en">Animal Name (English)</label>
                        <input class="form-control" type="text" id="name_en" value="{{ $animal_data[$animal_id]['animal_name_en'] ?? '' }}"
                            name="name_en" placeholder="Animal Name (English)">
                    </div>
                    <div class="pb-1">
                        <label class="font-weight-bold" for="type">Animal Type</label>
                        <div class="pb-4">
                            <label class="form-control" name="animal_type" id="animal_type_value" >
                                {{$animal_data[$animal_id]['type_name'] ?? ''}}
                            </label>
                        </div>
@foreach ($animal_data[$animal_id]['animal_attributes'] as $attribute)
                    <div class="pb-1">
                        <label class="font-weight-bold" for="attribute_value">{{ $attribute['animal_attributes_name'] ?? '' }}</label>
                        <input class="form-control" type="text" id="attribute_value" value="{{ $attribute['attribute_value'] ?? '' }}"
                            name="attribute_value[]" >
                    </div>
@endforeach
                </div>

                <div align="right" class="col-md-12 col-sm-12">
                <button type="submit" class="btn btn-sm btn-primary m-r-5" id="btn-add-animal">Submit</button>
                <a href="{{ route('animalall.index') }}" class="btn btn-sm btn-default">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        url = "{{ route('animal.get_attribute_value') }}",
            $.get(url, function(data) {
                $('#id_type').val(data.id);
                console.log(JSON.stringify(data))
            })
    })
</script>
@endpush
