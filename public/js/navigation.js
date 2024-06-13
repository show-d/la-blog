(function ($) {


    var icoShowNav = '<i class="icon-circle-arrow-left" title="collapse"></i>'
    var icoHideNav = '<i class="icon-circle-arrow-right" title="expand"></i>'
    var icoCloseNav = '<i class="icon-remove" title="close"></i>'
    var navStr = '<div class="h-nav-container"><p class="title">Navigation</p>'
    var $content = $('.content ')
    var $h2 = $('.content h2')

    if ($h2.size() > 0) {
        navStr += '<ul>'
        $h2.each(function (i, n) {

            var anc = 'h2' + i
            navStr += '<li><a href="#' + anc + '" >' + $(n).text() + '</a>'
            $(n).append('<a name="' + anc + '"></a>')

            var $h3 = $(n).nextUntil('h2', 'h3')
            if ($h3.size() > 0) {
                navStr += '<ul>'
                $h3.each(function (j, n) {
                    var anc = 'h3' + '_' + i + '_' + j
                    navStr += '<li><a href="#' + anc + '" >' + $(n).text() + '</a>'
                    $(n).append('<a name="' + anc + '"></a>')
                })
                navStr += '</ul>'
            }
        })
        navStr += '</ul>'

        navStr += '     <div class="nav-tool">'
            + '            <span id="hideShowNavIco">' + icoHideNav + '</span>'
            + '            <span id="closeNav">' + icoCloseNav + '</span>'
            + '        </div>'
            + ' </div>'

        $content.prepend(navStr)
    }


    var $hNavContainer = $('.h-nav-container')
    var $navTool = $('.nav-tool')
    var hncpr = $hNavContainer.css('padding-right')
    var $hideShowNavIco = $('#hideShowNavIco')
    var navToolHideWidth = 23

    if (!isMobile){
        $(window).scroll(function () {
            var st = $(this).scrollTop()
            var navhHeight = $hNavContainer.height()
            var pos = st > navhHeight ? 'fixed' : ''

            var navToLeft = $content.offset().left + $content.width() - $('.h-nav-container').width()-2
            $hNavContainer.css({
                'position': pos,
                'left': navToLeft
            })

            if (st > navhHeight) {
                $navTool.show()
            } else {
                $navTool.hide()
                recoverNavContainer()
            }

            if ($('.h-nav-container ul:eq(0)').is(':visible')) {
                $hNavContainer.css({"width": 'auto'}) //$content.width()+'px'
            } else {
                $hNavContainer.css({"width": navToolHideWidth+'px'})
            }
        })
    }

    var shortNavWidth
    function recoverNavContainer() {
        var navToLeft = $('.h-nav-container').css('position') === 'relative' ?0 : $content.offset().left + $content.width() -shortNavWidth
        $hideShowNavIco.html(icoHideNav)
        $hNavContainer.css({"width": 'auto', 'padding-right': hncpr,'left':navToLeft})
        $hNavContainer.find('ul').eq(0).show()
        $hNavContainer.find('.title').show()
        $hNavContainer.show()
    }

    function hideNavContainer() {
        shortNavWidth = $('.h-nav-container').width()

        var navToLeft = $content.offset().left + $content.width() - navToolHideWidth-2
        $hideShowNavIco.html(icoShowNav)
        $hNavContainer.find('ul').eq(0).hide()
        $hNavContainer.find('.title').hide()
        $hNavContainer.css({"width": navToolHideWidth+'px', 'padding-right': '0px', 'left': navToLeft})
    }

    $('#hideShowNavIco').click(function () {
        if ($hNavContainer.find('ul').eq(0).is(':visible')) {
            hideNavContainer()
        } else {
            recoverNavContainer()
        }
    })

    $('#closeNav').click(function () {
        $hNavContainer.hide()
    })
})(jQuery)
