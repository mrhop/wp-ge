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

    if (bodyId.indexOf('videos') > -1) {
        $('video').click(function (e) {
            var _this = this
            $('video').each(function () {
                if (_this !== this) {
                    if (this.currentTime > 0 && !this.paused && !this.ended && this.readyState > 2) {
                        this.pause()
                        this.controls = true
                    }
                }
            })
            if ((this.currentTime <= 0 || this.paused || this.ended) && this.readyState > 0) {
                this.play()
                this.controls = false
            } else if (this.currentTime > 0 && !this.paused && !this.ended && this.readyState > 2) {
                this.pause()
                this.controls = true
            }
        })
    }

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

