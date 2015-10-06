<?php
namespace Annatar\TheInterfaces;
/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/10/5
 * Time: 22:35
 */

interface CurlInterface {
    function execute();
    function setSettings();
    function getResult();
}