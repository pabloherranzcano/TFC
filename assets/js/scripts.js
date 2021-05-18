// Mostrar dropdown al hacer click en el icono hamburguesa
$(document).ready(function() {
    $('.burger').on('click', function() {
        $('.nav').toggleClass('showing');
        $('.nav ul').toggleClass('showing');
    });
});

// Carousel Slick
$('.post-wrapper').slick({
    centerMode: true,
    centerPadding: '60px',
    slidesToShow: 4,
    cssEase: 'linear',
    nextArrow: $('.next'),
    prevArrow: $('.prev'),
    responsive: [{
            breakpoint: 1024,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        }
    ]
});

// CKEditor
CKEDITOR.replace('editor', {});


// COMENTARIOS
$(document).ready(function() {
    // When user clicks on submit comment to add comment under pos	t
    $(document).on('click', '#submit_comment', function(e) {
        e.preventDefault();
        var comment_text = $('#comment_text').val();
        var url = $('#comment_form').attr('action');
        // Stop executing if not value is entered
        if (comment_text === "") return;
        $.ajax({
            url: url,
            type: "POST",
            data: {
                comment_text: comment_text,
                comment_posted: 1
            },
            success: function(data) {
                var response = JSON.parse(data);
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
    // When user clicks on submit reply to add reply under comment
    $(document).on('click', '.reply-btn', function(e) {
        e.preventDefault();
        // Get the comment id from the reply button's data-id attribute
        var comment_id = $(this).data('id');
        // show/hide the appropriate reply form (from the reply-btn (this), go to the parent element (comment-details)
        // and then its siblings which is a form element with id comment_reply_form_ + comment_id)
        $(this).parent().siblings('form#comment_reply_form_' + comment_id).toggle(500);
        $(document).on('click', '.submit-reply', function(e) {
            e.preventDefault();
            // elements
            var reply_textarea = $(this).siblings('textarea'); // reply textarea element
            var reply_text = $(this).siblings('textarea').val();
            var url = $(this).parent().attr('action');
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    comment_id: comment_id,
                    reply_text: reply_text,
                    reply_posted: 1
                },
                success: function(data) {
                    if (data === "error") {
                        alert('There was an error adding reply. Please try again');
                    } else {
                        $('.replies_wrapper_' + comment_id).append(data);
                        reply_textarea.val('');
                    }
                }
            });
        });
    });
});