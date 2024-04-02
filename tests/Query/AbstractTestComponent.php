<?php

require_once __DIR__ . '/../testsInit.php';

abstract class AbstractTestComponent extends TestSetup {
    protected $targetClass;
    protected $target;

    function setUp(): void {
        parent::setUp();
        $this->target = new $this->targetClass();
    }

    function test__toString__spaceBefore(){
        $regex = '/^ /';
        $match = preg_match($regex, $this->target->toString());
        $this->assertEquals(1, $match);
    }

    function test__toString__expected(){
        $this->assertEquals($this->toStringResult, $this->target->toString());
    }
}
