<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 20:14
 */

namespace Annatar\Controllers;

use Annatar\Controllers\ControllersTraits\CheckDataFromRedis;
use Annatar\Curl\MainCrawl;
use Annatar\Config\Crawler;
use Annatar\Factory\Boot;

class UsersGet
{

    use CheckDataFromRedis;

    static private $count = 0;

    /**
     * @var \Predis\Client
     */
    protected $redis = null;
    /**
     * @var \Annatar\Database\MySQLDatabase
     */
    protected $db = null;
    public function __construct() {
        // 获取redis实例
        $this->redis = Boot::redis();

        $this->db = Boot::DB();
        // 从配置文件中获取最大limit并写入到redis中
        $size = Crawler::getMaxLimit();
        $this->redis->set('limitSize', $size);
        // 初始化设置并第一次启动
        $this->getUsernames(0);
    }


    /**
     * 添加用户主逻辑
     *
     * 首先从配置文件拿数据
     *
     * 在规定的次数和限制内循环拉取数据
     *
     * 主要从redis里面拉数据出来，每处理完一个就会被删除。
     *
     * 当redis里面没有数据了就再进入数据库获取数据，
     *
     * 如此往复，直到达成任务
     *
     */
    function addUsers() {

        $endCounts = Crawler::getTimes();
        $size = $this->redis->get('limitSize');



        while(static::$count < $endCounts) {
            if($this->redis->llen('usernames')) {
                Crawler::setAddUsersUrl($this->redis->lpop('usernames'));
                static::runUsersCrawler();
                static::$count++;
            }else{
                $this->getUsernames(static::$count * $size);
            }
        }

    }
    private function runUsersCrawler() {
        $crawler = new MainCrawl();
        $crawler->getData();
        $data = $crawler->analysisUserFollers();

        $tm = Boot::storeData();
        $tm->storeUsers('INSERT INTO users(username, createAt) VALUES(?, ?)');
        $tm->storeUsers($data);
    }
}