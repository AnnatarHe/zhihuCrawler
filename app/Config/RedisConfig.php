<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 20:00
 */

namespace Annatar\Config;


class RedisConfig
{
    static private $redisConfig = [
        'host' => '127.0.0.1'
    ];

    static public function getRedisConfig() {
        return static::$redisConfig;
    }
}