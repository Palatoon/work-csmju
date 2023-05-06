$(document).ready(function() {

    if (typeof $('#create-new-booking-form').length !== 'undefined') {
        $('#create-new-booking-form').validate({
            rules: {
                title: {
                    required: true,
                },
                start: {
                    required: true,
                },
                end: {
                    required: true,
                },
            }
        });
    }

    if (typeof $('#create-new-device-type').length !== 'undefined') {
        $('#create-new-device-type').validate({
            rules: {
                name: {
                    required: true,
                }
            }
        });
    }

    if (typeof $('#create-new-home-assistant').length !== 'undefined') {
        $('#create-new-home-assistant').validate({
            rules: {
                name: {
                    required: true,
                },
                ip: {
                    required: true,
                },
                port: {
                    required: true,
                }
            }
        });
    }

    if (typeof $('#create-new-command').length !== 'undefined') {
        $('#create-new-command').validate({
            rules: {
                name: {
                    required: true,
                },
                value: {
                    required: true,
                }
            }
        });
    }

    if (typeof $('#report-filter-form').length !== 'undefined') {
        $('#report-filter-form').validate({
            rules: {
                'start': {
                    required: true,
                },
                'end': {
                    required: true,
                },
                'room[]': {
                    required: true,
                    minlength: 1
                },
                'booking_status[]': {
                    required: true,
                    minlength: 1
                },
                'user_type[]': {
                    required: true,
                    minlength: 1
                },
            }
        });
    }

    if (typeof $('#condition-form').length !== 'undefined') {
        $('#condition-form').validate({
            rules: {
                'name': {
                    required: true,
                },
                'active_location': {
                    required: true,
                },
                'device': {
                    required: true,
                },
                'type': {
                    required: true,
                },
                'first_operator': {
                    required: true,
                },
                'first_value': {
                    required: true,
                },
                // 'command': {
                //     required: true,
                // },
            }
        });
    }

    if (typeof $('#mac').length !== 'undefined') {
        $('#mac').keyup(function(e) {
            var r = /([a-f0-9]{2})([a-f0-9]{2})/i,
                str = e.target.value.replace(/[^a-f0-9]/ig, "");

            while (r.test(str)) {
                str = str.replace(r, '$1' + ':' + '$2');
            }

            e.target.value = str.slice(0, 17);
        });
    }

});