$(document).ready(function() {
    $('input[type="text"][name="flt_search"]').keyup(function() {
        $elem = $(this);
        $("tbody tr").each(function() {
            if($(this).text().toLowerCase().indexOf($elem.val().toLowerCase()) !== -1) {
                $(this).css("display","table-row");
            } else {
                $(this).css("display","none");
            }
        });
    });
});