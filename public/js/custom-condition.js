var actions_tog = [];
var acton_room_id = "";
$(document).ready(function () {



    $('#datetimepickerx3').datetimepicker({
        format: 'LT'
    });

    $('#add-automate').click(function () {
        $('#nameau').val("");
        $('#divautocons').html("");
        $('#divautoact').html("");
        $('#modal-addautomate').modal('show');
    });


    $('#form-save-cons').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            }
        }
    });


    $('#form-save-act').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            }
        }
    });



    $('#form-update-cons').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            }
        }
    });


    $('#form-edit-automation').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            }
        }
    });


    $('#form-edit-act').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            }
        }
    });



    $('#form-save-delay').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            },
            value: {
                required: true,
            }
        }
    });


    $('#form-edit-delay').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            },
            value: {
                required: true,
            }
        }
    });


    $('#form-save-automation').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
            }
        }
    });


    $('#btn-save-cons').click(function () {
        swal({
            title: 'Alert',
            text: 'Are you sure that you want to save this condition?',
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
            if (isConfirm && $('#form-save-cons').valid()) {
                $('#form-save-cons').submit();
            }
        });
    });


    $('#btn-save-delay').click(function () {
        swal({
            title: 'Alert',
            text: 'Are you sure that you want to add this delay?',
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
            if (isConfirm && $('#form-save-delay').valid()) {
                $('#form-save-delay').submit();
            }
        });
    });



    $('#btn-update-cons').click(function () {
        swal({
            title: 'Alert',
            text: 'Are you sure that you want to update this condition?',
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
            if (isConfirm && $('#form-update-cons').valid()) {
                $('#form-update-cons').submit();
            }
        });
    });




    $('#btn-edit-automation').click(function () {
        swal({
            title: 'Alert',
            text: 'Are you sure that you want to update this automation?',
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
            if (isConfirm && $('#form-edit-automation').valid()) {
                $('#form-edit-automation').submit();
            }
        });
    });




    $('#btn-edit-delay').click(function () {
        swal({
            title: 'Alert',
            text: 'Are you sure that you want to update this delay?',
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
            if (isConfirm && $('#form-edit-delay').valid()) {
                $('#form-edit-delay').submit();
            }
        });
    });


    $('#btn-save-automation').click(function () {
        swal({
            title: 'Alert',
            text: 'Are you sure that you want to add this automation?',
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
            if (isConfirm && $('#form-save-automation').valid()) {
                $('#form-save-automation').submit();
            }
        });
    });


    $('#btn-save-act').click(function () {
        swal({
            title: 'Alert',
            text: 'Are you sure that you want to add this action?',
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
            if (isConfirm && $('#form-save-act').valid()) {
                $('#form-save-act').submit();
                // $('#modal-setact').modal('hide');
                // $.ajax({
                //     url: '/backend/actions/store',
                //     type: 'post',
                //     data: {
                //         '_token': $('meta[name=csrf-token]').attr('content'),
                //         'room': acton_room_id,
                //         'name': $('#nameact').val(),
                //         'data': actions_tog
                //     },
                //     success: function (data) {


                //         if (data) {
                //             swal("Create actions successfully!", "", "success").then((isConfirm) => {
                //                 location.reload();
                //             });
                //         }
                //     }
                // })
            }
        });


    });






    $('#btn-edit-act').click(function () {
        swal({
            title: 'Alert',
            text: 'Are you sure that you want to update this action?',
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
            if (isConfirm && $('#form-edit-act').valid()) {

                $('#form-edit-act').submit();
                // $('#modal-editact').modal('hide');
                // $.ajax({
                //     url: '/backend/actions/update',
                //     type: 'post',
                //     data: {
                //         '_token': $('meta[name=csrf-token]').attr('content'),
                //         'room': acton_room_id,
                //         'name': $('#nameeditact').val(),
                //         'data': actions_tog
                //     },
                //     success: function (data) {

                //         if (data) {
                //             swal("Updated actions successfully!", "", "success").then((isConfirm) => {
                //                 location.reload();
                //             });
                //         }
                //     }
                // })
            }
        });


    });







});




btncons = (id) => {
    var html = "<a href='javascript:;' onclick='setcons(" + id + ")'><div class='note note-danger' style='cursor: pointer;'><div class='note-content'><h4><b>Condition</b></h4>";
    html += "<p>สร้างเงื่อนไขการทำงาน</p></div><div class='note-icon'><i class='fa fa-lightbulb'></i></div></div></a>";
    html += "<a href='javascript:;' onclick='setaction(" + id + ")'><div class='note note-primary note-with-right-icon' style='cursor: pointer;'><div class='note-icon'><i class='fa fa-exchange-alt'></i></div>";
    html += "<div class='note-content text-right'><h4><b>Action</b></h4> <p>สร้างการทำงานของอุปกรณ์</p></div></div></a>";
    // html += "<a href='javascript:;' onclick='setdelay(" + id + ")'><div class='note note-warning' style='cursor: pointer;'><div class='note-content'><h4><b>Delay</b></h4> <p>สร้างเวลาในการทำงาน</p></div><div class='note-icon'><i class='fa fa-clock'></i></div>";
    // html += "</div></a>";
    $('#modal-body-cons').html(html);

    $('#modal-cons').modal('show');
}







setcons = (id) => {
    $('#modal-cons').modal('hide');
    $('#room_idx').val(id);
    $('#divaddcons').html("");
    $('#namexa').val("");
    $('#btn-add-cons').html("<a href='javascript:;' onclick='addcons(" + id + ")'><i class='fa fa-plus-circle mt-2 ml-2 text-success'></i></a><a href='javascript:;' onclick='constime()'><i class='fa fa-clock mt-2 ml-2 text-danger'></i></a>");
    $('#modal-setcons').modal('show');

}



setdelay = (id) => {
    $('#modal-cons').modal('hide');
    $('#room_idxd').val(id);
    $('#namexd').val("");
    $('#valuexd').val("");
    $('#modal-setdelay').modal('show');
}


addact = (id) => {
    $.ajax({
        url: '/backend/getcondition/' + id,
        type: 'get',
        success: function (data) {
            var html = "<div class='row m-0 pt-2' id='act_" + id + "' >";

            var idx = makeid(4);
            html += "<div class='col-5 p-0 float-left'><select class='form-control' name='sldevice[]' onchange='fncgettype(\"" + idx + "\", this.value)'>";
            html += "<option value='0' selected>-- Device --</option>";
            $.each(data.device, function (i, k) {
                html += "<option value='" + k.id + "'>" + k.name + "</option>";
            });
            html += "</select></div>";


            html += "<div class='col-5 p-0 float-left ml-2' id='acid_" + idx + "'><select class='form-control' name='slcons[]'><option selected>-- Action --</option></select></div>";

            html += "<div class='col-1 float-left '><a href='javascript:;' onclick='deladdact(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 text-danger'></i></a></div></div>";
            $('#divaddact').append(html);
        }

    })

};



