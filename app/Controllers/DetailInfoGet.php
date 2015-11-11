<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 20:15
 */

namespace Annatar\Controllers;

use Annatar\Controllers\ControllersTraits\CheckDataFromRedis;
use Annatar\Curl\MainCrawl;
use Annatar\Config\Crawler;
use Annatar\Factory\Boot;
use Annatar\Helpers\Helpers;

class DetailInfoGet extends Controller
{

    use CheckDataFromRedis;

    public function __construct()
    {
        parent::init();
    }

    public function getDetails()
    {

        $this->run('setCrawlerUrl', 'runGetDetailsCrawler');
    }

    protected function runGetDetailsCrawler()
    {
        $crawler = new MainCrawl();
        $crawler->getData();
        $this->dataArray = $crawler->analysisCrawler();

        if (DEBUG == true) {
            echo 'the result is: ';
            var_dump($this->dataArray);
        }

        if (! $this->dataArray) {
            echo '404 not found';
            return false;
        }

        // 确认是否网络通畅
        if($this->dataArray['username'] == null) {
            echo 'bad http connect';
            return false;
        }

        $this->store();

        // 释放内存
        $crawler = null;
    }

    final private function store() {

        // 爬虫数据的存储
        $tm = Boot::detailsStore();

        // 预处理存储数据
        $tm->store('INSERT IGNORE INTO informations(username, nickname, bio, location, business, gender, education, education_extra, content, agrees, thanks, blue_stars, following, followers) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        // 存

        $tm->store($this->dataArray);


    }
}