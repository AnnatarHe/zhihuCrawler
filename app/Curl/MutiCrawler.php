<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/7
 * Time: 21:10
 */

namespace Annatar\Curl;


use Annatar\Curl\CrawlerTraits\CrawlerTrait;
use Annatar\TheInterfaces\CurlInterface;

class MutiCrawler implements CurlInterface
{

    use CrawlerTrait;


    // curl 资源合集
    private $curls = [];

    // 传过来的url
    private $urls = [];

    // muti curl resource 不知道中文怎么讲
    private $muti_curl = null;

    public function __construct(array $urls, $cookies) {

        $this->urls = $urls;

        $this->cookies = $cookies;

        $this->muti_curl = curl_multi_init();
    }

    public function setSettings() {

        array_map(function($url) {
            $single = curl_init($url);
            $this->setAgant($single);
            $this->setCookies($single);
            $this->returnTransfer($single);
            array_push($this->curls, $single);
            curl_multi_add_handle($this->muti_curl, $single);
        }, $this->urls);

    }

    /**
     * 多线程获取。出错了。再看看文档再来干，明天再说吧。
     */
    public function execute() {

        $users = [];

        do {
            while (CURLM_CALL_MULTI_PERFORM === curl_multi_exec($this->muti_curl, $running));
            if (!$running) break;
            while (($res = curl_multi_select($mh)) === 0) {};
            if ($res === false) {
                echo "<h1>select error</h1>";
                break;
            }
        } while (true);


    }

    public function getResult() {

    }


}