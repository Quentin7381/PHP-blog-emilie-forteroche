<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use services\DBQuery\Select;
use services\DBQuery\components\Condition;

class SelectTest extends AbstractTestComponent {
    protected $targetClass = Select::class;

    function setUp(): void {
        parent::setUp();
        $this->target->from = 'table';

        $this->target->where[] = [new Condition('a', 1)];
        $this->target->where[] = [new Condition('b', 2, 'LIKE'), 'OR'];
        $this->target->where[] = [new Condition('c', 3)];

        $this->target->orderBy['a'] = 'ASC';
        $this->target->orderBy['b'] = 'DESC';

        $this->target->limit = 10;
        $this->target->offset = 5;

        $this->target->groupBy = ['a', 'b'];
        $this->target->having = [new Condition('a', 1)];

        $this->toStringResult =
            'SELECT * ' .
            'FROM table ' .
            'WHERE a = 1 OR b LIKE 2 AND c = 3 ' .
            'ORDER BY a ASC, b DESC ' .
            'LIMIT 10 ' .
            'OFFSET 5 ' .
            'GROUP BY a, b ' .
            'HAVING a = 1';
    }

    function test__toString__spaceBefore(){
        $this->assertTrue(true);
    }

    function test__toString__optionalValues(){
        $select = new Select();
        $select->from = 'table';

        $this->toStringResult = 'SELECT * FROM table';

        $expected = 'SELECT * FROM table';
        $this->assertEquals($expected, $select->toString());
    }
}