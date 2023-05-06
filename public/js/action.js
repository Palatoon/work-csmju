$(document).ready(function() {

    if (typeof $('.btn-action-model').length !== 'undefined') {
        $('.btn-action-model').click(function(ev) {
            var model = $(this).data('model');
            var action = $(this).data('action');
            ev.preventDefault();
            swal({
                title: 'Alert',
                text: 'Are you sure that you want to ' + action + ' this ' + model.replace(/-/g, ' ') + '?',
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
                        text: 'Confirm',
                        value: true,
                        visible: true,
                        className: 'btn btn-warning',
                        closeModal: true
                    }
                }
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $('.form-action-model').submit();
                }
            });
        });
    };

    $.fn.btn_type_status = function(model, parent, id, url) {
        $('#type-name').html(model.replace(/-/g, ' ').capitalize());
        $('#form-type-status').attr('action', url);
        $('#type_status_id').attr('name', parent + '_id');
        $('#type_status_id').val(id);
        $('#typeStatusModal').modal({ backdrop: 'static', keyboard: false });
    };

    $.fn.btn_delete_item = function(model, id) {
        swal({
            title: 'Alert',
            text: 'Are you sure that you want to delete this ' + model.replace(/-/g, ' ') + '?',
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
                    text: 'Confirm',
                    value: true,
                    visible: true,
                    className: 'btn btn-warning',
                    closeModal: true
                }
            }
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: '/backend/' + model + '/delete?' + $.param({
                        'id': id
                    }),
                    success: function(response) {
                        $().notification(response);
                        location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    };

    $.fn.notification = function(e) {
        switch (e.type) {
            case 'info':
                toastr.info(e.message);
                break;

            case 'warning':
                toastr.warning(e.message);
                break;

            case 'success':
                toastr.success(e.message);
                break;

            case 'error':
                toastr.error(e.message);
                break;
        }
    };

    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }
});