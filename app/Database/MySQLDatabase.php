<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 15:27
 */

namespace Annatar\Database;
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

        $this->dns = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'];

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
        $this->readied = $this->instance->prepare($query);
    }

    /**
     * 执行
     *
     * @param $params
     * @return $this
     */
    public function execute($params) {

        $success = $this->readied->execute($params);
        if($success) {
            return $this;
        }else {
            $errorInfo = $this->readied->errorInfo();
            throw new \Exception($errorInfo[2]);
        }

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

    public function __destruct() {

    }

}