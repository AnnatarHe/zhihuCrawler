<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 15:06
 */

namespace Annatar\Curl\Analysis;
use Annatar\TheInterfaces\AnalysisInterface;
use Annatar\Curl\CrawlerTraits\CrawlerRegexs;
class CrawlerAnalysis implements AnalysisInterface
{
    // 调用正则
    use CrawlerRegexs;

    // 原数据
    private $data = '';

    // 处理好的数据
    private $afterAnalysis = [];

    /**
     * 主函数，调用各种方法
     *
     * @param $data 爬到的数据
     * @return array 处理后的数据
     */
    public function analysis($data) {

        $this->data = $data;

        $this->setName();
        $this->setBio();
        $this->setLocation();
        $this->setBusiness();
        $this->setGender();
        $this->setEducation();
        $this->setEducation_extra();
        $this->setContent();
        $this->setAgrees();
        $this->setThanks();
        $this->setBlue_stars();
        $this->setFolleringAndFollers();
        return $this->afterAnalysis;
    }


    /**
     * 粉丝和关注的人
     */
    protected function setFolleringAndFollers() {

        preg_match_all($this->regexs['following_and_followers'], $this->data, $folleringAndFollers);

        $this->afterAnalysis['following'] = $folleringAndFollers[2][0];
        $this->afterAnalysis['followers'] = $folleringAndFollers[2][1];
    }

    /**
     * 设置两个用户名
     */
    protected function setName() {
        preg_match($this->regexs['name'], $this->data, $name);
        $this->afterAnalysis['nickname'] = $name[1];
        $this->afterAnalysis['username'] = $name[2];
    }

    /**
     * 用户名旁边的那行小字
     */
    protected function setBio() {
        preg_match($this->regexs['bio'], $this->data, $bio);
        if($bio) {
            $this->afterAnalysis['bio'] = $bio[1];
        }else{
            $this->afterAnalysis['bio'] = '';
        }
    }

    /**
     * 地址
     */
    protected function setLocation() {
        preg_match($this->regexs['location'], $this->data, $location);
        if($location) {
            $this->afterAnalysis['location'] = $location[1];
        }else {
            $this->afterAnalysis['location'] = '';
        }

    }

    /**
     * 行业
     */
    protected function setBusiness() {
        preg_match($this->regexs['business'], $this->data, $business);
        $this->afterAnalysis['business'] = $business[1];
    }

    /**
     * 性别
     */
    protected function setGender() {
        preg_match($this->regexs['gender'], $this->data, $gender);
        $this->afterAnalysis['gender'] = $gender[1];
    }

    /**
     * 设定大学教育背景
     */
    protected function setEducation() {
        preg_match($this->regexs['education'], $this->data, $education);
        if($education) {
            $this->afterAnalysis['education'] = $education[1];
        }else{
            $this->afterAnalysis['education'] = '';
        }
    }

    /**
     * 设定专业，要是没有就是空的
     */
    protected function setEducation_extra() {
        preg_match($this->regexs['education_extra'], $this->data, $education_extra);
        if($education_extra) {
            $this->afterAnalysis['education_extra'] = $education_extra[1];
        }else {
            $this->afterAnalysis['education_extra'] = '';
        }

    }

    /**
     * 个人的title
     */
    protected function setContent() {
        preg_match($this->regexs['content'], $this->data, $content);
        if($content) {
            $this->afterAnalysis['content'] = $content[1];
        }else{
            $this->afterAnalysis['content'] = '';
        }

    }

    /**
     * 收到的赞同
     */
    protected function setAgrees() {
        preg_match($this->regexs['agrees'], $this->data, $agrees);
        $this->afterAnalysis['agrees'] = $agrees[1];
    }

    /**
     * 收到的感谢
     */
    protected function setThanks() {
        preg_match($this->regexs['thanks'], $this->data, $thanks);
        $this->afterAnalysis['thanks'] = $thanks[1];
    }

    /**
     * 设定友好度
     */
    protected function setBlue_stars() {
        preg_match($this->regexs['blue_stars'], $this->data, $blue_stars);
        $this->afterAnalysis['blue_stars'] = 0;
    }
}