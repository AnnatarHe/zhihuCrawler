<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 11:42
 */

namespace Annatar\Curl;
use Annatar\Curl\CrawlerTraits\CrawlerRegexs;
use Annatar\Factory\Boot;

class AnalysisData
{

    public function analysisCrawler(string $data) {
        return Boot::crawlerAnalysis()->analysis($data);
    }

    public function analysisUserFollowers(string $data) {
        return Boot::userFollowersAnalysis()->analysis($data);
    }

}