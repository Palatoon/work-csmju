var session_dragable_item = [];
$(document).ready(function() {
    $('[ip-mask]').ipAddress();
    $('.ac').hide();
    $('.nonac').hide();

    if (typeof $('.js-example-basic-single').length !== 'undefined') {
        $('.js-example-basic-single').select2();
    }

    if (typeof $('#clear-filter').length !== 'undefined') {
        $('#clear-filter').click(function(ev) {
            $(this).closest('form').find("input[type=text]").val("");
            $(this).closest('form').find("input[type=checkbox]").attr("checked", false);
        });
    };

    if (typeof $('.enable-dragable').length !== 'undefined') {
        $('.enable-dragable').click(function(ev) {
            $('.dragable').addClass('dragable-item');
            $('.room-image-link').addClass('disabled');
            $.each($('.dragable-item'), function(index, value) {
                dragElement(document.getElementById($(this).attr('id')));
            });

            $('.enable-dragable').addClass('disable-dragable');
            $('.enable-dragable').html('<i class="fas fa-save mr-2"></i></i>Save')
            $('.disable-dragable').removeClass('enable-dragable');

            $('.disable-dragable').click(function(ev) {
                ev.preventDefault();
                swal({
                    title: 'Warning',
                    text: 'Are you sure you want to move this item ?',
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
                        $.each($('.dragable-item'), function(index, value) {
                            disableElement(document.getElementById($(this).attr('id')));
                        });
                        $('.dragable').removeClass('dragable-item');
                        $('.room-image-link').removeClass('disabled');
                        $('.disable-dragable').addClass('enable-dragable');
                        $('.disable-dragable').html('<i class="fas fa-hand-paper mr-2"></i>Move')
                        $('.enable-dragable').removeClass('disable-dragable');

                        var count = 0;

                        //console.log(session_dragable_item);

                        $.each(session_dragable_item, function(key, val) {
                            $.ajax({
                                url: val.url,
                                type: "post",
                                data: val,
                                success: function(response) {
                                    //console.log(response);
                                    if (response == true) {
                                        count++;
                                    }

                                    if (count == session_dragable_item.length) {
                                        toastr.success('Update successfully!');
                                        location.reload();
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown);
                                }
                            });
                        });
                    }
                });
            });
        });
    }

    // jstree
    if (typeof $('#jstree-default').length !== 'undefined') {
        $('#jstree-default').jstree({
            "core": {
                "themes": {
                    "responsive": false,
                }
            },
            "types": {
                "default": {
                    "icon": "fa fa-building text-warning fa-lg"
                },
                "area": {
                    "icon": "fas fa-layer-group text-info fa-lg"
                },
                "room": {
                    "icon": "fas fa-door-closed text-black fa-lg"
                }
            },
            "plugins": [
                "types",
                "search",
                //"checkbox",
                "wholerow"
            ],
            "search": {
                "show_only_matches": true,
                "show_only_matches_children": true
            }
        });


        $('#search-room-input').on("keyup change", function() {
            $('#jstree-default').jstree(true).search($(this).val())
        });

        $('#jstree-default').on('select_node.jstree', function(e, data) {
            var link = $('#' + data.selected).find('a');
            if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
                if (link.attr("target") == "_blank") {
                    link.attr("href").target = "_blank";
                }
                document.location.href = link.attr("href");
                return false;
            }
        });
    }

    // summernote
    if (typeof $('.summernote').length !== 'undefined') {
        $('.summernote').summernote({
            placeholder: '',
            height: 200,
            focus: false,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview']],
            ],
            oninit: function() {
                var noteBtn = '<button id="makeSnote" type="button" class="btn btn-default btn-sm btn-small" title="Identify a music note" data-event="something" tabindex="-1"><i class="fa fa-music"></i></button>';
                var fileGroup = '<div class="note-file btn-group">' + noteBtn + '</div>';
                $(fileGroup).appendTo($('.note-toolbar'));

                $('#makeSnote').tooltip({ container: 'body', placement: 'bottom' });

                $('#makeSnote').click(function(event) {
                    var highlight = window.getSelection(),
                        spn = document.createElement('span'),
                        range = highlight.getRangeAt(0)

                    spn.innerHTML = highlight;
                    spn.className = 'snote';
                    spn.style.color = 'blue';

                    range.deleteContents();
                    range.insertNode(spn);
                });
            },

        });
    }

    if (typeof $('#gotohistory').length !== 'undefined') {
        $history = history.length;
        if ($history == 1) {
            $('#gotohistory').addClass('hide')

        } else {
            $('#gotohistory').click(function() {
                window.history.back();
            })
        }
    }

    // if (typeof $('.plan-area').length !== 'undefined' && typeof floor_plan !== 'undefined') {
    //     $('.plan-area').css("width", $('#plan-image').width() + 'px');

    //     var id = $('.plan-area').data('id');
    //     var model = $('.plan-area').data('model');
    //     setInterval(function() {
    //         $.ajax({
    //             url: "/backend/device/getStatus",
    //             type: "post",
    //             data: {
    //                 '_token': $('#global_csrf').val(),
    //                 'id': id,
    //                 'model': model
    //             },
    //             beforeSend: function() {
    //                 $('.device--icon').html('<span class="mdi mdi-loading" style="font-size:2.5rem;"></span>');
    //             },
    //             success: function(response) {
    //                 console.log(response);
    //                 $.each(response, function(key, val) {
    //                     var color = '';
    //                     if (val.icon_color != "null") {
    //                         color += 'color:' + val.icon_color + ';';

    //                     }
    //                     var icon = '<span class="mdi mdi-' + val.icon + '" style="font-size:2.8rem;' + color + '"></span>'
    //                         // var status = '<span style="font-size:0.5vw;">' + val.status_value + '</span><br />' +
    //                         //     '<i style="font-size:0.5vw;">' + val.status_time + '</i>';
    //                     $('.device-' + val.id + '-icon').html(icon);
    //                     //$('.device-' + val.id + '-status').html(status);
    //                     if (val.status_value != "null") {
    //                         var stt = '<span style="font-size:0.5vw;position:relative;top:-15px;">' + val.status_value + '</span>';
    //                         //<br /><i style="font-size:0.5vw;"></i> ' + val.status_time;
    //                         $('.device-' + val.id + '-status').html(stt);
    //                     }
    //                 });
    //             },
    //             error: function(jqXHR, textStatus, errorThrown) {
    //                 //console.log(textStatus, errorThrown);
    //             }

    //         });
    //     }, 30000);
    // }

    if (typeof $('.item-on-off').length !== 'undefined') {
        $('.item-on-off').dblclick(function() {
            var id = $(this).data('item-id');
            var status = $(this).data('item-status');
            $.ajax({
                url: "/backend/device/switchStatus",
                type: "post",
                data: {
                    '_token': $('#global_csrf').val(),
                    'id': id,
                    'status': status
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        });
    }

    if (typeof $('#condition-device-select').length !== 'undefined') {
        $('#condition-device-select').on('change', function() {
            var device_id = $(this).val();
            if (device_id.length > 0) {

                $.ajax({
                    url: "/backend/condition/getDeviceCommand",
                    type: "post",
                    data: {
                        '_token': $('#global_csrf').val(),
                        'id': device_id,
                    }
                }).done(function(response) {
                    if (response.length > 0) {
                        $('#condition-command-select').find('option').remove().end()
                            .append('<option selected value="">Select</option>');
                        $.each(response, function(key, val) {
                            $('#condition-command-select').append('<option value="' + val.id + '">' + val.command_name + '</option>');
                        });
                    }
                });
            }
        });
    }

    if (typeof $('#condition-building-select').length !== 'undefined') {
        $('#condition-building-select').on('change', function() {
            $('#condition-device-select').find('option').remove().end()
                .append('<option selected value="">Select</option>');
            var building_id = $(this).val();
            if (building_id.length > 0) {
                $.ajax({
                    url: "/backend/condition/getdevicebylocation",
                    type: "post",
                    data: {
                        '_token': $('#global_csrf').val(),
                        'id': building_id,
                        'location': 'building'
                    },
                }).done(function(response) {
                    if (response.length > 0) {
                        $.each(response, function(key, val) {
                            $('#condition-device-select').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                    }
                });
            }
        });
    }

    if (typeof $('#condition-area-select').length !== 'undefined') {
        $('#condition-area-select').on('change', function() {
            $('#condition-device-select').find('option').remove().end()
                .append('<option selected value="">Select</option>');
            var area_id = $(this).val();
            if (area_id.length > 0) {
                $.ajax({
                    url: "/backend/condition/getdevicebylocation",
                    type: "post",
                    data: {
                        '_token': $('#global_csrf').val(),
                        'id': area_id,
                        'location': 'area'
                    },
                }).done(function(response) {
                    if (response.length > 0) {
                        $.each(response, function(key, val) {
                            $('#condition-device-select').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                    }
                });
            }
        });
    }

    if (typeof $('#condition-room-select').length !== 'undefined') {
        $('#condition-room-select').on('change', function() {
            $('#condition-device-select').find('option').remove().end()
                .append('<option selected value="">Select</option>');
            var room_id = $(this).val();
            if (room_id.length > 0) {
                $.ajax({
                    url: "/backend/condition/getdevicebylocation",
                    type: "post",
                    data: {
                        '_token': $('#global_csrf').val(),
                        'id': room_id,
                        'location': 'room'
                    },
                }).done(function(response) {
                    if (response.length > 0) {
                        $.each(response, function(key, val) {
                            $('#condition-device-select').append('<option value="' + val.id + '">' + val.name + '</option>');
                        });
                    }
                });
            }
        });
    }

    $('input[type=radio][name=active_location]').change(function() {
        $('#condition-device-select').find('option').remove().end()
            .append('<option selected value="">Select</option>');
        $.ajax({
            url: "/backend/condition/getdevicebylocation",
            type: "post",
            data: {
                '_token': $('#global_csrf').val(),
                'id': $('#condition-' + this.value + '-select').children("option:selected").val(),
                'location': this.value
            },
        }).done(function(response) {
            if (response.length > 0) {
                $.each(response, function(key, val) {
                    $('#condition-device-select').append('<option value="' + val.id + '">' + val.name + '</option>');
                });
            }
        });
    });

    if (typeof $('.active-condition').length !== 'undefined') {
        $('.active-condition').click(function(ev) {
            $token = $(this).data('token');
            $room_id = $(this).data('id');
            $value = $(this).data('value');
            if ($value == true) {
                $text = "Are you sure that you want to activate this condition?";
            } else {
                $text = "Are you sure that you want to activate this condition?";
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
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "/backend/condition/active",
                        type: "post",
                        data: {
                            '_token': $token,
                            'id': $room_id,
                            'is_active': $value
                        },
                        success: function(response) {
                            if (response != true) {
                                toastr.error(toastr_lang.update_fail);
                            } else {
                                toastr.success(toastr_lang.update_success);
                                setInterval(function() { location.reload(); }, 3000);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }

                    });
                }
            });
        });
    }
    if (typeof $('#device-type-status-icon-color').length !== 'undefined') {
        $('#device-type-status-icon-color').colorpicker({ format: 'hex' });
    }

    if (typeof $('.license-active').length !== 'undefined') {
        $('.license-active').click(function() {
            var status;
            var old_status;
            var text;
            var chk = $(this);
            var room_id = chk.data('id');
            if (!$(this).is(':checked')) {
                status = false;
                old_status = true;
                text = "Are you sure that you want to deactivate this room?";
            } else {
                status = true;
                old_status = false;
                text = "Are you sure that you want to activate this room?";
            }
            swal({
                title: swal_lang.alert,
                text: text,
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
                    $.ajax({
                        url: "/backend/room/update_license",
                        type: "post",
                        data: {
                            '_token': $('#global_csrf').val(),
                            'id': room_id,
                            'active_license': status
                        },
                        success: function(response) {
                            console.log(response);
                            if (response != true) {
                                if (response == 999) {
                                    toastr.warning("License limit exceeded.");
                                } else {
                                    toastr.error(toastr_lang.update_fail);
                                }

                                if (old_status == true) {
                                    chk.prop('checked', true);
                                } else {
                                    chk.removeAttr('checked');
                                }
                            } else {
                                toastr.success(toastr_lang.update_success);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }

                    });
                } else {
                    if (old_status == true) {
                        chk.prop('checked', true);
                    } else {
                        chk.removeAttr('checked');
                    }
                }
            });
        });
    }

});

function dragElement(elmnt) {
    var pos1 = 0,
        pos2 = 0,
        pos3 = 0,
        pos4 = 0;
    if (document.getElementById(elmnt.id + "header")) {
        // if present, the header is where you move the DIV from:
        document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
    } else {
        // otherwise, move the DIV from anywhere inside the DIV:
        elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        var top = elmnt.offsetTop - pos2;
        var left = elmnt.offsetLeft - pos1;
        elmnt.style.top = top + "px";
        elmnt.style.left = left + "px";
        var model = elmnt.getAttribute("data-model");
        var url = "/backend/" + model + "/item-position";
        let w = $('.plan-area').width();
        let h = $('.plan-area').height();
        if (top >= h) {
            top = h - 50;
            top = (top * 100) / h;
        }
        top = (top * 100) / h;
        if (top <= 0) {
            top = 0;
        }
        if (left >= w) {
            left = w - 50;
            left = (left * 100) / w;
        }
        left = (left * 100) / w;
        if (left <= 0) {
            left = 0;
        }
        let data = {
            '_token': $('meta[name=csrf-token]').attr('content'),
            'item_id': elmnt.getAttribute("data-item-id"),
            'item_type': elmnt.getAttribute("data-item-type"),
            'x': parseInt(top),
            'y': parseInt(left),
            'url': url
        };

        $.each(session_dragable_item, function(key, val) {
            if (val.item_id == data.item_id) {
                session_dragable_item.splice(key, 1);
            }
        });
        session_dragable_item.push(data);
    }

    function closeDragElement() {
        // stop moving when mouse button is released:
        document.onmouseup = null;
        document.onmousemove = null;
    }
}

function disableElement(elmnt) {
    if (document.getElementById(elmnt.id + "header")) {
        document.getElementById(elmnt.id + "header").onmousedown = false;

    } else {
        elmnt.onmousedown = false;
    }
}