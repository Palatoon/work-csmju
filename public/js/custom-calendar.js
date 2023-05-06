$(document).ready(function() {

    if (typeof $('#calendar').length !== 'undefined') {
        $('#multiple-calendar-control').addClass('hide');
        $('#calendar').fullCalendar({
            locale: lang,
            timeFormat: 'HH:mm',
            slotLabelFormat: 'HH:mm',
            timeZone: 'Asia/Bangkok',
            defaultView: 'agendaWeek',
            header: {
                left: 'agendaWeek,agendaDay',
                center: 'title',
                right: 'prev,today,next'
            },
            firstDay: 1,
            disableResizing: true,
            editable: false,
            nowIndicator: true,
            eventLimit: true,
            events: [],
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                $.ajax({
                    url: "/getConfig",
                    type: "get",
                    success: function(response1) {
                        session_max_participant = response1.max_participant;
                        session_booking_hour_max = response1.booking_hour_max;
                        session_booking_hour_min = response1.booking_hour_min;
                        session_booking_ahead_day = response1.booking_ahead_day;
                        session_booking_per_week = response1.booking_per_week;
                        session_booking_per_day = response1.booking_per_day;
                        var sb = moment(start).format("YYYY-MM-DD HH:mm");
                        var eb = moment(end).format("YYYY-MM-DD HH:mm");
                        $.ajax({
                            url: "/checkQuota",
                            type: "post",
                            data: {
                                '_token': $('#global_csrf').val(),
                                'start': sb,
                                'end': eb
                            },
                            success: function(response2) {
                                if (response2.booking_per_week >= session_booking_per_week) {
                                    toastr.warning(toastr_lang.qouta_time_a_week.replace("#x#", session_booking_per_week));
                                } else if (response2.booking_per_day >= session_booking_per_day) {
                                    toastr.warning(toastr_lang.qouta_time_a_day.replace("#x#", session_booking_per_day));
                                } else {
                                    $.ajax({
                                        url: "/backend/room/getRoomSeat",
                                        type: "post",
                                        data: {
                                            '_token': $('#token').val(),
                                            'room_id': main_room.id
                                        },
                                        success: function(response3) {
                                            session_max_participant = response3.seat - 1;
                                            var a = moment(start, "DD/MM/YYYY HH:mm");
                                            var b = moment(end, "DD/MM/YYYY HH:mm");
                                            var c = b.diff(a, 'hours');
                                            if (c > session_booking_hour_max) {
                                                toastr.warning(toastr_lang.qouta_max_hour.replace("#x#", session_booking_hour_max));
                                            } else if (c < session_booking_hour_min) {
                                                toastr.warning(toastr_lang.qouta_min_hour.replace("#x#", session_booking_hour_min));
                                            } else {
                                                $('#jquery-tagIt-participant').tagit("removeAll");
                                                $('#booking_id').val('');
                                                $('#search-participant').val('');
                                                $('#modal-size').removeClass('modal-xl').addClass('modal-lg');
                                                $('#dashboard-calendar-area').addClass('hide').removeClass('col-md-4');
                                                $('#booking-calendar-area').addClass('col-md-12').removeClass('col-md-8');
                                                var view = $('#calendar').fullCalendar('getView');
                                                if (view.name == 'agendaDay' || view.name == 'agendaWeek') {
                                                    if (moment(moment.utc(start).subtract('7', 'hours').toDate()).isBefore(moment())) {
                                                        $('#calendar').fullCalendar('unselect');
                                                        toastr.warning(toastr_lang.elapsed_period);
                                                        return false;
                                                    } else {
                                                        var currday = new Date;
                                                        var bookable = new Date(currday.setDate(currday.getDate() + parseInt(session_booking_ahead_day)));
                                                        var start_date = moment.utc(start).subtract('7', 'hours').toDate();
                                                        bookable.setHours(23, 59, 59, 59);
                                                        if (start_date <= bookable) {
                                                            $('#cancel-booking-btn').addClass('hide');
                                                            $('#cancel-booking-btn').attr('data-id', '');
                                                            $('#room_id').val(main_room.id);
                                                            $('#room_name').val(main_room.name);
                                                            $('#datepicker-start').val(moment(start).format('DD/MM/YYYY HH:mm'));
                                                            $('#datepicker-end').val(moment(end).format('DD/MM/YYYY HH:mm'));
                                                            $('#createEventModal').modal({ backdrop: 'static', keyboard: false });
                                                        } else {
                                                            toastr.warning(toastr_lang.qouta_day_advance.replace("#x#", session_booking_ahead_day));
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
            },
            selectOverlap: function(event) {
                toastr.warning(toastr_lang.qouta_dup_other);
            },
            eventMouseover: function(calEvent, jsEvent) {
                var durationTime = moment(calEvent.start).format('HH') + ":" + moment(calEvent.start).format('mm') + " - " + moment(calEvent.end).format('HH') + ":" + moment(calEvent.end).format('mm');
                var tooltip = '<div class="tooltipevent">' + durationTime + '</div>';
                $("body").append(tooltip);
                $(this).mouseover(function(e) {
                    $(this).css('z-index', 10000);
                    $('.tooltipevent').fadeIn('500');
                    $('.tooltipevent').fadeTo('10', 1.9);
                }).mousemove(function(e) {
                    $('.tooltipevent').css('top', e.pageY + 10);
                    $('.tooltipevent').css('left', e.pageX + 20);
                });
            },
            eventMouseout: function(calEvent, jsEvent) {
                $(this).css('z-index', 8);
                $('.tooltipevent').remove();
            },
            viewRender: function(view, event, element) {
                var start = getFormatDate(view.start._d);
                var end = getFormatDate(view.end._d);

                if (view.name == 'agendaWeek') {
                    var curr = new Date;
                    var currday = new Date;
                    var now = new Date;
                    var first = view.start._d.getDate() - view.start._d.getDay();
                    var last = first + 6;

                    var firstday = new Date(curr.setDate(first));
                    var lastday = new Date(curr.setDate(last));
                    var bookable = new Date(currday.setDate(currday.getDate() + parseInt(session_booking_ahead_day)));
                    firstday.setHours(0, 0, 0);
                    lastday.setHours(23, 59, 59, 59);
                    bookable.setHours(23, 59, 59, 59);
                    var a = moment(lastday);
                    var b = moment(now);
                    var c = a.diff(b, 'days')

                    if (firstday < currday) {
                        if (c >= 7) {
                            $('.fc-prev-button').removeClass('fc-state-disabled');
                        } else {
                            $('.fc-prev-button').addClass('fc-state-disabled');
                        }
                    } else {
                        $('.fc-prev-button').removeClass('fc-state-disabled');
                    }

                    if (bookable < lastday) {
                        $('.fc-next-button').addClass('fc-state-disabled');
                    } else {
                        $('.fc-next-button').removeClass('fc-state-disabled');
                    }
                }

                $.ajax({
                    url: "/backend/room/" + $('#main_room').val() + "/booking",
                    type: "post",
                    data: {
                        '_token': $('#token').val(),
                        'start': moment(start, 'DD/MM/YYYY').format('YYYY-MM-DD'),
                        'end': moment(end, 'DD/MM/YYYY').format('YYYY-MM-DD'),
                        'room_id': main_room.id
                    },
                    beforeSend: function() {
                        $('#calendar').css("opacity", 0);
                        toastr.warning(toastr_lang.room_loading.replace("#x#", main_room.name));
                    },
                    success: function(event) {
                        //console.log(event);
                        $('#calendar').fullCalendar('removeEvents');
                        $('#calendar').fullCalendar('addEventSource', event);
                        $('#calendar').css("opacity", 1);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }

                });
            },
            eventClick: function(info) {
                var time_checker = moment(new Date(), "DD/MM/YYYY HH:mm");
                var start = moment(info.start, "DD/MM/YYYY HH:mm");
                // alert(time_checker);
                // alert(start);
                if (time_checker > start) {
                    toastr.warning(toastr_lang.elapsed_period);
                } else {
                    $('#jquery-tagIt-participant').tagit("removeAll");
                    $('#search-participant').val('');
                    $.ajax({
                        url: "/backend/room/getRoomSeat",
                        type: "post",
                        data: {
                            '_token': $('#token').val(),
                            'room_id': main_room.id
                        },
                        success: function(response) {
                            session_max_participant = response.seat - 1;
                            //console.log(info);
                            if (info.editable == 1 && info.organizer == session_login_email) {
                                // $('#room_id').val(main_room.id);
                                // alert(main_room.id);
                                $('#cancel-booking-btn').removeClass('hide');
                                $('#cancel-booking-btn').attr('data-id', info.system_booking_id);

                                $('#api_booking_id').val(info.api_booking_id);
                                $('#booking_id').val(info.system_booking_id);
                                $('#search-participant').val('');
                                $('#room_name').val(main_room.name);
                                $('#booking_title').val(info.title);
                                $('#datepicker-start').val(moment(info.start).format('DD/MM/YYYY HH:mm'));
                                $('#datepicker-end').val(moment(info.end).format('DD/MM/YYYY HH:mm'));
                                $('#booking_detail').summernote("code", info.detail);
                                if (info.calendar_id != null && info.icaluid != null) {
                                    $.each($(info.attendees), function(index, value) {
                                        if (value.emailAddress.address != info.organizer && value.type != 'resource') {
                                            var pname = '';
                                            if (value.emailAddress.name != null) {
                                                pname += value.emailAddress.name + ' [' + value.emailAddress.address + ']';
                                            } else {
                                                pname += value.emailAddress.address;
                                            }
                                            var list = '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-editable">' +
                                                '<span class="tagit-label">' + pname + '</span>' +
                                                '<a class="tagit-close" data-email="' + pname + '"><span class="text-icon">×</span>' +
                                                '<span class="ui-icon ui-icon-close"></span></a></li>';

                                            $('#jquery-tagIt-participant').prepend(list);

                                            $('.tagit-close').click(function(ev) {
                                                this.closest('li').remove();
                                            });
                                        } else {}
                                    });
                                } else {
                                    $.each($(info.attendees), function(index, value) {
                                        if (value.emailAddress.address != info.organizer && value.type != 'resource') {
                                            var pname = '';
                                            if (value.emailAddress.Name != null) {
                                                pname += value.emailAddress.Name + ' [' + value.emailAddress.address + ']';
                                            } else {
                                                pname += value.emailAddress.address;
                                            }
                                            var list = '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-editable">' +
                                                '<span class="tagit-label">' + pname + '</span>' +
                                                '<a class="tagit-close" data-email="' + pname + '"><span class="text-icon">×</span>' +
                                                '<span class="ui-icon ui-icon-close"></span></a></li>';

                                            $('#jquery-tagIt-participant').prepend(list);

                                            $('.tagit-close').click(function(ev) {
                                                this.closest('li').remove();
                                            });
                                        }
                                    });
                                }
                                $('#createEventModal').modal({ backdrop: 'static', keyboard: false });
                            } else {
                                toastr.warning(toastr_lang.cannot_modify);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }

                    });
                }
            }

        });
    }

    if (typeof multi_room !== 'undefined' && multi_room.length > 1) {
        $('#multiple-calendar-control').removeClass('hide');
        $.each(multi_room, function(propName, propVal) {
            $('#calendar_' + propVal.id).fullCalendar({
                locale: lang,
                timeFormat: 'HH:mm',
                slotLabelFormat: 'HH:mm',
                timeZone: 'Asia/Bangkok',
                header: {
                    left: 'title',
                    center: '',
                    right: 'prev,today,next'
                },
                defaultView: 'agendaDay',
                nowIndicator: true,
                editable: false,
                eventLimit: true,
                events: [],
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                    $.ajax({
                        url: "/getConfig",
                        type: "get",
                        success: function(response1) {
                            session_max_participant = response1.max_participant;
                            session_booking_hour_max = response1.booking_hour_max;
                            session_booking_hour_min = response1.booking_hour_min;
                            session_booking_ahead_day = response1.booking_ahead_day;
                            session_booking_per_week = response1.booking_per_week;
                            session_booking_per_day = response1.booking_per_day;
                            var sb = moment(start).format("YYYY-MM-DD HH:mm");
                            var eb = moment(end).format("YYYY-MM-DD HH:mm");
                            $.ajax({
                                url: "/checkQuota",
                                type: "post",
                                data: {
                                    '_token': $('#global_csrf').val(),
                                    'start': sb,
                                    'end': eb
                                },
                                success: function(response2) {
                                    if (response2.booking_per_week >= session_booking_per_week) {
                                        toastr.warning(toastr_lang.qouta_time_a_week.replace("#x#", session_booking_per_week));
                                    } else if (response2.booking_per_day >= session_booking_per_day) {
                                        toastr.warning(toastr_lang.qouta_time_a_day.replace("#x#", session_booking_per_day));
                                    } else {
                                        $.ajax({
                                            url: "/backend/room/getRoomSeat",
                                            type: "post",
                                            data: {
                                                '_token': $('#global_csrf').val(),
                                                'room_id': propVal.id
                                            },
                                            success: function(response3) {
                                                session_max_participant = response3.seat - 1;
                                                var a = moment(start, "DD/MM/YYYY HH:mm");
                                                var b = moment(end, "DD/MM/YYYY HH:mm");
                                                var c = b.diff(a, 'hours');
                                                if (c > session_booking_hour_max) {
                                                    toastr.warning(toastr_lang.qouta_max_hour.replace("#x#", session_booking_hour_max));
                                                } else if (c < session_booking_hour_min) {
                                                    toastr.warning(toastr_lang.qouta_min_hour.replace("#x#", session_booking_hour_min));
                                                } else {
                                                    $('#jquery-tagIt-participant').tagit("removeAll");
                                                    $('#booking_id').val('');
                                                    $('#search-participant').val('');
                                                    $('#modal-size').removeClass('modal-xl').addClass('modal-lg');
                                                    $('#dashboard-calendar-area').addClass('hide').removeClass('col-md-4');
                                                    $('#booking-calendar-area').addClass('col-md-12').removeClass('col-md-8');
                                                    var view = $('#calendar_' + propVal.id).fullCalendar('getView');
                                                    if (view.name == 'agendaDay') {
                                                        if (moment(moment.utc(start).subtract('7', 'hours').toDate()).isBefore(moment())) {
                                                            $('#calendar').fullCalendar('unselect');
                                                            toastr.warning(toastr_lang.elapsed_period);
                                                            return false;
                                                        } else {
                                                            var currday = new Date;
                                                            var bookable = new Date(currday.setDate(currday.getDate() + parseInt(session_booking_ahead_day)));
                                                            var start_date = moment.utc(start).subtract('7', 'hours').toDate();
                                                            bookable.setHours(23, 59, 59, 59);
                                                            if (start_date <= bookable) {
                                                                $('#cancel-booking-btn').addClass('hide');
                                                                $('#cancel-booking-btn').attr('data-id', '');
                                                                $('#room_id').val(propVal.id);
                                                                $('#room_name').val(propVal.name);
                                                                $('#datepicker-start').val(moment(start).format('DD/MM/YYYY HH:mm'));
                                                                $('#datepicker-end').val(moment(end).format('DD/MM/YYYY HH:mm'));
                                                                $('#createEventModal').modal({ backdrop: 'static', keyboard: false });
                                                            } else {
                                                                toastr.warning(toastr_lang.qouta_day_advance.replace("#x#", session_booking_ahead_day));
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
                },
                selectOverlap: function(event) {
                    toastr.warning(toastr_lang.qouta_dup_other);
                },
                eventMouseover: function(calEvent, jsEvent) {
                    var durationTime = moment(calEvent.start).format('HH') + ":" + moment(calEvent.start).format('mm') + " - " + moment(calEvent.end).format('HH') + ":" + moment(calEvent.end).format('mm');
                    var tooltip = '<div class="tooltipevent">' + durationTime + '</div>';
                    $("body").append(tooltip);
                    $(this).mouseover(function(e) {
                        $(this).css('z-index', 10000);
                        $('.tooltipevent').fadeIn('500');
                        $('.tooltipevent').fadeTo('10', 1.9);
                    }).mousemove(function(e) {
                        $('.tooltipevent').css('top', e.pageY + 10);
                        $('.tooltipevent').css('left', e.pageX + 20);
                    });
                },
                eventMouseout: function(calEvent, jsEvent) {
                    $(this).css('z-index', 8);
                    $('.tooltipevent').remove();
                },
                viewRender: function(view, element) {
                    var start = getFormatDate(view.start._d);
                    var end = getFormatDate(view.end._d);

                    $room = [];

                    $.each($('.switch-room'), function(index, value) {
                        if ($(value).is(":checked")) {
                            $room.push($(value).data('id'));
                        }
                    });

                    $('#room_array_list').val($room);

                    $.ajax({
                        url: "/backend/room/" + propVal.id + "/booking",
                        type: "post",
                        data: {
                            '_token': $('#token').val(),
                            'start': moment(start, 'DD/MM/YYYY').format('YYYY-MM-DD'),
                            'end': moment(end, 'DD/MM/YYYY').format('YYYY-MM-DD'),
                            'room_id': propVal.id
                        },
                        beforeSend: function() {
                            $('#calendar_' + propVal.id).css("opacity", 0);
                            toastr.warning(toastr_lang.room_loading.replace("#x#", propVal.name));
                        },
                        success: function(event) {
                            $('#calendar_' + propVal.id).fullCalendar('removeEvents');
                            $('#calendar_' + propVal.id).fullCalendar('addEventSource', event);
                            $('#calendar_' + propVal.id).css("opacity", 1);

                            // $('.fc-prev-button').click();
                            // $('.fc-today-button').click();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }

                    });
                },
                eventClick: function(info) {
                    var time_checker = moment(new Date(), "DD/MM/YYYY HH:mm");
                    var start = moment(info.start, "DD/MM/YYYY HH:mm");
                    if (time_checker > start) {
                        toastr.warning(toastr_lang.elapsed_period);
                    } else {
                        $('#jquery-tagIt-participant').tagit("removeAll");
                        $('#search-participant').val('');
                        $.ajax({
                            url: "/backend/room/getRoomSeat",
                            type: "post",
                            data: {
                                '_token': $('#token').val(),
                                'room_id': propVal.id
                            },
                            success: function(response) {
                                session_max_participant = response.seat - 1;
                                if (info.editable == 1 && info.organizer == session_login_email) {
                                    $('#cancel-booking-btn').removeClass('hide');
                                    $('#cancel-booking-btn').attr('data-id', info.system_booking_id);

                                    $('#api_booking_id').val(info.api_booking_id);
                                    $('#booking_id').val(info.system_booking_id);
                                    $('#room_id').val(propVal.id);
                                    $('#room_name').val(propVal.name);
                                    $('#booking_title').val(info.title);
                                    $('#datepicker-start').val(moment(info.start).format('DD/MM/YYYY HH:mm'));
                                    $('#datepicker-end').val(moment(info.end).format('DD/MM/YYYY HH:mm'));
                                    $('#booking_detail').summernote("code", info.detail);
                                    if (info.calendar_id != null && info.icaluid != null) {
                                        $.each($(info.attendees), function(index, value) {
                                            if (value.emailAddress.address != info.organizer && value.type != 'resource') {
                                                var pname = '';
                                                if (value.emailAddress.name.length > 0) {
                                                    pname += value.emailAddress.name + ' [' + value.emailAddress.address + ']';
                                                } else {
                                                    pname += value.emailAddress.address;
                                                }
                                                var list = '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-editable">' +
                                                    '<span class="tagit-label">' + pname + '</span>' +
                                                    '<a class="tagit-close" data-email="' + pname + '"><span class="text-icon">×</span>' +
                                                    '<span class="ui-icon ui-icon-close"></span></a></li>';

                                                $('#jquery-tagIt-participant').prepend(list);

                                                $('.tagit-close').click(function(ev) {
                                                    this.closest('li').remove();
                                                });
                                            }
                                        });
                                    } else {
                                        $('.tagit-close').click();
                                        $.each($(info.attendees), function(index, value) {
                                            if (value.emailAddress.address != info.organizer && value.type != 'resource') {
                                                var pname = '';
                                                if (value.emailAddress.Name.length > 0) {
                                                    pname += value.emailAddress.Name + ' [' + value.emailAddress.address + ']';
                                                } else {
                                                    pname += value.emailAddress.address;
                                                }
                                                var list = '<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all tagit-choice-editable">' +
                                                    '<span class="tagit-label">' + pname + '</span>' +
                                                    '<a class="tagit-close" data-email="' + pname + '"><span class="text-icon">×</span>' +
                                                    '<span class="ui-icon ui-icon-close"></span></a></li>';
                                                $('#jquery-tagIt-participant').prepend(list);

                                                $('.tagit-close').click(function(ev) {
                                                    this.closest('li').remove();
                                                });
                                            }
                                        });
                                    }
                                    $('#createEventModal').modal({ backdrop: 'static', keyboard: false });
                                } else {
                                    toastr.warning(toastr_lang.cannot_modify);
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }

                        });
                    }
                }
            });
        });
    }

    if (typeof $('.switch-room').length !== 'undefined') {
        if (typeof multi_room !== 'undefined' && multi_room.length > 1) {

            var today_checker = new Date();
            var newdate = new Date(today_checker);
            var limit_day_checker = new Date(newdate.setDate(newdate.getDate() + parseInt(session_booking_ahead_day - 1)));
            $('#calendar-date').datepicker({
                format: 'MM d, yyyy',
                inline: true,
                startDate: new Date(),
                endDate: '+' + session_booking_ahead_day + 'd',
            }).on("changeDate", function(e) {
                $('.calendar').fullCalendar('gotoDate', e.date);
                if (e.date <= limit_day_checker) {
                    $('.btn-calendar-next').attr('disabled', false);
                } else {
                    $('.btn-calendar-next').attr('disabled', true);
                }

                if (e.date > today_checker) {
                    $('.btn-calendar-previous').attr('disabled', false);
                } else {
                    $('.btn-calendar-previous').attr('disabled', true);
                }
            });
            $('#calendar-date').val($('.fc-left').find('h2').first().text());
            $('.fc-right').addClass('hide');

            $('.btn-calendar-previous').attr('disabled', true);

            $('.btn-calendar-next').click(function(ev) {
                $('.btn-calendar-previous').attr('disabled', false);

                $('.btn-calendar-next').attr('disabled', false);
                $.each($('.calendar'), function(index, value) {
                    $next = $(this).find('.fc-next-button');
                    if (!$next.hasClass('fc-state-hover')) {
                        $next.trigger("click");
                    }
                });
                $('#calendar-date').val($('.fc-left').find('h2').first().text());

                var timestamp = Date.parse($('#calendar-date').val());
                var current_date = new Date(timestamp);
                //console.log(current_date);
                if (current_date <= limit_day_checker) {
                    $('.btn-calendar-next').attr('disabled', false);
                } else {
                    $('.btn-calendar-next').attr('disabled', true);
                }
            });

            $('.btn-calendar-previous').click(function(ev) {
                $('.btn-calendar-next').attr('disabled', false);

                $.each($('.calendar'), function(index, value) {
                    $prev = $(this).find('.fc-prev-button');
                    if (!$prev.hasClass('fc-state-hover')) {
                        $prev.trigger("click");
                    }
                });
                $('#calendar-date').val($('.fc-left').find('h2').first().text());

                var timestamp = Date.parse($('#calendar-date').val());
                var current_date = new Date(timestamp);
                //console.log(current_date);
                if (current_date > today_checker) {
                    $('.btn-calendar-previous').attr('disabled', false);
                } else {
                    $('.btn-calendar-previous').attr('disabled', true);
                }
            });

            $('.btn-calendar-today').click(function(ev) {
                $.each($('.calendar'), function(index, value) {
                    $today = $(this).find('.fc-today-button');
                    if (!$today.hasClass('fc-state-hover')) {
                        $today.trigger("click");
                    }
                });
                $('#calendar-date').val($('.fc-left').find('h2').first().text());
                $('.btn-calendar-previous').attr('disabled', true);
                $('.btn-calendar-next').attr('disabled', false);
            });
        }

        $('.switch-room').change(function() {
            if ($(".switch-room:checked").length > 5) {
                toastr.warning(toastr_lang.limit_compare);
                $('#switcher_checkbox_' + $(this).data('id')).prop("checked", false);
            } else {
                $room = [];
                $.each($('.switch-room'), function(index, value) {
                    if ($(value).is(":checked")) {
                        $room.push($(value).data('id'));
                    }
                });
                $('#room_array_list').val($room);
            }
        });

        $('#view-select-room').click(function(ev) {
            $('#room-celendar-form').submit();
        });

    }
});