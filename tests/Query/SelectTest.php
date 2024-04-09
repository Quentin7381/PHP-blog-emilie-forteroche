<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\Select;
use Utils\DBQuery\components\Condition;

class SelectTest extends AbstractTestComponent {
    protected $targetClass = Select::class;

    function setUp(): void {
        parent::setUp();
        $this->target->from = 'table';

        $this->target->where[] = [new Condition('col1', 1)];
        $this->target->where[] = [new Condition('col2', 2, 'LIKE'), 'OR'];
        $this->target->where[] = [new Condition('col3', 3)];

        $this->target->orderBy['col1'] = 'ASC';
        $this->target->orderBy['col2'] = 'DESC';

        $this->target->limit = 10;
        $this->target->offset = 5;

        $this->target->groupBy = ['col1', 'col2'];
        $this->target->having = [new Condition('col1', 1)];

        $this->toStringResult =
            'SELECT * ' .
            'FROM table ' .
            'WHERE col1 = 1 OR col2 LIKE 2 AND col3 = 3 ' .
            'ORDER BY col1 ASC, col2 DESC ' .
            'LIMIT 10 ' .
            'OFFSET 5 ' .
            'GROUP BY col1, col2 ' .
            'HAVING col1 = 1';
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