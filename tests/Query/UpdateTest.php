<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\Update;
use Utils\DBQuery\components\Condition;

class UpdateTest extends AbstractTestComponent {
    protected $targetClass = Update::class;
    protected $toStringResult = 'UPDATE table SET a = 1, b = 2, c = 3 WHERE a = 1 OR b LIKE 2';

    function setUp(): void {
        parent::setUp();
        $this->target->table = 'table';
        $this->target->where[] = new Condition('a', 1);
        $this->target->where[] = [new Condition('b', 2, 'LIKE'), 'OR'];

        $this->target->set['a'] = 1;
        $this->target->set['b'] = 2;
        $this->target->set['c'] = 3;
    }

    function test__toString__spaceBefore(){
        $this->assertTrue(true);
    }
}