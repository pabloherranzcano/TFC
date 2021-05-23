// Mostrar dropdown al hacer click en el icono hamburguesa
$(document).ready(function() {
    $('.burger').on('click', function() {
        $('.nav').toggleClass('showing');
        $('.nav ul').toggleClass('showing');
    });
});

// CKEditor
CKEDITOR.replace('editor', {
    filebrowserUploadurl: "ckeditor5-build-classic/ck_upload.php",
    filebrowserUploadMethod: "form"
});