fncgettype = (id, value) => {

    $.ajax({
        url: 'actions/getdevicetypebyid/' + value,
        type: 'get',
        success: function (data) {

            if (data == "true") {
                $('#acid_' + id).html("<input class='form-control' type='text' name='slcons[]' placeholder='Value'>");
            } else if (data == "Calendar") {
                $('#acid_' + id).html("<select class='form-control' name='slcons[]'><option value='speak' selected>Speak</option></select>");
            } else {
                $('#acid_' + id).html("<select class='form-control' name='slcons[]'><option value='on' selected>ON</option><option value='off'>OFF</option></select>");
            }
        }
    });

}


deladdact = (id) => {
    $('#act_' + id).remove();
}


deleditact = (id) => {
    $('#eact_' + id).remove();
}


setaction = (id) => {
    $('#modal-cons').modal('hide');
    $('#room_idax').val(id);
    $('#divaddact').html("");
    $('#nameact').val("");
    $('#btn-add-act').html("<a href='javascript:;' onclick='addact(" + id + ")'><i class='fa fa-plus-circle mt-2 ml-2 text-success'></i></a>");
    // $.ajax({
    //     url: 'actions/getdevicetype/' + id,
    //     type: 'get',
    //     success: function (data) {

    //         if (data != null) {
    //             var html = [];
    //             actions_tog = [];
    //             acton_room_id = id;
    //             $.each(data, function (i, k) {
    //                 // actions_tog.push({
    //                 //     "id": k.id,
    //                 //     "stat": false
    //                 // });

    //                 html += "<div class='row m-0'><div class='col-5 p-0 float-left'><p class='mt-2'>" + k.name_en + "</p></div>";
    //                 html += "<div class='col-4 float-left pl-4'><label class='switch'><input type='hidden' name='type[]' value=" + k.id + "><input type='checkbox'  onclick='addactions(" + k.id + ", this)'><span class='slider round'></span></label></div>";
    //                 html += "<div class='col-3 float-left' id='sl_" + k.id + "'></div></div>";
    //             });
    //             $('#divaddact').append(html);
    //         }
    //     }
    // });

    $('#modal-setact').modal('show');

}


constime = () => {
    var id = makeid(4);
    var html = "";

    $.ajax({
        url: '/backend/gettimecondition',
        type: 'get',
        success: function (data) {
            html = "<div class='row m-0 pt-2' id='" + id + "' >";
            html += "<div class='col-5 p-0 float-left'><select class='form-control' name='sldevice[]' onchange='fncgetconslist(\"" + id + "\", this.value)' >";
            html += "<option value='" + data.device_id + "' selected>" + data.name + "</option>";
            html += "</select></div>";

            html += "<div class='col-5 p-0 float-left'><div class='col-11 p-0 float-left ml-2'><div class='input-group date' id='datetimepicker_" + id + "'><input type='text' class='form-control' name='val_sensor[]' value='0'/><span class='input-group-addon'><span class='fa fa-clock'></span></span></div><input class='form-control' type='hidden' name='slcons[]' placeholder='Value' value='" + data.id + "'></div></div>";
            html += "<div class='col-1 float-left '><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 text-danger'></i></a></div></div>";

            $('#divaddcons').append(html);

            $('#datetimepicker_' + id).datetimepicker({
                format: 'HH:mm',
            });


        }
    });
}


addcons = (roomid) => {

    var id = makeid(4);
    var html = "";


    $.ajax({
        url: '/backend/getcondition/' + roomid,
        type: 'get',
        success: function (data) {


            html = "<div class='row m-0 pt-2' id='" + id + "' >";


            html += "<div class='col-5 p-0 float-left'><select class='form-control' name='sldevice[]' onchange='fncgetconslist(\"" + id + "\", this.value)' >";
            html += "<option value='0' selected>-- Device Type --</option>";
            $.each(data.device, function (i, k) {
                html += "<option value='" + k.id + "'>" + k.name + "</option>";
            });
            html += "</select></div>";


            html += "<div class='col-5 p-0 float-left' id='r_" + id + "'><div class='col-11 p-0 float-left ml-2'><select class='form-control' name='slcons[]' id='" + id + "_slconslist'>";
            html += "<option value='0' selected>-- Condition --</option>";
            // $.each(data.condition, function (i, k) {
            //     html += "<option value='" + k.id + "'>" + k.name + "</a>";
            // });
            html += "</select></div></div>";

            html += "<div class='col-1 float-left '><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 text-danger'></i></a></div></div>";
            $('#divaddcons').append(html);
        }
    });

}


fncgetconslist = (id, value) => {



    $.ajax({
        url: '/backend/getconditionlist/' + value,
        type: 'get',
        success: function (data) {
            if (data != "") {
                var html = "";


                var hh = "";

                $('#' + id + '_slconslist').html("");
                $.each(data.list, function (i, k) {
                    if (k.name === ">" || k.name === "<" || k.name === "=") {
                        html += '<option value="' + k.id + '">' + k.name + '</option>';
                        hh = "<div class='col-5 p-0 float-left ml-2'><select class='form-control' name='slcons[]' id='" + id + "_slconslist'>";
                        hh += "</select></div>";
                        hh += "<div class='col-5 p-0 float-left ml-2'><input class='form-control' type='number'  name='val_sensor[]' placeholder='Value' value='0' require></div>";
                    } else {
                        if (k.name != "ทำงานตามเวลา") {
                            html += '<option value="' + k.id + '">' + k.name + '</option>';
                            hh = "<div class='col-11 p-0 float-left ml-2'><select class='form-control' name='slcons[]' id='" + id + "_slconslist'>";
                            hh += "</select><input class='form-control' type='hidden'  name='val_sensor[]' placeholder='Value'></div>";
                        }
                    }

                });

                $('#r_' + id).html(hh);
                $('#' + id + '_slconslist').append(html);
            }
        }
    })

}



