<?php
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/6
 * Time: 15:25
 */

namespace Annatar\TheInterfaces;


interface DatabaseInterface
{
    public function ready($query);
    public function execute($params);
    public function getResult();
}