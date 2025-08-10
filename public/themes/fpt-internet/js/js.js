$(document).ready(function () {
    $(".slider_goicuoc").slick({
        dots: true,
        autoplay: true,
        slidesToShow: 3,
        infinite: true,
        arrows: true,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    arrows: true,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 900,
                settings: {
                    arrows: true,
                    slidesToShow: 1,
                    infinite: true,
                    centerMode: true,

                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    slidesToShow: 1,
                    centerMode: true,
                    infinite: true
                }
            }
        ]
    });
});

$(document).ready(function () {
    $(".slider_goicuoc_2").slick({
        dots: true,
        autoplay: true,
        slidesToShow: 3,
        infinite: true,
        arrows: true,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    arrows: true,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 900,
                settings: {
                    arrows: true,
                    slidesToShow: 2,
                    infinite: true,
                    centerMode: true,

                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    slidesToShow: 1,
                    centerMode: true,
                    infinite: true
                }
            }
        ]
    });
});
