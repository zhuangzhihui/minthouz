/**
 *
 * @param url
 */
function del(url) {
    layer.confirm('确定要彻底删除吗？', function () {
        $.ajax({
            url: url,
            type: "post",
            dataType: "json",
            success: function (result) {
                if (result.status === 1) {
                    layer.msg(result.message, { icon: 1, time: 600 }, function () {
                        location.replace(location.href)
                    });
                } else {
                    layer.msg(result.message, { icon: 5, time: 2000 });
                }
            }
        }, 'JSON')
    })
}

/**
 * 缩略图插入
 * 注意：缩略图和相册列表的字段注意统一
 * $('.' + cls + ' img')  // $('.image img') 解析出来是这个样子的，所以 img input 前面需要加一个空格 来定位
 * @param cls  // 该参数是可以确定插入的位置的
 * @param key
 */
function insert(cls, key) {
    let index = parent.layer.getFrameIndex(window.name);
    parent.$('.' + cls + ' img').attr('src', key);
    parent.$('.' + cls + ' input').val(key);
    parent.layer.close(index);
}

/**
 * 相册插入列表
 * 注意：缩略图和相册列表的字段注意统一
 * @param id
 * @param key
 */
function in_list(id, key) {
    let index = parent.layer.getFrameIndex(window.name);
    let img = '<img src="' + key + '" alt="" style="height: 92px;padding-right: 5px;">'
    let input = '<input type="hidden" name="album[]" value="' + key + '">'
    let into = parent.$('.' + id + '');
    into.append(img);
    into.append(input);
}

function changeStatus(url) {
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function (result) {
            if (result.status === 1) {
                layer.msg(result.message, { 'icon': 1, 'time': 600 }, function () {
                    window.location.replace(location.href);
                });
            } else {
                layer.msg(result.message, { 'icon': 5, 'time': 8000 });
            }
        }
    })
}