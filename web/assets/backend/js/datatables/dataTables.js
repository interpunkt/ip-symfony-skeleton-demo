//  Datatables init
//  
//  Copyright 2016 by inter-punkt.ag
//  Autor: Selim Imoberdorf
//  --------------------------------------------------------

    var table = $('.table-data').DataTable({
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