/**
 * Created by Donghui Huo on 2016/3/15.
 */
$(document).ready(function () {
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

