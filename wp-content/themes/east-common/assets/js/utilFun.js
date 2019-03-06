/**
 * Created by Donghui Huo on 2016/3/15.
 */
//var $ = require("jQuery");
var utilFun = {
        animate: function (obj) {
            $(obj).each(function () {
                $(this).addClass($(this).data("animated")).css('visibility', 'visible').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $(this).removeClass($(this).data("animated"));
                });
            })
        },
        animateWithAction: function (obj, action, actionremove, callback) {
            $(obj).each(function () {
                $(this).removeClass(actionremove).addClass(action).css('visibility', 'visible').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    if (callback) {
                        callback();
                    }
                });
            })
        },
        hide: function (obj) {
            $(obj).each(function () {
                $(this).css('visibility', 'hidden');
            })
        },
        removeAnimate: function (obj) {
            $(obj).each(function () {
                $(this).removeClass($(this).data("animated"));
            })
        },
        numberValueChange: function (type, begin, end, Object, interval, dataChangeTimes) {
            if (begin != end) {
                dataChangeTimes = dataChangeTimes ? dataChangeTimes : 10;
                var data = Math.abs(begin - end);
                if(data<10){
                    dataChangeTimes = data
                }
                var dataInterval = parseInt(data / dataChangeTimes);
                var lastData = Math.abs(begin - end) % dataChangeTimes;
                if (lastData != 0) {
                    dataChangeTimes += 1;
                }
                var beginTimes = 0;
                var intervalFun = window.setInterval(function () {
                    beginTimes += 1;
                    if (beginTimes < dataChangeTimes) {
                        if (begin > end) {
                            begin = begin - dataInterval
                        } else {
                            begin = begin + dataInterval
                        }
                    } else {
                        if (begin > end) {
                            begin = begin - (lastData==0?dataInterval:lastData)
                        } else {
                            begin = begin + (lastData==0?dataInterval:lastData)
                        }
                    }
                    if (type == "number") {
                        $(Object).text(begin);
                    }else if(type=="minute"){
                        //$(Object).text(parseInt(begin/60)+":"+begin%60);
                        $(Object).text(parseInt(begin/60)+":"+(begin%60>=10?begin%60:'0'+begin%60));
                    }
                    if (begin == end) {
                        window.clearInterval(intervalFun);
                        $(Object).data("value", begin);
                    }
                }, interval ? interval : 100);
                return intervalFun;
            }
            return null;
        },
        numberValueInterrupt: function (type,data, object, intervalFun) {
            window.clearInterval(intervalFun);
            if (type == "number") {
                $(object).text(data);
            }else if(type=="minute"){
                console.log(parseInt(data/60)+":"+(data%60>=10?data%60:'0'+data%60));
                $(object).text(parseInt(data/60)+":"+(data%60>=10?data%60:'0'+data%60));
            }
            $(object).data("value", data);
        },
        browser:{
            versions:function(){
                var u = navigator.userAgent, app = navigator.appVersion;
                return {
                    trident: u.indexOf('Trident') > -1, //IE内核
                    presto: u.indexOf('Presto') > -1, //opera内核
                    webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,//火狐内核
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                    android: u.indexOf('Android') > -1 || u.indexOf('Adr') > -1, //android终端
                    iPhone: u.indexOf('iPhone') > -1 , //是否为iPhone或者QQHD浏览器
                    iPad: u.indexOf('iPad') > -1, //是否iPad
                    webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
                    weixin: u.indexOf('MicroMessenger') > -1, //是否微信 （2015-01-22新增）
                    qq: u.match(/\sQQ/i) == " qq" //是否QQ
                };
            }(),
            language:(navigator.browserLanguage || navigator.language).toLowerCase()
        }
    }
