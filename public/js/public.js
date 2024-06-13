function getMobileOs() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;

    if (/windows phone/i.test(userAgent)) {
        return "Windows Phone";
    }

    if (/android/i.test(userAgent)) {
        return "Android";
    }

    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return "iOS";
    }

    return "unknown";
}

var os = getMobileOs()
var isIos = os === 'iOS'
var isAndroid = os === 'Android'
var isWindowsPhone = os === 'Windows Phone'
var isMobile = isIos || isAndroid || isWindowsPhone

function timeConverter(unixTimestamp, yyyyMMdd) {
    var dt = new Date(unixTimestamp * 1000);
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var year = dt.getFullYear();
    var month = months[dt.getMonth()];
    var date = dt.getDate();

    var datePad = date < 10 ? '0' + date : date;
    var tmpM = dt.getMonth() + 1
    var monthPad = tmpM < 10 ? '0' + tmpM : tmpM;

    var hour = dt.getHours() < 10 ? '0' + dt.getHours() : dt.getHours();
    var min = dt.getMinutes() < 10 ? '0' + dt.getMinutes() : dt.getMinutes();
    var sec = dt.getSeconds() < 10 ? '0' + dt.getSeconds() : dt.getSeconds();


    if (yyyyMMdd !== undefined) {
        return year + '-' + monthPad + '-' + datePad + ' ' + hour + ':' + min + ':' + sec
    }

    var time = month + ' ' + date + ', ' + year;//+ ' ' + hour + ':' + min + ':' + sec;
    return time;
}


function lConfirm(tips, yesCallback, cancelCallback) {
    layer.confirm(tips, {
            btn: ['yes', 'no']
        }, yesCallback
        , function () {
            if (cancelCallback != undefined)
                cancelCallback();
        });
}

function alert(tips, milSec, callback) {
    if (milSec > 0) {
        layer.msg(tips, {
            time: milSec
        });
    } else if (callback != undefined)
        layer.alert(tips, callback);
    else
        layer.alert(tips);

    $('.layui-layer-close').parent().hide();

}

function toast(msg, milSec) {
    milSec = milSec == undefined ? 2000 : milSec;
    alert(msg, milSec);
}

function tips(msg, jQElement, milSec, iDirection, bgColor) {
    milSec = milSec == undefined ? 5000 : milSec;
    iDirection = iDirection == undefined ? 2 : iDirection;
    bgColor = bgColor == undefined ? '#212529' : bgColor;
    layer.tips(msg, jQElement, {
        tips: [iDirection, bgColor],
        time: milSec
    });
}

//iframe窗
function showPage(url, title, width, height, scrollbar) {
    width = width == undefined ? '893px' : width;
    height = height == undefined ? '500px' : height;
    scrollbar = scrollbar == undefined ? false : true;

    closeLayer(-1, false);
    return layer.open({
        type: 2,
        title: title,
        shadeClose: true,
        shade: 0.5,
        maxmin: true, //maxmin button
        scrollbar: scrollbar,
        area: [width, height],
        content: [url, 'no'], //iframe url，no = no scroll
    });

}

function showLayer(container, title, width, height, showCloseBtn) {
    width = width == undefined ? '893px' : width;
    height = height == undefined ? '500px' : height;
    title = title == null || title == '' ? false : title;
    showCloseBtn = showCloseBtn == undefined ? 0 : 1;
    return layer.open({
        type: 1,
        title: false,
        closeBtn: showCloseBtn,
        anim: 2,
        shadeClose: true,
        scrollbar: false,
        area: [width, height],
        content: $(container),
    });
}

function closeLayer(idx, closeParent) {
    if (idx == -1) {
        if (closeParent)
            parent.layer.closeAll();
        else
            layer.closeAll();
    } else {
        if (closeParent)
            parent.layer.close(idx);
        else
            layer.close(idx);
    }

}

function showLoading(theme, useShade) {
    theme = theme == undefined ? 0 : theme;
    useShade = useShade == undefined ? false : useShade;
    var index = layer.load(theme, {shade: useShade});
    return index;
}

function waitRedirect(url, milSec) {
    setTimeout(function () {
        location.href = url
    }, milSec)

    var cnt = milSec / 1000
    setInterval(function () {
        $('#spCountdown').html('(' + cnt-- + ')')
    }, 1000)
}

function dateParse(cls, fullFmt) {
    //date parse
    var $date = $(cls)
    if ($date.val() !== undefined) {
        $date.each(function () {
            var $this = $(this)
            var timestamp = $.trim($this.text())
            if (isNaN(timestamp)) {
                return false
            }

            if (fullFmt) {
                $(this).text(timeConverter(timestamp, 'yyyyMMddHHmmss'))
            } else {
                $(this).text(timeConverter(timestamp))
            }

        })
    }
}

String.prototype.replaceAll = function (s1, s2) {
    return this.replace(new RegExp(s1, "gm"), s2)
}

function scrollToElement(ele) {
    $([document.documentElement, document.body]).animate({
        scrollTop: $(ele).offset().top
    }, 500);
}

(function f($) {

    //date parse
    dateParse('.date', false)

    //nav selected
    var pathName = location.pathname
    var $lia = $('.nav-pills li a')
    var addActive = false

    $lia.each(function () {
        var $this = $(this)
        var href = $this.attr('href')
        if (href === '/') {
            return true
        }
        if (pathName.indexOf(href) === 0) {
            $this.parent().addClass('active')
            addActive = true
            return false
        }
    })

    if (!addActive) {
        $lia.eq(0).parent().addClass('active')
    }

    var $waitRedirect = $('#waitRedirect')
    if ($waitRedirect.val() !== undefined) {
        waitRedirect($waitRedirect.attr('data-url'), $waitRedirect.attr('data-seconds'))
    }

    $('#scrollToTop').click(function () {
        scrollToElement('body')
    })

    if ($('.pagination').val() === undefined) {
        $('.index-list hr:last').remove()
    }
})(jQuery)

var checkEmptyTxt = function (ele) {
    if ($.trim($('[name="' + ele + '"]').val()) === '') {
        $('[name="' + ele + '"]').focus()
        return false
    }
    return true
}

function handleCaptcha() {
    $('#captchaImg').attr('src', '/captcha?r=' + Math.random())
    /*    $.getJSON('/captcha/', function (d) {
            if (d.code !== '0') {
                alert(d.message)
                return false
            }

            var data = d.data
            $('[name="captchaCode"]').val('')
            $('#captchaImg').attr('src', data.captchaImgB64)
            $('#captchaId').val(data.captchaId)
        })*/
}

$('#captchaImg').click(function () {
    handleCaptcha()
})


var _token = $('input[name="_token"]').val();
/*$.ajaxSetup({
    headers: { "_token": _token},
    data: {
        "_token": _token
    }
});*/
