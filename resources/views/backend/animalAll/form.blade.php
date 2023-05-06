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
                @if (isset($animal))
                    <input class="form-control" type="hidden" name="id" value="{{ $animal->id }}" required />
                @endif
                <div class="form-group">
                    <div class="pb-1">
                        <label class="font-weight-bold" for="name">Animal Name</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="{{ $animal->name ?? '' }}" placeholder="Animal Name" required />
                    </div>
                    <div class="pb-1">
                        <label class="font-weight-bold" for="name_en">Animal Name (English)</label>
                        <input class="form-control" type="text" id="name_en" value="{{ $animal->name_en ?? '' }}"
                            name="name_en" placeholder="Animal Name (English)">
                    </div>
                    <div class="pb-1">
                        <label class="font-weight-bold" for="type">Animal Type</label>
                        <div class="pb-4">
                            <select class="form-control" name="animal_type" autofocus id="animal_type">
                                {{-- @if ($animal->type_id == '0') --}}
                                <option value="">-- Select --</option>
                                @foreach ($animaltype as $item)
                                    @if ($animal->type_id = null)
                                        <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                    @else
                                        <option
                                            value="{{ $item->id }}"@if ($item->id == $animal->type_id) {{ 'selected' }} @endif>
                                            {{ $item->name }}</option>
                                    @endif
                                    {{-- <option
                                        value="{{ $item->id }}"@if ($item->id == $animal->type_id) {{ 'selected' }} @endif>
                                        {{ $item->name_en }}</option> --}}
                                @endforeach
                            </select>
                        </div>


                        <div class="attribute pb-4">
                            @if (count($attributes) > 0)
                                @foreach ($attributes as $item)
                                    <label class="font-weight-bold"
                                        for="username">{{ ucfirst($item->animal_attributes_name_en) }}</label>
                                    <input class="form-control" type="text" id="attribute" name="values[]" autofocus>
                                @endforeach
                            @endif
                        </div>

                        <div id="attr_content"></div>

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
                let type_id = document.location.search.split('?type_id=')[1];
                $('#animal_type').val(type_id).change()

                $('#animal_type').change(function() {
                    var id = $(this).find(':selected').val();
                    var datax = {
                        '_token': $('meta[name=csrf-token]').attr('content'),
                        'type_id': id
                    };
                    $('#attr_content').html('');
                    $.ajax({
                        url: "{{ route('animal.get_attribute') }}",
                        type: "post",
                        dataType: 'json',
                        data: datax,
                        success: function(data) {
                            console.log(data);
                            if (data.length > 0) {
                                $.each(data, function(i, item) {
                                    var input = '<label class="font-weight-bold">' + item
                                        .animal_attributes_name_en + ' </label>' +
                                        '<input class="form-control" type="text" id="attribute-' +
                                        item.animal_attributes_name_en + '"name=values[' +
                                        item
                                        .id + ']' +
                                        ' autofocus required />';
                                    $('#attr_content').append(input);
                                });
                            }
                        }
                    })
                });
            });
        </script>
    @endpush
