<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/7
 * Time: 10:45
 */

namespace Annatar\Store;


use Annatar\Store\Traits\SingleTraits;

class StoreUsers extends Store
{
    use SingleTraits;

    public function store($param) {
        if(is_string($param)) {
            $this->ready($param);
        }else{
            $this->save($param);
        }
    }


    protected function save(array $param) {
        foreach($param as $v) {
            $this->db->execute([$v, time()]);
        }
    }

}