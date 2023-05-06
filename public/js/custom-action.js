var xamppurl = '/smartfarm-portal/public/backend/';
$(document).ready(function () {

    if (typeof $('.btn-action-model').length !== 'undefined') {
        $('.btn-action-model').click(function (ev) {
            var model = $(this).data('model');
            var action = $(this).data('action');
            var form = $('#' + $(this).data('form'));
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    if (form && form.valid()) {
                        $('.form-action-model').submit();
                    }
                    if (!form) {
                        $('.form-action-model').submit();
                    }
                }
            });
        });
    };

    $.fn.btn_type_status = function (action, parent, item, url) {
        let status = JSON.parse(item);
        let type = JSON.parse(parent);
        $('#device-type-id').val(type.id);
        $('#status-type-name').html(type.name);
        if (action == "create") {
            $('#device-type-status-id').val("");
            $('#device-type-status-name').val("Default");
            $('#device-type-status-icon').val("");
            $('#device-type-status-icon-color').val("");
            $('#device-type-status-image').html("");
        } else {
            $('#device-type-status-id').val(status.id);
            $('#device-type-status-name').val(status.name);
            $('#device-type-status-icon').val(status.icon);
            $('#device-type-status-icon-color').val(status.icon_color);
            $('#device-type-status-image').html(status.image);
        }
        $('#device-type-status-form').attr('action', url);
        $('#typeStatusModal').modal({ backdrop: 'static', keyboard: false });
    };

    $.fn.btn_delete_item = function (model, id) {
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
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: '/backend/' + model.toLowerCase() + '/delete?' + $.param({
                        'id': id
                    }),
                    success: function (response) {
                        //console.log(response);
                        $().notification(response);
                        location.reload();
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    };




    $.fn.btn_delete_item_history_type = function (model, id) {
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
        }).then(function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: xamppurl + model.toLowerCase() + '/delete',
                    method: 'POST',
                    type: 'json',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id
                    },
                    success: function (response) {
                        if (response == 'true') {
                            toastr.success('Delete history type successfull!');
                            setTimeout(() => {
                                window.location.reload()
                            }, 2000)
                        } else {
                            toastr.error('Delete history type fail!');
                        }
                        // $().notification(response);
                        // location.reload();
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
                // $.ajax({
                //     method: 'POST',
                //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                //     url: '/backend/' + model.toLowerCase() + '/delete?' + $.param({
                //         'id': id
                //     }),
                //     success: function (response) {
                //         //console.log(response);
                //         $().notification(response);
                //         location.reload();
                //     },
                //     error: function (xhr) {
                //         console.log(xhr.responseText);
                //     }
                // });
            }
        });
    };




    $.fn.notification = function (e) {
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

    String.prototype.capitalize = function () {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }

    // chaneg user role
    if (typeof $('.chaneg-user-role').length !== 'undefined') {
        $('.chaneg-user-role').click(function (ev) {
            $token = $(this).data('token');
            $user_id = $(this).data('id');
            $slug = $(this).data('slug');
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: swal_lang.change_role,
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "user/update_role",
                        type: "post",
                        data: {
                            '_token': $token,
                            'id': $user_id,
                            'role': $slug
                        },
                        success: function (response) {
                            //console.log(response);
                            if (response != true) {
                                toastr.error(toastr_lang.update_role_fail);
                            } else {
                                toastr.success(toastr_lang.update_success);
                                setInterval(function () { location.reload(); }, 3000);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }

                    });
                }
            });
        });

        if (typeof $('#user-list-table tbody').length !== 'undefined') {
            $('#user-list-table tbody').on('click', function () {
                $('.chaneg-user-role').click(function (ev) {
                    $token = $(this).data('token');
                    $user_id = $(this).data('id');
                    $slug = $(this).data('slug');
                    ev.preventDefault();
                    swal({
                        title: swal_lang.alert,
                        text: swal_lang.change_role,
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
                    }).then(function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "user/update_role",
                                type: "post",
                                data: {
                                    '_token': $token,
                                    'id': $user_id,
                                    'role': $slug
                                },
                                success: function (response) {
                                    ;
                                    if (response != true) {
                                        toastr.error(toastr_lang.update_role_fail);
                                    } else {
                                        toastr.success(toastr_lang.update_success);
                                        setInterval(function () { location.reload(); }, 3000);
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown);
                                }

                            });
                        }
                    });
                });
            });
        }
    }

    // serach user from ad
    if (typeof $('#search_room_email').length !== 'undefined') {
        $('#search_room_email').keyup(function () {
            if ($(this).val().length >= 3) {
                $.ajax({
                    "url": "https://ws.lanna.co.th/Ads/searchuser",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Content-Type": "application/json"
                    },
                    "data": JSON.stringify({ "username": $(this).val() }),
                }).done(function (response) {
                    //console.log(response);
                    $('#list_user_email').html('');
                    $.each(response, function (i, item) {
                        $list = '<option value="' + item.Email + '">';
                        $('#list_user_email').append($list)
                    });

                });
            }
        });
    }

    // disable room
    if (typeof $('.disable-room').length !== 'undefined') {
        $('.disable-room').click(function (ev) {
            $token = $(this).data('token');
            $room_id = $(this).data('id');
            $value = $(this).data('value');
            if ($value == true) {
                $text = swal_lang.disable_room;
            } else {
                $text = swal_lang.enable_room;
            }
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: $text,
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "room/disable",
                        type: "post",
                        data: {
                            '_token': $token,
                            'id': $room_id,
                            'disable': $value
                        },
                        success: function (response) {
                            if (response != true) {
                                toastr.error(toastr_lang.update_fail);
                            } else {
                                toastr.success(toastr_lang.update_success);
                                setInterval(function () { location.reload(); }, 3000);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }

                    });
                }
            });
        });
    }


    if (typeof $('#btn-add-room').length !== 'undefined') {
        $('#btn-add-room').click(function (ev) {
            $name = $('#name').val();
            $email = $('#search_room_email').val();
            $seat = $('#seat').val();
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: swal_lang.add_room,
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    if (!($name && $email && $seat)) {
                        swal({
                            title: swal_lang.caution,
                            text: swal_lang.fill_name_email_seat,
                            icon: 'error',
                        })
                    } else {
                        $("#create-new-room").submit();
                    }
                }
            });
        });
    };

    if (typeof $('#btn-edit-room').length !== 'undefined') {
        $('#btn-edit-room').click(function (ev) {
            $name = $('#name').val();
            $email = $('#search_room_email').val();
            $seat = $('#seat').val();
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: swal_lang.update_room,
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    if (!($name && $email && $seat)) {
                        swal({
                            title: swal_lang.caution,
                            text: swal_lang.fill_name_email_seat,
                            icon: 'error',
                        })
                    } else {
                        $("#update-room").submit();
                    }
                }
            });
        });
    };

    if (typeof $('#btn-add-building').length !== 'undefined') {
        $('#btn-add-building').click(function (ev) {
            $name = $('#name').val();
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: 'Are you sure that you want to add this building?',
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    if (!($name)) {
                        swal({
                            title: swal_lang.caution,
                            text: 'Please fill out name.',
                            icon: 'error',
                        })
                    } else {
                        $("#create-new-building").submit();
                    }
                }
            });
        });
    };

    if (typeof $('#btn-edit-building').length !== 'undefined') {
        $('#btn-edit-building').click(function (ev) {
            $name = $('#name').val();
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: 'Are you sure that you want to update this building?',
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    if (!($name)) {
                        swal({
                            title: swal_lang.caution,
                            text: 'Please fill out name.',
                            icon: 'error',
                        })
                    } else {
                        $("#update-building").submit();
                    }
                }
            });
        });
    };

    if (typeof $('#btn-add-roomtype').length !== 'undefined') {
        $('#btn-add-roomtype').click(function (ev) {
            $name = $('#name').val();
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: swal_lang.add_room_type,
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    if (!($name)) {
                        swal({
                            title: swal_lang.caution,
                            text: swal_lang.fill_name,
                            icon: 'error',
                        })
                    } else {
                        $("#create-new-roomtype").submit();
                    }
                }
            });
        });
    };

    if (typeof $('#btn-edit-roomtype').length !== 'undefined') {
        $('#btn-edit-roomtype').click(function (ev) {
            $name = $('#name').val();
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: swal_lang.update_room_type,
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    if (!($name)) {
                        swal({
                            title: swal_lang.caution,
                            text: swal_lang.fill_name,
                            icon: 'error',
                        })
                    } else {
                        $("#update-roomtype").submit();
                    }
                }
            });
        });
    };

    // if (typeof $('#create-new-config').length !== 'undefined') {
    //     $('#create-new-config').click(function () {
    //         $('#createEventModal3').modal({ backdrop: 'static', keyboard: false });
    //     });
    // }

    // if (typeof $('#btn-add-configs').length !== 'undefined') {
    //     $('#btn-add-configs').click(function (ev) {
    //         $names = $('#names').val();
    //         ev.preventDefault();
    //         swal({
    //             title: swal_lang.alert,
    //             text: 'Are you sure that you want to addd this configuration?',
    //             icon: 'warning',
    //             buttons: {
    //                 cancel: {
    //                     text: 'Cancel',
    //                     value: null,
    //                     visible: true,
    //                     className: 'btn btn-default',
    //                     closeModal: true,
    //                 },
    //                 confirm: {
    //                     text: swal_lang.confirm,
    //                     value: true,
    //                     visible: true,
    //                     className: 'btn btn-warning',
    //                     closeModal: true
    //                 }
    //             }
    //         }).then(function (isConfirm) {
    //             if (isConfirm) {
    //                 if (!($names)) {
    //                     swal({
    //                         title: swal_lang.caution,
    //                         text: 'Please fill out name.',
    //                         icon: 'error',
    //                     })
    //                 } else {
    //                     $("#btn-add-config").submit();
    //                 }
    //             }
    //         });
    //     });
    // };

    if (typeof $('#btn-edit-configs').length !== 'undefined') {
        $('#btn-edit-configs').click(function (ev) {
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: swal_lang.update_config,
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    $("#btn-edit-config").submit();
                }
            });
        });
    };

    if (typeof $('.cb-room-bookable').length !== 'undefined') {
        $('.cb-room-bookable').change(function () {
            var attr = $(this).attr('checked');
            var group = $(this).data('group');
            var room = $(this).data('room');
            var bookable;
            if (typeof attr !== 'undefined') {
                bookable = 0;
                $(this).removeAttr('checked');
            } else {
                bookable = 1;
                $(this).attr('checked', "");
            }

            $.ajax({
                url: "/backend/room/updateBookable",
                type: "post",
                data: {
                    '_token': $('#global_csrf').val(),
                    'group_id': group,
                    'room_id': room,
                    'bookable': bookable
                }
            }).done(function (response) {
                if (response == true) {
                    toastr.success(toastr_lang.update_success);
                } else {
                    toastr.error(toastr_lang.update_fail);
                }
            });
        });
    }




    if (typeof $('#btn-edit-notify').length !== 'undefined') {
        $('#btn-edit-notify').click(function (ev) {

            var data = {
                '_token': $('#global_csrf').val(),
                'id': $('#notify_id').val(),
                'name': $('#notify_name').val(),
                'unit': $('#notify_unit').val(),
                'value': $('#notify_value').val(),
                'active': ($('#notify_active').is(':checked')) ? 1 : 0
            }

            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: 'Are you sure that you want to edit this notification?',
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
            }).then(function (isConfirm) {
                if (isConfirm) {
                    if ($('#notify_id').val() == '') {
                        swal({
                            title: swal_lang.caution,
                            text: 'Please fill out name.',
                            icon: 'error',
                        })
                    } else {

                        $.ajax({
                            url: "notification/update",
                            type: "post",
                            data: data,
                            success: function (response) {
                                if (response == 'success') {

                                    $('#notifyModal').modal('hide');
                                    toastr.success(toastr_lang.update_success);
                                    setInterval(function () { location.reload(); }, 3000);

                                } else {
                                    toastr.error(response);
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }

                        });

                    }
                }
            });
        });
    };
});


