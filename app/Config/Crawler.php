<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/5
 * Time: 22:48
 */

namespace Annatar\Config;


/**
 * 爬虫的配置信息
 *
 * Class Crawler
 * @package Annatar\Config
 */
class Crawler
{
    static private $crawler = [
        // 每次从数据库拿出多少数据
        'maxCounts' => 1000,
        // 拉多少次数据
        'times' => 600,
        'url' => 'http://www.zhihu.com/people/AnnatarHe/about',
        'cookies' => '_za=a6876498-c244-4e37-bfa1-56fe753b0ded; _ga=GA1.2.2053837710.1442629759; q_c1=8c45d37eb29e4b4bb738c631a86df1d6|1443831855000|1441199776000; _xsrf=0393f8aec5f5b3252e807d764b7a9c1c; cap_id="MTJhNzY3MWY4NzYwNGYxOTlhZTdhODk2OGU2ZjhjYjY=|1446300577|8c49b3da12e0d5cc314b94529309b070d5278837"; unlock_ticket="QUJDTVh2Nmc3d2dYQUFBQVlRSlZUYkRTTkZaZloxdERZVEI1eThHcV82cEZSVE4yUV96Qmh3PT0=|1446300584|e9bb52ac46f96cb24e4550e1aeccc7f4c8a9023f"; z_c0="QUJDTVh2Nmc3d2dYQUFBQVlRSlZUZUJZWEZiWTVRWWFvaU9pS29SbmZJTzdWN01YMUN2RTFnPT0=|1446300640|0d871bd151eb29785a8160e3eb6c7d03fa5578a8"; __utmt=1; __utma=51854390.2053837710.1442629759.1446300783.1446300783.1; __utmb=51854390.70.9.1446301005230; __utmc=51854390; __utmz=51854390.1446300783.1.1.utmcsr=zhihu.com|utmccn=(referral)|utmcmd=referral|utmcct=/; __utmv=51854390.100-1|2=registration_date=20151031=1^3=entry_date=20150902=1'
    ];

    static public function getCrawlerConfigs() {
        return static::$crawler;
    }

    static public function setCrawlerUrl($username) {
        static::$crawler['url'] = 'http://www.zhihu.com/people/' . $username . '/about';
    }

    static public function setAddUsersUrl($username) {
        static::$crawler['url'] = 'http://www.zhihu.com/people/' . $username . '/followers';
    }

    /**
     * 每次从数据库拉取的数据量
     *
     * @return Integer
     */
    static public function getMaxLimit() {
        return static::$crawler['maxCounts'];
    }

    /**
     * 应该拿多少次的数据
     *
     * @return Integer
     */
    static public function getTimes() {
        return static::$crawler['times'];
    }
}