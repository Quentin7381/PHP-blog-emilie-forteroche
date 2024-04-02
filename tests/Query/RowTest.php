<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\components\Row;

class RowTest extends AbstractTestComponent {
    protected $targetClass = Row::class;
    protected $toStringResult = ' (John, 30, USA)';

    function setUp(): void {
        parent::setUp();
        $this->target = new $this->targetClass(['name', 'age', 'country']);
        $this->target['name'] = 'John';
        $this->target['age'] = 30;
        $this->target['country'] = 'USA';
    }

    public function test__arrayAccess__columnsAreTraducedInIndexes(){
        $row = new Row(['name', 'age', 'country']);
        $row['name'] = 'John';
        $row['age'] = 30;
        $row['country'] = 'USA';

        $this->assertEquals('John', $row->row[0]);
        $this->assertEquals(30, $row->row[1]);
        $this->assertEquals('USA', $row->row[2]);

        $this->assertEquals('John', $row['name']);
        $this->assertEquals(30, $row['age']);
        $this->assertEquals('USA', $row['country']);
    }
}