fncgetconslist2 = (id, value) => {

    $.ajax({
        url: '/backend/getconditionlist/' + value,
        type: 'get',
        success: function (data) {
            if (data != "") {

                var hh = "";
                var html = "";
                $('#' + id + '_slconslist2').html("");
                $.each(data.list, function (i, k) {
                    if (k.name === ">" || k.name === "<" || k.name === "=") {
                        html += '<option value="' + k.id + '">' + k.name + '</option>';
                        hh = "<div class='col-5 p-0 float-left ml-2'><select class='form-control' name='slcons[]' id='" + id + "_slconslist2'>";
                        hh += "</select></div>";
                        hh += "<div class='col-5 p-0 float-left ml-2'><input class='form-control' type='number'  name='val_sensor[]' placeholder='Value' value='0' require></div>";
                    } else {
                        html += '<option value="' + k.id + '">' + k.name + '</option>';
                        hh = "<div class='col-11 p-0 float-left ml-2'><select class='form-control' name='slcons[]' id='" + id + "_slconslist2'>";
                        hh += "</select><input class='form-control' type='hidden'  name='val_sensor[]' placeholder='Value'></div>";
                    }
                });

                $('#er_' + id).html(hh);
                $('#' + id + '_slconslist2').append(html);


                // var html = "";
                // $('#' + id + '_slconslist2').html("");
                // $.each(data.list, function (i, k) {
                //     html += '<option value="' + k.id + '">' + k.name + '</option>';
                // });
                // $('#' + id + '_slconslist2').append(html);
            }
        }
    })

}



fncgetconslist3 = (id, value, invalue) => {

    $.ajax({
        url: '/backend/getconditionlist/' + value,
        type: 'get',
        success: function (data) {

            if (data != "") {
                var html = "";
                var hh = "";
                //$('#' + id + '_slconslist2').html("");
                $.each(data.list, function (i, k) {

                    if (k.name === ">" || k.name === "<" || k.name === "=") {
                        if (k.id == invalue) {
                            html += '<option value="' + k.id + '" selected>' + k.name + '</option>';
                            hh = "<div class='col-5 p-0 float-left ml-2'><select class='form-control' name='slcons[]' id='" + id + "_slconslist2'>";
                            hh += "</select></div>";
                            hh += "<div class='col-5 p-0 float-left ml-2'><input class='form-control' type='number'  name='val_sensor[]' placeholder='Value' value='" + k.condition_value + "' require></div>";
                        } else {
                            html += '<option value="' + k.id + '">' + k.name + '</option>';
                        }
                    } else {
                        if (k.id == invalue) {
                            html += '<option value="' + k.id + '" selected>' + k.name + '</option>';
                        } else {
                            html += '<option value="' + k.id + '">' + k.name + '</option>';
                        }
                        hh = "<div class='col-11 p-0 float-left ml-2'><select class='form-control' name='slcons[]' id='" + id + "_slconslist2'>";
                        hh += "</select><input class='form-control' type='hidden'  name='val_sensor[]' placeholder='Value'></div>";
                    }
                });


                $('#er_' + id).html(hh);
                $('#' + id + '_slconslist2').append(html);
            }
        }
    })

}



function makeid(length) {
    var result = "";
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() *
            charactersLength));
    }
    return result;
}



addactions = (id, stat) => {

    try {
        $.each(actions_tog, function (i, k) {
            if (k.id === id) {
                var removeIndex = actions_tog.map(function (item) {
                    return item.id;
                }).indexOf(k.id);
                actions_tog.splice(removeIndex, 1);
            }
        });
    } catch {}

    actions_tog.push({
        "id": id,
        "stat": 1
    });

    if (stat.checked) {
        $('#sl_' + id).html("<select class='form-control' name='sldata[]' onchange='fncsetstat(" + id + ", this.value)'><option value='1'>ON</option><option value='0'>OFF</option></select>")
    } else {
        try {
            $.each(actions_tog, function (i, k) {
                if (k.id === id) {
                    var removeIndex = actions_tog.map(function (item) {
                        return item.id;
                    }).indexOf(k.id);
                    actions_tog.splice(removeIndex, 1);
                }
            });
            $('#sl_' + id).html("");
        } catch {
            $('#sl_' + id).html("");
        }
    }



    // $.each(actions_tog, function (i, k) {
    //     if (k.id == id) {
    //         console.log(2);
    //         k.stat = stat.checked;
    //     } else {
    //         console.log(3);
    //         actions_tog.push({
    //             "id": id,
    //             "stat": stat.checked
    //         });
    //     }
    // });

}




addactions2 = (id, stat) => {

    try {
        $.each(actions_tog, function (i, k) {
            if (k.id === id) {
                var removeIndex = actions_tog.map(function (item) {
                    return item.id;
                }).indexOf(k.id);
                actions_tog.splice(removeIndex, 1);
            }
        });
    } catch {}

    actions_tog.push({
        "id": id,
        "stat": 1
    });

    if (stat.checked) {
        $('#sl_ed' + id).html("<select class='form-control' name='sldata[]' onchange='fncsetstat(" + id + ", this.value)'><option value='1'>ON</option><option value='0'>OFF</option></select>")
    } else {
        try {
            $.each(actions_tog, function (i, k) {
                if (k.id === id) {
                    var removeIndex = actions_tog.map(function (item) {
                        return item.id;
                    }).indexOf(k.id);
                    actions_tog.splice(removeIndex, 1);
                }
            });
            $('#sl_ed' + id).html("");
        } catch {
            $('#sl_ed' + id).html("");
        }
    }

}



fncsetstat = (id, value) => {


    $.each(actions_tog, function (i, k) {
        if (k.id === id) {
            k.stat = parseInt(value);
        }
    });
}


deladdcons = (id) => {
    $('#' + id).remove();
}



editconstime = () => {
    var id = makeid(4);
    var html = "";

    $.ajax({
        url: '/backend/gettimecondition',
        type: 'get',
        success: function (data) {
            html = "<div class='row m-0 pt-2' id='" + id + "' >";
            html += "<div class='col-5 p-0 float-left'><select class='form-control' name='sldevice[]' onchange='fncgetconslist(\"" + id + "\", this.value)' >";
            html += "<option value='" + data.device_id + "' selected>" + data.name + "</option>";
            html += "</select></div>";

            html += "<div class='col-5 p-0 float-left'><div class='col-11 p-0 float-left ml-2'><div class='input-group date' id='datetimepicker_" + id + "'><input type='text' class='form-control' name='val_sensor[]' value='0'/><span class='input-group-addon'><span class='fa fa-clock'></span></span></div><input class='form-control' type='hidden' name='slcons[]' placeholder='Value' value='" + data.id + "'></div></div>";
            html += "<div class='col-1 float-left '><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 text-danger'></i></a></div></div>";

            $('#diveditcons').append(html);

            $('#datetimepicker_' + id).datetimepicker({
                format: 'HH:mm',
            });
        }
    });
}



