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
class StoreData
{

    /**
     * @var \Annatar\TheInterfaces\DatabaseInterface
     */
    private $db = null;

    static $instence = null;

    static public function getInstence() {

        if(is_null(static::$instence)){
            static::$instence = new self();
        }
        return static::$instence;
    }

    private function __construct() {
        $this->db = Boot::DB();
    }


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

    public function storeUsers($param) {
        if(is_string($param)) {
            $this->ready($param);
        }else{
            $this->saveUsers($param);
        }
    }

    /**
     * 存储
     * @param array $param
     */
    protected function save(array $param) {
        $this->db->execute($param);
    }

    protected function saveUsers(array $param) {
        foreach($param as $v) {
            $this->db->execute([$v, time()]);
        }
    }

    /**
     * 预处理
     *
     * @param $query
     */
    protected function ready($query) {
        $this->userStat = $this->db->ready($query);
    }
}