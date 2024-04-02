<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\components\Where;
use Utils\DBQuery\components\Condition;

class WhereTest extends AbstractTestComponent {
    protected $targetClass = Where::class;
    protected $toStringResult = ' WHERE a = 1 OR b LIKE 2 AND c = 3';

    function setUp(): void {
        parent::setUp();
        $this->target[] = [new Condition('a', 1)];
        $this->target[] = [new Condition('b', 2, 'LIKE'), 'OR'];
        $this->target[] = [new Condition('c', 3)];
    }
}