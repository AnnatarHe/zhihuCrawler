<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 15:27
 */

namespace Annatar\Database;
use Annatar\Helpers\Helpers;
use Annatar\TheInterfaces\DatabaseInterface;
use Annatar\Config\DBConfig;
class MySQLDatabase implements DatabaseInterface
{

    private $result;

    private $dns = '';

    /**
     * @var \PDO
     */
    static private $_instance = null;

    private $instance = null;

    /**
     * @var \PDOStatement
     */
    private $readied = null;

    static public function getInstence() {

        if(is_null(static::$_instance)){
            static::$_instance = new self;
        }
        return static::$_instance;

    }

    private function __construct() {

        /**
         * @var \Annatar\Config\DBConfig::$configs
         */
        $config = DBConfig::getConfigs();

        $this->dns = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=utf8';

        try {
            static::$_instance = new \PDO($this->dns, $config['user'], $config['password']);
        }catch (\PDOException $e) {
            echo $e->getMessage();
        }

        // 好像是只有实例化对象才有一些方法
        $this->instance = static::$_instance;
    }

    /**
     * 预处理
     *
     * @param $query
     */
    public function ready($query) {
        try{
            $this->readied = $this->instance->prepare($query);
        }catch (\PDOException $e) {
            throw new \PDOException($e->errorInfo);
        }

    }

    /**
     * 执行
     *
     * @param $params
     * @return $this
     */
    public function execute($params = null) {

        try{
            if(is_null($params)){
                $this->readied->execute();
            }else{
                $this->readied->execute($params);
            }
        }catch (\PDOException $e) {

            throw new \PDOException($e->errorInfo);
        }
        if ( $this->instance->lastInsertId() == 0 ){
            $err = $this->instance->errorInfo();
            // 需要添加日志记录
//            var_dump($this->readied->errorInfo());
//            var_dump($err);

        }
    }

    public function bind($index, $val, $type) {

        $this->readied->bindParam($index, $val, $type);
    }

    /**
     * 获取结果集
     *
     * @return array
     */
    public function getResult() {

        $this->result = $this->readied->fetchAll(\PDO::FETCH_ASSOC);
        return $this->result;
    }

    public function select($query) {
        return $this->instance->query($query, \PDO::FETCH_ASSOC);
    }

    public function __destruct()
    {
        unset($this->result);
        static::$_instance = null;
        $this->instance = null;
    }

}