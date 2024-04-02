<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\Delete;
use Utils\DBQuery\components\Condition;

class DeleteTest extends AbstractTestComponent {
    protected $targetClass = Delete::class;
    protected $toStringResult = 'DELETE FROM table WHERE a = 1 OR b LIKE 2 AND c = 3';

    function setUp(): void {
        parent::setUp();
        $this->target->from = 'table';
        $this->target->where[] = [new Condition('a', 1)];
        $this->target->where[] = [new Condition('b', 2, 'LIKE'), 'OR'];
        $this->target->where[] = [new Condition('c', 3)];
    }

    function test__toString__spaceBefore(){
        $this->assertTrue(true);
    }
}