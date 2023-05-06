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
                <h4 class="panel-title"><i class="fa fa-cog mr-2"></i>System</h4>
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
                <table class="table table-striped table-td-valign-middle datatable">
                    <!-- <p align="right">
						<button class="btn btn-xs btn-success fa fa-plus" id="create-new-config">&nbsp;&nbsp;Add</button> 
						 {{--<a href="{{ route('setting.create') }}" class="btn btn-xs btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>--}}
					</p> -->
                    <thead>
                        <tr>
                            <th class="hide" width="1%">#</th>
                            <th class="">DataCode</th>
                            <th class="">DataLabel</th>
                            <th class="">DataUnit</th>
                            <th class="">SmallCode</th>
                            <th class="">Conditions</th>
                            <th class="">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td class="hide">{{ $item->id }}</td>
                            <td>{{ $item->DataCode }}</td>
                            <td>{{ $item->DataLabel }}</td>
                            <td>{{ $item->DataUnit }}</td>
                            <td>{{ $item->SmallCode }}</td>
                            <td>
                                {{ $item->condition->condition ?? '' }} {{ $item->condition->value ?? '' }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-xs" onclick="$().btn_condition_item('datacode', '{{$item->id}}', '{{$item->DataLabel}}');"><i class="fa fa-plus mr-2"></i>condition</button>
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
<div class="modal fade" id="conditionModal" tabindex="-1" role="dialog" aria-labelledby="conditionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addChartModalLabel">Config Condition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-add-condition" method="post" action="{{ route('datatcode-condition.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="input-datacode-id" name="datacode_id" value="">
                    <div class="form-group">
                        <label>Datacode</label>
                        <input type="text" class="form-control" id="input-datacode" placeholder="Datacode" readonly>
                    </div>
                    <div class="form-group">
                        <label>Alert</label>
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-control" data-no="1" id="input-condition" name="condition" required>
                                    <option value=">">{{ '>' }}</option>
                                    <option value=">=">{{ '>=' }}</option>
                                    <option value="<">{{ '<' }}</option>
                                    <option value="<=">{{ '<=' }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="input-value" name="value" placeholder="Value" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-store-condition">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $.fn.btn_condition_item = function(model, id, code) {
            $('#input-datacode-id').val(id);
            $('#input-datacode').val(code);
            $.ajax({
                url: "{{ route('datacode.getCondition') }}",
                type: "post",
                data: {
                    '_token': $('#global_csrf').val(),
                    'id': id,
                }
            }).done(function(response) {
                if (Object.keys(response).length > 0) {
                    $('#input-condition').val(response.condition);
                    $('#input-value').val(response.value);
                } else {
                    $("#input-condition").val($("#input-condition option:first").val());
                    $('#input-value').val('');
                }

                $('#conditionModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        };

        $('#form-add-condition').validate({
            rule: {
                condition: 'required',
                value: 'required',
            }
        })

        $('#btn-store-condition').click(function(ev) {
            ev.preventDefault();
            if ($('#form-add-condition').valid()) {
                swal({
                    title: swal_lang.alert,
                    text: 'Are you sure that you want to store this condition?',
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: 'Cancel',
                            value: null,
                            visible: true,
                            className: 'btn btn-default',
                            closeModal: true,
                        },
                        confirm: {
                            text: swal_lang.confirm,
                            value: true,
                            visible: true,
                            className: 'btn btn-warning',
                            closeModal: true
                        }
                    }
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $('#form-add-condition').submit();
                    }
                });
            }
        });

    });
</script>
@endpush