<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 20:14
 */

namespace Annatar\Controllers;

use Annatar\Curl\MainCrawl;
use Annatar\Config\Crawler;
use Annatar\Factory\Boot;

class UsersGet extends Controller
{



    public function __construct() {

        parent::init();


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
    public function addUsers() {

        $this->getSize();

        // 从redis拿出数据，并定义url，随后开始爬行逻辑
        while(static::$count < $this->endCounts) {
            if($this->redis->llen('usernames')) {
                Crawler::setAddUsersUrl($this->redis->lpop('usernames'));
                $this->runUsersCrawler();
                static::$count++;
            }else{
                $this->getUsernames(static::$count * $this->size);
            }
        }
    }

    /**
     * 私有方法主爬虫
     */
    final private function runUsersCrawler() {
        $crawler = new MainCrawl();
        $crawler->getData();
        $this->dataArray = $crawler->analysisUserFollers();

        $this->store();
    }

    final private function store() {

        // 爬虫数据的存储
        $tm = Boot::userStore();
        // 预处理存储数据
        $tm->store('INSERT INTO users(username, createAt) VALUES(?, ?)');
        // 存
        $tm->store($this->dataArray);
    }
}