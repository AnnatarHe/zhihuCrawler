<?php

/**
 * Created by PhpStorm.
 * User: Annatar
 * Date: 2015/12/5
 * Time: 22:19
 */
class HelloTest extends PHPUnit_Framework_TestCase
{

    public function itJustATest() {
        $stack = [];
        $this->assertEquals(0, count($stack));
    }

}