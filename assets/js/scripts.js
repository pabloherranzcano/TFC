// Mostrar dropdown al hacer click en el icono hamburguesa
$(document).ready(function() {
    $('.burger').on('click', function() {
        $('.nav').toggleClass('showing');
        $('.nav ul').toggleClass('showing');
    });
});

// CKEditor
ClassicEditor
    .create(document.querySelector('#body'), {
        ckfinder: {
            uploadUrl: '../../../images/'
        },
    })
    .catch(error => {
        console.error(error);
    });