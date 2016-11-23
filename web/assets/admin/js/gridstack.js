

$(function () {
    var options = {
        cellHeight: 80,
        verticalMargin: 10
    };
    $('.grid-stack').gridstack(options);
});

// save widget
$("#save-grid").click(function(e){

    e.preventDefault();

    var res = _.map($('.grid-stack .grid-stack-item:visible'), function (el) {
        el = $(el);
        var node = el.data('_gridstack_node');

        // Ajax Store Grid in index Entity
        $.ajax({
            method: "POST",
            url: "/admin/index/gridsave",
            data: {
                id: el.attr('data-custom-id'),
                x: node.x,
                y: node.y,
                width: node.width,
                height: node.height,
                content: el.find( "#editorContent-" + node._id ).html()
            }
        })
            .done(function( msg ) {
                console.log( "x: " + msg.x );
                console.log( "y: " + msg.y );
                console.log( "width: " + msg.width );
                console.log( "height: " + msg.height );
                console.log( "content: " + msg.content );
            });

        /*return {
            id: el.attr('data-custom-id'),
            x: node.x,
            y: node.y,
            width: node.width,
            height: node.height,
            content: el.find( "#editorContent" ).html()
        };*/
    });


    //aalert(JSON.stringify(res));
});

// add widget
$('#add_widget').click(function(){
    var el = $.parseHTML("<div><div class=\"grid-stack-item-content\"/><div/>");
    var grid = $('.grid-stack').data('gridstack');
    grid.addWidget(el, 1, 1, 4, 1, true);
});

// edit widget 1
$(".save").click(function(){
    var content = CKEDITOR.instances.editor1.getData();
    $( "#editorContent-1" ).html( content );
    $("#modal").modal('hide');
});

// EDIT Widget 2
$(".save-2").click(function(){
    var content = CKEDITOR.instances.editor2.getData();
    $( "#editorContent-2" ).html( content );
    $("#modal-2").modal('hide');
})


// ckeditor
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.replace( 'editor1' );
CKEDITOR.replace( 'editor2' );