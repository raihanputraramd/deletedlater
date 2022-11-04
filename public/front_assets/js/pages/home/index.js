$(".gapro-carousel").slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    speed: 2000,
    autoplaySpeed: 3000,
    variableWidth: true,
    centerMode: true,
    nextArrow: $('.header-carousel-next'),
    prevArrow: $('.header-carousel-prev'),
    responsive: [
        {
            breakpoint: 767,
            settings: {
                dots: false,
                slidesToShow: 1,
                arrows: true,
                variableWidth:true,
            }
        },
        {
            breakpoint: 998,
            settings: {
                dots: false,
                slidesToShow: 1,
                arrows: true,
                variableWidth:true
            },
        }
    ]
});

$(".testimoni-carousel").slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    speed: 2000,
    autoplaySpeed: 3000,
    fade:true,
    nextArrow: $('.testimoni-carousel-next'),
    prevArrow: $('.testimoni-carousel-prev'),
    responsive: [
        {
            breakpoint: 767,
            settings: {
                dots: false,
                slidesToShow: 1,
                arrows: true,
                variableWidth:false
            }
        },
        {
            breakpoint: 998,
            settings: {
                dots: false,
                slidesToShow: 1,
                arrows: true,
                variableWidth:false
            },
        }
    ]
});
