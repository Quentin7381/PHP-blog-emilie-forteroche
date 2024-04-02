<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\components\GroupBy;

class GroupByTest extends AbstractTestComponent {
    protected $toStringResult = ' GROUP BY col1, col2';
    protected $targetClass = GroupBy::class;

    function setUp(): void {
        parent::setUp();
        $this->target[0] = 'col1';
        $this->target[1] = 'col2';
    }
}