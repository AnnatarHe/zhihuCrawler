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



    public function __construct() {

        parent::init();

        $this->getUsernames(0);
    }

    public function getDetails() {

        $this->getSize();

        // 从redis拿出数据，并定义url，随后开始爬行逻辑
        while(static::$count < $this->endCounts) {
            if($this->redis->llen('usernames')) {
                Crawler::setCrawlerUrl($this->redis->lpop('usernames'));
                $this->runGetDetailsCrawler();
                static::$count++;
            }else{
                $this->getUsernames(static::$count * $this->size);
            }
        }
    }

    function runGetDetailsCrawler() {
        $crawler = new MainCrawl();
        $crawler->getData();
        $this->dataArray = $crawler->analysisCrawler();

        $this->store();
    }

    final private function store() {

        // 爬虫数据的存储
        $tm = Boot::detailsStore();

        // 预处理存储数据
        $tm->store('INSERT INTO informations(username, nickname, bio, location, business, gender, education, education_extra, content, agrees, thanks, blue_stars, following, followers) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        // 存
        $tm->store($this->dataArray);

    }
}