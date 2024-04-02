<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use services\DBQuery\components\Condition;

class ConditionTest extends AbstractTestComponent {
    protected $toStringResult = ' column LIKE value';
    protected $targetClass = Condition::class;

    function setUp(): void {
        parent::setUp();
        $this->target->column = 'column';
        $this->target->value = 'value';
        $this->target->operator = 'LIKE';
    }
}