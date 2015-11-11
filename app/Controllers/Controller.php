<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/7
 * Time: 9:59
 */

namespace Annatar\Controllers;

use Annatar\Controllers\ControllersTraits\CheckDataFromRedis;
use Annatar\Factory\Boot;
use Annatar\Config\Crawler;

class Controller
{

    use CheckDataFromRedis;

    /**
     * 当前进行到第几次了
     *
     * @var int
     */
    static protected $count = 0;

    /**
     * 最重要运行几轮
     *
     * @var int
     */
    protected $endCounts = 0;

    /**
     * @var \Predis\Client
     */
    protected $redis = null;

    /**
     * @var \Annatar\Database\MySQLDatabase
     */
    protected $db = null;

    /**
     * 每次从数据库拿多少数据
     *
     * @var int
     */
    protected $size = 0;

    /**
     * @var 从数据库拿出的数据，正准备发到数据库里面
     */
    protected $dataArray;

    protected function init() {
        // 获取redis实例
        $this->redis = Boot::redis();

        $this->db = Boot::DB();

        // 从配置文件中获取最大limit并写入到redis中
        $size = Crawler::getMaxLimit();
        $this->redis->set('limitSize', $size);

        if (DEBUG == true) {
            echo 'the usernames at redis :';
            var_dump($this->redis->llen('usernames'));
        }

        if ( !$this->redis->llen('usernames') ) {
            // 初始化数据
            $this->getUsernames(0);
        }


    }

    protected function getSize() {

        $this->endCounts = Crawler::getTimes();
        $this->size = $this->redis->get('limitSize');
    }

    protected function run($urlMethod, $runMethod) {

        $this->getSize();
        // 从redis拿出数据，并定义url，随后开始爬行逻辑
        while(static::$count < $this->endCounts) {

            if( $len = $this->redis->llen('usernames') ) {

                for($i = 0; $i < $len; $i++) {

                    Crawler::$urlMethod($this->redis->lpop('usernames'));
                    if(! $this->$runMethod() ) {
                        continue;
                    }
                }
                static::$count++;
            }else{
                $this->getUsernames(static::$count * $this->size);
            }
        }

    }
}