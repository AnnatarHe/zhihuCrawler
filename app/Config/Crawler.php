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
        'cookies' => '__utma=51854390.712732287.1442674748.1446442835.1446904422.37; __utmz=51854390.1446356569.33.5.utmcsr=zhihu.com|utmccn=(referral)|utmcmd=referral|utmcct=/; __utmv=51854390.100-1|2=registration_date=20151031=1^3=entry_date=20150921=1; q_c1=181dc84d7b914fd2b114c87811bc7ad7|1445701408000|1442810608000; cap_id=ZDRlN2U2YWMwZjkxNGZmMWEzZjIwYWViZjNlYzY0MjU=|1446300158|1c9a6f6ac6e34abb454fb854347feac6e8417d75; z_c0=QUJDTVh2Nmc3d2dYQUFBQVlRSlZUUTlYWEZhSU4wSkU1MVlCMXN2NW92YzY2UUVMUHNldklBPT0=|1446300175|4f0eed1b7579ff78506e45edeaa387f26b5444e1; __utmb=51854390.4.10.1446904422; __utmt=1; __utmc=51854390; _za=5b740e6d-15e2-46fb-95a8-bda99c181555; _xsrf=b0b42c7df2ae4f903558f968e2e2b4d3'
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