btneditcons = (id, name) => {
    $('#diveditcons').html("");
    $('#edit_idx').val(id);
    $('#namex').val(name);
    var html = "";
    $.ajax({
        url: '/backend/getconditionbyid',
        type: 'post',
        data: {
            '_token': $('meta[name=csrf-token]').attr('content'),
            id: id,
        },
        success: function (data) {
            $('#btn-edit-cons').html("<a href='javascript:;' onclick='editaddcons(" + data.room + ")'><i class='fa fa-plus-circle mt-2 ml-2 text-success'></i></a><a href='javascript:;' onclick='editconstime()'><i class='fa fa-clock mt-2 ml-2 text-danger'></i></a>");

            $.ajax({
                url: '/backend/getcondition/' + data.room,
                type: 'get',
                success: function (res) {

                    $.each(data.condition, function (s, d) {

                        html = "";
                        html = "<div class='row m-0 pt-2'>";
                        var idtx = makeid(4);
                        html += "<div class='col-5 p-0 float-left'>";


                        if (d.device_id != null && d.value == null) {
                            html += "<select class='form-control' name='sldevice[]' onchange='fncgetconslist2(\"" + idtx + "\", this.value)'>";
                            $.each(res.device, function (i, k) {
                                if (d.device_id == k.id) {
                                    html += "<option value='" + k.id + "' selected>" + k.name + "</a>";
                                    fncgetconslist3(idtx, k.id, d.condition_list_id);
                                } else {
                                    html += "<option value='" + k.id + "'>" + k.name + "</a>";
                                }
                            });
                            html += "</select></div>";



                            html += "<div class='col-5 p-0 float-left' id='er_" + idtx + "'><div class='col-11 p-0 float-left ml-2'><select class='form-control' name='slcons[]' id='" + id + "_slconslist2'>";
                            html += "<option value='0' selected>-- Condition --</option>";
                            // $.each(data.condition, function (i, k) {
                            //     html += "<option value='" + k.id + "'>" + k.name + "</a>";
                            // });
                            html += "</select></div></div>";
                        } else {
                            html += "<select class='form-control' name='sldevice[]'>";

                            $.each(res.list, function (i, k) {

                                if (d.condition_list_id == k.id) {

                                    html += "<option value='" + d.device_id + "' selected>" + k.name + "</option>";
                                }
                            });
                            html += "</select></div>";

                            html += "<div class='col-5 p-0 float-left'><div class='col-11 p-0 float-left ml-2'><div class='input-group date' id='datetimepicker_" + idtx + "'><input type='text' class='form-control' name='val_sensor[]' value='" + d.value + "'/><span class='input-group-addon'><span class='fa fa-clock'></span></span></div><input class='form-control' type='hidden' name='slcons[]' placeholder='Value' value='" + d.condition_list_id + "'></div></div>";
                        }




                        // html += "<div class='col-5 p-0 float-left ml-2'>";
                        // html += "<select class='form-control' name='slcons[]' id='" + idtx + "_slconslist2'>";
                        // $.each(res.list, function (i, k) {
                        //     if (d.condition_list_id == k.id) {
                        //         html += "<option value='" + k.id + "' selected>" + k.name + "</option>";
                        //     }
                        // });
                        //html += "</select></div>";


                        html += "<div class='col-1 float-left'><a href='javascript:;' onclick='delcons(\"" + d.id + "\", " + id + " , \"" + name + "\")'><i class='fa fa-trash-alt mt-2 text-danger'></i></a></div></div>";


                        $('#diveditcons').append(html);

                        $('#datetimepicker_' + idtx).datetimepicker({
                            format: 'HH:mm',
                        });


                    });


                }
            });
        }
    })
    $('.delall').html("<a href='javascript:;' onclick='btndelall(" + id + ")'><button type='button' class='btn btn-danger mt-4'>Delete</button></a>");
    $('#modal-editcons').modal('show');
}





btneditdelay = (id, name, value) => {
    $('#edit_idexd').val(id);
    $('#nameexd').val(name);
    $('#valueexd').val(value);
    $('.deldelayall').html("<a href='javascript:;' onclick='btndeldelay(" + id + ")'><button type='button' class='btn btn-danger mt-4'>Delete</button></a>");
    $('#modal-editdelay').modal('show');
}



editaddact = (id) => {
    $.ajax({
        url: '/backend/getcondition/' + id,
        type: 'get',
        success: function (data) {
            var html = "<div class='row m-0 pt-2' id='eact_" + id + "' >";

            var idx = makeid(4);

            html += "<div class='col-5 p-0 float-left'><select class='form-control' name='sldevice[]' onchange='fncgettype2(\"" + idx + "\", this.value)'>";
            html += "<option value='0' selected>-- Device Type --</option>";
            $.each(data.device, function (i, k) {
                html += "<option value='" + k.id + "'>" + k.name + "</option>";
            });
            html += "</select></div>";

            html += "<div class='col-5 p-0 float-left ml-2' id='acidedt_" + idx + "'><select class='form-control' name='slcons[]'>";
            html += "<option>-- Action --</option>";
            html += "</select></div>";

            html += "<div class='col-1 float-left '><a href='javascript:;' onclick='deleditact(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 text-danger'></i></a></div></div>";
            $('#diveditact').append(html);
        }

    })

};



fncgettype2 = (id, value) => {
    $.ajax({
        url: 'actions/getdevicetypebyid/' + value,
        type: 'get',
        success: function (data) {
            if (data == "true") {
                $('#acidedt_' + id).html("<input class='form-control' type='text' name='slcons[]' placeholder='Value'>");
            } else if (data == "Calendar") {
                $('#acidedt_' + id).html("<select class='form-control' name='slcons[]'><option value='speak' selected>Speak</option></select>");
            } else {
                $('#acidedt_' + id).html("<select class='form-control' name='slcons[]'><option value='on' selected>ON</option><option value='off'>OFF</option></select>");
            }
        }
    });

}


