/**
 * Created by Donghui Huo on 2016/3/15.
 */
$(document).ready(function () {
    $(".navbar-nav li.active").removeClass("active");
    $(".navbar-nav li." + $("body").attr("id") + "-li").addClass("active");
    $(".navbar-nav li." + $("body").attr("id") + "-li-parent").addClass("active");
    $(".left-menu li." + $("body").attr("id")).addClass("active");
    //do something
    new Swiper('.top-slider .swiper-container', {
        // Optional parameters
        loop: true,
        speed: 600,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        // navigation: {
        //     nextEl: '.swiper-button-next',
        //     prevEl: '.swiper-button-prev',
        // }
    })
});

