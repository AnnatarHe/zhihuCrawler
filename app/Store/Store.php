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

    protected $eventAfterStore = ['saveConfig'];

    /**
     * 预处理
     *
     * @param $query
     */
    protected function ready($query) {
        $this->db->ready($query);
    }

    public function addEventAfterStore($event) {

        array_push($this->eventAfterStore, $event);
    }

    public function saveConfig($times, $id) {

        $fileSave = Boot::fileCache('lastTimes.txt');

        $fileSave->saveConfig($times, $id);

        unset($fileSave);
    }


}