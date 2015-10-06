<?php
require 'vendor/autoload.php';
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/5
 * Time: 22:17
 */
$startTime = \Annatar\Helpers\Helpers::devTime();
echo 'working';

Annatar\Run::getUsers();

echo '<hr />' . 'Done';

$endTime = \Annatar\Helpers\Helpers::devTime();

echo '<hr />' . 'wasted time :' . $endTime - $startTime . 's';