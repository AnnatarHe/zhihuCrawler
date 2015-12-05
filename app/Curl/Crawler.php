<?php
namespace Annatar\Curl;
use Annatar\Helpers\Helpers;
use Annatar\Curl\CrawlerTraits\CrawlerTrait;
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/5
 * Time: 22:22
 */

class Crawler implements \Annatar\TheInterfaces\CurlInterface
{
    use CrawlerTrait;

    // curl资源
    private $curl = null;


    // 结果集
    private $result = '';

    /**
     *
     * 初始化，载入url和cookies
     * 并设置无头信息
     *
     * @param $url
     * @param $cookies
     */
    public function __construct(string $url,string $cookies) {

        $this->cookies = $cookies;
        $this->curl = curl_init($url);
        if (DEBUG == true) {
            var_dump($url);
        }
        curl_setopt($this->curl, CURLOPT_HEADER, 0);
    }

    /**
     * 设置几个必需的设置
     */
    public function setSettings(): null {
        $this->setAgant();
        $this->setHeaders();
        $this->setCookies();
        $this->returnTransfer();
    }

    /**
     * 执行curl操作
     */
    public function execute(): null {
        $this->result = curl_exec($this->curl);

    }

    /**
     * 获取结果集
     * @return string
     */
    public function getResult(): string {
        return $this->result;
    }

    public function __destruct() {
        curl_close($this->curl);
        unset($this->result);
    }

}