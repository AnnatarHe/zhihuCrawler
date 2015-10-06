<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 9:49
 */

namespace Annatar\Curl\CrawlerTraits;


trait CrawlerTrait
{

    // 浏览器代理
    private $agent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36';

    // cookies，通过配置文件来确认
    private $cookies = '';

    /**
     * 设置代理（模仿浏览器）
     */
    protected function setAgant() {
        curl_setopt($this->curl, CURLOPT_USERAGENT, $this->agent);
    }

    /**
     * 设置cookies
     */
    protected function setCookies() {
        curl_setopt($this->curl, CURLOPT_COOKIE, $this->cookies);
    }

    /**
     * 设置返回类型
     */
    protected function returnTransfer() {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);
    }
}