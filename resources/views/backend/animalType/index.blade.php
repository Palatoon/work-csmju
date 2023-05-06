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
                    <h4 class="panel-title"><i class="fas fa-list mr-2"></i>Animal Type</h4>
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
                            <a href="{{ route('animal-type.create') }}" class="btn btn-xs btn-success"><i
                                    class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
                        </p>
                        <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Name (English)</th>
                                <th class="text-nowrap">Attribute</th>
                                <th class="text-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ $typeattribute }} --}}
                            @foreach ($animaltype as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->name_en }}</td>
                                    {{-- <td>{{ $item->animal_attributes_name }}</td> --}}
                                    <td>
                                        @foreach ($attributes as $attr)
                                            @if ($item->id == $attr->id)
                                                <span>{{ $attr->animal_attributes_name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    {{-- <td>{{ App\TypeAttribute::find($item->id)->animal_types_id }}</td> --}}
                                    <td>
                                        <a href="{{ route('animal-type.edit', ['animal_type' => $item->id]) }}"
                                            class="btn btn-xs btn-info">Edit</a>
                                        <button class="btn btn-xs btn-danger"
                                            onclick="$().btn_delete_item('animal-type', '{{ $item->id }}');">Delete</button>
                                        <button type="button" class="btn btn-info btn-lg btn-xs"
                                            onclick="$().btn_attr_item('{{ $item->id }}');">Attribute</button>
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
    <!-- modal -->
    <div class="modal fade" id="attributeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attribute</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('typeattribute.store') }}">
                    @csrf
                    <input type="hidden" name="animal_id" id="animal_id" />
                    <div class="modal-body">
                        <div class="form-check">
                            @foreach ($animalattribute as $item)
                                <div>
                                    <input class="form-check-input" type="checkbox" name="attr[]"
                                        value="{{ $item->id }}" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->animal_attributes_name }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-details">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // $('.btn-add-attribute').click(function() {
            //     var id = $(this).data('id');
            //     $('#animal_id').val(id);
            // });
        });

        $.fn.btn_attr_item = function(id) {
            $('#animal_id').val(id);
            $('#attributeModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            // swal({
            //     title: 'Alert',
            //     text: 'Are you sure that you want to delete this ' + model.replace(/-/g, ' ') + '?',
            //     icon: 'warning',
            //     buttons: {
            //         cancel: {
            //             text: 'Cancel',
            //             value: null,
            //             visible: true,
            //             className: 'btn btn-default',
            //             closeModal: true,
            //         },
            //         confirm: {
            //             text: 'Confirm',
            //             value: true,
            //             visible: true,
            //             className: 'btn btn-warning',
            //             closeModal: true
            //         }
            //     }
            // }).then(function(isConfirm) {
            //     if (isConfirm) {
            //         $.ajax({
            //             method: 'POST',
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             url: '/backend/' + model.toLowerCase() + '/delete?' + $.param({
            //                 'id': id
            //             }),
            //             success: function(response) {
            //                 //console.log(response);
            //                 $().notification(response);
            //                 location.reload();
            //             },
            //             error: function(xhr) {
            //                 console.log(xhr.responseText);
            //             }
            //         });
            //     }
            // });
        };
    </script>
@endpush
