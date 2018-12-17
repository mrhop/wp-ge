jQuery(document).ready(function ($) {
    new Swiper('.swiper-container.normal-navigate', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        }
    });
    new Swiper('.swiper-container.multi-3d', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        }
    });
    if ($(window).width() < 768) {
        new Swiper('.swiper-container.multi', {
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            }
        })
    } else {
        new Swiper('.swiper-container.multi', {
            slidesPerView: 2,
            spaceBetween: 30,
            slidesPerGroup: 2,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            }
        });
    }
    var ele_strategy_breadcrumb = $('.strategy-container .breadcrumbs > span[property="itemListElement"]:nth-last-child(3)');
    if (ele_strategy_breadcrumb.length > 0) {
        ele_strategy_breadcrumb.find('> a').attr('href', document.location.href)
        var drop_menu = $('#main-navigation ul.dropdown-menu > li > a[href*="strategy"]')
        if (drop_menu.length > 0) {
            drop_menu.parents('li.menu-item').addClass('current-menu-ancestor')
        }
    }
});
