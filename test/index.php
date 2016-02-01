<?php

class IndexTest extends PHPUnit_Framework_TestCase
{
  public function testArray()
  {
    $stack = [];
    $this->assertEquals(0, count($stack));
  }
  public function testFail()
  {
      $foo = true;
      $this->assertEquals(true, $foo);
  }
}
