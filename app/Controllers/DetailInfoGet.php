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

class DetailInfoGet
{

    use CheckDataFromRedis;

    public function Crawler() {
        array_map(function($n) {
            Crawler::setCrawlerUrl($n);
            static::runCrawler();
        }, static::$usernames);
    }

    function runCrawler() {
        $crawler = new MainCrawl();
        $crawler->getData();
        var_dump($crawler->analysisCrawler());
    }
}