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
    public function getData() {

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
    public function analysisCrawler() {
        $data = $this->data;
        $this->afterAnalysis = $this->analysis->analysisCrawler($data);
        return $this->afterAnalysis;
    }

    /**
     * 爬虫数据分析
     *
     * @return array
     */
    public function analysisUserFollers() {
        $data = $this->data;
        $this->afterAnalysis = $this->analysis->analysisUserFollowers($data);
        return $this->afterAnalysis;
    }
}