btneditact = (id, name) => {

    $('#diveditact').html("");
    $('#room_ideditax').val(id);
    $('#nameeditact').val(name);
    var html = "";
    // $.ajax({
    //     url: '/backend/getactionbyid',
    //     type: 'post',
    //     data: {
    //         '_token': $('meta[name=csrf-token]').attr('content'),
    //         id: id,
    //     },
    //     success: function (data) {

    //         if (data != null) {

    //             var nontype = [];
    //             $.ajax({
    //                 url: 'actions/getdevicetype/' + data.room_id,
    //                 type: 'get',
    //                 success: function (dtype) {
    //                     $.each(dtype, function (i, k) {
    //                         nontype.push(k);
    //                     });



    //                     var html = [];
    //                     actions_tog = [];
    //                     acton_room_id = id;



    //                     $.each(data.data, function (i, k) {
    //                         actions_tog.push({
    //                             "id": k.id,
    //                             "stat": k.status
    //                         });

    //                         var removeIndex = nontype.map(function (item) {
    //                             return item.id;
    //                         }).indexOf(k.id);
    //                         nontype.splice(removeIndex, 1);




    //                         // html += "<div class='row m-0'><div class='col-8 p-0 float-left'><p class='mt-2'>" + k.name + "</p></div>";
    //                         // if (k.status == true) {
    //                         //     html += "<div class='col-4 float-left pl-4'><label class='switch'><input type='hidden' name='type[]' value=" + k.id + "><input type='checkbox' checked onclick='addactions(" + k.id + ", this)' ><span class='slider round'></span></label></div></div>";
    //                         // } else {
    //                         //     html += "<div class='col-4 float-left pl-4'><label class='switch'><input type='hidden' name='type[]' value=" + k.id + "><input type='checkbox' onclick='addactions(" + k.id + ", this)' ><span class='slider round'></span></label></div></div>";
    //                         // }

    //                         html += "<div class='row m-0'><div class='col-5 p-0 float-left'><p class='mt-2'>" + k.name + "</p></div>";
    //                         html += "<div class='col-4 float-left pl-4'><label class='switch'><input type='hidden' name='type[]' value=" + k.id + "><input type='checkbox'  onclick='addactions2(" + k.id + ", this)' checked><span class='slider round'></span></label></div>";
    //                         html += "<div class='col-3 float-left' id='sl_ed" + k.id + "'>";
    //                         if (k.status == true) {
    //                             html += "<select class = 'form-control' name = 'sldata[]' onchange = 'fncsetstat(" + k.id + ", this.value)'><option value='1' selected>ON</option><option value='0'>OFF</option></select>";
    //                         } else {
    //                             html += "<select class = 'form-control' name = 'sldata[]' onchange = 'fncsetstat(" + k.id + ", this.value)'><option value='1'>ON</option><option value='0' selected>OFF</option></select>";
    //                         }

    //                         html += "</div></div>";


    //                     });



    //                     $.each(nontype, function (i, k) {
    //                         html += "<div class='row m-0'><div class='col-5 p-0 float-left'><p class='mt-2'>" + k.name_en + "</p></div>";
    //                         html += "<div class='col-4 float-left pl-4'><label class='switch'><input type='hidden' name='type[]' value=" + k.id + "><input type='checkbox'  onclick='addactions2(" + k.id + ", this)'><span class='slider round'></span></label></div>";
    //                         html += "<div class='col-3 float-left' id='sl_ed" + k.id + "'></div></div>";
    //                     });

    //                     $('#diveditact').append(html);




    //                 }
    //             });



    //         }
    //     }
    // });

    $.ajax({
        url: '/backend/getactionbyid',
        type: 'post',
        data: {
            '_token': $('meta[name=csrf-token]').attr('content'),
            id: id,
        },
        success: function (act) {


            $.ajax({
                url: '/backend/getcondition/' + act.room_id,
                type: 'get',
                success: function (dv_type) {

                    $('#edt-act').html("<a href='javascript:;' onclick='editaddact(" + act.room_id + ")'><i class='fa fa-plus-circle mt-2 ml-2 text-success'></i></a>");
                    $.each(act.data, function (s, d) {
                        html = "";
                        html = "<div class='row m-0 pt-2'>";
                        var idtx = makeid(4);
                        html += "<div class='col-5 p-0 float-left'>";
                        html += "<select class='form-control' name='sldevice[]'>";
                        $.each(dv_type.device, function (i, k) {

                            if (d.id == k.id) {
                                html += "<option value='" + k.id + "' selected>" + d.name + "</a>";
                            } else {
                                html += "<option value='" + k.id + "'>" + k.name + "</a>";
                            }
                        });
                        html += "</select></div>";


                        html += "<div class='col-5 p-0 float-left ml-2'>";



                        if (d.status === "on") {
                            html += "<select class='form-control' name='slcons[]' id='" + idtx + "_slconslist2'>";
                            html += "<option value='on' selected>ON</a>";
                            html += "<option value='off'>OFF</a>";
                            html += "</select>";
                        } else if (d.status == "speak") {
                            html += "<select class='form-control' name='slcons[]' id='" + idtx + "_slconslist2'>";
                            html += "<option value='speak' selected>Speak</a>";
                            html += "</select>";
                        } else if (d.status === "off") {
                            html += "<select class='form-control' name='slcons[]' id='" + idtx + "_slconslist2'>";
                            html += "<option value='off' selected>OFF</a>";
                            html += "<option value='on'>ON</a>";
                            html += "</select>";
                        } else {
                            html += "<input class='form-control' type='text' name='slcons[]' placeholder='Value' value='" + d.status + "'></input>";
                        }

                        html += "</div>";




                        html += "<div class='col-1 float-left '><a href='javascript:;' onclick='delacts(\"" + d.id + "\", " + id + " , \"" + name + "\")'><i class='fa fa-trash-alt mt-2 text-danger'></i></a></div></div>";
                        $('#diveditact').append(html);
                    });
                }
            });
            // $('#btn-edit-cons').html("<a href='javascript:;' onclick='editaddcons(" + data.room + ")'><i class='fa fa-plus-circle mt-2 ml-2 text-success'></i></a>");

            // $.ajax({
            //     url: '/backend/getcondition/' + data.room,
            //     type: 'get',
            //     success: function (res) {



            //         $.each(data.condition, function (s, d) {
            //             html = "";
            //             html = "<div class='row m-0 pt-2'>";


            //             var idtx = makeid(4);
            //             html += "<div class='col-5 p-0 float-left'>";
            //             html += "<select class='form-control' name='sldevice[]' onchange='fncgetconslist2(\"" + idtx + "\", this.value)'>";
            //             $.each(res.device, function (i, k) {
            //                 if (d.device_id == k.id) {
            //                     html += "<option value='" + k.id + "' selected>" + k.name + "</a>";
            //                 } else {
            //                     html += "<option value='" + k.id + "'>" + k.name + "</a>";
            //                 }
            //             });
            //             html += "</select></div>";




            //             html += "<div class='col-5 p-0 float-left ml-2'>";
            //             html += "<select class='form-control' name='slcons[]' id='" + idtx + "_slconslist2'>";
            //             $.each(res.list, function (i, k) {
            //                 if (d.condition_list_id == k.id) {
            //                     html += "<option value='" + k.id + "' selected>" + k.name + "</a>";
            //                 } else if (k.device_type == data.list) {
            //                     html += "<option value='" + k.id + "'>" + k.name + "</a>";
            //                 }
            //             });
            //             html += "</select></div>";


            //             html += "<div class='col-1 float-left'><a href='javascript:;' onclick='delcons(\"" + d.id + "\", " + id + " , \"" + name + "\")'><i class='fa fa-trash-alt mt-2 text-danger'></i></a></div></div>";
            //             $('#diveditcons').append(html);
            //         });


            //     }
            // });
        }
    })
    $('.delactall').html("<a href='javascript:;' onclick='btndelactall(" + id + ")'><button type='button' class='btn btn-danger mt-4'>Delete</button></a>");
    $('#modal-editact').modal('show');

}





