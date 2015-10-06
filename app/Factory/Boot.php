<?php
namespace Annatar\Factory;
use Annatar\Controllers\DetailInfoGet;
use Annatar\Controllers\UsersGet;
use Annatar\Curl\Analysis\CrawlerAnalysis;
use Annatar\Curl\Analysis\UserFollowersAnalysis;
use Annatar\Curl\AnalysisData;
use Annatar\Curl\Crawler;
use Annatar\Database\MySQLDatabase;
use Annatar\Store\StoreData;

/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/5
 * Time: 22:41
 */

class Boot
{
    /**
     *
     * 实例化curl爬虫
     * @param array $configs
     * @return Crawler
     */
    static public function curl(array $configs) {

        $url = $configs['url'];
        $cookies = $configs['cookies'];
        return new Crawler($url, $cookies);
    }

    /**
     * 实例化分析程序
     *
     * @return AnalysisData
     */
    static public function analysis() {
        return new AnalysisData();
    }

    /**
     * 实例化爬虫数据分析
     *
     * @return CrawlerAnalysis
     */
    static public function crawlerAnalysis() {
        return new CrawlerAnalysis();
    }

    /**
     * 实例化用户关注人分析
     *
     * @return UserFollowersAnalysis
     */
    static public function userFollowersAnalysis() {
        return new UserFollowersAnalysis();
    }

    /**
     * 单例模式
     * 生成数据库对象
     *
     * @return MySQLDatabase|\PDO
     */
    static public function DB() {
        return MySQLDatabase::getInstence();
    }

    /**
     * 单例模式
     * 生成存储数据实例
     *
     * @return \Annatar\Store\StoreData
     */
    static public function storeData() {
        return StoreData::getInstence();
    }

    static protected $redis;
    static public function redis() {
        if(empty(static::$redis)){
            static::$redis = new \Predis\Client();
        }
        return static::$redis;
    }

    static public function usersGetController() {
        return new UsersGet();
    }

    static public function detailInfoGetController() {
        return new DetailInfoGet();
    }

}
