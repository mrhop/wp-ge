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

    // click menu and the breadcrumb
    document.querySelectorAll('#primary-menu >.menu-item >a').forEach(function (element) {
        var subMenu = element.parentElement.querySelector('.sub-menu');
        if (subMenu != null) {
            element.addEventListener('click', function (e) {
                if (subMenu.style.display === 'block') {
                    subMenu.style.display = 'none'
                } else {
                    subMenu.style.display = 'block'
                }
                e.preventDefault()
                e.stopPropagation()
            })
        }
    })
    document.querySelectorAll('#primary-menu > ul >.page_item >a').forEach(function (element) {
        var subMenu = element.parentElement.querySelector('.children');
        if (subMenu != null) {
            element.addEventListener('click', function (e) {
                if (subMenu.style.display === 'block') {
                    subMenu.style.display = 'none'
                } else {
                    subMenu.style.display = 'block'
                }
                e.preventDefault()
                e.stopPropagation()
            })
        }
    })
    var breadcrumbFirst = document.querySelector('.breadcrumbs >.container > span > a')
    if (breadcrumbFirst) {
        document.querySelector('.breadcrumbs >.container > span > a').addEventListener('click', function (e) {
            e.preventDefault()
        })
    }
    document.body.addEventListener('click', function () {
        document.querySelectorAll('#primary-menu >.menu-item .sub-menu').forEach(function (element) {
            element.style.display = 'none'
        })
    })

});

