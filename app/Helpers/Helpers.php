<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 11:45
 */

namespace Annatar\Helpers;


class Helpers
{
    static public function hello() {
        return 'Hello';
    }

    static public function dd($obj) {
        echo '</pre>';
        var_dump($obj);
        echo '</pre>';
        exit();
    }

    static public function devTime() {
        $time = explode(' ', microtime());
        return $time[1];
    }
}