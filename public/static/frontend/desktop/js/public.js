function gNotice() {
    var close = $('#g-notice .close');
    close.click(function () {
        $(this).parents('#g-notice').slideUp()
    })
}

/*function menuHover () {
    var nav = $('#nav'),
        navItem = $('#menu-list .menu-item');
    navItem.hover(function () {
        nav.addClass('navActive');
        $(this).children('.item-children').css('display', 'block');
    }, function () {
        nav.removeClass('navActive');
        $(this).children('.item-children').css('display', 'none');
    })
}*/

/*function newMenu () {
    var nav = $('#nav'),
        navList = $('#menu-list'),
        navItem = $('#menu-list .menu-item');
    navList.hover(function () {
        nav.addClass('navActive');
    }, function () {
        nav.removeClass('navActive');
    });

    navItem.mouseenter(function () {
        if (nav.hasClass('navActive')) {
            $(this).children('.item-children').css('display', 'block');
        } else {
            $(this).children('.item-children').slideDown(300);
        }
    });
    navItem.mouseleave(function () {
        var x = navList.mouseover();
        console.log(x);
        if (nav.hasClass('navActive')) {
            $(this).children('.item-children').css('display', 'none');
        }
    });
}*/

// 2020.10.08 添加导航交互样式 - 新版
function handelMenuHover() {
    var nav = $('#nav'),
        navItem = $('#menu-list .menu-item');
    nav.mouseleave(function () {
        nav.removeClass('navActive');
    });
    nav.mouseleave(function () {
        $(this).find('.item-children').slideUp(200);
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
                    $(_this).siblings('li').children('.item-children').slideUp(200)
                } else {
                    $(_this).siblings('li').children('.item-children').css('display', 'none');
                }
            }
        });
        $(_this).children('.item-children').slideDown(200)
    });
}

function gTop() {
    var g_top = $("#g-top");
    g_top.click(function () {
        $("html,body").animate({"scrollTop": 0}, 300);
    });
}

$(function () {

    gNotice();

    // menuHover();

    // newMenu();

    handelMenuHover()

    gTop();

});
