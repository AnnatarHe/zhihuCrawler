<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 16:43
 */

namespace Annatar\Store;
use Annatar\Factory\Boot;

/**
 * 保存数据
 *
 * Class StoreData
 * @package Annatar\Store
 */
class Store
{

    /**
     * @var \PDOStatement
     */
    protected $stat = null;

    /**
     * 预处理
     *
     * @param $query
     */
    protected function ready($query) {
        $this->db->ready($query);
    }
}