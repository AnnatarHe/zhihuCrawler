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
    private $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36';

    // cookies，通过配置文件来确认
    private $cookies = '';

    /**
     * 设置代理（模仿浏览器）
     */
    protected function setAgant($resource = null) {
        $resource = is_null($resource) ? $this->curl : $resource;
        curl_setopt($resource, CURLOPT_USERAGENT, $this->agent);
    }

    /**
     * 设置cookies
     */
    protected function setCookies($resource = null) {
        $resource = is_null($resource) ? $this->curl : $resource;
        curl_setopt($resource, CURLOPT_COOKIE, $this->cookies);
    }

    protected function setHeaders($resource = null)
    {
        $resource = is_null($resource) ? $this->curl : $resource;
        curl_setopt($resource, CURLOPT_HTTPHEADER, [
            'Upgrade-Insecure-Requests' => 1,
            'If-Modified-Since' => 'Tue, 10 Nov 2015 13:13:20 GMT'
        ]);
    }

    /**
     * 设置返回类型
     */
    protected function returnTransfer($resource = null) {
        $resource = is_null($resource) ? $this->curl : $resource;
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($resource, CURLOPT_FOLLOWLOCATION, 1);
    }
}