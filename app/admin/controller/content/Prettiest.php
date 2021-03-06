<?php

declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/6 16:19
 * @User: admin
 * @Current File : Banner.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\content;


use app\admin\controller\BaseAdmin;
use think\App;
use think\facade\View;
use app\admin\validate\content\Prettiest as validate;
use app\admin\service\content\Prettiest as service;
use think\response\Json;

/**
 * Class Prettiest 优质的 最棒的 重金推荐的
 * @package app\admin\controller\content
 */
class Prettiest extends BaseAdmin
{
    //此为推荐位的类型 即 prettiest的type;语义看该变量的上下文意思
    protected $type = [
        '1' => '幻灯片(活动/新品)',
        '2' => '热门(实力担当)',
        '3' => '重金打造(镇馆之宝)',
        '4' => '霸屏横幅(实力推荐)'
    ];

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->validate = new validate();
        $this->service = new service();
    }

    /**
     * @return string
     */
    public function index()
    {
        if ($this->request->isGet()) {
            $type = input('get.type', 1, 'intval');
            $data = $this->service->getDataByType((int)$type, (int)$this->language, (int) $status = 0);
            View::assign('type', input('get.type'));
            View::assign('data', $data);
            return View::fetch();
        }
    }

    /**
     * @return string
     */
    public function add()
    {
        if ($this->request->isGet()) {
            $typeValue = $this->type[input('get.type')];
            $typeIndex = input('get.type');
            View::assign('type', $typeValue);
            View::assign('index', $typeIndex);
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $data = input('post.', [], 'trim');
            $data['language_id'] = $this->language;
            if (!$this->validate->scene('add')->check((array)$data)) return show(0, $this->validate->getError()); //后台验证数据合法性
            if ($this->service->create((array)$data)) {
                return show(1, '新增成功');
            }
            return show(0, '新增失败，未知原因');
        }
    }

    public function edit()
    {
        if ($this->request->isGet()) {
            $data = $this->service->getDataById((int)input('get.id', 1, 'intval'));
            if (empty($data) && !is_array($data)) {
                // 数据不合法
            }
            $data['value'] = $this->type[$data['type']];
            View::assign('data', $data);
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $data = input('post.', [], 'trim');
            $data['language_id'] = $this->language;
            if (!$this->validate->scene('edit')->check((array)$data)) return show(0, $this->validate->getError()); //后台验证数据合法性
            if ($this->service->update((array)$data)) {
                return show(1, '保存成功');
            }
            return show(0, '保存失败，未知原因');
        }
    }

    /**
     * @return Json|void
     * 修改状态
     *
     */
    public function changeStatus()
    {
        //        parent::changeStatus();
        $id = input('get.id');
        $status = input('get.status');
        $result = $this->service->changeStatus((int)$id, (int)$status);
        if ($result->id) return show(1, '保存成功');
        return show(0, '保存失败，未知原因');
    }
}