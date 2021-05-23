$(document).ready(function() {
    // Cuando el usuario hace click en "enviar comentario".
    $(document).on('click', '#submit_comment', function(e) {
        e.preventDefault();
        var postId = $('#postPostId').val();
        var comment_text = $('#comment_text').val();

        /* Si el comentario tiene apóstrofos, genera un conflicto con el string, por lo que anulamos
        cualquier posible apóstrofo que un usuario pueda insertar. */
        if (comment_text.includes("'")) {
            comment_text = comment_text.replace("'", "\\'");
        }

        var url = $('#comment_form').attr('action');

        // Paramos la ejecución si no se ha itnroducido nada.
        if (comment_text === "")
            return;

        $.ajax({
            url: url,
            type: "POST",
            data: {
                comment_text: comment_text,
                comment_posted: 1,
                postId: postId
            },
            success: function(data) {
                var response = JSON.parse(data);
                console.log(data);
                if (data === "error") {
                    alert('Ha habido un error enviando el comentario. Prueba otra vez.');
                } else {
                    $('#comments-wrapper').prepend(response.comment)
                    $('#comments_count').text(response.comments_count);
                    $('#comment_text').val('');
                }
            }
        });
    });
});