delcons = (id, reid, name) => {
    swal({
        title: 'Alert',
        text: 'Are you sure that you want to delete this condition?',
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
                url: '/backend/delcons',
                type: 'post',
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    id: id,
                },
                success: function (data) {
                    if (data) {
                        btneditcons(reid, name);
                    }
                }
            });
        }
    });

};





delacts = (id, reid, name) => {
    swal({
        title: 'Alert',
        text: 'Are you sure that you want to delete this action?',
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
                url: '/backend/delacts',
                type: 'post',
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    id: id,
                    template_id: reid,
                },
                success: function (data) {

                    if (data) {
                        btneditact(reid, name);
                    }
                }
            });
        }
    });

};




editaddcons = (room) => {

    var id = makeid(4);
    var html = "";


    $.ajax({
        url: '/backend/getcondition/' + room,
        type: 'get',
        success: function (data) {


            html = "<div class='row m-0 pt-2' id='" + id + "' >";


            html += "<div class='col-5 p-0 float-left'><select class='form-control' name='sldevice[]' onchange='fncgetconslist2(\"" + id + "\", this.value)' >";
            html += "<option value='0' selected>-- Device Type --</option>";
            $.each(data.device, function (i, k) {
                html += "<option value='" + k.id + "'>" + k.name + "</option>";
            });
            html += "</select></div>";


            html += "<div class='col-5 p-0 float-left' id='er_" + id + "'><div class='col-11 p-0 float-left ml-2'><select class='form-control' name='slcons[]' id='" + id + "_slconslist2'>";
            html += "<option value='0' selected>-- Condition --</option>";
            // $.each(data.condition, function (i, k) {
            //     html += "<option value='" + k.id + "'>" + k.name + "</a>";
            // });
            html += "</select></div></div>";

            html += "<div class='col-1 float-left '><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 text-danger'></i></a></div></div>";
            $('#diveditcons').append(html);





            // html = "";
            // html += "<div class='row m-0 pt-2' id='" + id + "'>";


            // html += "<div class='col-5 p-0 float-left'><select class='form-control' name='sldevice[]' onchange='fncgetconslist2(\"" + id + "\", this.value)'>";
            // html += "<option value='0' selected>-- Device --</option>";
            // $.each(data.device, function (i, k) {
            //     html += "<option value='" + k.id + "'>" + k.name + "</a>";
            // });
            // html += "</select></div>";


            // html += "<div class='col-5 p-0 float-left ml-2'><select class='form-control' name='slcons[]' id='" + id + "_slconslist2'>";
            // html += "<option value='0' selected>-- Condition --</option>";
            // $.each(data.condition, function (i, k) {

            //     html += "<option value='" + k.id + "'>" + k.name + "</a>";
            // });
            // html += "</select></div>";

            // html += "<div class='col-1 float-left '><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 text-danger'></i></a></div></div>";

            // $('#diveditcons').append(html);
        }
    });



}




btndelall = (id) => {
    swal({
        title: 'Alert',
        text: 'Are you sure that you want to delete template?',
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
                url: '/backend/conditiondelall',
                type: 'post',
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    id: id,
                },
                success: function (data) {
                    if (data) {
                        swal("Removed successfully!", "", "success").then((isConfirm) => {
                            location.reload();
                        });
                    }
                }
            });
        }
    });

};




btndeldelay = (id) => {
    swal({
        title: 'Alert',
        text: 'Are you sure that you want to delete delay?',
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
                url: '/backend/delaydelall',
                type: 'post',
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    id: id,
                },
                success: function (data) {
                    if (data) {
                        swal("Removed successfully!", "", "success").then((isConfirm) => {
                            location.reload();
                        });
                    }
                }
            });
        }
    });

};




btndelactall = (id) => {
    swal({
        title: 'Alert',
        text: 'Are you sure that you want to delete template?',
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
                url: '/backend/actiondelall',
                type: 'post',
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    id: id,
                },
                success: function (data) {
                    if (data) {
                        swal("Removed successfully!", "", "success").then((isConfirm) => {
                            location.reload();
                        });
                    }
                }
            });
        }
    });

};






addautocons = () => {
    var id = makeid(4);
    var html = "";
    $.ajax({
        url: '/backend/automation/getroom',
        type: 'get',
        success: function (data) {
            html = "<div class='row m-0 pt-2' id='" + id + "' >";
            html += "<div class='col-5 p-0 float-left'><select class='form-control' onchange='fncgetcons(\"" + id + "\", this.value)' >";
            html += "<option value='0'>-- Room --</a>";
            $.each(data.room, function (i, k) {
                html += "<option value='" + k.id + "'>" + k.name + "</a>";
            });
            html += "</select></div>";
            html += "<div class='col-5 p-0 float-left ml-2'><select class='form-control' id='cons" + id + "' name='data[]' >";
            html += "</select></div>";
            html += "<div class='col-1 float-left pl-2'><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 ml-2 text-danger'></i></a></div></div>";
            $('#divautocons').append(html);
        }
    });

}

