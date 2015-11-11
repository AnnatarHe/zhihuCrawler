<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 10:03
 */

namespace Annatar\Curl\CrawlerTraits;


trait CrawlerRegexs
{
    public $regexs = [
        // 英文昵称，以及中文
        'name' => '/<span class="name">(.+)<\/span>/',
        // 说了什么
        'bio' => '/<span class="bio" title="(.*\s*)">.*\s*<\/span/',
        // 位置
        'location' => '/<span class="location item" title="(.*)"><a href="/',
        // 干嘛的
        'business' => '/<span class="business item" title="(.*)"><a href="/',
        // 性别
        'gender' => '/<span class="item gender" ><i class="icon icon-profile-(\w+)"><\/i>/',
        // 大学
        'education' => '/<span class="education item" title="(.*)"><a href="/',
        // 专业
        'education_extra' => '/<span class="education-extra item" title=\'(.*)\'><a href="/',
        // 个人说的话
        'content' => '/<span class="content">\n{2}(.*)\n{2}<\/span>/',
        // 被赞同
        'agrees' => '/<span class="zm-profile-header-user-agree"><span class="zm-profile-header-icon"><\/span><strong>(\d+)<\/strong>/',
        // 被感谢
        'thanks' => '/<span class="zm-profile-header-user-thanks"><span class="zm-profile-header-icon"><\/span><strong>(\d+)<\/strong>/',
        // 这个比较特殊，第一个匹配是（我所关注的人），第二个匹配时（被我关注的人），第三个匹配是（主页被多少人浏览）
        'following_and_followers' => '/<span class="zg-gray-normal">(.*)<\/span><br \/>\n<strong>(\d+)<\/strong><label>/',
        // 友善度
        'blue_stars' => '/<span class="blue-stars" style="width: (\d+)\.\d+%"><\//'
    ];
}
