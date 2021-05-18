$(document).ready(function() {
    // When user clicks on submit comment to add comment under post
    $(document).on('click', '#submit_comment', function(e) {
        e.preventDefault();
        var postId = $('#postPostId').val();
        var comment_text = $('#comment_text').val();
        /* Si el comentario tiene apóstrofos, genra un conflicto con el string, por lo que anulamos
        cualquier posible apóstrofo que un usuario pueda insertar. */
        if (comment_text.includes("'")) {
            comment_text = comment_text.replace("'", "\\'");

            console.log(comment_text);
        }

        var url = $('#comment_form').attr('action');
        // Stop executing if not value is entered
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
                    alert('There was an error adding comment. Please try again');
                } else {
                    $('#comments-wrapper').prepend(response.comment)
                    $('#comments_count').text(response.comments_count);
                    $('#comment_text').val('');
                }
            }
        });
    });
});