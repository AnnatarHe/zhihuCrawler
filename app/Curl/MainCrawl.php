<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 11:46
 */

namespace Annatar\Curl;
use Annatar\Config\Crawler;
use Annatar\Factory\Boot;
use Annatar\Helpers\Helpers;

class MainCrawl
{

    /**
     * @var \Annatar\Curl\Crawler
     */
    protected $crawler = null;

    /**
     * @var \Annatar\Curl\AnalysisData
     */
    protected $analysis = null;

    protected $data = '';

    protected $afterAnalysis;

    public function __construct() {

        // 初始化爬虫
        $configs = Crawler::getCrawlerConfigs();
        $this->crawler = Boot::curl($configs);
        // 初始化分析器
        $this->analysis = Boot::analysis();
    }

    /**
     * 获取数据
     *
     * 先是添加一些设置，然后执行，之后获取
     */
    public function getData(): null {

        $this->crawler->setSettings();
        $this->crawler->execute();
        $this->data = $this->crawler->getResult();

    }

    /**
     * 爬虫数据分析
     * 调用Analysis类的方法
     *
     * @return array
     */
    public function analysisCrawler(): array {

        // 404 跳过
        if (preg_match('/<strong>>你似乎来到了没有知识存在的荒原...<\/strong>/', $this->data)) {
            return false;
        }

        $this->afterAnalysis = $this->analysis->analysisCrawler($this->data);
        return $this->afterAnalysis;
    }

    /**
     * 爬虫数据分析
     *
     * @return array
     */
    public function analysisUserFollers(): array {
        $data = $this->data;

        $this->afterAnalysis = $this->analysis->analysisUserFollowers($data);
        return $this->afterAnalysis;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->analysis = null;
    }
}