$('.show-comment-form').click(function () {
    $('#formComment').show()
    $(this).hide()
    checkEmptyTxt('comment')
})

$('#btnComment').click(function () {
    if (!checkEmptyTxt('user_name')) {
        return false
    }
    if (!checkEmptyTxt('comment')) {
        return false
    }
    if (!checkEmptyTxt('captchaCode')) {
        return false
    }

    var idxCmt;
    var formData = $('#formComment').serialize()
    $.ajax({
        type: "POST",
        url: "/comment/addEditCommentAction",
        //dataType: "application/x-www-form-urlencoded",
        data: formData,
        beforeSend: function () {
            idxCmt = showLoading()
        },
        success: function (d) {
            closeLayer(idxCmt)
            toast(d.message)
            //$('#captchaImg').click();
            handleCaptcha();
            if (d.code == 0) {
                //appendComment(d.data)
                //$('#formComment')[0].reset()

                setTimeout(function () {
                    location.reload();
                }, 2000)
            }
        },
        error: function (ex) {
            closeLayer(idxCmt)
            alert(ex.responseText)
        }
    })
})

function appendComment(arr) {
    var tpl = ' <span>   <p class="comment-user-region">                                '
        + '         <a href="{{siteUrl}}" target="_blank">{{user_name}}</a>    '
        + '         <span class="date2">{{input_time}}</span>'
        + '         <span class="address">{{address}}</span>'
        + '    </p>'
        + '    <p class="comment-block"> '
        + '        {{comment}}'
        + '    </p>'
        + '    <hr class="dotted"/>'
        + '    </span>'

    for (var k in arr) {
        var val = arr[k]
        tpl = tpl.replaceAll('{{' + k + '}}', val)
    }

    $('#commentList').prepend(tpl)
    replaceComment()
    dateParse('.date2', true)
    scrollToElement('#commentList')
}

function replaceComment() {
    $('.comment-block').each(function () {
        var $this = $(this)
        $this.html($.trim($this.html()).replaceAll('\n', "<br/>"))
    })
}

handleCaptcha()
replaceComment()
dateParse('.date2', true)

$('.btnRemove').click(function () {
    var $this = $(this)
    var comment = $this.parent().find('.comment-block').text()
    lConfirm("确定要删除这条评论吗 ?<br/>" + comment, function () {
        var cmtIdx = showLoading()
        var contentId = $('[name="content_id"]').val()
        var commentId = $this.attr('data-commentId')
        $.post( '/'+hidBloggoPath+'/deleteCommentAction', {
            "_token": _token,
            "content_id": contentId,
            "comment_id": commentId
        }, function (d) {
            if (d.code === 0) {
                $this.parent().parent().slideUp()
            }

            toast(d.message)
            closeLayer(cmtIdx)
        })
    }, function () {

    })
})
