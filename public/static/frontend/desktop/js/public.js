function gNotice () {
    var close = $('#g-notice .close');
    close.click(function () {
        $(this).parents('#g-notice').slideUp()
    })
}

function menuHover () {
    var nav = $('#nav'),
        navItem = $('#menu-list .menu-item');
    navItem.hover(function () {
        nav.toggleClass('navActive');
        $(this).children('.item-children').stop(true, false).fadeToggle(300);
    })
}

function gTop () {
    var g_top = $("#g-top");
    g_top.click(function () {
        $("html,body").animate({"scrollTop": 0}, 300);
    });
}

$(function () {

    gNotice();

    menuHover();

    gTop();

});