$(document).ready(function() {

    if (typeof $('#datepicker-start').length !== 'undefined' && typeof $('#datepicker-end').length !== 'undefined') {
        $.ajax({
            url: "/getConfig",
            type: "get",
            success: function(response) {
                $('#datepicker-start').datetimepicker({
                    locale: 'th-th',
                    minDate: new Date(),
                    maxDate: moment(new Date).set({
                        hour: 23,
                        minute: 59,
                        second: 59
                    }).add(response.booking_ahead_day, 'days'),
                    stepping: response.time_step,
                    format: 'DD/MM/YYYY HH:mm',
                });

                $('#datepicker-end').datetimepicker({
                    locale: 'th-th',
                    minDate: new Date(),
                    maxDate: moment(new Date).set({
                        hour: 23,
                        minute: 59,
                        second: 59
                    }).add(response.booking_ahead_day, 'days'),
                    stepping: response.time_step,
                    format: 'DD/MM/YYYY HH:mm',
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    if (typeof $('#datepicker-filter-start').length !== 'undefined' && typeof $('#datepicker-filter-end').length !== 'undefined') {
        $.ajax({
            url: "/getConfig",
            type: "get",
            success: function(response) {
                $('#datepicker-filter-start').datetimepicker({
                    minDate: new Date(),
                    maxDate: moment(new Date).set({
                        hour: 23,
                        minute: 59,
                        second: 59
                    }).add(response.booking_ahead_day, 'days'),
                    stepping: response.time_step,
                    format: 'DD/MM/YYYY HH:mm',
                });
                $('#datepicker-filter-start').val(moment(new Date()).format('DD/MM/YYYY HH:mm'));

                $('#datepicker-filter-end').datetimepicker({
                    minDate: new Date(),
                    maxDate: moment(new Date).set({
                        hour: 23,
                        minute: 59,
                        second: 59
                    }).add(response.booking_ahead_day, 'days'),
                    stepping: response.time_step,
                    format: 'DD/MM/YYYY HH:mm',
                });
                $('#datepicker-filter-end').val(moment(new Date()).format('DD/MM/YYYY HH:mm'));
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    if (typeof $('#datepicker-report-start').length !== 'undefined' && typeof $('#datepicker-report-end').length !== 'undefined') {
        $.ajax({
            url: "/getConfig",
            type: "get",
            success: function(response) {
                $('#datepicker-report-start').datetimepicker({
                    format: 'DD/MM/YYYY HH:mm',
                });

                $('#datepicker-report-end').datetimepicker({
                    format: 'DD/MM/YYYY HH:mm',
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

});