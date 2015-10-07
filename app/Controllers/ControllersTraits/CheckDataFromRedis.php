<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 20:20
 */

namespace Annatar\Controllers\ControllersTraits;
use Annatar\Factory\Boot;
use Annatar\Helpers\Helpers;

trait CheckDataFromRedis
{

    /**
     * 获取用户名的主要运行系统之一
     *
     * 逻辑：处理数据库，获得结果集，传入到redis中。
     *
     * @param $count
     */
    protected function getUsernames($count) {

        $size = intval($this->redis->get('limitSize'));

        $this->db->ready('SELECT * FROM users WHERE id > ? limit ' . $size);
        $this->db->execute([$count]);
        $result = $this->db->getResult();

        $tmp_array = [];
        foreach($result as $v) {
            $tmp_array[] = $v['username'];
        }

        $this->redis->rpush('usernames', $tmp_array);
    }

    protected function getLastTimesAndId() {
        $times = Boot::fileCache('lastTimes.txt');

        return $times->getConfig();

    }
}