$(document).ready(function() {

    if (typeof $('.datatable').length !== 'undefined') {
        $('.datatable').DataTable({
            pageLength: 15,
            lengthMenu: [
                [15, 30, 50, 100, -1],
                [15, 30, 50, 100, "All"]
            ],
            "language": dt_lang
        });
    }

    if (typeof $('.datatable-responsive').length !== 'undefined') {
        $('.datatable-responsive').DataTable({
            responsive: true,
            pageLength: 15,
            lengthMenu: [
                [15, 30, 50, 100, -1],
                [15, 30, 50, 100, "All"]
            ],
            "language": dt_lang
        });
    }

    if (typeof $('#room-list-datatable').length !== 'undefined') {
        $rTable = $('#room-list-datatable').DataTable({
            "pageLength": 15,
            "responsive": true,
            "info": false,
            "bLengthChange": false,
            "order": [
                [1, "desc"]
            ],
            "language": dt_lang
        });

        $('#room-list-datatable_filter').addClass('hide');
        $('#room-list-datatable_paginate').closest('.col-sm-12').removeClass('col-sm-12 col-md-7').addClass('col-md-12');
        $('#search-room-input').keyup(function() {
            $rTable.search($(this).val()).draw();
        })
    }

    if (typeof $('#report-list-datatable').length !== 'undefined') {
        $('#report-list-datatable').DataTable({
            "responsive": true,
            "ordering": true,
            "order": [
                [2, "desc"]
            ],
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "language": dt_lang
        });
    }

    if (typeof $('#request-list-datatable').length !== 'undefined') {
        $('#request-list-datatable').DataTable({
            "order": [
                [0, 'desc'],
            ]
        });
    }

    if (typeof $('#access-list-datatable').length !== 'undefined') {
        $('#access-list-datatable').DataTable({
            "responsive": true,
            "ordering": true,
            "order": [
                [2, "desc"]
            ],
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "language": dt_lang
        });
    }

    if (typeof $('#statistic-table').length !== 'undefined') {
        $('#statistic-table').DataTable({
            responsive: true,
            searching: false,
            paging: false,
            pageLength: 15,
            lengthMenu: [
                [15, 30, 50, 100, -1],
                [15, 30, 50, 100, "All"]
            ],
            "language": dt_lang
        });
    }
});