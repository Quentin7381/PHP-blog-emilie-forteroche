<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\components\Limit;

class LimitTest extends AbstractTestComponent {
    protected $targetClass = Limit::class;
    protected $toStringResult = ' LIMIT 10';

    function setUp(): void {
        parent::setUp();
        $this->target = new $this->targetClass(10);
    }
}