function btn_edit_config(id, name, value, type, isdefault) {
    $('#setting-id').val(id);
    // $('#setting-name').val(name);
    //$('#setting-label').html(name);
    $('#setting-value').val(value);
    $('#settingModal').modal({ backdrop: 'static', keyboard: false });

}


function btn_edit_notify(id, name, value, unit, isdefault) {
    $('#notify_id').val(id);
    $('#notify_name').val(name);
    $('#notify_value').val(value);
    $('#notify_unit').val(unit);

    if (isdefault == 1) {
        $('#notify_active').attr('checked', true);
    } else {
        $('#notify_unactive').attr('checked', true);
    }




    $('#notifyModal').modal({ backdrop: 'static', keyboard: false });
}

function btn_reject_config(id) {
    $id = id;
    swal({
        title: swal_lang.alert,
        text: swal_lang.delete_config,
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
    }).then(function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: "setting/reject",
                type: "get",
                data: {
                    'id': $id,
                },
                success: function (response) {
                    if (typeof response.error !== 'undefined') {
                        toastr.error(response.error.message);
                    } else {
                        toastr.success(toastr_lang.delete_success);
                        setInterval(function () { location.reload(); }, 3000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }
    });
};

function btn_reject_building(id) {
    $id = id;
    swal({
        title: swal_lang.alert,
        text: 'Are you sure that you want to delete this building?',
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
    }).then(function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: "building/reject",
                type: "get",
                data: {
                    'id': $id,
                },
                success: function (response) {
                    if (typeof response.error !== 'undefined') {
                        toastr.error(response.error.message);
                    } else {
                        toastr.success(toastr_lang.delete_success);
                        setInterval(function () { location.reload(); }, 3000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }
    });
};

function btn_reject_room(id) {
    $id = id;
    swal({
        title: swal_lang.alert,
        text: swal_lang.delete_room,
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
    }).then(function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: "room/reject",
                type: "get",
                data: {
                    'id': $id,
                    'type': 'Reject'
                },
                success: function (response) {
                    if (typeof response.error !== 'undefined') {
                        toastr.error(response.error.message);
                    } else {
                        toastr.success(toastr_lang.delete_success);
                        setInterval(function () { location.reload(); }, 3000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }
    });
};

function btn_reject_roomtype(id, is_default) {
    $id = id;
    $isdefault = is_default;
    swal({
        title: swal_lang.alert,
        text: swal_lang.delete_room_type,
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
    }).then(function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: "room-type/reject",
                type: "get",
                data: {
                    'id': $id,
                },
                success: function (response) {
                    if (typeof response.error !== 'undefined') {
                        toastr.error(response.error.message);
                    } else {
                        toastr.success(toastr_lang.delete_success);
                        setInterval(function () { location.reload(); }, 3000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }
    });
};

function getRandomInt(max) {
    return Math.floor(Math.random() * Math.floor(max));
}

function getFormatDate(date) {
    var d = new Date(date);
    var custom_date = ("0" + d.getDate()).slice(-2);
    var custom_month = ("0" + (d.getMonth() + 1)).slice(-2);
    var custom_year = d.getFullYear().toString();
    var custom_hour = ("0" + (d.getHours() - 7)).slice(-2);
    var custom_minute = ("0" + d.getMinutes()).slice(-2);
    return custom_date + "/" + custom_month + "/" + custom_year + ' ' + custom_hour + ':' + custom_minute;
}

function convertPHPDate(date) {
    $datetime = date.split(' ');
    $date = $datetime[0].split('/');
    return $date[2] + '-' + $date[1] + '-' + $date[0] + ' ' + $datetime[1];
}


function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function ucwords(str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}




btnsubmitPost = () => {
    swal({
        title: swal_lang.alert,
        text: 'Are you sure that you want to add this data?',
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
    }).then(function (isConfirm) {
        if (isConfirm) {


            if ($('#history_types_id').val() != '' && $('#history_detail').val() != '') {
                var form = $('#animal-history')[0];
                var formData = new FormData(form);
                $.ajax({
                    url: xamppurl + 'animal/profile',
                    type: 'post',
                    data: formData,
                    success: function (data) {

                        if (data == "true") {
                            renderAnimalHistory($('#animal_id').val());
                            $('#history_detail').val('');
                            $("#history_types_id").find('option').attr("selected", false);
                            var drEvent = $('.dropify').dropify();
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();
                            $('#modalTimeline').modal('hide');
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                })
            } else {
                toastr.warning('Please input data');
            }

        }
    })
}


showAddtimeline = () => {
    $('#modalTimeline').modal('show');
}



removeHistory = (id) => {

    swal({
        title: swal_lang.alert,
        text: 'Are you sure that you want to delete this data?',
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
    }).then(function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: xamppurl + 'animal/deleteHistory/' + id,
                type: 'get',
                success: function (data) {
                    if (data == "true") {
                        renderAnimalHistory($('#animal_id').val());
                    }
                }
            })
        }
    });
}


renderAnimalHistory = (id) => {
    var html = '';
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    $.ajax({
        url: xamppurl + 'animal/timeline/' + id,
        type: 'get',
        success: function (data) {
            if (data != '' || data != []) {
                data.data.forEach((i, k) => {
                    var date = new Date(i.created_at);
                    html += '<li><div class="timeline-time">';
                    html += '<span class="date">' + date.getDate() + ' ' + months[date.getMonth()] + ' ' + date.getFullYear() + '</span>';
                    html += '<span class="time">' + date.getHours() + ':' + date.getMinutes() + '</span>';
                    html += '</div><div class="timeline-icon"><a href="javascript:;">&nbsp;</a></div>';
                    html += '<div class="timeline-body"><div class="timeline-header">';
                    html += '<span class="username">' + i.typeName + '</span>';


                    html += '<div class="media-body valign-middle text-right overflow-visible float-right">';
                    html += '<div class="btn-group btn-group-sm dropdown">';
                    html += '<a href="javascript:;" class="btn btn-default">Action</a>';
                    html += '<a href="#" data-toggle="dropdown" class="btn btn-default dropdown-toggle"><b class="caret"></b></a>';
                    html += '<div class="dropdown-menu dropdown-menu-right">';
                    html += '<a href="javascript:;" class="dropdown-item" onclick="editHistory(' + i.id + ', ' + i.history_types_id + ', \'' + i.detail + '\', \'' + i.image + '\')">Edit</a>';
                    html += '<div class="dropdown-divider"></div>';
                    html += '<a href="javascript:;" class="dropdown-item" onclick="removeHistory(' + i.id + ')">Delete</a>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';



                    html += '</div><div class="timeline-content">';
                    if (i.image != null) {
                        html += '<img src="/smartfarm-portal/public/img/animalHistory/' + i.image + '">';
                    }
                    html += '<p class="lead">' + i.detail + '</p>';
                    html += '</div></div></li>';
                });
                $('.timeline').html(html);
            }
        }
    })


}




editHistory = (id, type, detail, image) => {
    $('#history_edit_id').val(id);
    $("#history_types_id option[value='" + type + "']").attr("selected", "selected");
    $("#history_detail").val(detail);

    if (image != null && image != 'null') {
        $("#uploadImg").hide();
        $("#showImg").html("<div class='col-sm text-right p-0 m-0'><a href='javascript:;' onclick='delHistoryImg(" + id + ")' class='btn btn-xs btn-danger mb-2'>Delete Image</a></div><img width='100%' src='/smartfarm-portal/public/img/animalHistory/" + image + "'>");
        $("#showImg").show();
    } else {
        $("#uploadImg").show();
        $("#showImg").hide();
        // $(".dropify").attr("data-default-file", "/smartfarm-portal/public/img/animalHistory/" + image);
    }
    $('#modalTimeline').modal('show');
}





delHistoryImg = (id) => {

    swal({
        title: swal_lang.alert,
        text: 'Are you sure that you want to delete this image?',
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
    }).then(function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: xamppurl + 'animal/deleteHistoryImage/' + id,
                type: 'get',
                success: function (data) {
                    if (data == "true") {
                        $("#uploadImg").show();
                        $("#showImg").hide();
                        $("#showImg").html('');
                    }
                }
            })
        }
    });
}