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
        'maxCounts' => 1,
        // 拉多少次数据
        'times' => 2,
        'url' => 'http://www.zhihu.com/people/AnnatarHe/about',
        'cookies' => '_za=a656a5db-b9a7-433b-aa3e-21538bac720a; __utmt=1; __utma=51854390.1335110575.1447161207.1447161207.1447161207.1; __utmb=51854390.2.10.1447161207; __utmc=51854390; __utmz=51854390.1447161207.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); __utmv=51854390.000--|3=entry_date=20151110=1'
    ];

    static public function getCrawlerConfigs() {
        return static::$crawler;
    }

    static public function setCrawlerUrl($username) {
        static::$crawler['url'] = 'http://www.zhihu.com/people/' . $username;
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