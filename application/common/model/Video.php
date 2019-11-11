<?php
/**
 * Created by PhpStorm.
 * User: guo
 * Date: 2017/9/8
 * Time: 15:00
 */

namespace app\common\model;

use app\common\model\Language as LanguageModel;

/**
 * Class Video
 * @package app\common\model
 */
Class Video extends BaseModel
{
    protected $table = 'tb_video';

    /**
     * @param $code
     * @return \app\en_us\controller\Search|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     *
     */
    public function getVideoByLanguage($code)
    {
        $order = ['listorder' => 'desc', 'id' => 'desc'];
        $language_id = LanguageModel::getLanguageCodeOrID($code);
        $map = ['status' => 1, 'language_id' => $language_id];

        $query = $this->where($map);
        $data = $query->order($order)->field('id,name,url_title,image,urlabroad,urlchina')->paginate(8, true);
        $count = $query->count();
        return ['data' => $data, 'count' => $count];
    }

    //获取子分类的视频列表
    public function getVideosByCategoryId($status, $language_id, $id)
    {
        $data = ['status' => $status, 'language_id' => $language_id];
        $order = ['listorder' => 'desc', 'id' => 'desc'];
        return Search($this->table, $data, $order);
    }
}