$(document).ready(function() {

    var participants = [];

    // create booking
    if (typeof $('#create-new-booking').length !== 'undefined') {
        $('#create-new-booking').click(function(ev) {
            $token = $(this).data('token');
            ev.preventDefault();
            if ($('#booking_id').val().length > 0) {
                $text = swal_lang.update_booking;
            } else {
                $text = swal_lang.booking_room;
            }
            if ($('#create-new-booking-form').valid()) {
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
                            className: 'btn btn-info',
                            closeModal: true
                        }
                    }
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "/getConfig",
                            type: "get",
                            success: function(response1) {
                                //console.log(response1);
                                session_booking_hour_max = response1.booking_hour_max;
                                session_booking_hour_min = response1.booking_hour_min;
                                session_booking_ahead_day = response1.booking_ahead_day;
                                session_booking_per_week = response1.booking_per_week;
                                session_booking_per_day = response1.booking_per_day;
                                session_after_using_end = response1.after_using_end;

                                var st = $('#datepicker-start').val();
                                var bt = $('#datepicker-end').val();
                                if (st.indexOf("00:00") >= 0) {
                                    st.replace("00:00", "24:00");
                                }
                                if (bt.indexOf("00:00") >= 0) {
                                    bt.replace("00:00", "24:00");
                                }
                                var time_checker = moment(new Date(), "DD/MM/YYYY HH:mm");
                                var a = moment(st, "DD/MM/YYYY HH:mm");
                                var b = moment(bt, "DD/MM/YYYY HH:mm");
                                var c = b.diff(a, 'hours');
                                if (time_checker > a) {
                                    toastr.warning(toastr_lang.elapsed_period);
                                } else {
                                    // -------------- get attendee -----------------
                                    var p_list = [];
                                    var uniqueNames = [];
                                    $('.tagit-label').each(function() {
                                        p_list.push($(this).html());
                                    });

                                    $.each(p_list, function(i, el) {
                                        if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                                    });
                                    p_list = uniqueNames;
                                    var p_arr = '{"participant": [';
                                    var email_check = 0;
                                    $.each(p_list, function(i, el) {
                                        var email = '';
                                        var name = '';
                                        if (el.indexOf('[') > -1) {
                                            email = el.substring(
                                                el.lastIndexOf("[") + 1,
                                                el.lastIndexOf("]")
                                            );
                                            name = el.split(' [')[0];
                                        } else {
                                            email = el;
                                        }
                                        var isLastElement = i == p_list.length - 1;
                                        if (isLastElement) {
                                            p_arr += '{"name": "' + name + '", "email": "' + email + '"}';
                                        } else {
                                            p_arr += '{"name": "' + name + '", "email": "' + email + '"},';
                                        }

                                        if (!isEmail(email)) {
                                            email_check++;
                                        }
                                    });
                                    p_arr += ']}';

                                    if (email_check > 0) {
                                        toastr.error(toastr_lang.email_format_incorrect);
                                    } else {
                                        $('#participant-list').val(p_arr);
                                        // -------------- get attendee -----------------

                                        if (a > b) {
                                            toastr.warning(toastr_lang.wrong_time);
                                        } else {
                                            if (c > session_booking_hour_max) {
                                                toastr.warning(toastr_lang.qouta_max_hour.replace("#x#", session_booking_hour_max));
                                            } else if (c < session_booking_hour_min) {
                                                toastr.warning(toastr_lang.qouta_min_hour.replace("#x#", session_booking_hour_min));
                                            } else {
                                                var sb = moment(a).format("YYYY-MM-DD HH:mm");
                                                var eb = moment(b).format("YYYY-MM-DD HH:mm");
                                                $.ajax({
                                                    url: "/checkQuota",
                                                    type: "post",
                                                    data: {
                                                        '_token': $('#global_csrf').val(),
                                                        'start': sb,
                                                        'end': eb
                                                    },
                                                    success: function(response2) {
                                                        if (response2.booking_per_week >= session_booking_per_week && $('#booking_id').val().length == 0) {
                                                            toastr.warning(toastr_lang.qouta_time_a_week.replace("#x#", session_booking_per_week));
                                                        } else if (response2.booking_per_day >= session_booking_per_day && $('#booking_id').val().length == 0) {
                                                            toastr.warning(toastr_lang.qouta_time_a_day.replace("#x#", session_booking_per_day));
                                                        } else {
                                                            if ($('#booking_id').val().length > 0) {
                                                                var data = {
                                                                    '_token': $('#global_csrf').val(),
                                                                    'start': sb,
                                                                    'end': eb,
                                                                    'room_id': $('#room_id').val(),
                                                                    'booking_id': $('#booking_id').val()
                                                                };
                                                            } else {
                                                                var data = {
                                                                    '_token': $('#global_csrf').val(),
                                                                    'start': sb,
                                                                    'end': eb,
                                                                    'room_id': $('#room_id').val(),
                                                                };
                                                            }
                                                            $.ajax({
                                                                url: "/checkRoomBookable",
                                                                type: "post",
                                                                data: data,
                                                                success: function(response3) {
                                                                    //console.log(response3)
                                                                    if (response3.result == false) {
                                                                        switch (response3.type) {
                                                                            case 'duplicate':
                                                                                toastr.warning(toastr_lang.qouta_dup_booking.replace("#x#", session_after_using_end));
                                                                                break;
                                                                            case 'time':
                                                                                toastr.warning(toastr_lang.qouta_dup_self.replace("#x#", session_after_using_end));
                                                                                break;
                                                                            case 'group':
                                                                                toastr.warning(toastr_lang.qouta_not_in_group.replace("#x#", session_after_using_end));
                                                                                break;
                                                                        }
                                                                    } else {
                                                                        $("#create-new-booking-form").submit();
                                                                    }
                                                                },
                                                                error: function(jqXHR, textStatus, errorThrown) {
                                                                    console.log(textStatus, errorThrown);
                                                                }

                                                            });
                                                        }
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                        console.log(textStatus, errorThrown);
                                                    }

                                                });
                                            }
                                        }
                                    }
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        });
                    }
                });
            }
        });
    }

    // approve request
    if (typeof $('.btn-request-approve').length !== 'undefined') {
        $('.btn-request-approve').click(function(ev) {
            $token = $(this).data('token');
            $booking_id = $(this).data('id');
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: swal_lang.approve_booking,
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
                        url: "booking-request/action",
                        type: "post",
                        data: {
                            '_token': $token,
                            'id': $booking_id,
                            'type': 1
                        },
                        success: function(response) {
                            //console.log(response);
                            if (typeof response.error !== 'undefined') {
                                toastr.error(response.error.message);
                            } else {
                                toastr.success(toastr_lang.booking_approved);
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

    // reject reason
    if (typeof $('#btn-reject-reason').length !== 'undefined') {
        $('#btn-reject-reason').click(function() {
            $token = $(this).data('token');
            $booking_id = $(this).data('booking_id');
            $type = $(this).data('type');
            $reason = $('#reason').val();
            swal({
                title: swal_lang.alert,
                text: swal_lang.reject_booking,
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
                        closeModal: 0
                    }
                }
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "booking-request/action",
                        type: "post",
                        data: {
                            '_token': $token,
                            'id': $booking_id,
                            'reason': $reason,
                            'type': $type
                        },
                        success: function(response) {
                            //console.log(response);
                            if (response != true) {
                                toastr.error(toastr_lang.refuse_fail);
                            } else {
                                toastr.success(toastr_lang.decline_success);
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

    // reject request
    if (typeof $('.btn-request-reject').length !== 'undefined') {
        $('.btn-request-reject').click(function(ev) {
            $token = $(this).data('token');
            $booking_id = $(this).data('id');
            $('#btn-reject-reason').data('token', $token);
            $('#btn-reject-reason').data('booking_id', $booking_id);
            $('#btn-reject-reason').data('type', 0);
            $('#rejectRequestModal').modal('show');
            ev.preventDefault();
        });
    }

    // cancel update
    if (typeof $('.btn-request-cancel').length !== 'undefined') {
        $('.btn-request-cancel').click(function(ev) {
            $token = $(this).data('token');
            $booking_id = $(this).data('id');
            $('#btn-reject-reason').data('token', $token);
            $('#btn-reject-reason').data('booking_id', $booking_id);
            $('#btn-reject-reason').data('type', 5);
            $('#rejectRequestModal').modal('show');
            ev.preventDefault();
        });
    }

    // approve update
    if (typeof $('.btn-request-update').length !== 'undefined') {
        $('.btn-request-update').click(function(ev) {
            $token = $(this).data('token');
            $booking_id = $(this).data('id');
            ev.preventDefault();
            swal({
                title: swal_lang.alert,
                text: swal_lang.approve_booking,
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
                        url: "booking-request/action",
                        type: "post",
                        data: {
                            '_token': $token,
                            'id': $booking_id,
                            'type': 4
                        },
                        success: function(response) {
                            //console.log(response);
                            if (typeof response.error !== 'undefined') {
                                toastr.error(response.error.message);
                            } else {
                                toastr.success(toastr_lang.booking_approved);
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

    // booker cancel booking
    if (typeof $('#cancel-booking-btn').length !== 'undefined') {
        $('#cancel-booking-btn').click(function(ev) {
            $token = $(this).data('token');
            $booking_id = $(this).data('id');
            var st = $('#datepicker-start').val();
            if (st.indexOf("00:00") >= 0) {
                st.replace("00:00", "24:00");
            }
            var time_checker = moment(new Date(), "DD/MM/YYYY HH:mm");
            var a = moment(st, "DD/MM/YYYY HH:mm");
            if (time_checker > a) {
                toastr.warning(toastr_lang.elapsed_period);
            } else {
                ev.preventDefault();
                swal({
                    title: swal_lang.alert,
                    text: swal_lang.cancel_booking,
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
                            closeModal: 0
                        }
                    }
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "/backend/booking-request/action",
                            type: "post",
                            data: {
                                '_token': $token,
                                'id': $booking_id,
                                'type': 3
                            },
                            success: function(response) {
                                //console.log(response);
                                if (response != true) {
                                    toastr.error(toastr_lang.cancel_fail);
                                } else {
                                    toastr.success(toastr_lang.cancel_success);
                                    setInterval(function() { location.reload(); }, 3000);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }

                        });
                    }
                });
            }
        });
    }

    if (typeof $('#search-participant').length !== 'undefined') {
        $("#search-participant").on('keyup', function(e) {
            var search_text = $(this).val();
            var participants = [];
            $('.tagit-label').each(function() {
                participants.push($(this).html());
            });

            $.ajax({
                url: "/getConfig",
                type: "get",
                success: function(response1) {
                    session_max_participant = response1.max_participant;
                    session_booking_per_week = response1.booking_per_week;
                    session_booking_per_day = response1.booking_per_day;
                    var min = session_max_participant - 1;

                    if (participants.length >= min) {
                        $('#jquery-tagIt-participant').attr('disabled', true);
                        $('#add_participant').attr('disabled', true);
                        toastr.warning(toastr_lang.qouta_participant.replace("#x#", session_max_participant));
                    } else {
                        $('#jquery-tagIt-participant').attr('disabled', false);
                        $('#add_participant').attr('disabled', false);
                        if (search_text.length >= 3) {
                            $.ajax({
                                "url": "https://ws.lanna.co.th/Ads/searchuser",
                                "method": "POST",
                                "timeout": 0,
                                "headers": {
                                    "Content-Type": "application/json"
                                },
                                "data": JSON.stringify({
                                    "username": search_text
                                }),
                            }).done(function(response) {
                                $('#list_participant').html('');
                                $.each(response, function(i, item) {
                                    $list = '<option value="' + item.FullName + " [" + item.Email + ']">';
                                    $('#list_participant').append($list)
                                });
                            });
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('#add_participant').click(function(ev) {

            var search = $('#search-participant').val();
            var email = search.substring(
                search.lastIndexOf("[") + 1,
                search.lastIndexOf("]")
            );
            if (email.length > 0 && isEmail(email)) {
                $.ajax({
                    url: "/getConfig",
                    type: "get",
                    success: function(response1) {
                        session_booking_per_week = response1.booking_per_week;
                        session_booking_per_day = response1.booking_per_day;

                        var st = $('#datepicker-start').val();
                        var bt = $('#datepicker-end').val();
                        if (st.indexOf("00:00") >= 0) {
                            st.replace("00:00", "24:00");
                        }
                        if (bt.indexOf("00:00") >= 0) {
                            bt.replace("00:00", "24:00");
                        }
                        var a = moment(st, "DD/MM/YYYY HH:mm");
                        var b = moment(bt, "DD/MM/YYYY HH:mm");
                        var sb = moment(a).format("YYYY-MM-DD HH:mm");
                        var eb = moment(b).format("YYYY-MM-DD HH:mm");

                        $.ajax({
                            url: "/checkQuota",
                            type: "post",
                            data: {
                                '_token': $('#global_csrf').val(),
                                'start': sb,
                                'end': eb,
                                'email': email
                            },
                            success: function(response2) {
                                if (response2.booking_per_week >= session_booking_per_week) {
                                    toastr.warning(toastr_lang.qouta_time_a_week_user.replace("#x#", session_booking_per_week));
                                    return false;
                                } else if (response2.booking_per_day >= session_booking_per_day) {
                                    toastr.warning(toastr_lang.qouta_time_a_day_user.replace("#x#", session_booking_per_day));
                                    return false;
                                } else {
                                    var participants = [];

                                    $('.tagit-label').each(function() {
                                        participants.push($(this).html());
                                    });

                                    if (email != session_login_email && participants.includes(search) == false) {
                                        participants.push(search);
                                    } else {
                                        toastr.warning("คุณเป็นผู้เข้าร่วมอยู่แล้ว");
                                    }

                                    if (participants.length > 0) {
                                        $('#jquery-tagIt-participant').tagit("removeAll");
                                        $.each(participants, function(x, y) {
                                            var list = '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-editable">' +
                                                '<span class="tagit-label">' + y + '</span>' +
                                                '<a class="tagit-close" data-email="' + y + '"><span class="text-icon">×</span>' +
                                                '<span class="ui-icon ui-icon-close"></span></a></li>';

                                            $('#jquery-tagIt-participant').prepend(list);

                                            $('.tagit-close').click(function(ev) {
                                                this.closest('li').remove();
                                                $('#add_participant').attr('disabled', false);
                                            });
                                        });
                                    }
                                    $('#search-participant').val('');
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }

                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            } else {
                toastr.error(toastr_lang.email_format_incorrect);
            }
        });
    }

    // attendee tagit
    if (typeof $('#jquery-tagIt-participant').length !== 'undefined') {
        $('#jquery-tagIt-participant').tagit({
            allowDuplicates: false,
            removeConfirmation: true,
            editOnClick: true,
            triggerKeys: ['enter'],
            beforeTagAdded: function(event, ui) {
                $.ajax({
                    url: "/getConfig",
                    type: "get",
                    success: function(response1) {
                        session_max_participant = response1.max_participant;
                        session_booking_per_week = response1.booking_per_week;
                        session_booking_per_day = response1.booking_per_day;
                        var pcount = 0;
                        var val = ui.tagLabel;
                        $('.tagit-label').each(function() {
                            pcount++
                        });

                        if (!isEmail(val)) {
                            toastr.error(toastr_lang.email_format_incorrect);
                            return false;
                        } else if (val == session_login_email) {
                            toastr.warning("คุณเป็นผู้เข้าร่วมอยู่แล้ว");
                            return false;
                        } else {

                            if (pcount < session_max_participant) {
                                if (!isEmail(val)) {
                                    toastr.error(toastr_lang.email_format_incorrect);
                                    return false;
                                } else {

                                    var st = $('#datepicker-start').val();
                                    var bt = $('#datepicker-end').val();
                                    if (st.indexOf("00:00") >= 0) {
                                        st.replace("00:00", "24:00");
                                    }
                                    if (bt.indexOf("00:00") >= 0) {
                                        bt.replace("00:00", "24:00");
                                    }
                                    var a = moment(st, "DD/MM/YYYY HH:mm");
                                    var b = moment(bt, "DD/MM/YYYY HH:mm");
                                    var sb = moment(a).format("YYYY-MM-DD HH:mm");
                                    var eb = moment(b).format("YYYY-MM-DD HH:mm");

                                    $.ajax({
                                        url: "/checkQuota",
                                        type: "post",
                                        data: {
                                            '_token': $('#global_csrf').val(),
                                            'start': sb,
                                            'end': eb,
                                            'email': val
                                        },
                                        success: function(response2) {
                                            if (response2.booking_per_week >= session_booking_per_week) {
                                                $('.tagit-label').each(function() {
                                                    if ($(this).html() == val) {
                                                        $(this).parent().find('.ui-icon-close').trigger('click');
                                                    }
                                                });
                                                toastr.warning(toastr_lang.qouta_time_a_week_user.replace("#x#", session_booking_per_week));
                                                return false;
                                            } else if (response2.booking_per_day >= session_booking_per_day) {
                                                $('.tagit-label').each(function() {
                                                    if ($(this).html() == val) {
                                                        $(this).parent().find('.ui-icon-close').trigger('click');
                                                    }
                                                });
                                                toastr.warning(toastr_lang.qouta_time_a_day_user.replace("#x#", session_booking_per_day));
                                                return false;
                                            } else {
                                                if (session_max_participant - pcount == 1) {
                                                    $('#add_participant').attr('disabled', true);
                                                } else {
                                                    $('#add_participant').attr('disabled', false);
                                                }
                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            console.log(textStatus, errorThrown);
                                            $('.tagit-label').each(function() {
                                                if ($(this).html() == val) {
                                                    $(this).parent().find('.ui-icon-close').trigger('click');
                                                }
                                            });
                                            return false;
                                        }

                                    });

                                }
                            } else {
                                $('.tagit-label').each(function() {
                                    if ($(this).html() == val) {
                                        $(this).parent().find('.ui-icon-close').trigger('click');
                                    }
                                });
                                $('#add_participant').attr('disabled', true);
                                toastr.warning(toastr_lang.qouta_participant.replace("#x#", session_max_participant));
                                return false;
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        $('.tagit-label').each(function() {
                            if ($(this).html() == val) {
                                $(this).parent().find('.ui-icon-close').trigger('click');
                            }
                        });
                        return false;
                    }
                });
            },
            focus: function() {
                return false;
            },

        });
    }

});

function approve(status) {
    if (status == true) {
        $("#approver").val("");
        $("#approver").select2().trigger('change');
    }
    $("#approver").attr("disabled", status);
}