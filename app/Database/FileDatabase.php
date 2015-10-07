<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/7
 * Time: 15:41
 */

namespace Annatar\Database;


use Annatar\TheInterfaces\FileDataInterface;

class FileDatabase implements FileDataInterface
{

    protected $originDest = DIR . 'cache/';

    protected $destination = '';

    public function __construct($file) {
        $this->destination = $this->originDest . $file;
    }

    /**
     * 重新设定目的地
     *
     * @param $destination
     */
    public function setDest($destination) {

        $this->destination = $this->originDest . $destination;
    }

    /**
     * 保存数据
     *
     * @param $content
     * @return bool
     * @throws \Exception
     */
    protected function save($content) {

        $context = file_put_contents($this->destination, $content);

        if (! $context) {
            throw new \Exception('Can not save the contents to this file');
        }

        return true;

    }

    /**
     * 获取文件信息
     *
     * @return string
     * @throws \Exception
     */
    protected function getFile() {
        $context = file_get_contents($this->destination);

        if (! $context) {
            throw new \Exception('Can not read the contents form this file');
        }

        return $context;
    }

}