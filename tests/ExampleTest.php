<?php

use PHPUnit\Framework\TestCase;
class ExampleTest extends TestCase
{
 public function testBasic()
 {
 $this->assertTrue(true);
 }
 public function testSum()
 {
 $this->assertEquals(4, 2 + 2);
 }
}

