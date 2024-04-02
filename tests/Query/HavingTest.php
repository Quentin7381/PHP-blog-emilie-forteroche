<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\components\Having;

class HavingTest extends AbstractTestComponent {
    protected $toStringResult = ' HAVING column LIKE value OR column2 = value2 AND column3 = value3';
    protected $targetClass = Having::class;

    function setUp(): void {
        parent::setUp();
        $this->target[] = [new Utils\DBQuery\components\Condition('column', 'value', 'LIKE')];
        $this->target[] = [new Utils\DBQuery\components\Condition('column2', 'value2'), 'OR'];
        $this->target[] = [new Utils\DBQuery\components\Condition('column3', 'value3')];
    }
}