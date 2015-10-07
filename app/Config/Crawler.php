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
        'maxCounts' => 2,
        // 拉多少次数据
        'times' => 2,
        'url' => 'http://www.zhihu.com/people/AnnatarHe/about',
        'cookies' => '_za=a6876498-c244-4e37-bfa1-56fe753b0ded; _ga=GA1.2.2053837710.1442629759; q_c1=8c45d37eb29e4b4bb738c631a86df1d6|1443831855000|1441199776000; cap_id="NzAzNjYzM2ViMjJmNDFmNjljMTNmNTE5MTg2OTNjN2U=|1443831855|e900e311b03a8daa4f15cd0d666f351528b38222"; z_c0="QUFCQThERWpBQUFYQUFBQVlRSlZUY0t0TmxhR2cwaFliMlh0T09vUlV6RlZpQUI3NEpqRUJRPT0=|1443832002|8b2a106e84bebd45a3b144dbbb626f4eb86a4261"; _xsrf=0393f8aec5f5b3252e807d764b7a9c1c; __utmt=1; __utma=51854390.2053837710.1442629759.1444050546.1444050546.1; __utmb=51854390.12.9.1444052490866; __utmc=51854390; __utmz=51854390.1444050546.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); __utmv=51854390.100-1|2=registration_date=20131230=1^3=entry_date=20131230=1'
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