<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 15:04
 */

namespace Annatar\Curl\CrawlerTraits;


trait AddUsersTrait
{
    protected $usersRegx = [
        'followers' => '/href="http:\/\/www\.zhihu\.com\/people\/(.*)" class="zg-link"/'
    ];
}