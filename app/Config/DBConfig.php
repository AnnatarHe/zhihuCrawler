<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 15:29
 */

namespace Annatar\Config;


class DBConfig
{
    static private $configs = [
        'host' => '127.0.0.1',
        'port' => '3306',
        'user' => 'root',
        'password' => 'adminhele',
        'dbname' => 'zhihu'
    ];
    static function getConfigs(): array {
        return static::$configs;
    }
}