/**
 * Created by Donghui Huo on 2016/3/15.
 */
var currentScrollTop = 0
$(document).ready(function () {
    var bodyId = $("body").attr("id")
    $(".navbar-nav li.active").removeClass("active");
    $(".navbar-nav li." + bodyId + "-li").addClass("active");
    $(".navbar-nav li." + bodyId + "-parent-li").addClass("active");
    new Swiper('.top-slider .swiper-container', {
        // Optional parameters
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    })
    document.addEventListener('scroll', function () {
        $('#page .header').removeClass('in')
        $('.navbar-toggle').addClass('collapsed')
        $('.navbar-collapse').removeClass('in')
        if (currentScrollTop > document.documentElement.scrollTop) {
            $('#page .header').removeClass('navbar-scroll-down');
        } else {
            $('#page .header').css('overflow', 'hidden')
            $('#page .header').addClass('navbar-scroll-down');
        }
        currentScrollTop = document.documentElement.scrollTop
        if (currentScrollTop == 0) {
            $('#page .header').css('position', 'relative')
        } else {
            $('#page .header').css('position', 'fixed')
        }
    })
    $('.navbar-toggle').click(function () {
        if ($(this).hasClass('collapsed')) {
            $('#page .header').addClass('in')
        } else {
            $('.navbar-collapse').on('webkitAnimationEnd mozAnimationEnd msAnimationEnd oAnimationEnd animationEnd', function () {
                if (!$(this).hasClass('collapsed')) {
                    $('#page .header').removeClass('in')
                }
            })
        }
    })
    $('#page .header').on('transitionend webkitTransitionEnd oTransitionEnd', function () {
        if (!$('#page .header').hasClass('navbar-scroll-down')) {
            $('#page .header').css('overflow', 'visible')
        }
    })
    document.querySelectorAll('.content-section .section-title').forEach(function (element) {
        var elementWatcher = scrollMonitor.create(element);
        elementWatcher.exitViewport(function () {
            element.classList.remove('fadeInDown');
        });
        elementWatcher.enterViewport(function () {
            element.classList.add('fadeInDown');
        });
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
    if (bodyId.indexOf('index')>-1) {
        var element1 = document.querySelector('.content-section.animate1')
        var elementWatcher1 = scrollMonitor.create(element1);
        elementWatcher1.stateChange(function () {
            $(element1.querySelector('.row .col')).toggleClass('fadeInLeft', this.isInViewport);
            $(element1.querySelector('.row .col:last-child')).toggleClass('fadeInRight', this.isInViewport);
        });
        var element2 = document.querySelector('.content-section.animate2')
        var elementWatcher2 = scrollMonitor.create(element2);
        element2.querySelectorAll('.row .col').forEach(function (e, i, array) {
            var delay = 300 * i
            $(e).css('animation-delay', delay + 'ms')
            $(e).css('-webkit-animation-delay', delay + 'ms')
            elementWatcher2.stateChange(function () {
                $(e).toggleClass('fadeInUp', this.isInViewport);
            });
        })
        if (window.location.hash && window.location.hash.indexOf('about-us') > -1) {
            $('html, body').animate({
                scrollTop: $("section.content-section.about-us").offset().top - 139
            }, 1000);
        }
        $('nav.navbar-default ul li.about-li').on('click', function () {
            $('html, body').animate({
                scrollTop: $("section.content-section.about-us").offset().top - 139
            }, 1000);
        });
    } else if (bodyId.indexOf('layouts')>-1) {
        $('.general img.general-img').maphilight()
        var flagOpened = false
        var minWidth = 760
        var availableLabel = 'Available:'
        var unavailableLabel = 'Unavailable:'
        var sizeLabel = 'Size:'
        var roomsLabel = 'Rooms:'
        if ($("body").hasClass("layout-mg")) {
            availableLabel = 'Захиалах боломжтой:'
            unavailableLabel = 'Захиалах боломжгүй:'
            sizeLabel = 'Талбайн хэмжээ:'
            roomsLabel = 'Өрөөний тоо:'
        }
        $('.general #mapGeneral area').mouseenter(function (e) {
            var title = $(this).data('title')
            var available = $(this).data('available')
            var unavailable = $(this).data('unavailable')
            var rooms = $(this).data('rooms')
            $('.content-section .tool-tip').css({
                top: (e.pageY - document.documentElement.scrollTop - 10),
                left: (e.pageX - document.documentElement.scrollLeft + 20),
                display: 'block'
            }).html('<h5>' + title + '</h5><p>' + availableLabel + '&nbsp;' + available + '</p><p>' + unavailableLabel + '&nbsp;<span style="text-decoration: line-through">' + unavailable + '</span></p>').addClass('fadeIn');
        }).mousemove(function (e) {
            $('.content-section .tool-tip').css({
                top: (e.pageY - document.documentElement.scrollTop - 10),
                left: (e.pageX - document.documentElement.scrollLeft + 20)
            });
        }).mouseleave(function (e) {
            $('.content-section .tool-tip').css({
                display: 'none'
            }).removeClass('fadeIn');
        })
        $('.general #mapGeneral area').click(function (e) {
            var curentTarget = $('.flat-1 .subwrapper .' + $(this).data('2d'))
            if ($(window).outerWidth() > minWidth) {
                if (!flagOpened) {
                    curentTarget.css('display', 'block').css('transition', '400ms width linear').css('width', function () {
                        return $('.flat-1').width() - 382
                    }).on('webkitTransitionEnd oTransitionEnd transitionend msTransitionEnd', function () {
                        curentTarget.find('.sub-img').maphilight()
                        curentTarget.find('map').imageMapResize()
                    })
                    flagOpened = true
                } else {
                    $('.flat-1 .subwrapper .sub').css('display', 'none')
                    $('.flat-1 .subwrapper .' + $(this).data('2d')).css('display', 'block').css('width', function () {
                        return $('.flat-1').width() - 382
                    })
                    curentTarget.find('.sub-img').maphilight()
                    curentTarget.find('map').imageMapResize()
                }
            } else {
                $('.flat-1 .general').css('transition', '400ms width linear').css('width', 0)
                $('.flat-1 .subwrapper .' + $(this).data('2d')).css('display', 'block').css('transition', '400ms width linear').css('width', function () {
                    return $('.flat-1').width()
                }).on('webkitTransitionEnd oTransitionEnd transitionend msTransitionEnd', function () {
                    curentTarget.find('.sub-img').maphilight()
                    curentTarget.find('map').imageMapResize()
                })
                $('.flat-1 .subwrapper .close-icon').click(function () {
                    $('.flat-1 .general').css('transition', '400ms width linear').css('width', 382)
                    $('.flat-1 .subwrapper .sub').css('display', 'none').css('transition', 'none').css('width', 0)
                })
            }

            // 给出必须的hide和显示
            e.preventDefault();
        })
        $('.content-section .modal').click(function (e) {
            if (e.target.classList.contains('modal')) {
                $('.content-section .modal').css('display', 'none')
            }
        })
        $('.content-section .modal .close-icon').click(function () {
            $('.content-section .modal').css('display', 'none')
        })
        $('.content-section .subwrapper map area').mouseenter(function (e) {
            var title = $(this).data('title')
            var size = $(this).data('size')
            var rooms = $(this).data('rooms')
            $('.content-section .tool-tip').css({
                top: (e.pageY - document.documentElement.scrollTop - 10),
                left: (e.pageX - document.documentElement.scrollLeft + 20),
                display: 'block'
            }).html('<h5>' + title + '</h5><p>' + sizeLabel + '&nbsp;' + size + '</p><p>' + roomsLabel + '&nbsp;' + rooms + '</p>').addClass('fadeIn');
        }).mousemove(function (e) {
            $('.content-section .tool-tip').css({
                top: (e.pageY - document.documentElement.scrollTop - 10),
                left: (e.pageX - document.documentElement.scrollLeft + 20)
            });
        }).mouseleave(function (e) {
            $('.content-section .tool-tip').css({
                display: 'none'
            }).removeClass('fadeIn');
        })
        $('.content-section .subwrapper map area').click(function (e) {
            $('.content-section .modal').css('display', 'flex')
            $('.content-section .modal .container')[0].scrollTop = 0
            $('.content-section .modal div.sub').css('display', 'none')
            $('.content-section .modal div.' + e.currentTarget.id).css('display', 'block')
            e.preventDefault()
        })
    } else if (bodyId.indexOf('design-') >= 0) {
        var swiperGallery = new Swiper('.mask.big-img .swiper-container', {
            // Optional parameters
            init: false,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            lazy: {
                loadPrevNext: true,
            },
        })
        $('.mask.big-img img.close-icon').click(function () {
            $('.mask.big-img').hide()
        })
        $('.mask.big-img').click(function (e) {
            if (!e.target.classList.contains('swiper-button-prev') && !e.target.classList.contains('swiper-button-next') && !e.target.classList.contains('slide-image'))
                $('.mask.big-img').hide()
        })
        $('.content-section .mask').click(function (e) {
            $('.mask.big-img').show()
            swiperGallery.init()
            swiperGallery.slideTo($(this).data('related'), 0)
        })
    }
});

