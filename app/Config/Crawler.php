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
        'currentUsername' => '',
        // 每次从数据库拿出多少数据
        'maxCounts' => 100,
        // 拉多少次数据
        'times' => 2,
        'url' => 'http://www.zhihu.com/people/mimiknowyourself',
        'cookies' => '__utma=51854390.712732287.1442674748.1447159378.1447239604.39; __utmz=51854390.1446356569.33.5.utmcsr=zhihu.com|utmccn=(referral)|utmcmd=referral|utmcct=/; __utmv=51854390.000--|2=registration_date=20151031=1^3=entry_date=20150921=1; q_c1=181dc84d7b914fd2b114c87811bc7ad7|1445701408000|1442810608000; cap_id=ODUyNDA0OWQzZDYyNGU1ZDg0OWQwY2U0YWM0MmU1MGU=|1447239590|3dcf089a265f40f4f5ec1f0f4dd9cffaf3c3d62e; z_c0=QUJDTVh2Nmc3d2dYQUFBQVlRSlZUUTlYWEZhSU4wSkU1MVlCMXN2NW92YzY2UUVMUHNldklBPT0=|1446300175|4f0eed1b7579ff78506e45edeaa387f26b5444e1; __utmb=51854390.2.10.1447239604; __utmt=1; n_c=1; __utmc=51854390; _za=5b740e6d-15e2-46fb-95a8-bda99c181555; _xsrf=b0b42c7df2ae4f903558f968e2e2b4d3'
    ];

    static public function getCrawlerConfigs(): array {
        return static::$crawler;
    }

    static public function setCrawlerUrl(string $username):null {
        static::$crawler['url'] = 'http://www.zhihu.com/people/' . $username;
        static::$crawler['currentUsername'] = $username;
    }

    static public function getCurrentUsername(): string {
        return static::$crawler['currentUsername'];
    }

    static public function setAddUsersUrl(string $username): null {
        static::$crawler['url'] = 'http://www.zhihu.com/people/' . $username . '/followers';
    }

    /**
     * 每次从数据库拉取的数据量
     * @return int|int
     */
    static public function getMaxLimit(): int {
        return static::$crawler['maxCounts'];
    }

    /**
     * 应该拿多少次的数据
     * @return int|int
     */
    static public function getTimes(): int {
        return static::$crawler['times'];
    }
}