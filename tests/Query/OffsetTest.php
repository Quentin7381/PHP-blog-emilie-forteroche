<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use services\DBQuery\components\Offset;

class OffsetTest extends AbstractTestComponent {
    protected $targetClass = Offset::class;
    protected $toStringResult = ' OFFSET 10';

    function setUp(): void {
        parent::setUp();
        $this->target = new $this->targetClass(10);
    }
}