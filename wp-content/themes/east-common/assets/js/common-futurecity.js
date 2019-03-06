/**
 * Created by Donghui Huo on 2016/3/15.
 */
$(document).ready(function () {
    if (utilFun.browser.versions.mobile || utilFun.browser.versions.android || utilFun.browser.versions.ios) {
        //手机端样式重置
        $("body").addClass("navbar-mobile");
    }
    if ($("#home").size() > 0) {
        if (utilFun.browser.versions.mobile || utilFun.browser.versions.android || utilFun.browser.versions.ios) {
            //手机端重置高度
            var number = document.body.clientHeight / document.body.clientWidth * 1300;
            $("#home").css("height", number + "px");
            $(".index-container .mask>.container-fluid>.colum").css("height", (number - 160) + "px");
            window.addEventListener('orientationchange', function () {
                var timeout,
                    end = function () {
                        clearTimeout(timeout);
                        timeout = null;
                    };
                timeout = setTimeout(function () {
                    // The timeout happened first.
                    $("#home").css("height", "100%");
                    var number = document.body.clientHeight / document.body.clientWidth * 1300;
                    $("#home").css("height", number + "px");
                    $(".index-container .mask>.container-fluid>.colum").css("height", (number - 160) + "px");
                    end();
                }, 400);
            });
        }
        var home_section_flag = true;
        var media_first_flag = true;
        $('#home .flexslider').flexslider({
            fadeFirstSlide: false,
            controlNav: false,
            directionNav: false,
            animationSpeed: 1000,
            slideshowSpeed: 5000,
            slideshow: true,
            start: function (slider) {
                utilFun.animate("#home .flex-active-slide .animated");
            },
            before: function () {
                utilFun.hide("#home .flex-active-slide .animated");
            },
            after: function (slider) {
                utilFun.animate("#home .flex-active-slide .animated");
            }
        });
        $('#home .flexslider .flex-caption').hover(function () {
            $(this).find(".glyphicon-play-circle").fadeTo(200, 0.8);
        }, function () {
            $(this).find(".glyphicon-play-circle").fadeTo(200, 0.0);
        })

        $('#home .scroll-div').perfectScrollbar({"maxScrollbarLength": 50});
        //！！！需要继续处理
        $('#home .scroll-div .ps-scrollbar-y').mousedown(function () {
            $('#home').one('mouseup', function (e) {
                home_section_flag = false;
            });
        })
        $('#home .news-a').click(function () {
            if (!$('#home .news-a').hasClass("active") && home_section_flag) {
                home_section_flag = false;
                if ($(".mask .container-fluid.active").length > 0) {
                    utilFun.animateWithAction($(".mask .container-fluid.active"), "fadeOutLeft", "fadeInLeft", function () {
                        $(".mask .container-fluid.active").removeClass("active")
                        $(".navbar-fixed-bottom .pull-left a").removeClass("active")
                        $('#home .news-a').addClass("active")
                        utilFun.animateWithAction($(".mask .container-fluid.news"), "fadeInLeft", "fadeOutLeft", function () {
                            $(".mask .container-fluid.news").addClass("active");
                            $(".mask > .container-fluid:not(.active)").css("visibility", 'hidden')
                            home_section_flag = true;
                        });
                    });
                } else {
                    $(".navbar-fixed-bottom .pull-left li").removeClass("active")
                    $(this).addClass("active")
                    $(".navbar-fixed-bottom").css("opacity", 1);
                    $(".mask").css("visibility", "visible");
                    utilFun.animateWithAction($(".mask .container-fluid.news"), "fadeInLeft", "fadeOutLeft", function () {
                        $(".mask .container-fluid.news").addClass("active");
                        home_section_flag = true;
                    });
                }
            }
        })
        // $('#home .press-a').click(function () {
        //     if (!$('#home .press-a').hasClass("active") && home_section_flag) {
        //         home_section_flag = false;
        //         if ($(".mask > .container-fluid.active").length > 0) {
        //             utilFun.animateWithAction($(".mask > .container-fluid.active"), "fadeOutLeft", "fadeInLeft", function () {
        //                 $(this).css("visibility",'hidden')
        //                 $(".mask > .container-fluid.active").removeClass("active")
        //                 $(".navbar-fixed-bottom .pull-left a").removeClass("active")
        //                 $('#home .press-a').addClass("active")
        //                 utilFun.animateWithAction($(".mask > .container-fluid.press"), "fadeInLeft", "fadeOutLeft", function () {
        //                     $(".mask > .container-fluid.press").addClass("active")
        //                     home_section_flag = true;
        //                 });
        //             });
        //         } else {
        //             $(".navbar-fixed-bottom .pull-left li").removeClass("active")
        //             $(this).addClass("active")
        //             $(".navbar-fixed-bottom").css("opacity", 1);
        //             $(".mask").css("visibility", "visible");
        //             utilFun.animateWithAction($(".mask > .container-fluid.press"), "fadeInLeft", "fadeOutLeft", function () {
        //                 $(".mask > .container-fluid.press").addClass("active");
        //                 home_section_flag = true;
        //             });
        //         }
        //
        //     }
        // })
        $('#home .media-a').click(function () {
            if (!$('#home .media-a').hasClass("active") && home_section_flag) {
                home_section_flag = false;
                if ($(".mask > .container-fluid.active").length > 0) {
                    utilFun.animateWithAction($(".mask > .container-fluid.active"), "fadeOutLeft", "fadeInLeft", function () {
                        $(".mask > .container-fluid.active").removeClass("active")
                        $(".navbar-fixed-bottom .pull-left a").removeClass("active")
                        $('#home .media-a').addClass("active")
                        utilFun.animateWithAction($(".mask > .container-fluid.media"), "fadeInLeft", "fadeOutLeft", function () {
                            $(".mask > .container-fluid.media").addClass("active")
                            $(".mask > .container-fluid:not(.active)").css("visibility", 'hidden')
                            if (media_first_flag) {
                                $('.portfoliolist').mixItUp();
                                media_first_flag = false;
                            }
                            home_section_flag = true;
                        });
                    });
                } else {
                    $(".navbar-fixed-bottom .pull-left li").removeClass("active")
                    $(this).addClass("active")
                    $(".navbar-fixed-bottom").css("opacity", 1);
                    $(".mask").css("visibility", "visible");
                    utilFun.animateWithAction($(".mask > .container-fluid.media"), "fadeInLeft", "fadeOutLeft", function () {
                        $(".mask > .container-fluid.media").addClass("active");
                        if (media_first_flag) {
                            $('.portfoliolist').mixItUp();
                            media_first_flag = false;
                        }
                        home_section_flag = true;
                    });
                }

            }
        })

        $('#home .contact-a').click(function () {
            if (!$('#home .contact-a').hasClass("active") && home_section_flag) {
                home_section_flag = false;
                if ($(".mask > .container-fluid.active").length > 0) {
                    utilFun.animateWithAction($(".mask > .container-fluid.active"), "fadeOutLeft", "fadeInLeft", function () {
                        $(".mask > .container-fluid.active").removeClass("active")
                        $(".navbar-fixed-bottom .pull-left a").removeClass("active")
                        $('#home .contact-a').addClass("active")
                        utilFun.animateWithAction($(".mask > .container-fluid.contact"), "fadeInLeft", "fadeOutLeft", function () {
                            $(".mask > .container-fluid.contact").addClass("active")
                            $(".mask > .container-fluid:not(.active)").css("visibility", 'hidden')
                            home_section_flag = true;
                        });
                    });
                } else {
                    $(".navbar-fixed-bottom .pull-left li").removeClass("active")
                    $(this).addClass("active")
                    $(".navbar-fixed-bottom").css("opacity", 1);
                    $(".mask").css("visibility", "visible");
                    utilFun.animateWithAction($(".mask > .container-fluid.contact"), "fadeInLeft", "fadeOutLeft", function () {
                        $(".mask > .container-fluid.contact").addClass("active");
                        home_section_flag = true;
                    });
                }

            }
        })

        $('#home .mask').click(function () {
            if (event.target.className == "mask" && home_section_flag) {
                home_section_flag = false;
                utilFun.animateWithAction($(this).children(".container-fluid.active"), "fadeOutLeft", "fadeInLeft", function () {
                    $(".mask").css("visibility", "hidden");
                    $(".navbar-fixed-bottom").css("opacity", "");
                    $(".mask > .container-fluid").removeClass("active");
                    $(".navbar-fixed-bottom .pull-left a").removeClass("active")
                    home_section_flag = true;
                });
            }
            if (event.target.className == "mask" && !home_section_flag) {
                home_section_flag = true;
            }
        })
        $('#home .mask .glyphicon-remove').click(function () {
            if (home_section_flag) {
                home_section_flag = false;
                utilFun.animateWithAction($(this).parent().parent(), "fadeOutLeft", "fadeInLeft", function () {
                    $(".mask").css("visibility", "hidden");
                    $(".navbar-fixed-bottom").css("opacity", "");
                    $(".mask > .container-fluid").removeClass("active");
                    $(".navbar-fixed-bottom .pull-left a").removeClass("active")
                    home_section_flag = true;
                });
            }
        })
        $('.portfolio-wrapper').hover(function () {
            $(this).find(".label").css("bottom", 0);
        }, function () {
            $(this).find(".label").css("bottom", "-20px");
        })
        $('.portfoliolist').on('mixEnd', function (e, state) {
            $('div.portfolio:visible a.fancyShow').fancybox({
                width: 600,
                height: 400,
                helpers: {
                    title: {
                        type: 'over'
                    }
                }
            });
        });
        //news detail shows content
        $('.news-single .news-brief').click(function () {
            var parent = $(this).parent();
            if ($("body").hasClass("navbar-mobile")) {
                if (parent.height() == 240) {
                    //need to extend
                    parent.height(240 + 550 + $(parent).find('.news-content').outerHeight());
                } else {
                    parent.height(240);
                }
            } else {
                if (parent.height() == 240) {
                    //need to extend
                    parent.height(240 + $(parent).find('.news-content').outerHeight());
                } else {
                    parent.height(240);
                }
            }

        })
        $('.news-single .news-brief .news_title a').click(function (e) {
            e.preventDefault()
        })
        $('#form-newsletter .newsletter-submit').click(function (e) {
            if (!$('#form-newsletter .newsletter-name').val() || !$('#form-newsletter .newsletter-first-name').val() || !$('#form-newsletter .newsletter-email').val() || !$('#form-newsletter .newsletter-job').val() || !$('#form-newsletter .newsletter-message').val()) {
                alert('Fields marked with an asterisk are required');
            } else {
                $.ajax({
                    method: 'GET',
                    url: "http://localhost:8080/cmsbackend/form/sendMail",
                    dataType: "jsonp",
                    data: {
                        toMail: $('#newsletter-toMail').val(), subject: $('#newsletter-subject').val(),
                        content: '<ul><li>Name: ' + $('#form-newsletter .newsletter-name').val() + '</li>' +
                        '<li>First Name: ' + $('#form-newsletter .newsletter-first-name').val() + '</li>' +
                        '<li>Email: ' + $('#form-newsletter .newsletter-email').val() + '</li>' +
                        '<li>Job: ' + $('#form-newsletter .newsletter-job').val() + '</li>' +
                        '<li>Message: ' + $('#form-newsletter .newsletter-message').val() + '</li></ul>'
                    },
                    jsonp: 'callback',
                    jsonpCallback: 'newsletter_callback',
                    success: function (data) {
                        if (data.success) {
                            alert('thank you, we will response to you as soon as possible')
                            $('#form-newsletter')[0].reset();
                        }
                    }
                });
            }
            e.preventDefault()
        })
        //video
        $('#home .bottom-sub li.video').click(function () {
            $('#home .mask-bottom').css("visibility", "visible");
        })
        $('#home .mask-bottom').click(function () {
            $('#home .mask-bottom').css("visibility", "hidden");
        })
        $('#home .mask-bottom .glyphicon-remove').click(function () {
            $('#home .mask-bottom').css("visibility", "hidden");
        })
    } else if ($("#unique-experience").size() > 0) {
        $('#unique-experience .first-container .flexslider').flexslider({
            directionNav: false,
            controlNav: true,
            controlsContainer: ".first-container",
            manualControls: ".first-container .control-nav li.control-label",
            animationSpeed: 1000,
            slideshowSpeed: 3000,
            slideshow: true,
            animation: "fade",
            start: function (slider) {
                $("#unique-experience .first-container  .slider_tip").css("left", (slider.currentSlide * 20 + 10) + "%")
            },
            before: function (slider) {
                console.log(slider.animatingTo);
                console.log(slider.animatingTo * 20 + 10);
                $("#unique-experience .first-container .slider_tip").css("left", (slider.animatingTo * 20 + 10) + "%")
            }
        });

        //third section
        var controller = new ScrollMagic.Controller();
        new ScrollMagic.Scene({triggerElement: ".someone_say .trigger_photo", duration: 300})
            .setTween(".someone_say .arrow", {top: "0"})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".someone_say .trigger_photo", duration: 300})
            .setTween(".someone_say .img", {top: "100px"})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".someone_say .top", duration: 500})
            .setTween(".someone_say .top", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".someone_say .top p:nth-child(1)", duration: 200})
            .setTween(".someone_say .bottom", {opacity: 1})
            .addTo(controller);

        new ScrollMagic.Scene({triggerElement: ".fourth-container div.trigger_p", duration: 100})
            .setTween(".fourth-container .central p.comment", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fourth-container div.trigger_img1", duration: 400})
            .setTween(".fourth-container .central li:nth-child(1) img", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fourth-container div.trigger_img2", duration: 400})
            .setTween(".fourth-container .central li:nth-child(2) img", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fourth-container div.trigger_img3", duration: 400})
            .setTween(".fourth-container .central li:nth-child(3) img", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fourth-container div.trigger_img4", duration: 400})
            .setTween(".fourth-container .central li:nth-child(4) img", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fourth-container div.trigger_img5", duration: 400})
            .setTween(".fourth-container .central li:nth-child(5) img", {opacity: 1})
            .addTo(controller);

        $('#unique-experience .sixth-container .flexslider').flexslider({
            directionNav: false,
            controlNav: true,
            controlsContainer: ".sixth-container",
            manualControls: ".sixth-container .control-nav li",
            animationSpeed: 1000,
            slideshowSpeed: 3000,
            slideshow: true,
            animation: "slide",
            start: function (slider) {
                $("#unique-experience .sixth-container  .slider_tip").css("left", (slider.currentSlide * 20 + 10) + "%")
            },
            before: function (slider) {
                $("#unique-experience .sixth-container .slider_tip").css("left", (slider.animatingTo * 20 + 10) + "%")
            }
        });
    } else if ($("#great-access").size() > 0) {
        var interruptDistanceFun;
        var interruptMinuteFun;
        $('#great-access .second-container .flexslider').flexslider({
            directionNav: false,
            controlNav: true,
            controlsContainer: ".second-container",
            manualControls: ".second-container .control-nav li",
            animationSpeed: 1000,
            slideshowSpeed: 3000,
            slideshow: true,
            animation: "fade",
            start: function (slider) {
                $("#great-access .second-container  .circle_current").css("left", (slider.currentSlide * 12.4 + 11.5) + "%");
                var begin = Number($(".second-container .holder .distance .value").data("value"));
                var end = Number($(".second-container .bottom .control-nav li:nth-child(" + (slider.currentSlide + 1) + ")").data("distance"));
                interruptDistanceFun = utilFun.numberValueChange("number", begin, end, $(".second-container .holder .distance .value"), 80);
                var beginDate = Number($(".second-container .holder .time .value").data("value"));
                var endDate = Number($(".second-container .bottom .control-nav li:nth-child(" + (slider.currentSlide + 1) + ")").data("time"));
                interruptMinuteFun = utilFun.numberValueChange("minute", beginDate, endDate, $(".second-container .holder .time .value"), 80);

            },
            before: function (slider) {
                $("#great-access .second-container .circle_current").css("left", (slider.animatingTo * 12.4 + 11.5) + "%");
                var begin = Number($(".second-container .bottom .control-nav li:nth-child(" + (slider.currentSlide + 1) + ")").data("distance"));
                var end = Number($(".second-container .bottom .control-nav li:nth-child(" + (slider.animatingTo + 1) + ")").data("distance"));
                interruptDistanceFun = utilFun.numberValueChange("number", begin, end, $(".second-container .holder .distance .value"), 80);
                var beginDate = Number($(".second-container .holder .time .value").data("value"));
                var endDate = Number($(".second-container .bottom .control-nav li:nth-child(" + (slider.animatingTo + 1) + ")").data("time"));
                interruptMinuteFun = utilFun.numberValueChange("minute", beginDate, endDate, $(".second-container .holder .time .value"), 80);
            }, after: function (slider) {
                if (interruptDistanceFun) {
                    utilFun.numberValueInterrupt("number", Number($(".second-container .bottom .control-nav li:nth-child(" + (slider.currentSlide + 1) + ")").data("distance")), $(".second-container .holder .distance .value"), interruptDistanceFun);
                }
                if (interruptMinuteFun) {
                    utilFun.numberValueInterrupt("minute", Number($(".second-container .bottom .control-nav li:nth-child(" + (slider.currentSlide + 1) + ")").data("time")), $(".second-container .holder .time .value"), interruptDistanceFun);
                }
            }
        });

        $('#great-access .second-update-container .flexslider').flexslider({
            directionNav: false,
            controlNav: true,
            controlsContainer: ".second-update-container",
            manualControls: ".second-update-container .control-nav > div",
            animationSpeed: 1000,
            slideshowSpeed: 3000,
            slideshow: true,
            animation: "fade"
        });
        var controller = new ScrollMagic.Controller();
        new ScrollMagic.Scene({
            triggerElement: "#great-access .second-container h4",
            duration: 200
        })
            .addTo(controller)
            .on("enter", function (e) {
                if (e.type == "enter") {
                    $("#great-access .third-container ul.number span.number").each(function () {
                        var begin = Number($(this).text());
                        var end = Number($(this).data("value"));
                        if (begin != end) {
                            utilFun.numberValueChange("number", begin, end, $(this), 80);
                        }
                    })
                }
            })
    } else if ($("#eco-responsible-destination").size() > 0) {
        $('#eco-responsible-destination .second-container .flexslider').flexslider({
            directionNav: true,
            controlNav: false,
            animationSpeed: 1000,
            slideshowSpeed: 3000,
            slideshow: false,
            animation: "fade",
            customDirectionNav: $(".custom-navigation a")
        });
        $('#eco-responsible-destination .second-update-container .flexslider').flexslider({
            directionNav: false,
            controlNav: false,
            controlsContainer: ".second-update-container",
            manualControls: ".second-update-container .control-nav li.control-label",
            animationSpeed: 1000,
            slideshowSpeed: 3000,
            slideshow: true,
            animation: "slide"
        });
        $('#eco-responsible-destination .third-container .bottom .icon').click(function () {
            $("#eco-responsible-destination .third-container .bottom .mask").css("visibility", "visible").css("opacity", 1);
            ;
            $("#eco-responsible-destination .third-container .bottom .icon").css("visibility", "hidden").css("opacity", 0);
            $("#eco-responsible-destination .third-container .bottom .icon" + "." + $(this).data("type")).css("visibility", "visible").css("opacity", 1);
            $("#eco-responsible-destination .third-container .bottom  div.content").css("visibility", "hidden").css("opacity", 0);
            $("#eco-responsible-destination .third-container .bottom div.content" + "." + $(this).data("type")).css("visibility", "visible").css("opacity", 1);
        })

        $("#eco-responsible-destination .third-container .bottom .mask").click(function () {
            $("#eco-responsible-destination .third-container .bottom .icon").css("visibility", "visible").css("opacity", 1);
            $("#eco-responsible-destination .third-container .bottom  div.content").css("visibility", "hidden").css("opacity", 0);
            $(this).css("visibility", "hidden").css("opacity", 0);
        })

        var controller = new ScrollMagic.Controller();

        new ScrollMagic.Scene({triggerElement: ".fifth-container div.trigger_1", duration: 200})
            .setTween(".fifth-container .comment", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fifth-container div.trigger_2", duration: 200})
            .setTween(".fifth-container img.top1", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fifth-container div.trigger_3", duration: 200})
            .setTween(".fifth-container img.top2", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fifth-container div.trigger_4", duration: 200})
            .setTween(".fifth-container .top", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fifth-container div.trigger_5", duration: 400})
            .setTween(".fifth-container .bottom .pull-left", {opacity: 1, marginLeft: "270px"})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fifth-container div.trigger_6", duration: 400})
            .setTween(".fifth-container .bottom .pull-right", {opacity: 1, marginRight: "300px"})
            .addTo(controller);

        new ScrollMagic.Scene({triggerElement: ".fourth-container", duration: 300})
            .setTween(".someone_say .arrow", {top: "0"})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fourth-container", duration: 300})
            .setTween(".someone_say .img", {top: "100px"})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fourth-container", duration: 500})
            .setTween(".someone_say .top", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".fourth-container", duration: 200})
            .setTween(".someone_say .bottom", {opacity: 1})
            .addTo(controller);
    } else if ($("#architectural-icon").size() > 0) {
        var controller = new ScrollMagic.Controller();

        new ScrollMagic.Scene({triggerElement: ".first-container div.center img", duration: 200})
            .setTween(".first-container .left-top", {left: "150px", top: "20px"})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".first-container div.center img", duration: 200})
            .setTween(".first-container .right-top", {right: "100px", top: "60px"})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".first-container div.center img", duration: 200})
            .setTween(".first-container .left-bottom", {left: "180px", top: "350px"})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".first-container div.center img", duration: 200})
            .setTween(".first-container .right-bottom", {right: "180px", top: "350px"})
            .addTo(controller);
        $(".second-container .direct .plus").click(function () {
            $(".second-container .direct .plus.selected").removeClass("selected");
            $(this).addClass("selected");
            $(".second-container .main-img.selected").removeClass("selected");
            $(".second-container .main-img" + "." + $(this).data("related")).addClass("selected");
        });
        $(".second-container .direct .glyphicon-remove").click(function () {
            $(".second-container .direct").addClass("closed");
        });
        $(".second-container .direct .glyphicon-chevron-right").click(function () {
            $(".second-container .direct").removeClass("closed");
        });
        $(".second-container .direct").bind($.support.transition.end,
            function () {
                if ($(".second-container .direct").hasClass("closed")) {
                    $(".second-container .direct .glyphicon-remove").hide();
                    $(".second-container .direct .glyphicon-chevron-right").show();
                } else {
                    $(".second-container .direct .glyphicon-remove").show();
                    $(".second-container .direct .glyphicon-chevron-right").hide();
                }
            });
        var controller = new ScrollMagic.Controller();
        new ScrollMagic.Scene({triggerElement: ".someone_say .trigger_photo", duration: 300})
            .setTween(".someone_say .arrow", {top: "0"})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".someone_say .trigger_photo", duration: 300})
            .setTween(".someone_say .img", {top: "100px"})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".someone_say .top", duration: 500})
            .setTween(".someone_say .top", {opacity: 1})
            .addTo(controller);
        new ScrollMagic.Scene({triggerElement: ".someone_say .top p:nth-child(1)", duration: 200})
            .setTween(".someone_say .bottom", {opacity: 1})
            .addTo(controller);

        $('#architectural-icon .fourth-container .flexslider').flexslider({
            directionNav: false,
            controlNav: true,
            controlsContainer: ".fourth-container",
            manualControls: ".fourth-container .control-nav li.control-label",
            animationSpeed: 1000,
            slideshowSpeed: 3000,
            slideshow: true,
            animation: "fade",
            start: function (slider) {
                $("#architectural-icon .fourth-container .control-div").css("margin-top", (-((slider.currentSlide + 1) * 25)) + "px")
            },
            before: function (slider) {
                $("#architectural-icon .fourth-container .control-div").css("margin-top", (-((slider.animatingTo + 1) * 25)) + "px")
            }
        });

        var fifthSlider = $('#architectural-icon .fifth-container .flexslider').flexslider({
            directionNav: false,
            controlNav: true,
            controlsContainer: ".fifth-container",
            manualControls: ".fifth-container .control-nav li.control-label",
            animationSpeed: 1000,
            slideshowSpeed: 3000,
            animationLoop: false,
            slideshow: false,
            animation: "slide"
        });
        $('#architectural-icon .fifth-container .flexslider li.item').click(function () {
            if (!$(this).hasClass("flex-active-slide")) {
                $(fifthSlider).data('flexslider').flexAnimate(($('.fifth-container .flexslider li.item').index($(this))), true);
            }
        })

    } else if ($("#joint-project").size() > 0) {
        $('#joint-project .first-container .flexslider').flexslider({
            directionNav: false,
            controlNav: true,
            controlsContainer: ".first-container",
            manualControls: ".first-container .control-nav li.control-label",
            animationSpeed: 1000,
            slideshowSpeed: 3000,
            slideshow: true,
            animation: "slide",
            before: function (slider) {
                $("#joint-project .first-container .control-div div.circle.direct").css("left", (slider.animatingTo * 14.28 + 7.1) + "%");
            }
        });
    }
});

