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
            uploadUrl: '/assets/images/posts_images'
        }
    })
    .then(data => console.log(data))
    .catch(error => {
        console.error(error);
    });