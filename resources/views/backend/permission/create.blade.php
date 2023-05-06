@extends('layouts.backend')
@section('content')
<style>
    .main {
        width: 100%;
        margin: 0px;
    }

    #group {
        padding-left: 2.375rem;
    }

    .form-group .showico .form-control-icon {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
    }
</style>
<!-- Start @Header -->
@include('backend.partials.header-title')
<!-- End @Header -->
<div class="panel panel-inverse">

    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Add Permission</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body panel-form">
        <form method="POST" action="{{ route('permission.store') }}" class="form-horizontal form-bordered" id="create-form">
            @csrf
            <div class="form-group">

                <div class="pb-2">
                    <label class="font-weight-bold" for="ip">Group</label>
                    <div class="main">
                        <div class="form-group">
                            <span class="showico"><span class="fa fa-search form-control-icon"></span></span>
                            <input type="text" class="form-control" list="list-group" placeholder="Search" id="group" name="Group" required autocomplete="off">
                            <datalist id="list-group"></datalist>
                        </div>
                    </div>

                    <!-- <div class="input-group is-invalid">
                        <input class="form-control" type="text" id="group" name="Group" required />
                        <div class="input-group-append" id="divsearch">
                            <button class="btn btn-green" type="button" id="search_group">ค้นหา</button>
                        </div>
                        <ul class="listgroup list-group" style="position: absolute; z-index: 1000; width: 83%; margin-top: 34px; max-height: 500px; overflow-y: scroll;"></ul>
                    </div> -->
                    <input type="hidden" value="{{$_GET['id']}}" name="fkid">
                    <input type="hidden" value="{{$_GET['type']}}" name="type">

                </div>

                <div class="pb-2">
                    <label class="font-weight-bold" for="name">Group Name</label>
                    <input class="form-control" type="text" id="name" name="name" required readonly />
                </div>

                <div class="pb-2">
                    <label class="font-weight-bold" for="disting">DistinguishedName</label>
                    <input class="form-control" type="text" id="disting" name="disting" required readonly>
                </div>

                <div class="pb-2">
                    <label class="font-weight-bold" for="hours">Hours/Week</label>
                    <input class="form-control" type="number" id="hours" name="hours" min="0" required>
                    <input class="form-control" type="hidden" id="fkid" name="fkid" value="{{$_GET["id"]}}" required readonly>

                </div>

                <div align="right" class="col-md-12 col-sm-12">
                    <button type="submit" class="btn btn-sm btn-primary m-r-5" id="btn-add-device">Submit</button>
                    <a href="{{ url('/backend/room/'.$_GET["id"].'/permission') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    @endsection

    @section('script')

    <script>
        $('body').click(function() {
            $('.list-group').html('');
            $('#search_group').html('ค้นหา');
        });
        $('#btn-add-device').click(function(ev) {
            ev.preventDefault();
            swal({
                title: 'Alert',
                text: 'Are you sure that you want to add permission?',
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
                        className: 'btn btn-info',
                        closeModal: true
                    }
                }
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $("#create-form").submit();
                }
            });
        });





        $('#group').keyup(function() {
            if ($('#group').val().length >= 2) {
                $.ajax({
                    "url": "https://ws.lanna.co.th/Ads/searchgroup",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Content-Type": "application/json"
                    },
                    "data": JSON.stringify({
                        "groupname": $('#group').val()
                    }),

                    beforeSend: function() {
                        $('.showico').html('<i class="fas fa-spinner form-control-icon"></i>');
                    },
                    success: function(response) {

                        var address = [];
                        var id = [];
                        var name = [];
                        $('#list-group').html('');
                        $.each(response, function(i, item) {
                            $list = '<option value="' + item.Name + '">';
                            $('#list-group').append($list)
                            id.push(item.ID);
                            address.push(item.Address);
                            name.push(item.Name);
                            $('.showico').html('<i class="fas fa-check form-control-icon"></i>');
                        });


                        $('#group').on('change', function() {
                            $('#hours').focus();
                            $('#name').val($('#group').val());
                            $.each(name, function(index, data) {
                                if (data == $('#group').val()) {
                                    $('#disting').val(address[index]);
                                    $('#sid').val(id[index]);

                                }
                            });
                        });

                    }
                });

                // .done(function(response) {
                //     var address = [];
                //     var id = [];
                //     var name = [];
                //     $('#list-group').html('');
                //     $.each(response, function(i, item) {
                //         $list = '<option value="' + item.Name + '">';
                //         $('#list-group').append($list)
                //         id.push(item.ID);
                //         address.push(item.Address);
                //         name.push(item.Name);
                //     });


                //     $('#group').on('change', function() {
                //         $('#hours').focus();
                //         $('#name').val($('#group').val());
                //         $.each(name, function(index, data) {
                //             if(data == $('#group').val()){
                //                 $('#disting').val(address[index]);
                //                 $('#sid').val(id[index]);
                //             }
                //         });
                //     });


                // });
            }
        });





        $('#search_group').click(function() {


            var group = $('#group').val();
            if (group.length >= 3) {
                $('.listgroup').empty();
                var pdata = {
                    groupname: $('#group').val()
                };


                $.ajax({
                    url: "https://ws.lanna.co.th/Ads/searchgroup",
                    //url:"http://localhost:54484/api/Adls/searchgroup",
                    type: "POST",
                    datatype: "json",
                    contentType: 'application/json',
                    data: JSON.stringify(pdata),
                    crossDomain: true,
                    beforeSend: function(xhr, opts) {
                        $('#search_group').html('กำลังค้นหา..');
                        //$('#search_group').attr('disabled' , true);
                    },
                    success: function(json) {
                        if (json.length > 0) {
                            $.each(json, function(index, data) {
                                var li = "";
                                li = li + '<li class="list-group-item"><div class="d-flex flex-row justify-content-between align-items-center">' +
                                    '<div class="flex-fill" ><p class="font-weight-medium mb-0"> ' + data.Name + '</p>' +
                                    '<p class="text-muted mb-0 text-small mt-1">' + data.Address + '</p>' +
                                    '<div class="ml-0 mt-1"><button type="button" class="btn btn-xs btn-danger add-user-to-assign-list pl-2 pr-2" data-title="null" ' +
                                    'onclick="addgroup(\'' + data.Name + '\',\'' + data.Address + '\')">Add Group</button></div></div ></li>';
                                $('.listgroup').append(li);
                            });
                        } else {
                            $('#search_group').html('ไม่พบกลุ่ม');
                            setTimeout(function() {
                                $('#search_group').html('ค้นหา');
                            }, 2000);
                        }
                    }

                })
            } else {
                $('#search_group').html('กรุณาพิมพ์ชื่อตั้งแต่ 3 ตัวขึ้นไป');
                setTimeout(function() {
                    $('#search_group').html('ค้นหา');
                }, 2000);
            }


        });


        function addgroup(name, disting) {
            $('.list-group').html('');
            $('#search_group').html('ค้นหา');
            $('#name').val(name);
            $('#disting').val(disting);
        }
    </script>
    @endsection