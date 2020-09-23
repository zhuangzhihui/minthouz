<?php

/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/10 10:28
 * @User: admin
 * @Current File : Image.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\media;


use app\admin\controller\BaseAdmin;
use app\libs\utils\cloud\AliOss;
use Exception;
use think\App;
use think\facade\Env;
use think\facade\Session;
use think\facade\View;
use think\response\Json;

/**
 * Class Image
 * @package app\admin\controller\media
 */
class Image extends BaseAdmin
{
    protected $bucket;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->bucket = Env::get('oss.bucket');
    }

    /**
     * @return string
     * @throws Exception
     */
    public function index()
    {
        if ($this->request->isGet()) {
            $path = input('get.path', 'images/', 'htmlspecialchars,trim');
            $type = input('get.type', '', 'trim,intval'); //这个类型是用来去除掉插入到/插入两个操作的，当在别的功能里调用该功能是就需要显示，反之则不要
            Session::set('path', $path); //上传行为需要用到这个path
            $nav = array_filter(explode('/', $path));
            $navbar = [];
            foreach ($nav as $item) {
                $temp['name'] = $item;
                $temp['path'] = substr($path, 0, strpos($path, '/' . $item)) . '/' . $item;
                $navbar[] = $temp;
            }
            $items = AliOss::listObj((string)$this->bucket, (string)$path);
            $baseUrl = Env::get('oss.baseUrl'); //传递到前端 防止换来换去，全部都要手撸
            View::assign('type', $type);
            View::assign('baseUrl', $baseUrl);
            View::assign('items', $items);
            View::assign('path', $path);
            View::assign('nav', $navbar);
            return View::fetch();
        }
    }
    /**
     * 选择图片的方法，后面有用再说明
     *
     * @Author: kevin qiu
     * @DateTime: 2020-08-10
     * @return void
     */
    public function select()
    {
        if ($this->request->isGet()) {
            $path = input('get.path', 'images/', 'htmlspecialchars,trim');
            $class = input('get.class', 'image', 'htmlspecialchars,trim');
            Session::set('path', $path); //上传行为需要用到这个path
            $nav = array_filter(explode('/', $path));
            $navbar = [];
            foreach ($nav as $item) {
                $temp['name'] = $item;
                $temp['path'] = substr($path, 0, strpos($path, '/' . $item)) . '/' . $item;
                $navbar[] = $temp;
            }
            $items = AliOss::listObj((string)$this->bucket, (string)$path);
            $baseUrl = Env::get('oss.baseUrl'); //传递到前端 防止换来换去，全部都要手撸
            View::assign('baseUrl', $baseUrl);
            View::assign('items', $items);
            View::assign('path', $path);
            View::assign('class', $class);
            View::assign('nav', $navbar);
            return View::fetch();
        }
    }

    /**
     * @return string|Json
     * @throws Exception
     */
    public function createFolder()
    {
        if ($this->request->isGet()) {
            $path = input('get.path', 'images', 'htmlspecialchars,trim');
            View::assign('path', $path);
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $post = input('post.', '', 'htmlspecialchars,trim');

            $folder = str_replace('/', '', $post['folder']);
            unset($post);
            $key = Session::get('path') . $folder;
            //todo::阿里云和亚马逊云合体在这里分分支
            $result = AliOss::mkdir((string)$this->bucket, (string)$key);
            if ($result == 200) {
                return show(1, '创建成功', [], 200);
            }
            return show(0, '创建失败', [], 500);
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    public function upload()
    {
        if ($this->request->isGet()) {
            $path = input('get.path', 'images', 'htmlspecialchars,trim');
            View::assign('path', $path);
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $file = $this->request->file('file');
            $key = Session::get('path') . $file->getOriginalName();
            $filePath = $file->getRealPath();
            if (AliOss::putFile($key, (string)$filePath)) {
                return json(['code' => 1, 'msg' => 'ok', 'data' => ['src' => '']]);
            }
            return json();
        }
    }

    /**
     * @return Json
     */
    public function delImage()
    {
        if ($this->request->isPost()) {
            $key = input('get.key', '', 'htmlspecialchars,trim');
            $result = AliOss::delFile($this->bucket, $key);
            if ($result == 204) return show(1, '删除成功', [], 200);
            return show(0, '删除失败', [], 200);
        }
    }
}