adddelay = () => {
    var id = makeid(4);
    var html = "";
    html = "<div class='row m-0 pt-2' id='" + id + "'>";
    html += "<div class='col-4 p-0 float-left'><select class='form-control'><option value='Delay' selected>Delay</option></select></div>";
    html += "<div class='col-3 p-0 float-left ml-1'><input type='hidden' class='form-control' name='data[]' value='delay'><input type='number' class='form-control' name='delay_val[]' value='0'></div>";
    html += "<div class='col-3 p-0 float-left ml-1'><select class='form-control' name='delay_type[]'>";
    html += "<option value='0' selected>Millisecond</option>";
    html += "<option value='1'>Second</option>";
    html += "<option value='2'>Minute</option>";
    html += "</select></div>";
    html += "<div class='col-1 float-left pl-2'><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 ml-2 text-danger'></i></a></div></div>";
    $('#divautoact').append(html);
}



editautodelay = () => {
    var id = makeid(4);
    var html = "";
    html = "<div class='row m-0 pt-2' id='" + id + "'>";
    html += "<div class='col-4 p-0 float-left'><select class='form-control'><option value='Delay' selected>Delay</option></select></div>";
    html += "<div class='col-3 p-0 float-left ml-1'><input type='hidden' class='form-control' name='data[]' value='delay_new'><input type='number' class='form-control' name='delay_val[]' value='0'></div>";
    html += "<div class='col-3 p-0 float-left ml-1'><select class='form-control' name='delay_type[]'>";
    html += "<option value='0' selected>Millisecond</option>";
    html += "<option value='1'>Second</option>";
    html += "<option value='2'>Minute</option>";
    html += "</select></div>";
    html += "<div class='col-1 float-left pl-2'><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 ml-2 text-danger'></i></a></div></div>";
    $('#diveditautoact').append(html);
}




addautoact = () => {
    var id = makeid(4);
    var html = "";
    $.ajax({
        url: '/backend/automation/getroom',
        type: 'get',
        success: function (data) {
            html = "<div class='row m-0 pt-2' id='" + id + "' >";
            html += "<div class='col-5 p-0 float-left'><select class='form-control' onchange='fncgetact(\"" + id + "\", this.value)' >";
            html += "<option value='0'>-- Room --</a>";
            $.each(data.room, function (i, k) {
                html += "<option value='" + k.id + "'>" + k.name + "</a>";
            });
            html += "</select></div>";
            html += "<div class='col-5 p-0 float-left ml-2'><select class='form-control' id='act" + id + "' name='data[]' >";
            html += "</select></div>";
            html += "<div class='col-1 float-left pl-2'><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 ml-2 text-danger'></i></a></div></div>";
            $('#divautoact').append(html);
        }
    });

}




fncgetcons = (id, val) => {
    if (val != 0) {
        $.ajax({
            url: '/backend/automation/getcondition/' + val,
            type: 'get',
            success: function (data) {
                var html = "";
                $.each(data, function (i, k) {
                    html += "<option value='" + k.id + "'>" + k.name + "</option>";
                });
                $('#cons' + id).html(html);
            }
        });

    } else {
        $('#cons' + id).html("");
    }

}





fncgetact = (id, val) => {

    if (val != 0) {
        $.ajax({
            url: '/backend/automation/getaction/' + val,
            type: 'get',
            success: function (data) {
                var html = "";
                $.each(data, function (i, k) {
                    html += "<option value='" + k.id + "'>" + k.name + "</option>";
                });
                $('#act' + id).html(html);
            }
        });

    } else {
        $('#act' + id).html("");
    }

}





