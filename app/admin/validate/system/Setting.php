<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/2 9:44
 * @User: admin
 * @Current File : Setting.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\validate\system;


use think\Validate;

class Setting extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'title' => 'require|max:255',
        'keywords' => 'require|max:120',
        'description' => 'require|max:255',
        'information' => 'require|max:255',
    ];
    protected $message = [
        'id.require' => 'ID为必填项',
        'id.number' => 'ID不合法',
        'title.require' => '网站标题不能为空',
        'title.max' => '网站标题不能超过设置的范围（120个字符）',
        'keywords.require' => '关键词不能为空',
        'keywords.max' => '关键词不能超过控制范围（120个字符）',
        'description.require' => '描述不能为空',
        'description.max' => '描述不能超过控制范围（255个字符）',
        'information.require' => '版权信息不能为空',
        'information.max' => '版权信息不能超过控制范围（255个字符）',
    ];
}