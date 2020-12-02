function gNotice() {
    var close = $('#g-notice .close');
    close.click(function () {
        $(this).parents('#g-notice').stop(true, false).slideUp(200)
    })
}

// 2020.10.08 添加导航交互样式 - 新版
function gMenuHover() {
    var nav = $('#nav'),
        navItem = $('#menu-list .menu-item');
    nav.mouseleave(function () {
        nav.removeClass('navActive');
        $(this).find('.item-children').stop(true, false).slideUp(200);
        $(this).find('.menu-item').removeClass('menu-item-active');
    });
    navItem.mouseenter(function () {
        var _this = this,
            _thisItemDom = $(_this).children('.item-children');
        nav.addClass('navActive');
        $(_this).siblings('li').removeClass('menu-item-active');
        $(_this).addClass('menu-item-active');
        navItem.toArray().forEach(function (item) {
            var itemDom = $(item).children('.item-children');
            if (itemDom.css('display') === 'block') {
                _thisItemDom.css('display', 'block');
                if (_thisItemDom.length === 0) {
                    $(_this).siblings('li').children('.item-children').stop(true, false).slideUp(200)
                } else {
                    $(_this).siblings('li').children('.item-children').css('display', 'none');
                }
            }
        });
        $(_this).children('.item-children').stop(true, false).slideDown(200)
    });
}

//全局侧边栏的返回顶部的按钮
function gTop() {
    var g_top = $("#g-top");
    g_top.click(function () {
        $("html,body").animate({"scrollTop": 0}, 300);
    });
}

//1、判断滚动条是向上还是向下滚动
function pageScroll() {
    var p = 0,
        t = 0;
    var header = $('.g-hd'),
        noticeHeight = $('.g-notice').outerHeight(true) || 0,
        hdHeight = $('.g-hd .hd').outerHeight(true) || 0,
        navHeight = $('.g-hd .nav').outerHeight(true) || 0,
        headerHeight = hdHeight + navHeight;
    $(window).scroll(function () {
        var scrollDom = {
            header: header,
            noticeHeight: noticeHeight,
            hdHeight: hdHeight,
            navHeight: navHeight,
            headerHeight: headerHeight
        };
        p = $(this).scrollTop();
        if (t < p) { // 向下滚动
            scrollDown(p, scrollDom)
        } else { // 向上滚动
            scrollUp(p, scrollDom)
        }
        setTimeout(function () {t = p;}, 0)
    })
}

// todo: 添加渐变的效果完成，下一步代码优化
function scrollDown (p, scrollDom) { //向下滑动
    if (p <= (scrollDom.headerHeight + scrollDom.noticeHeight)) {
        $('.g-section').css('paddingTop', 0 + 'px');
    } else {
        scrollDom.header.css('height', 0 + 'px');
        $('#menu-list .menu-item').children('.item-children').css({'display': 'none'});
        $('.g-section').css('paddingTop', scrollDom.headerHeight + 'px');
        scrollDom.header.addClass('cloneNav');
    }
}

// todo: 添加渐变的效果完成，下一步代码优化
function scrollUp (p, scrollDom) { //向上滑动
    if (p <= scrollDom.noticeHeight) {
        scrollDom.header.removeClass('cloneNav');
        scrollDom.header.css('height', '');
        $('.g-section').css('paddingTop', 0 + 'px');
    } else {
        scrollDom.header.addClass('cloneNav');
        scrollDom.header.css('height', scrollDom.headerHeight + 'px');
        $('.g-section').css('paddingTop', scrollDom.headerHeight + 'px');
    }
}

$(function () {

    gNotice();

    gMenuHover();

    gTop();

    pageScroll()

});