btneditautomation = (id, name, opr) => {

    $('#nameeditau').val(name);
    $('#nameeditauid').val(id);


    if (opr === "AND") {
        $('#eopr1').prop("checked", true);
    }
    if (opr === "OR") {
        $('#eopr2').prop("checked", true);
    }
    $.ajax({
        url: '/backend/automation/getroom',
        type: 'get',
        success: function (room) {

            $.ajax({
                url: '/backend/automation/template/' + id,
                type: 'get',
                success: function (data) {

                    $('#diveditautocons').html("");
                    $('#diveditautoact').html("");
                    $.each(data, function (i, k) {
                        var xid = makeid(4);
                        if (k.type == "Condition") {
                            html = "<div class='row m-0 pt-2' id='" + xid + "' >";
                            html += "<div class='col-5 p-0 float-left'><select class='form-control' onchange='fncgetcons(\"" + xid + "\", this.value)' >";
                            html += "<option value='0'>-- Room --</a>";
                            $.each(room.room, function (s, j) {
                                if (k.room_id == j.id) {
                                    html += "<option value='" + j.id + "' selected>" + j.name + "</a>";
                                } else {
                                    html += "<option value='" + j.id + "'>" + j.name + "</a>";
                                }
                            });
                            html += "<option value='Delay'>Delay</option>";
                            html += "</select></div>";
                            html += "<div class='col-5 p-0 float-left ml-2'><select class='form-control' id='cons" + xid + "' name='data[]' >";
                            html += "<option value='" + k.id + "' selected>" + k.name + "</option>";
                            html += "</select></div>";
                            html += "<div class='col-1 float-leditautoactft pl-2'><a href='javascript:;' onclick='delautomation(\"" + k.id + "\", \"" + id + "\", \"" + name + "\", \"" + opr + "\")'><i class='fa fa-trash-alt mt-2 ml-2 text-danger'></i></a></div></div>";
                            $('#diveditautocons').append(html);
                        } else if (k.type == "Action") {

                            html = "<div class='row m-0 pt-2' id='" + xid + "' >";
                            html += "<div class='col-5 p-0 float-left'><select class='form-control' onchange='fncgetact(\"" + xid + "\", this.value)' >";
                            html += "<option value='0'>-- Room --</a>";
                            $.each(room.room, function (s, j) {
                                if (k.room_id == j.id) {
                                    html += "<option value='" + j.id + "' selected>" + j.name + "</a>";
                                } else {
                                    html += "<option value='" + j.id + "'>" + j.name + "</a>";
                                }
                            });
                            html += "<option value='Delay'>Delay</option>";
                            html += "</select></div>";
                            html += "<div class='col-5 p-0 float-left ml-2'><select class='form-control' id='act" + xid + "'  name='data[]' >";
                            html += "<option value='" + k.id + "' selected>" + k.name + "</option>";
                            html += "</select></div>";
                            html += "<div class='col-1 float-left pl-2'><a href='javascript:;' onclick='delautomation(\"" + k.id + "\", \"" + id + "\", \"" + name + "\",  \"" + opr + "\")'><i class='fa fa-trash-alt mt-2 ml-2 text-danger'></i></a></div></div>";
                            $('#diveditautoact').append(html);
                        } else if (k.type == "Delay") {
                            html = "<div class='row m-0 pt-2' id='" + id + "'>";
                            html += "<div class='col-4 p-0 float-left'><select class='form-control'><option value='Delay' selected>Delay</option></select></div>";
                            html += "<div class='col-3 p-0 float-left ml-1'><input type='hidden' class='form-control' name='data[]' value='delay'>";
                            if (k.name.indexOf("Milisecond") != -1) {
                                html += "<input type='number' class='form-control' name='delay_val[]' value='" + k.value + "'></div>";
                                html += "<div class='col-3 p-0 float-left ml-1'><select class='form-control' name='delay_type[]'>";
                                html += "<option value='0' selected>Millisecond</option>";
                                html += "<option value='1'>Second</option>";
                                html += "<option value='2'>Minute</option>";
                                html += "</select></div>";
                            } else if (k.name.indexOf('Second') != -1) {

                                html += "<input type='number' class='form-control' name='delay_val[]' value='" + (k.value / 1000) + "'></div>";
                                html += "<div class='col-3 p-0 float-left ml-1'><select class='form-control' name='delay_type[]'>";
                                html += "<option value='0'>Millisecond</option>";
                                html += "<option value='1' selected>Second</option>";
                                html += "<option value='2'>Minute</option>";
                                html += "</select></div>";
                            } else {

                                html += "<input type='number' class='form-control' name='delay_val[]' value='" + (k.value / 60 / 1000) + "'></div>";
                                html += "<div class='col-3 p-0 float-left ml-1'><select class='form-control' name='delay_type[]'>";
                                html += "<option value='0'>Millisecond</option>";
                                html += "<option value='1'>Second</option>";
                                html += "<option value='2' selected>Minute</option>";
                                html += "</select></div>";
                            }

                            html += "<div class='col-1 float-left pl-2'><a href='javascript:;' onclick='delautomation(\"" + k.id + "\", \"" + id + "\", \"" + name + "\",  \"" + opr + "\")'><i class='fa fa-trash-alt mt-2 ml-2 text-danger'></i></a></div></div>";


                            //bell
                            // html = "<div class='row m-0 pt-2' id='" + xid + "' >";
                            // html += "<div class='col-5 p-0 float-left'><select class='form-control' onchange='fncgetact(\"" + xid + "\", this.value)' >";
                            // html += "<option value='0'>-- Room --</a>";
                            // $.each(room.room, function (s, j) {
                            //     html += "<option value='" + j.id + "'>" + j.name + "</a>";
                            // });
                            // html += "<option value='Delay' selected>Delay</option>";
                            // html += "</select></div>";
                            // html += "<div class='col-5 p-0 float-left ml-2'><select class='form-control' id='act" + xid + "'  name='data[]' >";
                            // html += "<option value='" + k.type + "' selected>" + k.name + "</option>";
                            // html += "</select></div>";
                            // html += "<div class='col-1 float-left pl-2'><a href='javascript:;' onclick='delautomation(\"" + k.id + "\", \"" + id + "\", \"" + name + "\",  \"" + opr + "\")'><i class='fa fa-trash-alt mt-2 ml-2 text-danger'></i></a></div></div>";
                            $('#diveditautoact').append(html);
                        }
                    });

                }


            });
        }
    });
    $('.delautoall').html("<a href='javascript:;' onclick='btndelautoall(" + id + ")'><button type='button' class='btn btn-danger mt-4'>Delete</button></a>");
    $('#modal-editautomate').modal('show');
}






editautocons = () => {
    var id = makeid(4);
    var html = "";
    $.ajax({
        url: '/backend/automation/getroom',
        type: 'get',
        success: function (data) {
            html = "<div class='row m-0 pt-2' id='" + id + "' >";
            html += "<div class='col-5 p-0 float-left'><select class='form-control' onchange='fncgetcons(\"" + id + "\", this.value)' >";
            html += "<option value='0'>-- Room --</a>";
            $.each(data.room, function (i, k) {
                html += "<option value='" + k.id + "'>" + k.name + "</a>";
            });
            html += "</select></div>";
            html += "<div class='col-5 p-0 float-left ml-2'><select class='form-control' id='cons" + id + "' name='data[]' >";
            html += "</select></div>";
            html += "<div class='col-1 float-left pl-2'><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 ml-2 text-danger'></i></a></div></div>";
            $('#diveditautocons').append(html);
        }
    });

}





editautoact = () => {
    var id = makeid(4);
    var html = "";
    $.ajax({
        url: '/backend/automation/getroom',
        type: 'get',
        success: function (data) {
            html = "<div class='row m-0 pt-2' id='" + id + "' >";
            html += "<div class='col-5 p-0 float-left'><select class='form-control' onchange='fncgetact(\"" + id + "\", this.value)' >";
            html += "<option value='0'>-- Room --</a>";
            $.each(data.room, function (i, k) {
                html += "<option value='" + k.id + "'>" + k.name + "</a>";
            });
            html += "<option value='Delay'>Delay</a>";
            html += "</select></div>";
            html += "<div class='col-5 p-0 float-left ml-2'><select class='form-control' id='act" + id + "' name='data[]' >";
            html += "</select></div>";
            html += "<div class='col-1 float-left pl-2'><a href='javascript:;' onclick='deladdcons(\"" + id + "\")'><i class='fa fa-trash-alt mt-2 ml-2 text-danger'></i></a></div></div>";
            $('#diveditautoact').append(html);
        }
    });

}




delautomation = (id, aid, name, opr) => {
    swal({
        title: 'Alert',
        text: 'Are you sure that you want to delete template?',
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
                url: '/backend/automation/delbyid',
                type: 'post',
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    id: id,
                },
                success: function (data) {

                    if (data) {
                        $('#diveditautocons').html("");
                        $('#diveditautoact').html("");
                        btneditautomation(aid, name, opr);
                    }
                }
            });
        }
    });
}




btndelautoall = (id) => {
    swal({
        title: 'Alert',
        text: 'Are you sure that you want to delete automation?',
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
                url: '/backend/automation/delall',
                type: 'post',
                data: {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    id: id,
                },
                success: function (data) {
                    if (data) {
                        swal("Removed successfully!", "", "success").then((isConfirm) => {
                            location.reload();
                        });
                    }
                }
            });
        }
    });
}
