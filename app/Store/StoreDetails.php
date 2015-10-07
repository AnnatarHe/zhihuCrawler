<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/7
 * Time: 10:44
 */

namespace Annatar\Store;

use Annatar\Store\Traits\SingleTraits;
use Annatar\Helpers\Helpers;

class StoreDetails extends Store
{

    use SingleTraits;
    /**
     * 通过判定是否为数组来切换执行
     *
     * @param $param
     */
    public function store($param) {
        if(is_string($param)) {
            $this->ready($param);
        }else{
            $this->save($param);
        }
    }

    /**
     * 暂时无用
     *
     * @param array $data
     * @param array $type
     */
    public function bind(array $data, array $type) {
        $i = 1;
        foreach ($data as $val) {
            $this->db->bind($i, $val, $type[$i - 1]);
            $i++;
        }
    }

    /**
     * 存储
     *
     * 这一段我非常的不明白，为什么关联数组被传过去。
     *
     * 用foreach把数据插入到临时变量里面，然后传过去
     *
     * @param array $param
     */
    protected function save(array $params) {

        // 临时数组
        $tmp = [];
        foreach ($params as $v) {
            array_push($tmp, $v);
        }
        $this->db->execute($tmp);

    }
}