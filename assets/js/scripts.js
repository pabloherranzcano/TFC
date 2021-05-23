// Mostrar dropdown al hacer click en el icono hamburguesa
$(document).ready(function() {
    $('.burger').on('click', function() {
        $('.nav').toggleClass('showing');
        $('.nav ul').toggleClass('showing');
    });
});

// // CKEditor
ClassicEditor
    .create(document.querySelector('#body'), {
        ckfinder: {
            uploadUrl: ' /ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/',
        },
    })
    .catch(error => {
        console.error(error);
    });