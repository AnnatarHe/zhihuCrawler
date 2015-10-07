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
     * 存储
     * @param array $param
     */
    protected function save(array $params) {

        $this->db->execute($params);
    }
}