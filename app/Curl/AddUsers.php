<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 14:43
 */

namespace Annatar\Curl;
use Annatar\Curl\Crawler;
use Annatar\Config\Crawler as Configs;

class AddUsers
{
    static public $regex = '/href="http:\/\/www\.zhihu\.com\/people\/(.*)" class="zg-link"/';

    static public $firstUsers =  ['AnnatarHe', 'liu-xue-20-67', 'SuneBear'];

    static public function addUsers() {


    }
}