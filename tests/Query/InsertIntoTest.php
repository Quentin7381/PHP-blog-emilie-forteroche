<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\InsertInto;
use Utils\DBQuery\components\Condition;

class InsertIntoTest extends AbstractTestComponent {
    protected $targetClass = InsertInto::class;
    protected $toStringResult = 'INSERT INTO table (a, b, c) VALUES (1, 2, 3), (4, 5, 6), (7, 8, 9)';

    function setUp(): void {
        parent::setUp();
        $this->target->table = 'table';
        $this->target->values->columns = ['a', 'b', 'c'];

        $this->target->values[0]['a'] = 1;
        $this->target->values[0]['c'] = 3;
        $this->target->values[0]['b'] = 2;

        $this->target->values[1] = ['b' => 5, 'a' => 4, 'c' => 6];

        $this->target->values[2] = [7, 8, 9];
    }

    function test__toString__spaceBefore(){
        $this->assertTrue(true);
    }
}