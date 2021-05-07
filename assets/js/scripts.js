// Mostrar menú al hacer click en la hamburguesa
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