/**
 * Created by Donghui Huo on 2016/3/15.
 */
$(document).ready(function () {
    var bodyId = $("body").attr("id")
    if (bodyId.indexOf('index') > -1) {
        new Swiper('.top-slider .swiper-container', {
            loop: true,
            speed: 600,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            }
        })
    }
    if ((window.innerHeight + 100) < $(document).height()) {
        $('#top-link-block').removeClass('hidden').affix({
            // how far to scroll down before link "slides" into view
            offset: {top: 100}
        });
    }

    $("#top-link-block a").click(function () {
        $('html,body').animate({scrollTop: 0}, 'slow');
        return false;
    })

});

