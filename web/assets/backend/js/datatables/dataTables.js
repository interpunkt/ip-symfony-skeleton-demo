///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Default DataTables
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // Custom Search Field
    $('#searchDefault').on( 'keyup', function () {
        table.search( this.value ).draw();
    });

    var table = $('.table-data').DataTable({
        lengthChange: false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ],
        "bSort" : true,
        "bLengthChange": false,
        "order": [[ 0, "desc" ]],
        "language": {
            "decimal":        "",
            "emptyTable":     "Keine Daten vorhanden.",
            "info":           "_START_ bis _END_ von _TOTAL_ Einträgen",
            "infoEmpty":      "Keine Daten vorhanden",
            "infoFiltered":   "in den Total _MAX_ Einträgen.",
            "infoPostFix":    "",
            "thousands":      "'",
            "lengthMenu":     "_MENU_ Einträge anzeigen",
            "loadingRecords": "Laden …",
            "processing":     "Verarbeiten …",
            "search":         "Suchen:",
            "zeroRecords":    "Keine Resultate gefunden.",
            "paginate": {
                "sFirst": "Erste Seite",
                "sLast": "Letzte Seite",
                "sNext": "Nächste Seite",
                "sPrevious": "Vorherige Seite"
            }
        }
    });

    table.buttons().container()
        .appendTo( '#datatables-export' );

    // Hide Standard Search Field
    $("#DataTables_Table_0_filter").hide();

