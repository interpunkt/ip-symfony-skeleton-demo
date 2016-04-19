//  TinyMCE Configuration JS
//  
//  Copyright 2016 by inter-punkt.ag
//  Autor: Selim Imoberdorf
//  --------------------------------------------------------

    tinymce.init({
        mode : "specific_textareas",
        editor_selector : "tinymce",
        height: 500,
        plugins: [
            'autolink lists link image print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
        menubar: false
    });