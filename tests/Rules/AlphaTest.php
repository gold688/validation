<?php

use Rakit\Validation\Rules\Alpha;

class AlphaTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->rule = new Alpha;
    }

    public function testValids()
    {
        $this->assertTrue($this->rule->check('foo', []));
        $this->assertTrue($this->rule->check('foobar', []));
    }

    public function testInvalids()
    {
        $this->assertFalse($this->rule->check(2, []));
        $this->assertFalse($this->rule->check([], []));
        $this->assertFalse($this->rule->check(new stdClass, []));
        $this->assertFalse($this->rule->check('123asd', []));
        $this->assertFalse($this->rule->check('asd123', []));
        $this->assertFalse($this->rule->check('foo123bar', []));
        $this->assertFalse($this->rule->check('foo bar', []));
    }

}
