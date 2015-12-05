<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/7
 * Time: 16:09
 */

namespace Annatar\Config;


use Annatar\Database\FileDatabase;

class FileConfigFromCache extends FileDatabase
{

    public function saveConfig(int $times, int $id) {

        $content = 'currentTimes: ' . $times . '\n';

        $content .= 'currentID: ' . $id;

        $this->save($content);
    }

    public function getConfig() {

        $configs = [];

        $context = $this->getFile();

        $regex = '/current(\w+): (\d+)/';

        preg_match_all($regex, $context, $result);

        try{
            // 当前次数
            array_push($configs, $result[2][0]);

            // 当前ID
            array_push($configs, $result[2][1]);
        }catch(\Exception $e) {
            return $configs;
        }


        return $configs;
    }

}