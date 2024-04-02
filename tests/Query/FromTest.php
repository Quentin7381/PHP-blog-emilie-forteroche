<?php

require_once __DIR__ . '/../testsInit.php';
require_once __DIR__ .'/AbstractTestComponent.php';

use Utils\DBQuery\components\From;

class FromTest extends AbstractTestComponent {
    protected $targetClass = From::class;
    protected $toStringResult = ' FROM table';

    function setUp(): void {
        parent::setUp();
        $this->target = new $this->targetClass('table');
    }
}